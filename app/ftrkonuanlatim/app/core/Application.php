<?php
class Application {
    function __construct() {
        self::commonFileInclude();
        self::parse_url();
        self::getposthtmlspecialchars();        
        $this->method=$this->methodControl();
        $this->route($this->page,$this->data,$this->method);
    }
    #yönlendirme işlemlerini burda yaptık
    private function route($page=null,$data=[],$method=false){
        if(!$method){ ##burda url ile gelen istekler
            if(!empty($page)){
                $phpFile=APP_CONTROLLER.$page.".php";
                if(is_file($phpFile)){
                    require_once APP_CONTROLLER."index.php";
                }else{
                    require_once APP_VIEW."error.php";
                }
            }else{
                require_once APP_CONTROLLER."index.php";
            }
        }else if($method){ ## burda ajax ile gelen istekler
            if(empty($page=@$_GET["page"])){
                if(empty($page=@$_POST["page"])){
                   $page=null;
                }   
            }
            unset($_GET["page"]); ##burda post ve get arraylerini gereksiz olanları boşaltık
            unset($_POST["page"]);
            if(!($page==null)){
                $phpFile=APP_CONTROLLER.$page.".php";
                if(is_file($phpFile)){
                    require_once $phpFile;
                }else{
                    require_once APP_VIEW."error.php";
                }
            }
        }else{
            return false;
        }
    }

    #url işlemleri ile burda bir işlem yaptık
    private function parse_url(){
        $data=explode("/",$_SERVER["REQUEST_URI"]);
        $data=arrEmptyElementDelete($data);
        $data1=explode("/",APP_ROOT1);
        $data1=arrEmptyElementDelete($data1);
        $data=equalsArr($data,$data1);
        $this->page=@$data[0];    
        unset($data[0]);
        $data=arrEmptyElementDelete($data);
        $this->data=$data;
        unset($data);
    }
    
    #burda http ajax isteği varmı kontrol ediyoruz.
    private function methodControl(){
        if(!("ajax" === @$_GET["method"])){
            if(!("ajax" === @$_POST["method"])){
                return false;
            }
            unset($_POST["method"]);
            return true;
            
        }
        unset($_GET["method"]);
        return true;
    }
    #her zaman çağrılacak fonksitonlar
    private function commonFileInclude(){
        require_once APP_FUNCS."security_funcs.php";
        require_once APP_FUNCS."help_funcs.php";
        require_once APP_FUNCS."error_funcs.php";
    }   
    #htmlspecial ve trim fonksyionlarını get ve post methodları üzerinden geçirdik
    private function getposthtmlspecialchars(){            
        $_POST=htmlspecialAndTrim($_POST);
        $_GET=htmlspecialAndTrim($_GET);
    }
}
   
?>