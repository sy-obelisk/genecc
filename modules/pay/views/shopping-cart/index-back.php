<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="js/shoppingCart.js"></script>

<form method="post" id="shopCart" action="/pay/order/index">
    <?php
        if(count($shopCart)>0) {
            ?>
            <table>
                <tr>
                    <td>全选</td>
                    <td>图片</td>
                    <td>名称</td>
                    <td>单价</td>
                    <td>数量</td>
                    <td>操作</td>
                </tr>
                <?php foreach ($shopCart as $v) { ?>
                    <tr>
                        <td><input class="shopId" type="checkbox" value="<?php echo isset($v['id']) ? $v['id'] : '' ?>" name="shopId[]">
                        </td>
                        <td>
                            <img width="50" height="30" src="<?php echo $v['image']?>">
                        </td>
                        <td><?php echo $v['contentName'] ?></br><?php echo $v['tag'] ?></td>
                        <td><?php echo $v['price'] ?></td>
                        <td><span onclick="reduce(<?php echo $v['contentId']?>,this)">-</span><span class="num"><?php echo $v['num'] ?></span><span onclick="add(<?php echo $v['contentId']?>,this)">+</span></td>
                        <td><a href="/pay/shopping-cart/delete?contentId=<?php echo $v['contentId']?>">删除</a></td>
                    </tr>
                <?php
                }
                ?>
                <?php
                $userId = Yii::$app->session->get('userId');
                ?>
                <input onclick="subCart(this)" type="button" data-value="<?php echo $userId ? 1 : 2?>" value="去结算">
            </table>
        <?php
        }else {
            ?>
            <div>暂时还没有添加课程</div>
        <?php
        }
    ?>
</form>
<!DOCTYPE html>
<html>
<head>
    <title>购物车页面</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/public.css"/>
    <link rel="stylesheet" href="css/shoppingCart.css"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="js/shoppingCart.js"></script>
</head>
<body>
<!---------------------头部--------------------------->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<!---------------------头部 end--------------------------->


<div class="shoppingCont">
    <h4>全部商品 <span>12</span></h4>
    <div class="catContent">
        <table cellspacing="0">
            <tr>
                <th>
                    <input type="checkbox" name="checkBox" id="allCheck"/><label for="allCheck">全选</label>
                </th>
                <th>商品</th>
                <th>单价（元）</th>
                <th>数量</th>
                <th>操作</th>
            </tr>
            <?php foreach ($shopCart as $v) { ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td>
                        <div class="cat-left"></div>
                        <div class="cat-right">
                            <h3>美国留学申请服务</h3>
                            <span>2015-06-15 13:16:26</span>
                        </div>
                        <div style="clear: both"></div>
                    </td>
                    <td><span>￥<span>700.00</span></span></td>
                    <td>
                        <div class="calculate">
                            <input type="button" value="-" class="subtract" onclick="subFun(this)"/>
                            <span>1</span>
                            <input type="button" value="+" class="add" onclick="addFun(this)"/>
                        </div>
                    </td>
                    <td><b class="subtotal">￥<span>700</span></b></td>
                    <td>
                        <a href="#">商品详情</a>
                        <a href="javascript:void(0);" class="redColor" onclick="deleteRecord(this)">删除记录</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div class="bottomInfo">
            <div class="info-left">
                <input type="checkbox" name="checkBox" id="allC"/><label for="allC">全选</label>
                <span onclick="deleteProduct()">删除选中的商品</span>
            </div>
            <div class="info-right">
                <span>已选商品<b class="redFont" id="piece">0</b>件</span>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;合计：<b class="redFont"><span>￥<span id="lastTotal">0</span></span></b></span>
                <input type="button" value="结算"/>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>

<!----------------------------尾部--------------------------->
<div class="footer">
    <span>Copyright &copy; 2015 All Right Reserved toeflonline.cn 版权所有</span>
</div>
</body>
</html>
<script type="text/javascript">
    function subCart(_this){
        var arr = new Array();
        var login = $(_this).attr('data-value');
        if(login == 1){
            $('.shopId').each(function(){
                if($(this).is(":checked")){
                    arr.push($(this).val());
                }
            })
            if(arr.length == 0){
                alert('请选择商品');
            }else{
                $.post("/pay/api/add-order-goods",{shopId:arr},function(re){
                    if(re.code == 1){
                        window.location.href="/pay/order/index";
                    }
                },'json')
            }
        }else{
            userLogin();
        }
    }

    /**
     * 购物车数量减一
     * @param _contentId
     */
    function reduce(_contentId,_this){
        var num = parseInt($(_this).siblings('.num').html());
        if(num == 1){
            alert("商品数量不能为0");
            return false;
        }
        $.post("/pay/api/shop-num",{contentId:_contentId,type:1},function(re){
            $(_this).siblings('.num').html(num-1);
        },'json')
    }

    /**
     * 购物车数量加1
     * @param _contentId
     */
    function add(_contentId,_this){
        var num = parseInt($(_this).siblings('.num').html());
        $.post("/pay/api/shop-num",{contentId:_contentId,type:2},function(re){
            $(_this).siblings('.num').html(num+1);
        },'json')
    }
</script>
