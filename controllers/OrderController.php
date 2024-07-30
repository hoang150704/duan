<?php
function checkoutOrder()
{
    $view = 'order/checkout';
    $style = 'style/checkout';
    $script = 'checkout';
    if (!empty($_POST)) {
        // Lấy dữ liệu
        $history = [];
        $order = [
            'order_code'=>time(),
            'account_id' => $_SESSION['user']['id'],
            'date_order' => date('Y-m-d'),
            'total_money' => $_SESSION['order']['total_price'],
            'order_address' => $_POST['order_address'],
            'order_phone' => $_POST['order_phone'],
            'order_account_name' => $_POST['order_account_name'],
            'note' => $_POST['note'],
            'shipping' => 0,
            'date_success_order' => null,
            'status' => 1,
            'payment' => $_POST['payment'],
        ];
        if ($order['payment'] == 0) {
            // Xử lí code thanh toán offline
            $order['status_id'] = 1;
            $history['status_id'] = 1;
            // insert dữ liệu lấy id đơn hàng
            $order_id = insert_get_last_id('order_shop', $order);
            // Truyền id đơn hàng vào lịch sử đơn hàng
            $history['order_id'] = $order_id;
            // Insert dữ liệu
            insert('order_status_history', $history);
            foreach ($_SESSION['order']['cart'] as $item) {

                $detail = [
                    'order_id' => $order_id,
                    'product_lookup_id' => $item['product_lookup_id'],
                    'product_name' => $item['product_name'],
                    'product_price' => $item['price'],
                    'detail_quantity' => $item['quantity'],
                    'image' => $item['main_image']

                ];

                insert('detail_order', $detail);
                $lookup = getProductLookup($item['product_lookup_id']);
                $quantityLookup = $lookup['quantity'] - $item['quantity'];
                $quantity = [
                    'quantity' => $quantityLookup,
                ];
                update('product_lookup', $item['product_lookup_id'], $quantity);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['order']);
            header('Location:' . BASE_URL . '?act=success&check=0');
            exit;
        } else {
            // Xử lí code thanh toán online

            $order['status_id'] = 10;
            $history['status_id'] = 10;
            // insert dữ liệu lấy id đơn hàng
            $order_id = insert_get_last_id('order_shop', $order);
            // Truyền id đơn hàng vào lịch sử đơn hàng
            $history['order_id'] = $order_id;
            // Insert dữ liệu
            insert('order_status_history', $history);
            foreach ($_SESSION['order']['cart'] as $item) {

                $detail = [
                    'order_id' => $order_id,
                    'product_lookup_id' => $item['product_lookup_id'],
                    'product_name' => $item['product_name'],
                    'product_price' => $item['price'],
                    'detail_quantity' => $item['quantity'],
                    'image' => $item['main_image']

                ];

                insert('detail_order', $detail);
                $lookup = getProductLookup($item['product_lookup_id']);
                $quantityLookup = $lookup['quantity'] - $item['quantity'];
                $quantity = [
                    'quantity' => $quantityLookup,
                ];
                update('product_lookup', $item['product_lookup_id'], $quantity);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['order']);
            paymentOnline($order_id,$order['order_code'],$order['total_money'],1);
            header('Location:' . BASE_URL . '?act=success&check=1');
            exit;
        }
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
// Thanh toán online
// Thanh toán thành công
function successOrder($id,$check)
{
    if($check==1){
        $order2 = [
            'status_id' =>11,
        ];
        update('order_shop',$id,$order2);
    }
    require_once PATH_VIEW . 'order/success.php';
}
// Chi tiết đơn hàng
function detailOrder($id)
{
    // View
    $view = 'authen/detailOrder';
    $style = 'style/info';
    $script = 'info';
    // Lấy dữ liệu
    $statusOrders = getAllStatusOrder();
    $orders = listAll('order_shop');
    $order_detail = listAllDetailOrder();
    $histories = listAllHistoryOrder();
    // Xử lí dữ liệu thành mảng dữ liệu mong muốn
    $combinedData = [];
    $statusMap = [];
    foreach ($statusOrders as $statusOrder) {
        $statusMap[$statusOrder['id']] = $statusOrder;
    }

    // Tìm đơn hàng có order_id = $id
    foreach ($orders as $order) {
        if ($order['id'] == $id) {
            $statusId = $order['status_id'];

            // Tạo một mảng chứa thông tin đơn hàng hiện tại
            $orderData = [
                'order' => $order,
                'status_name' => $statusMap[$statusId]['status_order_name'],
                'details' => [],
                'history' => []
            ];

            // Tìm các chi tiết sản phẩm thuộc đơn hàng hiện tại
            foreach ($order_detail as $detail) {
                if ($detail['order_id'] == $order['id']) {
                    $orderData['details'][] = $detail;
                }
            }

            // Tìm lịch sử trạng thái thuộc đơn hàng hiện tại và thêm tên trạng thái vào từng lịch sử
            foreach ($histories as $history) {
                if ($history['order_id'] == $order['id']) {
                    $history['status_order_name'] = $statusMap[$history['status_id']]['status_order_name'];
                    $orderData['history'][] = $history;
                }
            }

            // Thêm dữ liệu đơn hàng vào mảng tổng hợp theo trạng thái
            if (!isset($combinedData[$statusId])) {
                $combinedData[$statusId] = [
                    'status' => $statusMap[$statusId],
                    'orders' => []
                ];
            }
            $combinedData[$statusId]['orders'][] = $orderData;
        }
    }
    // Loại bỏ các trạng thái không có đơn hàng
    $combinedData = array_filter($combinedData, function ($data) {
        return !empty($data['orders']);
    });

    // Kết thúc phần lấy dữ liệu
    // XỬ lí người dùng submit
    foreach ($combinedData as $value) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem nút nào đã được nhấn
            if (isset($_POST['cancel'])) {
                // Xử lý logic cho nút "Hủy đơn hàng" hoặc "Hoàn hàng"
                if (in_array($value['status']['id'], [1, 2, 10, 11])) {
                    // Logic khi hủy đơn hàng
                    $data = [
                        'status_id' => 6,

                    ];
                    update('order_shop', $id, $data);
                    $data_history = [
                        'note' => $_POST['reason'],
                        'status_id' => 6,
                        'order_id' => $id
                    ];
                    insert('order_status_history', $data_history);
                } else {
                    // Hoàn hàng
                    $data = [
                        'status_id' => 7,

                    ];
                    update('order_shop', $id, $data);
                    $data_history = [
                        'note' => $_POST['reason'],
                        'status_id' => 7,
                        'order_id' => $id
                    ];
                    insert('order_status_history', $data_history);
                }
            } elseif (isset($_POST['success'])) {
                // Thành công
                $data = [
                    'status_id' => 5,
                    'date_success_order'=>date('Y-m-d')
                ];
                update('order_shop', $id, $data);
                $data_history = [
                    'status_id' => 5,
                    'order_id' => $id
                ];
                insert('order_status_history', $data_history);;
            }
            header('Location:' . BASE_URL . '?act=detail-order&id=' . $id);
            exit;
        }
    }


    require_once PATH_VIEW . 'layouts/master.php';
}
// Thanh toán online
function paymentOnline($id,$order_code,$total_money,$payment){
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = BASE_URL."?act=success&check=1&id=".$id;
    $vnp_TmnCode = "H4F1AT04";//Mã website tại VNPAY 
    $vnp_HashSecret = "CRAR2JMXDGXXG4JT67YHRYV4CP66Y1KA"; //Chuỗi bí mật
    
    $vnp_TxnRef = $order_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
    $vnp_OrderInfo = 'Thanh toan don hang';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $total_money * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    // $vnp_ExpireDate = $_POST['txtexpire'];
    //Billing
    // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
    // $vnp_Bill_Email = $_POST['txt_billing_email'];
    // $fullName = trim($_POST['txt_billing_fullname']);
    // if (isset($fullName) && trim($fullName) != '') {
    //     $name = explode(' ', $fullName);
    //     $vnp_Bill_FirstName = array_shift($name);
    //     $vnp_Bill_LastName = array_pop($name);
    // }
    // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
    // $vnp_Bill_City=$_POST['txt_bill_city'];
    // $vnp_Bill_Country=$_POST['txt_bill_country'];
    // $vnp_Bill_State=$_POST['txt_bill_state'];
    // // Invoice
    // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
    // $vnp_Inv_Email=$_POST['txt_inv_email'];
    // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
    // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
    // $vnp_Inv_Company=$_POST['txt_inv_company'];
    // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
    // $vnp_Inv_Type=$_POST['cbo_inv_type'];
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        // "vnp_ExpireDate"=>$vnp_ExpireDate,
        // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
        // "vnp_Bill_Email"=>$vnp_Bill_Email,
        // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
        // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
        // "vnp_Bill_Address"=>$vnp_Bill_Address,
        // "vnp_Bill_City"=>$vnp_Bill_City,
        // "vnp_Bill_Country"=>$vnp_Bill_Country,
        // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
        // "vnp_Inv_Email"=>$vnp_Inv_Email,
        // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
        // "vnp_Inv_Address"=>$vnp_Inv_Address,
        // "vnp_Inv_Company"=>$vnp_Inv_Company,
        // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
        // "vnp_Inv_Type"=>$vnp_Inv_Type
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    // }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if ($payment ==1) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    
}
