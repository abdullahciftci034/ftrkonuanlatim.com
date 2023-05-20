<div id="caption">Şifre Değişikliği</div>
<div id="forgetPassword">
    <form  id="forgetPassword_form" action="<?php echo APP_ROOT1; ?>" method="POST" >
        <label for="password">Yeni Şifre</label><br>
        <input type="password" name="password" title="new password" required size="64" minlength="8" maxlength="64"><br>
        
        <label for="cpassword">Yeni Şifre Tekrar</label><br>
        <input type="password" name="cpassword" title="new password" required size="864" minlength="8" maxlength="64"><br>
        <button type="submit">Gönder</button>   
    </form>
</div>
<div id='info'>Kod doğrulandı yeni şifreniz.</div>
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
            var data=new FormData(obje[0]);
            
            data.append("method","ajax");
            data.append("page","userPasswordForgetNew");
            var numbers=$("div#bootControlNumber").text();
            data.append("bootControlNumber",numbers);
            if(data.get("password")==data.get("cpassword")){
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
            }else{
                $("div#info").html("Şifre aynı değil");
            }

        });
    });
</script>