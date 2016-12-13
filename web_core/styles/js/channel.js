//1. 根据组获得通讯通道
var channel = GS.createChannel();
channel.bind("onStart", function (event) {//视频开始
    //window.location.reload();//刷新当前页面.
    $("#sdktype").html('');
});

channel.bind("onStatus", function (event) {//SDK状态
    if(Number(event.data.type)==2){
        $("#sdktype").html('<b>直播未开始</b>');
    }else{
        $("#sdktype").html(event.data.explain);
    }
});

//用户在线人数
// channel.bind("onUserOnline", function (event) {
//     $("#students_count").html("(" + event.data.count + ")");
// });


//学生列表
// channel.bind("onUserList", function (event) {//列表
//     UserList(event.data.list);
// });
channel.bind("onUserJoin", function (event) {//加入
    UserJoin(event.data.list);
});
channel.bind("onUserLeave", function (event) {//离开
    UserLeave(event.data.list);
});
//公聊
channel.bind("onPublicChat", function (event) {
    setchatlist(event.data.senderId, event.data.sender, event.data.content,'0');
});


//发送消息
//选择对象或所有人聊天
function sendMess(e) {
    var content = $("#chat-content").val();
    channel.send("submitChat", {
        "content": content,
        "richtext": '',
        "security": "high"
    }, function (resultInfo) {

    });
    setchatlist($(e).attr("userid"), $(e).attr("username"), content,'1');
    $("#chat-content").val("");
}


//公聊
function setchatlist(senderId, sender, content,mk) {
    var str = '';
    var spanS='';
    if(mk=='1'){
        spanS= '<span class="greenC" senderid=' + senderId + '>' + sender + '</span>';
    }else{
        spanS= '<span  class="blueC" senderid=' + senderId + '>' + sender + '</span>';
    }
    str += '<li>';
    str+=spanS;
    //str += '<span senderid=' + senderId + '>' + sender + '</span>';
    //str += '<span>' + sender + '</span>';
    str += '<p>' + content + '</p>';
    str += '</li>';
    $("#PublicChat").append(str);
    scrollBot();
}

//滚动条滚动到底部
function scrollBot(){
    var obj= $(".aLcR-center");
    obj.animate({scrollTop:obj[0].scrollHeight+"px"},1000);
}
//enter键发送
function sendLoad(event) {
    if (event.keyCode == 13) {
        sendMess($(".group-input input[type=button]"));
    }
}

function UserList(list) {
    var str = '';
    $(list).each(function () {
        str += '<li id="user' + this.id + '">';
        str += '<img src="app/web_core/styles/images/aLive_userImg.png" alt="用户头像" width="24"/>';
        str += '<span>' + this.name + '</span>';
        str += '</li>';
    });
    $("#students_list").html(str);
}

function UserJoin(list) {

    $(list).each(function () {
        if ($("#user" + this.id).length > 0) {
            var str = '';
            str += '<li id="user' + this.id + '">';
            str += '<img src="app/web_core/styles/images/aLive_userImg.png" alt="用户头像" width="24"/>';
            str += '<span>' + this.name + '</span>';
            str += '</li>';
            $("#students_list").append(str);
        }
    });
}

function UserLeave(list) {
    $(list).each(function () {
        if ($("#user" + this.id).length > 0) {
            $("#user" + this.id).remove();
        }
    });

}