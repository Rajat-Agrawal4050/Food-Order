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

	<link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">

	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

	<link rel="stylesheet" href="{{ asset('css/aos.css') }}">

	<link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">


	<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>

<body class="goto-here">

	<?php

	use App\Models\Cart;
	use Illuminate\Support\Facades\Auth;

	include 'header.php';
	$url = asset('images/bg_1.jpg');
	?>


	<?php
	$url = asset('images/bg_1.jpg');
	?>
	<div class="hero-wrap hero-bread" style="background-image: url({{$url}});">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
					<h1 class="mb-0 bread">Product Single</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="images/product-1.jpg" class="image-popup"><img src="{{ asset('storage/img/'.$result->image) }}" class="img-fluid" alt="Colorlib Template"></a>
				</div>

				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3>{{$result->product_name}}</h3>
					<div class="rating d-flex">
						<!-- <p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p> -->
						<p class="text-left">
							<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
						</p>
					</div>
					<p class="price"><span>&#8377; {{$result->price}}</span></p>
					<p>{{$result->description}}
					</p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<!-- <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select>
	                </div> -->
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
							<?php
							$pid = $result->id;
							$user_id = Auth::id();
							$qty = Cart::where('user_id', $user_id)->where('item_id', $pid)->value('quantity');
							if (!$qty) {
								$qty = 1;
							}
							?>
							<form method="POST" action="#">
								@csrf
								<input type="text" id="quantity" name="quantity" class="form-control input-number" value="{{$qty}}" min="1" max="<?php echo $result->stock; ?>">
								<span class="input-group-btn ml-2">
									<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
										<i class="ion-ios-add"></i>
									</button>
								</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;">{{$result->stock}} kg available</p>
						</div>
					</div>
					<p>

						<input type="hidden" name="product_id" id="product_id" value="{{$result->id}}">
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token(); }}">
						<input type="button" id="addCartBtn" class="btn btn-black py-3 px-5" value="Add to Cart">
					</p>
					</form>
				</div>

			</div>

		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Products</span>
					<h2 class="mb-4">Related Products</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">

				<?php
				$cat = $result->category;

				use App\Models\Product;

				$res = Product::where(function ($query) use ($cat, $result) {
					$query->where('category', '=', $cat);
					$query->where('id', '!=', $result->id);
				})->latest()->limit(4)->get();

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
												<!-- <span class="mr-2 price-dc">$120.00</span> -->
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
				<?Php }
				} ?>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Vegefoods</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="#" class="py-2 d-block">Shop</a></li>
							<li><a href="#" class="py-2 d-block">About</a></li>
							<li><a href="#" class="py-2 d-block">Journal</a></li>
							<li><a href="#" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">FAQs</a></li>
								<li><a href="#" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


	<?Php // include public_path('jsfile.php'); 
	?>

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
	<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('js/aos.js') }}"></script>
	<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/scrollax.min.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="{{ asset('js/google-map.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

	<script src="{{ asset('js/sweetalert2.min.js') }} "></script>

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

		$(document).ready(function() {

			$(document).on('click', '#addCartBtn', function() {

				let qty = $('#quantity').val();
				let id = $('#product_id').val();
				// console.log(qty+'pid='+id);

				if (qty < 1) {
					Swal.fire('Please Select any Quantity', '', 'error');
					return
				}

				$.ajax({
					url: "{{ route('addCart') }}",
					type: "POST",
					data: {
						_token: $('#_token').val(),
						qty: qty,
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
						} else {
							Swal.fire('Something went wrong', '', 'error');
						}
					}
				});

			});

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

</body>

</html>