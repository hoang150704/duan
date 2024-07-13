<?php
if(!function_exists('getUserByUsernameAndPassword')){
    function getUserByUsernameAndPassword($tableName,$username,$password){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM $tableName WHERE username = :username  AND password = :password AND `role` =0 LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$password);

            $stmt->execute();

            return $stmt ->fetch();
            

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}

// email
if(!function_exists('getPasswordByEmail')){
    function getPasswordByEmail($email){
        try {
            //Nếu không trùng trả về true
           
            $sql = "SELECT * FROM `account` WHERE email = :email `role` =0 LIMIT 1" ;

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email",$email);
            $stmt->execute();

            return $stmt ->fetch();
            

        } catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }
}