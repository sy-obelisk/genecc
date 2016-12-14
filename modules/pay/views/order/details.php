<!DOCTYPE html>
<html>
<head>
    <title>订单---详情页</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/order-details.css"/>
    <script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
</head>
<body>
<!---------------------头部--------------------------->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<!---------------------头部 end--------------------------->
<div class="orderTop">
    <h4>订单详情</h4>
    <div class="orderNum">
        订单号：<?php echo $data['orderNumber']?>
        <?php   switch($data['status'])
        {
            case 1:$status='未付款';break;
            case 2:$status='已取消';break;
            case 3:$status='已付款';break;
            case 4:$status='配送中';break;
            case 5:$status='已完成';break;
        } ?>
        &nbsp;&nbsp;&nbsp;&nbsp;状态：<span class="redC"><?php echo $status?></span>
        <!--------完成显示下面的--------->
        <!--<span class="greenC">完成</span>-->
        <!--<a href="#">评价</a>&lt;!&ndash;跳转到课程详情页的评价&ndash;&gt;-->
    </div>
    <div class="status">
        <ul>
            <li class="on">
                <div class="numDiv"></div>
                <span>提交订单</span>
                <p><?php echo date("Y-m-d",$data['createTime'])?><br> <?php echo date("H:i:s",$data['createTime'])?></p>
            </li>
            <li class="on">
                <div class="lineDiv"></div>
            </li>
            <li class="on">
                <div class="lineDiv"></div>
            </li>
            <?php
                if($data['status'] != 2 ) {
                    ?>
                    <li class="<?php echo $data['status'] >2?'on':''?>">
                        <div class="numDiv"></div>
                        <span>付款成功</span>
                    </li>
                    <li class="<?php echo $data['status'] >2?'on':''?>">
                        <div class="lineDiv"></div>
                    </li>
                    <li class="<?php echo $data['status'] >2?'on':''?>">
                        <div class="lineDiv"></div>
                    </li>
                    <li class="<?php echo $data['status'] >2?'on':''?>">
                        <div class="numDiv"></div>
                        <span>完成购买</span>
                        <?php
                            if($data['payTime']) {
                                ?>
                                <p><?php echo date("Y-m-d", $data['payTime'])?>
                                    <br> <?php echo date("H:i:s", $data['payTime'])?></p>
                            <?php
                            }
                        ?>
                    </li>
                <?php
                }else {
                    ?>
                    <li class="on">
                        <div class="numDiv"></div>
                        <span>取消成功</span>
                    </li>
                <?php
                }
            ?>
        </ul>
    </div>
</div>

<div class="orderInfo">
    <div class="infoHead">订单信息</div>
    <div class="infoContent">
        <?php if($data['type'] == 1){?>
        <h4>收货人信息</h4>
        <ul>
            <li>收&nbsp;&nbsp;货&nbsp;&nbsp;人：<?php echo $data['consigneeName']?></li>
            <li>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：<?php echo $data['address']?></li>
            <li>手机号码：<?php echo $data['phone']?></li>
        </ul>
        <div class="xianGrey"></div>
        <h4>支付及配送方式</h4>
        <ul>
            <li>支付方式：在线支付</li>
            <li>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：0.00</li>
        </ul>
        <?php
        }
        ?>
        <div class="infoTable">
            <table>
                <tr>
                    <th>商品</th>
                    <th>状态</th>
                    <th>单价</th>
                    <th>数量</th>
                </tr>
                <?php
                    if($data['type'] == 1) {
                        ?>
                        <?php
                            foreach($data['goods'] as $v) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="leftImg"><img width="133" height="85" src="<?php echo $v['image']?>"></div>
                                        <div class="rightFont">
                                            <h5><?php echo $v['contentName']?></h5>
                                        </div>
                                        <div style="clear: both"></div>
                                    </td>
                                    <td><?php echo $status?></td>
                                    <td>￥<?php echo $v['price']?></td>
                                    <td><?php echo $v['num']?></td>
                                </tr>
                            <?php
                            }
                                ?>
                    <?php
                    }else {
                        ?>
                        <tr>
                            <td>
                                <div class="leftImg"><img width="133" height="85" src="/cn/images/ldcz.png"></div>
                                <div class="rightFont">
                                    <h5>雷豆充值</h5>
                                </div>
                                <div style="clear: both"></div>
                            </td>
                            <td><?php echo $status?></td>
                            <td>￥<?php echo $data['payable']?></td>
                            <td>1</td>
                        </tr>
                    <?php
                    }
                ?>
            </table>
            <div class="orderTotal">
                订单总金额：<span>￥<?php echo $data['payable']?></span>
            </div>
        </div>
    </div>
</div>



<!----------------------------尾部--------------------------->
<div class="footer">
    <span>Copyright &copy; 2015 All Right Reserved toeflonline.cn 版权所有</span>
</div>


</body>
</html>