<?php
require_once __DIR__."/../lib/class.phpmailer.php";
require_once __DIR__."/../funcs/error_funcs.php";
require_once __DIR__."/../funcs/config_funcs.php";

function verificationEmailSend($userEmail,$userName,$password,$verificationCode,$dateOfDeletion){
    $message="
        <div>
            <table>
                <tr>
                    <td>Email :</td>
                    <td>$userEmail </td>
                </tr>
                <tr>
                    <td>Kullanıcı adı :</td>
                    <td>$userName</td>
                </tr>
                <tr>
                    <td>Şifre :</td>
                    <td>$password</td>
                </tr>
                <tr>
                    <td>Kaydın son tamamlama tarihi :  </td>
                    <td>$dateOfDeletion</td>
                </tr>
            <table>
            <br>
            <h2>
                Doğrulama Kodu 
            </h2>
            <br>
            <h1>
                $verificationCode
            </h1>
            <br>
            <div>
                Not: Şifrenizi kaydedin. Şifreler geri dönüşümsüzdür.
            </div>

        </div>
    ";
    $messageHeader="Eposta Dogrulama Kodu";
    if($data=email_config_return("verification")){
        $mailArr=["senderEmail"=>$data->{"email"},"senderPassword"=>$data->{"password"},"message"=>$message,"messageH"=>$messageHeader,"senderName"=>$data->{"email"},"clientEmail"=>$userEmail];
        if(mailsend($mailArr)){
            return true;
        }
        return false;
    }
    return false;
    
}
function verificationEmailSend1($userEmail,$userName,$verificationCode){
    $message="
        <div>
            <table>
                <tr>
                    <td>Email :</td>
                    <td>$userEmail </td>
                </tr>
                <tr>
                    <td>Kullanıcı adı :</td>
                    <td>$userName</td>
                </tr>
            <table>
            <br>
            <h2>
                Doğrulama Kodu 
            </h2>
            <br>
            <h1>
                $verificationCode
            </h1>
            <br>
            <div>
                Not: Şifrenizi kaydedin. Şifreler geri dönüşümsüzdür.
            </div>
        </div>
    ";
    $messageHeader="Eposta Dogrulama Kodu";
    if($data=email_config_return("verification")){
        $mailArr=["senderEmail"=>$data->{"email"},"senderPassword"=>$data->{"password"},"message"=>$message,"messageH"=>$messageHeader,"senderName"=>$data->{"email"},"clientEmail"=>$userEmail];
        if(mailsend($mailArr)){
            return true;
        }
        return false;
    }
    return false;
}

function forgetEmailSend($userEmail,$userName,$verificationCode){
    $message="
        <div>
            <table>
                <tr>
                    <td>Email :</td>
                    <td>$userEmail </td>
                </tr>
                <tr>
                    <td>Kullanıcı adı :</td>
                    <td>$userName</td>
                </tr>
            <table>
            <br>
            <h2>
                Kod 
            </h2>
            <br>
            <h1>
                $verificationCode
            </h1>
            <br>
            <div>
                Not: Şifrenizi kaydedin. Şifreler geri dönüşümsüzdür.
            </div>
        </div>
    ";
    $messageHeader="Sifre degisikligi";
    if($data=email_config_return("forget")){
        $mailArr=["senderEmail"=>$data->{"email"},"senderPassword"=>$data->{"password"},"message"=>$message,"messageH"=>$messageHeader,"senderName"=>$data->{"email"},"clientEmail"=>$userEmail];
        if(mailsend($mailArr)){
            return true;
        }
        return false;
    }
    return false;
}


function mailsend($mailArr=[]){
    if( arrEmpty($mailArr)){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
        $mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
        $mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
        $mail->Host = APP_EMAILSERVER; // Mail sunucusunun adresi (IP de olabilir)
        $mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
        $mail->IsHTML(true);
        $mail->SetLanguage("tr", "phpmailer/language");
        $mail->CharSet  ="utf-8";
        $mail->Username = $mailArr["senderName"]; // Gönderici adresinizin sunucudaki kullanıcı adı (e-posta adresiniz)
        $mail->Password =$mailArr["senderPassword"]; // Mail adresimizin sifresi
        $mail->SetFrom($mailArr["senderEmail"], $mailArr["senderName"]); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
        $mail->AddAddress($mailArr["clientEmail"]); // Mailin gönderileceği alıcı adres
        $mail->Subject = $mailArr["messageH"]; // Email konu başlığı
        $mail->Body = $mailArr["message"]; // Mailin içeriği
        if(!$mail->Send()){
            mailSendErrorRegistration($mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
    return false;
}
function mailSendErrorRegistration($message){
    error_registions("email_send_error.txt",$message);
}
function email_config_return($emailName){
    if($data=json_config_read("email_config.json")){
        return $data->{$emailName};
    }
    return false;
}
?>