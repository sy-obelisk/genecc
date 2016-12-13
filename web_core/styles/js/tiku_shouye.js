$(function () {
    jQuery("#remen_yicuo").slide({trigger: "click"});
    //jQuery("#zhishi_yufa").slide({trigger: "click"});
    jQuery("#classJieshao").slide();
    $(".fenlei_CR_top_in .fenlei_CR_top_in_backg").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "230px", "top": "40px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "49px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_in .fenlei_CR_top_in_backg02").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "230px", "top": "40px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "49px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_inbo .fenlei_CR_top_in_backg").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "182px", "top": "30px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "35px", "top": "50%"}, 1000)
        }
    });
    $(".fenlei_CR_top_inbo .fenlei_CR_top_in_backg02").bind({
        "mouseenter": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "182px", "top": "30px"}, 1000)
        }, "mouseleave": function () {
            var bo_div = $(this).find("div");
            bo_div.animate({"height": "35px", "top": "50%"}, 1000)
        }
    });
    jQuery(".b-desc").slide({trigger: "click"});
    $(".workUl02 li input").click(function () {
        //if ($(this).hasClass("on")) {
        //    $("#section").removeAttr("val");
        //    $("#sec_nandu").removeAttr("val");
        //    $(this).removeClass("on")
        //} else {
        //$("#section").val($(this).find("a input[name='section']").val());
        //$("#sec_nandu").val($(this).find("a input[name='level']").val());
        getutkinfo();
        //}
    });
    $(".gaiban_ZN ul li").bind({
        "mouseenter": function () {
            $(this).animate({marginTop: "-10px"})
        }, "mouseleave": function () {
            $(this).animate({marginTop: "0"})
        }
    });
    $(".left_ndleix ul li").each(function () {
        if ($(this).index() == 7) {
            $(this).css("marginRight", "0")
        }
    });
    $(".gg_close").click(function () {
        $(this).parent().hide()
    });

});
//广告随滚动条滚动js
$(document).ready(function () {
    var scrollbox = $(".tiku_guangg");
    var position = scrollbox.position();
    scrollbox.css("top", 20 + $(document).scrollTop());
    $(window).scroll(function () {
        var offsetTop = 20 + $(document).scrollTop();
        scrollbox.stop().animate({top: offsetTop, marginTop: "0"}, {duration: 800, queue: false})
    })
});

function getutkinfo() {
    var sections = $("input[name='section']:checked").val();
    var levels = $("input[name='level']:checked").val();
    var z = '';
    if (z != '' && z != undefined || z != null) {
        $("#lu_fly").show();
        $(".log_reg_zzc").show();
        var postdata = {
            step: $("input[name='step']:checked").val()
        };
        if (sections != '' && sections != 'undefined') {
            postdata.sectionid = sections;
        }
        if (levels != '' && levels != 'undefined') {
            postdata.questionlevel = levels;
        }
        $.ajax({
            url: '/practise/getutk', // action
            data: postdata,
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    if (data.uallnum > 0) {
                        $(".mas_start").val("继续做题");
                        $("#seeZTresult").show();
                        $("#tikumsg").html("此题库你已做题数[" + data.uallnum + "]题，总题数为[" + data.qallnum + "]");
                    }
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                } else if (data.code == -1) {
                    //$("#tikumsg").html(data.message);//没登录
                    $("#lu_fly").hide();
                    $("#login_register").show();
                } else {
                    $("#tikumsg").html("你还没有做过这个题库噢，请点击马上开始做题~");
                    $(".mas_start").val("马上开始做题");
                    $("#seeZTresult").hide();
                    $("#lu_fly").hide();
                    $(".log_reg_zzc").hide();
                }
            },
            error: function () {
                $("#lu_fly").hide();
                $(".log_reg_zzc").hide();
                alert("sorry!,网络通讯失败！");
            }
        });
    } else {
        alert(z);
    }
}

//
/**
 * 异步请求获取单项信息
 * @param _this
 * @param id 单项id
 */
function changeSection(_this, id) {
    var str = "";
    $.post('index.php?web/webapi/getSectionInfo', {sectionId: id}, function (re) {
        str += '<ul>';
        for (i = 0; i < re.length; i++) {
            str += '<li>';
            str += '<a href="/practise/' + re[i].knowsid + '-' + re[i].knows + '.html">';
            str+='<div class="kaoTest ';
            if (re[i].ukqnubm > 0) {
                var a = ' kaoTestBG" >';
            } else {
                var a = ' " >';
            }
            str += a;
            str+='<div class="kaoIcon"><span>考</span> </div><span>'+ re[i].knows;
            str+='</span><div class="arrowsIcon"></div><div class="zzcIcon">';
            str += '<span>共题' + re[i].totalnum + '<br/>';
            if (re[i].ukqnubm > 0) {
                var b = '我做了<b style="color: #d40006;">' + re[i].ukqnubm + '</b>题'
            } else if (re[i].ukqnubm == re[i].totalnum && re[i].totalnum != 0) {
                var b = '已做完';
            } else {
                var b = re[i].num + '人已做'
            }
            str += b;
            str += '</span></div></div></a></li>';
        }
        str += '</ul>';

        $(_this).siblings('li').removeClass('on');
        $(_this).addClass('on');
        $('#sectionKnows').html(str);
    }, 'json');
}

/**
 * 获取单项来源题库
 * @param _this 点击对象
 * @param id 单项Id
 * @param twoId 来源Id
 * @param name 来源名
 */
