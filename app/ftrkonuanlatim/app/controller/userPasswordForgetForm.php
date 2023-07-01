<?php
$_SESSION["bootControlNumber"]=createVerificationCode();
echo "<div id='bootControlNumber' style='display: none; visibility: hidden;'>".$_SESSION["bootControlNumber"]."</div>";
require_once APP_VIEW."userPasswordForgetForm.php";
?>