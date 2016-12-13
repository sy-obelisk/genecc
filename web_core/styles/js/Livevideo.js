//1. 根据组获得通讯通道
var channel = GS.createChannel();
var duration;
channel.bind("onFileDuration", function (event) {
    duration = event.data.duration;//获取到总时间，可以开始操作滚动条滚动
});

channel.bind("onFileDuration", function (event) {
    duration = event.data.duration;//获取到总时间，可以开始操作滚动条滚动
});
channel.bind("onPlay", function (event) {//滚动条继续滚动

});
channel.bind("onPause", function (event) {//暂停滚滚条

});
channel.bind("onStop", function (event) {//播放结束

});
function play(e) {
    if ($(e).hasClass('fa-play')) {
        $(e).removeClass('fa-play').addClass('fa-pause');
        channel.send("play", {});
    } else if ($(e).hasClass('fa-pause')) {
        $(e).removeClass('fa-pause').addClass('fa-play');
        channel.send("pause", {});
    }
}

function submitVolume(leftValue){
    value=Number(leftValue)/100;
    channel.send("submitVolume",{"value":value});
}