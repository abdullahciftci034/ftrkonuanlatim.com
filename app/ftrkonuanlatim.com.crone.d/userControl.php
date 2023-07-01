<?php
function userControl(){
    require_once APP_MYSQL."userMysqlClass.php";
    require_once APP_MYSQL."userInterimMysqlClass.php";
    $interimObj=new userInterimMysql("root");
    $userObj=new userMysql("root");
    $interimArr=$interimObj->getElementAllColumn(["id","userId","dateOfDeletion"]);
    if(!empty($interimArr) and $interimArr!="1"){
        foreach ($interimArr as $key => $val ){
            if(timeControl($val["dateOfDeletion"])){
                $userObj->deleteAnd(["id"=>$val["userId"]]);
            }
        }
    }
    $userObj->connPdo=null;
    $interimObj->connPdo=null;
}
function timeControl($time){
    return date("Y-m-d H:i:s") > date($time);
}
?>