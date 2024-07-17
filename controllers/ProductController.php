<?php
function productDetail($id){
    $view = 'products/detail';
    $product = getProductById($id);
    debug($product);
    require_once PATH_VIEW.'layouts/master.php';
}