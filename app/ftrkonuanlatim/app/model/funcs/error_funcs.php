<?php
#burada hata  kaydı yapıyoruz eğer hata dosyası henüz oluşturulmamış ise oluşturuy
function error_registions($fileName,$errorMessega){
    try{
        $fileName =APP_PROBLEMS.$fileName;
        if(is_file($fileName)){
            return error_registions1($fileName,$errorMessega);
        }else{
            if(touch($fileName)){
                if(is_file($fileName)){
                    return error_registions1($fileName,$errorMessega);
                }       
            }
        }
        return false;
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}
function error_registions1($fileName,$errorMessega){
    $dosya = fopen($fileName,'a');
    $str="Tarih : ".date('d.m.Y H:i:s')." => ". $errorMessega."\n";
    if(!fwrite($dosya, $str)){
        echo"<br>izim hatası<br>";
        fclose($dosya);    
        return false;
    }
    $str=null;
    fclose($dosya);
    return true;
}
function error_log_save($fileName,$result){
    if($result["save"]){
        error_registions($fileName,$result["error"]);
        echo "Bizden kayanklı bir hata oluştu. Eğer acilse sistem yöneticine başvurun. abdullahciftci034@gmail.com";
    }else{
        echo $result["error"];
    }

}

?>