$(function () {
    //固定部分控制背景颜色
    $(".fixed_div_img").hover(function () {
        $(this).css("background", "#00a1e8");
    }, function () {
        $(this).css("background", "#b2b2b2");
    });
    //头部选中效果
    var url = window.location.href;
    var urlS = url.split("/")[3];
    if (urlS == "practise") {
        $(".head_nav>ul>li").eq(3).addClass("on");
    } else if (urlS == "index.html") {
        $(".head_nav>ul>li").eq(0).addClass("on");
    } else if (urlS == "learn") {
        $(".head_nav>ul>li").eq(2).addClass("on");
    } else if (urlS == "exam") {
        $(".head_nav>ul>li").eq(4).addClass("on");
    } else if (urlS == "test") {
        $(".head_nav>ul>li").eq(5).addClass("on");
    } else if (urlS == "publicclass") {
        //$(".head_nav ul li").eq(5).css("background","black");
        //$(".head_nav ul li").eq(5).find("div.xiala").addClass("on").show();
    } else if (urlS == "gmatcourses") {
        $(".head_nav>ul>li").eq(6).addClass("on");
    } else if (urlS == "video.html") {
        $(".head_nav>ul>li").eq(7).addClass("on");
    }
    else if (urlS == "teachers") {
        $(".head_nav>ul>li").eq(10).addClass("on");
    } else if (urlS == "shop") {
        $(".head_nav>ul>li").eq(12).addClass("on");
    }else if (urlS == "internship") {
        //$(".head_nav>ul>li").eq(11).addClass("on");
    }else if (urlS == "DownloadApp.html") {
        $(".head_nav>ul>li").eq(13).addClass("on");
    } else if (urlS == "question") {
        $(".head_nav>ul>li").eq(1).addClass("on");
}

    jQuery(".lr_whiteBG").slide({trigger: "click"});
    $(".login_qita").mouseenter(function () {
        $(".hover_add_rl").show()
    });
    $(".hover_add_rl").mouseleave(function () {
        $(".hover_add_rl").hide()
    });
    $(".login_qita02").mouseenter(function () {
        $(".hover_add_rl02").show()
    });
    $(".hover_add_rl02").mouseleave(function () {
        $(".hover_add_rl02").hide()
    });

    $(".login_head_btn").bind('click',Login);
    $(".he_nav_register").bind('click',register);

    $(".vip_huiy").mouseenter(function () {
        $(".he_nav_xiala").show()
    });
    $(".vip_huiy").mouseleave(function () {
        $(".he_nav_xiala").hide()
    });
    $(".he_nav_li_hoverT").mouseenter(function () {
        $(this).find("div.zN_zzc").show()
    });
    $(".he_nav_li_hoverT").mouseleave(function () {
        $(this).find("div.zN_zzc").hide()
    });

    $("#goRegister").bind('click',goLogin);
    $("#goLogin").bind('click',goRegister);
    jQuery(".twoRegHd").slide({trigger: "click"});
    //广告窗关闭按钮
    $(".jiqir_close02").click(function () {
        $(this).parent().hide()
    });
    //遮罩层
    setInterval(function () {
        var wenzW = getWidth();
        var wenzH = $(document).height();
        $(".log_reg_zzc").css({"width": wenzW + "px", "height": wenzH + "px"});
    }, 500);
});

function Login(){
    $("#login_register").show();
    $(".log_reg_zzc").show();
    //$(".lr_whiteBG_hb .hd ul .login").trigger("click")
}
function register(){
    $("#reg_register02").show();
    $(".log_reg_zzc").show();
    //$(".lr_whiteBG_hb .hd ul .reg").trigger("click")
}
function goRegister(){
    $("#login_register").show();
    $("#reg_register02").hide();
}
function goLogin(){
    $("#login_register").hide();
    $("#reg_register02").show();
}

function clickDX(e, timeN, str) {
    var _that = $(e);
    var timeNum = timeN;
    //$(e).removeAttr("onclick");
    $(e).attr("disabled", true);
    _that.unbind("click").val(timeNum + "秒后重发");
    var timer = setInterval(function () {
        _that.val(timeNum + "秒后重发");
        timeNum--;
        if (timeNum <= 0) {
            clearInterval(timer);
            $(e).removeAttr("disabled");
            if (str == 1) {
                _that.val("免费获取验证码");
                _that.bind("click", "#anPhone", get_Phonecode);
            } else {
                _that.val("发送邮件");
                _that.bind("click", "#send", sendEmail)
            }

        }
    }, 1000)
}
function isStrictMode() {
    return document.compatMode != "BackCompat"
}
function getHeight() {
    return isStrictMode() ? Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight) : Math.max(document.body.scrollHeight, document.body.clientHeight)
}
function getWidth() {
    return isStrictMode() ? Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth) : Math.max(document.body.scrollWidth, document.body.clientWidth)
}


