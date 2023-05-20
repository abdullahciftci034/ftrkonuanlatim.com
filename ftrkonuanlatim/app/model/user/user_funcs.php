<?php
require_once __DIR__."/../email/email_funcs.php";
//////////////////////////////////////////////////////////////////////////////////////////
##################################################
##################################################
########### kullanıcı kayıt bölümü ############### 
function userRegistration($userObj,$interimObj,$blockedObj,$data){
    #user bölümüne kayıt ettik
    if($userObj->insert($data)){
        #burda kayıt ettiğmiz userin idsini aldık
        $data1=["userName"=>$data["userName"]];  
        $userId=$userObj->getUserReturnId($data1);
        $userId=$userId[0]["id"];
        #email gonderme yapılacak # 6 basamaklı bir sayı ürettik
        $verificationCode=createVerificationCode();
        #burda şimdiki tarihe mysql de 1 gün ekledik
        $dateOfDeletion=oneDayAdd();
        if($blockedObj->insert(["userId"=>$userId])){    
            $data1=["userId"=>$userId,"userEmail"=>$data["userEmail"],"verificationCode"=>$verificationCode ,"dateOfDeletion"=>$dateOfDeletion];
            #burda ise users interim kayıt ettik
            if($interimObj->insert($data1)){
                if(verificationEmailSend($data["userEmail"],$data["userName"],$data["password"],$verificationCode,$dateOfDeletion)){
                        return ["result"=> true,"error"=>$data["userEmail"] ." epostasına doğrulama kodu gönderildi. $dateOfDeletion tarihine kadar epostanıza gelen kodla kayıdınız tamamlayabilirsiniz. Şimdi giriş yapabilirsiniz.<br> Eğer eposta gözükmüyorsa <strong>spam</strong> mesajlara bakınız.","save"=>false];
                }    
                $interimObj->deleteAnd(["userId"=>$userId]);
                $blockedObj->deleteAnd(["userId"=>$userId]);
                $userObj->deleteAnd(["id"=>$userId]);
                return ["result"=>false,"error"=> $data["userEmail"] ."adresine doğrulama kodu gönderilemedi.","save"=>false];
            }
            $blockedObj->deleteAnd(["userId"=>$userId]);
            $userObj->deleteAnd(["id"=>$userId]);
            return ["result"=>false,"error"=>__FILE__." userRegistration fonksiyonunda userInterim eklemede hata oluştu. userName : ".$data["userName"],"save"=>true];
        }
        $userObj->deleteAnd(["id"=>$userId]);
        return ["result"=>false,"error"=>__FILE__." userRegistration fonksiyonunda usersLoginBlockedList eklemede hata oluştu. userName : ".$data["userName"],"save"=>true];
    }else{
       return reVerificationCodeSend($userObj,$interimObj,$data);
    } 
    return ["result"=>false,"error"=>__FILE__."userRegistration fonksiyonu çalışırken. Sorgu sırasında hata oluştu.","save"=>true];
}

#burda eğer kullanıcı kodu yeniden gönderilmesini istiyorsa bu fonksiyon çalışacak
function reVerificationCodeSend($userObj,$interimObj,$data){
    $data1=["userName"=>$data["userName"] , "userEmail"=>$data["userEmail"] ,"userConfirmation"=>0 ];
    if($sorgu=$userObj->getElementAndAll($data1)){
        $userId=@$sorgu[0]["id"];
        if(empty($userId)){
            unset($data1["userConfirmation"]);
            if($sorgu=$userObj->getElementOrAll($data1)){
                $userId=$sorgu[0]["id"];
                if(!empty($userId)){ 
                    return ["result"=>false,"error"=> $data["userName"]." veya ".$data["userEmail"]."  bu kullanıcı adresi veya eposta adresi kullanılmış olabilir başka bir eposta veya kullanıcı adı deneyin.","save"=>false];
                }
                return ["result"=>false,"error"=>__FILE__."reVerificationCodeSend fonksiyonu çalışırken. Ekleme sırasında hata oluştu. Kullanıcılar yok ve eklemedi. userName: ". $data["userName"]." , email : ".$data["userEmail"],"save"=>true];
            }
        }
        $verificationCode=createVerificationCode();
        $data1=["verificationCode"=>$verificationCode];
        $data2=["userEmail"=>$data["userEmail"],"userId"=>$userId];
        if($interimObj->updateAnd($data1,$data2)){
            if(verificationEmailSend1($data["userEmail"],$data["userName"],$verificationCode)){
                return ["result"=>true,"error"=>$data["userEmail"] ."adresine doğrulama kodu tekrardan gönderildi.","save"=>false];
            }
            return ["result"=>false,"error"=>"Doğrulama kodu ".$data["userEmail"] ." adresine gönderilirken hata oluştu . Eğer sorununuz çözükmüyorsa yöneticiye başvurun.","save"=>false];
        }
        return ["result"=>false,"error"=>__FILE__." yeni doğrulama kodu veri tabanına kaydedilirken hata oluştu. userEmail ".$data["userEmail"],"save"=>true]; 
    }
    return ["result"=>false,"error"=>__FILE__." reVerificationCodeSend fonksiyonunda id arama sorgusunda hata çıktı. userEmail : ".$data["userEmail"] ." , userName : ".$data["userName"] ." ","save"=>true];
} 







