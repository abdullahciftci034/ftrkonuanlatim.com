<div id="userList"> 
    <br><br>
    <div id="caption">Kayıtlı Kullanıcılar</div>
    <br>
    <table id="userList">
        <tr>
            <th>user Id</th>
            <th>Kullanıcı Adı</th>
            <th>Kullanıcı İsmi</th>
            <th>Kullanıcı Email</th>
            <th>Kayıt Tarihi</th>
            <th>Profil</th>
        </tr>
        <?php
            $sayi=0;
            $varmi=false;
            if(!empty($list) and $list!="1"){
                $sayi=count((array)$list);
            }
            for($i=$sayi-1;-1<$i;$i--){
                if($list[$i]["userConfirmation"]){
                    $varmi=true;
                    echo " 
                        <tr>
                            <td>".$list[$i]["id"] ."</td>
                            <td>".$list[$i]["userName"] ."</td>
                            <td>".$list[$i]["userNameVal"]."</td>
                            <td>".$list[$i]["userEmail"]."</td>
                            <td>".$list[$i]["userDateOfRegistration"]."</td>
                            <td><a href='".APP_ROOT1."user/".$list[$i]["userName"]."' >Profile Git</a></td>
                        </tr>";
                }
            }  
            if(!$varmi){
                echo "
                <tr>
                <td>Yok</td>
                <td>Yok</td>
                <td>Yok</td>
                <td>Yok</td>
                <td><a>Yok</a></td
                </tr>
                ";
            }  
        ?>
    </table>
    <br><br>
    <br>        

    <div id="caption">Kayıt Olmayı Bekleyenler</div>
    <br>
    <table id="userList">
        <tr>
            <th>user Id</th>
            <th>Kullanıcı Adı</th>
            <th>Kullanıcı İsmi</th>
            <th>Kullanıcı Email</th>
            <th>Kayıt Tarihi</th>
        </tr>
        <?php
            $sayi=0;
            $varmi=false;
            if(!empty($list) and $list!="1"){
                $sayi=count((array)$list);
            }
            for($i=$sayi-1;-1<$i;$i--){
                if(!$list[$i]["userConfirmation"]){
                    $varmi=true;
                    echo " 
                        <tr>
                            <td>".$list[$i]["id"] ."</td>
                            <td>".$list[$i]["userName"] ."</td>
                            <td>".$list[$i]["userNameVal"]."</td>
                            <td>".$list[$i]["userEmail"]."</td>
                            <td>".$list[$i]["userDateOfRegistration"]."</td>
                        </tr>";
                }
            }  
            if(!$varmi){
                echo "
                <tr>
                <td>Yok</td>
                <td>Yok</td>
                <td>Yok</td>
                <td>Yok</td>
                <td><a>Yok</a></td
                </tr>
                ";
            }  
        ?>
    </table>
</div>
<style>
div#userList{
    width: 100%;
    min-height:200px;
    background-color:rgb(245,245, 245) ;
}
div#userList div#caption{
    margin: auto;
    text-align: center;
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 4px;
}
div#userList  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

div#userList table#userList td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

div#userList table#userList tr:nth-child(even) {
    background-color: #dddddd;
}
div#userList table#userList{
    border: solid 2px rgb(200,200,200);
    width: 98%;
    margin: auto;
}
@media screen and (max-width:1100px){
    div#userListtable {
        font-size: medium;
    }
}
@media screen and (max-width:865px){
    div#userListtable {
        font-size: medium;
    }
}
@media screen and (max-width:768px){
    div#userList  table {
        font-size: small;
    }
}
@media screen and (max-width:576px){
    div#userList  table {
        font-size:x-small;
    }
}
@media screen and (max-width:450px){
    div#userList div#userListProfil div#myInfo{
        float: left;
        width: 100%;
        margin:auto;
        font-size: small;
    }
}
@media screen and (max-width:300px){
    div#userList table {
        font-size: xx-small;
    }
}
</style>