<?php
if(oturumControl()){
    session_destroy();
    echo "<script> window.location='".APP_ROOT1."';</script>";
}else{
    echo "Giriş yapmadınız.";
}
?>