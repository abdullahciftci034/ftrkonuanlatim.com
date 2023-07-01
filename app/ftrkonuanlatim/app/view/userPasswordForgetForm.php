<div id="caption">Şifremi Unuttum</div>
<div id="forgetPassword">
    <form  id="forgetPassword_form"  action="<?php echo APP_ROOT1."index.php"; ?>"  method="POST" >
        <label for="emailorname">E-posta veya Kullanıcı Adınız </label><br>
        <input type="username" name="emailorname" title="Eposta veya Kullanıcı Adı" required size="32" minlength="6" maxlength="64"><br>
        <button type="submit">Gönder</button>   
    </form>
</div>
<div id='info'></div>
<script>
    $(function(){
        $("form#forgetPassword_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);
            var data=new FormData(obje[0]);
            var numbers=$("div#bootControlNumber").text();
            data.append("method","ajax");
            data.append("page","userPasswordForget");
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
