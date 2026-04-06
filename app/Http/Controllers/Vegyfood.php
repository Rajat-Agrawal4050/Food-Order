<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\BillingAddress;
use App\Models\Category;
use App\Notifications\NotifyUser;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Razorpay\Api\Api;

class Vegyfood extends Controller
{
    //

    public function index($id)
    {
        return view('products', ['id' => $id]);
    }

    public function product_single($id)
    {
        $result = Product::find($id);
        return view('product-single', ['result' => $result]);
    }

    public function showEditProduct($id)
    {
        return view('admin.edit-product', ['id' => $id, 'categories' => Category::all()]);
    }

    public function adminLogin(Request $req)
    {

        $user = User::where('email', $req->username)->first();

        if ($user && Hash::check($req->password, $user->password) && $user->role == 'admin') {

            Auth::login($user);
            return 1;
        } else {
            return 0;
        }
    }

    public function addCart(Request $req)
    {
        if (!Auth::check()) {
            return -1;
        }

        $qty = $req->qty;
        $user_id = Auth::id();  // id of logged in user
        $id = $req->id;

        $res = DB::table('carts')->where('user_id', '=', $user_id)->where('item_id', '=', $id)->exists();

        if ($res == null || $res == '' || $res == false) {
            $r = Cart::create([
                'user_id' => $user_id,
                'item_id' => $id,
                'quantity' => $qty
            ]);
            if ($r) {
                return 1;
            } else {
                return 0;
            }
        } else if ($res) {
            $r2 = Cart::where('user_id', $user_id)->where('item_id', $id)->update([
                'quantity' => $qty,
            ]);
            if ($r2) {
                return 1;
            } else {
                return 0;
            }
        }

        // echo $r;

    }

    public function addCart1(Request $req)
    {
        if (!Auth::check()) {
            return -1;
        }

        $user_id = Auth::id();  // id of logged in user
        $id = $req->id;

        $res = DB::table('carts')->where('user_id', '=', $user_id)->where('item_id', '=', $id)->exists();

        if ($res == null || $res == '' || $res == false) {
            $r = Cart::create([
                'user_id' => $user_id,
                'item_id' => $id,
                'quantity' => '1',
            ]);
            if ($r) {
                return 1;
            } else {
                return 0;
            }
        } else if ($res) {
            $r2 = Cart::where('user_id', $user_id)->where('item_id', $id)->increment('quantity');  // increments quantity col by 1
            return -2;
        }
        // echo $r;

    }

