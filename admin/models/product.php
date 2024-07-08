<?php
if(!function_exists('listAllForProduct')){
    function listAllForProduct(){
        try {
            //code...
           
            $sql = "SELECT * FROM product INNER JOIN category ON product.category_id = category.id WHERE product.status = 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
           

            $stmt->execute();

            return $stmt ->fetchAll();

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}