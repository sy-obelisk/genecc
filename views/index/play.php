<!DOCTYPE html>
<html xmlns:gs="http://www.gensee.com/ec">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>视频直播页面</title>
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.10.3.custom.gs.min.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://static.gensee.com/webcast/static/sdk/js/gssdk.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>
    <script type="text/javascript" src="/js/webplayer.common.js"></script>
    <script type="text/javascript" src="/js/webplayer.vod.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.10.3.custom.min.js"></script>

    <!--[if IE 6]>
    <script type="text/javascript" src="/js/DD_belatedPNG.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.tran');
        DD_belatedPNG.fix('.comm-title');
    </script>
    <![endif]-->
</head>

<body>

<div class="web">
    <div class="main">
        <!--PPT Area-->
        <div id="widget-doc" class="ppt-container">
            <div class="ppt-main">
                <gs:doc
                    site="bjsy.gensee.com"
                    ctx="training"
                    ownerid="zDXid1AhJD"
                    fullscreen="true"
                    bgcolor=""
                    lang="zh_CN"/>
            </div>
        </div>
        <!--PPT Area End-->

        <!--Control Bar-->
        <div class="control-container">
            <div class="drag-handle"></div>
            <div class="control-main">
                <div class="vod-ctrl-left">
                    <a id="playBtn" class="btn-pause" href="javascript:;" title="暂停"></a>
                    <span class="current-play-time">
                        <span id="hour_add_show">0:</span><span id="minute_add_show">00:</span><span id="second_add_show">00</span>
                    </span>
                </div>
                <div class="vod-ctrl-center">
                    <div class="player-progress-bar-wrap">
                        <div class="player-slider progress-bar-elapsed" ></div>
                        <div class="player-slider progress-bar-buffer" ></div>
                        <div id="playerProgressBar" class="player-progress-bar">
                        </div>
                    </div>
                </div>
                <div class="vod-ctrl-right">
                    <span class="play-time">
                    <span id="hour_show">0:</span><span id="minute_show">00:</span><span id="second_show">00</span>
                    </span>
                    <div class="vod-ctrl-r-btn">
                        <a id="soundBtn" class="horn-icon tran" href="javascript:;"></a>
                        <div id="volSlider" class="vol-slider">
                        </div>
                        <a class="btn-switch" href="javascript:;" title="切换"></a>
                        <a class="btn-signal" href="javascript:;" title="优选网络"  onClick="chooseNetShow();"></a>
                    </div>
                </div>
            </div>
        </div>
        <!--Control Bar End-->

        <!--Outline Area-->
        <div class="outline-container">

            <div class="outline-main">

                <div class="classBottom">
                    <img src="/images/gmat_live.png" alt="图片"/>
                    <ul>
                        <li>更多GMAT精品课程预告</li>
                        <li>1、留学名校免费规划评估</li>
                        <li>2、托福一对一定制课程</li>
                        <li>3、托福全程/单项强化班</li>
                        <li>4、GMAT周末班/晚班 强化班</li>
                    </ul>
                    <p>详情咨询Lindy老师微信gmatonline-lindy</p>
                </div>
            </div>
        </div>
    </div>
    <!--Outline Area End-->

    <!--Video Area-->
    <div id="widget-video" class="video-container">

        <div class="player">
            <gs:video-vod
                site="bjsy.gensee.com"
                ctx="training"
                ownerid="zDXid1AhJD"
                uid="14889"
                uname="2"
                password=""
                authcode=""
                encodetype=""
                bgimg="http://www.gmatonline.cn/app/web_core/styles//images/bg-video.png"
                bar="false"
                py="1"
                lang="zh_CN"/>
        </div>
    </div>
</div>
<!--Video Area End-->
<div id="coverLayer"></div>


<!--<!--&lt;!&ndash;遮罩层&ndash;&gt;-->-->
<!--<div class="form-maskLayer"></div>-->
<!--<!--&lt;!&ndash;遮罩层里面的文字&ndash;&gt;-->-->
<!--<div class="form-font">-->
<!--<div class="topBlue">雷哥GMAT在线课程，助你预见想象的700+</div>-->
<!--<div class="passDiv">-->
<!--<form  action="" method="post">-->
<!--<input id="ispwd" value="{x2;$ispwd}" type="hidden"/><br/>-->
<!--密码:<input id="PWD" name="PWD" placeholder="{x2;if:$pwd_msg==1}密码错误！{x2;else}请输入密码{x2;endif}" type="text"/>-->
<!--<button type="submit">提交</button>-->
<!--</form>-->
<!--</div>-->
<!--</div>-->
<!--<script>-->
<!--//输入密码的遮罩层高度-->
<!--$(".form-maskLayer").css("height",$(document).height()+"px");-->
<!--</script>-->

<!--打赏弹窗-->
<div class="form-maskLayer"></div>
<div class="form-font">
    <div class="topBlue">如果以上课程对你有所帮助，可以打赏给雷哥网哟，金额不限</div>
    <div class="passDiv">
        <form  action="" method="post">
            <br/>
            <input id="PWD" name="PWD" type="text"/>
            <button type="submit">打赏</button>
        </form>
    </div>
</div>
</body>
</html>
