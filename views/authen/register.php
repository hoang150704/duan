<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=BASE_URL?>assets/login/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
</head>
<body>
    <!-- Form without bootstrap -->
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-action-left">
                <div class="auth-form-outer">
                <a href="<?=BASE_URL?>">Trang chủ</a>
                <div class="d-flex flex-column">

                    <h2 class="auth-form-title">
                        Đăng kí
                    </h2>
                  </div>
                    <form class="login-form" method="post">
                        <input type="text" class="auth-form-input" placeholder="Họ và tên" name="fullname" >
                        <input type="email" class="auth-form-input" placeholder="Email" name="email" >
                        <input type="text" class="auth-form-input" placeholder="Tên đăng nhập" name="username" >
                        <div class="input-icon">
                            <input type="password" class="auth-form-input" placeholder="Mật khẩu" name="password" >
                            <i class="fa fa-eye show-password"></i>
                        </div>
                        <input type="password" class="auth-form-input" placeholder="Xác nhận mật khẩu" name="re-password" >
                        <label class="btn active">
                            <input type="checkbox" name='email1' checked>
                            <i class="fa fa-square-o"></i><i class="fa fa-check-square-o"></i> 
                            <span> I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.</span>
                        </label>
                        <div class="footer-action">
                            <input type="submit" value="Đăng ký" class="auth-submit">
                            <a href="<?=BASE_URL.'?act=login'?>" class="auth-btn-direct">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="auth-action-right">
                <div class="auth-image">
                    <img src="<?=BASE_URL?>assets/login/assets/vector.jpg" alt="login">
                </div>
            </div>
        </div>
    </div>
    <script src="<?=BASE_URL?>assets/login/js/common.js"></script>
</body>
</html>