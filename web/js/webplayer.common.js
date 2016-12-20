/**
 * webplayer common
 * Author: Feil.Wang
 * Date: 2013.07
 */

var channel = GS.createChannel();
var videoduration;
var myslider;
var time_z=360;
var st
var time_test;
var type;
var sdk;
var stype=0;
$(function () {
    channel.bind("onFileDuration", function (event) {
        videoduration = event.data.duration;
        time_test = videoduration*0.3;
        type = $('#type').val();
        sdk = $('#sdk').val();
    });
    //PlayheadTime监听
    channel.bind("onPlayheadTime", function (event) {
        var width=event.data.playheadTime/videoduration*100;
        var nowTime = event.data.playheadTime;
        if(type==1 && time_test>0 && width){
            //console.log(time_test);
            channel.send("seek", {"timestamp":time_test});//跳转到指定时间点
            time_test=0;
        }else{
            if(width>30 && type != 1){
                $.post("/index/judge",{sdk:sdk,nowTime:nowTime},function(data){
                    if(data.code!=1){
                        stype=1;
                        //显示打赏弹窗
                        $(".form-maskLayer").show();
                        $(".form-font").show();
                        channel.send("pause", {});
                    }
                })
            }
            $(".progress-bar-buffer").css("width", event.data.downloadProgress + "%");//下载百分比
            $("#playerProgressBar").slider('value', width);//滚动条
            $(".progress-bar-elapsed").width(width+"%");
            var intDiff= parseInt((videoduration-event.data.playheadTime)/1000);
            var intAdd=parseInt(event.data.playheadTime/1000);
            timerDif(intDiff);
            timeradd(intAdd);
        }

    });
    //Seek监听
    channel.bind("onSeekCompleted", function (event) {
        channel.send("play", {});
        myslider = setInterval(callplay, time_z);
        $("#playBtn").attr({
            "class": "btn-pause",
            "title": "暂停"
        });
    });

    myslider = setInterval(callplay,time_z);
    function callplay() {
        channel.send("playheadTime", {});
    }

    webplayer.init();
    $(window).resize(function (e) {
        if (e.target.tagName == undefined) {
            webplayer.resizeInit();
            $(".control-container,.video-container,.ppt-container").draggable("enable");
            $(".control-container,.video-container,.ppt-container").resizable("enable");
        }
    });

    //模拟播放、暂停
    $("#playBtn").click(function () {
        if ($(this).hasClass("btn-pause")) {
            $(this).attr({
                "class": "btn-play",
                "title": "播放"
            });
            channel.send("pause", {});
        } else {
            $(this).attr({
                "class": "btn-pause",
                "title": "暂停"
            });
            channel.send("play", {})
        }

    });

    //模拟静音
    $("#soundBtn").click(function () {
        if ($(this).hasClass("horn-icon")) {
            $(this).attr("class", "horn-off-icon");
            channel.send("submitMute", {"mute": true});
        } else {
            $(this).attr("class", "horn-icon");
            channel.send("submitMute", {"mute": false});
        }
    });

    //音量滑块
    $("#volSlider").slider({
        value: 50,
        change: function () {
            var val = $("#volSlider a").css("left");
            val = val.replace(/px|%/, "");
            $("#volSlider span").width(val);
            channel.send("submitVolume", {"value": val / 100});
            if (parseInt(val) == 0) {
                $("#soundBtn").attr("class", "horn-off-icon");
            } else {
                $("#soundBtn").attr("class", "horn-icon");
            }
        }
    });

    //进度条
    $("#playerProgressBar").slider({
        value: 0,
        animate:time_z,
        min:0,
        max:videoduration,
        start:function(event,ui){
            //console.log(1);
            channel.send("pause", {});
            clearInterval(myslider);
            $("#playBtn").attr({
                "class": "btn-play",
                "title": "播放"
            });
        },
        slide: function (event, ui) {
            //console.log(2);
            var style = $("#playerProgressBar a").attr("style").split(":")[1];
            var val = parseInt(style) + "%";
            $(".progress-bar-elapsed").width(val);
        },
        change: function (event, ui) {
            //console.log(3);
            $(".progress-bar-elapsed").width(ui.value+"%");
        },
        stop: function (event, ui) {
            //console.log(4);
            var tmt=parseInt(videoduration*ui.value/100);
            channel.send("seek", {"timestamp":tmt});//跳转到指定时间点
            //console.log(tmt+'|'+videoduration+'|'+ui.value);
        }
    });

    //文字直播选择语言
    $("#selectLang").click(function () {
        var list = $(".lang-list");
        if (list.css("display") == "none") {
            list.slideDown(200);
        } else {
            list.slideUp(200);
        }
    });

    //文字直播区域收缩
    $(".btn-textlive").click(function () {
        var txtLiveBox = $(".text-live-container");
        if (txtLiveBox.hasClass("box-isopen")) {
            txtLiveBox.animate({
                width: '25px'
            }, 200);
            txtLiveBox.removeClass("box-isopen");
        } else {
            txtLiveBox.animate({
                width: '700px'
            }, 200);
            txtLiveBox.addClass("box-isopen");
        }
    });

    //在线用户
    $("#userList").click(function () {
        var userListDiv = $(".user-list-wrap");
        if (!$(this).hasClass("user-icon-open")) {
            userListDiv.show();
            $(this).addClass("user-icon-open");
        } else {
            userListDiv.hide();
            $(this).removeClass("user-icon-open");
        }
    });

    //问答、留言切换
    $(".qa-tabs span").click(function () {
        var index = $(this).index();
        $(this).addClass("current").siblings().removeClass("current");
        $(".qa-main > div").eq(index).show().siblings().hide();
    });

    //视频文档切换
    $(".btn-switch").bind("click", function () {
        if ($(".video-container").hasClass("v-full-screen") || $(".ppt-container").hasClass("ppt-fullscreen")) return;
        switchVideoToPPT(0);
    });

    ////窗口最小化及还原
    //WidgetMinimize(".ppt-container", ".shortcut-2").minimize();
    //WidgetMinimize(".video-container", ".shortcut-3").minimize();
    //WidgetMinimize(".chat-container", ".shortcut-4").minimize();
    //WidgetMinimize(".qa-container", ".shortcut-5").minimize();
    //WidgetMinimize(".outline-container", ".shortcut-4").minimize();

    //双击全屏
    $("#widget-doc .comm-title").dblclick(function () {
        pptScreenCtrl(1);
    });
    $("#widget-video .comm-title").dblclick(function () {
        videoScreenCtrl();
    });

    //输入框聚焦
    $("#qa-text-area,#leaveMsgText").focus(function () {
        $(this).closest(".ask-input").addClass("focus-border");
    }).blur(function () {
        $(this).closest(".ask-input").removeClass("focus-border");
    });
    $("#chat-area").focus(function () {
        $(this).closest(".chat-input").addClass("focus-border");
    }).blur(function () {
        $(this).closest(".chat-input").removeClass("focus-border");
    });
    $("#leaveMsgEmail").focus(function () {
        $(this).closest(".input-email").addClass("focus-border");
    }).blur(function () {
        $(this).closest(".input-email").removeClass("focus-border");
    });

    $(".user-list li a").click(function () {
        openChatSubmitArea();
    });

    /* 分享、二维码、反馈 */
    $("#sharePopup dt a").click(function () {
        var tab = $(this).parent();
        var otherTab = tab.parent().siblings("dl").children("dt")
        var content = tab.siblings("dd");
        var otherCnt = tab.parent().siblings("dl").children("dd");
        tab.addClass("current");
        otherTab.removeClass("current");
        content.slideDown(300);
        otherCnt.slideUp(300);
    });
    $("#shareSideBtn").click(function () {
        var shareBox = $(this).parent();
        if (shareBox.hasClass("share-show")) {
            shareBox.animate({
                "left": "-215px"
            }, 300);
            shareBox.removeClass("share-show");
        } else {
            shareBox.animate({
                "left": 0
            }, 300);
            shareBox.addClass("share-show");
        }
    });
    $(".fb-textarea,.fb-input").focus(function () {
        var oldValue = $(this).val();
        if (oldValue == this.defaultValue) {
            $(this).val("");
        }
    }).blur(function () {
        var oldValue = $(this).val();
        if (oldValue == "") {
            $(this).val(this.defaultValue);
        }
    });

});


