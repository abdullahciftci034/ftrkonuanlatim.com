<?php
if(oturumControl() and @$_SESSION["oturum"]["userRank"]=="3"){
  require_once APP_MYSQL."mysqlStartClass.php";
  $mysql =new mysqlStart();
  $mysql->createStruct();
  $mysql->insertMysql();
  $mysql->databaseObj->connPdo=null;
}

?> 