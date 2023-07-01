<?php
if(oturumControl() and $_SESSION["oturum"]["userConfirmation"]){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_UNIT."unit_funcs.php";
    $unitObj=new unitMysql("root");
    $_POST["authorUserId"]=$_SESSION["oturum"]["id"];
    $result=update_unpproved($unitObj,$_POST);   
    if($result["result"]){
        echo $result["error"];
        //refreshPage();//sayfa yeniledik
    }else{
        error_log_save("unitError.txt",$result);
    }
    $unitObj->connPdo;
}else{
    require_once __DIR__."/error.php";
}
?>