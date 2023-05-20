<?php
if(oturumControl()){
    echo '
    <div id="messageSendBox"> 
        <form  id="messageSendBox_form" action="'.APP_ROOT1.'index.php" method="POST" >
            <textarea placeholder="Yorum Yap" name="message"></textarea>
            <input type="hidden" name="unitId" value="'.$unit["id"].'">
            <button type="submit">Yorum Yap</button>   
        </form>
    </div>
    <div id="info"></div> 
    ';
}
echo "<div id='mesajkutusu' unitId='".$unit["id"]."'>";
require_once __DIR__."/messageBox.php";
echo "</div>";
?>
<style>
/* mesaj gönderme bölümü csselri*/
div#box::after{
    visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}

div#messageSendBox{
    width: 95%;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(200,200,200);
    padding: 3px;
    margin: auto;
}
div#messageSendBox form#messageSendBox_form{
    max-width:100%;
    text-align: center;
}
div#messageSendBox form#messageSendBox_form button ,input[name=button]{
    font-weight:600;
    width: 35%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
    margin-top:3px;
    margin-bottom: 3px;
}
div#messageSendBox form#messageSendBox_form textarea{
    width:95%;
    font-size: 12px;
}




/*mesaj gösterme bölümü */
div#messageBox{
    margin: auto;
    margin-top: 15px;
    margin-bottom: 15px;
    max-width: 95%;

}
div#messageBox::after{
    visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}


div#messageBox div#messageTextBox{
    margin:0px;
    padding: 0px;
    top:0px;
    left: 0px;
}
div#messageBox div#messageTextBox{
    margin:5px;
    min-height: 75px;  
    background-color:rgb(234, 236, 241);
    border :rgb(235,235, 235) solid 2px;
    border-radius: 6px;
    box-shadow: 1.5px 1.5px rgb(210, 210, 210);
    font-size: 13px;
}
div#messageBox div#messageTextBox::after{
    visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}
div#messageBox  div#content{
    float: left;    
    max-width: 75%;
}
 
div#messageBox div#content div#kullanici{
    margin-top:6px;
    margin-bottom: 6px;
    margin-left:12px;
    margin-right: 12px;
    max-width: 50%;
    font-weight: 500;
}

div#messageBox div#content div#message{
    margin-bottom: 2px;
    margin-right: 12px;
    margin-left :12px;
    max-width: 87%;
    word-break: break-word;
    overflow: hidden;
    text-overflow: ellipsis;

}
div#messageBox div#icon-img{
    margin-top: 9px;
    float: right;
    width:35px;
}

div#messageBox div#icon-img div#response{
    float: right;
    padding: 0px;
}
div#messageBox div#icon-img div#response img {
    width: 30px;
    height: 20px;
}
div#messageBox div#icon-img div#delete{
    margin-right: 5px;
    float: right;
    padding: 0px;
    
}
div#messageBox div#icon-img div#delete img{
    width: 20px;
    height: 30px;   
}

/*
bağlı mesaj lat mesajlar

 */
div#messageBox div#linkedMessage{
    background-color: rgb(240, 240, 240);
    width: 80%;
    float: right;
    border :rgb(235,235, 235) solid 2px;
    border-radius: 2px;
    box-shadow: 0.5px 0.5px rgb(210, 210, 210);
    font-size: 13px;
}

div#messageBox div#linkedMessage::after{
    visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;   
}
div#messageBox div#linkedMessage div#content{
    
}
div#addSendBox{
    float: right;
    width: 80%;
}
div#addSendBox input[name=button]{
    font-weight: 500;
    font-size: 13px;
}

</style>
<script>
/*var imageX= 70;
    var imageY= 55;
    var imageCerceveX=(imageX/100)*42;
    var imageCerceveY=(imageY/100)*31;
    var imageMarginPx=(imageX/100)*24;
    var imageMarginPy=(imageY/100)*35;
*/


$(function(){
    $("div#messageSendBox form#messageSendBox_form").submit(function(e){ 
        e.preventDefault();
        var data1=new FormData($(this)[0]);
        data1.append("method","ajax");
        data1.append("page","message");
        $.ajax({
            url:$(this).attr("action"),
            type:$(this).attr("method"),
            data:data1,
            contentType:false,
            processData:false,
            success:function(data){
                $("div#info").html(data);
                messageBox(data1.get("unitId"));
                console.log(data1.get("unitId"));
            },error:function(data){
                $("div#info").html(data);
            }
        });
    });
    $("div#messageSendBox form#messageSendBox_form input[type=button]").live("click",function(){
        var obj=$(this).parents("form#messageSendBox_form");
        var data1=new FormData(obj[0]);
        data1.append("method","ajax");
        data1.append("page","message");
        $.ajax({
            url:obj.attr("action"),
            type:obj.attr("method"),
            data:data1,
            contentType:false,
            processData:false,
            success:function(data){
                $("div#info").html(data);
                messageBox(data1.get("unitId"));
                console.log(data1.get("unitId"));
            },error:function(data){
                $("div#info").html(data);
            }
        });
    });
    function messageBox(unitId){
        var data=new FormData();
        data.append("method","ajax");
        data.append("page","messageBox");
        data.append("unitId",unitId);
        $.ajax({
            url:router,
            type:"POST",
            data:data,
            contentType:false,
            processData:false,
            success:function(data){
                $("div#mesajkutusu").html(data);
            },error:function(data){
                $("div#info").html(data);
            }
        });
    }

    $("div#messageBox div#icon-img div#response img").live("click",function(){
        $("div#addSendBox").html(" ");
        var messageId=$(this).parents("div#messageBox").attr("messageId");
        var html='<div id="messageSendBox" > <form  id="messageSendBox_form" action="<?php echo APP_ROOT1."index.php"; ?>" method="POST" > <textarea placeholder="Yorum Yap" name="message"></textarea> <input type="hidden" name="unitId" value="<?php echo $unit["id"]; ?>"><input type="hidden"  name="messageId" value="'+messageId+'" ><input name="button" value="Yorum Yap" type="button"> </form></div>'
        $(this).parents("div#messageBox").siblings("div#addSendBox").html(html);
    });
    $("div#messageBox div#icon-img div#delete img").live("click",function(){
        var unitId=$("div#mesajkutusu").attr("unitId");
        var messageId=$(this).parents("div[name=message]").attr("messageId");  
        var data=new FormData();    
        data.append("method","ajax");
        data.append("page","messageDelete");
        data.append("messageId",messageId);
        $.ajax({
            url:router,
            type:"POST",
            data:data,
            contentType:false,
            processData:false,
            success:function(data){
                $("div#mesajkutusu").html(data);
                messageBox(unitId);
            },error:function(data){
                $("div#info").html(data);
            }
        });
    });
    
});

</script>