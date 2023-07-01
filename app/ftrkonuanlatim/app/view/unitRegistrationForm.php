<?php
    # editor gereksininzi olan css kodlarını  dahil ettik
    echo '<script type="text/javascript" src="'.APP_PUBLIC1.'html_editor/quill.min.js"></script>';
    echo "<link rel='stylesheet' href='".APP_PUBLIC1."html_editor/quill.snow.css'/>";
?>

<div id="paylasim_yap">
    <div id="islemler" style="float:right; margin-top: 5px; margin-right: 25px; margin-bottom: 5px;" >
        <button name="preview" style="background-color:rgb(191, 217, 236); border: 1px rgb(118, 118, 118);  font-weight:600; margin: auto; ">Ön İzleme</button>
        <button name="tempSave" style="background-color:rgb(191, 217, 236); border: 1px rgb(118, 118, 118);  font-weight:600; margin: auto; ">Kaydet</button>        
    </div>
    <label for="content" style="margin-left:20px; font-size: 18px;  font-weight: 500;">İçerik</label>
        <div id="standalone-container" style="width:95%; margin:auto;">
        <div id="toolbar-container">
            <span class="ql-formats">
            <select class="ql-font"></select>
            <select class="ql-size"></select>
            </span>
            <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
            </span>
            <span class="ql-formats">
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
            </span>
            <span class="ql-formats">
            <button class="ql-header" value="1"></button>
            <button class="ql-header" value="2"></button>
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
            </span>
            <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
            </span>
            <span class="ql-formats">
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
            </span>
            <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
            <button class="ql-formula"></button>
            </span>
            <span class="ql-formats">
            <button class="ql-clean"></button>
            </span>
        </div>
        <div id="editor-container" style="background-color: white;" name="content-icerik"></div>
    </div>
    <form  id="paylasim_yap_form" action="<?php echo APP_ROOT1; ?>index.php" method="POST" enctype="multipart/form-data">
        <label for="content">İçerik</label>
        <?php
            # bizim tarafımızdan onaylanmış olan kullanıcılara dosya yükleme izni verdik
            if(@$_SESSION["oturum"]["userActive"]){
                echo '
                <label for="file">Dosya</label>
                <input type="file" name="file">
                ';
            }
        ?>
        <br>
        <label for="unitTitle">Konu Başlığı</label>
        <br>
        <input type="text" name="unitTitle" value="<?php if(is_array(@$_SESSION["unit"])){ echo @$_SESSION["unit"]["unitTitle"]; }  ?>" placeholder="Konu başlığı">
        <br>
        <label for="lessonKey">Ders Seçin</label>
        <br>
        <select name="lessonKey">
            <?php
                foreach($lessonKeysNames as $key => $val){
                    if( @$_SESSION["unit"]["lessonKey"]===$key){
                        echo"<option value='".$key."' selected>".$val."</option>";
                    }else{
                        echo"<option value='".$key."'>".$val."</option>";
                    }
                }
            ?>
        </select>
        <br>
        <div id="button">
            <button type="submit">Gönder</button>   
        </div>
    </form>
</div>
<div id="response">
    <div id="info"></div>
    <div id='info1'><?php sessionUnitRegistration(@$_SESSION["unit"]); ?></div>
</div>
<script>
    //session değerinizden gelen paylaşımın içeriği
    var content=$("div#unitContentPart div#content").html();
    // yeni editor oluşturduk genel ayarla böyle olucak
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: '#toolbar-container'
        } ,theme: 'snow'
    });

    //ajax işlemlerimiz
    $(function(){
        $("form#paylasim_yap_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);
            var data=new FormData(obje[0]);
            content = $("div[name=content-icerik] div.ql-editor").html();
            data.append("unitContent",content);
            data.append("method","ajax");
            data.append("page","unitRegistration");
            $.ajax({
                url:obje.attr("action"),
                type: obje.attr("method"),
                data:data,
                contentType:false,
                processData:false,
                success:function(data) {
                    $("div#info").html(data);
                    data=$("div#unit_text").html();
                    $("div#unit_text").html("");
                    $("div#info1").html(data);
                },error:function(data){
                    $("div#info").html(data);
                }
            });
        });
        $("div#islemler button[name=preview]").click(function(){
            var obje=$("form#paylasim_yap_form");
            var data=new FormData(obje[0]);
            content = $("div[name=content-icerik] div.ql-editor").html();
            data.append("unitContent",content);
            data.append("method","ajax");
            data.append("page","unitPreview");
            $.ajax({
                url:obje.attr("action"),
                type: obje.attr("method"),
                data:data,
                contentType:false,
                processData:false,
                success:function(data) {
                    $("div#info").html(data);
                    data=$("div#unit_text").html();
                    $("div#unit_text").html("");
                    $("div#info1").html(data);
                },error:function(data){
                    $("div#info").html(data);
                }
            });
        });
        //geçici olarak kayıt ediyoru<
        $("div#islemler button[name=tempSave]").click(function(){
            var obje=$("form#paylasim_yap_form");
            var data=new FormData(obje[0]);
            content =$("div[name=content-icerik] div.ql-editor").html();
            data.append("unitContent",content);
            data.append("method","ajax");
            data.append("page","unitTempSave");
            $.ajax({
                url:obje.attr("action"),
                type: obje.attr("method"),
                data:data,
                contentType:false,
                processData:false,
                success:function(data) {
                    $("div#info").html(data);
                    data=$("div#unit_text").html();
                    $("div#unit_text").html("");
                    $("div#info1").html(data);
                },error:function(data){
                    $("div#info").html(data);
                }
            });
        });
    }); 

    //sessiondan içeriği buraya yazdırdık
    document.querySelector("#editor-container div.ql-editor").innerHTML=content;
