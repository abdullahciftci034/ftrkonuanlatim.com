<?php
if(!oturumControl()){
  require_once APP_USER."user_funcs.php";
  require_once APP_MYSQL."userLoginBlockedListMysqlClass.php";
  require_once APP_MYSQL."userMysqlClass.php";
  if(@$_SESSION["bootControlNumber"]===@$_POST["bootControlNumber"]){
      $userObj=new userMysql("root");
      $blockedObj=new userLoginBlockedListMysql("root");  
      $data=["password"=>$_POST["password"],"userName"=>$_POST["emailorname"],"userEmail"=>$_POST["emailorname"]];
      $result=login0($userObj,$blockedObj,$data);
      if($result["result"]){
          echo $result["error"];
          if(!$_SESSION["userConfirmation"]){
             refreshPage("userConfirmationForm");
          }else{
             refreshPage("userProfil");
          }
      }else{
        error_log_save("userError.txt",$result);
      }
  }else{
     error_log_save("userError.txt",["result"=>false,"error" => __FILE__." mysql bağlantısı hatası ","save"=>true]);
  }
  $userObj->connPdo=null;
  $blockedObj->connPdo=null;
}else{
  require_once __DIR__."error.php";
}
?>