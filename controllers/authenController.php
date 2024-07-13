<?php
function showFormLoginController(){
    if(!empty($_POST)){
        if(!empty($_POST)){
            loginUser();
        }
        
    }
    require_once PATH_VIEW. 'authen/login.php';
}
function loginUser(){   
    
    $user = getUserByUsernameAndPassword('account',$_POST['username'],$_POST['password']);
    if(empty($user)){
        $_SESSION['errors'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
        
        header('Location:' . BASE_URL. '?act=login');
        exit();
    }
    
        $_SESSION['user'] = $user;
       
        header('Location:' . BASE_URL );
        exit();
}
    
function showFormSignupController(){
    require_once PATH_VIEW . 'authen/register.php';
}
function forgotPassword(){
    if(!empty($_POST)){
       $user = getPasswordByEmail($_POST['email']);
       if(empty($user)){
        $_SESSION['errors'] = 'Email không tồn tại trên hệ thống';
       } else{

       }
    }
}
