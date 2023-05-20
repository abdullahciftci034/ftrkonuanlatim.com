<div id="login_ol">
    <form  id="login_ol_form" action="index.php" method="POST" >
        <label for="emailorname">E-posta veya Kullanıcı Adınız </label><br>
        <input type="username" name="emailorname" title="Bu alanı doldurmak zorunludur" required size="32" minlength="8" maxlength="64"><br>
        <label for="password">Şifre</label> <br>
        <input type="password" ss="son" name="password" placeholder="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" title="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" required size="16" minlength="8" maxlength="16"><br>
        <button type="submit">Giriş</button>   
    </form>
</div>

<div id='info'></div>
<div id="unuttum" ><a href="<?php echo APP_ROOT1."userPasswordForgetForm" ?>">Şifremi unuttum</a></div>
<style type="text/css"> 
div#login_ol{
    margin: auto;
}
form#login_ol_form{
    width:300px;
    text-align: center;
}
form#login_ol_form label{
    text-align:center;
    margin-bottom: 7px;
    font-size: 18px;    
}
form#login_ol_form input{    
    width:200px ;
    margin-bottom:7px;
}
form#login_ol_form button{
    width: 80%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
}
form#login_ol_form input[ss="son"]{
    margin-bottom: 15px;
    font-size: 15px;
    height: 25;
}
div#login_ol{
    width: 300px;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(118, 118, 118);
}
div#unuttum{
    text-align:center; margin-top:10px; 
}
div#unuttum a{
    color: black;
}

</style>
<script type="text/javascript">
    $(function(){
        $("form#login_ol_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);
            var data=new FormData(obje[0])
            data.append("method","ajax");
            data.append("page","userLogin");
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