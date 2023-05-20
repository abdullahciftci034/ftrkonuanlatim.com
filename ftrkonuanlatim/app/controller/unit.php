<?php
require_once APP_MYSQL."unitMysqlClass.php";
$unitObj=new unitMysql("root");
$unitData["unitConfirmation"]="1";
if(!empty(@$data[0]) and !empty(@$data[1])){
    $unitData=["lessonKey"=>$data[0],"unitKey"=>$data[1]];
}else if(!empty(@$_POST["unitKey"]) and !empty($_POST["lessonKey"])){
    $unitData=["unitKey"=>$_POST["unitKey"],"lessonKey"=>$_POST["lessonKey"]];
}else if(!empty(@$_GET["unitKey"]) and !empty(@$_GET["lessonKey"])){
    $unitData=["unitKey"=>$_GET["unitKey"],"lessonKey"=>$_GET["lessonKey"]];
}else if(!empty(@$data[0]) and empty(@$data[1])){
    $unitData=["unitKey"=>$data[0]];
}
if(@$unitData["unitKey"]=="oneri" and !empty(@$unitData["lessonKey"])){
    $unitData["unitKey"]=$unitData["lessonKey"]."/".$unitData["unitKey"];
}
if(!empty(@$unitData["unitKey"])){
    if($unitData["unitKey"]=="oneri"){
        require_once __DIR__."/unit1.php";
    }else{
        if($unit=$unitObj->getElementAndAll($unitData)){    
            $unit=@$unit[0];
            $unitId=$unit["id"];
            if(!empty($unit)){
                require_once APP_MYSQL."userMysqlClass.php";
                $userObj=new userMysql("root");
                $user=$userObj->getElementAnd(["userName","userNameVal"],["id"=>$unit["authorUserId"]]);
                $user=$user[0];
                $userObj->connPdo=null;
                $unit=htmlspecialchars_decode_arr($unit);
                require_once APP_VIEW."unit.php";
            }else{
                echo "<div id='info'>Konu bulunamadı.</div>";
                require_once __DIR__."/paylasimlar.php";
            }
        }else{
            echo "hata" ;
        } 
    }
}else{
    require_once __DIR__."/paylasimlar.php";
}
$unitObj->connPdo=null;
?>