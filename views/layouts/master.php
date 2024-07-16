<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fashion eCommerce HTML Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>assets/user/theme_shop/assets/img/favicon.ico">
    
    <!-- CSS 
    ========================= -->


    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/user/theme_shop/assets/css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/user/theme_shop/assets/css/style.css">

</head>

<body>

    <!-- Main Wrapper Start -->
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">
                
    </div>

    <!--Offcanvas menu area end-->
    
    <!--header area start-->
    <?php require_once PATH_VIEW. 'layouts/partials/header.php'; ?>
    <!--header area end-->

    <!--slider area start-->
    <div class="slider_area slider_style home_three_slider owl-carousel">
        <div class="single_slider" data-bgimg="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/slider4.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_one">
                            <img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/content3.png" alt="">
                            <p>the wooboom clothing summer collection is back at half price</p>
                            <a href="shop.html">Discover Now</a>
                        </div>    
                    </div>
                </div>
            </div>    
        </div>
        <div class="single_slider" data-bgimg="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/slider5.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_two">
                            <img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/content4.png" alt="">
                            <p>the wooboom clothing summer collection is back at half price</p>
                            <a href="shop.html">Discover Now</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider" data-bgimg="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/slider6.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content content_three">
                            <img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/slider/content5.png" alt="">
                            <p>the wooboom clothing summer collection is back at half price</p>
                            <a href="shop.html">Discover Now</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider area end-->

    <!--banner area start-->
    <div class="banner_section banner_section_three">
        <div class="container-fluid">
            <div class="row ">
               <div class="col-lg-4 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner8.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner9.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner_area bottom">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="<?= BASE_URL ?>assets/user/theme_shop/assets/img/bg/banner10.jpg" alt="#"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banner area end-->
    <!-- content -->
    <?php require_once PATH_VIEW. $view . '.php'; ?>

    <!--footer area start-->
    <?php require_once PATH_VIEW. 'layouts/partials/footer.php'; ?>


<!-- JS
============================================ -->

<!-- Plugins JS -->
<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/main.js"></script>



</body>

</html>