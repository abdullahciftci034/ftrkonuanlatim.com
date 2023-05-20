<?php
if(!empty(@$_SESSION["forget"])  and @$_SESSION["forget"]["confirmation"]){
   require_once APP_VIEW."userPasswordForgetNewForm.php";
}else{
    require_once __DIR__."/error.php";
}

?>