///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
##################################################
##################################################
################# user giriş kısmı ###############
function login0($userObj,$blockedObj,$data){
    
    if($result=$userObj->getElementOr(["password"=>"password","id"=>"id","userLoginBlocked"=>"userLoginBlocked"],["userEmail"=>$data["userEmail"],"userName"=>$data["userName"]])){
      $kisi=@$result[0];
      if(is_array($kisi)){
         if(!$kisi["userLoginBlocked"]){ 
            if($result=$userObj->userPasswordControl(["password"=>$data["password"],"kayitliPassword"=>$kisi["password"]]) ){
               if($result[0][0]){
                    $blockedObj->updateAnd(["userLoginTry"=>0],["userId"=>$kisi["id"]]);
                    return login1($userObj,$data);     
               }
               return userLoginBlocked($userObj,$blockedObj,$kisi["id"]);     
            }
            return ["result"=>false,"error"=>__FILE__." login0 fonksiyonunda passwordControl fonksiyonunda bir hata oluştu. userId : ".$data["userName"] ,"save"=>true];
         }
        return ["result"=>false,"error"=> $data["userName"]." kullanıcısı 50 yanlış şifre denemlerinden dolayı bloklanmıştır. 1 gün sonra tekrar deneyin. Eğer bir sorun yaşıyorsanız, yöneticiye başvurunuz.Yönetici eposta : abdullahciftci034@gmail.com","save"=>false];    
      }
     return ["result"=>false,"error"=>"Böyle bir kullanıcı bulunamadı.","save"=>false];
   }
   return ["result"=>false,"error"=>__FILE__." login0 fonksiyonu users sorgusu yaparken hata oluştu","save"=>true ];
}

function login1($userObj,$data){
    if($result=$userObj->getElementOrAll(["userName"=>$data["userName"],"userEmail"=>$data["userEmail"]])){
        if(is_array($result)){
            $_SESSION["oturum"]=$result[0];
            return ["result"=>true,"error"=>"oturum açıldı.","save"=>false ]; 
        }
        return  ["result"=>false,"error"=>__FILE__." login1 is_array array sonucunda hata oluştu. kullanıcı : ".$data["userName"],"save"=>true];
    }
    return  ["result"=>false,"error"=>__FILE__." login1  array sonucunda hata oluştu. kullanıcı : ".$data["userName"],"save"=>true];
} 

 function userLoginBlocked($userObj,$blockedObj,$id){
   if($result=$blockedObj->getBlocked(["userId"=>$id])){
        $result=@$result[0]["userLoginTry"];
        if($result < 50 ){
            $result++;
            if($blockedObj->updateAnd(["userLoginTry"=>$result],["userId"=>$id])){
                return ["result"=>false,"error"=>"Şifre yanlış","save"=> false];
            }
            return ["result"=>false,"error"=>"userLoginbloked arttırılırken hata oluştu.","save"=> true];
            
        }else{
            if($userObj->updateAnd(["userloginBlocked"=>1],["id"=>$id])){
                return ["result"=>false,"error"=> "Kullanıcı yanlış denemelerden dolayı bloklanmıştır.","save"=>false];
            }
            return ["result"=>false,"error"=>__FILE__." kullanıcı bloklanamadı. userId : $id ","save"=>true] ;
        }
   }
   return ["result"=>false,"error"=>__FILE__." userLoginBlocked fonksiyonunda userblockedlist veri çekerken hata oluştu. userId : $id ","save"=>true];
 }

 




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
###########################################################################
###########################################################################
##################### kullanıcı onaylama bölümü ###########################
function usersConfirmation1($userObj,$interimObj,$data){
    ##data içeriği userEmail userId
    if($result=$interimObj->getVerificationNumber(["userEmail"=>$data["userEmail"],"userId"=>$data["userId"]])){
        if($result[0]["verificationCode"]==$data["verificationCode"]){
            if(($userObj->updateAnd(["userConfirmation"=>true],["id"=>$data["userId"],"userEmail"=>$data["userEmail"]]))){
                if($interimObj->deleteAnd($data)){
                    return ["result"=>true,"error"=>"Kullanıcı atif edildi. <script> window.location='".APP_ROOT1."';</script>","save"=>false];
                }
                return ["result"=>false,"error"=>__FILE__."  usersConfirmation fonksiyonu users kullanıcı onay sırasında hata oluştu. userId :  ".$data["userId"],"save"=>true];
            }
            return ["result"=>false,"error"=>__FILE__."    usersConfirmation users tablosunda güncellemesırasında  sırasında hata oluştu. userId : ".$data["userId"],"save"=>true];   
        }else{
            require_once __DIR__."/../email/email_funcs.php";
            $verificationCode=createVerificationCode();
            $statment="UPDATE ".APP_DATABASENAME.".usersInterim SET usersInterim.verificationCode= $verificationCode WHERE usersInterim.userId=".$data["userId"];
            if($interimObj->updateAnd(["verificationCode"=>$verificationCode],["userId"=>$data["userId"]])){
                $userName=($userObj->getElementAnd(["userName"],["userEmail"=>$data["userEmail"]]))[0][0];
                if(verificationEmailSend1($data["userEmail"],$userName,$verificationCode)){
                    return ["result"=>false,"error"=>"Doğrulama kodunu yanlış girdiniz. ".$data["userEmail"]." adresine tekrar doğrulama kodu gönderildi.","save"=>false];
                }
                return ["result"=>false,"error"=>"  Email Gönderilmedi","save"=>false];
            }
            return ["result"=>false,"error"=>__FILE__."  usersConfirmation fonksiyonunda yeni doğrulama kodu veritabanına yazılamadı. userId : ".$data["userId"],"save"=>true];
        }
       
    }
    return ["result"=>false,"error"=>__FILE__."   mysql interimdan doğrulama kodu verisi çekerken hata oluştu . userId : ".$data["userId"],"save"=>true];
}































