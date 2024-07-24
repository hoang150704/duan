<?php
function checkoutOrder(){
    $view = 'order/checkout';
    $style = 'style/checkout';
    $script = 'checkout';
    if (!empty($_POST)) {
        $order = [
            'status_id'=>1,
            'account_id'=>$_SESSION['user']['id'],
            'date_order'=>date('Y-m-d'),
            'total_money'=>$_SESSION['order']['total_price'],
            'order_address'=>$_POST['order_address'],
            'order_phone'=>$_POST['order_phone'],
            'order_account_name'=>$_POST['order_account_name'],
            'note'=>$_POST['note'],
            'shipping'=>0,
            'date_success_order'=>null,
            'status'=>1,

        ];
        $order_id = insert_get_last_id('order_shop',$order);
        foreach($_SESSION['order']['cart'] as $item ){
            
            $detail = [
                'order_id'=>$order_id,
                'product_lookup_id'=>$item['product_lookup_id'],
                'product_name'=>$item['product_name'],
                'product_price'=>$item['price'],
                'detail_quantity'=>$item['quantity'],

            ];
            
            insert('detail_order',$detail);
            $lookup = getProductLookup($item['product_lookup_id']);
            $quantityLookup = $lookup['quantity'] - $item['quantity'];
            $quantity = [
                'quantity'=>$quantityLookup,
            ];
            update('product_lookup',$item['product_lookup_id'],$quantity);
            
        }
        unset($_SESSION['cart']);
        unset($_SESSION['order']);
        header('Location:' . BASE_URL . '?act=success' );
        exit;
        
        
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
function successOrder(){
    require_once PATH_VIEW . 'order/success.php';
}
// Update
