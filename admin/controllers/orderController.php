<?php
// orderListAll
function orderListAll()
{
    $title = 'Danh sách tài khoản';
    $view = 'orders/list';
    $script = 'listUser';
    $style = 'table';
    $orders = listAllForOrder();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};

// orderShowOne
function orderShowOne($id)
{
    $order = showOneForOrder($id);
    if (empty($order)) {
        e404();
    }
    $account = getAccountOnOrder($order['account_id']);
    $details = getDetailOnOrder($order['id']);
    $i = 0;
    $allMoney = 0;
    foreach ($details as $detail) {
        $total_money[$i] = $detail['product_price'] * $detail['detail_quantity'];
        $allMoney = $allMoney + $total_money[$i];
        $i++;
    }

    $script = 'detail';
    $style = 'table';
    $title = 'Chi tiết tài khoản';
    $view = 'orders/detail';
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};



// orderUpdate
function orderUpdate($id)
{
    $order = showOne('order_shop', $id);
    if (empty($order)) {
        e404();
    }
    $details = getDetailOnOrder($order['id']);
    $status_orders = listAll('status_order');
    $title = 'Cập nhật thông tin đơn hàng ' . '#' . ucfirst($order['id']);
    $view = 'orders/update';
    $script = 'create';
    $style = 'create';
    if (!empty($_POST)) {
        $data = [
            "order_account_name" => $_POST['order_account_name'] ?? $order['order_account_name'],
            "order_phone" => $_POST['order_phone'] ?? $order['order_phone'],
            "order_address" => $_POST['order_address'] ?? $order['order_address'],
            "total_money" => $_POST['total_money'] ?? $order['total_money'],
            "shipping" => $_POST['shipping'] ?? $order['shipping'],
            "note" => $_POST['note'] ?? $order['note'],
            "status_id" => $_POST['status_id'] ?? $order['status_id'],

        ];
       
        $details_data = [
            "detail_quantity" => $_POST['detail_quantity'] ?? $order['detail_quantity'],
        ];


        $errors = validateUpdate($data, $id);

            update('order_shop', $id, $data);
            $i=0;
            foreach ($details as $de) {                
                    $detail_data = [
                        "detail_quantity" => $details_data['detail_quantity'][$i],
                    ];
                    update('detail_order',$de['id'], $detail_data);
                    $i++;
            }
            $_SESSION['success'] = "Bạn đã sửa tài khoản thành công";
        


        header('Location:' . BASE_URL_ADMIN . '?act=order-update&id=' . $id);
        exit();
    }


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};


// orderDelete
function orderDelete($id)
{

    delete_hidden('order_shop', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=order');
    exit();
};
