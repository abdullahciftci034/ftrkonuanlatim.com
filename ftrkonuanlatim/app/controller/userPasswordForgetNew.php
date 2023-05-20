<?php
if(!empty(@$_SESSION["forget"])  and @$_SESSION["forget"]["confirmation"] and !empty(@$_POST["password"]) and @$_POST["password"]==@$_POST["cpassword"]){
    require_once APP_MYSQL."userMysqlClass.php";
    $userObj=new userMysql("root");
    if($userObj->userUpdateAnd(["password"=>$_POST["password"]],["id"=>$_SESSION["forget"]["userId"],"userEmail"=>$_SESSION["forget"]["userEmail"]])){
        echo "Şifreniz güncellenmiştir. Yönlendiriliyorsunuz.";
        unset($_SESSION["forget"]);
        echo " <script>
        function yonlendir(adres, saniye) {
          if (saniye == 0) {
            window.location.href = adres;
            return;
          }
          saniye--;
          setTimeout(function() {
            yonlendir(adres, saniye);
          }, 1000);
        }
        yonlendir('".APP_ROOT1."userLoginForm', 1);";
    }else{
        echo "Bizden kaynaklı bir hata oluştu. Yöneticiye başvurun eposta :abdullahciftci034@gmail.com ";
    }
}else{
    require_once __DIR__."/error.php";
}

?>