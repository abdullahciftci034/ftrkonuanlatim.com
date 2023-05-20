<br>
<div><strong>Sayın Moderatör</strong> bu konuyu onaylamanızda dikkat edilecek hususlar vardır. Bunlar:
    <ul>
        <li>İçerikte "script" ifadesi olursa güvenlik açısından konuyu onaylamayın. </li>
        <li>İçerikte karmaşık gözüken kodlar var ise onaylamayabilirsiniz.</li>
        <li>İçerikte "script" ifadesini aramak için <strong>Ctrl+F</strong> tuşuna basarak yapabilirsiniz.</li>
    </ul>
</div>
<br><br>
<div id="onaylama_yap">     
    <div id="islemler" style="float:right; margin-top: 5px; margin-right: 25px; margin-bottom: 5px;" >
        <button name="delete" style="background-color:rgb(191, 217, 236); border: 1px rgb(118, 118, 118);  font-weight:600; margin: auto; ">Sil</button>        
    </div>
    <form  id="onaylama_yap_form" action='<?php echo APP_ROOT1."unitConfirmationEditForm1/".$arr["id"]; ?>' method="POST" enctype="multipart/form-data" unitId="<?php echo $arr["id"]; ?>">
    
        <label for="unitContent">İçerik</label>
        <br>
        
        <textarea name="unitContent" placeholder="Konu içerik" ><?php if(!empty($arr)){ echo $arr["unitContent"];}?></textarea>
        <br>

        <label for="unitTitle">Konu Başlığı</label>
        <br>

        <input type="text" name="unitTitle" value="<?php if(!empty($arr)){echo $arr["unitTitle"]; } ?>" placeholder="Konu başlığı">
        <br>

        <label for="lessonKey">Ders Seçin</label>
        <br>

        <select name="lessonKey">
            <?php
                if(!empty($arr)){
                    foreach($lessonKeysNames as $key => $val){
                        if( @$arr["lessonKey"]===$key){
                            echo"<option value='".$key."' selected>".$val."</option>";
                        }else{
                            echo"<option value='".$key."'>".$val."</option>";
                        }
                    }
                } 
                
            ?>
        </select>
        <br>
        <div id="button">
            <button type="submit">İleri</button>   
        </div>
    </form>
</div>
<div id='info'></div>
<style type="text/css"> 
    div#onaylama_yap{
        margin: auto;
    }
    form#onaylama_yap_form{
        margin: auto;
        width:99%;
        text-align: left;
    }
    form#onaylama_yap_form label{
        text-align:left;
        margin-bottom: 7px;
        font-size: 18px;
        font-weight: 500;    
    }
    form#onaylama_yap_form textarea{
        width: 100%;
        height: 500px;
    }
    form#onaylama_yap_form input{    
        width:100% ;
        margin-bottom:10px;
    }
    form#onaylama_yap_form select{    
        width:100% ;
        margin-bottom:7px;
    }
    form#onaylama_yap_form div#button{
        text-align: center;
    }
    form#onaylama_yap_form button{
        font-weight: 700;
        width: 80%;
        background-color:rgb(191, 217, 236);
        height: 30px;
        border: 1px rgb(118, 118, 118);
        font-size: 16px;
        margin-bottom:7px;
    }
    form#onaylama_yap_form input[ss="son"]{
        margin-bottom: 15px;
        font-size: 15px;
        height: 25;
    }
    div#onaylama_yap{
        width: 100%;
        background-color: rgb(234, 236, 241);
        border:solid 1px rgb(118, 118, 118);
    }
</style>
<script type="text/javascript">
    $(function(){
        $("div#islemler button[name=delete]").click(function(){
            var data=new FormData();
            data.append("method","ajax");
            data.append("page","unitUnapprovedDelete");
            $.ajax({
                url:router,
                type: "post",
                data:data,
                contentType:false,
                processData:false,
                success:function(data) {
                    $("div#info").html(data);
                },error:function(data){
                    $("div#info").html(data);
                }
            });
        });
    });
</script>