<?php
if(oturumControl() and $_SESSION["oturum"]["userRank"]>=2){
    require_once  APP_MYSQL."unitMysqlClass.php";
    require_once APP_SITEMAP."createSitemapClass.php";
    require_once APP_KATEGORILER."kategoriJson.php";
    require_once APP_UNIT."unit_funcs.php";
    $unitObj=new unitMysql("root");
    $sitemapObj=new createSitemap(APP_ROOT."sitemap.xml");
    $kategoriObj=new kategoriJson("kategoriler.json");
    $data=["id"=>$_SESSION["unitEdit"]["id"],"unitKey1"=>$_SESSION["unitEdit"]["unitKey"],"lessonKey1"=>$_SESSION["unitEdit"]["lessonKey"]];
    $result=unitDisapprove($unitObj,$sitemapObj,$kategoriObj,$data);
    if($result["result"]){
        echo $result["error"];
        refreshPage("unitConfirmationListForm");//sayfa yeniledik
    }else{
        error_log_save("unitError.txt",$result);
    }
    $unitObj->connPdo=null;
    $sitemapObj=null;
    $kategoriObj=null;
}   
?>