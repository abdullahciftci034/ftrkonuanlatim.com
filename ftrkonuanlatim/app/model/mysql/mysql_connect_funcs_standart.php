<?php
#burda ise standart bir sorgu için kolay bağlantı yolları
require_once __DIR__."/../funcs/config_funcs.php";

function mysql_return_standart($path){
    if($config_data=json_config_read($path)){
        return mysql_connecting_standart($config_data);
    }
    return false;
}
function mysql_connecting_standart($array){
    return mysql_connect_standart($array->{"host"},$array->{"user"},$array->{"password"},$array->{"dbname"});
}
function mysql_connect_standart($host,$user,$password,$dbname){
	$baglan=mysqli_connect($host,$user,$password,$dbname);
    mysqli_query($baglan,"SET CHARACTER SET utf8");
    return $baglan;
}
?>