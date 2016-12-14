<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!--防止设置padding的div增大-->
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link rel="stylesheet" href="/cn/css/pay.css"/>
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/publicJS.js"></script>
</head>
<body>
<!---------------------头部--------------------------->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<!---------------------头部 end--------------------------->

<div class="payBig">
    <div class="payTop">
        <ul>
            <li>
                <label>账户余额：</label>
                <span><?php echo $integral?> 雷豆</span>
            </li>
            <li>
                <label>充值金额：</label>
                <input id="money" onblur="changeNumber(this)" type="text"/>
                <span>元</span>
            </li>
            <li>
                <label>充值雷豆：</label>
                <span id="integral">0</span>
                <span>雷豆</span>
            </li>
        </ul>
    </div>
    <div class="payBottom">
        <!--支付平台-->
        <div class="zhifu_pT">
            <h2 class="zhifu_title_y"><span></span>支付平台</h2>
            <ul>
                <li>
                    <input checked type="radio" name="zhifu_pT_r" id="zhufubao"/>
                    <div>
                        <label for="zhufubao"><img src="/cn/images/zhifu_zfb.png" alt="支付宝支付"/></label>
                    </div>
                </li>
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="weixin"/>-->
<!--                    <div>-->
<!--                        <label for="weixin"><img src="images/zhifu_weixin.png" alt="微信支付"/></label>-->
<!--                    </div>-->
<!--                </li>-->
            </ul>
        </div>
        <!--储蓄卡支付-->
