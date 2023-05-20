<?php
if(!oturumControl()){
    $_SESSION["bootControlNumber"]=createVerificationCode();
    echo "<div id='bootControlNumber' style='display: none; visibility: hidden;'>".$_SESSION["bootControlNumber"]."</div>";
    require_once APP_VIEW."userLoginForm.php";  
}else{
    require_once __DIR__."/error.php";
}
?>