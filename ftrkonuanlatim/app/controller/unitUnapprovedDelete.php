<?php
if(oturumControl() and $_SESSION["oturum"]["userRank"]>=2 and @$_SESSION["oturum"]["userActive"]){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_UNIT."unit_funcs.php";
    $unitObj=new unitMysql("root");
    if(emptyArr($_SESSION["unitConfirmation"])){
        $result=unitUnapprovedDelete1($unitObj,$_SESSION["unitConfirmation"]);
        if($result["result"]){
            echo $result["error"];
            unset($_SESSION["unitConfirmation"]);
            refreshPage("unitConfirmationListForm");
        }else{
            error_log_save("unitError.txt",$result);
        }
    }else{
        error_log_save("unitUnapprovedDeleteError.txt",["result"=>false,"error"=>__FILE__." mysql bağlantısı hatası","save"=>true]);
    }
    $unitObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
}
?>
