<?php

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\BillingAddress;

$user_id = Auth::id();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Admin - Dashboard HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="index.html">
                    <h1 class="tm-site-title mb-0">Product Admin</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-file-alt"></i>
                                <span>
                                    Reports <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Daily Report</a>
                                <a class="dropdown-item" href="#">Weekly Report</a>
                                <a class="dropdown-item" href="#">Yearly Report</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/all_products">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-user"></i>
                                Accounts
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                                <span>
                                    Settings <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Billing</a>
                                <a class="dropdown-item" href="#">Customize</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="/logout">
                                Admin, <b>Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <!-- <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Performance</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div> -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Storage Information</h2>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Notification List</h2>
                        <div class="tm-notification-items">
                            <?php

                            $result = DB::table('notifications')->where('read_at', null)->latest()->get();

                            foreach ($result as $p) {
                            ?>

                                <div class="media tm-notification-item">
                                    <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                    <div class="media-body">
                                        <p class="mb-2"><b><?Php echo json_decode($p->data)->message; ?></b> has subscribed your Site. <br>
                                            <span class="tm-small tm-text-color-secondary">{{ \Carbon\Carbon::parse($p->created_at)->format('d M, Y \a\t h:i') }}</span>
                                            &nbsp;&nbsp; <a href="{{ route('markasread', $p->id) }}" class="tm-small text-warning">Mark as Read</a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = Order::latest()->get();

                                $subTotal = $totalDiscount = $ship_charge = 0;
                                $netTotal = $i = 0;
                                foreach ($result as $order) {
                                    $i++;


                                    // $Total = $item->quantity * $detail->price;
                                    // $subTotal += $Total;
                                    $user_id = $order->user_id;
                                    $buyer = User::find($user_id);
                                    $add = BillingAddress::find($order->address);
                                    $id = $order->product_id;
                                    $qty = $order->qty;
                                    $ids = explode(',', $id);

                                    $qtys = explode(',', $qty);

                                    $order_date = $order->created_at;

                                    $i = 0;
                                    foreach ($ids as $id) {

                                        if ($id == '')
                                            continue;

                                        $detail = Product::find($id);
                                        // moving, pending,cancelled
                                ?>
                                        <tr>
                                            <td><b>#{{ $order->id }}</b></td>
                                            <td><img src="{{ asset('storage/img/' . $detail->image) }}" height="50px" width="50px"></td>

                                            <td><b>{{$detail->product_name}}</b></td>
                                            <td><b>{{ $qtys[$i] }}</b></td>
                                            <td><b>&#8377; {{ ($detail->price - $detail->discount) }}</b></td>
                                            <td>{{$buyer->email}}</td>
                                            <td>{{ $add->city }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('h:i\, d M Y') }}</td>
                                            <td>
                                                <div class="tm-status-circle <?php if ($order->order_status == 'PENDING') {
                                                                                    echo "pending";
                                                                                } else if ($order->order_status == 'COMPLETED') {
                                                                                    echo "moving";
                                                                                } ?>">
                                                </div><?php if ($order->order_status == 'PENDING') {
                                                            echo "PENDING";
                                                        } else if ($order->order_status == 'COMPLETED') {
                                                            echo "COMPLETED";
                                                        } ?>
                                            </td>
                                            <td>
                                                <div class="tm-status-circle <?php if ($order->payment_status == 'PENDING') {
                                                                                    echo "pending";
                                                                                } else if ($order->payment_status == 'PAID') {
                                                                                    echo "moving";
                                                                                } ?>">
                                                </div><?php if ($order->payment_status == 'PENDING') {
                                                            echo "PENDING";
                                                        } else if ($order->payment_status == 'PAID') {
                                                            echo "PAID";
                                                        } ?>
                                            </td>
                                        </tr>

                                <?php
                                        $i++;
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                    Copyright &copy; <b>2018</b> All rights reserved.

                    Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
                </p>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function() {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function() {
                updateLineChart();
                updateBarChart();
            });
        })
    </script>
</body>

</html>