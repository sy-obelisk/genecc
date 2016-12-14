<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
<!----------------公开课头部--------------------->
<div class="blueNav">
    <div class="inBlue">
        <img src="/cn/images/openD_titleIcon.png" alt="图标" height="33"/>
        <b>小申公开课</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <span>留学 |</span>
        <span>GMAT |</span>
        <span>托福</span>
        <p>400-1816-180</p>
    </div>
</div>

<!----------------------------------轮播start---------------------------------------------------------->
<div id="z_lunbo" class="z_lunbo">
    <div class="bd">
        <ul>
            <li>
                <a href="#" target="_blank">
                    <img src="/cn/images/index_lunbo3.jpg" alt="banner图"/>
                </a>
            </li>
            <li>
                <a href="#" target="_blank">
                    <img src="/cn/images/index_lunbo3.jpg" alt="banner图"/>
                </a>
            </li>
        </ul>
    </div>

    <!--轮播上面的会员登录遮罩层-->
    <div class="huiyuan_login_zzc"></div>
    <!--轮播上面的会员登录内容-->
    <div class="huiy_login_c">
        <p>会员登录</p>
        <form class="ordinary">
            <div>
                <input type="text" class="hy_username" placeholder="手机/邮箱/用户名"  datatype="s5-16" errormsg="昵称至少5个字符,最多16个字符!"/>
                <br/>
            </div>
            <div>
                <input type="password" class="hy_password" placeholder="密码" datatype="*6-16" errormsg="密码范围在6~16位之间！"/>
                <br/>
            </div>
            <div>
                <input type="text" placeholder="验证码" class="hy_yzm" datatype="*" errormsg="动态密码不能为空！"/>
                <span><img src="/cn/images/index.png" alt="点我换一张"  class="yzmImg"/></span>
                <br/>
            </div>
            <div class="log_reg">
                <input type="button" value="马上登陆" id="btn_sub"/>
                <input type="button" value="立即注册" class="he_nav_register"/>
            </div>
        </form>
        <div class="qita_log">
            <span>其他账号登陆<img src="/cn/images/index_hy_add.png" alt="" style="position: relative;top: 2px"/></span>
            <ul>
                <li><a href="#" target="_blank" class="hy_qq"></a></li>
            </ul>
        </div>

    </div>

</div>
<script>
    //    轮播
    jQuery(".z_lunbo").slide({mainCell:".bd ul",autoPlay:true,trigger:"click",effect:"fade",mouseOverStop:false});

</script>
<!----------------------------------轮播end---------------------------------------------------------->

<!----------------公开课头部 end--------------------->

<!--<div class="open-commonStyle">-->
<!--    <ul>-->
<?php
//$data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218','pageSize' => 8]);
//    foreach($data as $v) {
//        ?>
<!--        <li>-->
<!--            <div class="topImg">-->
<!--                <img src="--><?php //echo $v['image']?><!--" alt="课程图"/>-->
<!--            </div>-->
<!--            <p>--><?php //echo $v['name']?><!--</p>-->
<!--            <span>--><?php //echo date("Y-m-d H:i",strtotime($v['cnName'])) ?><!--</span>-->
<!--            <b>--><?php //echo $v['numbering']?><!--</b>-->
<!---->
<!--            <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>-->
<!--            --><?php
//            if($v['duration']) {
//                ?>
<!--                <a href="/public-class/back/--><?php //echo $v['id']?><!--.html" class="classBtn diffColor01">回放</a>-->
<!--            --><?php
//            }else {
//                ?>

<!--           --><?php
//            }
//            ?>
<!--            <a href="/public-class/--><?php //echo $v['id']?><!--.html" class="classBtn diffColor02">详情</a>-->
<!--        </li>-->
<!--    --><?php
//    }
//?>
<!--    </ul>-->
<!--</div>-->


<div class="open-commonStyle">
    <ul>
<!--        <a href="/public-class/162/1.html">more</a>-->
        <div class="open-commonTitle">
            <a href="/public-class/162/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack01">
                <h1>GMAT</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,162','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <img src="<?php echo $v['image']?>" alt="课程图"/>
                </div>
                <p><?php echo $v['name']?></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                    if($v['duration']) {
                        ?>
                        <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                    <?php
                    }else {
                        ?>
                        <a href="javascript:;" onclick="buyNow(<?php echo $v['id']?>)" class="classBtn diffColor01">报名</a>
                    <?php
                    }
                ?>
                <a href="/public-class/<?php echo $v['id']?>.html" class="classBtn diffColor02">详情</a>
            </li>
        <?php
        }
?>
        <div style="clear: both"></div>
        <div class="open-commonTitle">
            <a href="/public-class/163/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack02">
                <h1>托福</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,163','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <img src="<?php echo $v['image']?>" alt="课程图"/>
                </div>
                <p><?php echo $v['name']?></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                if($v['duration']) {
                    ?>
                    <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                <?php
                }else {
                    ?>
                    <a href="javascript:;" onclick="buyNow(<?php echo $v['id']?>)" class="classBtn diffColor01">报名</a>
                <?php
                }
                ?>
                <a href="/public-class/<?php echo $v['id']?>.html" class="classBtn diffColor02">详情</a>
            </li>
        <?php
        }
        ?>
        <div style="clear: both"></div>

        <div class="open-commonTitle">
            <a href="/public-class/150/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack03">
                <h1>留学</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,150','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <img src="<?php echo $v['image']?>" alt="课程图"/>
                </div>
                <p><?php echo $v['name']?></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                if($v['duration']) {
                    ?>
                    <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                <?php
                }else {
                    ?>
                    <a href="javascript:;" onclick="buyNow(<?php echo $v['id']?>)" class="classBtn diffColor01">报名</a>
                <?php
                }
                ?>
                <a href="/public-class/<?php echo $v['id']?>.html" class="classBtn diffColor02">详情</a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
<script type="text/javascript">
    /**
     * 立即队员
     */
    function buyNow(_id){
        window.location.href="/quick-clearing/"+_id+"/1.html";
    }
</script>
