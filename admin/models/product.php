<?php
if(!function_exists('listAllForProduct')){
    function listAllForProduct(){
        try {
            //code...
           
            $sql = "SELECT 
                    product.id AS product_id, 
                    product.product_name, 
                    product.category_id, 
                    product.des, 
                    product.main_image, 
                    product.status AS product_status, 
                    category.category_name 
                    FROM 
                    product 
                    INNER JOIN 
                    category ON product.category_id = category.id 
                    WHERE 
                    product.status = 1;";

            $stmt = $GLOBALS['conn']->prepare($sql);
           

            $stmt->execute();

            return $stmt ->fetchAll();

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}