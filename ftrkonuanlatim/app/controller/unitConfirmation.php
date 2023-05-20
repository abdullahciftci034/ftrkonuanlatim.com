<?php
if(oturumControl() and $_SESSION["oturum"]["userRank"]>=2 and @$_SESSION["oturum"]["userActive"]){
    if(emptyArr($_POST)){
        require_once APP_UNIT."unit_funcs.php";
        require_once APP_SITEMAP."createSitemapClass.php";
        require_once APP_MYSQL."unitMysqlClass.php";
        require_once APP_KATEGORILER."kategoriJson.php";
        $sitemapObj=new createSitemap(APP_ROOT."sitemap.xml");
        $kategoriJsonObj=new kategoriJson(APP_KATEGORİLER_JSON);
        $unitObj=new unitMysql("root");
        $data=["id"=>$_SESSION["unitConfirmation"]["id"],"lessonKey"=>$_POST["lessonKey"],"lessonKey1"=>$_SESSION["unitConfirmation"]["lessonKey"],"unitKey1"=>$_SESSION["unitConfirmation"]["unitKey"],"unitTitle"=>$_POST["unitTitle"],"unitContent"=>$_POST["unitContent"],"unitFileLocation"=>$_SESSION["unitConfirmation"]["unitFileLocation"]];
        $result=unitConfirmation1 ($unitObj,$kategoriJsonObj,$sitemapObj,$data);
        if($result["result"]){
            echo $result["error"];
            unset($_SESSION["unitConfirmation"]);
            refreshPage("unitConfirmationListForm");//sayfa yeniledik
        }else{
            error_log_save("unitError.txt",$result);
        }
        $kategoriJsonObj=null;
        $sitemapObj=null;
        $unitObj->connPdo=null;
    }else{
        echo "İçerik veya konu başlığı boş.";
    }
}else{
    require_once __DIR__."/error.php";
}
?>