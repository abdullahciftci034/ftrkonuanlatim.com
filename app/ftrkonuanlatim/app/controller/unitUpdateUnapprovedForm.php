<?php
if(oturumControl() and $_SESSION["oturum"]["userConfirmation"]){
    require_once APP_KATEGORILER."kategoriJson.php";
    $kategoriJsonObj=new kategoriJson(APP_KATEGORİLER_JSON);
    $lessonKeysNames=$kategoriJsonObj->getLessonKeysNamesArr();
    $kategoriJsonObj=null;
    $arr=[];
    if(!empty(@$data[0])){
        require_once APP_MYSQL."unitMysqlClass.php";
        $unitObj=new unitMysql("root");
        
        $d=$unitObj->getElementAndAll(["id"=>$data[1],"authorUserId"=>$_SESSION["oturum"]["id"]]);
        if(!empty($d)){
            $arr=$d[0];
            unset($d);
        }
        $unitObj->connPdo=null;
    }
    require_once APP_VIEW."unitUpdateUnapprovedForm.php";
}else{
    require_once __DIR__."/error.php";
}
?>