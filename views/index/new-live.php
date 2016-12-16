<!DOCTYPE html>
<html>
<head>
    <title>手机版视频直播界面</title>
    <!-- Basic Page Needs
     ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="Copyright" content="">
    <!-- <meta name="description" content=""> -->
    <!-- 让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <!-- IOS6全屏 Chrome高版本全屏
    <-- ================================================== -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- 让360双核浏览器用webkit内核渲染页面
     <-- ================================================== -->
    <meta name="renderer" content="webkit">
    <!-- Mobile Specific Metas
     <-- ================================================== -->
    <!-- !!!注意 minimal-ui 是IOS7.1的新属性，最小化浏览器UI -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/css/new-live.css"/>
    <link rel="stylesheet" href="/css/jquery.nstSlider.css"/>
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.nstSlider.js"></script>
    <script type="text/javascript" src="/js/new-live.js"></script>
</head>
<body>
<!--标题栏-->
<div class="blackNav">
    <a href="#" class="returnP"><img src="/images/videoL_lj.png" alt="白色返回箭头"/></a>
    <span>如何突破Lecture难关</span>
</div>
<div class="play_main">
    <!--放ppt的容器-->
     <div class="play_con"></div>
    <!--进度条-->
    <div class="my_pro">
        <div class="nstSlider top" data-range_min="0" data-range_max="100"
             data-cur_min="30"  data-cur_max="0">
            <div class="bar top"></div>
            <div class="leftGrip top"></div>
        </div>
        <div class="rightLabel">01:32:28</div>
    </div>
</div>
<!--底部黑色条部分-->
<div class="black_control">
    <!--播放-->
    <div class="play" onclick="playIcon(this)"></div>
    <!--切换图标-->
    <!--<div class="toggle"></div>-->
    <!--音量-->
    <div class="volume">
        <div class="volume_icon">
            <img src="/images/video_volume.png" alt="音量图标">
        </div>
        <div class="volume_pro">
            <div class="nstSlider" data-range_min="0" data-range_max="100"
                 data-cur_min="30"  data-cur_max="0">
                <div class="bar bot"></div>
                <div class="leftGrip bot"></div>
            </div>
        </div>
    </div>
</div>
<!--老师视频部分-->
<div class="teacher_box"></div>
<script type="text/javascript">
    $(function(){
        $('.nstSlider').nstSlider({
            "left_grip_selector": ".leftGrip",
            "value_bar_selector": ".bar"
        });
    });

</script>
</body>
</html>