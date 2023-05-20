<?php
if(oturumControl()){
    require_once APP_MYSQL."messageMysqlClass.php";
    $messageObj=new messageMysql("root");
    if(!empty($_POST["message"]) and !empty($_POST["unitId"])){
        if(empty($_POST["messageId"])){
            if($messageObj->insert(["unitId"=>$_POST["unitId"],"userId"=>$_SESSION["oturum"]["id"],"message"=>$_POST["message"]])){
                echo "Yorum yapıldı.";
            }
        }else{
            if($messageObj->insert(["unitId"=>$_POST["unitId"],"userId"=>$_SESSION["oturum"]["id"],"message"=>$_POST["message"],"messageId"=>$_POST["messageId"]])){
                echo "Yorum yapıldı.";
            }
        }
    }else{
        echo "Mesaj kısmı boş.";
    }
    $messageObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
}
?>