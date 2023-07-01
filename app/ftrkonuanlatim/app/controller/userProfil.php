<?php
if(oturumControl()  and  @$_SESSION["oturum"]["userConfirmation"]){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_MYSQL."unitTempSaveMysqlClass.php";
    $unitObj=new unitMysql("root");
    $tempSaveObj=new unitTempSave("root");
    $unitTemp=$tempSaveObj->getElementAnd(["unitTitle","lessonKey"],["authorUserId"=>$_SESSION["oturum"]["id"]]);
    if(!empty($unitTemp)){
        $unitTemp=$unitTemp[0];
    }
    $list=$unitObj->getElementAnd(["id","lessonKey","unitTitle", "UnitDateOfRegistration" ,"unitConfirmation"],["authorUserId"=>$_SESSION["oturum"]["id"]]);
    require_once APP_VIEW."userProfil.php";
    $unitObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
} 
?>