//显示优选网络
function chooseNetShow() {
    $(".choose-net-container").show();
}
//隐藏优选网络
function chooseNetClose() {
    $(".choose-net-container").hide();
}

//视频全屏、还原操作
var currentVideoPos = {};//记录视频窗口当前位置
function videoScreenCtrl() {
    var $videoWindow = $(".video-container");
    var $pptWindow = $(".ppt-container");
    if (!$videoWindow.hasClass("v-full-screen")) {
        if ($pptWindow.hasClass("ppt-fullscreen")) {
            pptScreenCtrl(0);//当文档已经是全屏的时候，先退出文档全屏
        }
        $("html").css("overflow", "hidden");
        var scrollLeftOffset = $("html").scrollLeft();//获得滚动条左偏移量
        var scrollTopOffset = $("html").scrollTop();//获得滚动条上偏移量
        currentVideoPos._width = $videoWindow.css("width");
        currentVideoPos._height = $videoWindow.css("height");
        currentVideoPos._left = $videoWindow.css("left");
        currentVideoPos._top = $videoWindow.css("top");
        $videoWindow.css({
            "width": $(window).width(),
            "height": $(window).height() + 30,
            "left": scrollLeftOffset,
            "top": scrollTopOffset - 30,
            "z-index": 999
        });
        $videoWindow.find("object").css({
            "height": "100%"
        });
        $videoWindow.addClass("v-full-screen");
        $(".video-container").resizable("disable");
        $(".btn-fullscr").addClass("btn-fullsrc-exit");
        ctrlBarFullPos(1);
        ctrlBarAutoHide();
    } else {
        $("html").css("overflow", "auto");
        $videoWindow.css({
            "width": currentVideoPos._width,
            "height": currentVideoPos._height,
            "left": currentVideoPos._left,
            "top": currentVideoPos._top,
            "z-index": "auto"
        });

        $videoWindow.removeClass("v-full-screen");
        $(".video-container").resizable("enable");
        $(".btn-fullscr").removeClass("btn-fullsrc-exit");
        ctrlBarFullPos(0);
        ctrlBarAutoHide();
    }
    webplayer.videoInnerSize();
}