function changeLowerExam(_this,twoId,name){
    var str = "";
    $.post('index.php?web/webapi/getLowerInfo', {twoId:twoId}, function (re) {

        if(re.sc){
            str +='<li>';
            str +='<h4>句子改错SC</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.sc.length; i++){
                str +='<li>';
                str +='<a href="/practise/'+re.sc[i].stid+'_'+re.sc[i].sectionid+'_'+re.sc[i].twoobjectid+'_'+re.sc[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.sc[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.sc[i].userlowertk >0 && typeof(re.sc[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.sc[i].userlowertk+' 题';
                }else if(re.sc[i].userlowertk == re.sc[i].lowertknumb && re.sc[i].lowertknumb != 0 && typeof(re.sc[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.sc[i].userlowertk == 0 && typeof(re.sc[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }


        if(re.cr){
            str +='<li>';
            str +='<h4>逻辑CR</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.cr.length; i++) {;
                str +='<li>';
                str +='<a href="/practise/'+re.cr[i].stid+'_'+re.cr[i].sectionid+'_'+re.cr[i].twoobjectid+'_'+re.cr[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.cr[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.cr[i].userlowertk >0 && typeof(re.cr[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.cr[i].userlowertk+' 题';
                }else if(re.cr[i].userlowertk == re.cr[i].lowertknumb && re.cr[i].lowertknumb != 0 && typeof(re.cr[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.cr[i].userlowertk == 0 && typeof(re.cr[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }



        if(re.rc){
            str +='<li>';
            str +='<h4>阅读RC</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.rc.length; i++) {
                str +='<li>';
                str +='<a href="/practise/'+re.rc[i].stid+'_'+re.rc[i].sectionid+'_'+re.rc[i].twoobjectid+'_'+re.rc[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.rc[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.rc[i].userlowertk >0 && typeof(re.rc[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.rc[i].userlowertk+' 题';
                }else if(re.rc[i].userlowertk == re.rc[i].lowertknumb && re.rc[i].lowertknumb != 0 && typeof(re.rc[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.rc[i].userlowertk == 0 && typeof(re.rc[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }



        if(re.ds){
            str +='<li>';
            str +='<h4>数学DS</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.ds.length; i++) {
                str +='<li>';
                str +='<a href="/practise/'+re.ds[i].stid+'_'+re.ds[i].sectionid+'_'+re.ds[i].twoobjectid+'_'+re.ds[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.ds[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.ds[i].userlowertk >0 && typeof(re.ds[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.ds[i].userlowertk+' 题';
                }else if(re.ds[i].userlowertk == re.ds[i].lowertknumb && re.ds[i].lowertknumb != 0 && typeof(re.ds[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.ds[i].userlowertk == 0 && typeof(re.ds[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }



        if(re.ps){
            str +='<li>';
            str +='<h4>数学PS</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.ps.length; i++) {
                str +='<li>';
                str +='<a href="/practise/'+re.ps[i].stid+'_'+re.ps[i].sectionid+'_'+re.ps[i].twoobjectid+'_'+re.ps[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.ps[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.ps[i].userlowertk >0 && typeof(re.ps[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.ps[i].userlowertk+' 题';
                }else if(re.ps[i].userlowertk == re.ps[i].lowertknumb && re.ps[i].lowertknumb != 0 && typeof(re.ps[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.ps[i].userlowertk == 0 && typeof(re.ps[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }



        if(re.awa){
            str +='<li>';
            str +='<h4>作文AWA</h4>'
            str +='<div class="singleBanner">';
            str +='<div class="singleHd hd">';
            str +='<a href="javascript:;" class="prev"><i class="fa fa-arrow-circle-up"></i></a>';
            str +='<a href="javascript:;" class="next"><i class="fa fa-arrow-circle-down"></i></a>';
            str +='</div>';
            str +='<div class="rightBd">';
            str +='<ul>';
            for (i = 0; i < re.awa.length; i++) {
                str +='<li>';
                str +='<a href="/practise/'+re.awa[i].stid+'_'+re.awa[i].sectionid+'_'+re.awa[i].twoobjectid+'_'+re.awa[i].stname+'.html">';
                str +='<div class="kuTest">';
                str +='<div class="kuIcon">';
                str +='<span>库</span>';
                str +='</div>';
                str +='<span>【'+name+'】 '+re.awa[i].stname+'</span>';
                str +='<div class="arrowRight"></div>';
                str +='</div>';
                str +='</a>';
                if(re.awa[i].userlowertk >0 && typeof(re.awa[i].userlowertk) != 'undefined'){
                    var a = '已做 '+re.awa[i].userlowertk+' 题';
                }else if(re.awa[i].userlowertk == re.awa[i].lowertknumb && re.awa[i].lowertknumb != 0 && typeof(re.awa[i].userlowertk) != 'undefined'){
                    var a = '已做完';
                }else if(re.awa[i].userlowertk == 0 && typeof(re.awa[i].userlowertk) != 'undefined' ){
                    var a = '未做题';
                }else{
                    var a = '';
                }
                str +='<span class="fontPosition">'+a+'</span>';
                str +='</li>';
            }
            str +='</ul>';
            str +='</div>';
            str +='</div>';
            str +='<script type="text/javascript">';
            str +='jQuery(".singleBanner").slide({mainCell:".rightBd ul",autoPage:true,effect:"top",scroll:5,vis:5,trigger:"click",pnLoop:false});';
            str +='</script>';
            str +='</li>';
        }


        $(_this).siblings('li').removeClass('on');
        $(_this).addClass('on');
        $('#lowerContent').html(str);
    }, 'json');
}