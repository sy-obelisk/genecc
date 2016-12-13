$(function(){
//    控制题目难度刷题li显示层次
    var index=$(".timu_choose>ul>li").length;
    var num='-25';
   $(".timu_choose>ul>li").each(function(){
       var peis=$(this).index();
       $(this).css({zIndex:index});
       if(peis!=0){
           $(this).css({marginLeft:parseInt(num)});
       }
       index--;
   });
    //选择题目类型
    $(".cho_box ul li input").click(function(){
        getutkinfo();
    });
    //小题库默认显示
    changeLowerExam("#ogfive",1,'OG15');
    //必考考点默认显示
    changeSection("#luoji",8);
});

function zuoti(e) {
    var login=$("#tikumsg").attr("data-login");
    if (login != '') {//判断是否登录
        var href = '/practise/zuoti&ndzn=1';
        var sectionid = $("input[name='section']:checked").val();
        var level=$("input[name='section']:checked").parents(".choose_mask").parent("li").attr("data-value");
        var step = "doall";
        if (sectionid == '' || typeof(sectionid) == "undefined") {
            $(".log_reg_zzc").show();
            zhisyZZC("276", "166", "show", "app/web_core/styles/images/leixing_bg.png", 1, "噢～", "", "");
            return false;
        } else {
            href = href + '&sectionid=' + sectionid;
        }
        if (level != '' && typeof(level) != "undefined") {
            href = href + '&questionlevel=' + level;
        }
        if (step != '' && typeof(step) != "undefined") {
            href = href + '&step=' + step;
        }
        if ($(e).attr('quit') == 'true') {
            href = href + '&quit=true';
        }
        window.location.href = href;
    } else {
        loginHref();
    }
}
function getutkinfo() {
    var sections = $("input[name='section']:checked").val();
    var levels = $("input[name='section']:checked").parents(".choose_mask").parent("li").attr("data-value");
    var z = '';
    if (z != '' && z != undefined || z != null) {
        //$("#lu_fly").show();
        //$(".log_reg_zzc").show();
        var postdata = {
            step:"doall"//题目状态-->全部
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
                        $("input[name='section']:checked").parents(".cho_box").find(".mas_start").html("继续做题");
                        $("input[name='section']:checked").parents(".cho_box").find(".seeZTresult").css("visibility","inherit");//查看已做题结果按钮
                        //$("#tikumsg").html("此题库你已做题数[" + data.uallnum + "]题，总题数为[" + data.qallnum + "]");
                    }

                } else if (data.code == -1) {
                    //$("#tikumsg").html(data.message);//没登录
                    //跳转到登陆界面
                    loginHref();
                } else {
                    //$("#tikumsg").html("你还没有做过这个题库噢，请点击马上开始做题~");
                    $("input[name='section']:checked").parents(".cho_box").find(".mas_start").html("点击进入");
                    $("input[name='section']:checked").parents(".cho_box").find(".seeZTresult").css("visibility","hidden");
                }
                //$("#lu_fly").hide();
                //$(".log_reg_zzc").hide();
            },
            error: function () {
                alert("sorry!,网络通讯失败！");
            }
        });
    } else {
        alert(z);
    }
}

/**
 * 异步请求获取单项信息
 * @param _this
 * @param id 单项id
 */
