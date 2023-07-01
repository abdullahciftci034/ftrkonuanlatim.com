$(function(){
   
    $("div#ucNokta").click(function(){
        $("div#ucNokta_gorunecekOge").animate({'width': 'toggle'},750);
        
        if($("div#ucNokta_baslangic").css("width")==="300px"){
            $("div#ucNokta_baslangic").animate({"width":"20","border":"none"},750);
            $(this).animate({"margin-left":0},750);
        }else{
            $(this).animate({"margin-left":280},750);
            $("div#ucNokta_baslangic").animate({"width":300,"border":"solid 1px rgb(200,200,200)"},750);
        } 
    });
    $.ajax({
        type:"POST",
        url:router,
        data:{"method":"ajax","page":"kategoriler"},
        success:function(gelenVeri){
                var obj=JSON.parse(gelenVeri);
                $("div#kategoriler").html(obj.list.scalar);
        }   
    }).complete(function(){
        $("ul#kategoriler li#kategoriler ul#konu_getir li").each(function(){
            $(this).children("a").click(function(){
                var lesson=$(this).parent("li").parent("ul").parent("div") .siblings("a").attr("name");
                var unit=$(this).attr("name");
                var url=root+"unit";
                url+="/"+unit;
                history.pushState("","",url);
                $.ajax({
                    url:router,
                    type:"post",
                    data:{"method":"ajax","page":"unit","unitKey":unit,"lessonKey":lesson},
                    success:function(gelenVeri){
                        $("div.section_anahat").html(gelenVeri);
                    }   
                });
            });  
        });
        $("div#kategoriler ul#kategoriler li#kategoriler").each(function(){
            $(this).click(function(){
                $(this).children("div").slideToggle(750);
                return false;             
            });
        });    
        $("div#kategoriler ul#kategoriler li#kategoriler a").each(function(){
            $(this).click(function(){
                $(this).parent("li").children("div").slideToggle(750);
                return false;       
            });
        });
       
    });
  
});
