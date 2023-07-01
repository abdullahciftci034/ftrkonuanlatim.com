<?php
#burda link oluşturacak fonksiyonlar yazdık
function str_replace_new($str){
    return str_replace(["Ç","ç","Ş","ş","İ","ı","Ü","ü","Ğ","ğ","Ö","ö"],["c","c","s","s","i","i","u","u","g","g","o","o"],$str);
  }
  function str_replace_new1($str){
    for($i=0;$i<5;$i++){
      $str=str_replace("__","_",$str);
    }
    return $str;
  }
  function trim_new($str){
    return trim(trim($str,"_"));
  }
  function preg_replace_new($str){
    return preg_replace("[\W]","_",$str); 
  }
  function mb_strtolower_new($str){
    return mb_strtolower($str);
  }
  function link_olustur($str){
    return  str_replace_new1(mb_strtolower_new(trim_new(preg_replace_new(str_replace_new($str)))));
  }
?>