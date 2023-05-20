<?php
require_once __DIR__."/kategoriJson.php";
class kategori{
    function __construct(){
        $kategoriJson=new kategoriJson(APP_KATEGORİLER_JSON);
        $this->data=$kategoriJson->data;
    }
    public function list_return(){
        $str="<ul id='kategoriler'>";
            foreach($this->data as $key => $val){
                $str.="<li id='kategoriler'><a href='#' id='kategoriler'name='".$key."'>".$val->{"lesson_name"}."</a><div>";
                    $str.="<ul id='konu_getir'>";
                    foreach($val->{"units"} as $key1 => $val1){
                        $str.="<li><a href='#' name='".$key1."'>".$val1."</a></li>";
                    }   
                    $str.="</ul>";
                $str.="</div></li>";    
            }
            $str.="</ul>";
        return $str;
    }
    public function jsonreturn(){
        echo json_encode((object)["data"=>(object)$this->data,"list"=>(object)$this->list_return()]);
    }
}
?>