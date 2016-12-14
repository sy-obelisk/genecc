<!DOCTYPE html>
<html>
<head>
    <title>小申托福在线官网|托福网络课程_托福TPO模考_TOEFL培训_托福在线学习平台</title>
    <meta name="keywords" content="托福网络课程、托福在线课程、托福TPO模考、toefl培训、小申托福">
    <meta name="description" content="小申托福在线，在线托福听力训练、托福口语训练、TPO模考训练，托福在线网络课程学习，在线题目答疑及学习计划定制等一系列自适应在线学习服务平台。">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!--防止设置padding的div增大-->
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link rel="stylesheet" href="/cn/css/personalCenter.css"/>
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/publicJS.js"></script>
    <script type="text/javascript" src="/cn/js/personalCenter.js"></script>
</head>
<body>

<!---------------------头部--------------------------->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<!---------------------头部 end--------------------------->
<?php
$userId = Yii::$app->session->get('userId');
$userData = Yii::$app->session->get('userData');
?>
<div class="personBig">
    <div class="person-left">
        <div class="personTop">
            <div class="top-left">
                <div><span></span><img src="<?php echo $userData['image']?$userData['image']:'/cn/images/details_defaultImg.png'?>" alt="用户头像"/></div>
<!--                <h1>--><?php //echo $userData['nickname']?$userData['nickname']:$userData['userName']?><!--</h1>-->
            </div>
            <div class="top-right">
                <b>用户名<br/><?php echo $userData['nickname']?$userData['nickname']:$userData['userName']?></b>
<!--                <h2>雷豆数量</h2>-->
<!--                <span>300</span>-->
<!--                <div data-value="/user/manage.html" class="changeUrl"><span>账号管理</span></div>-->
            </div>
        </div>
        <?php $action=Yii::$app->controller->action->id;
        ?>
        <div class="bottomUL">
            <ul>
                <li data-value="/user/exam.html" <?php echo $action == 'test-record'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg01"></div>
                    <span>模考记录</span>
                </li>
                <li data-value="/user/listen.html" <?php echo $action == 'listen-record'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg02"></div>
                    <span>听力记录</span>
                </li>
                <li data-value="/user/speaking.html" <?php echo $action == 'spoken'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg07"></div>
                    <span>口语记录</span>
                </li>
                <li data-value="/user/collect.html" <?php echo $action == 'collect'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg03"></div>
                    <span>收藏记录</span>
                </li>
                <li>
                    <a href="/user/manage.html">
                        <div class="bg06"></div>
                        <span>账号管理</span>
                    </a>
                </li>

                <li data-value="/user/vocab.html" <?php echo $action == 'vocab'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg04"></div>
                    <span>生词本</span>
                </li>

                <li data-value="/user/course.html" <?php echo $action == 'class'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg05"></div>
                    <span>我的课程</span>
                </li>
                <li data-value="/user/integral.html" <?php echo $action == 'integral'?'class="on changeUrl"':'class="changeUrl"'?>>
                    <div class="bg06"></div>
                    <span>雷豆管理</span>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            $('.changeUrl').live('click',function(){
                var url = $(this).attr('data-value');
                window.location.href=url;
            })
        </script>
    </div>
    <div class="person-right">
        <?= $content ?>
    </div>
    <div style="clear: both"></div>
</div>

<!---------------------尾部--------------------------->
<?php use app\commands\front\FooterWidget;?>
<?php FooterWidget::begin();?>
<?php FooterWidget::end();?>
<!---------------------尾部 end--------------------------->
</body>
</html>

