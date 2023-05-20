<?php
require_once __DIR__."/commonMysqlClass.php";
class unitMysql extends commonMysql{
    function __construct($mysqlUser){
        parent::__construct($mysqlUser);
        $this->table=APP_DATABASENAME.".unit";
    }
    ## key  ile varmı yok mu kontrol ediyoruz
    public function unitKeyEmpty($data){
        $stetmant="SELECT id FROM ".$this->table." where unitKey= :unitKey";
        return $this->query($data,$stetmant);
    }  
    ## key  ile varmı yok mu kontrol ediyoruz
    public function unitIdEmpty($data){
        $stetmant="SELECT unitKey FROM ".$this->table." where unitKey=:unitKey";
        return $this->query($data,$stetmant);
    }
    #onaylanmış olanların son 10 tanesini gösteriyor
    public function unitApprovedLast10(){
        $stetmant="SELECT unitKey,unitTitle, unitContent FROM ".$this->table." where unitConfirmation=1 order by id desc LIMIT 10";
        return $this->query([],$stetmant);
    }
    #onaylanmamışlarını gösteriyor 
    public function getUnitUnapproved(){
        $stetmant="SELECT unitKey,unitTitle, unitContent FROM ".$this->table." where unitConfirmation=0";
        return $this->query([],$stetmant);
    }
    #onlanmışların son 3'ünü gösteriyor
    public function getUnitApprovedLast3(){
        $stetmant="SELECT unitKey,unitTitle, unitContent FROM ".$this->table." where unitConfirmation=1 order by id desc LIMIT 3";
        return $this->query([],$stetmant);
    } 
    #onaylanmış 
    public function getUnitApproved(){
        $stetmant="SELECT unitKey,unitTitle, id,UnitDateOfRegistration FROM ".$this->table." where unitConfirmation=1 order by id desc LIMIT 10";
        return $this->query([],$stetmant);
    }
    ## lesson key göre bütün unit leri çekme
    public function unitLessonKey($data){  
        $stetmant="SELECT unitKey,unitTitle, id  FROM  ".$this->table." where lessonKey = :lesonKey ";
        return $this->query($data,$stetmant);   
    }
    ## lessonkeyleri aynı olan ların ismi değiştirdik
    public function unitLessonKeyUpdate($data){
        $stetmant="UPDATE ".$this->table." set lessonkey = :newLessonKey where lessonKey=:lessonKey";
        return $this->query($data,$stetmant);
    }
}
?>