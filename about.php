<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Blood Donar Management System | About Us </title>
	<!-- Meta tag Keywords -->

	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link
		href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
		rel="stylesheet">
	<link
		href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
		rel="stylesheet">
	<!-- //Web-Fonts -->

</head>

<body>
	<?php include('includes/header.php'); ?>

	<!-- banner 2 -->
	<div class="inner-banner-w3ls">
		<div class="container">

		</div>
		<!-- //banner 2 -->
	</div>
	<!-- page details -->
	<!-- <div class="breadcrumb-agile">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.php">Home</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">About Us</li>
			</ol>
		</div>
	</div> -->
	<!-- //page details -->

	<!-- about -->
	<section class="about">
		<div class="container py-xl-2 py-lg-2">
			<div class="w3ls-titles text-center mb-md-5 mb-4">
				<h3 class="title">Who We Are?</h3>
				<span>
					<i class="fas fa-user-md"></i>
				</span>
				<p class="py-3">We're leveraging the power of technology to revolutionize blood donation. Our platform
					utilizes real-time data and advanced matching algorithms to ensure that blood is efficiently
					distributed to those who need it most. By embracing innovation, we're making a significant impact on
					the lives of countless individuals.
			</div>
		</div>
	</section>

	<style>
		.photos {
			height: 20px;
			width: 30%;
		}
		.last {
			padding-top: 615px;
		}
	</style>

	<section class="p-5">
		<h3 class="title py-xl-2 py-lg-2">Behind This Project?</h3>
		<div class="photos">
			<div class="card-deck">
				<div class="card">
					<img src="images\wangbu.jpg" class="card-img-top team-img" alt="Wangbu"
						style="max-width: 100%; height: auto;">
					<div class="card-body">
						<h4 class="card-title">Wangbu Theeng </h4>
						<p class="card-text">Wangbu is a valuable team member with expertise in php and frontend
							technology.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //about -->

	<div class="last">



		<?php include('includes/footer.php'); ?>


		<!-- Js files -->
		<!-- JavaScript -->
		<script src="js/jquery-2.2.3.min.js"></script>
		<!-- Default-JavaScript-File -->

		<!-- banner slider -->
		<script src="js/responsiveslides.min.js"></script>
		<script>
			$(function () {
				$("#slider4").responsiveSlides({
					auto: true,
					pager: true,
					nav: true,
					speed: 1000,
					namespace: "callbacks",
					before: function () {
						$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});
			});
		</script>
		<!-- //banner slider -->

		<!-- fixed navigation -->
		<script src="js/fixed-nav.js"></script>
		<!-- //fixed navigation -->

		<!-- smooth scrolling -->
		<script src="js/SmoothScroll.min.js"></script>
		<!-- move-top -->
		<script src="js/move-top.js"></script>
		<!-- easing -->
		<script src="js/easing.js"></script>
		<!--  necessary snippets for few javascript files -->
		<script src="js/medic.js"></script>

		<script src="js/bootstrap.js"></script>
		<!-- Necessary-JavaScript-File-For-Bootstrap -->

		<!-- //Js files -->
	</div>
</body>

</html>