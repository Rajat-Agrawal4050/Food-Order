<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Vegyfood;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('admin');

Route::get('/accounts', function () {
    return view('admin.accounts');
})->middleware('admin');


Route::get('/addProduct', function () {
    return view('admin.add-product');
})->middleware('admin');

Route::get('/all_products', function () {
    return view('admin.products');
})->middleware('admin');

Route::post('/add', [Vegyfood::class, 'addProduct']);
Route::post('/edit', [Vegyfood::class, 'editProduct']);

Route::get('/edit_product/{id}', [Vegyfood::class, 'showEditProduct'])->name('edit.product');

Route::get('/product', [Vegyfood::class, 'showProducts']);

Route::get('/account', function () {
    return view('admin/accounts');
});


Route::get('/my-orders', function () {
    return view('my-orders');
})->name('my-orders');


Route::get('/admin_login', function () {
    return view('admin.login');
});

Route::post('/billSubmit', [Vegyfood::class, 'billSubmit']);

Route::get('/products/{cat}', [Vegyfood::class, 'index']);


Route::post('/admin_login', [Vegyfood::class, 'adminLogin'])->name('admin.login');

Route::get('/about', function () {
    return view('about');
});

Route::get('/logout', [Vegyfood::class, 'logout']);

Route::post('/addCart', [Vegyfood::class, 'addCart'])->name('addCart');

Route::post('/addCart1', [Vegyfood::class, 'addCart1'])->name('addCart1');

Route::get('/product-single/{id}', [Vegyfood::class, 'product_single']);

Route::get('/blog-single', function () {
    return view('blog-single');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/product-single', function () {
    return view('product-single');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/shop/{cat}', function ($cat) {
    return view('shop', ['cat' => $cat]);
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/markasread/{id}', [Vegyfood::class, 'markasread'])->name('markasread');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/subscribe', [Vegyfood::class, 'subscribe']);

Route::get('/storage_link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});

Route::get('/cache', function () {
    Artisan::call('cache:clear');
    return 'cache cleared successfully!';
})->name('cache');
