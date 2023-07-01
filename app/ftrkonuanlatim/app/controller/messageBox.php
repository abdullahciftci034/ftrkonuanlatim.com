<?php
require_once APP_MYSQL."messageMysqlClass.php";
$messageObj=new messageMysql("root");
$unitId=$_POST["unitId"];
$data=$messageObj->getMessageUnitMessageLast(["unitId"=>$unitId,"messageId"=>'0']);
$yorum=false; 
$userObj=null; 
if(!empty($data) and $data != 1){
    require_once APP_MYSQL."userMysqlClass.php";
    $userObj=new userMysql("root");
    $yorum=true;
}
require_once APP_VIEW."messageBox.php";
$messageObj->connPdo=null;
@$userObj->connPdo=null;
?>