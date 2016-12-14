<link rel="stylesheet" href="/cn/css/payTwo.css"/>
<link rel="stylesheet" href="/cn/js/payTwo.js"/>
<div class="payTwo">
    <div class="payT-top">
        <ul>
            <li>订单号：<?php echo $sign->orderNumber?></li>
            <li>请您及时付款，以便订单尽快处理！</li>
            <li>应付金额：<span><?php echo $sign->payable?>元</span></li>
        </ul>
    </div>
    <div class="payWay">
        <h4>选择付款方式</h4>
        <h5>第三方支付</h5>
        <ul>
            <li>
                <input type="radio" checked name="pay" id="pay01"/>
                <label for="pay01">
                    <img src="/cn/images/pay_icon01.png" alt="代表图片">
                    <img src="/cn/images/pay_fontIcon.png" alt="文字图片"></label>
            </li>
<!--            <li>-->
<!--                <input type="radio" name="pay" id="pay02"/>-->
<!--                <label for="pay02">-->
<!--                    <img src="/cn/images/pay_icon01.png" alt="代表图片">-->
<!--                    扫码支付</label>-->
<!--            </li>-->
<!--            <li>-->
<!--                <input type="radio" name="pay" id="pay03"/>-->
<!--                <label for="pay03">-->
<!--                    <img src="/cn/images/pay_icon02.png" alt="代表图片">-->
<!--                    微信支付</label>-->
<!--            </li>-->
        </ul>
        <a href="/pay/order/pay?orderId=<?php echo $sign->id?>" class="comeOnPay">立即支付</a>
        <div style="clear: both"></div>
    </div>
</div>
