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
function logoutUser(){
    if(!empty($_SESSION['user'])){
        session_destroy();
    }
    header('Location:'.BASE_URL);
    exit;
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
// Đăng kí tài khoản

function signupUser(){
    if(!empty($_POST)){
        $data = [
            'fullname' => $_POST['fullname'],
            'email'=> $_POST['email'],
            'username'=> $_POST['username'],
            'password'=> $_POST['password'],
            'status'=>1,
            'role'=>0,
            'create_date'=>date('Y-m-d')
        ];
        
        insert('account',$data);
        }
        
    
    require_once PATH_VIEW. 'authen/register.php';
}
// Thông tin người dùng
function infoUser(){
    require_once PATH_VIEW. 'authen/infor.php';
}