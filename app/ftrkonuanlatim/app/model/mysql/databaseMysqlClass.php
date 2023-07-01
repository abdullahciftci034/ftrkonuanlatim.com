<?php
require_once __DIR__."/commonMysqlClass.php";
class databaseMysql extends commonMysql{
    function __construct($mysqlPerson,$database = null){
        parent::__construct($mysqlPerson);
        if(!empty($database)){
            $this->database=$database;
        }
    }
    
    #tablo isimlerinin  hepsini döndürdük
    public function getTablesNames(){
        $stetmant ="SHOW TABLES";
        $data=$this->query([],$stetmant);
        $arr=[];
        $i=0;
        foreach($data as $key => $val ){
            $i=0;
            foreach($val as $key1 => $val1 ){
                if("$i"=="$key1"){
                    $i++;       
                }else{
                    array_push($arr,$val1);
                }
            }
        }
        return $arr;
    }
    ## normal tablo oluşturduk
    public function createTable($data){
        $stetmant="CREATE TABLE ".$this->database.".$data";
        return $this->query([],$stetmant);
    }
    # tablo sildik
    public function deleteTable($data){
        $stetmant="DROP TABLE ".$this->database.".$data";
        return $this->query([],$stetmant);
    }
    #burada otomatik tablolar oluşturuldu.
    public function createTableArr($tableArr){
        $stetmant="";
        $data=[];
        foreach ($tableArr as $key => $val){
            $stetmant="CREATE TABLE ".$this->database.".$key ".$val;
            if($this->query($data,$stetmant)){
                echo "$key table oluşturuldu.<br>";
            }else{
                echo "$key table oluşturulamadı.<br>";
            }
        }
    }
    #tablo arr alarak sildik
    function deleteTableArr($tableArr){
        $stetmant="";
        $data=[];
        $tableArr=array_reverse((array)$tableArr);
        foreach ($tableArr as $key => $val){
            $stetmant="DROP TABLE ".$this->database.".$key";
            if($this->query($data,$stetmant)){
                echo "$key table silindi.<br>";
            }else{
                echo "$key table silinemedi.<br>";
            }
        }
    }
    #user bölümüne bir array ile ekleme yaptık
    public function tableInsertArr($data,$table){
        $stetmant="";
        $stetmant1="";
        $stetmant2="";
        $i=0;
        foreach($data as $key => $val){
            $stetmant="";
            $stetmant1="";
            $stetmant2="";
            $i=0;           
            foreach($val as $key1=> $val1){
                if($i==0){
                    $stetmant1.=" $key1 ";
                    $stetmant2 .=" :$key1 ";
                    $i++;
                }else{
                    $stetmant1.=", $key1 ";
                    $stetmant2.=", :$key1 ";
                }   
            } 
            $stetmant="INSERT INTO ".$this->database.".".$table." ( $stetmant1 ) values ( $stetmant2 ) ";
            if($this->query((array)$val,$stetmant)){
                echo "$table verisi eklendi.<br>";
            }else{
                echo "$table verisi eklenemedi.<br>";
            }
        }
    }
    # user bölümü obje olarak geri döndürdük
    public function getTableObject($table){
        $stetmant="SELECT * FROM ".$this->database.".".$table;
        $data=$this->query([],$stetmant);
        $obj=[];
        $obj1=[];
        $i=0;
        if(!empty($data[0])){
            foreach($data as $key => $val){
                $i=0;
                $obj1=[];
                foreach($val as $key1 => $val1 ){
                   if("$i"=="$key1"){
                        $i++;
                    }else{
                        $obj1[$key1]=$val1;
                   }
                }
                array_push($obj,(object)$obj1);
            }
            return (object)$obj;
        }
        return (object)[];
        
    }
   
   

    #mysqdeki bütün verileri çektik
    public function getTableObjectAll($data){
        $finalArr=[];
        foreach($data as $key => $val){
            $finalArr[$val]=$this->getTableObject($val);
        }
        return (object)$finalArr;
    }  

    
    ## bütün tablolardaki verileri çektik obje olarak yaptık
    public function getMysqlObjectAll(){
        return $this->getTableObjectAll($this->getTablesNames());
    }
     # burda bütün verileri ekledik
    public function tableInsertAll($data){
        foreach($data as $key => $val){
            $this->tableInsertArr($val,$key);
        }
    }





    /*
    #################################################################
    ######################### burası kullanılmıyor ##################
    public function reNameDatabase($data){
        
    }
    public function reNameTable($data){
        $stetmant="RENAME TABLE ".$this->database.".:old_table TO :new_table";
        return $this->query($data,$stetmant);
    }
   #mysql foksiyonlarını otomatik oluşturduk
   public function insertFuncs($insertArr){
        $stetmant="";
        foreach ($insertArr as $key => $val){
            foreach($val as $key1 => $val1){
                $stetmant="CREATE FUNCTION ".$this->database.$val1;
                if($this->query([],$stetmant)){
                    echo $key1." fonksiyonu eklendi.<br>";
                }else{
                    echo $key1." fonksiyonu eklenemedi.<br>";
                }
            }
        }
    }
    ## bir tane fonksiyon siler
    function deleteFunc($data){
        $stetmant="DROP FUNCTION ".$this->database.":functionName";
        return $this->query($data,$stetmant);
    }
    #mysql bir arr şeklinde fonksiyon siler 
    function deletefuncsArr($deleteArr){
        $stetmant="";
        foreach ($deleteArr as $key => $val){
            foreach($val as $key1 => $val1){
                $stetmant="DROP FUNCTION ".$this->database.".".$key1;
                if($this->query([],$stetmant)){
                    echo $key1." fonksiyonu silindi.";
                }else{
                    echo $key1." fonksiyonu silinemedi.";
                }
            }
        }
    } */
}
?>