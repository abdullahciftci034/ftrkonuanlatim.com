<?php
if(oturumControl() and $_SESSION["oturum"]["userConfirmation"]){
    require_once APP_MYSQL."unitTempSaveMysqlClass.php";
    require_once APP_UNIT."unit_funcs.php";
    $tempSaveObj=new unitTempSave("root");  
    $result=unitTempSave($tempSaveObj,["unitContent"=>$_POST["unitContent"],"unitTitle"=>$_POST["unitTitle"],"lessonKey"=>$_POST["lessonKey"],"authorUserId"=>$_SESSION["oturum"]["id"]]);
    if($result["result"]){
        unset($_SESSION["unit"]);
        echo $result["error"];
    }else{
        error_log_save("unitError.txt",$result);
        $_SESSION["unit"]=sessionUnitRegistration($_POST);
    }
    $tempSaveObj->connPdo=null;
}
?>