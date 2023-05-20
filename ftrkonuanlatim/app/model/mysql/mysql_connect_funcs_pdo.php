<?php
require_once __DIR__."/../funcs/config_funcs.php";
#bu mysql pdo bağlantısını otomatik yapar ve döndürür.
require_once __DIR__."/../funcs/error_funcs.php";

function mysql_return_pdo($path,$person){
    if($config_data=json_config_read($path)){
        return mysql_connecting_pdo($config_data->{$person});
    }
    return false;    
}

function mysql_connecting_pdo($array){
    return mysql_connect_pdo($array->{"host"},$array->{"user"},$array->{"password"},$array->{"dbname"});
}
function mysql_connect_pdo($host,$user,$password,$dbname){
    try{
        $conn=new PDO("mysql:host=$host;dbname=$dbname;",$user,$password);  
        return $conn;       
    }catch(PDOException $e){
        error_registions("mysql_connect_problems.txt",$e->getMessage());
        return false;
    }
}
?>