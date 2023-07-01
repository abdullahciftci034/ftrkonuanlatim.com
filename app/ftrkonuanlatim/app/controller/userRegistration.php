<?php
if(!oturumControl() ){
    require_once APP_USER."user_funcs.php";
    require_once APP_MYSQL."userMysqlClass.php";
    require_once APP_MYSQL."userInterimMysqlClass.php";
    require_once APP_MYSQL."userLoginBlockedListMysqlClass.php";
    if(@$_SESSION["bootControlNumber"]=== @$_POST["bootControlNumber"]){
        unset($_POST["bootControlNumber"]);
        unset($_POST["passwordControl"]);   
        $userObj=new userMysql("root");
        $interimObj=new userInterimMysql("root");
        $blockedObj=new userLoginBlockedListMysql("root");
        $result=userRegistration($userObj,$interimObj,$blockedObj,$_POST);   
        if($result["result"]){
            echo $result["error"];
        }else{
            error_log_save("userError.txt",$result);
        }
    }else{
        error_log_save("userError.txt",["result"=>false,"error" => __FILE__." mysql bağlantısı hatası ","save"=>true]);
    }
    $userObj->connPdo=null;
    $interimObj->connPdo=null;
    $blockedObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
}
?>