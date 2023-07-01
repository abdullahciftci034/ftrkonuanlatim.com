<?php
require_once APP_MYSQL."unitMysqlClass.php";

$unitObj=new unitMysql("root");
$result=[];
if($result=$unitObj->unitApprovedLast10()){
    echo "<div class='container'><div class='row'>";
    if(!empty(@$result[0])){
        foreach($result as $val){
            echo '<meta name="'.$val["unitTitle"].'">';
            echo "<div id='duzen1' class='col-sm-12 col-md-12 col-lg-5 col-xl-5'><h5>".$val["unitTitle"]."</h5>".strip_tags(htmlspecialchars_decode(substr($val["unitContent"],0,400)))."";
            echo "<a href='".APP_ROOT1."unit/".$val["unitKey"]."'> devami için tıklayın</a></div>";
        }
    }else{
        echo "Güncel Paylaşım hiç olmadı.";
    }
    
    echo "</div></div>";
}
$unitObj->connPdo=null;
?>
 <script>
  
 </script>
 <style>
     div#duzen1{
         
         margin-top: 10px;
         margin-bottom: 15px;
     }
    div#duzen1{
        margin: auto;
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