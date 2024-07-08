<?php
// productListAll
function productListAll()
{
    $title = 'Danh sách sản phẩm';
    $view = 'products/list';
    $script = 'listUser';
    $style = 'table';
    $products = listAllForProduct();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// productShowOne
function productShowOne($id)
{
    $product = showOne('account', $id);
    if (empty($product)) {
        e404();
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết sản phẩm';
    $view = 'products/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// productCreate
function productCreate()
{
    $script = 'create';
    $script2 ='tinyMCE';
    $style = 'create';
    $title = 'Thêm sản phẩm';
    $view = 'products/create';
    $categories = listAll('category');


    if (!empty($_POST)) {
        $data = [
            'product_name'=>$_POST['product_name'],
            'des'=>$_POST['des'],
            'category_id'=>$_POST['category_id'],
            




        ];
        debug($data);
        $date = date('Y-m-d');
        $data['create_date'] = $date;
        // $errors = validateCreate($data);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            header('Location:' . BASE_URL_ADMIN . '?act=product-create');
            exit();
        }
        $avatar = $data['avatar'];
        if (!empty($avatar) && $avatar['size'] > 0) {
            $data['avatar'] = uploadFlie($avatar, 'uploads/products/');
        }else{
            $data['avatar'] = 'uploads/avatar5.png';
        }
        insert('account', $data);
        $_SESSION['success'] = "Bạn đã thêm sản phẩm thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=product');
        exit();
    }
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validateCreate
function validateProductCreate($data, $repassword)
{

    $errors = [];
    // productname
    if (empty($data['productname'])) {
        $errors[] = 'Bạn cần nhập tên đăng nhập';
    } else if (regaxVietnamese($data['productname'])) {
        $errors[] = 'Tên đăng nhập không được có dấu';
    } 

    // fullname dài tối đa 50 kí tự và bắt buộc nhập
    if (empty($data['fullname'])) {
        $errors[] = 'Bạn cần nhập họ và tên';
    } else if (strlen($data['fullname']) > 50) {
        $errors[] = 'Họ và tên chỉ được phép nhập tối đa 50 kí tự';
    }


    // Email
    if (empty($data['email'])) {
        $errors[] = 'Bạn cần nhập email';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không đúng định dạng';
    } else if (!checkSameEmail('account', $data['email'])) {
        $errors[] = 'Email đã được sử dụng';
    }
    // Password
    if (empty($data['password'])) {
        $errors[] = 'Bạn cần nhập mật khẩu';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
    } else if (regaxVietnamese($data['password'])) {
        $errors[] = 'Mật khẩu không được có dấu';
    } elseif ($data['password'] != $repassword) {
        $errors[] = 'Nhập lại mật khẩu phải giống nhau mật khẩu';
    }
    // type
   

    if ($data['role'] === null) {
        $errors[] = 'Bạn bắt buộc phải nhập quyền';
    } else if ($data['role'] !=0 && $data['role'] !=1) {
        $errors[] = 'Role chỉ có 2 value 1(Admin) | 0(product)';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }
    // avatar
    if ($data['avatar']['size']>0 && !empty($data['avatar'])){
        $typeImage =['image/png','image/jpg','image/jpeg'];
        if($data['avatar']['size'] > 2*1024*1024){
            $errors[] ='Không thể tải file quá 2Mb';
        }else if(!in_array($data['avatar']['type'],$typeImage)){
            $errors[] ='Chỉ upload file .png .jpg .jpeg';
        }
    }


    return $errors;
};
// productUpdate
function productUpdate($id)
{
    $product = showOne('account', $id);
    if (empty($product)) {
        e404();
    }

    $title = 'Cập nhật thông tin ' . ucfirst($product['productname']) ;
    $view = 'products/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "productname" => $_POST['productname'] ?? $product['productname'],
            "password" => $_POST['password'] ?? $product['password'],
            "email" => $_POST['email'] ?? $product['email'],
            "phone" => $_POST['phone'] ?? $product['phone'],
            "fullname" => $_POST['fullname'] ?? $product['fullname'],
            "address" => $_POST['address'] ?? $product['adrress'],
            "role" => $_POST['role'] ?? $product['role'],
            'status' => 1,
            'avatar' => $_FILES['avatar'] ?? $product['avatar'],

        ];

        $date = date('Y-m-d');
        $data['create_date'] = $date;
        $avatar = $data['avatar'];
        $errors = validateUpdate($data, $id);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            
            
        }else{
            
        if (!empty($avatar) && $avatar['size'] > 0) {
            $data['avatar'] = uploadFlie($avatar, 'uploads/products/');
        }else{
            $data['avatar'] = $product['avatar'];
        }
            update('account', $id, $data);
            $_SESSION['success'] = "Bạn đã sửa sản phẩm thành công";
        }


        header('Location:' . BASE_URL_ADMIN . '?act=product-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// validate update
function validateProductUpdate($data, $id)
{

    $errors = [];
    // productname
    if (empty($data['productname'])) {
        $errors[] = 'Bạn cần nhập tên đăng nhập';
    } else if (regaxVietnamese($data['productname'])) {
        $errors[] = 'Tên đăng nhập không được có dấu';
    } 

    // fullname dài tối đa 50 kí tự và bắt buộc nhập
    if (empty($data['fullname'])) {
        $errors[] = 'Bạn cần nhập họ và tên';
    } else if (strlen($data['fullname']) > 50) {
        $errors[] = 'Họ và tên chỉ được phép nhập tối đa 50 kí tự';
    }


    // Email
    if (empty($data['email'])) {
        $errors[] = 'Bạn cần nhập email';
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không đúng định dạng';
    } else if (!checkSameEmailById('account', $data['email'],$id)) {
        $errors[] = 'Email đã được sử dụng';
    }
    // Password
    if (empty($data['password'])) {
        $errors[] = 'Bạn cần nhập mật khẩu';
    } else if (strlen($data['password']) < 8 || strlen($data['password']) > 20) {
        $errors[] = 'Mật khẩu ít nhất phải dài 8 kí tự và không được quá 20 kí tự';
    } else if (regaxVietnamese($data['password'])) {
        $errors[] = 'Mật khẩu không được có dấu';
    }
    // type
   

    if ($data['role'] === null) {
        $errors[] = 'Bạn bắt buộc phải nhập quyền';
    } else if ($data['role'] !=0 && $data['role'] !=1) {
        $errors[] = 'Role chỉ có 2 value 1(Admin) | 0(product)';
    }
    // phone
    if (!empty($data['phone'])) {
        if (!regaxPhone($data['phone'])) {
            $errors[] = 'Số điện thoại chưa đúng định dạng';
        }
    }
    // 
    if ($data['avatar']['size']>0){
        $typeImage =['image/png','image/jpg','image/jpeg'];
        if($data['avatar']['size'] > 2*1024*1024){
            $errors[] ='Không thể tải file quá 2Mb';
        }else if(!in_array($data['avatar']['type'],$typeImage)){
            $errors[] ='Chỉ upload file .png .jpg .jpeg';
        }
    }

    return $errors;
};

// productDelete
function productDelete($id)
{

    delete_hidden('account', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=product');
    exit();
};
