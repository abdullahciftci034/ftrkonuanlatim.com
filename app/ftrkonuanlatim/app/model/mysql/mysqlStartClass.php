<?php

class mysqlStart{
    function __construct($person , $database = null){
        require_once APP_MYSQL."databaseMysqlClass.php";
        $this->databaseStrutJson=APP_CONFIG."mysql_database_struct.json";
        $this->insertJson=APP_CONFIG."mysql_insert.json";
        $this->databaseObj =new databaseMysql($person,$database);
       
    }

    public function createDB(){
        $statment="CREATE DATABASE ".$this->databaseObj->database;
        return $this->databaseObj->query([],$statment);
    }
    public function json_config_read($path){
        if(is_file($path)){
            return  json_decode(file_get_contents($path,JSON_UNESCAPED_UNICODE));
        }
        return false;
    }
    public function createStruct(){
        $data=$this->json_config_read($this->databaseStrutJson);
        if(!empty($data)){
            foreach($data as $key => $val){
                $this->databaseObj->database=$key;            
                $this->databaseObj->createTableArr($val);
            }
        }
    }
    public function insertMysql(){
        $data=$this->json_config_read($this->insertJson);
        if(!empty($data)){
            foreach($data as $key => $val){
                $this->databaseObj->database=$key;
                $this->databaseObj->tableInsertAll($val);
            }
        }

    } 
}
?>