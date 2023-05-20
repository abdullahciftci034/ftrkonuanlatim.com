<?php
require_once APP_FUNCS."link_funcs.php";

#############################################################
################### unitte onay kaldırma ###################
function unitDisapprove($unitObj,$sitemapObj,$kategoriObj,$data){
    if($unitObj->updateAnd(["unitConfirmation"=>0],["id"=>$data["id"],"unitKey"=>$data["unitKey1"]])){
        if($kategoriObj->unitDelete($data["lessonKey1"],$data["unitKey1"])){
            if($sitemapObj->linkRemove("https://ftrkonuanlatim.com/unit/".$data["unitKey1"])){
                if($sitemapObj->save() and $kategoriObj->save()){
                    return ["result"=>true,"error"=>"Konu kaldırıldı.","save"=>false];
                }
                $unitObj->updateAnd(["unitConfirmation"=>1],["id"=>$data["id"],"unitKey"=>$data["unitKey1"]]);
                return ["result"=>false,"error"=> __FILE__." kategoriler.json veya sitemap dosyası kaydedilirken hata oluştu.","save"=>true];
            }
            $unitObj->updateAnd(["unitConfirmation"=>1],["id"=>$data["id"],"unitKey"=>$data["unitKey1"]]);
            return ["result"=>false,"error"=>__FILE__." sitemapten link silinemedi link:".$data["lessonKey1"],"save"=>true];
        }
        $unitObj->updateAnd(["unitConfirmation"=>1],["id"=>$data["id"],"unitKey"=>$data["unitKey1"]]);
        return ["result"=>false,"error"=>__FILE__." kategoriler.json bölümünden unitkey kaldırılamadı. unitKey:".$data["lessonKey1"] ,"save"=>true];
    }
    return ["result"=>false,"error"=> __FILE__." databeseden uniconfirmation 0 yapılırken hata oluştu. unitKey:".$data["lessonKey1"] ,"save"=>true];
}

#############################################################
##################  onaylama yaptığımız bölüm ###############
function unitConfirmation1($unitObj,$kategoriJsonObj,$sitemapObj,$data){
    $data["unitKey"]=link_olustur($data["unitTitle"]);
    if(!empty($data["id"])){
        if($data["unitFileLocation"]=="bos" and empty($data["unitContent"])){
            return ["result"=>false,"error"=>"Herhangi bir içerik veya dosya yok.","save"=>false];
        }  
        echo $data["lessonKey1"];
        if($kategoriJsonObj->unitAdd($data["lessonKey"],$data["unitKey"],$data["unitTitle"])){ ##### json ekleme yaptık ####
            if($data["unitFileLocation"]!="bos"){
                $dosyaKonumu=APP_UPLOAD_TEMP.$data["unitFileLocation"];
                $taşınakKonum=APP_UPLOAD_KATEGORILER."/".$data["lessonKey"]."/".$data["unitFileLocation"];
                if(!rename($dosyaKonumu,$taşınakKonum)){##### taşıma yaptık ####
                    return ["result"=>false,"error"=>__FILE__." unitConfirmation1 dosya taşıma hatası.Ders key: ".$data["lessonKey"]." Dosya Adı:". $data["unitFileLocation"],"save"=>true];
                }
            }
            try{
                if( $unitObj->updateAnd(["unitConfirmation"=>true,"lessonKey"=>$data["lessonKey"],"unitKey"=>$data["unitKey"],"unitTitle"=>$data["unitTitle"],"unitContent"=>$data["unitContent"]],["id"=>$data["id"]])){
                    if($sitemapObj->linkAdd("https://ftrkonuanlatim.com/unit/". $data["unitKey"],date("Y-m-d"),"years","0.5")){
                        if($kategoriJsonObj->save() and $sitemapObj->save()){#### sitemap ekelme yaptık ####
                            return ["result"=>true,"error"=>"Paylaşım onaylanmıştır.","save"=>false];
                        }
                        return ["result"=>false,"error"=>__FILE__."unitConfirmation1 fonksiyonunda kategoriler objesi kaydedilemedi Derskey:".$data["lessonKey"]." KonuId:".$data["id"],"save"=>true];    
                    }//burda kontrol
                    return ["result"=>false,"error"=>__FILE__." sitemap ekleme sırasında hata var. fonksiyon: unitConfirmation1, unitKey: ".$data["unitKey"],"save"=>true];
                }
                return ["result"=>false,"error"=>__FILE__." mysql update hatası unitconfirmation1 ","save"=>true];
            
            }catch(PDOException $e){
                return ["result"=>false,"error"=>__FILE__." mysql update hatası ". $e->getMessage() ,"save"=>true];
            }
        }
        return ["result"=>false,"error"=> "Bu başlık daha önce kullanılmış başka bir başlık bulunuz","save"=>false];    
  }
  return ["result"=>false,"error"=> "Onaylamış konuyu böyle düzenleyemessiniz","save"=>false];
}

