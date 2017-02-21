<?php $userId = Yii::$app->session->get('userId'); ?>
<?php $userData = Yii::$app->session->get('userData')?>
<!DOCTYPE html>
<html>
<head>
<!--    <title>--><?php //echo $this->context->title?><!--</title>-->
    <title>出国留学_美国留学_英国留学_澳洲留学_留学申请_雷哥网留学</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="<?php echo $this->context->keywords?>">
    <meta name="description" content="<?php echo $this->context->description?>">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/animate.min.css"/>
    <link rel="stylesheet" href="/cn/css/newPublic.css"/>
    <link rel="stylesheet" href="/cn/css/reset.css"/>
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
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
<!-------------------咨询框------------------------>
<div class="refer_small" onclick="showZiXun()"></div>
<div class="referBox">
    <div class="refer_close" onclick="closeRefer()"></div>
    <div class="refer_top"></div>
    <div class="refer_con">
        <ul>
            <li>
                <a href="http://p.qiao.baidu.com/im/index?siteid=7905926&ucid=18329536&cp=&cr=&cw=" target="_blank">
                    <div class="comSize diffBG01"></div>
                    <p>在线咨询</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <div class="comSize diffBG02"></div>
                    <p>微信</p>
                    <div class="tanc_mask01 animated"><img src="/cn/images/smartapply_ewm.png" alt="二维码图片"></div>
                </a>
            </li>
            <li>
                <a href="tencent://message/?uin=3426496022&amp;Site=www.cnclcy&amp;Menu=yes" target="_blank">
                    <div class="comSize diffBG03"></div>
                    <p>QQ</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <div class="comSize diffBG04"></div>
                    <p>电话</p>
                    <div class="tanc_mask02 animated">400-1816-180</div>
                </a>
            </li>
            <li>
                <a href="tencent://message/?uin=2187813997&amp;Site=www.cnclcy&amp;Menu=yes" target="_blank">
                    <div class="comSize diffBG05"></div>
                    <p>吐槽入口</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="referTop();">
                    <div class="diffBG06 animated">
                        <img src="/cn/images/refer_icon06.png" alt="回到顶部图标"/>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
    <!-------------------头部------------------------>
    <div class="greyNav">
        <div class="inGrey">
            <div class="leftNav">
                <ul>
                    <li>
                        <a href="/"><img src="/cn/images/index_kevinIcon.png" alt="图标"></a>
                    </li>
                    <li><a href="http://www.gmatonline.cn">GMAT</a></li>
                    <li><a href="http://www.toeflonline.cn/">TOEFL</a></li>
                    <li><a href="http://ielts.gmatonline.cn/">IELTS</a></li>
                    <li><a class="on" href="http://smartapply.gmatonline.cn /">留学</a></li>
                    <li>|</li>
                    <li><span>400-1816-180</span></li>
                    <li><a href="tencent://message/?uin=1746295647&amp;Site=www.cnclcy&amp;Menu=yes">在线咨询</a></li>
                </ul>
            </div>
            <div class="fl nav-de">互联网一站式留学申请平台</div>
            <div class="rightLogin">
                <?php
                if(!$userId) {
                    ?>
                    <!--未登录展示-->
                    <div class="rightLogin">
                        <div class="loginBefore">
                            <a href="http://login.gmatonline.cn/cn/index?source=3&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>"><input type="button" value="登陆" onclick="userLogin()"></a>
                            <a href="http://login.gmatonline.cn/cn/index?source=3&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>"><input type="button" value="注册" onclick="userRegister()"></a>
                        </div>
                    </div>
                    <?php
                }else {
                    ?>
                    <!--登陆之后展示-->
                    <div class="loginAfter">
                        <div class="whiteDiv"><img src="<?php echo $userData['image']?$userData['image']:'/cn/images/details_defaultImg.png'?>" alt="用户头像"></div>
                        <div class="leftFont">
                            <span><?php echo $userData['nickname']?$userData['nickname']:$userData['userName']?>（初来乍到）</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="clearB"></div>
                        <!--下拉-->
                        <div class="xiala-con">
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
            <div class="clearBr"></div>
        </div>
    </div>
    <div class="header">
        <div class="in_head">
            <div class="col-md-3">
                <a href="/"><img src="/cn/images/logo.png" alt="logo图标" width="185"/></a>
            </div>
            <div class="col-md-6">
                <div class="searchBox">
                    <div class="col-md-1">
                        <img src="/cn/images/search.png" alt="搜索图标" onclick="searchGoods()"/>
                    </div>
                    <div class="col-md-7">
                        <input class="goodsKeywords" type="text" placeholder="University of Rochester" onkeydown="javascript:searchs(event)" value="<?php echo  isset($_GET['content'])?$_GET['content']:''?>"/>
                    </div>
                    <div class="col-md-2 search_K">
                        <span id="searchHtml">搜学校</span>
                        <i class="fa fa-caret-down"></i>
                        <div class="sea_down">
                            <ul>
                                <li>搜产品</li>
                                <li>搜专业</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 font" onclick="searchGoods()">搜索</div>
                </div>
                <div class="clearfix"></div>
                <div class="sea_bofont">
                    英国留学 澳大利亚留学 美国留学 新西兰留学 加拿大留学 香港留学 新加坡留学
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-md-7 h_phone">
                    <img src="/cn/images/head_phone.png" alt="电话图标"/>
                    <span>400-1816-180</span>
                </div>
                <div class="col-md-5">
                    <div class="col-md-3 h_person">
                        <img src="/cn/images/head_person.png" alt="人人图标"/>
                    </div>
                    <div class="col-md-7">
                        <div class="consult"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3426496022&amp;site=qq&amp;menu=yes">在线咨询</a></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-----------------------导航------------------------------->
    <div id="navBox">
    <div class="nav nav_par">
        <ul class="ul_box">
            <li class="on">
                <a href="javascript:void(0);">留学服务分类 <i class="fa fa-caret-down"></i></a>
                <div class="first-down">
                    <ul>
                        <li><h4>留学考试</h4></li>
                        <li><a href="/cn/enact/gmat">GMAT</a></li>
                        <li><a href="/cn/toefldy">托福</a></li>
                        <li><a href="/course/category-164/type-0/page-1.html">雅思</a></li>
                        <li><h4>留学国家</h4></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-176/page-1.html">美国</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-157/page-1.html">英国</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-177/page-1.html">加拿大</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-158/page-1.html">澳大利亚</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-178/page-1.html">香港</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-179/page-1.html">法国</a></li>
                        <li><a href="/study-abroad/category-0/aim-0/country-232/page-1.html">新加坡</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="/">留学主页</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/index/home')){ ?> class="on" <?php } ?> ><a href="/cn/index/home">留学商城</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/enact/index')){ ?> class="on" <?php } ?> ><a href="/cn/enact/index">名校申请</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/enact/writ')){ ?> class="on" <?php } ?>><a href="/cn/enact/writ">文书神器</a></li>
            <li><a href="http://schools.smartapply.cn/assess.html">免费评估</a></li>
            <li><a href="http://schools.smartapply.cn/schools.html">海外院校库</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/ranking')){ ?> class="on" <?php } ?>><a href="/cn/ranking/293-308.html">大学排名</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/mall-two')){ ?> class="on" <?php } ?>><a href="/cn/mall-two">录取案例库</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/dynamic')){ ?> class="on" <?php } ?>><a href="/cn/dynamic">留学攻略</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/question')){ ?> class="on" <?php } ?>><a href="/cn/question"> 留学问答</a></li>
            <li <?php if(strstr($_SERVER['REQUEST_URI'],'/cn/consultant')){ ?> class="on" <?php } ?>><a href="/cn/consultant">留学顾问</a></li>
        </ul>
    </div>
