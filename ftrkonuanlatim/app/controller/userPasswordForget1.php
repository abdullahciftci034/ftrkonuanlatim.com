<?php
if(!empty($_SESSION["forget"]) and @$_SESSION["bootControlNumber"]==@$_POST["bootControlNumber"] ){
   if(!empty($_POST["code"])){
        if(@$_SESSION["forget"]["code"]==$_POST["code"]){
            $_SESSION["forget"]["confirmation"]=1;
            echo "Kod doğrulandı.Yönlendiriliyorsubuz";
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
                    yonlendir('".APP_ROOT1."userPasswordForgetNewForm', 1);
                </script>";
        }else{
            require_once APP_EMAIL."email_funcs.php";
            $_SESSION["forget"]["code"]=createVerificationCode();
            if(forgetEmailSend($_SESSION["forget"]["userEmail"],$_SESSION["forget"]["userName"],$_SESSION["forget"]["code"])){
                echo "Doğrulama kodu tekrar gönderildi. Eğer göremiyorsanız <strong>spam</strong> mesajlara bakın.";
            }
        }
   }else{
        echo "Code boş";
   }
}else{
    require_once __DIR__."/error.php";
}
?> 