function zhisyZZC(width, height, rightTopClose, backImg, btnNum, btnOneFont, btnTwoFontL, btnTwoFontR, link) {
    $(".log_reg_zzc").show();
    $(".zishiy_zzcDiv").css({"width": width + "px", "height": height + "px", "display": "block"});
    if (rightTopClose == "show") {
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").show();
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").click(function () {
            $(this).parents("div.zishiy_zzcDiv").hide();
            $(".log_reg_zzc").hide()
        })
    } else {
        $(".zishiy_zzcDiv .zzcDiv_head .head_center .head_center_close").hide()
    }
    if (backImg.indexOf("/") > 0) {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center img.content_center_img").attr("src", backImg)
    } else {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center p").html(backImg)
    }
    if (btnNum == 1) {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn2").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center span.content_center_font").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").val(btnOneFont)
    } else {
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").hide();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn2").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center span.content_center_font").show();
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff").val(btnTwoFontL);
        $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff2").val(btnTwoFontR)
    }
    $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_btn").click(function () {
        $(this).parents("div.zishiy_zzcDiv").hide();
        $(".log_reg_zzc").hide()
    });
    $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff2").click(function () {
        $(this).parents("div.zishiy_zzcDiv").hide();
        $(".log_reg_zzc").hide()
    });
    $(".zishiy_zzcDiv .zzcDiv_content .content_center input.content_center_diff").click(function () {
        location.href = link;
    });

}

//关闭遮罩层
function closeRL(self) {
    $(self).parent().parent().parent().hide();
    $(".log_reg_zzc").hide();
}
function closeRL02(self) {
    $(self).parent().parent().hide();
    $(".log_reg_zzc").hide();
}
//验证函数
var yanz = true;
function webYZ(self, reg, lengthNum) {
    $(self).bind({
        'focus': function () {

        },
        'blur': function () {
            var textVal = $(this).val();
            var regs = reg;
            if (!$(this).val() || !regs.test(textVal) || $(this).val().length < lengthNum) {
                $(this).parent().find("span.miss_login").show();
                yanz = false;
            } else {
                $(this).parent().find("span.miss_login").hide();
                yanz = true;
            }
        }
    });
    return yanz;
}
//验证用户名不能为中文
var yanzhen = true;
function webUser(self, reg, start, end) {
    $(self).bind({
        'focus': function () {

        },
        'blur': function () {
            var regs = reg;
            var textVal = $(this).val();
            if (!$(this).val()) {
                $(this).parent().find("span.miss_login").html("用户名为空!").show();
            }
            //else if ($(this).val().length < start || !$(this).val().length > end) {
            //    $(this).parent().find("span.miss_login").html("用户名必须为3-15个字符!").show();
            //    yanzhen = false;
            //}
            else if ($(this).val() && !regs.test(textVal)) {
                $(this).parent().find("span.miss_login").html("用户名为3-15个字符【不能含有中文】!").show();
                yanzhen = false;
            } else {
                $(this).parent().find("span.miss_login").hide();
                yanzhen = true;
            }
        }
    });
    return yanzhen;
}

//头部搜索
function seaEnter(event) {
    if (event.keyCode == 13) {
        searchEnter($("#keyword").next("div"));
    }
}

function searchEnter(e) {
    var k = $(e).prev("input#keyword").val();
    var r = k.replace(/\//g,'*');
    var u = r.replace(/\+/g,'~');
    if(u.indexOf("?")!=-1){
        var q = u.indexOf("?");
        u=u.substring(0, q+1);
    }
    if (typeof(k) != 'undefined') {
        var url = "/question/k-" + encodeURIComponent(u)+".html";
        window.location.href = url;
    }
}

//重新模考弹窗
function moldTest(link) {
    zhisyZZC("300", "190", "hide", "app/web_core/styles/images/Moldtestagain.png", 2, "", "确 定", "取 消", link);
    //location.href=link;
}

//    双十一悬浮窗随滚动条滚动
$(document).ready(function () {
    var windowH = $(window).height() - 136;//可视区域高度
    var allHeight = document.body.clientHeight;
    var scrollbox = $(".rightBanners");
    $(window).scroll(function () {
        var offsetTop = $(window).scrollTop() + 432;
        scrollbox.stop().animate({top: offsetTop + "px"}, {duration: 500});
    })
});
//双十一关闭
function closeFa(o) {
    $(o).parent().hide();
}


//关闭右边固定部分
function closeFixed(o){
    $(o).parent().fadeOut();
    $(".consult").fadeIn(1000);
}
//点击咨询显示固定部分
function showFixed(o){
    $(o).fadeOut();
    $("#fixed_div").fadeIn(1000);
}
//活动底部固定栏目关闭
function closeNianHui(o){
    $(o).parent().hide();
}

//登录 按钮跳转
function loginHref(){
    var urls=window.location.href;
    window.location.href="http://login.viplgw.cn/cn/index?source=1&url="+urls;
}
//注册 按钮跳转
function registerHref(){
    var urls=window.location.href;
    window.location.href="http://login.viplgw.cn/cn/index/register?source=1&url="+urls;
}
//关闭咨询框
function closeRefer(){
    $(".referBox").slideUp();
    $(".refer_small").fadeIn();
}
//点击小的咨询展示大的咨询
function showZiXun(){
    $(".referBox").slideDown();
    $(".refer_small").fadeOut();
}
//回到顶部
function referTop(){
    $("html,body").animate({scrollTop:0},800);
}