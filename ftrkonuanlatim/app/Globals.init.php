<?php
   define("APP_ROOT",__DIR__."/../");
   define("APP_ROOT1",rootSearch()."/");#script bolümüne gidecek
   #define("APP_ROOTURL",rootUrlSearch());#uygulamanın url rootunu bulduk
   define("APP_PUBLIC",__DIR__."/../public/");
   define("APP_PUBLIC1",APP_ROOT1."public/");#script bolümüne gidecek
   define("APP_CONTROLLER",__DIR__."/../app/controller/");
   define("APP_CORE",__DIR__."/../app/core/");
   define("APP_MODEL",__DIR__."/../app/model/");
   define("APP_VIEW",__DIR__."/../app/view/");
   define("APP_PROBLEMS",__DIR__."/../../ftrkonuanlatim.com.problems.d/");
   define("APP_BACKUP",__DIR__."/../../ftrkonuanlatim.com.backup.d/");
   define("APP_CONFIG",__DIR__."/../../ftrkonuanlatim.com.config.d/");
   define("APP_UPLOAD_TEMP",__DIR__."/../../ftrkonuanlatim.com.temp.d/");
   define("APP_CRONE",__DIR__."/../../ftrkonuanlatim.com.crone.d/");
   define("APP_UPLOAD_KATEGORILER",__DIR__."/../upload/kategoriler/");
   define("APP_MYSQL",APP_MODEL."mysql/");
   define("APP_CLASS",APP_MODEL."classes/");
   define("APP_FUNCS",APP_MODEL."funcs/");
   define("APP_EMAIL",APP_MODEL."email/");
   define("APP_USER",APP_MODEL."user/");
   define("APP_LIBARY",APP_MODEL."lib/");
   define("APP_KATEGORILER",APP_MODEL."kategoriler/");
   define("APP_UNIT",APP_MODEL."unit/");
   define("APP_SITEMAP",APP_MODEL."sitemap/");
   define("APP_MESSAGE",APP_MODEL."message/");
   define("APP_DATABASENAME","ftrkonuanlatim");
   define("APP_EMAILSERVER","mail.ftrkonuanlatim.com");
   define("APP_KATEGORİLER_JSON","kategoriler.json");
   define("APP_MYSQL_CONFIG","mysql_config.json");
   
   
   function rootSearch(){
      $arr=explode("/",$_SERVER["SCRIPT_NAME"]);
      $sayi=count($arr);
      $kok="";
      for ($i=1;$sayi-1>$i;$i++){
         $kok.="/".$arr[$i];
      }
      return $kok;
   }
   function rootUrlSearch(){
      $data=explode($_SERVER["SCRIPT_NAME"],"/");
      $sayi=count($data);
      echo $sayi;
      unset($data[$sayi-1]);
      $url="/";
      for($i=0;$i<$sayi;$i++){
         if(!empty($data[$i])){
            $url=$url."$data[$i]/";
         }
      }
      return $url;
   }
?>