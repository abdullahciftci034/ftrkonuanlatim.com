<?php 
#config dosyasını okuduk
function json_config_read($path){
    $fileConfig=APP_CONFIG.$path;
    if(is_file($fileConfig)){
        return  json_decode(file_get_contents($fileConfig,JSON_UNESCAPED_UNICODE));
    }
    return false;
}

function json_config_write($path,$data){
    $fileConfig=APP_CONFIG.$path;
    if(is_file($fileConfig)){
        return file_put_contents($fileConfig,json_encode($data,JSON_UNESCAPED_UNICODE));
    }
    return false;
}
?>