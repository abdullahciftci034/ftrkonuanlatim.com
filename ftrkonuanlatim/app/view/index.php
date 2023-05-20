<!DOCTYPE html>
<html lang="tr">
    <head>
        <title>FTR</title>
        <meta charset="utf-8">
        <meta  name="description" content="Fizik Tedavi ve Rehabiltasyon,FTR,Rehabiltasyon">
        <meta name="FTR,Rehabiltasyon,fizik,Tedavi,ftrkonuanlatim,ftrkonuanlatim.com,fizyoterapist,Fizik tedavi">   
        <meta name="viewport" content="width=device-width ,initial-scala=1,maximum-scala=1" >
<?php

     echo ' <script type="text/javascript">
                //yonlendirme dosyası
                var router="'.APP_ROOT1.'index.php";
                var root="'.APP_ROOT1.'";
            </script>
            <link rel="stylesheet" type="text/css" href="'.APP_PUBLIC1.'css_file/bootstrap_lib_css/bootstrap.min.css">  
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery_lib_js/jquery-3.4.1.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery_lib_js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/bootstrap_lib_js/popper.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/bootstrap_lib_js/popper1.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/bootstrap_lib_js/bootstrap.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/bootstrap_lib_js/bootstrap1.min.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery_lib_js/jquery-1.7.1.min.js"></script>  
            <link rel="stylesheet" type="text/css" href="'.APP_PUBLIC1.'css_file/base_css/index.css">
            <link rel="stylesheet" type="text/css" href="'.APP_PUBLIC1.'css_file/base_css/kategoriler.css">
            <link rel="stylesheet" type="text/css" href="'.APP_PUBLIC1.'css_file/base_css/guncelPaylasimlar.css">
            <link rel="stylesheet" type="text/css" href="'.APP_PUBLIC1.'css_file/base_css/paylasimlar.css">
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery/index_jquery.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery/kategoriler_jquery.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery/paylasimlar_jquery_ajax.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery/paylasimlar_jquery.js"></script>
            <script type="text/javascript" src="'.APP_PUBLIC1.'js_file/jquery/unit_jquery.js"></script>
            ';
?>
    </head>
    <body> 
        <header>
        <div  id="kategoriler2">
                <div class="row" style="height:30px; width:24px">
                    <div id="kategoriler2">
                        <div id='ucNokta_baslangic'>
                            <div id='ucNokta'>
                                <div id="ucNokta_bosluk"></div>
                                <div id='ucNokta_cizgi'></div>
                                <div id='ucNokta_cizgi'></div>
                                <div id='ucNokta_cizgi'></div>       
                            </div>
                            <div id='ucNokta_gorunecekOge'>
                                <div id="kategoriler"></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="baslik"><h2><i>Fizik Tedavi ve Rehabilitasyon</i></h2></div>
            <div class="description">Burada fizik tedavi ve rehabilitasyon ders notları paylaşılıcaktır.</div>
        </header>
        <nav>
            <div class="container">   
                <div class="row"> 
                    <div id="ust_taraf" class="col">
                        <a id="ust_tarafA" href="#" name='anasayfa'>Anasayfa</a>
                    </div >
                    <div id="ust_taraf" class="col">
                        <a id="ust_tarafA" href="#" name="paylasimlar">Paylaşımlar</a>
                    </div>
                    <?php
                    if(!oturumControl()){
                        
                        echo 
                        '<div id="ust_taraf" class="col">
                            <a id="ust_tarafA" href="#" name="userRegistrationForm">Kayıt Ol</a>
                        </div>
                        <div id="ust_taraf" class="col">
                            <a id="ust_tarafA" href="#" name="userLoginForm">Giriş</a>
                        </div>';
                    }else{
                        
                        if(!@$_SESSION["oturum"]["userConfirmation"]){
                            echo '
                            <div id="ust_taraf" class="col">
                                <a id="ust_tarafA" href="#" name="userConfirmationForm">Kullanıcı Doğrulama</a>
                            </div>';
                        }else{
                            if($_SESSION["oturum"]["userRank"] >= 2){
                                echo
                                '<div id="ust_taraf" class="col">
                                    <a id="ust_tarafA" href="#" name="unitConfirmationListForm">Konuları Düzenle</a>
                                </div>'; 
                            }
                            
                            echo '
                            <div id="ust_taraf" class="col">
                                <a id="ust_tarafA" href="#" name="unitRegistrationForm">Paylaşım Yap</a>
                            </div>
                            <div id="ust_taraf" class="col">
                                <a id="ust_tarafA" href="#" name="userProfil">Profil</a>
                            </div>';
                        }
                        echo '
                        <div id="ust_taraf" class="col">
                            <a id="ust_tarafA" href="#" name="exit">ÇIKIŞ</a>
                        </div>
                        ';
                    }

                    
                    
                    ?>
                    
                   <!-- <div id="ust_taraf" class="col">
                        <a id="ust_tarafA" href="#" name="hakkimda">Hakkımda</a>
                    </div>
-->
                </div>
            </div>
        </nav>
        <div class="container-fluid section_aside">
            <div class="row">
                <div class="col-xl-1 col-lg-0 "></div>
                <section class="col-xl-7 col-lg-8 col-md-9">
                    <div class="ana_hat">
                        <div class= "section_anahat">
                        <?php
                            #burada sayfalarımız bir istekle çağırdık
                            if(!$method){
                                if(!empty($page) and $page !="index" and $page !="anasayfa" ){
                                    require_once APP_CONTROLLER.$page.".php";
                                }else{
                                    require_once __DIR__."/index2.php";
                                }
                            }
                        ?>
                        </div>
                    </div>
                </section>
                <aside class="col-xl-3 col-lg-4 col-md-3">
                    <div class="ana_hat">
                        <div id="kategoriler1">
                            <div  id="kategoriler">       
                            </div>
                        </div>
                        <hr>
                        <h2>Güncel Paylaşımlar</h2>
                        <div id="guncelPaylasimlar">
                        </div>
                        <br>
                        <a href="<?php echo APP_ROOT1."paylasimlar"; ?>"><h5 style="color:black;">Daha fazlası için tıkla</h5></a>
                     </div>   
                </aside>
                <div class="col-xl-1 col-lg-0 col-md-0 "></div>
            </div>
        </div>
        <footer class="container"> 
            <div class="ana_hat">
            </div>
        </footer>
    </body>
</html>