//视频文档切换
var currentPptPos = {}; //记录文档窗口当前位置
var changeAnimateStatus = true; //视频文档切换动画完成状态
var lastType = -1; //视频文档为主模式切换的最后一次状态
var currentType = -1; //视频文档为主模式切换的当前状态
function switchVideoToPPT(type) {
    /**
     * type 有0,1,2三种状态
     * 0为自由切换
     * 1为文档至主窗口
     * 2为视频至主窗口
     */
    lastType = type;
    var $videoWindow = $(".video-container");
    var $pptWindow = $(".ppt-container");
    var pptIsMain = $pptWindow.hasClass("ppt-is-main");

    if (changeAnimateStatus) {
        currentType = type;
        changeAnimateStatus = false;
        currentVideoPos._width = $videoWindow.css("width");
        currentVideoPos._height = $videoWindow.css("height");
        currentVideoPos._left = $videoWindow.css("left");
        currentVideoPos._top = $videoWindow.css("top");

        currentPptPos._width = $pptWindow.css("width");
        currentPptPos._height = $pptWindow.css("height");
        currentPptPos._left = $pptWindow.css("left");
        currentPptPos._top = $pptWindow.css("top");

        if (type == 0) {
            if (pptIsMain) {
                switchFn();
                $pptWindow.removeClass("ppt-is-main");
            } else if (!pptIsMain) {
                switchFn();
                $pptWindow.addClass("ppt-is-main");
            }

        } else if (type == 1) {
            if (!pptIsMain) {
                switchFn();
                $pptWindow.addClass("ppt-is-main");
            } else {
                changeAnimateStatus = true;
            }
        } else if (type == 2) {
            if (pptIsMain) {
                switchFn();
                $pptWindow.removeClass("ppt-is-main");
            } else {
                changeAnimateStatus = true;
            }
        }

    } else {
        setTimeout(function () {
            if (lastType != currentType) {
                switchVideoToPPT(lastType);
            }
        }, 150);
    }

    function switchFn() {
        $pptWindow.find(".ppt-main").css("height", "100%");
        $videoWindow.find(".player").css("height", "100%");
        $pptWindow.animate({
            "width": currentVideoPos._width,
            "height": currentVideoPos._height,
            "left": currentVideoPos._left,
            "top": currentVideoPos._top

        }, 300, function () {
            webplayer.pptInnerSize();
            changeAnimateStatus = true;
        });
        //video to main
        $videoWindow.animate({
            "width": currentPptPos._width,
            "height": currentPptPos._height,
            "left": currentPptPos._left,
            "top": currentPptPos._top

        }, 300, function () {
            webplayer.videoInnerSize();
            changeAnimateStatus = true;
        });
    }

}


