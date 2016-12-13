$(function () {
    //课程推荐
    $(".hy_cV_in_div").eq(0).css("marginRight","18px");
    $(".hy_cV_in_div").eq(1).css("marginRight","18px");

    //$(".hy_l_liebiao li").click(function () {
    //    var indexLI = $(this).index();
    //    $(".huiy_r_content").eq(indexLI).show();
    //    $(".huiy_r_content").eq(indexLI).siblings().hide();
    //    $(this).css("border", "1px #00b7ff solid");
    //    $(this).siblings().css("border", "none");
    //    $(this).find("a").css("color", "#00b6ff");
    //    $(this).find("a").parent().siblings().find("a").css("color", "black");
    //    $(this).find("img").show();
    //    $(this).siblings().find("img").hide();
    //});
    //if (huiy_num) {
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).css("border", "1px #00b7ff solid");
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).siblings().css("border", "none");
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).find("a").css("color", "#00b6ff");
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).find("a").parent().siblings().find("a").css("color", "black");
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).find("img").show();
    //    $(".hy_l_liebiao li").eq(huiy_num - 1).siblings().find("img").hide();
    //    $(".huiy_r_content").eq(huiy_num - 1).show();
    //    $(".huiy_r_content").eq(huiy_num - 1).siblings().hide()
    //}

    $("#user_btn").click(function () {
        $(".he_nav_xiala").slideToggle()
    });
    $("#my_phone").blur(function () {
        var reg = /^0{0,1}(13[0-9]|15[0-9]|18[2-9])[0-9]{8}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span#phone_span").show()
        } else {
            $(this).parent().find("span#phone_span").hide()
        }
    });
    $("#youxiang").blur(function () {
        var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if ($(this).val() == "" || !reg.test($(this).val())) {
            $(this).parent().find("span#youx_span").show()
        } else {
            $(this).parent().find("span#youx_span").hide()
        }
    });
    $("#oldCode").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span#old_span").show()
        } else {
            $(this).parent().find("span#old_span").hide()
        }
    });
    $("#newCode").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6) {
            $(this).parent().find("span#newCode_span").show()
        } else {
            $(this).parent().find("span#newCode_span").hide()
        }
    });
    $("#newCodeTwo").blur(function () {
        var reg = /^[A-Za-z0-9_-]+$/;
        if ($(this).val() == "" || !reg.test($(this).val()) || parseInt($(this).val().length) < 6 || $("#newCode").val() != $(this).val()) {
            $(this).parent().find("span#newCodeTwo_span").show()
        } else {
            $(this).parent().find("span#newCodeTwo_span").hide()
        }
    });

    //雷豆换购课程默认选中
    var leiStr=location.search.split("&");
    if(leiStr[2]=='commodiy_type=3'){
        $("#videoClass ul li").eq(2).trigger("click");
    }
});

