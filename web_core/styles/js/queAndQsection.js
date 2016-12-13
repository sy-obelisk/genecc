$(function(){
    var keyword = $('#keys').val();
    if(keyword){
        //定位search
        location.href="#search";
    }
});
//播放音频答案
function playAnswer(o){
    if($(o).find("audio")[0].paused){
        $(o).find("audio")[0].play();
        $(o).addClass("on");
    }else{
        $(o).find("audio")[0].pause();
        $(o).removeClass("on");
    }
}
//显示我要提问弹框
function questionA(o){
    $(".searchBox").show();
}
//关闭我要提问弹框
function closeSearch(o){
    $('.closeSearch').parent().hide();
}
//判断显示我要提问中需要花费雷豆的那句话
function showLeiD(o,num,diffLD){
    if(num=="1"){
        if(diffLD=='11'){
            $(o).parent().siblings("span.reminder").css("visibility","inherit").find("span>span").html("50");
        }else{
            $(o).parent().siblings("span.reminder").css("visibility","inherit").find("span>span").html("30");
        }
    }else {
        $(o).parent().siblings("span.reminder").css("visibility","hidden").find("span>span").html("");
    }
}
//第一种显示答案的方式
//function oneWay(o){
//    $(o).find("div.showAnswerF").slideToggle();
//}
//第二种显示答案的方式
//function twoWay(o,num){
//    var status=$(o).attr("payStatus");
//    if(num>2){
//        if(status=='1'){
//            $(o).find("div.showAnswerF").slideToggle();
//        }else{
//            $(o).find("div.payMoneyA").slideToggle();
//        }
//    }else{
//        $(o).find("div.showAnswerF").slideToggle();
//    }
//
//}
//点击立即消费可见答案
function payLeiDou(o){
    var askid = $(o).next("input").val();
    var integral = $("#integral").html();
    $.ajax({
        url: '/askleige/ajaxAskOrder', // 跳转到 action
        data: {
            id:askid,
            price:integral/100,
            integral:integral,
            num:1,
            commodity_type:6,
            title:'问题解答',
            check:1,
            consignee:'',
            conphone:'',
            url:'/askleige/index.html',
            img:''
        },
        type: 'POST',
        cache:false,
        dataType:'json',
        success: function (data) {
            if(data.code == 1){
                alert(data.messages);
                $(o).parents("div.payMoneyA").siblings("div.showAnswerF").slideToggle();
                $(o).parents("div.payMoneyA").parent().attr("payStatus","1");
            }else{
                alert(data.messages);
            }
        },
        error: function (data) {
            alert(data.messages);
        }
    });
}
/**
 * 我要提问
 */
function askQuestion(){
    var type='';
    var title=$(".searchB-area textarea").val();
    var price=$("#xiaohao").html();
    $ (".searchB-top ul li input").each(function()
    {
        if($(this).is(":checked")){
           type=$(this).attr("chooseType");
        }
    });
    if(!type){
        alert('请选择类型!');
    }else if(type&&title==''){
        alert('请输入你要提的问题内容!');
    }
    else{
        $.ajax({
            url: '/askleige/ajaxCommitQuestion', // 跳转到 action
            data: {
                title:title,
                type:type,
                price:price
            },
            type: 'POST',
            cache:false,
            dataType:'json',
            success: function (data) {
                if(data.code ==1){
                    alert(data.messages);
                    location.href="/askleige/index.html";
                }if(data.code ==2){
                    alert(data.messages);
                }if(data.code ==3){
                    $("#login_register").show();
                    $(".log_reg_zzc").show();
                }
            },
            error: function (data) {
                alert(data.messages);
            }
        });
    }
}
/**
 * 时间转换
 * @param nS
 * @returns {string}
 */
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
}
/**
 * 问答切换
 * @param o
 * @param num
 * @constructor
 */
function SwitchQuestion(o,num,user){
    if($(o).find("input").is(":checked")){
            var keywords =$("#keys").val();
            var type=$(o).find("input").attr("chooseType");
            if(type>2){
                $(o).parent().siblings("span.reminder").css("visibility","inherit");
            }else{
                $(o).parent().siblings("span.reminder").css("visibility","hidden");
            }
                $.ajax({
                    url: '/askleige/ajaxSwitchQuestion', // 跳转到 action
                    data: {
                        type:type,
                        key:keywords,
                        num:num,
                        user:user
                    },
                    type: 'POST',
                    cache:false,
                    dataType:'json',
                    beforeSend:function(){
                        $(".fengye").append("<li id='loading'>loading...</li>");//显示加载动画
                    },
                    success: function (data) {
                        $(".fengye").empty();//清空数据区
                        var str="";
                        $.each(data.list,function(k,v) {
                            var time = getLocalTime(v.time);
                            if(v.top==1){
                                var img = '<img src=" app/web_core/styles/images/queAq_folderhot.gif" alt="hot图标"/>';
                            }else{
                                var img = '';
                            }
                            if(v.solution == 1){
                               var  on ='onclick="viewAnswer(this)"';
                            }else{
                                var  on ='';
                            }
                            str +='<li '+on+'payStatus="'+ v.order_status+'"  aid="'+ v.id+'">'+
                            '<span style="float: left;color: #0099FF">【'+ v.typename+'】</span>'+
                            '<div class="left-img">'+
                            ''+img+''+
                            '</div>'+
                            '<div class="right-font">'+
                            '<a href="javascript:void(0);"  >'+v.title+'</a>'+
                            '</div>'+
                            '<div style="clear: both"></div>'+
                            '<p>'+time+' 回答：1 提问者：'+v.username+'<span>查看答案</span></p>'+
                            '<div id="aid"></div>'+
                            '</li>';
                        });
                        if(num ==1){
                            $(".SwitchQuestionTrue").html(str);
                            $(".fengyeTrue").html(data.pages);
                        }if(num ==0){
                            $(".SwitchQuestionFalse").html(str);
                            $(".fengyeFalse").html(data.pages);
                        }

                    },
                    error: function () {
                        alert('加载失败！');
                    }
                });
            }
}
/**
 * AJAX分页
 * @param self
 * @param pageNumber
 * @param pageSize
 * @param type
 * @param num
 */