//文档全屏与退出
function pptScreenCtrl(type) {
    /**
     * type == 1 全屏
     * type == 0 退出全屏
     */
    var $pptWindow = $(".ppt-container");
    if (type == 1) {
        $("html").css("overflow", "hidden");
        var scrollLeftOffset = $("html").scrollLeft();//获得滚动条左偏移量
        var scrollTopOffset = $("html").scrollTop();//获得滚动条上偏移量
        currentPptPos._width = $pptWindow.css("width");
        currentPptPos._height = $pptWindow.css("height");
        currentPptPos._left = $pptWindow.css("left");
        currentPptPos._top = $pptWindow.css("top");

        $pptWindow.css({
            "width": $(window).width(),
            "height": $(window).height() + 30,
            "left": scrollLeftOffset,
            "top": scrollTopOffset - 30,
            "z-index": 999
        });
        $pptWindow.addClass("ppt-fullscreen");
        $pptWindow.resizable("disable");
        ctrlBarFullPos(1);
        ctrlBarAutoHide();
    } else if (type == 0) {
        $("html").css("overflow", "auto");
        $pptWindow.css({
            "width": currentPptPos._width,
            "height": currentPptPos._height,
            "left": currentPptPos._left,
            "top": currentPptPos._top,
            "z-index": "auto"
        });
        $pptWindow.removeClass("ppt-fullscreen");
        $pptWindow.resizable("enable");
        ctrlBarFullPos(0);
        ctrlBarAutoHide();
    }
    webplayer.pptInnerSize();
}

//视频或文档全屏时，控制条位置变动
var curCtrlBarPos = {};
function ctrlBarFullPos(type) {
    /**
     * type == 1 全屏
     * type == 0 退出全屏
     */
    var $ctrlBar = $(".control-container");
    if (type == 1) {
        curCtrlBarPos._width = $ctrlBar.css("width");
        curCtrlBarPos._left = $ctrlBar.css("left");
        curCtrlBarPos._top = $ctrlBar.css("top");
        curCtrlBarPos._zIndex = $ctrlBar.css("z-index");

        $("html").css("overflow", "hidden");
        var scrollLeftOffset = $("html").scrollLeft();//获得滚动条左偏移量
        var scrollTopOffset = $("html").scrollTop();//获得滚动条上偏移量
        $ctrlBar.css({
            "width": $(window).width(),
            "left": scrollLeftOffset,
            "top": scrollTopOffset + $(window).height() - 48,
            "z-index": 9999
        });
        $ctrlBar.addClass("control-fullscreen");
        $ctrlBar.resizable("disable");
        $ctrlBar.draggable("disable");
    } else if (type == 0) {
        $("html").css("overflow", "auto");
        $ctrlBar.css({
            "width": curCtrlBarPos._width,
            "left": curCtrlBarPos._left,
            "top": curCtrlBarPos._top,
            "z-index": curCtrlBarPos._zIndex
        });
        $ctrlBar.removeClass("control-fullscreen");
        $ctrlBar.resizable("enable");
        $ctrlBar.draggable("enable");
    }

}

//视频或文档全屏时控制条自动隐藏

function ctrlBarAutoHide() {

    var fullWin = $(".ppt-container,.video-container");
    var ctrlBar = $(".control-container");
    ctrlBar.show();
    if (!ctrlBar.hasClass("control-fullscreen")) { //非全屏状态下
        clearInterval($.time);
    } else {
        fullWin.bind("mousemove", function () {
            if (ctrlBar.hasClass("control-fullscreen")) {
                clearInterval($.time);
                ctrlBar.show();
                $.time = setTimeout(function () {
                    ctrlBar.hide();
                }, 3000);
            }
        });
    }
}

function timerDif(intDiff){
        var day=0,
            hour=0,
            minute=0,
            second=0;//时间默认值
        if(intDiff > 0){
            day = Math.floor(intDiff / (60 * 60 * 24));
            hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
            minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
        }
        if (minute <= 9) minute = '0' + minute;
        if (second <= 9) second = '0' + second;
        //$('#day_show').html(day+"天");
        $('#hour_show').html(hour+':');
        $('#minute_show').html(minute+':');
        $('#second_show').html(second);
}
function timeradd(intDiff){
        var day=0,
            hour=0,
            minute=0,
            second=0;//时间默认值
        if(intDiff > 0){
            day = Math.floor(intDiff / (60 * 60 * 24));
            hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
            minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
        }
        if (minute <= 9) minute = '0' + minute;
        if (second <= 9) second = '0' + second;
        //$('#day_show').html(day+"天");
        $('#hour_add_show').html(hour+':');
        $('#minute_add_show').html(minute+':');
        $('#second_add_show').html(second);
}
