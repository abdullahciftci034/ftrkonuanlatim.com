<?php
require_once "ftrkonuanlatim/app/Globals.init.php";
require_once APP_MYSQL."mysqlStartClass.php";

$mysql =new mysqlStart("root1","ftrkonuanlatim");

if($mysql->createDB()){
   echo $mysql->databaseObj->database." database olusturuldu.<br/>";
}else{
    echo $mysql->databaseObj->database." database olusturulamadi.<br/>";
}
$mysql->createStruct();
$mysql->insertMysql();
$mysql->databaseObj->connPdo=null;
//username= abdullahciftci034, password = abdullah_123

?>