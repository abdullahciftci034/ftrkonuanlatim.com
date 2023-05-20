<?php
if(oturumControl() and $_SESSION["oturum"]["userActive"] and $_SESSION["oturum"]["userConfirmation"] and $_SESSION["oturum"]["userRank"]>=2){
    require_once APP_MYSQL."userMysqlClass.php";
    $userObj=new userMysql("root");
    $list=$userObj->getElementAllColumn(["id","userName","userNameVal","userEmail","userConfirmation","userDateOfRegistration"]);
    $userObj->connPdo=null;
    require_once APP_VIEW."moderator.php";
}else{
    require_once __DIR__."/error.php";
}
?>