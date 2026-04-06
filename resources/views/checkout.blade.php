<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

$user_id = Auth::id();
// echo $user_id;

if (!$user_id) {
	header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

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

	<style>
		#paymentLoader {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			width: 100%;
			background: rgba(0, 0, 0, 0.75) no-repeat center center;
			z-index: 10000;
			color: white;
		}
	</style>
</head>

<body class="goto-here">

	<?php include 'header.php'; ?>
	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
					<h1 class="mb-0 bread">Checkout</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">
					<form action="#" method="POST" class="billing-form">
						@csrf
						<h3 class="mb-4 billing-heading">Billing Details</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="first_name">First Name</label>
									<input type="text" class="form-control" id="first_name" name="first_name" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="last_name">Last Name</label>
									<input type="text" class="form-control" id="last_name" name="last_name" placeholder="">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="country">State / Country</label>
									<div class="select-wrap">
										<div class="icon"><span class="ion-ios-arrow-down"></span></div>
										<select name="country" id="country" class="form-control">
											<option value="India" selected>India</option>
											<option value="Italy">Italy</option>
											<option value="Philippines">Philippines</option>
											<option value="South Korea">South Korea</option>
											<option value="Hongkong">Hongkong</option>
											<option value="Japan">Japan</option>
										</select>
									</div>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="street_address">Street Address</label>
									<input type="text" id="street_address" name="street_address" class="form-control" placeholder="House number and street name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" id="landmark" name="landmark" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">Town / City</label>
									<input type="text" id="city" name="city" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="zip_code">Postcode / ZIP *</label>
									<input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" name="phone" id="phone" class="form-control" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group mt-4">
									<div class="radio">
										<!-- <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
										<label><input type="radio" name="optradio"> Ship to different address</label> -->
									</div>
								</div>
							</div>
						</div>

				</div>
				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-5">

							<?php
							$user_id = Auth::id();  // logged in id

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

								$Total = $item->quantity * $detail->price;
								$subTotal += $Total;
							}
							?>
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Cart Total</h3>
								<p class="d-flex">
									<span>Subtotal</span>
									<span id="sub_total">&#8377; <?php echo $subTotal; ?></span>
								</p>
								<p class="d-flex">
									<span>Delivery</span>
									<span id="delivery">&#8377; <?php echo $ship_charge; ?> </span>
								</p>
								<p class="d-flex">
									<span>Discount</span>
									<span id="discount">&#8377; <?php echo $totalDiscount; ?> </span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Total</span>
									<span id="net_total">&#8377; <?php echo $netTotal = $subTotal - ($totalDiscount + $ship_charge) ?> </span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="cart-detail p-3 p-md-4">
								<h3 class="billing-heading mb-4">Payment Method</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" value="COD" name="optradio" class="mr-2" checked> COD</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" value="RAZORPAY" name="optradio" class="mr-2"> Razorpay Payment</label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input required type="checkbox" id="accept_check" name="accept_check" value="" class="mr-2"> I have read and accept the terms and conditions</label>
										</div>
									</div>
								</div>
								<p><input type="button" id="placeOrderBtn" value="Place an order" class="btn btn-primary py-3 px-4"></p>
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
			</form><!-- END -->
		</div>
	</section> <!-- .section -->

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

	<div id="paymentLoader">
		<div class="row">
			<div class="col-sm-12 text-center">
				<div class="spinner-border" style="height: 4rem; width: 4rem; color: #007bff; "></div>
			</div>
			<div class="col-sm-12 text-center">
				Making Payment...
			</div>

		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

	<script src="{{ asset('js/sweetalert2.min.js') }} "></script>

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

	<script>
		function validateEmail(email) {
			var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return re.test(email);
		}

		$(function() {

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$("#placeOrderBtn").on("click", function() {

				let first_name = $("#first_name").val().trim();
				let last_name = $("#last_name").val().trim();
				let country = $("#country").val();
				let street_address = $("#street_address").val().trim();
				let landmark = $("#landmark").val().trim();
				let city = $("#city").val().trim();
				let zip_code = $("#zip_code").val().trim();
				let phone = $("#phone").val().trim();
				let email = $("#email").val().trim();

				if (first_name.length < 2) {
					Swal.fire("Your First name is mandatory.", "", "error");
					return;
				}
				if (last_name.length < 2) {
					Swal.fire("Your Last name is mandatory.", "", "error");
					return;
				}
				if (country == '') {
					Swal.fire("Please Select any Country.", "", "error");
					return;
				}
				if (street_address == '') {
					Swal.fire("Please Add Strret Address.", "", "error");
					return;
				}
				// if (landmark == '') {
				// 	Swal.fire("Enter Landmark.", "", "error");
				// 	return;
				// }
				if (city == '') {
					Swal.fire("Enter City Name.", "", "error");
					return;
				}
				if (zip_code.length < 6 || zip_code.length > 6) {
					Swal.fire("Enter valid pincode.", "", "error");
					return;
				}
				if (phone.length < 10 || phone.length > 14) {
					Swal.fire("Enter valid Phone Number.", "", "error");
					return;
				}
				if (!validateEmail(email)) {
					Swal.fire("Enter valid Email Address.", "", "error");
					return;
				}

				let payment_mode = '';
				if ($("input[name='optradio']").is(":checked")) {
					payment_mode = $("input[name='optradio']:checked").val();
				}

				if (!$('#accept_check').is(':checked')) {
					Swal.fire('Please Accept with Terms & Conditions', '', 'error');
					return;
				}

				// console.log(payment_mode)
				var formData = new FormData();
				formData.append("make_payment", true);
				formData.append("first_name", first_name);
				formData.append("last_name", last_name);
				formData.append("country", country);
				formData.append("street_address", street_address);
				formData.append("landmark", landmark);
				formData.append("city", city);
				formData.append("zip_code", zip_code);
				formData.append("phone", phone);
				formData.append("email", email);
				formData.append("payment_mode", payment_mode);

				$.ajax({
					url: "/billSubmit",
					method: "POST",
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function() {
						$("#paymentLoader").css("display", "flex");
					},
					success: function(data) {
						$("#paymentLoader").css("display", "none");
						console.log(data)
						var resp = $.parseJSON(data);
						if (resp.cod) { // COD 
							$("#first_name").val('');
							$("#last_name").val('');
							$("#street_address").val('');
							$("#landmark").val('');
							$("#city").val('');
							$("#zip_code").val('');
							$("#phone").val('');
							$("#email").val('');

							$('#sub_total').html('&#8377; 0');
							$('#delivery').html('&#8377; 0');
							$('#discount').html('&#8377; 0');
							$('#net_total').html('&#8377; 0');

							$('#accept_check').prop('checked', false);

							Swal.fire('Order Placed Successfully', '', 'success');
							setTimeout(function() {
								location.href = '/my-orders';
							}, 1000);

							return;

						}
						if (resp.empty) {
							Swal.fire("Cart is Empty, You can't Order Again", '', 'error');
							return;
						}

						if (resp.error) {
							Swal.fire("Something went wrong", resp.error, "error");
							return;
						}

						// RAZORPAY dialog open

						var options = {
							"key": "{{ config('services.razorpay.key') }}",
							"amount": resp.amount,
							"currency": "INR",
							"name": "Acme Corp",
							"description": "Test Transaction",
							"image": "https://example.com/your_logo",
							"order_id": resp.id,
							"handler": function(response) { // executes when payment is successful
								let payment_id = response.razorpay_payment_id;
								let order_id = response.razorpay_order_id;
								let signature = response.razorpay_signature;

								$("#paymentLoader").css("display", "flex");

								let formData = new FormData();
								formData.append('verifyPayment', JSON.stringify(response));
								$.ajax({
									url: "/billSubmit",
									method: "POST",
									data: formData,
									processData: false,
									contentType: false,
									success: function(data) {
										console.log('payment verification response: ' + data)
										$("#paymentLoader").css("display", "none");

										if (data.trim() == '1') {
											$("#first_name").val('');
											$("#last_name").val('');
											$("#street_address").val('');
											$("#landmark").val('');
											$("#city").val('');
											$("#zip_code").val('');
											$("#phone").val('');
											$("#email").val('');

											$('#sub_total').html('&#8377; 0');
											$('#delivery').html('&#8377; 0');
											$('#discount').html('&#8377; 0');
											$('#net_total').html('&#8377; 0');

											$('#accept_check').prop('checked', false);
											Swal.fire('Order Placed Successfully', '', 'success');

											setTimeout(function() {
												location.href = '/my-orders';
											}, 1000);
										} else {
											Swal.fire("Something went wrong", data, "error");
										}

									},
									error: function(xhr, status, error) {
										console.error(xhr.responseText);
									},
								});
							},
							"prefill": {
								"name": "Rajat Agrawal", //your customer's name
								"email": "rajatagrawal9394@gmail.com",
								"contact": "8191816126"
							},
							"notes": {
								"address": "Razorpay Corporate Office"
							},
							"theme": {
								"color": "#3399cc"
							}
						};
						var rzp1 = new Razorpay(options);
						rzp1.on('payment.failed', function(response) {
							alert(response.error.code);
							alert(response.error.description);
							alert(response.error.source);
							alert(response.error.step);
							alert(response.error.reason);
							alert(response.error.metadata.order_id);
							alert(response.error.metadata.payment_id);
						});
						rzp1.open();

					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					},
				})

			})

		})
	</script>

	<script>
		$(document).ready(function() {

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