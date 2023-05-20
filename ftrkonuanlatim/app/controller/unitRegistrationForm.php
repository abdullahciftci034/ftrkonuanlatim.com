<?php
if(oturumControl() and @$_SESSION["oturum"]["userConfirmation"]==1){
    require_once APP_KATEGORILER."kategoriJson.php";
    $kategoriler=new kategoriJson(APP_KATEGORİLER_JSON);
    $lessonKeysNames=$kategoriler->getLessonKeysNamesArr();
    if(@$data[0]=="tempsave"){
        require_once APP_MYSQL."unitTempSaveMysqlClass.php";
        $tempSaveObj=new unitTempSave("root");
        $d=$tempSaveObj->getElementAndAll(["authorUserId"=>$_SESSION["oturum"]["id"]]);
        if(!empty($d)){
            $_SESSION["unit"]=$d[0];
            unset($d);
        }
        $tempSaveObj->connPdo=null;
    }
    require_once APP_VIEW."unitRegistrationForm.php";
    $kategoriler=null;
}else{
    require_once __DIR__."/error.php";  
}
?>