</script>
<style type="text/css"> 
    div#paylasim_yap{
        margin: auto;
    }
    form#paylasim_yap_form{
        margin: auto;
        width:95%;
        text-align: left;
    }
    form#paylasim_yap_form label{
        text-align:left;
        margin-bottom: 7px;
        font-size: 18px;
        font-weight: 500;    
    }
    form#paylasim_yap_form textarea{
        width: 100%;
        height: 500px;
    }
    form#paylasim_yap_form input{    
        width:100% ;
        margin-bottom:10px;
    }
    form#paylasim_yap_form select{    
        width:100% ;
        margin-bottom:7px;
    }
    form#paylasim_yap_form div#button{
        text-align: center;
    }
    form#paylasim_yap_form button{
        font-weight: 700;
        width: 80%;
        background-color:rgb(191, 217, 236);
        height: 30px;
        border: 1px rgb(118, 118, 118);
        font-size: 16px;
        margin-bottom:7px;
    }
    form#paylasim_yap_form input[ss="son"]{
        margin-bottom: 15px;
        font-size: 15px;
        height: 25;
    }
    div#paylasim_yap{
        width: 100%;
        background-color: rgb(234, 236, 241);
        border:solid 1px rgb(118, 118, 118);
    }

    body > #standalone-container {
        margin: 50px auto;
        max-width: 720px;
    }
    #editor-container {
        height: 600px;
        min-height: 400px;
        max-height: 1000px;
    }

  /* paylasim bölümü css kodları */
   div#unitContentPart{
        font-size: 14px;
        word-break: break-all;
        overflow: hidden;
    }
     div#unitContentPart::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
     div#unitContentPart div#title{
        margin:auto;
        text-align: center;
        font-size: 23px;
        font-weight: 500;
        margin-top: 12px;
        margin-bottom: 12px;
    }
     div#unitContentPart div#content p{
        font-size: 14px;
        margin-top: 2.5px;
        margin-bottom: 2.5px;
    }
     div#unitContentPart div#content h1, .ql-size-huge{
        font-size: 19px;
        font-weight: 500;
    }
     div#unitContentPart div#content h2 ,.ql-size-large{
        font-size: 17px;
        font-weight: 500;
    }
     div#unitContentPart div#content h3{
        font-size: 15px;
        font-weight: 500;
    }
     div#unitContentPart div#content h4{
        font-size: 13px;
        font-weight: 500;
    }
     div#unitContentPart div#link a{
        font-size: 16px;
    }

    @media screen and (max-width:1100px){
         div#unitContentPart div#content p{
            font-size: 12px;
        }
         div#unitContentPart div#content  h1, .ql-size-huge{
            font-size: 17px;
            font-weight: 500;
        }
         div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 15px;
            font-weight: 500;
        }
         div#unitContentPart div#content h3{
            font-size: 13px;
            font-weight: 500;
        }
         div#unitContentPart div#content h4{
            font-size: 11px;
            font-weight: 500;
        }
    }
   
    @media screen and (max-width:768px){
         div#unitContentPart div#content p{
            font-size: 10px;
        }
         div#unitContentPart div#content  h1, .ql-size-huge{
            font-size: 16px;
            font-weight: 500;
        }
         div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 14px;
            font-weight: 500;
        }
         div#unitContentPart div#content h3{
            font-size: 12px;
            font-weight: 500;
        }
         div#unitContentPart div#content h4{
            font-size: 10px;
            font-weight: 500;
        }
    }
    @media screen and (max-width:576px){
         div#unitContentPart div#content p{
            font-size: 9px;
        }
         div#unitContentPart div#content  h1, .ql-size-huge{
            font-size: 15px;
            font-weight: 500;
        }
         div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 13px;
            font-weight: 500;
        }
         div#unitContentPart div#content h3{
            font-size: 11px;
            font-weight: 500;
        }
         div#unitContentPart div#content h4{
            font-size: 9px;
            font-weight: 500;
        }
    }
   
    @media screen and (max-width:300px){
         div#unitContentPart div#content p{
            font-size: 8px;
        }
         div#unitContentPart div#content  h1, .ql-size-huge{
            font-size: 14px;
            font-weight: 500;
        }
         div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 12px;
            font-weight: 500;
        }
         div#unitContentPart div#content h3{
            font-size: 10px;
            font-weight: 500;
        }
         div#unitContentPart div#content h4{
            font-size: 8px;
            font-weight: 500;
        }
    }     
</style>
