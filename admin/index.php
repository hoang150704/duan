<?php
// require file trong commons
session_start();
require_once "../commons/env.php";
require_once "../commons/helper.php";
require_once "../commons/connect-db.php";
require_once "../commons/model.php";
// require tự động

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);


// Điều hướng
$act=$_GET['act'] ?? '/';
checkLoginAuthen($act);
match ($act) {
    '/' =>dashboard(),
    // User
    'user'=>userListAll(),
    'user-detail'=>userShowOne($_GET['id']),
    'user-create'=>userCreate(),
    'user-update'=>userUpdate($_GET['id']),
    'user-delete'=>userDelete($_GET['id']),
    // category
    'category'=>categoryListAll(),
    'category-create'=>categoryCreate(),
    'category-update'=>categoryUpdate($_GET['id']),
    'category-delete'=>categoryDelete($_GET['id']),
    'category-detail'=>categoryShowOne($_GET['id']),
    // satatus order 
    'status_order'=>statusOrderListAll(),
    'status_order-create'=>statusOrderCreate(),
    'status_order-update'=>statusOrderUpdate($_GET['id']),
    'status_order-delete'=>statusOrderDelete($_GET['id']),
    'status_order-detail'=>statusOrderShowOne($_GET['id']),
    // Attribute
    'attribute'=>attributeListAll(),
    'attribute-create'=>attributeCreate(),
    'attribute-update'=>attributeUpdate($_GET['id']),
    'attribute-delete'=>attributeDelete($_GET['id']),
    'attribute-detail'=>attributeShowOne($_GET['id']),
    // Attribute_value
    'attributeValue-create'=>attributeValueCreate($_GET['id']),
    'attributeValue-update'=>attributeValueUpdate($_GET['idat'],$_GET['id']),
    'attributeValue-create'=>attributeValueDelete($_GET['idat'],$_GET['id']),
    // Authen
    'login'=>authenShowFormLoginAdmin(),
    'logout'=>logoutAuthen(),
    // Product
    
    'product'=>productListAll(),
    'product-detail'=>productShowOne($_GET['id']),
    'product-create'=>productCreate(),
    'product-update'=>productUpdate($_GET['id']),
    'product-delete'=>productDelete($_GET['id']),

};
    



// 
require_once "../commons/disconnect-db.php";

?>