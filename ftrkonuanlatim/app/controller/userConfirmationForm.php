<?php
if(oturumControl() and @$_SESSION["oturum"]["userConfirmation"]==0){
    require_once APP_VIEW."userConfirmationForm.php";
}else{
    require_once __DIR__."/error.php";
}
?>