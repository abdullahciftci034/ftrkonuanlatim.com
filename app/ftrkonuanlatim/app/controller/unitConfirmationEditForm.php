<?php
if(oturumControl() and $_SESSION["oturum"]["userActive"]  and $_SESSION["oturum"]["userRank"] >= 2){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_KATEGORILER."kategoriJson.php";
    $kategoriler=new kategoriJson(APP_KATEGORİLER_JSON);
    $unitObj=new unitMysql("root");
    $lessonKeysNames=$kategoriler->getLessonKeysNamesArr();
    if($arr=$unitObj->getElementAndAll(["unitConfirmation"=>0,"id"=>@$data[0]])){
        $arr=@$arr[0];
    }
    if(!empty($arr)){
        $_SESSION["unitConfirmation"]["id"]=$arr["id"];
        $_SESSION["unitConfirmation"]["authorUserId"]=$arr["authorUserId"];  
        $_SESSION["unitConfirmation"]["unitFileLocation"]=$arr["unitFileLocation"];
        $_SESSION["unitConfirmation"]["unitKey"]=$arr["unitKey"];
        $_SESSION["unitConfirmation"]["lessonKey"]=$arr["lessonKey"];
    }
    $unitObj->connPdo=null;
    $kategoriler=null;
    require_once APP_VIEW.$page.".php";
    
}else{
    require_once __DIR__."/error.php";
}
?>  