</div>
    <!-------------------导航 end------------------------>
<?=$content?>
<!----------------------尾部----------------------------->
    <!--footer-->
    <footer>
        <div class="w12 tm" style="padding: 30px 0;margin-top: 20px;">
            <ul class="footer-list">
                <li><a href="javascript:void(0);">课程类型</a></li>
                <li><a href="http://www.gmatonline.cn/index.html">GMAT</a></li>
                <li><a href="http://www.toeflonline.cn/">TOEFL</a></li>
                <li><a href="http://ielts.gmatonline.cn/">IELTS</a></li>
                <li><a href="http://smartapply.gmatonline.cn /">留学</a></li>
            </ul>
            <ul class="footer-list">
                <li><a href="javascript:void(0);">题库</a></li>
                <li><a href="http://www.gmatonline.cn/question/stog8leetkey.html">PREP</a></li>
                <li><a href="http://www.gmatonline.cn/question/stog1leetkey.html">OG</a></li>
                <li><a href="http://www.toeflonline.cn/tpoExam.html">TPO</a></li>
                <li><a href="http://ielts.gmatonline.cn/">剑桥</a></li>
            </ul>
            <ul class="footer-list erm-3-wrap">
                <li><a href="javascript:void(0);">关注我们</a></li>
                <li>
                    <a href="#"><div class="ft-icon"><img src="/cn/images/icon-wx.png" alt=""></div>：雷哥GMAT</a>
                    <div class="erm-3"><img src="/cn/images/erm-6.jpg" alt=""></div>
                </li>
                <li>
                    <a href="#"><div class="ft-icon"><img src="/cn/images/icon-wx.png" alt=""></div>：雷哥托福</a>
                    <div class="erm-3"><img src="/cn/images/erm-7.jpg" alt=""></div>
                </li>
                <li>
                    <a href="#"><div class="ft-icon"><img src="/cn/images/icon-wx.png" alt=""></div>：雷哥雅思</a>
                    <div class="erm-3"><img src="/cn/images/erm-8.png" alt=""></div>
                </li>
                <li>
                    <a href="#"><div class="ft-icon"><img src="/cn/images/icon-wx.png" alt=""></div>：雷哥留学</a>
                    <div class="erm-3"><img src="/cn/images/erm-9.jpg" alt=""></div>
                </li>
            </ul>
            <div class="leige-tag inb">
                <div><img src="/cn/images/logo-2.png" alt=""></div>
                <div class="ft-tag">
                    <span><em class="point"></em>优质教学</span>
                    <span><em class="point"></em>海量题库</span>
                    <span><em class="point"></em>全方位服务</span>
                    <span><em class="point"></em>超值课程礼包</span>
                </div>
                <p class="ft-de">雷哥网  让你学的更好、效率更高、让你每天进步一点点</p>
            </div>
        </div>
        <div class="copyRight tm">
            ©2016 gmatonline.cn All Rights Reserved    京ICP备15001182号-1 京公网安备11010802017681
            <a href="http://www.gmatonline.cn/aboutUs/16.html#free_shengm">免责声明</a>
        </div>
    </footer>
<!----------------------尾部  end----------------------------->
    <script type="text/javascript">
        function searchGoods(){
            var content = $('.goodsKeywords').val();
            var type = $('#searchHtml').html();
            if(content == ''){
                alert('请输入关键词');return false;
            }
            if(type=='搜产品'){
                location.href = '/search/content-'+content+'/page-1.html'
            }else {
                location.href="http://schools.smartapply.cn/cn/index/select?"+type+"&keywords="+content;
            }
        }
        function searchs(e){
            if(e.keyCode==13){
                searchGoods();
            }
        }
        /**
         * 用户退出
         */
        function loginOut() {
            $.post('/cn/api/login-out', {}, function (re) {
                window.location.href = "/"
            }, 'json')
        }
    </script>
</body>
</html>