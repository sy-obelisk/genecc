<link rel="stylesheet" href="/cn/css/MyLeiDou.css"/>
<div class="orderContent">
    <div class="order-left">
        <ul>
            <li><a href="/order.html">我的订单</a></li>
            <li class="on"><a href="/integral.html">我的雷豆</a></li>
            <li><a href="/user.html">个人资料</a></li>
        </ul>
    </div>
    <div class="order-right">
        <div class="canUse">
            <div class="use-left">
                <img src="<?php echo $userData['image']?$userData['image']:'/cn/images/details_defaultImg.png'?>" alt="用户头像">
            </div>
            <div class="use-center">
                <b><?php echo $integral ?></b>
                <span>可用雷豆</span>
            </div>
            <div class="use-right"><a href="/use.html">如何使用雷豆? 如何获得雷豆?</a></div>
            <div style="clear: both"></div>
        </div>
        <div class="LD-detail">
            <div class="detailHd hd">
                <ul>
                    <li data-value="0" class="change <?php echo  (isset($_GET['type'])&&$_GET['type']==0) || !isset($_GET['type'])?'on':''?>">雷豆明细</li>
                    <li data-value="1" class="change <?php echo  isset($_GET['type'])&&$_GET['type']==1?'on':''?>">收入雷豆</li>
                    <li data-value="2" class="change <?php echo  isset($_GET['type'])&&$_GET['type']==2?'on':''?>">支出雷豆</li>
                </ul>
            </div>
            <div class="detailBd">
                        <ul>
                            <li>
                                <table>
                                    <tr>
                                        <th>来源/用途</th>
                                        <th>雷豆变化</th>
                                        <th>日期</th>
                                    </tr>
                                    <?php
                                    foreach($details as $v) {
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="/cn/images/leiDou_<?php echo $v['type']==1?'ling':'huan'?>Icon.png" alt="图标">
                                                <span><?php echo $v['behavior'] ?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="<?php echo $v['type'] == 1 ? 'green' : 'red' ?>"><?php echo $v['type'] == 1 ? '+' : '-' ?>
                                                    <?php echo $v['integral'] ?></span>
                                            </td>
                                            <td>
                                                <span class="grey"><?php echo date("Y-m-d H:i:s", $v['createTime']) ?></span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>
                                <!--------分页--------------->
                                <div class="table-page">
                                    <ul>
<?php echo $pageStr?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<script type="text/javascript">
    $(function(){
        /**
         * 分页点击
         */
        $(".iPage").on("click",function(){
            var type = $('.detailHd').find('.on').attr('data-value');
            var page = $(this).html();
            location.href="/integral/"+type+"/"+page+'.html';
        })

        /**
         * 类型点击
         */
        $('.change').click(function(){
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            var type = $('.detailHd').find('.on').attr('data-value');
            location.href="/integral/"+type+"/1.html";
        })

        $('.prev').click(function(){
            var type = $('.detailHd').find('.on').attr('data-value');
            var page = $('.table-page').find('.on').html();
            page = parseInt(page)-1;
            location.href="/integral/"+type+"/"+page+'.html';
        })

        $('.next').click(function(){
            var type = $('.detailHd').find('.on').attr('data-value');
            var page = $('.table-page').find('.on').html();
            page = parseInt(page)+1;
            location.href="/integral/"+type+"/"+page+'.html';
        })
    })
</script>