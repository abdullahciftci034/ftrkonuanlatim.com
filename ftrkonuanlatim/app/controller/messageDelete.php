<?php
if(oturumControl()){
    require_once APP_MYSQL."messageMysqlClass.php";
    $messageObj=new messageMysql("root");
    if($_SESSION["oturum"]["userRank"]>=2 and @$_SESSION["oturum"]["userActive"]){
        if($messageObj->deleteAnd(["id"=>$_POST["messageId"]])){
            echo "Mesaj silindi.";
        }else{
            echo "Mesaj silinemedi.";
        }
    }else{
        if($messageObj->deleteAnd(["id"=>$_POST["messageId"],"userId"=>$_SESSION["oturum"]["id"]])){
            echo "Mesaj silindi.";
        }else{
            echo "Mesaj silinemedi.";
        }
    }
}else{
    require_once __DIR__."/error.php";
}
?>