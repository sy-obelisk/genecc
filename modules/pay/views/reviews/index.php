<link rel="stylesheet" href="/cn/css/Reviews.css"/>
<script type="text/javascript" src="/cn/js/Reviews.js"></script>
<div class="whiteDiv_r">
    <h4>商品评价</h4>
    <table cellspacing='0'>
        <tr>
            <th>商品信息</th>
            <th>价格</th>
            <th>操作</th>
        </tr>
        <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td>
                        <div class="left-Img">
                            <img src="<?php echo $v['image']?>" alt="商品图片">
                        </div>
                        <div class="right-info">
                            <h5><?php echo $v['name']?></h5>
                            <span>购买时间：<?php echo date("Y-m-d",$v['createTime'])?></span>
                        </div>
                        <div style="clear: both"></div>
                    </td>
                    <td>￥<?php echo $v['price']?></td>
                    <td>
                        <?php
                        if($v['id']) {
                            ?>
                            <p>评价成功</p>
                            <a href="/order.html">返回订单列表</a>
                        <?php
                        }else {
                            ?>
                            <input type="button" value="立即评价" onclick="showReview(<?php echo $v['pid']?>,<?php echo $orderId?>,<?php echo $v['contentId']?>)"/>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
        ?>
    </table>
    <div class="combinedScore">
        <div class="scoreGroup">
            <label><span>*</span>综合评分：</label>
            <div class="rightCont">
                <div class="star">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <span class="rightFont">其他买家需要你的建议哦~~</span>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="scoreGroup">
            <label class="sc-mt"><span>*</span>评价商品：</label>
            <div class="rightCont">
                <div class="pj-textArea">
                    <div class="pj-top">
                        <ul>

                        </ul>
                    </div>
                    <div class="pj-text">
                        <textarea class="discussContent" placeholder="商品是否给力？分享你的购买心得吧！"></textarea>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="sub-btn">
            <input id="contentId" data-type=""  data-value="" onclick="subDiscuss()" type="button" value="提交评价">
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * 提交评价
     */
        function subDiscuss(){
            var stars = $('.star').find('.on').length;
            var plate = new Array();
            var plateObj = $('.pj-top').find('.on');
            plateObj.each(function(){
                plate.push($(this).attr('data-value'));
            })
            var orderId = <?php echo $orderId ?>;
            var contentPid = $('#contentId').attr('data-value');
            var contentId = $('#contentId').attr('data-type');
            var content = $('.discussContent').val();
        $.post("/pay/api/add-discuss",{plate:plate,content:content,contentPid:contentPid,contentId:contentId,orderId:orderId,stars:stars},function(re){
            if(re.code == 1){
                location.reload();
            }else{
                if(re.code == 2){
                }else{
                    alert(re.message);
                }
            }
        },"json")

        }
</script>
