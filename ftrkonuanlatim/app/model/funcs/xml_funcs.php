<?php
# xml dosyamızı okuduk
function xml_read($file){
   
    if(is_file($file)){
        return  file_get_contents($file);
    }
    return false;   

}
function xmlDomReturn($data){
    if($data){
        return new DOMDocument('1.0', 'UTF-8');
    }
    return false;
}

?>