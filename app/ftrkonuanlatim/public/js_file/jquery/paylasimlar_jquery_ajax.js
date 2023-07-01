//paylasimlarYaz
function paylasimlarYaz(form) {
    var don;
    var gonderilenVeri=veriFormat_degistir(stringtoArray($(form).serialize()),{"method":"ajax","page":"paylasimIslemleri","islem":"paylasimYaz"});
    $.ajax({
        url: router,
        type: 'post',
        data:gonderilenVeri,
        async: false,
        success:function(gelenVeri) {
            don= gelenVeri;
        
        },error:function(){
            don= false;
        }             
    });
    return don;
}
//paylasimlarSil
//paylasimlarGuncelle
//paylasimlarOnayla
//paylasimlarOnayKaldir
function paylasimIslemi1(paylasimIslem,id){
    var don="";
    $.ajax({
        url: router,
        type: 'post',
        async: false,
        data:{"method":"ajax","page":"paylasimIslemleri","islem":paylasimIslem,"id":id},
        success:function(gelenVeri) {
            don=gelenVeri;
        },error:function(){
            don=false;
        }             
    });
    return don;
    
}
//paylasimlarOnayliOlanlariGoster
//paylasimlarHepsiniGor
//paylasimlarBaslikGoster
//paylasimlarSeciliOlaniGoster
//paylasimlarSonEklenenleriGoster 
function paylasimIslemi2(paylasimIslem){
    var don;
    $.ajax({
        url: router,
        type: 'post',
        data:{"method":"ajax","page":"paylasimIslemleri","islem":paylasimIslem},
        async: false,
        success:function(gelenVeri) {
            don= gelenVeri;
        },error:function(){
            don= false;
        }
    });
    return don;
}
/**/
function  veriFormat_degistir(arr,arr1) {
    for (let [key, value] of Object.entries(arr1)) {
           arr[key]=value;
    }
    return arr;
}
function  stringtoArray(str) {
   var arr={};
   var strArr=str.split("&");
   for (var i=0;i<strArr.length;i++){
        var strArr1=strArr[i].split("=");
        arr[strArr1[0]]=strArr1[1];
   }
   return arr;
}
function http_istek(paylasimIslem){
    var xhttp=new XMLHttpRequest();
    var cevap;
    xhttp.onreadystatechange
    xhttp.open("POST",router,true);
    xhttp.send({"method":"ajax","page":"paylasimIslemleri","islem":paylasimIslem});
    return xhttp.responseText;
}


