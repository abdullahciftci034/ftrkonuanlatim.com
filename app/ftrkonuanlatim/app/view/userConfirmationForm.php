<div id="dogrulama">
    <form  id="dogrulama_form" action="index.php" method="POST" >
        <label for="name">Doğrulama Kodu</label><br>
        <input type="text" name="code" title="Doğrulama Kodu" required size="6" minlength="3" maxlength="6"><br>
        <button type="submit">Gönder </button>   
    </form>
</div>
<div id='info'></div>
<style type="text/css"> 
div#dogrulama{
    margin: auto;
}
form#dogrulama_form{
    width:300px;
    text-align: center;
}
form#dogrulama_form label{
    text-align:center;
    margin-bottom: 7px;
    font-size: 18px;    
}
form#dogrulama_form input{    
    width:200px ;
    margin-bottom:7px;
}
form#dogrulama_form button{
    width: 80%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
}
form#dogrulama_form input[ss="son"]{
    margin-bottom: 15px;
    font-size: 15px;
    height: 25;
}
div#dogrulama{
    width: 300px;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(118, 118, 118);
}
</style>
<script type="text/javascript">
    $(function(){
        $("form#dogrulama_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);
            var data=new FormData(obje[0])
            data.append("method","ajax");
            data.append("page","userConfirmation");
            $.ajax({
                url:obje.attr("action"),
                type: obje.attr("method"),
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