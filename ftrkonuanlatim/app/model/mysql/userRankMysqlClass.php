<?php
require_once __DIR__."/commonMysqlClass.php";
class userRankMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);;
        $this->table=APP_DATABASENAME.".usersRank";
    }
    #burda bunu sileken altraki userları silmiyoruz.
    public function userRankDeleteUserChange($userMysqlObj,$data){
        if($userMysqlObj->rankValueUpdate($data)){
            if($this->deleteAnd($data)){
                return true;
            }
        }
        return false;
    }
    #burda ise rank valueli sildik ve userlarıda sildik
    public function userRankDeleteUserDelete($userMysqlObj,$data){
        if($userMysqlObj->rankValueOfDelete($data)){
            if($this->deleteAnd($data)){
                return true;
            }
        }
        return false;
    }
}
?>