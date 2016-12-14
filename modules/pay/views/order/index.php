<script type="text/javascript" src="/PCASClass/PCASClass.js"></script>
<link rel="stylesheet" href="/cn/css/cart-details.css"/>
<script type="text/javascript" src="/cn/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="/cn/js/cart-details.js"></script>
<div class="outCart">
    <h4>填写并核对订单信息</h4>
    <div class="inCart">
        <div class="cartTitle">收货人信息</div>
        <div class="delivery">
            <ul>
                <?php
                if(count($consignee)>0) {
                    ?>
                    <?php foreach ($consignee as $v) { ?>
                        <li class="consignee" data-value="<?php echo isset($v['id']) ? $v['id'] : '' ?>">
                            <div class="inDeli">
                                <div class="inDeli-left" onclick="defaultAddress(this)">
                                    <span><?php echo $v['alias']?></span>
                                    <b></b>
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="inDeli-center">
                                    <ul>
                                        <li><?php echo $v['name']?></li>
                                        <li>
                                            <span class="province"><?php echo $v['province']?></span>
                                            <span class="city"><?php echo $v['city']?></span>
                                            <span class="region"><?php echo $v['area']?></span>
                                            <span class="detailedness"><?php echo $v['address']?></span>
                                        </li>
                                        <li><?php echo $v['phone']?></li>
                                    </ul>
                                </div>
                                <div class="inDeli-right">
                                    <a href="javascript:void(0);" onclick="defaultAddress(this)">设为默认地址</a>
                                    <a href="javascript:void(0);" onclick="editAddress(this)">编辑</a>
                                    <a href="javascript:void(0);" onclick="deleteCurrent(this,<?php echo $v['id']?>)">删除</a>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                <?php
                }else {
                    ?>
                    <li>请添加收货人信息</li>
                <?php
                }
                ?>
            </ul>
            <a href="javascript:void(0);" class="newAdd" onclick="showAddress()">新增收货人</a>
        </div>
        <div class="cartTitle">支付方式</div>
        <div class="payWay">
            <div class="inPay">
                <span>在线支付</span>(支付宝)
                <b></b>
                <i class="fa fa-check"></i>
            </div>
        </div>
        <div class="cartTitle">商品详情</div>
        <div class="payInfo">
            <table cellspacing='0'>
                <tr>
                    <th>商品</th>
                    <th>单价</th>
                    <th>数量</th>
                    <th>优惠</th>
                </tr>
                <?php foreach ($goods as $v) { ?>
                    <tr>
                        <td>
                            <div class="payI-left"><img width="166" height="109" src="<?php echo $v['image']?>"></div>
                            <div class="payI-right">
                                <h3><?php echo $v['contentName'] ?></h3>
                                <span><?php echo $v['tag'] ?></span>
                            </div>
                            <div style="clear: both"></div>
                        </td>
                        <td>￥<span><?php echo $v['price'] ?></span></td>
                        <td>×<span><?php echo $v['num'] ?></span></td>
                        <td><span class="redColor"><?php echo $v['fStr']?$v['fStr']:'没有活动优惠' ?></span></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <div class="bottomRed">
                <ul>
                    <li>
                        <span><span class="redColor" id="allPiece">0</span>件商品，总商品金额：</span>
                        <label>￥<span id="totalPrice"><?php echo $totalMoney?></span></label>
                    </li>
                    <li>
                        <span>总优惠：</span>
                        <label>-￥<span><?php echo $totalDis?></span></label>
                    </li>
                    <li>
                        <span>运费：</span>
                        <label>￥<span>0.00</span></label>
                    </li>
                </ul>
            </div>
            <div class="useLD">
                <ul>
                    <li>
                        <input checked type="checkbox" id="checkBox"/>
                        <span>使用雷豆抵扣：</span>
                        <input type="text" value="<?php echo $integral?>" id="importLD" onblur="countLD(this)"/>
                        <span>个</span>
                    </li>
                    <li>
                        <span>你有<span id="haveLD"><?php echo $integral?></span>个，可用<span id="canUseLD"><?php echo $integral?></span>个</span>
                    </li>
                    <li>
                        <span>-￥<span id="deduction"><?php echo $integral*0.01?></span></span>
                    </li>
                </ul>
            </div>
            <div class="present">
                <span>应付金额：</span>
                <b>￥<span id="amountPayable"><?php echo $totalMoney-$totalDis?></span></b><br>
                <a onclick="subOrder()" href="javascript:;">提交订单</a>
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>

<!--遮罩层-->
<div class="addressMask"></div>
<!--添加收货地址-->
<div class="shippingAddress" id="newAdd">
    <div class="topTitle">
        <span>编辑收货人</span>
        <i class="fa fa-close" onclick="closeAddress(this)"></i>
    </div>
    <div class="addressContent">
        <form action="" id="address">
            <ul>
                <li>
                    <span><b>*</b>收货人：</span>
                    <div>
                        <input name="name" type="text" class="oneWidth"/>
                    </div>
                </li>
                <li>
                    <span><b>*</b>所在地区：</span>
                    <div>
                        <select class="province" name="province">

                        </select>
                        <select class="city" name="city">

                        </select>
                        <select class="area" name="area">

                        </select>
                    </div>
                </li>
                <li>
                    <span><b>*</b>详细地址：</span>
                    <div>
                        <input name="address" type="text" class="twoWidth"/>
                    </div>
                </li>
                <li>
                    <span><b>*</b>手机号码：</span>
                    <div>
                        <input name="phone" type="text" class="oneWidth" datatype="m" errormsg="手机号格式不正确(不能小于11位)!"/>
                    </div>
                </li>
                <li>
                    <span>地址别名：</span>
                    <div>
                        <input name="alias" type="text" class="oneWidth"/>
                        <span class="biem">建议填写常用名称【家里】【父母家】【公司】</span>
                    </div>
                </li>
                <input id="consigneeId" type="hidden" name="id" value="">
                <li>
                    <input type="button" onclick="saveConsignee()" value="保存收货人信息" class="sub-btn">
                </li>
            </ul>
        </form>
    </div>
</div>
