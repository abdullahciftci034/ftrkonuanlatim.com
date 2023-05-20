<?php
require_once APP_MYSQL."unitMysqlClass.php";
$unitObj=new unitMysql("root");
$retsult=$unitObj->unitApprovedLast10();
echo "<div id='guncel' class='container'><div class='row'>";
if(!empty($retsult)){
    foreach($retsult as $val){
        echo "<div id='duzen1' class='col-12'><h5>".$val["unitTitle"]."</h5>".strip_tags(htmlspecialchars_decode(substr($val["unitContent"],0,400)))."";
        echo "<a href='".APP_ROOT1."unit/".$val["unitKey"]."'> devami için tıklayın</a></div>";
    }
    echo "</div></div>";
}else{
    echo "Hiç güncel paylaşımımız olmadı.";
}
$unitObj->connPdo=null;
?>
<style>
    div#duzen1{
        padding-top: 6px;
        margin-bottom: 15px;
        margin-top:15px;
        font-size: 14px;
        background-color: rgb(238,238,238);
        border:rgb(238,238,238) solid 1px;
        border-radius: 6px;

    }
    @media screen and (max-width:768px){
        div#duzen1 {
            font-size: small;
        }
    }
    @media screen and (max-width:576px){
        div#duzen1 {
            font-size:x-small;
        }
    }
    @media screen and (max-width:300px){
        div#duzen1 {
            font-size: xx-small;
        }
       
    }
</style>