<?php
require_once __DIR__."/commonMysqlClass.php";
class mysqlProgress extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
    }
    public function createDatabese($data){
        $stetmant="CREATE DATABASE  :databaseName";
        return $this->query($data,$stetmant);
    }
    public function createUser($data){
        $stetmant="CREATE USER :userName@'localhost' IDENTIFIED BY :userPassword";
        return $this->query($data,$stetmant);
    }
    public function adminYetki($data){
        $stetmant="GRANT ALL ON :databaseName.* TO ':userName'@'localhost'";
        return $this->query($data,$stetmant);
    }
    public function deleteDatabase($data){

    }
    public function apply(){
        $stetmant="FLUSH PRIVILEGES";
        return $this->query([],$stetmant);
    }
}
?>