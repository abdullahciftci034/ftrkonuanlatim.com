<?php
if(oturumControl()){
    $_SESSION["unit"]=sessionUnitRegistration($_POST);
}else{
    require_once __DIR__."/error.php";
}
?>