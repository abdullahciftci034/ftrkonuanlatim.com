<?php
require_once APP_MYSQL."unitMysqlClass.php";
$unitObj=new unitMysql("root");
$result=[];
$result=$unitObj->getUnitApprovedLast3();
if(@!empty($result[0])){
    foreach($result as $val){
        echo "<a href='".APP_ROOT1."unit/".$val["unitKey"]."'>".$val["unitTitle"]."<a><br><br>";
    }
}else{
    echo "Güncel paylaşım hiç olmadı.";
}
?>