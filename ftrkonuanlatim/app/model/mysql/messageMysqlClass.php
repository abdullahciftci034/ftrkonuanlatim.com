<?php
require_once __DIR__."/commonMysqlClass.php";
class messageMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
        $this->table=APP_DATABASENAME.".message";
    }
    public function getMessageUnitMessageLast($data){
        $stetmant="SELECT * FROM ".$this->table." where unitId=:unitId and messageId=:messageId ORDER BY id DESC ";
        return $this->query($data,$stetmant);
    }
}
?>