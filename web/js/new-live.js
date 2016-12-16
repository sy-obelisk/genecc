$(function(){
    $(".blackNav").css("lineHeight",$(".blackNav").height()+"px");
    //$(".play").css("width",$(".play").height()+"px");
    //$(".toggle").css("width",$(".toggle").height()+"px");
    var height=$(".form-font").width()+120+"px";
    $(".form-font").css("height",height);

    if(parseInt($("#type").val())==1){
        //显示播放器
        $("#player").show();
    }
});
function playIcon(o){
    if($(o).hasClass("on")){
        $(o).removeClass("on");
    }else{
        $(o).addClass("on");
    }
}