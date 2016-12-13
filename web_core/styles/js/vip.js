$(function(){
    $(".moreList table tr").each(function(){
        var link=$(this).attr("data-link");
        if(link){
            $(this).css("cursor","pointer");
            $(this).hover(function(){$(this).css("color","#23afec")},function(){$(this).css("color","#484544")});
        }
    });
    //点击五大功能特权下面的tr
   $(".moreList table tr").bind("click",newLink);
});

function newLink(){
      var link=$(this).attr("data-link");
    if(link == null){
        alert("亲！暂时没有连接！！！");
    }
    if (link){
        var win = window.open(link);
    }

    //if(win == null){
    //    alert('新窗口看起来是被一个弹出窗口拦截程序所阻挡。 如果想打开新窗口，' +
    //    '我们建议您将本站点加入到这个拦截程序设定的允许弹出名单中。有的弹出窗口拦截程序允许在长按Ctrl键时可以打开新窗口。');
    //}

}
//判断用户登录后才跳转
function comeBuy(o,user){
    if(user != ''){
        var href = $(o).attr("data-link");
        window.open(href);
    } else {
        //$("#login_register").show();
        //$(".log_reg_zzc").show();
        loginHref();
    }
}