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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
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

    <!--slider area end-->

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
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>