<?php $userId = Yii::$app->session->get('userId')?>
<?php $userData = Yii::$app->session->get('userData')?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->context->title?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="<?php echo $this->context->keywords?>">
    <meta name="description" content="<?php echo $this->context->description?>">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/cn/js/public.js"></script>
</head>
<body>
<?php
$success_content = Yii::$app->session->get('success_content');
$loginOut = Yii::$app->session->get('loginOut');
if($success_content){
    echo $success_content;
    Yii::$app->session->remove('success_content');
}
if($loginOut){
    echo $loginOut;
    Yii::$app->session->remove('loginOut');
}
?>
<!---------------------------------头部信息条---------------------------------->
<!--<div class="commonNav">-->
<!--    <div class="inC-nav">-->
<!--        <div class="inC-navL">-->
<!--            <ul>-->
<!--                <li><a href="/"><i class="fa fa-home"></i>商城首页</a></li>-->
<!--                <li>您好，欢迎来到SmartApply商城！</li>-->
<!--                <li>|</li>-->
<!--                <li>服务热线：<span>400-1816-180</span></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="inC-navR">-->
<!--            <ul>-->
<!--                <li><a href="http://www.gmatonline.cn" target="_blank">返回雷哥GMAT</a></li>-->
<!--                <li><a href="http://www.toeflonline.cn" target="_blank">返回托福在线</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <!--        -->--><?php
//        //            if(!$userId) {
//        //                ?>
<!--        <!--                <div class="inC-navR">-->-->
<!--        <!--                    <ul>-->-->
<!--        <!--                        <li>[<a href="/login.html">登录</a>]</li>-->-->
<!--        <!--                        <li>[<a href="/register.html">免费注册</a>]</li>-->-->
<!--        <!--                    </ul>-->-->
<!--        <!--                </div>-->-->
<!--        <!--            -->--><?php
//        //            }
//        //        ?>
<!--        <div style="clear: both"></div>-->
<!--    </div>-->
<!--</div>-->
<div class="greyNav">
    <div class="inGrey">
        <div class="leftNav">
            <ul>
                <li>
                    <img src="images/index_kevinIcon.png" alt="图标">
                </li>
                <li><a href="http://www.gmatonline.cn/">GMAT</a></li>
                <li><a href="/" class="on">TOEFL</a></li>
                <li><a href="http://ielts.gmatonline.cn/">IELTS</a></li>
                <li><a href="http://smartapply.gmatonline.cn /" target="_blank">留学</a></li>
                <li>|</li>
                <li><span>400-1816-180</span></li>
                <li><a href="tencent://message/?uin=1746295647&amp;Site=www.cnclcy&amp;Menu=yes">在线咨询</a></li>
            </ul>
        </div>
        <div class="rightLogin">
            <!--登陆之后展示-->
            <div class="loginAfter">
                <div class="whiteDiv"><img src="images/details_defaultImg.png" alt="用户头像"></div>
                <div class="leftFont">
                    <span>hirsi                        （初来乍到）</span>
                    <i class="fa fa-angle-down"><img src="images/crow-2.png" alt=""></i>
                </div>
                <div class="clearB"></div>
            </div>
        </div>
        <div class="clearBr"></div>
    </div>
