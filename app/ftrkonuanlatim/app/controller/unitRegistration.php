<?php
if(oturumControl() and @$_SESSION["oturum"]["userConfirmation"]){
    require_once APP_UNIT."unit_funcs.php";
    require_once APP_KATEGORILER."kategoriJson.php";
    require_once APP_FUNCS."file_funcs.php";
    require_once APP_MYSQL."unitMysqlClass.php";
    $kategoriJsonObj=new kategoriJson(APP_KATEGORİLER_JSON);
    $unitObj=new  unitMysql("root");
    ##### Kesin kayıt için yapıldı #### 
    if(emptyArr($_POST)){
        #burda bir dosya gönderilmişmi dosya uploadda bir hata var ise geri dönüş yapıcaz
        $registrationControl=["resultFile"=>["fileEmpty"=>false,"fileError"=>false,"result"=>null],"resultMysql"=>null];
        $unitFileLocation="bos";
        # bir dosya varmı kontrolü yaptık ve dosyayı kayıt ettik
        if(arrEmpty(@$_FILES["file"]) or @$_FILES["file"]["error"]===0 and @$_SESSION["oturum"]["userActive"]){
            $registrationControl["resultFile"]["fileEmpty"]=true;
            $registrationControl["resultFile"]["fileError"]=false;
            $registrationControl["resultFile"]["result"]=fileUploadControl($_FILES["file"]);
            $unitFileLocation=@$registrationControl["resultFile"]["result"]["newfileName"];
        }else if(!empty(@$_FILES["file"]["name"]) and !empty(@$_FILES["file"]["error"]) and @$_SESSION["oturum"]["userActive"]){
            #burda dosya var ve hata var ise diğer işlemler duracak
            $registrationControl["resultFile"]["fileEmpty"]=true;
            $registrationControl["resultFile"]["fileError"]=true;
        }
        #burada yukarıdaki işlemlerin sağlandığını kontrol ettik
        if(!$registrationControl["resultFile"]["fileError"] and ($registrationControl["resultFile"]["result"]["result"] or !$registrationControl["resultFile"]["fileEmpty"])){
            $data=["authorUserId"=>$_SESSION["oturum"]["id"],"unitFileLocation"=>$unitFileLocation,"unitContent"=>$_POST["unitContent"],"unitTitle"=>$_POST["unitTitle"],"lessonKey"=>$_POST["lessonKey"]];
            $registrationControl["resultMysql"]=unitRegistration1($unitObj,$kategoriJsonObj,$data);
            if($registrationControl["resultMysql"]["result"]){
                echo $registrationControl["resultMysql"]["error"];
                unset($_SESSION["unit"]); 
            }else{
                error_log_save("unitError.txt",$registrationControl["resultMysql"]);
                $_SESSION["unit"]=sessionUnitRegistration($_POST);
            }
        }
        else if(!$registrationControl["resultFile"]["fileError"] and !@$registrationControl["resultFile"]["result"]["result"]){
            error_log_save("unitError.txt",$registrationControl["resultFile"]["result"]);
            $_SESSION["unit"]=sessionUnitRegistration($_POST);
        }else if(!$registrationControl["resultFile"]["fileError"]){
            echo "Dosya yükleme sırasında hata oluştu.";
            $_SESSION["unit"]=sessionUnitRegistration($_POST);
        }   
    }else if(!emptyArr($_POST)){
        $_SESSION["unit"]=sessionUnitRegistration($_POST);
        echo "İçerik veya konu başlığı boş";
    }
    $kategoriJsonObj=null;
    $unitObj->connPdo=null;
}else{
    require_once __DIR__."/error.php";
}
?>