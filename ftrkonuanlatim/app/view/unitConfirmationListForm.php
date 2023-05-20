<div id="konuOnaylListesi">
    <div id="caption" >Onaylanmamış Konular</div>
    <table id="konuOnaylListesi">
    
        <tr>
            <th>Konu Id</th>
            <th>Ders</th>
            <th>Konu Başlığı</th>
            <th>Kayıt Tarihi</th>
            <th>Düzenle veya Onayla</th>
        </tr>

    <?php
        $sayi=0;
        $varmi=false;
        if(!empty($list)){
            $sayi=count($list);
        }
        for($i=$sayi-1;-1<$i;$i--){
            if(!$list[$i]["unitConfirmation"]){
                $varmi=true;
                echo " 
                <tr>
                    <td>".$list[$i]["id"] ."</td>
                    <td>".$list[$i]["lessonKey"] ."</td>
                    <td>".$list[$i]["unitTitle"]."</td>
                    <td>".$list[$i]["UnitDateOfRegistration"]."</td>
                    <td><a href='".APP_ROOT1."unitConfirmationEditForm/".$list[$i]["id"]."'>Git</a></td>
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
<?php
if(!$varmi){
    echo "<br><br><p style='text-align:center;'>Yeni bir paylaşım olmadı.</p><br>";
}
?>
<br>
<br>
<hr>
<br>
<br>
<div id="konuOnaylListesi">
<div id="caption" >Onaylanmış Konular</div>
    <table id="konuOnaylListesi">
       
        <tr>
            <th>Konu Id</th>
            <th>Ders</th>
            <th>Konu Başlığı</th>
            <th>Kayıt Tarihi</th>
            <th>Düzenle veya Onayla</th>
        </tr>

    <?php
        $varmi=false;
       
        for($i=$sayi-1;-1<$i;$i--){
            if($list[$i]["unitConfirmation"]){
                $varmi=true;
                echo " 
                <tr>
                    <td>".$list[$i]["id"] ."</td>
                    <td>".$list[$i]["lessonKey"] ."</td>
                    <td>".$list[$i]["unitTitle"]."</td>
                    <td>".$list[$i]["UnitDateOfRegistration"]."</td>
                    <td><a href='".APP_ROOT1."unitEditForm/".$list[$i]["id"]."'>Git</a></td>
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
<?php
if(!$varmi){
    echo "<br><br><p style='text-align:center;'>Yeni bir paylaşım olmadı.</p><br>";
}
?>
<style type="text/css">
div#caption{
    margin: auto;
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 4px;
}
div#konuOnaylListesi table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table#konuOnaylListesi td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

table#konuOnaylListesi tr:nth-child(even) {
  background-color: #dddddd;
}
table#konuOnaylListesi{
    border: solid 2px rgb(200,200,200);
    width: 98%;
    margin: auto;
}
@media screen and (max-width:1100px){
    div#konuOnaylListesi table {
        font-size: large;
    }
}
@media screen and (max-width:865px){
    div#konuOnaylListesi table {
        font-size: medium;
    }
}
@media screen and (max-width:768px){
    div#konuOnaylListesi table {
        font-size: small;
    }
}
@media screen and (max-width:576px){
    div#konuOnaylListesi table {
        font-size:x-small;
    }
}
@media screen and (max-width:300px){
    div#konuOnaylListesi table {
        font-size: xx-small;
    }
}

</style>