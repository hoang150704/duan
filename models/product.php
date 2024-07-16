<?php
// Lấy 8 sản phẩm theo mã danh mục
if(!function_exists('listProductByCategoryLimit8')){
    function listProductByCategoryLimit8($id){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT product.id, product.product_name, product.category_id,product.main_image,product.status, product_lookup.price,product_lookup.sale_price FROM `product` INNER JOIN product_variant on product.id = product_variant.product_id INNER JOIN product_lookup ON product_variant.product_variant_id = product_lookup.id WHERE  category_id = :category_id AND product.status = 1 LIMIT 8" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_id",$id);
            $stmt->execute();

            return $stmt ->fetchAll();
            

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}
// 