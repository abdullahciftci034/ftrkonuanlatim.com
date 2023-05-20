<?php
require_once __DIR__."/commonMysqlClass.php";
class userLoginBlockedListMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
        $this->table=APP_DATABASENAME.".usersLoginBlockedList";
    }
    public function getBlocked($data){
        $stetmant="SELECT userLoginTry FROM ".$this->table." where userId=:userId";
        return $this->query($data,$stetmant);
    }
    
    # ıd ile güncelleme yaptık
    public function blockedIdUpdate($data){
        $stetmant="UPDATE ".$this->table." set userLoginTry=:userLoginTry  where userId=:userId";
        return $this->query($data,$stetmant);
    }   
   
    ## userların sildi iste username ister email ister id
    public function blockedDelete($data){
        $stetmant="DELETE FROM ".$this->table." where userId = :userId ";
        return $this->query($data,$stetmant);
    }
}

?>