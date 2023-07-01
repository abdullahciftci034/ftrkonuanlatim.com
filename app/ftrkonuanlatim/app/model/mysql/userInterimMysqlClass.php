<?php
require_once __DIR__."/commonMysqlClass.php";
class userInterimMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
        $this->table=APP_DATABASENAME.".usersInterim";
    }
    public function getVerificationNumber($data){
        $stetmant="SELECT verificationCode  FROM ".$this->table." where userId=:userId and userEmail=:userEmail ";
        return $this->query($data,$stetmant);
    }
    
}

?>