<?php
if(oturumControl() and $_SESSION["oturum"]["userRank"]>=2 and @$_SESSION["oturum"]["userActive"]){
    require_once APP_MYSQL."unitMysqlClass.php";
    $unitObj=new unitMysql("root");
    $list=$unitObj->getElementAllColumn(["id","lessonKey","unitTitle", "UnitDateOfRegistration" ,"unitConfirmation"]);
    require_once APP_VIEW."unitConfirmationListForm.php";
    $unitObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
}
?>