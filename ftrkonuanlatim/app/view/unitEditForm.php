<?php
    # editor gereksininzi olan css kodlarını  dahil ettik
    echo "<link rel='stylesheet' href='".APP_PUBLIC1."html_editor/quill.snow.css'/>";
    echo '<script type="text/javascript" src="'.APP_PUBLIC1.'html_editor/quill.min.js"></script>';
?>
<div id="editing">
    <div id="islemler" style="float:right; margin-top: 5px; margin-right: 25px; margin-bottom: 5px;" >
        <button name="disapprove" style="background-color:rgb(191, 217, 236); border: 1px rgb(118, 118, 118);  font-weight:600; margin: auto; ">Onay Kaldır</button>        
        <button name="preview" style="background-color:rgb(191, 217, 236); border: 1px rgb(118, 118, 118);  font-weight:600; margin: auto; ">Ön İzleme</button>
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
    <form  id="editing_form" action='<?php echo APP_ROOT1."index.php"; ?>' method="POST" enctype="multipart/form-data">
        <label for="unitTitle">Konu Başlığı</label>
        <br>
        <input type="text" name="unitTitle" value="<?php echo @$arr["unitTitle"]; ?>" placeholder="Konu başlığı">
        <br>
        <label for="lessonKey">Ders Seçin</label>
        <br>
        <select name="lessonKey">
            <?php
                foreach($lessonKeysNames as $key => $val){
                    if( @$arr["lessonKey"]===$key){
                        echo"<option value='".$key."' selected>".$val."</option>";
                    }else{
                        echo"<option value='".$key."'>".$val."</option>";
                    }
                }
            ?>
        </select>
        <div id="button">
            <button type="submit">Düzenleme Tamamlandı</button>   
        </div>
    </form>
</div>
<div id="response">
    <div id='info'></div>
    <div id='info1'><?php sessionUnitRegistration($arr); ?> </div>
</div>

<script type="text/javascript">
   var quill = new Quill('#editor-container', {
        modules: {  
            toolbar: '#toolbar-container'
        } ,theme: 'snow'
    });
    var content=$("div#unitContentPart div#content").html();
    
    // yeni editor oluşturduk genel ayarla böyle olucak
    $(function(){
        $("form#editing_form").submit(function(e){
            e.preventDefault();
            var obj=$(this);
            var data=new FormData(obj[0]);
            content = $("div[name=content-icerik] div.ql-editor").html();
            data.append("method","ajax");
            data.append("page","unitEdit");
            data.append("unitContent",content);
            $.ajax({
                url:obj.attr("action"),
                type: obj.attr("method"),
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
        /**onay kaldırma bölümü */
        $("div#islemler button[name=disapprove]").click(function(){
            var data=new FormData();
            var obj=$("form#editing_form");
            data.append("method","ajax");
            data.append("page","unitDisapprove");
           $.ajax({
                url:router,
                type:obj.attr("method"),
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
    $("div#islemler button[name=preview]").click(function(){
            var obje=$("form#editing_form ");
            var data=new FormData(obje[0]);
            content = $("div[name=content-icerik] div.ql-editor").html();
            data.append("method","ajax");
            data.append("page","unitPreview");
            data.append("unitContent",content);
            $.ajax({
                url: obje.attr("action"),
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
        //sessiondan içeriği buraya yazdırdık
        document.querySelector("#editor-container div.ql-editor").innerHTML=content;
</script>
<style type="text/css"> 
div#editing{
    margin: auto;
}
form#editing_form{
    margin: auto;
    width:99%;
    text-align: left;
}
form#editing_form label{
    text-align:left;
    margin-bottom: 7px;
    font-size: 18px;
    font-weight: 500;    
}
form#editing_form textarea{
    width: 100%;
    height: 500px;
}
form#editing_form input{    
    width:100% ;
    margin-bottom:10px;
}
form#editing_form select{    
    width:100% ;
    margin-bottom:7px;
}
form#editing_form div#button{
    text-align: center;
}
form#editing_form button{
    font-weight: 700;
    width: 80%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
    margin-bottom:7px;
}
form#editing_form input[ss="son"]{
    margin-bottom: 15px;
    font-size: 15px;
    height: 25;
}
div#editing{
    width: 100%;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(118, 118, 118);
}
body > #standalone-container {
    margin: 50px auto;
    max-width: 720px;
  }
#editor-container {
    height: 400px;
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
