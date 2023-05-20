<div id="kategoriList">
<?php
if(!empty(@$data["0"])){
    require_once APP_MYSQL."unitMysqlClass.php";
    $unitObj=new unitMysql("root");
    $list=$unitObj->getElementAnd(["unitKey","unitTitle"],["lessonKey"=>$data[0],"unitConfirmation"=>1]);
    echo '<div id="link">/<a href="'.APP_ROOT1.'d">d</a>/<a href="'.APP_ROOT1.'d/'.$data[0].'">'.$data[0].'</a></div>';
    echo "<div id='unitList'><ul id='unitList'>";
        foreach($list as $key => $val){
            echo "<li><a href='".APP_ROOT1."unit/".$val["unitKey"]."'>".$val["unitTitle"]."</a></li>";
        }
    echo"</ul></div>";
    $unitObj->connPdo=null;
}else{
    require_once APP_MYSQL."lessonMysqlClass.php";
    $lessonObj=new lessonMysql("root");
    $list=$lessonObj->getArr();
    echo "<div id=lessonList><ul id='lessonList'>";
    foreach($list as $key => $val){
        echo "<li><a href='".APP_ROOT1."d/".$val["lessonKey"]."'>".$val["lessonName"]."</a></li>";
    }
    echo"</ul><div>";    
    $lessonObj->connPdo=null;
}
?>
</div>
<style>
    div#kategoriList  a{
        font-size: 16px;
        color: black;
    }
    div#kategoriList  ul li{
       margin-top: 10px;
       margin-bottom: 10px;
    }

</style>