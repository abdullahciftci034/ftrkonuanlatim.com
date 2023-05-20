<?php
require_once __DIR__."/link_funcs.php";
function fileUploadControl($file){
    #eğer daha fazla dosya çeşidi istiyorsak bunu yapıcaz.
    //$controlArr=["text/plain","application/pdf","application/vnd.openxmlformats-officedocument.presentationml.presentation","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword","application/vnd.oasis.opendocument.text"];
    //$controlArr1=["txt","pdf","pptx","docx","rtf","odt"];       
    $fileNameControl=["pdf"]; #şimdilik kabul edilceke dosya çeşidi.
    $fileTypeControl=["application/pdf"];
    $fileNameArr=explode(".",$file["name"]);
    $fileUzanti=$fileNameArr[count($fileNameArr)-1];
    unset($fileNameArr[count($fileNameArr)-1]);
    if(fileControl1($fileUzanti,$fileNameControl)){
        if(fileControl1($file["type"],$fileTypeControl)){
            $fileDos = @file($file["tmp_name"]);
            preg_match("/^%PDF/",$fileDos[0],$matches);
            if(!empty($matches[0])){
                $newName=link_olustur(mediatizeArr($fileNameArr));
                if(rename($file["tmp_name"],APP_UPLOAD_TEMP.$newName.".pdf")){
                    return ["result"=>true,"error"=>"Dosya doğrulandı. ","save" => false,"newfileName"=>$newName.".pdf"];
                }
                return ["result"=>false,"error"=>__DIR__."fileUploadControl fonksiyonun gecici dosyası: ".$file["tmp_name"]." taşınamadı. ","save" => true];
            }
            return ["result"=>false,"error"=>"Dosyanız tehlike bulundu. Lütfen başka dosyalar deneyin.","save" => false];     
        }
        return ["result"=>false,"error"=>" Dosya uzantısı : $fileUzanti , DosyaMime türü: ".$file["type"],"save" => false]; 
    }
    return ["result"=>false,"error"=>" Dosya uzantısı : $fileUzanti , DosyaMime türü: ".$file["type"],"save" => false];
}

#burada belirlenmiş dosya işlemleri aynı var ise 
function fileControl1($Name,$controlArr){
    foreach($controlArr as $val){
        if($Name==$val){
            return true;
        }
    }
    return false;
}

#burada  array map ile dosyanın tamamen taranmasını sağladık
/*$ara1=function ($val){
    echo $val;
    preg_match("/^/",$val,$matches1);
    if(empty($matches1)){
        return null;
    }
    return $matches1[0];
};
*/    
?>