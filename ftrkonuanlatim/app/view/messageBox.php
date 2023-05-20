<?php
$cont=oturumControl();
$selfId=@$_SESSION["oturum"]["id"];
$yetki=@$_SESSION["oturum"]["userRank"];
$onay=@$_SESSION["oturum"]["userConfirmation"];
if($yorum){
    foreach($data as $val ){
        $userData=$userObj->getUserId(["id"=>$val["userId"]]);
        $userData=$userData[0];
        $unitCommenData = $messageObj->getElementAndAll(["unitId"=>$unitId,"messageId"=>$val["id"]]);
        echo '
        <div id="box">
            <div id="messageBox" name="message" messageId="'.$val["id"].'" >
                <div id="messageTextBox" > 
                    <div id="content"> 
                        <div id="kullanici">'.$userData["userNameVal"].'</div>
                        <div id="message">'.$val["message"].'</div>
                    </div>
                    '; 
                   if($cont and $onay){
                        echo'
                        <div id="icon-img">
                            <div id="response" >
                                <img title="Cevapla" src="'.APP_ROOT1.'public/img/googlemessages.svg" >
                            </div>';
                            if($selfId==$userData["id"] or  $yetki>=2){
                                echo '<div id="delete" >
                                    <img title="Sil" src="'.APP_ROOT1.'public/img/trash-svgrepo-com.svg" >
                                </div>';
                            }
                    echo'</div>
                    ';
                   }
                    echo'
                </div>
                <div>';
                if(!empty($unitCommenData) and $unitCommenData != "1"){
                    foreach($unitCommenData as $val1){
                        $userData1=$userObj->getUserId(["id"=>$val1["userId"]])[0];
                        echo '
                        <div id="linkedMessage"  name="message" messageId="'.$val1["id"].'" >
                            <div id="content">
                                <div id="kullanici">'.$userData1["userNameVal"].'</div>
                                <div id="message">'.$val1["message"].'</div>
                            </div>
                            ';
                            if($cont and $onay){
                                echo'
                                <div id="icon-img" >
                                    <div id="response" >
                                        <img title="Cevapla" src="'.APP_ROOT1.'public/img/googlemessages.svg" >
                                    </div>
                                    ';
                                    if($selfId==$userData1["id"] or $yetki>=2){
                                        echo'
                                    <div id="delete" >
                                        <img title="Sil" src="'.APP_ROOT1.'public/img/trash-svgrepo-com.svg" >
                                    </div>';
                                    }
                            echo '</div>';
                            }
                        echo'</div>';
                    }
                }
                    echo'
                </div>
            </div>
            <div id="addSendBox"></div>
        </div>
        ';

    }  
}else{  
    echo "<br><p style='text-align:center;'>Hiç yorum yapılmadı.</p>";
}
?>