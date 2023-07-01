<?php
function klasorleri_duzenle($json_array,$path){
    if(is_dir($path)){
         $klasor_array=klasordeki_klasorleri_goruntule($path."/");
         foreach($json_array as $key){
             $varmi=false;
             $i=0;
             foreach($klasor_array as $key1){
                 //klasör kontolu yapıcaz
                 if($key1===$key){
                     $varmi=true;
                 }
                 $i++;
             }
             //eğer klasör yoksa oluştur
             if(!$varmi){
                 klasor_olustur($path."/".$key);
                 echo $key." klasörü başarılı bir şekilde oluşturuldu.<br>";
             }
         }
         //$this->klasor_islemleri_silinsinmi($path,$klasor_array,$json_array);
     }else{
         return false;
     }
}
function klasor_islemleri_silinsinmi($path,$klasor_array,$json_array){
    $silinsinmi;
    for($i=0;$i<count($klasor_array);$i++){
        $silinsinmi=true;
        foreach($json_array as $key){
            if($key==$i){
                $silinsinmi=false;
            }
        }
         if($silinsinmi){
            $dizin = opendir($path."/".$klasor_array[$i]);
            while($dosya = readdir($dizin)) {
                if(is_file($path."/".$klasor_array[$i]."/".$dosya) && !($dosya=="." |$dosya=="..")){
                    if(dosya_sil($path."/".$klasor_array[$i]."/".$dosya)){
                        echo"$dosya dosyası başarılı bir şekilde silindi.";
                    }
                }
            }
            closedir($dizin);
            if(alt_dosya_klasor_sil($path."/".$klasor_array[$i])){
                echo "Dosyalar başarılı bir şekilde düzeltildi.";
            }
        }
    }
}
function dosyalari_duzenle($json_array,$path){
    if(is_dir($path)){
        if(($dosya_array=klasordeki_dosyalari_goruntule($path."/"))){
            $silinsinmi=null;
            $i=0;
            foreach($dosya_array as $key){
                $silinsinmi=true;
                foreach($json_array as $key1){
                    if($key1.".pdf"===$key || $key1.".html"===$key ){
                        $silinsinmi=false;
                    }
                }
                if($silinsinmi){
                    if(dosya_sil($path."/".$dosya_array[$i])){
                        echo"$dosya dosyası başarılı bir şekilde silindi.";
                    }
                }
                $i++;
            }
            $olmayan_dosyalar=array();
            $i=0;
            foreach($json_array as $key1){
                $varmi=false;
                foreach($dosya_array as $key){
                    if($key1.".pdf"===$key || $key1.".html"===$key){
                        $varmi=true;
                    }
                }
                if(!$varmi){
                    array_push($olmayan_dosyalar,$i);    
                }
                $i++;
            }
            return $olmayan_dosyalar;
        }else{
            $olmayan_dosyalar=array();
            for($i=0;$i<count($json_array);$i++){
                array_push($olmayan_dosyalar,$i);
            }
            return $olmayan_dosyalar;
        } 
    }else{
        return false;
    }
                    
}
function alt_dosya_klasor_sil($path){
    if(is_dir($path)){
        $klasor_listesi=klasordeki_klasorleri_goruntule($path."/");
        $dosya_listesi=klasordeki_dosyalari_goruntule($path."/");
        foreach($dosya_listesi as $key){
            if(dosya_sil($path."/".$key)){
                echo"$key dosyası başarılı bir şekilde silindi.<br>";
            }
        }  
        foreach($klasor_listesi as $key){
            alt_dosya_klasor_sil($path."/".$key);
        }
        if(klasor_sil($path)){   
            echo"$path klasörü başarılı bir şekşilde silindi.<br>";
            return true;
        }
    }
}
function klasor_dosyalari_tara_dondur($path){
    $ana_klasor_arr=klasordeki_klasorleri_goruntule($path);
    $arr=[];
    foreach($ana_klasor_arr as $key){
        $dosya_arr=klasordeki_dosyalari_goruntule($path."/".$key."/");
        $arr[$key]=$dosya_arr;
    }
    return $arr;
}
function klasordeki_klasorleri_goruntule($path){
    try{  
        $klasor_array=array();
        $dizin = opendir($path);
        while($dosya = readdir($dizin)) {
            if(is_dir($path.$dosya) && !($dosya == "." | $dosya == "..")){
                array_push($klasor_array,$dosya);                 
            }
        }
        closedir($dizin);
        return $klasor_array;
    }catch(Exception $e){
        closedir($dizin);
        echo $e->getMessage();
        return false;
    }
}
function klasordeki_dosyalari_goruntule($path){
    try{  
        $dosya_array=array();
        $dizin = opendir($path);
        while($dosya = readdir($dizin)) {
            if(is_file($path.$dosya) && !($dosya == "." | $dosya == "..")){
                array_push($dosya_array,$dosya);                 
            }
        }
        closedir($dizin);
        return $dosya_array;
    }catch(Exception $e){
        closedir($dizin);
        echo $e->getMessage();
        return false;
    }
}
function tasi_veya_yeniden_adlandir($eski_path,$yeni_path){
    try{
        if(rename($eski_path,$yeni_path)){
            return true;
        }
        return false;
    }catch(Exception $e){
        $e->getMessage();
        return false;
    }
}
function klasor_olustur($path){
    try{
        if(mkdir($path, '0722')){
            return true;
        }
        return false;
    }catch(Exception $e){
        $e->getMessage();
        return false;
    }
}
function klasor_sil($path){
    try{
        if(rmdir($path)){
            return true;
        }
        return false;
    }catch(Exception $e){
        $e->getMessage();
        return false;
    }
}
function dosya_sil($path){
    try{
        if(unlink($path)){
            return true;
        }
        return false;
    }catch(Exception $e){
        $e->getMessage();
        return false;
    }
}
?>