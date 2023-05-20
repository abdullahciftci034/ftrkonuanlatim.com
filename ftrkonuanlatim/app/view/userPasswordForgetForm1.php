<div id="caption">Doğrulama Kodu</div>
<div id="forgetPassword">
    <form  id="forgetPassword_form" action="<?php echo APP_ROOT1; ?>" method="POST" >
        <label for="code">Doğrulama odu</label><br>
        <input type="text" name="code" title="Doğrulama kodu" required size="6" minlength="4" maxlength="6"><br>
        <button type="submit">Giriş</button>   
    </form>
</div>
<div id='info'>Eposta adresinize doğrulama kodu gönderildi. Eğer eposta gözükmüyorsa <strong>spam</strong> mesajlara bakın.</div>
<style type="text/css"> 
div#caption{
    text-align: center;
    margin: auto;
    font-weight: 500;
    font-size: 17px;
    margin-bottom: 25px;
}
div#forgetPassword{
    margin: auto;
}
form#forgetPassword_form{
    width:300px;
    text-align: center;
}
form#forgetPassword_form label{
    text-align:center;
    margin-bottom: 7px;
    font-size: 18px;    
}
form#forgetPassword_form input{    
    width:200px ;
    margin-bottom:7px;
}
form#forgetPassword_form button{
    width: 80%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
}
form#forgetPassword_form input[ss="son"]{
    margin-bottom: 15px;
    font-size: 15px;
    height: 25;
}
div#forgetPassword{
    width: 300px;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(118, 118, 118);
}

</style>
<script type="text/javascript">
    $(function(){
        $("form#forgetPassword_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);
            var data=new FormData(obje[0])
            data.append("method","ajax");
            data.append("page","userPasswordForget1");
            var numbers=$("div#bootControlNumber").text();
            data.append("bootControlNumber",numbers);
            $.ajax({
                url:obje.attr("action"),
                type:obje.attr("method"),
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