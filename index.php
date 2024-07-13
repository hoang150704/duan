<?php
session_start();
// require file trong commons
require_once "./commons/env.php";
require_once "./commons/helper.php";
require_once "./commons/connect-db.php";
require_once "./commons/model.php";
// require tự động

require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);


// Điều hướng
$act=$_GET['act'] ?? '/';
match ($act) {
    '/' =>homeController(),
    'login'=>showFormLoginController(),
    'signup'=>showFormSignupController(),
    
};

// 
require_once "./commons/disconnect-db.php";

?>