<link rel="stylesheet" href="/cn/css/payPublic.css"/>
<link rel="stylesheet" href="/cn/css/payThree.css"/>
<div class="outPay">
    <div class="paySuc">
        <ul>
            <li>
                <img src="/cn/images/settlement_true.png" alt="勾勾图标"/>
                <span>支付成功！</span>
            </li>
            <li>
                <span>共计支付金额<b><?php echo $money?>元</b></span>
            </li>
            <li>
                <span>订单号：<?php echo $orderNumber?></span>
                <span>在线支付：<?php echo $money?>元</span>
            </li>
            <li>
                <a href="/">继续购物</a>
                <a href="/order.html">查看我的订单&gt;&gt;</a>
            </li>
        </ul>
    </div>
</div>