################### burda işlemler hosting firmaları tarafından desteklenmediği için bunu fonksiyonların içine dahil etmiyoruz ################
/*
function mysqlusersInterimOto($connStandart,$userId,$dateOfDeletion){ 
    $otoStatment="
        CREATE EVENT ".APP_DATABASENAME.".usersIntDel$userId
        ON SCHEDULE EVERY 1 MINUTE STARTS ('$dateOfDeletion') 
        DO 
        BEGIN 
            DELETE FROM ".APP_DATABASENAME.".usersInterim WHERE usersInterim.userId='$userId';
            DELETE FROM ".APP_DATABASENAME.".users WHERE users.id = '$userId' ;
            DROP EVENT ".APP_DATABASENAME.".usersIntDel$userId; 
        END";
    $sorgu=mysqli_query($connStandart,$otoStatment);
    if($sorgu){
        return true;
    }
    return false;
}
$otoResult=mysqlusersInterimOto($connStandart,$userId,$dateOfDeletion);                   
if($otoResult){
    
}
$userBlockedDelete="DELETE FROM ".APP_DATABASENAME.".usersLoginBlockedList WHERE userId='$userId'";
$usersDelete="DELETE FROM ".APP_DATABASENAME.".usersInterim where usersInterim.userId='$userId';";
$usersInterimDelete="DELETE FROM ".APP_DATABASENAME.".users where users.id='$userId' ;";
mysqli_query($connStandart,$userBlockedDelete);
mysqli_query($connStandart,$usersDelete);
mysqli_query($connStandart,$usersInterimDelete);
return ["result"=> false,"error"=>__FILE__." userInterimOto fonksiyonu oluşturulurken hata oluştu. userName : $userName","save"=>true];

function oneDayAddMysql($connStandart){
    return ((mysqli_query($connStandart,"select (current_timestamp() + Interval 1 day)"))->fetch_object())->{"(current_timestamp() + Interval 1 day)"};
}

###############################################################
################## user block  yapma işlemi yaptık #############
function blockedTimestart($connPdo,$userId){
   $connPdo->query("UPDATE ".APP_DATABASENAME.".users SET userLoginBlocked = 1  WHERE id = '$userId' ");
   $connPdo->query("UPDATE ".APP_DATABASENAME."usersLoginBlockedList set usersLoginBlockedList.userLoginTry=0 WHERE usersLoginBlockedList.userId='$userId'");
   $userBlokedEventStatment="CREATE EVENT ".APP_DATABASENAME.".userBlocked$userId
   ON SCHEDULE EVERY 2 minute STARTS (current_timestamp() + interval 3 MINUTE)
   DO
   BEGIN  
      UPDATE ".APP_DATABASENAME.".users SET userLoginBlocked = 0  WHERE id = '$userId';
       drop event ".APP_DATABASENAME.".userBlocked$userId;
   END";
   $connPdo->query($userBlokedEventStatment);
   return ["result"=>false,"error"=> "3 dk bloklandınız.","save"=>false];
 }

*/
?>