<!--        <div class="chuxuka_zhifu">-->
<!--            <h2 class="zhifu_title_y"><span></span>储蓄卡支付</h2>-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="china"/>-->
<!--                    <div>-->
<!--                        <label for="china"><img src="images/zhifu_china.png" alt="中国银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="zhaoshang"/>-->
<!--                    <div>-->
<!--                        <label for="zhaoshang"><img src="images/zhifu_zhaos.png" alt="招商银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="gongshang"/>-->
<!--                    <div>-->
<!--                        <label for="gongshang"><img src="images/zhifu_gongs.png" alt="中国工商银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="nongye"/>-->
<!--                    <div>-->
<!--                        <label for="nongye"><img src="images/zhifu_noye.png" alt="中国农业银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="jianshe"/>-->
<!--                    <div>-->
<!--                        <label for="jianshe"><img src="images/zhifu_jianshe.png" alt="中国建设银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="jiaotong"/>-->
<!--                    <div>-->
<!--                        <label for="jiaotong"><img src="images/zhifu_jiaot.png" alt="交通银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="shenzheng"/>-->
<!--                    <div>-->
<!--                        <label for="shenzheng"><img src="images/zhifu_shenz.png" alt="深圳发展银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="youzheng"/>-->
<!--                    <div>-->
<!--                        <label for="youzheng"><img src="images/zhifu_youz.png" alt="中国邮政"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="minsheng"/>-->
<!--                    <div>-->
<!--                        <label for="minsheng"><img src="images/zhifu_mings.png" alt="中国民生银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="xingye"/>-->
<!--                    <div>-->
<!--                        <label for="xingye"><img src="images/zhifu_xingye.png" alt="兴业银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="huaxia"/>-->
<!--                    <div>-->
<!--                        <label for="huaxia"><img src="images/zhifu_huax.png" alt="华夏银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="guangda"/>-->
<!--                    <div>-->
<!--                        <label for="guangda"><img src="images/zhifu_guangd.png" alt="中国光大银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="huifeng"/>-->
<!--                    <div>-->
<!--                        <label for="huifeng"><img src="images/zhifu_huifeng.png" alt="汇丰银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="zhada"/>-->
<!--                    <div>-->
<!--                        <label for="zhada"><img src="images/zhifu_zhad.png" alt="渣打银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="huaqi"/>-->
<!--                    <div>-->
<!--                        <label for="huaqi"><img src="images/zhifu_huaqi.png" alt="花旗银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        <!--信用卡支付-->
<!--        <div class="xinYK_zhifu">-->
<!--            <h2 class="zhifu_title_y"><span></span>信用卡支付</h2>-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_china"/>-->
<!--                    <div>-->
<!--                        <label for="yy_china"><img src="images/zhifu_china.png" alt="中国银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_zhaoshang"/>-->
<!--                    <div>-->
<!--                        <label for="yy_zhaoshang"><img src="images/zhifu_zhaos.png" alt="招商银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_gongshang"/>-->
<!--                    <div>-->
<!--                        <label for="yy_gongshang"><img src="images/zhifu_gongs.png" alt="中国工商银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_nongye"/>-->
<!--                    <div>-->
<!--                        <label for="yy_nongye"><img src="images/zhifu_noye.png" alt="中国农业银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_jianshe"/>-->
<!--                    <div>-->
<!--                        <label for="yy_jianshe"><img src="images/zhifu_jianshe.png" alt="中国建设银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_jiaotong"/>-->
<!--                    <div>-->
<!--                        <label for="yy_jiaotong"><img src="images/zhifu_jiaot.png" alt="交通银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_shengzheng"/>-->
<!--                    <div>-->
<!--                        <label for="yy_shengzheng"><img src="images/zhifu_shenz.png" alt="深圳发展银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_youzheng"/>-->
<!--                    <div>-->
<!--                        <label for="yy_youzheng"><img src="images/zhifu_youz.png" alt="中国邮政银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_minsheng"/>-->
<!--                    <div>-->
<!--                        <label for="yy_minsheng"><img src="images/zhifu_mings.png" alt="中国民生银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_xingye"/>-->
<!--                    <div>-->
<!--                        <label for="yy_xingye"><img src="images/zhifu_xingye.png" alt="兴业银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_huaxia"/>-->
<!--                    <div>-->
<!--                        <label for="yy_huaxia"><img src="images/zhifu_huax.png" alt="华夏银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_guangda"/>-->
<!--                    <div>-->
<!--                        <label for="yy_guangda"><img src="images/zhifu_guangd.png" alt="中国光大银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_huifeng"/>-->
<!--                    <div>-->
<!--                        <label for="yy_huifeng"><img src="images/zhifu_huifeng.png" alt="汇丰银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_zhada"/>-->
<!--                    <div>-->
<!--                        <label for="yy_zhada"><img src="images/zhifu_zhad.png" alt="渣打银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <input type="radio" name="zhifu_pT_r" id="yy_huaqi"/>-->
<!--                    <div>-->
<!--                        <label for="yy_huaqi"><img src="images/zhifu_huaqi.png" alt="花旗银行"/></label>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        <!--立即支付按钮-->
        <a href="javascript:;" onclick="integralPay()" class="zhifu_a"><div id="ljzf_btn"></div></a>
    </div>
</div>

<!----------------------------尾部--------------------------->
<div class="footer">
    <span>Copyright &copy; 2015 All Right Reserved toeflonline.cn 版权所有</span>
</div>
</body>
</html>
<script type="text/javascript">
    function changeNumber(_this){
        var money = $(_this).val();
        var reg = /^(([0-9]*[1-9][0-9]*)|(0?\.\d{2}))$/;
        if(!reg.test(money)){
            alert('请输入正确数字');
            return false;
        }
        var integral = money*100;
        $('#integral').html(integral);
    }

    /**
     * 积分下单
     */
    function integralPay(){
        var money = $('#money').val();
        var reg = /^(([0-9]*[1-9][0-9]*)|(0?\.\d{2}))$/;
        if(!reg.test(money)){
            alert('请输入正确数字');
            return false;
        }
        $.post('/pay/api/integral-pay',{money:money},function(re){
            alert(re.message);
            if(re.code == 1){
                window.location.href="/pay/order/pay?orderId="+re.orderId;
            }
        },'json')
    }
</script>