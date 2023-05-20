<div id="kayit_ol">
    <form  id="kayit_ol_form" action="index.php" method="POST" >
        <label for="userNameVal">İsim</label><br>
        <input type="text" name="userNameVal" title="Bu alanı doldurmak zorunludur" required size="32" minlength="3" maxlength="64"><br>
        <label for="userName">Kullanıcı Adı</label><br>
        <input type="text" name="userName" size="32" minlength="8" title="Türkçe ve özel karakter girmeyiniz." placeholder="Türkçe ve özel karakter girmeyiniz." maxlength="64"><br>
        <label for="userEmail">E-posta</label><br>
        <input type="email" name="userEmail" title="Bu alanı doldurmak zorunludur" required size="32" minlength="8" maxlength="64"><br>
        <label for="password">Şifre</label> <br>
        <input type="password" ss="son" name="password"minlength="8" placeholder="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" title="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" required size="16" minlength="8" maxlength="16"><br>
        <label for="passwordControl">Şifre Kontrol</label> <br>
        <input type="password" ss="son" name="passwordControl"  minlength="8" placeholder="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" title="Şifreniz türkçe karakter içermesin ve en az 8 karakter olsun" required size="16" minlength="8" maxlength="16">
        <button type="submit">Kayıt Ol </button>   
    </form>
</div>
<div id='info'></div>
<style type="text/css"> 
div#kayit_ol{
    margin: auto;
}
form#kayit_ol_form{
    width:300px;
    text-align: center;
}
form#kayit_ol_form label{
    text-align:center;
    margin-bottom: 7px;
    font-size: 18px;    
}
form#kayit_ol_form input{    
    width:200px ;
    margin-bottom:7px;
}
form#kayit_ol_form button{
    width: 80%;
    background-color:rgb(191, 217, 236);
    height: 30px;
    border: 1px rgb(118, 118, 118);
    font-size: 16px;
}
form#kayit_ol_form input[ss="son"]{
    margin-bottom: 15px;
    font-size: 15px;
    height: 25;
}
div#kayit_ol{
    width: 300px;
    background-color: rgb(234, 236, 241);
    border:solid 1px rgb(118, 118, 118);
}
</style>
<script type="text/javascript">
    $(function(){
        $("form#kayit_ol_form").submit(function(e){
            e.preventDefault();
            var obje=$(this);

            var data=new FormData(obje[0]);
            if(characterCont(data.get("userName"))){
                data.append("method","ajax");
                data.append("page","userRegistration");
                var numbers=$("div#bootControlNumber").text();
                data.append("bootControlNumber",numbers);
                if(data.get("password")==data.get("passwordControl")){
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
                }else{
                    $("div#info").html("Gönderilen şifre eşleşmiyor.");
                }
            }else{
                $("div#info").html("Lütfen kullanıcı adınızda türkçe karater ve özel karakter kullanmayınız. Sadece rakam ve sayılar.");
            }
        });
    });
    function characterCont(str) { 
        var len= str.length;
        var res = str.match(/[A-Za-z0-9]/g);
        var resLen = res.length;
        if(len==resLen){
            return true;
        }
        return false;
    }
</script>