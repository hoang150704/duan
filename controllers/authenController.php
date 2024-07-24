<?php
function showFormLoginController()
{
    if (!empty($_POST)) {
        if (!empty($_POST)) {
            loginUser();
        }
    }
    require_once PATH_VIEW . 'authen/login.php';
}
function isUserLoggedIn()
{
    return isset($_SESSION['user']);
}
function loginUser()
{

    $user = getUserByUsernameAndPassword('account', $_POST['username'], $_POST['password']);
    if (empty($user)) {
        $_SESSION['errors'] = 'Tên đăng nhập hoặc mật khẩu không đúng';

        header('Location:' . BASE_URL . '?act=login');
        exit();
    }

    $_SESSION['user'] = $user;
    if (isset($_GET['redirect'])) {
        $redirect_url = $_GET['redirect'];
        header('Location:' . $redirect_url);
    } elseif (isset($_SESSION['redirect_after_login'])) {
        $redirect_url = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect_url");
        exit();
    } else {
        // Nếu không có URL nào được lưu trữ, chuyển hướng đến trang mặc định (ví dụ: trang chủ)
        header('Location:' . BASE_URL);
    }
    exit();
}
function logoutUser()
{
    if (!empty($_SESSION['user'])) {
        session_destroy();
    }
    if (isset($_GET['redirect'])) {
        $redirect_url = $_GET['redirect'];
        header('Location:' . $redirect_url);
    } else {
        // Nếu không có URL nào được lưu trữ, chuyển hướng đến trang mặc định (ví dụ: trang chủ)
        header('Location:' . BASE_URL);
    }
    exit();
}


function forgotPassword()
{
    if (!empty($_POST)) {
        $user = getPasswordByEmail($_POST['email']);
        if (empty($user)) {
            $_SESSION['errors'] = 'Email không tồn tại trên hệ thống';
        } else {
        }
    }
}
// Đăng kí tài khoản

