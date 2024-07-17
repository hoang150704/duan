<?php
function homeController(){

    $view = 'home';
    $style = 'style/home';
    $listAoThun = listProductByCategoryLimit8(1);
    $listAoSoMi = listProductByCategoryLimit8(2);
    $listAoPolo = listProductByCategoryLimit8(3);
    $listQuanAu = listProductByCategoryLimit8(5);
    require_once PATH_VIEW.'layouts/master.php';
}
?>