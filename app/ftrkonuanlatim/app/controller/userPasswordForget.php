<?php
if(@$_SESSION["bootControlNumber"]==@$_POST["bootControlNumber"] ){
    require_once APP_MYSQL."userMysqlClass.php";
    require_once APP_EMAIL."email_funcs.php";
    $userUnit=new userMysql("root");
    $arr=$userUnit->getElementOr(["userEmail","id","userName"],["userName"=>$_POST["emailorname"],"userEmail"=>$_POST["emailorname"]]);
    if(!empty($arr) and @$arr!="1"){
        $arr=$arr[0];
        $_SESSION["forget"]["code"]=createVerificationCode();
        $_SESSION["forget"]["userId"]=$arr["id"];
        $_SESSION["forget"]["userEmail"]=$arr["userEmail"];
        $_SESSION["forget"]["userName"]=$arr["userName"];
        if(forgetEmailSend($arr["userEmail"],$arr["userName"],$_SESSION["forget"]["code"])){
            echo "Eposta adresinize doğrulama kodu gönderildi. Yönlendiriliyorsunuz.";
            echo "
                <script>
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
                    yonlendir('".APP_ROOT1."userPasswordForgetForm1', 1);
                </script>";
        }else{
            echo "Mail gönderilemedi.";
        } 
    }else{
        echo "Böyle bir kullanıcı yok.";
    }
}else{
    die;
}
?>