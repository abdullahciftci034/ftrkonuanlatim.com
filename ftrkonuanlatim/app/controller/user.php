<?php
if(@!empty($data[0])){
    require_once APP_MYSQL."userMysqlClass.php";
    require_once APP_MYSQL."unitMysqlClass.php";
    $userObj=new userMysql("root");
    $user=$userObj->getElementAnd(["id","userDateOfRegistration","userName","userNameVal"],["userName"=>$data[0],"userConfirmation"=>1]);
    $userObj->connPdo=null;
    $varmi=false;
    if(!empty($user) and $user!="1"){
        $user=$user[0];
        $unitObj=new unitMysql("root");
        $list=$unitObj->getElementAnd(["unitKey","unitTitle","unitDateOfRegistration","lessonKey"],["authorUserId"=>"".$user["id"]."","unitConfirmation"=>'1']);
        $unitObj->connPdo=null;
        require_once APP_VIEW."user.php";
    }else{
        echo "<br><div id='info' > Böyle bir kullanıcımız yok.</div><br>";
    }
}else {
    require_once __DIR__."/error.php";
}
?>