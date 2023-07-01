<?php
if(!empty(@$_SESSION["forget"])){
    $_SESSION["bootControlNumber"]=createVerificationCode();
    echo "<div id='bootControlNumber' style='display: none; visibility: hidden;'>".$_SESSION["bootControlNumber"]."</div>";
    require_once APP_VIEW."userPasswordForgetForm1.php";
}else{
    require_once __DIR__."/error.php";
}
?>