</div>
<!---------------------------------头部信息条 end---------------------------------->
<!-------------------头部------------------------>
<div class="headBg">
    <div class="head">
        <!--左边的logo-->
        <div class="logo">
            <a href="/"><img src="/cn/images/head_logo.png" alt="logo图标" width="247"/></a>
        </div>
        <!--中间的搜索-->
        <div class="search">
            <input class="goodsKeywords" type="text" value="<?php echo  isset($_GET['content'])?$_GET['content']:''?>" placeholder="托福口语技巧" onkeydown="javascript:searchs(event)"/>
            <div onclick="searchGoods()" class="searchIcon">
                <span></span>
                <img src="/cn/images/head_search.png" alt="搜索图标"/>
            </div>
        </div>
        <script type="text/javascript">
            function searchGoods(){
                var content = $('.goodsKeywords').val();
                if(content == ''){
                    alert('请输入关键词');return false;
                }
                location.href = '/search/content-'+content+'/page-1.html'
            }
            function searchs(e){
                if(e.keyCode==13){
                    searchGoods();
                }
            }
        </script>
        <!--购物车-->
        <div class="shoppingCart">
            <a href="/shopping-cart.html">
                <img src="/cn/images/head_shopIcon.png" alt="购物车图标"/>
                <span>购物车</span>
            </a>
        </div>
        <!--登陆/注册-->
        <div class="loginR">
            <?php
            if(!$userId) {
                ?>
                <!------------未登陆展示---------------->
                <div class="beforeLogin">
                    <a href="/login.html">登录</a>
                    <span>|</span>
                    <a href="/register.html">注册</a>
                </div>
            <?php
            }else {
                ?>
                <!--                    ---------登陆展示--------------------->
                <div class="afterLogin">
                    <div class="after-left">
                        <img class="navImage" src="<?php echo $userData['image']?$userData['image']:'/cn/images/details_defaultImg.png'?>" alt="用户头像"/>
                    </div>
                    <div class="after-right">
                        <span>个人中心</span>
                        <i class="fa fa-caret-down"></i>
                    </div>
                    <div style="clear: both"></div>
                    <!--                    &lt;!&ndash;下拉&ndash;&gt;-->
                    <div class="myCenter">
                        <ul>
                            <li><a href="/order.html">我的订单</a></li>
                            <li><a href="/integral.html">我的雷豆</a></li>
                            <li><a href="/user.html">个人资料</a></li>
                            <li><a onclick="loginOut()" href="javascript:;">退出</a></li>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    /**
     * 用户退出
     */
    function loginOut(){
        $.post('/cn/api/login-out',{},function(re){
            window.location.href="/"
        },'json')
    }
</script>
<!-------------------头部 end------------------------>

<!-------------------导航------------------------>
<div class="nav">
    <div class="inNav">
        <div class="nav-left">
            <a href="/" class="allSort">
                <span>全部商品分类</span>
                <i class="fa fa-angle-down"></i>
            </a>
            <!--            <img src="/cn/images/head_topBG.png" alt="全部商品分类顶部背景"/>-->
            <!--下拉部分-->
            <?php $controller = Yii::$app->controller->id;?>
            <?php $action = Yii::$app->controller->action->id;?>
            <?php
            $country = \app\modules\cn\models\Category::find()->where("pid=156")->orderBy("sort DESC")->all();
            $degree = \app\modules\cn\models\Category::find()->where("pid=159")->orderBy("sort DESC")->all();
            $category = \app\modules\cn\models\Category::find()->where("pid=150")->orderBy("sort DESC")->all();
            ?>
            <div class="classify <?php echo $controller=='index' || ($controller=='public-class' && $action=='index')?'default':''?>">
                <ul>
                    <li>
                        <h4>出国留学</h4>
                        <ul>
                            <?
                            foreach($category as $v) {
                                ?>
                                <li>
                                    <?php
                                    if($v['id'] == 151) {
                                        ?>
                                        <a href="/Americatop30.html"><?php echo $v['name']?></a>
                                    <?php
                                    }else {
                                        ?>
                                        <a href="/study-abroad/category-<?php echo $v['id']?>/aim-0/country-0/page-1.html"><?php echo $v['name']?></a>
                                    <?php
                                    }
                                    ?>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div class="classLevel">
                            <ul>
                                <?php
                                foreach($country as $v) {
                                    ?>
                                    <li>
                                        <div class="title"><?php echo $v['name']?></div>
                                        <ol>
                                            <?php
                                            foreach($degree as $val) {
                                                ?>
                                                <li><a href="/study-abroad/category-0/aim-<?php echo $val['id']?>/country-<?php echo $v['id']?>/page-1.html"><?php echo $val['name']?></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ol>
                                        <div style="clear: both"></div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4>留学工具 <span style="font-size: 12px;color: red;">开发中</span></h4>
                        <ul>

                            <li>
                                <a href="http://schools.smartapply.cn/schools.html">院校库</a>
                            </li>
                            <li>
                                <a href="http://academy.gmatonline.cn/assess.html">留学评估</a>
                            </li>
                            <li>
                                <a href="#">选校报告</a>
                            </li>
                            <li>
                                <a href="#">案例库</a>
                            </li>
                            <li>
                                <a href="#">大学排名</a>
                            </li>
                            <li>
                                <a href="#">留学动态</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h4>留学考试</h4>
                        <ul>
                            <?php
                            $category = \app\modules\cn\models\Category::find()->where("pid=155")->orderBy("sort DESC")->all();
                            $video = \app\modules\cn\models\Content::getClass(['category' =>'199','where' => 'c.pid=0']);
                            $live = \app\modules\cn\models\Content::getClass(['category' =>'198','where' => 'c.pid=0']);
                            foreach($category as $k => $v) {
                                ?>
                                <li>
                                    <a href="/course/category-<?php echo $v['id']?>/type-0/page-1.html"><?php echo $v['name']?></a>
                                </li>
                            <?php
                            }
                            ?>
                            <li>
                                <a href="/public-class.html" target="_blank">公开课</a>
                            </li>
                        </ul>

                        <div class="classLevel">
                            <ul>
                                <li>
                                    <div class="title">直播课</div>
                                    <ol>
                                        <?php
                                        foreach($live as $v){
                                            ?>
                                            <li><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ol>
                                    <div style="clear: both"></div>
                                </li>
                                <li>
                                    <div class="title">视频课</div>
                                    <ol>
                                        <?php
                                        foreach($video as $v){
                                            ?>
                                            <li><a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ol>
                                    <div style="clear: both"></div>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li>
                        <h4>增值服务</h4>
                        <ul>
                            <?php
                            $category = \app\modules\cn\models\Category::find()->where("pid=165")->orderBy("sort DESC")->all();
                            foreach($category as $v) {
                                ?>
                                <li><a href="/after-class/category-<?php echo $v['id']?>/page-1.html"><?php echo $v['name']?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <li>
                        <h4>留学图书</h4>
                        <ul>
                            <?php
                            $category = \app\modules\cn\models\Category::find()->where("pid=170")->orderBy("sort DESC")->all();
                            foreach($category as $v) {
                                ?>
                                <li><a href="/voucher/category-<?php echo $v['id']?>/page-1.html"><?php echo $v['name']?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nav-right">
            <ul>
                <!--                <li --><?php //echo $controller=='index'?'class="on"':''?><!-->
                <!--                    <a href="/">首页</a>-->
                <!--                </li>-->
                <li><a href="/study-abroad/category-152/aim-0/country-0/page-1.html">留学定制</a></li>
                <li>
                    <a href="/study-abroad/category-223/aim-0/country-0/page-1.html">文书</a>
                </li>
                <li><a href="http://academy.gmatonline.cn/assess.html">留学评估</a></li>
                <li><a href="http://schools.smartapply.cn/schools.html">院校库</a></li>

                <!--                <li><a href="#">案例库</a></li>-->
                <!--                <li><a href="#">大学排名</a></li>-->
                <!--                <li>-->
                <!--                    <a href="/study-abroad/category-151/aim-0/country-0/page-1.html">网申</a>-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <a href="/study-abroad/category-153/aim-0/country-0/page-1.html">选校</a>-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <a href="/after-class/category-154/page-1.html">实习</a>-->
                <!--                </li>-->
                <li>
                    <a href="/course/category-162/type-0/page-1.html">GMAT</a>
                </li>
                <li>
                    <a href="/course/category-163/type-0/page-1.html">托福</a>
                </li>
                <li>
                    <a href="/public-class.html" target="_blank">公开课</a>
                </li>
            </ul>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<!-------------------导航 end------------------------>
<?=$content?>
<!----------------------尾部----------------------------->
<div class="footer">
    <div class="inFooter">
        <div class="foot-left">
            <h4>24</h4>
            <span>小时免费热线</span>
            <p>400-1816-180</p>
            <img src="/cn/images/index_phone.png" alt="电话图标"/>
        </div>
        <div class="foot-right">
            <div class="footNav">
                <ul>
                    <li><a href="/study-abroad/category-152/aim-0/country-0/page-1.html">留学定制</a></li>
                    <li><span>|</span></li>
                    <li>
                        <a href="/study-abroad/category-223/aim-0/country-0/page-1.html">文书</a>
                    </li>
                    <li><span>|</span></li>
                    <li><a href="http://schools.smartapply.cn/schools.html">院校库</a></li>
                    <li><span>|</span></li>
                    <li><a href="#">案例库</a></li>
                    <li><span>|</span></li>
                    <li><a href="#">大学排名</a></li>
                    <li><span>|</span></li>
                    <!--                <li>-->
                    <!--                    <a href="/study-abroad/category-151/aim-0/country-0/page-1.html">网申</a>-->
                    <!--                </li>-->
                    <!--                <li>-->
                    <!--                    <a href="/study-abroad/category-153/aim-0/country-0/page-1.html">选校</a>-->
                    <!--                </li>-->
                    <!--                <li>-->
                    <!--                    <a href="/after-class/category-154/page-1.html">实习</a>-->
                    <!--                </li>-->
                    <li>
                        <a href="/course/category-162/type-0/page-1.html">GMAT</a>
                    </li>
                    <li><span>|</span></li>
                    <li>
                        <a href="/course/category-163/type-0/page-1.html">托福</a>
                    </li>
                    <li><span>|</span></li>
                    <li>
                        <a href="/public-class.html" target="_blank">公开课</a>
                    </li>
                </ul>
            </div>
            <div class="copyRight">Copyright &copy;2016 All Right Reserved  SmartApply 版权所有</div>
            <div class="weChat">
                <ul>
                    <li>
                        <div class="char-left">
                            <img src="/cn/images/index_ewmGmat.jpg" alt="二维码图片"/>
                        </div>
                        <div class="char-right">
                            <ul>
                                <li>雷哥GMAT官方微信</li>
                                <li>每时每刻掌握GMAT动态</li>
                                <li>随时随地知晓备考资讯</li>
                            </ul>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                    <li>
                        <div class="char-left">
                            <img src="/cn/images/index_ewmTeofl.jpg" alt="二维码图片"/>
                        </div>
                        <div class="char-right">
                            <ul>
                                <li>托福在线官方微信</li>
                                <li>每时每刻掌握托福动态</li>
                                <li>随时随地知晓备考资讯</li>
                            </ul>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<!----------------------尾部  end----------------------------->

</body>
</html>