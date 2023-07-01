<?php
if(oturumControl() and @$_SESSION["oturum"]["userRank"]=="3"){
  require_once APP_MYSQL."mysqlStartClass.php";
  $mysql =new mysqlStart();
  $mysql->createStruct();
  $mysql->insertMysql();
  $mysql->databaseObj->connPdo=null;
}elseif($data[0]==1){
  echo "hata yok";
  require_once APP_MYSQL."mysqlStartClass.php";
  $mysql =new mysqlStart("root");
  
  /* if($mysql->createDB()){
      echo $mysql->databaseObj->database." database olusturuldu.<br/>";
  }else{
      echo $mysql->databaseObj->database." database olusturulamadi.<br/>";
  }*/
  $mysql->createStruct();
  $mysql->insertMysql();
  $mysql->databaseObj->connPdo=null;
  //username= abdullahciftci034, password = abdullah_123
}


?> 