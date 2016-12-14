<link rel="stylesheet" href="/cn/css/orderDetails.css"/>
<script type="text/javascript" src="/cn/js/orderDetails.js"></script>
<div class="orderContent">
    <div class="order-left">
        <ul>
            <li class="on"><a href="/order.html">我的订单</a></li>
            <li><a href="/integral.html">我的雷豆</a></li>
            <li><a href="/user.html">个人资料</a></li>
        </ul>
    </div>
    <div class="order-right">
        <div class="orderHd hd">
            <ul>
                <li data-value="3"  class="change <?php echo (isset($_GET['status']) && $_GET['status']==3) || !isset($_GET['status'])?'on':''?>">全部订单</li>
                <li data-value="1" class="change <?php echo (isset($_GET['status']) && $_GET['status']=="1")?'on':''?>">待付款</li>
                <li data-value="2" class="change <?php echo (isset($_GET['status']) && $_GET['status']=="2")?'on':''?>">已付款</li>
            </ul>
        </div>
        <div class="orderBd">
            <ul>
                <li>
                    <table cellspacing='0'>
                        <tr class="haveBg">
                            <th>订单详情  <span style="float: right;">数量</span></th>
                            <th>收货人</th>
                            <th>金额</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($data as $v) {
                            ?>
                            <tr>
                                <td style="width: 400px">
                                    <p class="greyColor"><?php echo date("Y-m-d H:i:s",$v['createTime'])?> <span>订单号：<?php echo $v['orderNumber']?></span></p>
                                    <?php
                                    if($v['type'] == 1) {
                                        ?>
                                        <?php
                                        foreach ($v['goods'] as $val) {
                                            ?>
                                            <div class="left-picture">
                                                <a href="/goods/<?php echo $val['contentId']?>.html">
                                                    <img src="<?php echo $val['image'] ?>" alt="详情图片"/>
                                                </a>
                                            </div>
                                            <div class="right-introduce">
                                                <h4><a href="/goods/<?php echo $val['contentId']?>.html"><?php echo $val['contentName'] ?></a></h4>
                                                <span><a href="/goods/<?php echo $val['contentId']?>.html"><?php echo $val['contentTag'] ?></a></span>
                                            </div>
                                            <div>
                                                <span><?php echo $val['num'] ?></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }else {
                                        ?>
                                        <div class="left-picture">
                                            <img src="/cn/images/ldcz.png" alt="详情图片"/>
                                        </div>
                                        <div class="right-introduce">
                                            <h4>雷豆充值</h4>
                                            <span></span>
                                        </div>
                                        <div>
                                            <span>1</span>
                                        </div>
                                        <div style="clear: both"></div>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $v['type'] == 1?$v['consigneeName']:'雷豆'?></td>
                                <td><span class="redColor">￥<?php echo $v['payable']?></span></td>
                                <?php   switch($v['status'])
                                {
                                    case 1:$status='未付款';break;
                                    case 2:$status='已取消';break;
                                    case 3:$status='已付款';break;
                                    case 4:$status='配送中';break;
                                    case 5:$status='已完成';break;
                                } ?>
                                <td><span class="redColor"><?php echo $status?></span></td>
                                <td>
                                    <?php if($v['status'] == 1) { ?>
                                        <a class="buyNow" href="/payType/<?php echo $v['id']?>.html">付款</a>
                                        <a class="redColor" onclick="CancelOrder(<?php echo $v['id']?>,this)" href="javascript:;">取消订单</a>
                                    <?php
                                    }else if($v['status'] > 2){
                                        ?>
                                        <a href="<?php echo $v['reviews']?'javascript:;':'/evaluate/'.$v['id'].'.html'?>" class="orderD"><?php echo $v['reviews']?'已评价':'立即评价'?></a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <!--分页-->
                    <div class="table-page">
                        <ul>
                            <?php echo $pageStr?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<script type="text/javascript">
    /**
     * 立即购买
     * @param _id
     * @param _this
     */
    function buy(_id,_this){
        $.post("/pay/api/buy-again",{orderId:_id},function(re){
            if(re.code == 1){
                window.location.href="/shopping-cart.html"
            }
        },'json')
    }

    function CancelOrder(_id,_this){
        $.post("/pay/api/cancel-order",{orderId:_id},function(re){
            alert(re.message);
            if(re.code == 1){
                window.location.href="/order.html"
            }
        },'json')
    }
    $(function(){
        /**
         * 分页点击
         */
        $(".iPage").on("click",function(){
            var type = $('.orderHd').find('.on').attr('data-value');
            var page = $(this).html();
            location.href="/order/"+type+"/"+page+'.html';
        })

        /**
         * 类型点击
         */
        $('.change').click(function(){
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            var type = $('.orderHd').find('.on').attr('data-value');
            location.href="/order/"+type+"/1.html";
        })
    })
</script>