function signupUser()
{
    if (!empty($_POST)) {
        $data = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'status' => 1,
            'role' => 0,
            'create_date' => date('Y-m-d')
        ];

        insert('account', $data);
    }


    require_once PATH_VIEW . 'authen/register.php';
}
// Thông tin người dùng
function infoUser()
{
    $view = 'authen/info';
    $style = 'style/info';
    $script = 'info';
    $comments = getCommentForUser($_SESSION['user']['id']);
    require_once PATH_VIEW . 'layouts/master.php';
}
function orderOfUser()
{
}
function changePassword()
{
    $view = 'authen/changePassword';
    $style = 'style/info';
    $script = 'info';
    if (!empty($_POST)) {
        $data = [
            'password' => $_POST['password']
        ];
        $repass = $_POST['rePassword'];
        $oldpass = $_POST['oldPassword'];
        $errors = [];
        if (empty($oldpass)) {
            $errors = 'Mật khẩu cũ không được để trống';
        } else if ($oldpass != $_SESSION['user']['password']) {
            $errors = 'Bạn đã nhập sai mật khẩu cũ';
        } else {
            if (empty($data['password'])) {
                $errors = 'Mật khẩu mới không được để trống';
            } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
                $errors = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
            } elseif (preg_match('/\s/', $data['password'])) {
                $errors = 'Mật khẩu không được có khoảng trắng';
            } else if (regaxVietnamese($data['password'])) {
                $errors = 'Mật khẩu không được có dấu';
            } else if ($data['password'] != $repass) {
                $errors = 'Mật khẩu mới và nhập lại mật khẩu mới phải giống nhau';
            }
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ' . BASE_URL . '?act=change-password');
            exit;
        } else {
            update('account', $_SESSION['user']['id'], $data);
            session_destroy();
            header('Location: ' . BASE_URL . '?act=change-password-success');
            exit;
        }
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Thành công
function changePasswordSuccess()
{
    require_once PATH_VIEW . 'authen/success_change_pass.php';
}
// Up date
function updateUser()
{
    $view = 'authen/update';
    $style = 'style/info';
    $script = 'info';
    if (!empty($_POST)) {
        $data = [
            'fullname' => $_POST['fullname'] ?? $_SESSION['user']['fullname'],
            'address' => $_POST['address'] ?? $_SESSION['user']['address'],
            'phone' => $_POST['phone'] ?? $_SESSION['user']['phone'],
            'avatar' => $_FILES['avatar'] ?? $_SESSION['user']['avatar'],
        ];
        $avatar = $data['avatar'];
        $errors = [];
        if (empty($data['fullname']) || ctype_space($data['fullname'])) {
            $errors[] = 'Vui lòng nhập tên.';
        } else {
            // Xử lý nếu tên hợp lệ
            $data['fullname'] = ltrim($data['fullname']);
        }

        if (empty($data['address']) || ctype_space($data['address'])) {
            $errors[] = 'Vui lòng nhập địa chỉ.';
        } else {
            // Xử lý nếu địa chỉ hợp lệ
            $data['address'] = ltrim($data['address']);
        }

        // Xử lí số đt
        $data['phone'] = preg_replace('/\s+/', '', $data['phone']);
        if (empty($data['phone']) || ctype_space($data['phone'])) {
            $errors[] = 'Vui lòng nhập số điện thoại.';
        } elseif (!ctype_digit($data['phone'])) {
            $errors[] = 'Số điện thoại chỉ được chứa số.';
        } elseif (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
        // Xử lí hình nahr
        if ($data['avatar']['size'] > 0) {
            $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];
            if ($data['avatar']['size'] > 2 * 1024 * 1024) {
                $errors[] = 'Không thể tải file quá 2Mb';
            } else if (!in_array($data['avatar']['type'], $typeImage)) {
                $errors[] = 'Chỉ upload file .png .jpg .jpeg';
            }
        }
        // XỬ lí xem có lỗi không
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            if (!empty($avatar) && $avatar['size'] > 0) {
                $data['avatar'] = uploadFlie($avatar, 'uploads/users/');
            } else {
                $data['avatar'] = $_SESSION['user']['avatar'];
            }
            update('account', $_SESSION['user']['id'], $data);
            $_SESSION['user']['fullname'] = $data['fullname'];
            $_SESSION['user']['address'] = $data['address'];
            $_SESSION['user']['phone'] = $data['phone'];
            $_SESSION['user']['avatar'] = $data['avatar'];
            $_SESSION['success'] = 'Bạn đã thay đổi thông tin thành công';
        }
        header('Location: ' . BASE_URL . '?act=update-user');
        exit;
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Đổi email
function changeEmail($check)
{
    $view = 'authen/changeEmail';
    $style = 'style/info';
    $script = 'info';
    // 
    if ($check == 1) {
        $style1 = 'style="display: block;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: none;"';

        if (!empty($_POST)) {
            if ($_POST['email'] != $_SESSION['user']['email']) {
                $_SESSION['errors'] = "Email của bạn không đúng";
                header('Location: ' . BASE_URL . '?act=change-email&check=1');
                exit;
            } else {
                $titleEmail = "Xác nhận email";
                $session_lifetime = 180; // 3 phút

                // Kiểm tra nếu mã xác nhận đã tồn tại và đã hết hạn
                if (isset($_SESSION['verification']) && isset($_SESSION['created'])) {
                    if (time() - $_SESSION['created'] > $session_lifetime) {
                        unset($_SESSION['verification']);
                        unset($_SESSION['created']);
                    }
                }

                // Tạo mã xác nhận mới nếu không tồn tại
                if (!isset($_SESSION['verification'])) {
                    $verification = generateRandomCode();
                    $_SESSION['verification'] = $verification;
                    $_SESSION['created'] = time();
                }

                $body = "Mã xác nhận của bạn là: " . $_SESSION['verification'] . ". Mã chỉ tồn tại trong 3 phút.";
                $kq = SendMail($_POST['email'], $titleEmail, $body);

                header('Location: ' . BASE_URL . '?act=change-email&check=2');
                exit;
            }
        }
    }

    // Nếu check == 2, hiển thị form nhập mã xác nhận
    if ($check == 2) {
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: block;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: none;"';

        if (!empty($_POST)) {
            // Kiểm tra nếu mã xác nhận hết hạn
            if (time() - $_SESSION['created'] > 180) {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                $_SESSION['errors'] = "Mã xác nhận đã hết hạn. Vui lòng thử lại.";
                header('Location: ' . BASE_URL . '?act=change-email&check=1');
                exit;
            }

            // Kiểm tra mã xác nhận
            if ($_POST['verification'] != $_SESSION['verification']) {
                $_SESSION['errors'] = "Bạn nhập mã không đúng";
                header('Location: ' . BASE_URL . '?act=change-email&check=2');
                exit;
            } else {
                unset($_SESSION['verification']);
                unset($_SESSION['created']);
                header('Location: ' . BASE_URL . '?act=change-email&check=3');
                exit;
            }
        }
    }
    if($check==3){
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: block;"';
        $style4 = 'style="display: none;"';
        if(!empty($_POST)){
            $newemail = checkSameEmailUserById('account',$_POST['newemail'],$_SESSION['user']['id']);
            if($_SESSION['user']['email'] == $_POST['newemail']){
                $_SESSION['errors'] = "Email mới không được trùng với email cũ";
            }elseif(!$newemail){
                $_SESSION['errors'] = "Email bạn nhập đã được đăng kí tài khoản khác";
            }
            if(!empty($_SESSION['errors'])){
                header('Location: ' . BASE_URL . '?act=change-email&check=3');
                exit;
            }else{
                $_SESSION['newemail'] = $_POST['newemail'];
                header('Location: ' . BASE_URL . '?act=change-email&check=4');
                exit;
            }
        }
    }
    if($check==4){
        $style1 = 'style="display: none;"';
        $style2 = 'style="display: none;"';
        $style3 = 'style="display: none;"';
        $style4 = 'style="display: block;"';
        if(!empty($_POST)){
            
            if($_SESSION['user']['password'] != $_POST['password']){
                $_SESSION['errors'] = "Mật khẩu sai";
                header('Location: ' . BASE_URL . '?act=change-email&check=4');
                exit;
            }else{
                $data = [
                    'email'=>$_SESSION['newemail']
                ];
                update('account',$_SESSION['user']['id'],$data);
                $_SESSION['user']['email'] = $_SESSION['newemail'];
                unset($_SESSION['newemail']);
                header('Location: ' . BASE_URL . '?act=success-change-email');
                exit;
            }
        }
    }

    require_once PATH_VIEW . 'layouts/master.php';
}
// 
function generateRandomCode()
{
    return rand(100000, 999999);
}
function changeEmailSuccess()
{
    require_once PATH_VIEW . 'authen/success-email.php';
}