<?php
    require_once APP_MYSQL."messageMysqlClass.php";
    $messageObj=new messageMysql("root");
    $data=$messageObj->getMessageUnitMessageLast(["unitId"=>$unitId,"messageId"=>'0']);
    $unitId=$unit["id"];
    $userObj=null;
    $yorum=false;  
    if(!empty($data) and $data != 1){
        require_once APP_MYSQL."userMysqlClass.php";
        $userObj=new userMysql("root");
        $yorum=true;
    }
    require_once APP_VIEW."messageForm.php";
    $messageObj->connPdo=null;
    @$userObj->connPdo=null;
?>