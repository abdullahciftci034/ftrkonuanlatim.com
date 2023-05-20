<div id="user">
    <div id="userProfil">
        <div id="myfoto">Profil Image</div>
        <div id="myInfo">
            <table>
                <tr><td>İsim:</td><td><?php echo  $user["userNameVal"];?></td></div></tr> 
                <tr><td>Kullanıcı Adı:</td><td><?php echo $user["userName"];?></td></div></tr>
                <tr><td>Kayıt Tarihi:</td> <td><?php echo $user["userDateOfRegistration"];?></td></tr>
            </table>
        </div>
    </div>
    <hr>
    <hr>
    <br><br>
    <div id="myUnit">
        <div id="caption">Kullanıcının Paylaşımları</div>
    <div id="konuOnaylListesi">
        <div id="caption" >Onaylanmış Konularım</div>
        <table id="konuOnaylListesi">
            <tr>
                <th>Ders</th>
                <th>Konu Başlığı</th>
                <th>Kayıt Tarihi</th>
                <th>Gör</th>
            </tr>
            <?php
                 $sayi=0;
                 $varmi=false;
                 if(!empty($list) and $list!="1"){
                     $sayi=count((array)$list);
                    
                    }
                for($i=$sayi-1;-1<$i;$i--){
                    $varmi=true;    
                        echo " 
                            <tr>
                                <td>".$list[$i]["lessonKey"] ."</td>
                                <td>".$list[$i]["unitTitle"]."</td>
                                <td>".$list[$i]["unitDateOfRegistration"]."</td>
                                <td><a target='_blank' href='".APP_ROOT1."unit/".$list[$i]["unitKey"]."'>Git</a></td>
                            </tr>";
                    
                }  
                if(!$varmi){
                    echo "
                    <tr>
                    <td>Yok</td>
                    <td>Yok</td>
                    <td>Yok</td>
                    <td>Yok</td>
                    </tr>
                    ";
                }  
            ?>
        </table>
    </div> <?php if(!$varmi){ echo "<br><p style='text-align:center;'>Yeni bir paylaşım olmadı.</p>"; } ?> </div>
</div>
<style>
    div#user{
        margin-top: 10px;
        background-color: rgb(250,250, 250);
    }
    div#user::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    div#user div{
        border-radius: 3px;
    }

    /*user profil bölümü */
    div#user div#userProfil{
        width: 100%;
        margin:3px;
        padding: 3px;
        background-color:rgb(230,230, 230) ;
    }
    div#userProfil::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    div#user div#userProfil div#myfoto{
        float: left;
        min-width: 90px;
        min-height: 90px;
        max-width: 120px;
        max-height: 120px;
        margin:5px;
        background-color: rgb(210,210, 210);
    }
    div#user div#userProfil div#myInfo{
        float:right;
        margin:5px;
        width:70%;
        padding: 3px;
        min-height: 90px;
        max-height: 150px;
        font-weight: 500;
        font-size: 14px;
        background-color: rgb(210,210, 210);
        
    }
    div#user div#userProfil div#myInfo table {
        margin-left: 3px;
    }
    div#user div#myUnit{
        background-color:rgb(230,230, 230) ;
    }
    div#user div#myUnit::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    
    /* konuolar bölümü css leri */
    div#user div#myUnit{
        width: 100%;
        min-height:200px;
        background-color:rgb(245,245, 245) ;
    }
    div#user div#myUnit  div#caption{
        margin: auto;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 4px;
    }
    div#user div#konuOnaylListesi table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    div#user table#konuOnaylListesi td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    div#user table#konuOnaylListesi tr:nth-child(even) {
        background-color: #dddddd;
    }
    div#user table#konuOnaylListesi{
        border: solid 2px rgb(200,200,200);
        width: 98%;
        margin: auto;
    }
    @media screen and (max-width:1100px){
        div#user div#konuOnaylListesi table {
            font-size: medium;
        }
    }
    @media screen and (max-width:865px){
        div#user div#konuOnaylListesi table {
            font-size: medium;
        }
    }
    @media screen and (max-width:768px){
        div#user div#konuOnaylListesi table {
            font-size: small;
        }
        div#user div#userProfil div#myInfo{
            font-size: small;
        }
    }
    @media screen and (max-width:576px){
        div#user div#konuOnaylListesi table {
            font-size:x-small;
        }
    }
    @media screen and (max-width:450px){
        div#user div#userProfil div#myInfo{
            float: left;
            width: 100%;
            margin:auto;
            font-size: small;
        }
    }
    @media screen and (max-width:300px){
        div#user div#konuOnaylListesi table {
            font-size: xx-small;
        }
        div#user div#userProfil div#myInfo{
            font-size: x-small;
        }
    }
</style>
