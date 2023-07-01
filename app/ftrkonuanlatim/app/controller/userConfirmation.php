<?php
if(oturumControl() and !@$_SESSION["oturum"]["userConfirmation"]){
    require_once APP_USER."user_funcs.php";
    require_once APP_MYSQL."userMysqlClass.php";
    require_once APP_MYSQL."userInterimMysqlClass.php";
        $userObj=new userMysql("root");
        $interimObj=new userInterimMysql("root");
        $data=["userEmail"=>$_SESSION["oturum"]["userEmail"],"userId"=>$_SESSION["oturum"]["id"],"verificationCode"=>$_POST["code"]];
        $result=usersConfirmation1($userObj,$interimObj,$data);
        if($result["result"]){
            echo $result["error"];
            $_SESSION["oturum"]["userConfirmation"]=1;
            $_SESSION["oturum"][8]=1;
        }else{
            error_log_save("userError.txt",$result);
        }
    
    $connPdo =null;
}else{
    require_once __DIR__."/error.php";
}

?>