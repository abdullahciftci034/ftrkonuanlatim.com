<?php
#html dosyalarını php dosyaları içinde dahil eder
function htmlfileinclude($path){
    if(is_file($path)){
       echo file_get_contents($path);
      }
}

#bir arrayde boş bir değer var ise false döndürür
function emptyArr($arr){
    foreach($arr as $key => $val){
        if(empty($val)){
            return false;
        }
    }
    return true;
}

#$_SESSION["oturum"] kontorlü yapar
function oturumControl(){
    if(empty($_SESSION["oturum"])){
        return false;
    }
    return true;
}

#bir arrayde boş bir değer var ise false döndürür
function arrEmpty($arr){
    if(empty($arr)){
        return false;
    }
    foreach ($arr as $key => $val){
        if(empty($val)){
            return false;
        }
    }
    return true;
}

#doğrulama kodu üretir
function createVerificationCode(){
    return mt_rand(0,99).mt_rand(0,99).mt_rand(0,99);
}
function refreshPage($page=null){
    if($page==null){
        echo "<script> window.location='".APP_ROOT1."';</script>";
    }else{
        echo "<script> window.location='".APP_ROOT1."".$page."/';</script>";
    }
    
}

#bir dizide boş elemanları siler
function arrEmptyElementDelete($arr){
    $arrFinal=[];
    foreach($arr  as $key){
        if(!empty($key)){
            array_push($arrFinal,$key);
        }
    }
    unset($arr);
    return $arrFinal;
}

#birinci array içinde ikinci arraya eşit olan değerler toplanır döndürülür
function equalsArr($arr1=[],$arr2=[]){
    $arrFinal=[];
    $eklemi=true;
    foreach($arr1 as $key1){
        $eklemi=true;
        foreach($arr2 as $key2){
            if($key1===$key2){
                $eklemi=false;
            }
        }
        if($eklemi){
            array_push($arrFinal,$key1);
        }
    }
    return $arrFinal;
}

# array içindeki stringlerin hepsini birleştiri
function  mediatizeArr($arr){
    $str="";
    foreach($arr as $key => $val){
        $str.=$val;
    }
    return $str;    
}

#şimdiki zaman 1 gün ekleme fonksiyonu
function oneDayAdd(){
    return  date('Y-m-d H:i:s',strtotime('+1 day'));
}

#bunun amacı gelen session  değerleri tutmak ve ekrana yazdırmak
function sessionUnitRegistration($post){
    if(!empty($post)){
        $sessionUnit=htmlspecialchars_decode_arr($post);
        $response='<div id="unit_text"><div id="unitContentPart"> <div id="title">'.@$sessionUnit["unitTitle"].'</div><div id="content">'.@$sessionUnit["unitContent"].'</div></div></div>';
        echo $response;
        return $sessionUnit;
    }
}
?>
