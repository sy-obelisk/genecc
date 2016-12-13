$(function () {
    $(".tiku_mdt_fenxi").mouseenter(function () {
        $(this).parent().find("div").show();
        $(this).parent().find("img").show();
        $(this).parent().find("div").mouseleave(function () {
            $(this).hide();
            $(this).parent().find("img").hide()
        })
    });
    $(".ti_xq_show_answer").click(function () {
        $(this).css("background", " #02a7f4");
        $(".tiku_mdt_daan span").show()
    });
    $("#gkk_wjhg_bottom ul li .gkk_wjhg_bo_con_left").hover(function () {
        $(this).find("img").first().attr("src", "images/gongkaike_yuan_blue.png")
    }, function () {
        $(this).find("img").first().attr("src", "images/gongkaike_yuan_zi.png")
    });
    $("#gkk_wjhg_bottom ul li .gkk_wqhg_bo_contwo_right").hover(function () {
        $(this).find("img").first().attr("src", "images/gongkaike_yuan_blue.png")
    }, function () {
        $(this).find("img").first().attr("src", "images/gongkaike_yuan_zi.png")
    });
    $(".tiku_answer").live("click", "span.tiku_answer", function () {
        $(this).parent().parent().find(".answer_div").slideToggle();
        if ($(this).html() == "回复") {
            $(this).html("收起回复");
            $(this).css("background", "rgba(4, 164, 235, 0.14)");
            $(this).parent().siblings("div.answer_div").find("textarea").show();
            $(this).parent().siblings("div.answer_div").find("input.fabiao").show()
        } else {
            $(this).html("回复");
            $(this).css("background", "white")
        }
    });
    $(".in_tiku_answer").live("click", "span.in_tiku_answer", function () {
        $(this).parent().parent().parent().parent().find("input.my_say").show();
        $(this).parent().parent().parent().parent().find("textarea").show();
        $(this).parent().parent().parent().parent().find(".fabiao").show()
    });
    $(".my_say").live("click", "input.my_say", function () {
        $(this).parent().find("textarea").slideToggle("slow", function () {
            if ($(this).is(":hidden")) {
                $(this).parent().find(".fabiao").hide()
            } else {
                $(this).parent().find(".fabiao").show()
            }
        })
    });
    $(".tiku_mdt_dht .dht_hui_div").click(function () {
        if ($(this).find("div").hasClass("on")) {
            $(this).find("div").removeClass("on")
        } else {
            $(this).find("div").addClass("on")
        }
    });
});

$(document).ready(function () {
    $(".tiku_mdt_dtk_Two").attr("readonly", "readonly");
    $(".tiku_mdt_dtk_Two").focus(function () {
        $(this).blur();
    })
});

function wrongTopic(o){
    $(".log_reg_zzc").show();
    $(".wrong").show();
}
function closeW(){
    $(".log_reg_zzc").hide();
    $(".wrong").hide();
}

function ConfirmProblem(){
    var selectV=$(".wrongContent select").val();
    var textareaV=$(".wrongContent textarea").val();
    var inputV=$(".wrongContent input[type='hidden']").val();
    $.ajax({
        url: '/question/ajaxProblemBug', // 跳转到 action
        data: {
            type: selectV,
            describe: textareaV,
            questionid: inputV
        },
        type: 'post',
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data) {
                alert(data.msg);
                closeW();
            } else {
                alert('提交失败！');
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
function playAudio(o,num){
    if(num==0) {
        alert("购买了才能收听哦！");
        return false;
    }else{
        //音频js
        var play = document.getElementById('play');
        var v = document.getElementById('audio');
        var progress = document.getElementById("progress");
        var bg = document.getElementById("progressBG");
        var moveBlock = document.getElementById("moveBlock");
        var sound = document.getElementById("sound");
        var soundmoveBlock=document.getElementById("sound_moveBlock");
        var soundprogress=document.getElementById("sound_progress");
        var soundprogressBG=document.getElementById("sound_progressBG");
//                  play.onclick = function(){
        if(v.paused){
            play.className = "fa fa-pause";
            v.play();
        }else{
            play.className = "fa fa-play";
            v.pause();
        }
//                  };
        v.addEventListener('timeupdate',function(){
            var scale = v.currentTime / v.duration;
            bg.style.width = progress.offsetWidth * scale + "px";
            moveBlock.style.left = (progress.offsetWidth * scale - moveBlock.offsetWidth/2) + "px";
        },false);

        moveBlock.onmousedown = function(e){
            v.pause();
            var pointerStartX = e.clientX;
            var moveBlockStartLeft = moveBlock.offsetLeft;
            document.onmousemove = function(e){
                var pointerX = e.clientX;
                var dis = pointerX - pointerStartX;
                moveBlock.style.left = (moveBlockStartLeft+dis) + "px";
            };
            document.onmouseup = function(e){
                document.onmousemove = null;
                document.onmouseup = null;
                var scale = moveBlock.offsetLeft / progress.offsetWidth;
                v.currentTime = v.duration * scale;
                play.className = "fa fa-pause";
                v.play();
            }
        };
        soundmoveBlock.onmousedown=function(e){
            var clinetX= e.clientX;
            var sound_moveBlock_left=this.offsetLeft;
            document.onmousemove=function(e){
                var prentX= e.clientX;
                var tis=prentX-clinetX;
                var big_width=soundprogress.offsetWidth-soundmoveBlock.offsetWidth;
                soundmoveBlock.style.left=(sound_moveBlock_left+tis)+"px";
                if(soundmoveBlock.offsetLeft>big_width){
                    soundmoveBlock.style.left=big_width+"px";
                }
                if(soundmoveBlock.offsetLeft<=0){
                    soundmoveBlock.style.left=0;
                }
                soundprogressBG.style.width=(sound_moveBlock_left+tis+3)+"px";
                if(soundprogressBG.offsetWidth>soundprogress.offsetWidth){
                    soundprogressBG.style.width=soundprogress.offsetWidth+"px";
                }
                if(soundmoveBlock.offsetLeft<=0){
                    soundprogressBG.style.width=0;
                }
            };
            document.onmouseup=function(e){
                var bili= soundprogressBG.offsetWidth/soundprogress.offsetWidth;
                if(bili<=1/3  && bili>=0.1){
                    v.volume=0.1;
                    sound.className = "fa fa-volume-down";
                }else if(bili<=2/3 && bili>=1/3){
                    v.volume=0.2;
                    sound.className = "fa fa-volume-down";
                }
                else if(bili<=1 && bili>=2/3){
                    v.volume=0.3;
                    sound.className = "fa fa-volume-up";
                }else if(bili<=0.1){
                    v.volume=0;
                    sound.className = "fa fa-volume-off";
                }
                document.onmousemove=null;
                document.onmouseup=null;
            }
        };
        sound.onclick = function(){
            if(v.muted){
                v.muted = false;
                this.className = "fa fa-volume-up";
                soundmoveBlock.style.left=soundprogress.offsetWidth-soundmoveBlock.offsetWidth+"px";
                soundprogressBG.style.width=soundprogress.offsetWidth+"px";
            }else {
                v.muted =true;
                this.className = "fa fa-volume-off";
                soundmoveBlock.style.left=0;
                soundprogressBG.style.width=0;
            }
        };
    }
}