function changeSection(_this, id) {
    var str = "";
    $.post('/index.php?web/webapi/getSectionInfo', {sectionId: id}, function (re) {
        str += '<ul>';
        for (i = 0; i < re.length; i++) {
            str += '<li>';
            str += '<a href="/practise/' + re[i].knowsid + '-' + re[i].knows + '.html">';
            str+='<span class="kao_icon">考</span>&nbsp;';
            str+='<span>'+ re[i].knows;
            str+='</span><div class="kao_blue">';
            str += '<p>共题' + re[i].totalnum + '</p><p>';
            if (re[i].ukqnubm > 0) {
                var b = '我做了<b style="color: #d40006;">' + re[i].ukqnubm + '</b>题'
            } else if (re[i].ukqnubm == re[i].totalnum && re[i].totalnum != 0) {
                var b = '已做完';
            } else {
                var b = re[i].num + '人已做'
            }
            str += b;
            str += '</p></div></a></li>';
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
    var str = "",str_cr="",str_rc="",str_ds="",str_ps="",str_awa="";
    $.post('/index.php?web/webapi/getLowerInfo', {twoId:twoId}, function (re) {
        if(re.sc){
            var a='';
            for (i = 0; i < re.sc.length; i++) {
                str += ' <li>' ;
                str+='<a href="/practise/' + re.sc[i].stid + '_' + re.sc[i].sectionid + '_' + re.sc[i].twoobjectid + '_' + re.sc[i].stname + '.html">' ;
                str+='<span class="ku_icon">库</span>&nbsp;' ;
                str+='<span>' + name + ':' + re.sc[i].stname + '</span>' ;
                if(re.sc[i].userlowertk >0 && typeof(re.sc[i].userlowertk) != 'undefined'){
                     a = '已做 '+re.sc[i].userlowertk+' 题';
                }else if(re.sc[i].userlowertk == re.sc[i].lowertknumb && re.sc[i].lowertknumb != 0 && typeof(re.sc[i].userlowertk) != 'undefined'){
                     a = '已做完';
                }else if(re.sc[i].userlowertk == 0 && typeof(re.sc[i].userlowertk) != 'undefined' ){
                     a = '未做题';
                }else{
                     a = '';
                }
                str+='<span class="spe_color">'+a+'</span>' ;
                str+='</a>' ;
                str+='</li>';
            }
            $('#nav_sc').html(str);
        }

        if(re.cr){
            var b='';
            for (i = 0; i < re.cr.length; i++) {
                str_cr += ' <li>' ;
                str_cr+='<a href="/practise/'+re.cr[i].stid+'_'+re.cr[i].sectionid+'_'+re.cr[i].twoobjectid+'_'+re.cr[i].stname+'.html">';
                str_cr+='<span class="ku_icon">库</span>&nbsp;' ;
                str_cr+='<span>' + name + ':' + re.cr[i].stname + '</span>' ;
                if(re.cr[i].userlowertk >0 && typeof(re.cr[i].userlowertk) != 'undefined'){
                    b = '已做 '+re.cr[i].userlowertk+' 题';
                }else if(re.cr[i].userlowertk == re.cr[i].lowertknumb && re.cr[i].lowertknumb != 0 && typeof(re.cr[i].userlowertk) != 'undefined'){
                    b = '已做完';
                }else if(re.cr[i].userlowertk == 0 && typeof(re.cr[i].userlowertk) != 'undefined' ){
                    b = '未做题';
                }else{
                    b = '';
                }
                str_cr+='<span class="spe_color">'+b+'</span>' ;
                str_cr+='</a>' ;
                str_cr+='</li>';
            }
            $('#nav_cr').html(str_cr);
        }

        if(re.rc){
            var c='';
            for (i = 0; i < re.rc.length; i++) {
                str_rc += ' <li>' ;
                str_rc+='<a href="/practise/'+re.rc[i].stid+'_'+re.rc[i].sectionid+'_'+re.rc[i].twoobjectid+'_'+re.rc[i].stname+'.html">';
                str_rc+='<span class="ku_icon">库</span>&nbsp;' ;
                str_rc+='<span>' + name + ':' + re.rc[i].stname + '</span>' ;
                if(re.rc[i].userlowertk >0 && typeof(re.rc[i].userlowertk) != 'undefined'){
                    c = '已做 '+re.rc[i].userlowertk+' 题';
                }else if(re.rc[i].userlowertk == re.rc[i].lowertknumb && re.rc[i].lowertknumb != 0 && typeof(re.rc[i].userlowertk) != 'undefined'){
                    c = '已做完';
                }else if(re.rc[i].userlowertk == 0 && typeof(re.rc[i].userlowertk) != 'undefined' ){
                    c = '未做题';
                }else{
                    c = '';
                }
                str_rc+='<span class="spe_color">'+c+'</span>' ;
                str_rc+='</a>' ;
                str_rc+='</li>';
            }
            $('#nav_rc').html(str_rc);
        }

        if(re.ds){
            var d='';
            for (i = 0; i < re.ds.length; i++) {
                str_ds += ' <li>' ;
                str_ds+='<a href="/practise/'+re.ds[i].stid+'_'+re.ds[i].sectionid+'_'+re.ds[i].twoobjectid+'_'+re.ds[i].stname+'.html">';
                str_ds+='<span class="ku_icon">库</span>&nbsp;' ;
                str_ds+='<span>' + name + ':' + re.ds[i].stname + '</span>' ;
                if(re.ds[i].userlowertk >0 && typeof(re.ds[i].userlowertk) != 'undefined'){
                    d = '已做 '+re.ds[i].userlowertk+' 题';
                }else if(re.ds[i].userlowertk == re.ds[i].lowertknumb && re.ds[i].lowertknumb != 0 && typeof(re.ds[i].userlowertk) != 'undefined'){
                    d = '已做完';
                }else if(re.ds[i].userlowertk == 0 && typeof(re.ds[i].userlowertk) != 'undefined' ){
                    d = '未做题';
                }else{
                    d = '';
                }
                str_ds+='<span class="spe_color">'+d+'</span>' ;
                str_ds+='</a>' ;
                str_ds+='</li>';
            }
            $('#nav_ds').html(str_ds);
        }

        if(re.ps){
            var e='';
            for (i = 0; i < re.ps.length; i++) {
                str_ps += ' <li>' ;
                str_ps+='<a href="/practise/'+re.ps[i].stid+'_'+re.ps[i].sectionid+'_'+re.ps[i].twoobjectid+'_'+re.ps[i].stname+'.html">';
                str_ps+='<span class="ku_icon">库</span>&nbsp;' ;
                str_ps+='<span>' + name + ':' + re.ps[i].stname + '</span>' ;
                if(re.ps[i].userlowertk >0 && typeof(re.ps[i].userlowertk) != 'undefined'){
                    e = '已做 '+re.ps[i].userlowertk+' 题';
                }else if(re.ps[i].userlowertk == re.ps[i].lowertknumb && re.ps[i].lowertknumb != 0 && typeof(re.ps[i].userlowertk) != 'undefined'){
                    e = '已做完';
                }else if(re.ps[i].userlowertk == 0 && typeof(re.ps[i].userlowertk) != 'undefined' ){
                    e = '未做题';
                }else{
                    e = '';
                }
                str_ps+='<span class="spe_color">'+e+'</span>' ;
                str_ps+='</a>' ;
                str_ps+='</li>';
            }
            $('#nav_ps').html(str_ps);
        }

        if(re.awa){
            var f='';
            for (i = 0; i < re.awa.length; i++) {
                str_awa += ' <li>' ;
                str_awa+='<a href="/practise/'+re.awa[i].stid+'_'+re.awa[i].sectionid+'_'+re.awa[i].twoobjectid+'_'+re.awa[i].stname+'.html">';
                str_awa+='<span class="ku_icon">库</span>&nbsp;' ;
                str_awa+='<span>' + name + ':' + re.awa[i].stname + '</span>' ;
                if(re.awa[i].userlowertk >0 && typeof(re.awa[i].userlowertk) != 'undefined'){
                    f = '已做 '+re.awa[i].userlowertk+' 题';
                }else if(re.awa[i].userlowertk == re.awa[i].lowertknumb && re.awa[i].lowertknumb != 0 && typeof(re.awa[i].userlowertk) != 'undefined'){
                    f = '已做完';
                }else if(re.awa[i].userlowertk == 0 && typeof(re.awa[i].userlowertk) != 'undefined' ){
                    f = '未做题';
                }else{
                    f = '';
                }
                str_awa+='<span class="spe_color">'+f+'</span>' ;
                str_awa+='</a>' ;
                str_awa+='</li>';
            }
            $('#nav_awa').html(str_awa);
        }
        $(_this).siblings('li').removeClass('on');
        $(_this).addClass('on');
    }, 'json');
}