function seeJshow(){
    $(".jifen_xiangxi table").slideToggle();
}
function slideZS(self){
    if($(self).hasClass("fa-sort-asc")){
        $(self).addClass("fa-sort-desc");
        $(self).removeClass("fa-sort-asc");
        $(self).next("ol").slideDown("slow");
    }else{
        $(self).addClass("fa-sort-asc");
        $(self).removeClass("fa-sort-desc");
        $(self).next("ol").slideUp("slow");
    }
}
function askLeave(){
    $('.log_reg_zzc').show();
    $('.ask_leave').show();
}
function shenQclose(){
    $('.log_reg_zzc').hide();
    $('.ask_leave').hide();
}
function deletes(self){
    var noteid = $('#noteid').val();
    $.ajax({
        url: '/user/ajaxDelnote', // 跳转到 action
        data: {
            noteid:noteid
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                $(self).parent().parent().parent().remove();
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
var oldVal='';
function bianji(self){
    var htmls=$(self).parent().siblings("li.teaMess").html();
    $(self).parent().siblings("li.teaMess").html("<textarea>"+htmls+"</textarea>");
    oldVal=$(self).parent().siblings("li.teaMess").find("textarea").val();
    $(self).parent().html('<a href="#" class="biji_delete" onclick="noSaveXG(this,oldVal)">取消</a> <a href="#" class="biji_bianji" onclick="saveXG(this)">保存</a>');
}
function saveXG(self){
    var html=$(self).parent().siblings("li.teaMess").find("textarea").val();
    var id=$(self).parents("ol").next("input").val();
    $.ajax({
        url: '/user/ajaxeditnote', // 跳转到 action
        data: {
            notes:html,
            noteid:id
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                $(self).parent().siblings("li.teaMess").html(html);
                $(self).parent().html('<a href="#" class="biji_delete" onclick="deletes(this)">删除</a> <a href="#" class="biji_bianji" onclick="bianji(this)">编辑</a>');
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });


}
function noSaveXG(self,oldVal){
    $(self).parent().siblings("li.teaMess").html(oldVal);
    $(self).parent().html('<a href="#" class="biji_delete" onclick="deletes(this)">删除</a> <a href="#" class="biji_bianji" onclick="bianji(this)">编辑</a>');
}

function showAnswer(self){
    $(self).next("b.banswer").show();
}
//ajax 切换购课记录
function Record(self,a){
    $.ajax({
        url: '/user/ajaxRecord', // 跳转到 action
        data: {
            type:a
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            var publicstr ="";
            var livestr ="";
            var leidoustr ="";
            var vipstr ="";
            var videostr ="";
            var activeTime="";
            var videorow = "";
            var livesdkstr = "";
            if (data) {
                    $.each(data.msg,function(k,v) {

                        if(v.commodity_type == '2'){
                        publicstr += '<li>'+
                        '<div class="zhiboGk">'+
                        '<div class="zG_left"><img src="'+v.course.contentthumb+'" alt="课程图片"/></div>'+
                        '<div class="zG_center">'+
                        '<p>'+v.course.contenttitle+'</p>'+
                        '<ol>'+
                        '<li>开课时间：<span style="color: #d63240">'+v.course.times+'</span></li>'+
                        '<li>主讲老师：'+v.course.teacher+'</li>'+
                        '<li>购买时间：'+v.goods.time+'</li>'+
                        '</ol>'+
                        '<span class="redTS">'+v.goods.msg+'</span>'+
                        '</div>'+
                        '<div class="zG_right">'+
                        '<p>原价：￥'+v.course.price+'</p>'+
                        '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                        '<a href="'+v.url+'" style="">'+
                        '<input type="button" value="查看详情"/>'+
                        '</a>'+
                        '<a href="'+v.goods.url+'" style="">'+
                        '<input type="button" value="'+ v.goods.title+'"/>'+
                        '</a>'+
                        '</div>'+
                        '</div>'+
                        '</li>'
                        }else if(v.commodity_type == '1'){
                            if(v.video){
                                $.each(v.video,function(e,q) {
                                    if(q['-']==1){
                                        videorow+=' <div style="clear: both"></div>'+
                                        '<div style="width: 100%;border: 1px #04a8f4 solid;margin: 30px 0 30px 0;"></div>';

                                    }else{
                                        videorow +='<a href="/livevideo/'+ v.order_id+'-'+(e+1)+'.html" target="_blank">'+
                                        '<button type="button" value="">'+ q.name+'</button>'+
                                        '</a>'
                                    }
                                });
                            }else{
                                videorow = '';
                            }
                            if(v.livesdk.LIVESDKID){
                                livesdkstr ='<a href="'+v.goods.url+'" style=""><input type="button" value="'+ v.goods.title+'"/>';

                            }else{
                                livesdkstr ='';
                            }

                            livestr += '<li>'+
                            '<div class="zhiboGk">'+
                            '<div class="zG_left"><img src="'+v.course.contentthumb+'" alt="课程图片"/></div>'+
                            '<div class="zG_center">'+
                            '<p>'+v.course.contenttitle+'</p>'+
                            '<ol>'+
                            '<li>开课时间：<span style="color: #d63240">'+v.course.times+'</span></li>'+
                            '<li>主讲老师：'+v.course.teacher+'</li>'+
                            '<li>购买时间：'+v.goods.time+'</li>'+
                            '</ol>'+
                            '<span class="redTS">'+v.goods.msg+'</span>'+
                            '</div>'+
                            '<div class="zG_right">'+
                            '<p>原价：￥'+v.course.price+'</p>'+
                            '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                            '<a href="'+v.url+'" style="">'+
                            '<input type="button" value="查看详情"/>'+
                            '</a>'+
                            ''+livesdkstr+''+
                            '</a>'+
                            '</div>'+
                            '</div>'+
                            '<div class="showVideo">'+
                            ''+videorow+''+
                            '</div>'+
                            '</li>'
                        }else if(v.commodity_type == '3'){
                            var time=getLocalTime(v.buy_time);
                            if(v.course.times=='' || v.course.times== null){
                                activeTime='';
                            }else{
                                activeTime='<li>活动时间：'+v.course.times+'<span style="color: #d63240"></span></li>';
                            }
                            leidoustr +='<li id="leidou">'+
                            '<div class="zhiboGk">'+
                            '<div class="zG_left"><img src="app/web_core/styles/images/leidou_huangou.jpg" alt="课程图片"/></div>'+
                            '<div class="zG_center">'+
                            '<p>'+v.title+'</p>'+
                            '<ol>'+
                            '<li>数量：'+v.commodity_Num+'<span style="color: #d63240"></span></li>'+
                            '<li>时间：'+time+'<span style="color: #d63240"></span></li>'+activeTime+'</ol>'+
                            '</div>'+
                            '<div class="zG_right">'+
                            '<p>原价：￥'+v.price+'</p>'+
                            '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                            '<a href="'+v.url+'" style="">'+
                            '<input type="button" value="查看详情"/>'+
                            '</a>'+
                            '<a href="'+v.goods.url+'" style="">'+
                            '<input type="button" value="'+ v.goods.title+'"/>'+
                            '</a>'+
                            '</div>'+
                            '</div>'+
                            '</li>'
                        }else if(v.commodity_type == '7'){
                            var time=getLocalTime(v.buy_time);
                            if(v.course.times=='' || v.course.times== null){
                                activeTime='';
                            }else{
                                activeTime='<li>活动时间：'+v.course.times+'<span style="color: #d63240"></span></li>';
                            }
                            vipstr +='<li id="vip">'+
                            '<div class="zhiboGk">'+
                            '<div class="zG_left"><img src="app/web_core/styles/images/vip001.png" alt="课程图片"/></div>'+
                            '<div class="zG_center">'+
                            '<p>'+v.title+'</p>'+
                            '<ol>'+
                            '<li>数量：'+v.commodity_Num+'<span style="color: #d63240"></span></li>'+
                            '<li>时间：'+time+'<span style="color: #d63240"></span></li>'+activeTime+''+
                            '<li>购买时间：'+v.goods.time+'</li>'+
                            '</ol>'+
                            '<span class="redTS">'+v.goods.msg+'</span>'+
                            '</div>'+
                            '<div class="zG_right">'+
                            '<p>原价：￥'+v.price+'</p>'+
                            '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                            '<a href="/shop/vip/" style="">'+
                            '<input type="button" value="查看详情"/>'+
                            '</a>'+
                            '</div>'+
                            '</div>'+
                            '</li>'
                        }else if(v.commodity_type == '5'){
                            var time=getLocalTime(v.buy_time);
                            if(v.course.times=='' || v.course.times== null){
                                activeTime='';
                            }else{
                                activeTime='<li>活动时间：'+v.course.times+'<span style="color: #d63240"></span></li>';
                            }
                            videostr +='<li id="video">'+
                            '<div class="zhiboGk">'+
                            '<div class="zG_left"><img src="app/web_core/styles/images/course001.jpg" alt="课程图片"/></div>'+
                            '<div class="zG_center">'+
                            '<p>'+v.title+'</p>'+
                            '<ol>'+
                            '<li>数量：'+v.commodity_Num+'<span style="color: #d63240"></span></li>'+
                            '<li>时间：'+time+'<span style="color: #d63240"></span></li>'+activeTime+''+
                            '<li>购买时间：'+v.goods.time+'</li>'+
                            '</ol>'+
                            '<span class="redTS">'+v.goods.msg+'</span>'+
                            '</div>'+
                            '<div class="zG_right">'+
                            '<p>原价：￥'+v.price+'</p>'+
                            '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                            '<a href="'+v.url+'" style="">'+
                            '<input type="button" value="查看详情"/>'+
                            '</a>'+
                            '<a href="'+v.goods.url+'" style="">'+
                            '<input type="button" value="'+ v.goods.title+'"/>'+
                            '</a>'+
                            '</div>'+
                            '</div>'+
                            '</li>'
                        }else if(v.commodity_type == '8'){
                            var time=getLocalTime(v.buy_time);
                            var sdk = '';
                            if(v.course.times=='' || v.course.times== null){
                                activeTime='';
                            }else{
                                activeTime='<li>活动时间：'+v.course.times+'<span style="color: #d63240"></span></li>';
                            }

                            if(v.livesdk.LIVESDKID){
                                sdk = '<a href="'+v.goods.url+'" style="">'+'<input type="button" value="'+ v.goods.title+'"/>'+'</a>'
                            } if(v.order_status==0){
                                sdk = '<a href="'+v.goods.url+'" style="">'+'<input type="button" value="'+ v.goods.title+'"/>'+'</a>'
                            }if(v.order_status==1){
                                if(v.video){
                                    $.each(v.video,function(e,q) {
                                        videorow +='<a href="/livevideo/'+ v.order_id+'-'+(e+1)+'.html" target="_blank">'+
                                        '<button type="button" value="">'+ q.name+'</button>'+
                                        '</a>'
                                    });
                                }else{
                                    videorow = '';
                                }
                            }
                            videostr +='<li id="video">'+
                            '<div class="zhiboGk">'+
                            '<div class="zG_left"><img src="app/web_core/styles/images/course001.jpg" alt="课程图片"/></div>'+
                            '<div class="zG_center">'+
                            '<p>'+v.title+'</p>'+
                            '<ol>'+
                            '<li>数量：'+v.commodity_Num+'<span style="color: #d63240"></span></li>'+
                            '<li>时间：'+time+'<span style="color: #d63240"></span></li>'+activeTime+''+
                            '<li>购买时间：'+v.goods.time+'</li>'+
                            '</ol>'+
                            '<span class="redTS">'+v.goods.msg+'</span>'+
                            '</div>'+
                            '<div class="zG_right">'+
                            '<p>原价：￥'+v.price+'</p>'+
                            '<p style="color: green">'+v.goods.name+'：￥'+v.account+'</p>'+
                            '<a href="'+v.url+'" style="">'+
                            '<input type="button" value="查看详情"/>'+
                            '</a>'+
                            ''+sdk+''+
                            '</div>'+
                            '</div>'+
                            '<div class="showVideo">'+
                            ''+videorow+''+
                            '</div>'+
                            '</li>'
                        }
                        $("#LiveClass").html(livestr);
                        $("#publicClass").html(publicstr);
                        $("#leidou").html(leidoustr);
                        $("#vips").html(vipstr);
                        $("#videos").html(videostr);
                    });
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
}

function quxiaoshoucang(questionid,o){ //这个是收藏题的ajax
    var questionid=questionid;
    $.ajax({
        url : 'index.php?web/user/shoucang', // 跳转到 action
        data : {
            questionid : questionid
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            //alert(data.message);
            if(data.code==1){
                window.location.href = '/user/collect';
            }
        }
    });
}

function info(m,o){
    if(m==0){
        var photo=$("#btn_file").val();
        var nickname=$("#nickname").val();
        var phone=$("#my_phone").val();
        var v_phone = $("#my_phone").attr('v');
        var phonecode=$("#p_code").val();
        var email=$("#my_email").val();
        var v_email = $("#my_email").attr('v');
        var emailcode=$("#e_code").val();
        var qq=$("#qq").val();
        var school=$("#school").val();
        var profes=$("#profes").val();
        var gra=$("#gra").val();
        var country=$("#country_sec").val();
        var provice=$("#provice_sec").val();
        var city=$("#city_sec").val();
        var personstatus=$("input[name='stu']:checked").val();
        var reg = /^(13|15|18|14)\d{9}$/;
        var reg_email=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        var reg_qq=/^[1-9]*[1-9][0-9]*$/;
        if (!reg.exec(phone)) {
            $("#phone_span").show();
            return false;
        }else{
            $("#phone_span").show();
            $("#phone_span").text("输入正确");
        }
        if(!reg_email.exec(email)){
            $("#youx_span").show();
            return false;
        }else{
            $("#youx_span").show();
            $("#youx_span").text("输入正确");
        }
        if(!reg_qq.exec(qq)){
            $("#qq_span").show();
            return false;
        }else{
            $("#qq_span").show();
            $("#qq_span").text("输入正确");
        }
    }
    if(m==1){
        var oldpwd=$("#oldCode").val();
        var newpwd=$("#newCode").val();
        var againpwd=$("#newCodeTwo").val();
        if(againpwd!=newpwd){
            alert('两次密码不一致，请重新输入');
            return false;
        }
    }
    $.ajax({
        url : '/user/update', // 跳转到 action
        data : {
            nickname : nickname,
            phone : phone,
            phonecode : phonecode,
            email : email,
            emailcode : emailcode,
            qq : qq,
            school : school,
            profes : profes,
            gra : gra,
            country : country,
            provice : provice,
            city : city,
            personstatus : personstatus,
            photo: photo,
            newpwd : newpwd,
            oldpwd : oldpwd,
            v_phone : v_phone,
            v_email : v_email
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            alert(data.message);
            window.location.reload();
        },
        error : function() {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });

}


function dianji(o,s){
    var pid=$(o).val();

    $.ajax({
        url : '/user/areaajax', // 跳转到 action
        data : {
            pid : pid
            //传的值是字符型
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            if(data.code==1){
                //alert('ss');
                var str="";
                if(s=='cou'){
                    $.each(data.data,function(k,v){
                        str+='<option class="provice" value="'+ v.areaid+'">'+ v.area+'</option>';
                    })
                    $(".provice").remove();
                    $("#pro_next").after(str);
                    return false;
                }
                if(s=='pro'){
                    $.each(data.data,function(k,v){
                        str+='<option class="city" value="'+ v.areaid+'">'+ v.area+'</option>';
                    })
                    $(".city").remove();
                    $("#city_next").after(str);
                    return false;
                }
                /*if(pid==''){
                 $("#provinces_sec").html();
                 $("#city_sec").html();
                 }*/
            }

            if(data.code==2){
                var str="";
                str+='<option class="provice" selected="selected" value="'+ data.data.areaid+'">'+ data.data.area+'</option>';
                $(".provice").remove();
                $("#pro_next").after(str);
                $(".city").remove();
                $("#city_next").after(str);
                return false;

            }
        }
    });
}




function F_Open_dialog()
{
    document.getElementById("btn_file").click();
    $("#img").attr("src",$("#btn_file").val());
}


function genggai(){
    $("#my_phone").removeAttr("readonly");
    $("#my_phone").css("background-color","white");
    $("#my_phone").attr('v','1');
    $("#phonecode").css('display','block')
}
function changeEmail(){
    $("#my_email").removeAttr("readonly");
    $("#my_email").css("background-color","white");
    $("#my_email").attr('v','1');
    $("#emailcode").css('display','block')
}
/**
 * 手机验证码
 * @param e
 * @returns {boolean}
 */
function getPhonecode(e) {
    var Phonenum = $("#my_phone").val();
    if (Phonenum != '' && Phonenum.match(/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/)) {
        $.ajax({
            url: 'index.php?web/webapi/phonecode', // 跳转到 action
            data: {
                Phonenum: Phonenum
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    clickDX(e, 60, 1);
                } else {
                    alert(data.message);
                    $("#yz_phone").html(data.message);
                }
            },
            error: function () {
                alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
            }
        });
    } else {
        $("#yz_phone").html('手机号码有误！请重新输入');
        return false;
    }
}
//发送邮件函数
function getEmail(self, inputVal) {
    var email = $(inputVal).val();
    if (email) {
        $(self).val("邮件发送中");
    }
    $.post("index.php?web/information/mail", {emails: email}, function (msg) {
        if (msg == 1) {
            clickDX(self, 120, 2);
            $("#result").html("发送成功，请注意查收您的邮件！").css({color: 'orange', fontSize: '12px'});
        } else {
            $("#result").html(msg).css({color: 'orange', fontSize: '12px'});
        }
    });
}
function messages(userid,o,states){

    $.ajax({
        url : '/user/messages', // 跳转到 action
        data : {
            userid : userid,
            states : states
            //传的值是字符型
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            if(data.code==1){
                var str='';
                $.each(data.messageslist,function(k,v){
                    str+='<li>';
                    if(v.states=='0'){
                        str+='<a href="javascript:;"  class="read">【<span style="color: #8b0000;">未读</span>】</a> '
                    }else{
                        str+='<a href="javascript:;" class="read">【<span style="color: green;">已读</span>】</a> '
                    }
                    str+='<span>'+ v.title+'</span><br>';
                    if(v.questionid!=null){
                        if(v.states=='0'){
                            str+='<a href="javascript:void(0);"  onclick="states('+ v.id+',this)">' +
                            '<p>你对题目：“'+ v.section+'-'+ v.twoobject+'-'+ v.questionid+':'+ v.question.substr(0,30)+'...” 提出的疑问，已得到回复。</a>'+
                            '&nbsp;&nbsp;<input type="button" onclick="dele_message('+ v.id+')" value="删除" class="delete" style="float: right">'+
                            '<a onclick="states('+ v.id+',this,\''+v.questionid+'\')" class="delete" style=" background: #0099FF;float: right;margin-right: 10px">查看回复</a>' +
                            '</p>';
                        }else{
                            str+='<p style="color: #aaa">你对题目：“'+ v.section+'-'+ v.twoobject+'-'+ v.questionid+':'+ v.question.substr(0,30)+'...” 提出的疑问，已得到回复。'+
                            '&nbsp;&nbsp;<input type="button" onclick="dele_message('+ v.id+')" value="删除" class="delete" style="float: right">'+
                            '<a onclick="states('+ v.id+',this,\''+v.questionid+'\')" class="delete" style=" background: #0099FF;float: right;margin-right: 10px">查看回复</a>' +
                            '</p>';
                        }
                    }else{
                        if(v.states=='0'){
                            str+='<p><a href="javascript:void(0);"  onclick="states('+ v.id+',this)">' +
                            ''+ v.content+'' +
                            '</a></p>'+
                            '&nbsp;&nbsp;<input type="button" onclick="dele_message('+ v.id+')" value="删除" class="delete" style="float: right">';
                        }else{
                            str+='<p>'+ v.content+'</p>'+
                            '&nbsp;&nbsp;<input type="button" onclick="dele_message('+ v.id+')" value="删除" class="delete" style="float: right">';
                        }
                    }

                    str+='</li>';
                });
                $("#news_ul").html(str);
                $(".on").removeClass('on');
                $(o).addClass('on');
            }
        }
    });
}

function states(messageid,o,questionid){
    $.ajax({
        url : '/user/messagestate', // 跳转到 action
        data : {
            //userid : userid,
            messageid : messageid,
            questionid : questionid
            //传的值是字符型
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            if(questionid && typeof(questionid)!="undefined" && questionid!=0){
                window.location.href = '/question/tiku_meidaoti&questionid='+questionid;
            }else {
                if (data.code == 1) {
                    if (data.states == '1') {
                        $(o).parent().siblings("a.read").html("【<span>已读</span>】").find("span").css("color","green");
                        $(o).css("color","#aaa").removeAttr("onclick");
                    }
                }
            }
        }
    });
}

function upcallbact(imgurl,msg){
    $('.update_bigImg').html('<img src="/'+imgurl+'" alt="'+msg+'" />');
    $('.update_middleImg').html('<img src="/'+imgurl+'" alt="'+msg+'" />');
    $('.hy_l_touxiang').html('<img src="/'+imgurl+'" alt="'+msg+'"  />');
    $('.success_shangc').html(msg);
}

function ckqb(){
    $("#allmk").removeAttr("style")
}

function dele_message(messageid){
    $.ajax({
        url : '/user/dele_message', // 跳转到 action
        data : {
            messageid : messageid
            //传的值是字符型
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            if(data.code==1){
                window.location.href="/user/message";
            }

        }
    });
}

function scmk(id,mkid){
    $.ajax({
        url : '/user/dele_mk', // 跳转到 action
        data : {
            id : id,//模考结果id
            mkid: mkid
            //传的值是字符型
        },
        type : 'post',
        cache : false,
        dataType : 'json',
        success : function(data) {
            if(data.code==1){
                window.location.href="/user/modelRecord";
            }

        }
    });
}

function deleteorder(o){
    var orderid = $(o).attr('orderid');
    if(confirm("确认删除么？删除订单后将不能恢复噢~")) {
        $.ajax({
            url : '/user/deleteorder',
            data : {
                order_id : orderid
            },
            type : 'post',
            cache : false,
            dataType : 'json',
            success : function(data) {
                if(data.code==1){
                    window.location.reload();
                }
            }
        });
    }
}

