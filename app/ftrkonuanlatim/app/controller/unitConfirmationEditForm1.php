<?php
if(oturumControl() and $_SESSION["oturum"]["userActive"]  and $_SESSION["oturum"]["userRank"] >= 2){
    require_once APP_KATEGORILER."kategoriJson.php";
    $kategoriler=new kategoriJson(APP_KATEGORİLER_JSON);
    $lessonKeysNames=$kategoriler->getLessonKeysNamesArr();
    $arr=htmlspecialchars_decode_arr($_POST);
    require_once APP_VIEW."unitConfirmationEditForm1.php";
    
}else{
    require_once __DIR__."/error.php";
}
?>  