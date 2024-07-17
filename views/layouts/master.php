<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fashion eCommerce HTML Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    
    <!-- CSS 
    ========================= -->

    <?php require_once PATH_VIEW. $style . '.php'; ?>
   
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