function questionlist(self,pageNumber,pageSize,type,num) {
    $('#' + $(self).attr('t')).val($(self).attr('v'));
        $.ajax({
            url: '/askleige/ajaxSwitchQuestion', // 跳转到 action
            data: {
                pageNumber: pageNumber,
                pageSize: pageSize,
                type: type,
                num: num
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                    var str="";
                    $.each(data.list,function(k,v) {
                        var time = getLocalTime(v.time);
                        if(v.top==1){
                            var img = '<img src=" app/web_core/styles/images/queAq_folderhot.gif" alt="hot图标"/>';
                        }else{
                            var img = '';
                        }
                        str +='<li onclick="viewAnswer(this)" aid="'+ v.id+'">'+
                        '<span style="float: left;color: #0099FF">【'+ v.typename+'】</span>'+
                        '<div class="left-img">'+
                        ''+img+''+
                        '</div>'+
                        '<div class="right-font">'+
                        '<a href="javascript:void(0);">'+v.title+'</a>'+
                        '</div>'+
                        '<div style="clear: both"></div>'+
                        '<p>'+time+' 回答：1 提问者：'+v.username+'</p>'+
                        '</li>'
                    });
                if(num ==1){
                    $(".SwitchQuestionTrue").html(str);
                    $(".fengyeTrue").html(data.pages);
                }if(num ==0){
                    $(".SwitchQuestionFalse").html(str);
                    $(".fengyeFalse").html(data.pages);
                }
            },
            error: function () {
                alert("失败！");
            }
        });
}
/**
 * 查看答案
 */
function viewAnswer(o){
    var id = $(o).attr('aid');
    $.ajax({
        url: 'index.php?web/askleige/ajaxviewAnswer',
        data: {
            id: id
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if(data.code==1){
                var leidou = "";
                var str = "";
                if (data.list.type == 3) {
                    var lei = 50;
                }
                if (data.list.type == 4) {
                    var lei = 30;
                }
                if (data.list.type > 2 && data.list.solution == 1) {
                    <!--需要付费才能查看的答案-->
                    leidou += '<div class="payMoneyA">' +
                    '<div class="payM-left">' +
                    '<span id="integral">' + lei + '</span>雷豆' +
                    '</div>' +
                    '<div class="payM-right">' +
                    '<a href="javascript:void(0);" onclick="payLeiDou(this)">查看答案</a>' +
                    '<input type="hidden" value="' + data.list.id + '" id="askquestionid">' +
                    '<span>消费雷豆可见回答</span>' +
                    '</div>' +
                    '</div>' +
                    '<div style="clear: both"></div>'
                }
                var a_time = getLocalTime(data.list.answer.time);
                str += '<!--答案的第一种显示方式-->' +
                '<div class="showAnswerF">' +
                    '<div class="showA-left">答</div>' +
                        '<div class="showA-right">' +
                            '<span>' + data.list.answer.content + '</span>' +
                            '<span class="timeAnswer">' + a_time + '</span>' +
                        '<div class="bshare-custom" style="margin-top: 30px;">' +
                            '<span>分享到：</span>' +
                            '<a title="分享到QQ空间" class="bshare-qzone"></a>' +
                            '<a title="分享到微信" class="bshare-weixin"></a>' +
                            '<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>' +
                        '</div>' +

                    '</div>' +
                    '<div style="clear: both"></div>'+
                '</div>';
                if (data.list.order_status == '1') {
                    $(o).find("#aid").empty();
                    $(o).find("#aid").append(str);
                } else {
                    $(o).find("#aid").empty();
                    $(o).find("#aid").append(leidou);
                }
            }
            if(data.code ==2){
               alert(data.messages);
            }
            if(data.code ==3){
                $("#login_register").show();
                $(".log_reg_zzc").show();
            }
            $(o).find("#aid").slideToggle();
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}



