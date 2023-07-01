<?php
if(oturumControl() and $_SESSION["oturum"]["userActive"]  and $_SESSION["oturum"]["userRank"] >= 2){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_KATEGORILER."kategoriJson.php";
    $unitObj=new unitMysql("root"); 
    $kategoriObj=new  kategoriJson(APP_KATEGORİLER_JSON); 
    $lessonKeysNames=$kategoriObj->getLessonKeysNamesArr();
    $arr=null;
    if($arr=$unitObj->getElementAndAll(["unitConfirmation"=>1,"id"=>@$data[0]])){
        @$arr=$arr[0];
        $_SESSION["unitEdit"]["id"]=$arr["id"];
        $_SESSION["unitEdit"]["unitKey"]=$arr["unitKey"];
        $_SESSION["unitEdit"]["unitTitle"]=$arr["unitTitle"];
        $_SESSION["unitEdit"]["lessonKey"]=$arr["lessonKey"];
        $_SESSION["unitEdit"]["authorUserId"]=$arr["authorUserId"];
    }
    $unitObj->connPdo=null;
    require_once APP_VIEW."unitEditForm.php";
    
}else{
    require_once __DIR__."/error.php";
}
?>