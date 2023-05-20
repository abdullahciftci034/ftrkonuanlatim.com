<?php   
require_once __DIR__."/../funcs/config_funcs.php";
class kategoriJson{
    function __construct($path){
        $this->data= null;
        $this->path=$path;
        $this->json_dosya_oku();
    }
    #burda okuma işlemi ve kontrol işlemi yaptık
    public function json_dosya_oku(){
        $data=json_config_read($this->path);
        if($data){
            $this->data=$data;
        }
    }
    #key verilen dersi aradık
    public function lessonSearch($lesson_key){
        if(!empty(@$this->data->{$lesson_key})){
            return true;
        }
        return false;
    }

    #bütün ders isimlerimi döndürdük
    public function getLessonNamesArr(){
        $finalArr=[];
        foreach($this->data as $val){
            array_push($finalArr,$val->{"lesson_name"});
        }    
        return $finalArr;
    }

    #bütün ders keylerini döndürdük
    public function getLessonKeysArr(){
        $finalArr=[];
        foreach($this->data as $key => $val){
            array_push($finalArr,$key);
        }    
        return $finalArr;
    }

    #bütün keylerle beraber isimleri döndürdük
    public function getLessonKeysNamesArr(){
        $finalArr=[];
        foreach($this->data as $key => $val){
            $finalArr[$key]=$val->{"lesson_name"};
        }    
        return $finalArr;
    }

    #konu keylerine göre arama yaptık aradık
    public function unitSearch($lesson_key,$unit_key){
        if($this->lessonSearch($lesson_key)){
            if(!empty(@$this->data->{$lesson_key}->{"units"}->{$unit_key})){
                return true;
            }
            return false;    
        }
        return false;
    }

    # konuların key ve isimlerini döndürdük
    public function getUnitKeysNamesArr($lesson_key){
        if($this->lessonSearch($lesson_key)){
            return $this->data->{$lesson_key}->{"units"};
        }
        return false;
    }

    #konuların keylerini alsdık
    public function getUnitKeysArr($lesson_key){
        $data=$this->getUnitKeysNamesArr($lesson_key);
        if($data){
            $finalArr=[];
            foreach($data as $key => $val){
                array_push($finalArr,$key);
            }
            return $finalArr;
        }
        return false;
    }

    #konuların isimlerini döndürdük
    public function getUnitNamesArr($lesson_key){
        $data=$this->getUnitKeysNamesArr($lesson_key);
        if($data){
            $finalArr=[];
            foreach($data as $val){
                array_push($finalArr,$val);
            }
            return $finalArr;
        }
        return false;
    }

    #ders ekleme işlemi yaptık
    public function lessonAdd($lesson_key,$lesson_name){
        if(!$this->lessonSearch($lesson_key)){
            $data = (object)["lesson_name" => $lesson_name,"units"=>(object)["oneri"=>"Öneri"]];
            $this->data->{$lesson_key}=$data;
            return true;
        }   
        return false;
    }

    #ders silme işlemi yaptık
    public function lessonDelete($lesson_key){
        if($this->lessonSearch($lesson_key)){
            unset($this->data->{$lesson_key});
            return true;
        }
        return false;
    }

    #dersin keyini güncelledik
    public function setLessonKey($lesson_key,$set_key){
        if($this->lessonSearch($lesson_key)){
            $data=$this->data->{$lesson_key};
            unset($this->data->{$lesson_key});
            $this->data->{$set_key}=$data;
            return true;
        }
        return false;
    }
    
    #dersin isimini güncelledik
    public function setLessonName($lesson_key,$set_name){
        if($this->lessonSearch($lesson_key)){
            $this->data->{$lesson_key}->{"lesson_name"}=$set_name;
            return true;
        }
        return false;
    }

    #konu ekleme yaptık
    public function unitAdd($lesson_key,$unit_key,$unit_name){
       
        if(!$this->unitSearch($lesson_key,$unit_key) and $this->lessonSearch($lesson_key)){    
            
            $this->data->{$lesson_key}->{"units"}->{$unit_key}=$unit_name;
            
            return true;
        }
        return false;   
    }

    # konu silme işlemi
    public function unitDelete($lesson_key,$unit_key){
        if($this->unitSearch($lesson_key,$unit_key)){
            unset($this->data->{$lesson_key}->{"units"}->{$unit_key});
            return true;
        }
        return false;
    }
    
    #konu keyini güncelledik
    public function setUnitKey($lesson_key,$unit_key,$set_key){
        if($this->unitSearch($lesson_key,$unit_key) and $this->lessonSearch($lesson_key)){    
            $data=$this->data->{$lesson_key}->{"units"}->{$unit_key};
            unset($this->data->{$lesson_key}->{"units"}->{$unit_key});
            $this->data->{$lesson_key}->{"units"}->{$set_key}=$data;
            return true;
        }
        return false;   
    }

    #konu isimlerini güncelledik 
    public function setUnitName($lesson_key,$unit_key,$set_name){
       
        if($this->unitSearch($lesson_key,$unit_key)){    
            
            $this->data->{$lesson_key}->{"units"}->{$unit_key}=$set_name;
            return true;
        
        }
        return false;   
    }

    # bir konunun  dersini değiştirdik
    public function setLessonKeyUnit($lesson_key,$new_lesson_key,$unit_key){
        $result=$this->lessonSearch($lesson_key) and $this->lessonSearch($new_lesson_key) and $this->unitSearch($lesson_key,$unit_key);
        if($result){
            $data=$this->data->{$lesson_key}->{"units"}->{$unit_key};
            unset($this->data->{$lesson_key}->{"units"}->{$unit_key});
            $this->data->{$new_lesson_key}->{"units"}->{$unit_key}=$data;
            return true;    
        }
        return false;
    }
    
    #kayıt işlemi yaptık
    public function save(){
        if(json_config_write($this->path,$this->data)){
            return true;
        }
        return false;
    }
}
?>