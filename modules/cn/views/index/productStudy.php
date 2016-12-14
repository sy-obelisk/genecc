
    <link rel="stylesheet" href="/cn/css/productStudy.css"/>
</head>
<body>

<!--头部banner-->
<div class="banner">
    <a href="#"><img src="/cn/images/product_topimg.png" alt="banner"/></a>
</div>
<!--研究生留学产品-->
<div class="graduateStudent">
    <div class="col-md-3">
        <div class="haveBg">
            <h4>留学服务</h4>
            <p>美国TOP20名校申请  美国TOP50名校申请  英国G5名校申请  英国TOP10名校申请 留学申请 其他</p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="pro_title">
            <img src="/cn/images/product_title.png" alt="标题头图标"/>
            <span>留学申请服务</span>
            <img src="/cn/images/product_xiexian.png" alt="标题斜线">
            <b>Master Products</b>
            <a href="/study-abroad/category-152/aim-0/country-0/page-1.html">更多 <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="pro_bottom">
            <ul>
                <?php
                foreach($bengke['data'] as $k=>$v) {
                    ?>
                    <li>
                        <div class="col-md-3">
                            <div class="common_p bo_bg1">
                                <div class="lucency"><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></div>
                                <div class="luc_font">
                                    <div class="col-md-7">
                                        <p><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
<!--                                        <span>全程留学服务</span>-->
                                    </div>
                                    <div class="col-md-5">
                                        <p>￥<?php echo $v['price']?></p>
                                        <span>￥<?php echo $v['originalPrice']?></span>
                                        <a href="javascript:void(0);" onclick="addShop(<?php echo $v['id']?>)">加入购物车</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">
    /**
     * 添加购物车
     */
    function addShop(_id){
        var num = 1;
        $.post("/pay/api/add-shopping",{id:_id,num:num},function(re){
            if(re.code == 1){
                alert('加入购物车成功！')
                location.href = "/shopping-cart.html";
            }
        },'json')
    }
</script>
<!--本科留学产品-->
<div class="graduateStudent">
    <div class="col-md-3">
        <div class="haveBg">
            <h4>碎片化留学</h4>
            <p>材料翻译 审核及选校方案 文书服务 面试辅导 签证指导 </p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="pro_title">
            <img src="/cn/images/product_title.png" alt="标题头图标"/>
            <span>碎片化留学服务</span>
            <img src="/cn/images/product_xiexian.png" alt="标题斜线">
            <b>Bachelor Products</b>
            <a href="/study-abroad/category-153,220,223,224/aim-0/country-0/page-1.html">更多 <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="pro_bottom">
            <ul>
                <?php
                foreach($research['data'] as $k=>$v) {
                    ?>
                    <li>
                        <div class="col-md-3">
                            <div class="common_p bo_bg2">
                                <div class="lucency"><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></div>
                                <div class="luc_font">
                                    <div class="col-md-7">
                                        <p><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
<!--                                        <span>全程留学服务</span>-->
                                    </div>
                                    <div class="col-md-5">
                                        <p>￥<?php echo $v['price']?></p>
                                        <span>￥<?php echo $v['originalPrice']?></span>
                                        <a href="javascript:void(0);" onclick="addShop(<?php echo $v['id']?>)">加入购物车</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--语言产品-->
<div class="graduateStudent">
    <div class="col-md-3">
        <div class="haveBg">
            <h4>留学培训</h4>
            <p>TOEFL IELTS GMAT GRE 其他</p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="pro_title">
            <img src="/cn/images/product_title.png" alt="标题头图标"/>
            <span>留学培训</span>
            <img src="/cn/images/product_xiexian.png" alt="标题斜线">
            <b>Language School</b>
            <a href="/course/category-0/type-0/page-1.html">更多 <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="pro_bottom">
            <ul>
                <?php
                $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'originalPrice,price','category' => '155','pageSize' => 4]);
                foreach($data as $v) {
                    ?>
                    <li>
                        <div class="col-md-3">
                            <div class="common_p bo_bg3">
                                <div class="lucency"><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></div>
                                <div class="luc_font">
                                    <div class="col-md-7">
                                        <p><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
<!--                                        <span>全程留学服务</span>-->
                                    </div>
                                    <div class="col-md-5">
                                        <p>￥<?php echo $v['price']?></p>
                                        <span>￥<?php echo $v['originalPrice']?></span>
                                        <a href="javascript:void(0);" onclick="addShop(<?php echo $v['id']?>)">加入购物车</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--增值服务-->
<div class="graduateStudent">
    <div class="col-md-3">
        <div class="haveBg">
            <h4>增值服务</h4>
            <p>实习 游学 学习定制计划 论坛答疑 课前测评 模考解析 留学图书</p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="pro_title">
            <img src="/cn/images/product_title.png" alt="标题头图标"/>
            <span>增值服务</span>
            <img src="/cn/images/product_xiexian.png" alt="标题斜线">
            <b>Value Added Service</b>
            <a href="/after-class/category-0/page-1.html">更多 <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="pro_bottom">
            <ul>
                <?php
                $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'originalPrice,price','category' => '165','pageSize' => 4]);
                foreach($data as $v) {
                    ?>
                    <li>
                        <div class="col-md-3">
                            <div class="common_p bo_bg4">
                                <div class="lucency"><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></div>
                                <div class="luc_font">
                                    <div class="col-md-7">
                                        <p><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
<!--                                        <span>全程留学服务</span>-->
                                    </div>
                                    <div class="col-md-5">
                                        <p>￥<?php echo $v['price']?></p>
                                        <span>￥<?php echo $v['originalPrice']?></span>
                                        <a href="javascript:void(0);" onclick="addShop(<?php echo $v['id']?>)">加入购物车</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

</body>
</html>