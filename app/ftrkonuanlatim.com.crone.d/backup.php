<?php

function mysqlBackup(){
    require_once APP_MYSQL."databaseMysqlClass.php";
    $ftrObj=new databaseMysql("root",APP_DATABASENAME);    
    $ftrObj->getMysqlObjectAll();
    json_backup_write("backup_mysql_".date("y.m.d").".json",$ftrObj->getMysqlObjectAll());
    $ftrObj->connPdo=null;
}
function json_backup_write($path,$data){
    $fileConfig=APP_BACKUP.$path;
    if(touch($fileConfig)){
        if(is_file($fileConfig)){
            return file_put_contents($fileConfig,json_encode($data,JSON_UNESCAPED_UNICODE));
        }
        return false;
    }
}
function sitemapbackup(){
    $newfile=APP_BACKUP."sitemap_backup_".date("y.m.d").".xml";
    $copyFile=APP_ROOT."sitemap.xml";
    if(copy($copyFile,$newfile)){
       return true; 
    }
    return false;
}

?>