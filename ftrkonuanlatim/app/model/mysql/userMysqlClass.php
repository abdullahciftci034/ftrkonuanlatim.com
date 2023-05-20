<?php
require_once __DIR__."/commonMysqlClass.php";
class userMysql extends commonMysql{
    function __construct($mysqlPerson){
        parent::__construct($mysqlPerson);
        $this->table=APP_DATABASENAME.".users";
        $this->hash=" md5(sha( :password )) ";
    }
    ### user ekleme yaptık
    public function insert($data){
        $stetmant="INSERT INTO ".$this->table." (userName , password ,userEmail  ,userNameVal) values (:userName , ".$this->hash." ,:userEmail ,:userNameVal )";
        return $this->query($data,$stetmant);
    }

    #and  ile güncelleme yaptık
    public function userUpdateAnd($data,$select){
        $stetmant="UPDATE ".$this->table." SET ";
        $i=0;
        foreach ($data as $key => $val){
            if ($i==0){
                if($key=="password"){
                    $stetmant.= "$key =".$this->hash ." ";
                }else{
                    $stetmant.= "$key =:$key ";
                }
                
                $i++;
            }else{
                if($key=="password"){
                    $stetmant.=", $key =".$this->hash." ";
                }
                $stetmant.= " , $key =:$key ";
            }
        }
        $stetmant .=" where ";
        $i=0;
         foreach ($select as $key => $val){
            if ($i==0){
            $stetmant.= " $key =:$key ";
                $i++;
            }else{
                $stetmant.= " and $key =:$key ";
            }
        }
        $data=array_merge($select,$data);
        return  $this->query($data,$stetmant);
    }
    #or ile update ettik
    public function userUpdateOr($data,$select){
        $stetmant="UPDATE ".$this->table." SET ";
        $i=0;
        foreach ($data as $key => $val){
            if ($i==0){
                if($key=="password"){
                    $stetmant.= "$key =".$this->hash ." ";
                }else{
                    $stetmant.= "$key =:$key ";
                }
                
                $i++;
            }else{
                if($key=="password"){
                    $stetmant.=", $key =".$this->hash." ";
                }
                $stetmant.= " , $key =:$key ";
            }
        }
        $stetmant .=" where ";
         foreach ($select as $key => $val){
            if ($i==0){
            $stetmant.= " $key =:$key ";
                $i++;
            }else{
                $stetmant.= " or $key =:$key ";
            }
        }
        $data=array_merge($select,$data);
        return  $this->query($data,$stetmant);
    }

   
    public function getUserUnitForm(){
        $stetmant="SELECT id,userName,userNameVal FROM ".$this->table;
        return $this->query([],$stetmant);
    }
    public function getUserId($data){
        $stetmant="SELECT id,userName,userNameVal FROM ".$this->table." where id = :id " ;
        return $this->query($data,$stetmant);
            
    }
    public function  getUserReturnId($data){
        $stetmant="SELECT id FROM ".$this->table." where userName=:userName ";
        return $this->query($data,$stetmant);
            
    }
   
    #kullanıcının password kontorlünü yapar
    public function userPasswordControl($data){
        $stetmant="SELECT IF (".$this->hash." = :kayitliPassword,1,0)";         
        return $this->query($data,$stetmant);
    }
} 

?>