#########################################
############ kaydetmetmek yaptık #########
function unitRegistration1($unitObj,$kategoriJsonObj,$data){
    if($data["unitFileLocation"]==="bos" and empty($data["unitContent"])){
        return ["result"=>false,"error"=>"Her hangi bir içerik veya dosya yok.","save"=>false];
    } 
    $data["unitKey"]=link_olustur($data["unitTitle"]);
    if(!$kategoriJsonObj->unitSearch($data["lessonKey"],$data["unitKey"]) and $kategoriJsonObj->lessonSearch($data["lessonKey"])) {
        if($unitObj->insert($data)){
           return ["result"=>true,"error"=>"Paylaşımınız alınmıştır. Moderatörler tarafında onaylandıktan sonra yayınlancaktır.","save"=>false];        
        }
        return ["result"=>false,"error"=>"Bu başlık daha önce kullanılmış başka bir başlık yazınız.","save"=>false];
    }
    return ["result"=>false,"error"=> "Bu başlık daha önce kullanılmış başka bir başlık yazınız.","save"=>false];
}


#############################################################
################ konuyu geçici olarka kayıt ettik ############
function unitTempSave($tempSaveObj,$data){
    if($result=$tempSaveObj->getElementAnd(["authorUserId"],["authorUserId"=>$data["authorUserId"]])){ 
        if(!empty($result) and !($result == "1")){
            if($tempSaveObj->updateAnd(["lessonKey"=>$data["lessonKey"],"unitTitle"=>$data["unitTitle"],"unitContent"=>$data["unitContent"]],["authorUserId"=>$data["authorUserId"]])){
                return ["result"=>true,"error"=>"Paylaşımınız düzenlendi. Profil bölümünden tekrar düzenleyebilirsiniz.","save"=>false];
            }
            return ["result"=>false,"error"=>__FILE__."  Geçici kayıtta update yaparken hata oluştu.","save"=>true];
        }
        if($tempSaveObj->insert($data)){
            return ["result"=>true,"error"=>"Paylaşımınız kayıt edildi. Profil bölümünden tekrar düzenleyebilirsiniz..","save"=>false];
        }
        return ["result"=>false,"error"=>__FILE__."  Geçici kayıt yaparken hata oluştu.","save"=>true];
    }
    return ["result"=>false,"error"=>__FILE__." Sorgu hatası","save"=>true];
}
function unitTempEdit($tempEditObj,$data){
    if($tempEditObj->insert($data)){
        return ["result"=>true,"error"=>" Paylaşmınız düzenlendi. Modaratöre tarafından değişiklik onaylandıktan sonra düzenleme işlemi tamamlanacak. Şimdi eski düzenlenmemiş hali paylaşılıyor.","save"=>false];
    }
    return ["result"=>false,"error"=>__FILE__."" ,"save"=>true];
}




