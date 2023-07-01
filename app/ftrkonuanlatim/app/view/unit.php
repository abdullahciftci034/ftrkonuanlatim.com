<div id="unit">
    <meta name="<?php echo @$unit["unitTitle"]; ?>">
    <div id="unitContentPart">
        <?php
            if(@$data[1]=="oneri" or  @$data[0]=="oneri"){
                echo '<div id="link">/<a href="'.APP_ROOT1.'d">d</a>/<a href="'.APP_ROOT1.'d/'.$unit["lessonKey"].'">'.$unit["lessonKey"].'</a>/<a href="'.APP_ROOT1.'unit/'.$unit["unitKey"].'">oneri</a></div>';
            }else{
                echo '<div id="link">/<a href="'.APP_ROOT1.'d">d</a>/<a href="'.APP_ROOT1.'d/'.$unit["lessonKey"].'">'.$unit["lessonKey"].'</a>/<a href="'.APP_ROOT1.'unit/'.$unit["unitKey"].'">'.$unit["unitKey"].'</a></div>';
            }
        ?>
        
        <div id="title"><?php echo $unit["unitTitle"]; ?></div>
        <?php 
            if(oturumControl() and $_SESSION["oturum"]["userConfirmation"] and $_SESSION["oturum"]["userActive"] and $_SESSION["oturum"]["userRank"]>=2 ){
                echo '<div id="link" ><a href="'.APP_ROOT1.'unitEditForm/'.$unit["id"].'">Konuyu Düzenle</a></div>';
            }else if(oturumControl() and $_SESSION["oturum"]["userConfirmation"] and $_SESSION["oturum"]["id"] == $unit["authorUserId"] ){
                echo '<div id="link" ><a href="'.APP_ROOT1.'unitEditForm/'.$unit["id"].'">Konuyu Düzenle</a></div>';
            }
            echo '<div id="link" >Yazar : <a href="'.APP_ROOT1.'user/'.$user["userName"].'">'.$user["userNameVal"].'</a></div><br><br>';   
        ?>
        <div id="content"><?php echo $unit["unitContent"]; ?></div> 
    </div>
    <hr>
    <div id="messagePart"> <?php require_once APP_CONTROLLER."/messageForm.php"; ?> </div>
</div>
<style>
    div#unit{
        margin: 0px;
        padding: 0px;
        background-color: rgb(250,250,250);
        padding: 3px;
        font-size: 14px;
    }
    div#unit::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    /**content bölümü */

    div#unit div#unitContentPart{
        font-size: 14px;
        word-break: break-all;
        overflow: hidden;
    }
    div#unit div#unitContentPart::after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    div#unit div#unitContentPart div#title{
        margin:auto;
        text-align: center;
        font-size: 23px;
        font-weight: 500;
        margin-top: 12px;
        margin-bottom: 12px;
    }
    div#unit div#unitContentPart div#content p{
        margin-top: 2.5px;
        margin-bottom: 2.5px;
        font-size: 14px;
    }
    div#unit div#unitContentPart div#content h1, .ql-size-huge{
        font-size: 18px;
        font-weight: 500;
    }
    div#unit div#unitContentPart div#content h2 ,.ql-size-large{
        font-size: 16px;
        font-weight: 500;
    }
    div#unit div#unitContentPart div#content h3{
        font-size: 14px;
        font-weight: 500;
    }
    div#unit div#unitContentPart div#content h4{
        font-size: 12px;
        font-weight: 500;
    }
    div#unit div#unitContentPart div#link a{
        font-size: 16px;
        color: black;
    }

    @media screen and (max-width:1100px){
        div#unit div#unitContentPart div#content p{
            font-size: 12px;
        }
        div#unit div#unitContentPart div#content h1, .ql-size-huge{
            font-size: 17px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 15px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h3{
            font-size: 13px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h4{
            font-size: 11px;
            font-weight: 500;
        }
    }
   
    @media screen and (max-width:768px){
        div#unit div#unitContentPart div#content p{
            font-size: 10px;
        }
        div#unit div#unitContentPart div#content h1, .ql-size-huge{
            font-size: 16px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 14px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h3{
            font-size: 12px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h4{
            font-size: 10px;
            font-weight: 500;
        }
    }
    @media screen and (max-width:576px){
        div#unit div#unitContentPart div#content p{
            font-size: 9px;
        }
        div#unit div#unitContentPart div#content h1, .ql-size-huge{
            font-size: 15px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 13px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h3{
            font-size: 11px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h4{
            font-size: 9px;
            font-weight: 500;
        }
    }
   
    @media screen and (max-width:300px){
        div#unit div#unitContentPart div#content p{
            font-size: 8px;
        }
        div#unit div#unitContentPart div#content h1, .ql-size-huge{
            font-size: 14px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h2 ,.ql-size-large{
            font-size: 12px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h3{
            font-size: 10px;
            font-weight: 500;
        }
        div#unit div#unitContentPart div#content h4{
            font-size: 8px;
            font-weight: 500;
        }
    }
</style>