$(function(){
    $("nav div#ust_taraf").live("click",function(){
       var page= $(this).children("a").attr("name");
       history.pushState("","",root+page); 
       $.ajax({
            url:router,
            type:"post",
            data:{"method":"ajax","page":page},
            success:function(gelenVeri){
                
                $("div.section_anahat").html(gelenVeri);
                
            }   
        });
    });
    $("nav div#ust_taraf a#ust_tarafA").live("click",function(){
        var page= $(this).attr("name");
        history.pushState("","",root+page); 
        $.ajax({
             url:router,
             type:"post",
             data:{"method":"ajax","page":page},
             success:function(gelenVeri){
    
                $("div.section_anahat").html(gelenVeri);
            }
         });
         return false;
     });
     //guncel paylasimlar getir
     $.ajax({
        url:router,
        type:"post",
        data:{"method":"ajax","page":"guncelPaylasimlar"},
        success:function(gelenVeri){
            $("#guncelPaylasimlar").html(gelenVeri);
       }
    });
     
    function arrCleanEmpty(arr){
        var finalArr=[];
        for(var i=0;i<arr.length;i++){
            if(arr[i] !== "" &&  arr[i] !==null ) {
                finalArr.push(arr[i]);
            }
        }
        return finalArr;
    }   
});
    