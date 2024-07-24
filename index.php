<?php
session_start();
// require file trong commons
require_once "./commons/env.php";
require_once "./commons/helper.php";
require_once "./commons/connect-db.php";
require_once "./commons/function.php";
// require tự động
require __DIR__ ."/PHPMailer-master/src/PHPMailer.php"; 
require __DIR__ ."/PHPMailer-master/src/SMTP.php"; 
require __DIR__ .'/PHPMailer-master/src/Exception.php';
require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);


// Điều hướng
$act=$_GET['act'] ?? '/';
checkCheckout($act);
match ($act) {
    '/' =>homeController(),
    // Tài khoản
    'login'=>showFormLoginController(),
    'logout'=>logoutUser(),
    'signup'=>signupUser(),
    // Thông tin khách hàng
    'info'=>infoUser(),
    'order'=>orderOfUser(),
    'change-password'=>changePassword(),
    'change-password-success'=>changePasswordSuccess(),
    'update-user'=>updateUser(),
    'change-email'=>changeEmail($_GET['check']),
    'success-change-email'=>changeEmailSuccess(),
    // Sản phẩm
    'product-detail'=>productDetail($_GET['id']),
    'product-list'=>productList($_GET['id']),
    // Giỏ hàng
    'cart'=>cartView(),
    // Đơn hàng
    'checkout'=>checkoutOrder(),
    'success'=>successOrder(),
    
};

// 
require_once "./commons/disconnect-db.php";

?>