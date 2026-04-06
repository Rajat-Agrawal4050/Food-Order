<?Php

use App\Models\Category;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="token" id="token" content="{{ csrf_token(); }}">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="/css/animate.css">

  <link rel="stylesheet" href="/css/owl.carousel.min.css">
  <link rel="stylesheet" href="/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="/css/magnific-popup.css">

  <link rel="stylesheet" href="/css/aos.css">

  <link rel="stylesheet" href="/css/ionicons.min.css">

  <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="/css/jquery.timepicker.css">


  <link rel="stylesheet" href="/css/flaticon.css">
  <link rel="stylesheet" href="/css/icomoon.css">
  <link rel="stylesheet" href="/css/style.css">

  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

</head>

<body class="goto-here">

  <?php include 'header.php'; ?>

  <div class="hero-wrap hero-bread" style="background-image: url('/images/bg_1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
          <h1 class="mb-0 bread">Products</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 mb-5 text-center">
          <ul class="product-category">
            <li><a href="/shop" class="<?php if (!isset($cat)) echo "active" ?>">All</a></li>
            <?php
            $categories = Category::get();
            foreach ($categories as $c) {
            ?>
              <li><a href="/shop/<?php echo $c->category_title ?>" class="<?php if (isset($cat) && $cat == $c->category_title) echo "active" ?>"><?php echo $c->category_title ?></a></li>
            <?php } ?>

          </ul>
        </div>
      </div>
      <div class="row">
        <?php

        use App\Models\Product;

        if (isset($cat)) {
          $res = Product::where(function ($query) use ($cat) {
            $query->where('category', '=', $cat);
          })->latest()->paginate(8);
        } else {
          $res = Product::latest()->paginate(8);
        }

        if (isset($res[0])) {

          foreach ($res as $product) {
        ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
              <div class="product">
                <a href="/product-single/{{ $product->id}}" class="img-prod"><img class="img-fluid" src="{{ asset('storage/img/'.$product->image) }}" alt="Colorlib Template">
                  <!-- <span class="status">30%</span> -->
                  <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                  <h3><a href="#">{{ $product->product_name }}</a></h3>
                  <div class="d-flex">
                    <div class="pricing">
                      <p class="price">
                        <!-- <span class="mr-2 price-dc">&#8377; </span> -->
                        <span class="price-sale">&#8377;{{ $product->price }}</span>
                      </p>
                    </div>
                  </div>
                  <div class="bottom-area d-flex px-3">
                    <div class="m-auto d-flex">
                      <a href="/product-single/{{ $product->id}}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                        <span><i class="ion-ios-menu"></i></span>
                      </a>
                      <a href="javascript:void(0)" data-id="{{ $product->id}}" onclick="addCart1(this)"
                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                        <span><i class="ion-ios-cart"></i></span>
                      </a>
                      <a href="javascript:void(0)" class="heart d-flex justify-content-center align-items-center ">
                        <span><i class="ion-ios-heart"></i></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        } else {
          ?>
          <div class="col-md-12 text-center">
            <p style="color:red; font-weight:bold; padding-top:14px;">No Data Found</p>
          </div>
        <?php } ?>
      </div>
      <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <!-- <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul> -->
            {{ $res->links('vendor.pagination.custom') }}
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('footer');



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

  <?php
  include public_path('jsfile.php');
  ?>

</body>

</html>

<script>
  function addCart1(ele) {

    let id = $(ele).data('id');
    // alert(id)
    let _token = $('#token').attr('content');
    //   console.log(_token)
    // return
    $.ajax({
      url: "{{ route('addCart1') }}",
      type: "POST",
      data: {
        _token: _token,
        id: id,
      },
      cache: false,
      success: function(html) {
        console.log(html)
        resp = html.trim();
        if (resp == -1) {
          Swal.fire('Please Login', '', 'error');
        } else if (resp == 1) {
          Swal.fire('Added to Cart', '', 'success');
        } else if (resp == -2) {
          Swal.fire('Incremented', '', 'success');
        } else {
          Swal.fire('Something went wrong', '', 'error');
        }
      }
    });
  }
</script>