#######################################################################
######################### onaylanmamış konuyu sildik ###################
function unitUnapprovedDelete1($unitObj,$data){
    $result=["result"=>true,"error"=>"","save"=>false];
    $girdimi=false;
    if($data["unitFileLocation"] != "bos"){
        if(is_file(APP_UPLOAD_TEMP.$data["unitFileLocation"])){
            if(!unlink(APP_UPLOAD_TEMP.$data["unitFileLocation"])){
                $result=["result"=>false,"error"=>__FILE__." dosya silinemedi. dosya :".$data["unitFileLocation"],"save"=>true];
            }
        }else{
            $result=["result"=>false,"error"=>__FILE__." doysa yok gözüküyor. dosya :".$data["unitFileLocation"],"save"=>true];
        }
    }
    if($unitObj->deleteAnd(["id"=>$data["id"]])){
        if($result["result"]){
            $result=["result"=>true,"Konu silinmiştir.","save"=>false];
        }
    }else{
        $result["error"].=" / ".__FILE__." dosyasından databeseden unit silinmedi.";
        $result["save"]=true;
        $result["result"]=false;
        
    } 
    return $result;
}



###########################################################################
#####################onaylamış konuyu düzenleme yaptık ###################
function update_confirmation($unitObj,$kategoriObj,$sitemapObj,$data){
    
    $data["unitKey"]=link_olustur($data["unitTitle"]);
    if($data["lessonKey"]!=$data["lessonKey1"]){
        if(!$kategoriObj->setLessonKeyUnit($data["lessonKey1"],$data["lessonKey"],$data["unitKey1"])){
            return ["result"=>false,"error"=>__FILE__." lessonKey update yaparken hata oluştu.","save"=>true];
        }
    }
    if($data["unitTitle1"]!=$data["unitTitle"]){
        if(!($kategoriObj->setUnitName($data["lessonKey"],$data["unitKey1"],$data["unitTitle"]))){
            return ["result"=>false,"error"=>__FILE__." unit title güncellerken hata oluştu.","save"=>true];
        }
        if($data["unitKey"]!=$data["unitKey1"]){
            if(!$sitemapObj->setLink(["link"=>"https://ftrkonuanlatim.com/unit/".$data["unitKey1"],"loc"=>"https://ftrkonuanlatim.com/unit/".$data["unitKey"]])){
                return ["result"=>false,"error"=>__FILE__." site  haritası güncellerken hata oluştu.","save"=>true];
            }
            if(!$kategoriObj->setUnitKey($data["lessonKey"],$data["unitKey1"],$data["unitKey"])){
                return ["result"=>false,"error"=>__FILE__." json unitkey  güncellerken hata oluştu.","save"=>true];
            }
        }
    } 
    if($kategoriObj->save() and $sitemapObj->save()){
        if($unitObj->updateAnd(["lessonKey"=>$data["lessonKey"],"unitKey"=>$data["unitKey"],"unitTitle"=>$data["unitTitle"],"unitContent"=>$data["unitContent"]],["id"=>$data["id"]])){
            return ["result"=>true,"error"=>"Konu düzenlendi.","save"=>false];
        }
        return ["result"=>false,"error"=>__FILE__."  Mysql update yaparken hata oluştu.","save"=>true];
    }
    return ["result"=>false,"error"=>" kategori veya sitemap kayıt edilirken hata oluştu ","save"=>true];
    
}



function  update_unpproved($unitObj,$post){
    $newunitKey=link_olustur($post["unitTitle"]);
    if($unitObj->updateAnd(["lessonKey"=>$post["lessonKey"],"unitTitle"=>$post["unitTitle"],"unitContent"=>$post["unitContent"],"unitKey"=>$newunitKey],["id"=>$post["unitId"],"authorUserId"=>$post["authorUserId"]])){
        return ["result"=>true,"error"=>"Konu düzenlendi.","save"=>false];   
    }
    return ["result"=>false,"error"=>__FILE__."  Mysql update yaparken hata oluştu.","save"=>true];
}
?>