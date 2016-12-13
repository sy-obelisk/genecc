$(function () {
    jQuery("#classJieshao").slide({trigger: "click"});
    //$(".jC_lg_div").scroll_absolute({arrows: false});
    $(".guany_jian").click(function () {
        if ($(this).hasClass("on")) {
            $(this).removeClass("on")
        } else {
            $(this).addClass("on")
        }
        $(this).siblings("div.kt_xq_show_rx").slideToggle("slow")
    });

});

function chooseStyle(o){
    var contentid = $(o).attr('contid');
    if($(o).hasClass("on")){
        $(o).removeClass("on");
    }else{
        $(o).addClass("on").siblings("div").removeClass("on");
        if(typeof(contentid) !='undefined' ){
            location.href="/gmatcourses/"+contentid+".html";
        }
    }

}
//立即购买跳转
function comenewBuy(user,contentid,catid,commodity_type){
    if(user != ''){
        location.href="/pay/"+contentid+"-"+catid+"-"+commodity_type+".html";
    } else {
        loginHref();
    }
}