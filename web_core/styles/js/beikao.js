$(function(){
     var searchVal=location.href.split("=")[1];
     var last=searchVal.split("#")[0];
    if(last==1){
       $(".infoLhd ul li").eq(0).trigger("click");
    }else if(last==2){
        $(".infoLhd ul li").eq(1).trigger("click");
    }else{
        $(".infoLhd ul li").eq(2).trigger("click");
    }
});
