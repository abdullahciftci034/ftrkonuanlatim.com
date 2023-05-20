<?php
function htmlspecialAndTrim($arr){
  $duzenli_array=[];
  foreach($arr as $key => $val){
    if(!is_array($val)){
      $val=htmlspecialchars(trim($val));
    }else{
      $val=htmlspecialAndTrim($val);
    }
    $duzenli_array[$key]=$val;
  }
  return $duzenli_array;
}

#burada bazı filtreler yaptık
function htmlspecialcharsFilter($html){
  $html=htmlspecialchars_decode($html);
  $dom = new DOMDocument();
  @$dom->loadHTML($html);
  $tags_to_remove = array('script','style','iframe','link','svg','scrip','scri','scr','sc','s','a',"FRAMESET");
  foreach($tags_to_remove as $tag){
      $element = $dom->getElementsByTagName($tag);
      foreach($element  as $item){
          $item->parentNode->removeChild($item);
      }
  }
  $html = $dom->saveHTML();
  $strip_tags_filter="<b><h1><h2><br><i><h3><h4><strong>";
  $html=strip_tags($html,$strip_tags_filter);
  return $html;
}

#burda ise html arrayleri decode ettik 
function htmlspecialchars_decode_arr($arr){
  $duzenli_array=[];
  foreach($arr as $key => $val){
    if(!is_array($val)){
      $val=htmlspecialchars_decode($val);
    }else{
      $val=htmlspecialchars_decode_arr($val);
    }
    $duzenli_array[$key]=$val;
  }
  return $duzenli_array;
}

?>