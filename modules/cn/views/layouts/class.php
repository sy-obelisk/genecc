<?php $userId = Yii::$app->session->get('userId')?>
<?php $userData = Yii::$app->session->get('userData')?>
<!DOCTYPE html>
<html>
<head>
    <title>出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习">
    <meta name="description" content="出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/openClass.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/openPublic.css"/>
    <script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/Validform_v5.3.2_min.js"></script>
    <script type="text/javascript" src="/cn/js/public.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".ordinary").Validform({
                btnSubmit:"#btn_sub",
                showAllError:true,
                tiptype:3
            });
        });
    </script>
</head>
<body>

<!----------------公开课头部--------------------->
<div class="blueNav">
    <div class="inBlue">
        <img src="/cn/images/openD_titleIcon.png" alt="图标" height="33"/>
        <b>SmartApply公开课</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="http://www.gmatonline.cn/" target="_blank">返回雷哥GMAT在线 |</a>
        <a href="http://www.toeflonline.cn/" target="_blank">返回托福在线 |</a>
        <a href="/">返回商城</a>
        <p>400-1816-180</p>
    </div>
</div>

<!----------------------------------轮播start---------------------------------------------------------->
<div id="z_lunbo" class="z_lunbo">
    <div class="bd">
        <ul>
            <?php
            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '228,226']);
            foreach($data as $v) {
                ?>
                <li>
                    <a href="<?php echo $v['answer']?>" target="_blank">
                        <img src="<?php echo $v['image']?>" alt="banner图"/>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <!--图片上面的按钮-->
<!--    <div class="group-btn">-->
<!--        <ul>-->
<!--            <li>-->
<!--                <a target="blank" href="tencent://message/?uin=1746295647&amp;Site=www.cnclcy&amp;Menu=yes">-->
<!--                    <img src="/cn/images/open_phoneIcon.png" alt="图标"/>-->
<!--                    <span>预约申请</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a target="blank" href="tencent://message/?uin=1746295647&amp;Site=www.cnclcy&amp;Menu=yes">-->
<!--                    <img src="/cn/images/open_personIcon.png" alt="图标"/>-->
<!--                    <span>留学咨询</span>-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<?php
    if(!$userId) {
        ?>
        <!--轮播上面的会员登录遮罩层-->
        <div class="huiyuan_login_zzc"></div>
        <!--轮播上面的会员登录内容-->
        <div class="huiy_login_c">
            <p>会员登录</p>

            <form class="ordinary">
                <div>
                    <input type="text" class="userName hy_username" placeholder="手机/邮箱/用户名" datatype="s5-16"
                           errormsg="昵称至少5个字符,最多16个字符!"/>
                    <br/>
                </div>
                <div>
                    <input type="password" class="userPass hy_password" placeholder="密码" datatype="*6-16"
                           errormsg="密码范围在6~16位之间！"/>
                    <br/>
                </div>
                <div>
                    <input type="text" placeholder="验证码" class="loginCode hy_yzm" datatype="*" errormsg="动态密码不能为空！"/>
                    <span><img  src="/cn/api/verification-code" onclick="this.src='/cn/api/verification-code?'+Math.random();" alt="点我换一张"
                                class="yzmImg"/></span>
                    <br/>
                </div>
                <div class="log_reg">
                    <input type="button" onclick="subLogin()" value="马上登陆" />
                    <input type="button" onclick="location.href='/register.html'" value="立即注册" class="he_nav_register"/>
                </div>
            </form>
            <div class="qita_log">
                <span>其他账号登陆<img src="/cn/images/index_hy_add.png" alt="" style="position: relative;top: 2px"/></span>
                <ul>
                    <li><a href="#" target="_blank" class="hy_qq"></a></li>
                </ul>
            </div>

        </div>
    <?php
    }
    ?>
    <script type="text/javascript">
        /**
         * 用户登录
         */
        function subLogin(){
            var userPass = $('.userPass').val()
            var userName = $('.userName').val();
            var verificationCode = $('.loginCode').val();
            if(verificationCode == ""){
//            $('.loginCode').parent().find("p").css("visibility","visible");
                return false;
            }
            if(userName == ""){
//            $('.userName').next("p").css("visibility","visible").html("请输入用户名!");
                return false;
            }
            if(userPass == ""){
//            $('.userPass').next("p").css("visibility","visible").html("请输入密码");
                return false;
            }
            $.post('/cn/api/check-login',{verificationCode:verificationCode,userPass:userPass,userName:userName},function(re){
                if(re.code == 1){
                    location.reload();
                }else{
                    alert(re.message);
                }
            },'json')
        }
    </script>

</div>
<script>
    //    轮播
    jQuery(".z_lunbo").slide({mainCell:".bd ul",autoPlay:true,trigger:"click",effect:"left",mouseOverStop:false});

</script>
<?=$content?>
<!----------------------尾部----------------------------->
<div class="footer">
    <div class="inFooter">
        <div class="foot-left">
            <h4>24</h4>
            <span>小时免费热线</span>
            <p>400-1816-180</p>
            <img src="/cn/images/index_phone.png" alt="电话图标"/>
        </div>
        <div class="foot-right">
            <div class="footNav">
                <ul>
                    <li><a href="javascript:void(0);">友情链接</a></li>
                    <li><span>|</span></li>
                    <li>
                        <a href="http://www.gmatonline.cn/index.html" target="_blank">雷哥GMAT在线 </a>
                    </li>
                    <li><span>|</span></li>
                    <li> <a href="http://www.toeflonline.cn" target="_blank">托福在线</a></li>
                    <li><span>|</span></li>
                    <li><a href="/">SmartApply商城</a></li>

                </ul>
            </div>
            <div class="copyRight">Copyright &copy;2016 All Right Reserved  SmartApply 版权所有</div>
            <div class="weChat">
                <ul>
                    <li>
                        <div class="char-left">
                            <img src="/cn/images/index_ewmGmat.jpg" alt="二维码图片"/>
                        </div>
                        <div class="char-right">
                            <ul>
                                <li>雷哥GMAT官方微信</li>
                                <li>每时每刻掌握GMAT动态</li>
                                <li>随时随地知晓备考资讯</li>
                            </ul>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                    <li>
                        <div class="char-left">
                            <img src="/cn/images/index_ewmTeofl.jpg" alt="二维码图片"/>
                        </div>
                        <div class="char-right">
                            <ul>
                                <li>托福在线官方微信</li>
                                <li>每时每刻掌握托福动态</li>
                                <li>随时随地知晓备考资讯</li>
                            </ul>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<!----------------------尾部  end----------------------------->
</body>
</html>