    public function subscribe(Request $req)
    {

        $email = $req->email_value;

        if (!$email) {
            return response('0');
        } else {
            // Mail::to('rajatagrawal9394@gmail.com')->send(new WelcomeMail('Site Subscribed', $email));

            $admin = User::where('role', 'admin')->first();
            $admin->notify(new NotifyUser($email));
            return response('1');
        }
    }

    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }

    public function billSubmit(Request $req)
    {

        $user_id = Auth::id();
        // print_r($req);
        // return $req;
        if ($req->make_payment) {

            $product_ids = $qtys = '';
            $i = 0;

            $result = Cart::where(
                function ($query) use ($user_id) {
                    if ($user_id)
                        $query->where('user_id', '=', $user_id);
                    else
                        $query->where('user_id', '=', '-1');
                }
            )->get();

            $subTotal = $totalDiscount = $ship_charge = 0;
            $netTotal = 0;

            foreach ($result as $item) {

                $detail = Product::find($item->item_id);
                if (!$detail) {
                    continue;
                }
                $i++;

                if ($product_ids == '')
                    $product_ids = $product_ids . $item->item_id;
                else
                    $product_ids = $product_ids . ',' . $item->item_id;

                if ($qtys == '')
                    $qtys = $qtys . $item->quantity;
                else
                    $qtys = $qtys . ',' . $item->quantity;

                $Total = $item->quantity * $detail->price;
                $subTotal += $Total;
            };

            $netTotal = $subTotal - ($totalDiscount + $ship_charge);

            if ($i == 0) {
                return json_encode(array('empty' => true));
            }

            $address_obj = BillingAddress::create([

                'user_id' => Auth::id(),
                'first_name' =>  $req->first_name,
                'last_name' => $req->last_name,
                'country' => $req->country,
                'street_address' =>  $req->street_address,
                'city' =>  $req->city,
                'zip_code' =>  $req->zip_code,
                'phone' =>    $req->phone,
                'email' =>   $req->email
            ]);

            $add_id = $address_obj->id;

            $payment_status = 'PENDING';
            $order_status = 'PENDING';
            $payment_mode = $req->payment_mode;

            if ($payment_mode == 'COD') {
                $order_status = 'COMPLETED';
            }

            $order_obj = Order::create([

                'product_id' => $product_ids,
                'user_id' => Auth::id(),
                'qty' => $qtys,
                'amount' => $netTotal,
                'discount' =>  $totalDiscount,
                'address' => $add_id,
                'payment_method' => $payment_mode,
                'order_status' => $order_status,
                'payment_status' => $payment_status,
            ]);

            $insertID = $order_obj->id;

            if ($payment_mode == 'COD') {

                $res = Cart::where(
                    function ($query) use ($user_id) {
                        if ($user_id)
                            $query->where('user_id', '=', $user_id);
                        else
                            $query->where('user_id', '=', '-1');
                    }
                )->delete();

                return json_encode(array('cod' => true));
            }

            // echo 'add='. $add_id;

            // create razorpay order

            $amount = $netTotal;
            $amount = round($amount, 2) * 100;

            session(['order_in_progress' => $insertID]);

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $orderData = [
                'receipt'         => 'order_' . rand(1000, 9999),
                'amount'          => $amount,  // in paise
                'currency'        => 'INR',
                'payment_capture' => 1
            ];

            $razorpayOrder = $api->order->create($orderData);
            //  echo $razorpayOrder['id'];
            $arr = array();
            foreach ($razorpayOrder as $key => $value) {
                if (is_object($key)  ||  is_object($value))   continue;
                $arr[$key] = $value;
            }

            return json_encode($arr);
        } else if ($req->verifyPayment && session()->has('order_in_progress')) {

            $resp = json_decode($req->verifyPayment);

            $pay_id = $resp->razorpay_payment_id;
            $razorpay_order_id = $resp->razorpay_order_id;
            $signature = $resp->razorpay_signature;

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            try {
                $attr = [
                    'razorpay_order_id' => $razorpay_order_id,
                    'razorpay_payment_id' => $pay_id,
                    'razorpay_signature' => $signature
                ];

                $api->utility->verifyPaymentSignature($attr);

                $order_id = session('order_in_progress');

                Order::where('id', $order_id)->update(['order_status' => 'COMPLETED', 'payment_status' => 'PAID', 'payment_id' => $pay_id]);

                $res = Cart::where(
                    function ($query) use ($user_id) {
                        if ($user_id)
                            $query->where('user_id', '=', $user_id);
                        else
                            $query->where('user_id', '=', '-1');
                    }
                )->delete();

                return 1;
            } catch (\Exception) {
                return "Payment Verification Failed";
            }
        }
    }

    public function showProducts()
    {

        $result = Product::get();

        return view('admin.products', ['data' => $result]);
    }

    public function addProduct(Request $req)
    {

        $filename = time() . "." . $req->file('product_image')->getClientOriginalExtension();
        $path = $req->file('product_image')->storeAs('img', $filename, 'public');  // stores in storage/app/ folder in public disk not local disk 

        $result = Product::create(
            [
                'product_name' =>    $req->product_name,
                'category' =>  $req->category,
                'price' => $req->price,
                'stock' => $req->stock,
                'image' => $filename,
                'description' => $req->desc
            ]
        );

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editProduct(Request $req)
    {

        // return $req;
        $filename = $req->old_img;
        if ($req->file('product_image')) {
            $filename = time() . "." . $req->file('product_image')->getClientOriginalExtension();
            $path = $req->file('product_image')->storeAs('img', $filename, 'public');
        }

        $result = Product::where('id', $req->product_id)->update(
            [
                'product_name' =>    $req->product_name,
                'category' =>  $req->category,
                'price' => $req->price,
                'stock' => $req->stock,
                'image' => $filename,
                'description' => $req->desc
            ]
        );

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public function markasread($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }
}
