<?php
require_once __DIR__."/commonMysqlClass.php";
class lessonMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
        $this->table=APP_DATABASENAME.".lesson";
    }
    
    ## burda lesson keyi değiştirdik yapılan önce bütün bağlı ünitleri geçici lessonkey atadık sonra lessonkeyemizi update ettik sonra update ettiğimiz lesson keye taşıdık
    public function lessonKeyUpdate($lessonArr,$unitMysqlObj){
        $tempLessonKey=$lessonArr["lessonKey"]."1";
       if($this->insert(["lessonKey"=>$tempLessonKey,"lessonName"=>"bso"])){
           echo "girdi";
            if($unitMysqlObj->unitLessonKeyUpdate(["newLessonKey"=>$tempLessonKey,"lessonKey"=>$lessonArr["lessonKey"]])){
                $stetmant="UPDATE ".$this->table." set lessonKey = :newLessonKey  where  lessonKey = :lessonKey ";
                if($this->query($lessonArr,$stetmant)){
                    if($unitMysqlObj->unitLessonKeyUpdate(["newLessonKey"=>$lessonArr["newLessonKey"],"lessonKey"=>$tempLessonKey])){
                        $this->deleteAnd(["lessonKey"=>$tempLessonKey]);
                        echo "";
                        return true;
                    }
                }   
            }
            $this->deleteAnd(["lessonKey"=>$tempLessonKey]);
        }
        
        return false;
    }
    
    #lessonu sildik
    public function lessonDelete($data,$unitMysqlObj){
        if($unitMysqlObj->unitLessonDelete($data)){
            if( $this->deleteAnd($data)){
                return true;
            }
        }
        return false;
    }
    # bütün lessonları silerken bağlı ünitleri taşıdık
    public function lessonDeleteUnitUndelete($data,$unitMysqlObj){
        if($unitMysqlObj->unitLessonKeyUpdate($data)){
           if( $this->deleteAnd(["lessonKey"=>$data["lessonKey"]])){
               return true;
           }
        }
        return false;
    }


    # bütün lessonkeyleri çektik
    public function getLessonKeys(){
        $stetmant="SELECT lessonKey FROM ".$this->table; 
        if($sorgu=$this->query([],$stetmant)){
            return $sorgu;
        }
        return false;
    }
    #bütün lesson nameleri çektik
    public function getLessonNames(){
        $stetmant="SELECT lessonName FROM ".$this->table; 
        return $this->query([],$stetmant);
    }
}

?>