<?php
if(oturumControl() and $_SESSION["oturum"]["userRank"]>=2 and $_SESSION["oturum"]["userActive"]){
    require_once APP_MYSQL."unitMysqlClass.php";
    require_once APP_SITEMAP."createSitemapClass.php";
    require_once APP_KATEGORILER."kategoriJson.php";
    require_once APP_UNIT."unit_funcs.php";
    
    $unitObj=new unitMysql("root");
    $kategoriObj=new kategoriJson(APP_KATEGORİLER_JSON);
    $sitemapObj=new createSitemap(APP_ROOT."sitemap.xml");
    /*
    sessiondan 
    eski unitkey
    eski lessonkey
    eski unitTitle
    userId
    

    post ile gelenler
    yeni unitTitle
    yeni lessonKey
    yeni content
    
    */
    $data=["id"=>$_SESSION["unitEdit"]["id"],"lessonKey1"=>$_SESSION["unitEdit"]["lessonKey"],"lessonKey"=>$_POST["lessonKey"],"unitKey1"=>$_SESSION["unitEdit"]["unitKey"],"unitTitle1"=>$_SESSION["unitEdit"]["unitTitle"],"unitTitle"=>$_POST["unitTitle"],"unitContent"=>$_POST["unitContent"]];
    $result=update_confirmation($unitObj,$kategoriObj,$sitemapObj,$data);
    if($result["result"]){
        echo $result["error"];
        unset($_SESSION["unitEdit"]);
        refreshPage("unitConfirmationListForm");//sayfa yeniledik
    }else{
        error_log_save("unitError.txt",$result);
    }
    $unitObj->connPdo=null;
}
?>  