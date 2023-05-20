<?php
require_once __DIR__."/commonMysqlClass.php";
class unitTempEdit extends commonMysql{
    function __construct($userMysql){
        parent::__construct($userMysql);
        $this->table=APP_DATABASENAME.".unitTempEdit";
    }
}
?>