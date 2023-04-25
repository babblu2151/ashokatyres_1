 <?php session_start();
include_once 'includes/inc_connection.php';//Make connection with the database  	
include_once 'includes/inc_usr_functions.php';//reuse  Code
include_once "includes/inc_config.php";// path configuration
?>
<!DOCTYPE html>
<html lang="en">


<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="Mobhil Car Dealer HTML Template" />
	<meta property="og:title" content="Mobhil Car Dealer HTML Template" />
	<meta property="og:description" content="Mobhil Car Dealer HTML Template" />
	<meta property="og:image" content="https://mobhil.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

       <!-- Page Title -->
       <title><?php if (isset($page_seo_title) && !empty($page_seo_title)) echo $page_seo_title; ?></title>
    <?php if (isset($db_seodesc) && isset($db_seokywrd)) { ?>
        <meta name="description" content="<?php echo $db_seodesc; ?>">
        <meta name="keywords" content="<?php echo $db_seokywrd; ?>">
    <?php } ?>


	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon icon -->
	<link rel="icon" type="image/png" href="<?php echo $rtpth ?>images/favicon.png">
    
	<!-- Stylesheet -->
    <link href="<?php echo $rtpth ?>vendor/lightgallery/css/lightgallery.min.css" rel="stylesheet">
	<link href="<?php echo $rtpth ?>vendor/magnific-popup/magnific-popup.min.css" rel="stylesheet">
	<link href="<?php echo $rtpth ?>vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?php echo $rtpth ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	
	<link href="<?php echo $rtpth ?>vendor/splitting/dist/splitting.css" rel="stylesheet">
	<link href="<?php echo $rtpth ?>vendor/aos/aos.css" rel="stylesheet">
	
	<!-- Revolution Slider Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo $rtpth ?>vendor/revolution/v5.4.3/css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $rtpth ?>vendor/revolution/v5.4.3/css/layers.css">
	<!-- Revolution Navigation Style -->
	<link rel="stylesheet" type="text/css" href="<?php echo $rtpth ?>vendor/revolution/v5.4.3/css/navigation.css">
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
	<!-- Custom Stylesheet -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



	<link rel="stylesheet" href="<?php echo $rtpth ?>vendor/rangeslider/rangeslider.css">
    <link rel="stylesheet" href="<?php echo $rtpth ?>css/style.css">
	<link rel="stylesheet" class="skin" href="<?php echo $rtpth ?>css/skin/skin-1.css">


</head>

<body id="bg">

<header class="site-header mo-left header style-1">

<!-- Main Header -->
<div class="sticky-header main-bar-wraper navbar-expand-lg">
    <div class="main-bar clearfix ">
        <div class="container clearfix">
            <!-- Website Logo -->
            <div class="logo-header mostion logo-dark">
                <a href="<?php echo $rtpth ?>home"><img src="<?php echo $rtpth ?>images/logo.png" alt=""></a>
            </div>
            <!-- Nav Toggle Button -->
            <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <!-- Extra Nav -->
            <div class="extra-nav">
            <div class="extra-cell">
                    <a href="<?php echo $rtpth ?>my-cart.php" class="btn btn-primary  light phone-no shadow-none cat-home effect-1"><span><i class="fas fa-cart-arrow-down hdr-cart-icons"></i></span></a>
                </div>
                <div class="extra-cell">
                <a href="<?php echo $rtpth;?>signin" class="btn btn-primary  light phone-no shadow-none  effect-1"><span><i class="fas fa-user  hdr-cart-icons"></i></span></a>
                <!-- <a href="<?php echo $rtpth;?>signin" class="btn btn-primary light phone-no shadow-none cat-home effect-1"><i class="fas fa-user hdr-cart-icons"></i></a> -->



                    <!-- <a href="tel:9849003100"
                        class="btn btn-primary light phone-no shadow-none effect-1"><span><i
                                class="fas fa-phone-volume shake"></i>984 900 3100</span></a> -->
                </div>
            </div>
            <!-- Extra Nav -->
            <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                <div class="logo-header">
                    <a href="<?php echo $rtpth ?>home"><img src="<?php echo $rtpth ?>images/logo.png" alt=""></a>
                </div>
                <ul class="nav navbar-nav navbar navbar-left">
                    <li class=""><a href="<?php echo $rtpth;?>home"><i class="fas fa-home hdr-cart-icons"></i></a></li>
                    <li class=""><a href="<?php echo $rtpth;?>about-us">About Us</a></li>
                    <li class=""><a href="<?php echo $rtpth;?>product_type.php?type=car">Car Tyres</a></li>
                    <li class=""><a href="<?php echo $rtpth;?>product_type.php?type=bike">Bike Tyres</a></li>
                    <!-- <li class=""><a href="javascript:void(0);">Battery</a></li> -->
                    <li class=""><a href="<?php echo $rtpth;?>contact-us">Contact</a></li>
                    <!-- <li class=""><a href="<?php echo $rtpth;?>logout">Logout</a></li> -->
                    

                    <!-- <li class=""><a href="<?php echo $rtpth;?>signin"><i class="fas fa-user"></i></a></li> -->

                    <!-- <li class="sub-menu-down"><a href="javascript:void(0);">NEW<i class="fa fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:void(0);">CAR LISTING<i class="fa fa-angle-right"></i></a>
                            <ul class="sub-menu">
                                <li><a href="car-listing.html">CAR LISTING 1</a></li>
                                <li><a href="car-listing-2.html">CAR LISTING 2</a></li>
                                <li><a href="car-listing-3.html">CAR LISTING 3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);">SEARCH CAR<i class="fa fa-angle-right"></i></a>
                            <ul class="sub-menu">
                                <li><a href="new-car-search.html">SEARCH CAR</a></li>
                                <li><a href="new-car-search-result-list.html">SEARCH RESULT LIST</a></li>
                                <li><a href="new-car-search-result-column.html">SEARCH RESULT COLUMN</a></li>
                            </ul>
                        </li>
                        <li><a href="latest-cars.html">LATEST CARS</a></li>
                        <li><a href="popular-cars.html">POPULAR CARS</a></li>
                        <li><a href="upcoming-cars.html">UPCOMING CARS</a></li>
                        <li>
                            <a href="javascript:void(0);">DEALERS & SERVICE<i class="fa fa-angle-right"></i></a>
                            <ul class="sub-menu">
                                <li><a href="car-dealers.html">CAR DEALERS</a></li>
                                <li><a href="car-service-center.html">SERVICE CENTER</a></li>
                            </ul>
                        </li>
                        <li><a href="on-road-price.html">ON ROAD PRICE</a></li>
                    </ul>
                </li> -->

                </ul>
                <div class="dlab-social-icon">
                    <ul>
                        <li><a class="fab fa-facebook-f" href="javascript:void(0);"></a></li>
                        <li><a class="fab fa-twitter" href="javascript:void(0);"></a></li>
                        <li><a class="fab fa-linkedin-in" href="javascript:void(0);"></a></li>
                        <li><a class="fab fa-instagram" href="javascript:void(0);"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Header End -->
</header>
<!-- Header End -->

</body>

</html>
