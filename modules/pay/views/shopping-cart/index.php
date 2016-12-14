<link rel="stylesheet" href="/cn/css/shoppingCart.css"/>
<script type="text/javascript" src="/cn/js/shoppingCart.js"></script>
<div class="shoppingCont">
    <h4>全部商品</h4>
    <div class="catContent">
        <table cellspacing="0">
            <tr>
                <th>
                    <input type="checkbox" name="checkBox" id="allCheck"/><label for="allCheck">全选</label>
                </th>
                <th>商品</th>
                <th>单价（元）</th>
                <th>数量</th>
                <th>小计（元）</th>
                <th>操作</th>
            </tr>
            <?php foreach ($shopCart as $v) { ?>
                <tr>
                    <td><input class="shopId" value="<?php echo isset($v['id']) ? $v['id'] : '' ?>" name="shopId[]" type="checkbox"/></td>
                    <td>
                        <div class="cat-left"><img width="166" height="109" src="<?php echo $v['image']?>"></div>
                        <div class="cat-right">
                            <h3><?php echo $v['contentName'] ?></br><?php echo $v['tag'] ?></h3>
                            <span><?php echo date("Y-m-d H:i",$v['createTime']) ?></span>
                        </div>
                        <div style="clear: both"></div>
                    </td>
                    <td><span>￥<span><?php echo $v['price'] ?></span></span></td>
                    <td>
                        <div class="calculate">
                            <input type="button" value="-" class="subtract" onclick="reduce(<?php echo $v['contentId']?>,this,<?php echo $v['price']?>)"/>
                            <span class="num"><?php echo $v['num'] ?></span>
                            <input type="button" value="+" class="add" onclick="add(<?php echo $v['contentId']?>,this,<?php echo $v['price']?>)"/>
                        </div>
                    </td>
                    <td><b class="subtotal">￥<span><?php echo $v['price']*$v['num'] ?></span></b></td>
                    <td>
                        <a href="/toeflcourses/<?php echo $v['contentId']?>.html">商品详情</a>
                        <a href="/pay/shopping-cart/delete?contentId=<?php echo $v['contentId']?>" class="redColor">删除记录</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div class="bottomInfo">
            <div class="info-left">
<!--                <input type="checkbox" name="checkBox" id="allC"/><label for="allC">全选</label>-->
<!--                <span onclick="deleteProduct()">删除选中的商品</span>-->
            </div>
            <div class="info-right">
                <span>已选商品<b class="redFont" id="piece">0</b>件</span>
                <?php
                    $userId = Yii::$app->session->get('userId');
                ?>
                <input onclick="subCart(this)" type="button" data-value="<?php echo $userId ? 1 : 2?>" value="去结算"/>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
