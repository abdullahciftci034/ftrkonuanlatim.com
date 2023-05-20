<?php
if($method){ #ajax işlemleri
   require_once APP_VIEW."index2.php";
}else{ #normal get işlemleri
  require_once APP_VIEW."index.php";
}
?>