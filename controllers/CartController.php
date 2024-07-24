<?php

function cartView()
{
    $view = 'cart/cart';
    $style = 'style/home';
    $script = 'cart';
    if (!empty($_POST)) {
        updateCart();
    }
    // Tính toán tổng tiền
    $totalPrice = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        // Lưu thông tin đơn hàng vào $_SESSION['order']
        $_SESSION['order'] = [
            'cart' => $_SESSION['cart'],
            'total_price' => $totalPrice
        ];
    }


    require_once PATH_VIEW . 'layouts/master.php';
}

function updateCart()
{
    // Xử lý cập nhật số lượng sản phẩm
    if (!empty($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $index => $quantity) {
            $_SESSION['cart'][$index]['quantity'] = (int)$quantity;
        }
    }

    if (isset($_POST['remove'])) {
        foreach ($_POST['remove'] as $index => $value) {
            if ($value === '1') {
                // Remove the product from the cart based on the index
                unset($_SESSION['cart'][$index]);
            }
        }

        // Reindex the cart array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Tính toán tổng tiền
    $totalPrice = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    }

    // Lưu thông tin đơn hàng vào $_SESSION['order']
    $_SESSION['order'] = [
        'cart' => $_SESSION['cart'],
        'total_price' => $totalPrice
    ];
    header('Location: ' . BASE_URL . '?act=cart');
    exit;
}
