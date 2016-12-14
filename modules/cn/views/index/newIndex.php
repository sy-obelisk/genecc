
    <link rel="stylesheet" href="/cn/css/newIndex.css"/>
    <link rel="stylesheet" href="/cn/css/jquery.zySlide.css"/>
    <script type="text/javascript" src="/cn/js/jquery.zySlide.js"></script>
    <script type="text/javascript" src="/cn/js/newIndex.js"></script>
</head>
<body>
    <div class="top_banner">
        <div class="in_banner">
            <div class="col-md-3">
                <div class="left_mask">
                    <div class="l_mHd">
                        <ul>
                            <li>留学方案</li>
                            <li>背景提升</li>
                            <li>备考指南</li>
                            <li>选校指南</li>
                        </ul>
                    </div>
                    <div class="l_mBd">
                        <ul>
                            <li>
                                <form action="/cn/index/programme" method="post">
                                <div class="first_show">
                                    <p>轻松解决你的选校麻烦</p>
                                    <div class="selectBox">
                                        <ul>
                                            <li>
                                                <input type="text" name="user_name" placeholder="姓名"/>
                                                <input type="text" name="user_phone" placeholder="联系电话"/>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <b>想去的国家</b>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <input type="hidden" name="country">
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                        <?php
                                                        $country = \app\modules\cn\models\Category::find()->where("pid=156")->orderBy('sort DESC')->all();
                                                        foreach($country as $v) {
                                                        ?>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);"><?php echo $v['name']?></a>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <b>计划出国时间</b>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <input type="hidden" name="pan_time">
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">2016.11.11</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">2016.11.12</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">2016.11.13</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">2016.11.14</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <b>目前就读年级</b>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <input type="hidden" name="grade">
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">大一</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">大二</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">大三</a>
                                                        </li>
                                                        <li role="presentation" class="divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0);">研究生</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <input type="submit" value="免费获取留学方案"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(".in_banner").slide({titCell:".l_mHd li",mainCell:".l_mBd",trigger:"click"});
                </script>
            </div>
            <div class="col-md-9">
                <div class="right_mask">
                    <img src="/cn/images/index_font.png" alt="文字图标"/>
                    <div class="bot_mask">
                        <p>雷哥网留学服务流程</p>
                        <ul>
                            <li>
                                <div class="grey_circle">
                                    <img src="/cn/images/index_opIcon01.png" alt="图片"/>
                                    <p>免费获取<br>留学方案</p>
                                </div>
                            </li>
                            <li>
                                <div class="grey_jian">
                                    <img src="/cn/images/index_opjian.png" alt="图片"/>
                                </div>
                            </li>
                            <li>
                                <div class="grey_circle">
                                    <img src="/cn/images/index_opicon02.png" alt="图片"/>
                                    <p>专业顾问<br>六位一体服务</p>
                                </div>
                            </li>
                            <li>
                                <div class="grey_jian">
                                    <img src="/cn/images/index_opjian.png" alt="图片"/>
                                </div>
                            </li>
                            <li>
                                <div class="grey_circle">
                                    <img src="/cn/images/index_opicon03.png" alt="图片"/>
                                    <p>提交申请<br>获得offer</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!--留学精选产品-->
    <div class="common_title">
        <div class="in_common">
            <img src="/cn/images/index_titleImg01.png" alt="标题图"/>
            <span>留学精选产品</span>
            <img src="/cn/images/product_xiexian.png" alt="标题线" class="xian"/>
            <b>Selected Products</b>
            <a href="/study-abroad/category-0/aim-0/country-0/page-1.html">更多 <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    <div class="product_banner">
        <div class="product_bHd">
            <a href="javascript:void(0);" class="prev">
                <img src="/cn/images/index_leftControl.png" alt="箭头图标">
            </a>
            <a href="javascript:void(0);" class="next">
                <img src="/cn/images/index_rightControl.png" alt="箭头图标">
            </a>
        </div>
        <div class="product_bBd">
            <ul>
                <?php
                $country = \app\modules\cn\models\Category::find()->where("pid=156")->orderBy('sort DESC')->all();
                foreach($country as $key=>$v) {
                    ?>
<!--                    <li data-value="--><?php //echo $v['id']?><!--" class="--><?php //echo isset($_GET['country'])&&strstr($_GET['country'],"{$v['id']}")?'on':''?><!-- country"></li>-->
                    <li  data-value="<?php echo $v['id']?>" class="<?php echo isset($_GET['country'])&&strstr($_GET['country'],"{$v['id']}")?'on':''?> country">
                        <div class="col-md-3">
                            <div class="writeBlack">
                                <a href="/study-abroad/category-0/aim-0/country-<?php echo $v['id']?>/page-1.html" class="cou_img"><img src="/cn/images/index_country0<?php echo $key+1?>.png" alt="国家图片"></a>
                                <p><?php echo $v['name']?>留学</p>
                                <a href="/study-abroad/category-0/aim-0/country-<?php echo $v['id']?>/page-1.html" class="btnblue">相关产品</a>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(".product_banner").slide({titCell:".product_bHd li",mainCell:".product_bBd ul",vis:4,effect:"leftLoop",scroll:4,autoPage:true});
    </script>
    <!--院校库-->
    <div class="common_title">
        <div class="in_common">
            <img src="/cn/images/index_titleImg02.png" alt="标题图"/>
            <span>院校库</span>
            <img src="/cn/images/product_xiexian.png" alt="标题线" class="xian"/>
            <b>College Library</b>
            <a href="http://schools.smartapply.cn">更多 <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    <div class="three_plate">
        <div class="col-md-4">
            <div class="school_search">
                <img src="/cn/images/index_blueJian.png" alt="蓝色箭头图标"/>
                <span>学校搜索</span>
                <div class="right_search">
                    <div class="col-md-10">
                        <div class="col-md-2">
                            <img src="/cn/images/index_search.png" alt="search">
                            <span style="display: none" id="type">搜学校</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="keyword" placeholder="搜索学校"/>
                        </div>
                    </div>
                    <div class="col-md-2 se_blue" onclick="select()">搜索</div>
                </div>
            </div>
            <div class="search_bot">
                <a href="http://schools.smartapply.cn/schools.html">
                  <img src="/cn/images/index_lbaner.png" alt="图片"/>
                </a>
                <div class="sea_country">
                    <ul>
                        <?php foreach($schoolsc as $c){ ?>
                            <li><a href="http://schools.smartapply.cn/cn/index/index?country=<?php echo $c['id']?>&rank=&degree=&major=&page=1"><?php echo $c['name']?></a></li>
                            <?php
                        }?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function select(){
                var type = $('#type').html();
                var keyword = $('#keyword').val();
                if(keyword == ''){
                    alert('请输入关键字');
                }else{
                    location.href="http://schools.smartapply.cn/cn/index/select?type="+type+"&keywords="+keyword;
                }
            }
            //enter键搜索
        </script>
        <div class="col-md-4">
            <div class="hotSchool">
                <div class="hot_title">
                    <img src="/cn/images/index_blueJian.png" alt="蓝色箭头图标"/>
                    <span>热门学校</span>
                    <a href="http://schools.smartapply.cn">更多 <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="school_icon">
                    <?php foreach($schools as $key=>$v){
                        if($key > 8){break;}
                        ?>
                        <div class="col-md-4">
                            <a href="http://schools.smartapply.cn/schools/<?php echo $v['id']?>.html ">
                                <div class="sch_img">
                                    <img src="http://schools.smartapply.cn<?php echo $v['image'];?>" alt="图片"/>
                                </div>
                                <p><?php echo $v['name'];?></p>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hot_title">
                <img src="/cn/images/index_blueJian.png" alt="蓝色箭头图标"/>
                <span>大学排名</span>
                <a href="/cn/ranking">更多 <i class="fa fa-angle-right"></i></a>
            </div>
            <div class="college_bot">
                <div class="in_college">
                    <div class="col-topImg">
                        <img src="/cn/images/index_rbanner.jpg" alt="大学排名banner"/>
                    </div>
                    <ul>
                        <?php
                        $University = \app\modules\cn\models\Category::find()->where("pid=292")->all();
                        foreach($University as $v) {
                            ?>
                            <li>
                                <a href="/cn/ranking/<?php echo $v['id']?>-<?php echo isset($_GET['year'])?$_GET['year']:0?>.html">
                                    <img src="/cn/images/index_blueD.png" alt="圆点图标"/>
                                    <span><?php echo $v['name']?></span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<!--留学精选产品-->
<div class="common_title">
    <div class="in_common">
        <img src="/cn/images/index_titleImg03.png" alt="标题图"/>
        <span>成功案例</span>
        <img src="/cn/images/product_xiexian.png" alt="标题线" class="xian"/>
        <b>SUCCESSFUL CASES</b>
        <a href="/cn/mall-two">更多 <i class="fa fa-angle-right"></i></a>
    </div>
</div>
<div id="Slide1" class="zy-Slide">
    <!--prev:元素中的文本通常会保留空格和换行符。而文本也会呈现为等宽字体。-->
    <section><img src="/cn/images/index_leftControl.png" alt="上一张"></section>
    <section><img src="/cn/images/index_rightControl.png" alt="下一张"></section>
    <ul>
        <!--alt + shift : 可以创建一个矩形选择区域-->
        <?php
        $data = \app\modules\cn\models\Content::getClass(['fields' => 'cnName,problemComplement,originalPrice','category' => '281','page'=>1,'pageSize' => 9]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="circle_h">
                    <a href="/cn/mall-two/281-<?php echo $v['id']?>.html">
                        <img src="<?php echo $v['image']?>" alt="学生头像"/>
                    </a>
                </div>
                <h4><a href="/cn/mall-two/281-<?php echo $v['id']?>.html"><?php echo $v['cnName']?></a></h4>

                <p>录取院校：<?php echo $v['problemComplement']?></p>

                <div class="stu_info">
                    <?php echo $v['originalPrice']?>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<div class="advertisement">
    <a href="http://schools.smartapply.cn/schools.html">
        <img src="/cn/images/index_guangg.png" alt="广告图">
    </a>
</div>
<!--留学咨询产品-->
<div class="common_title">
    <div class="in_common">
        <img src="/cn/images/index_titleImg04.png" alt="标题图"/>
        <span>留学资讯</span>
        <img src="/cn/images/product_xiexian.png" alt="标题线" class="xian"/>
        <b>STUDY ABROAD INFORMATION</b>
        <a href="#">更多 <i class="fa fa-angle-right"></i></a>
    </div>
</div>
<div class="information">
    <div class="col-md-4">
        <div class="greyBox">
            <div class="blueTitle">留学资讯</div>
            <ul>
                <?php
                $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '242','page'=>1,'pageSize' => 4]);
                foreach($data as $key=>$v) {
                    ?>
                    <li>
                        <div class="col-md-4">
                            <div class="img_thub"><img src="/cn/images/index_study0<?php echo $key+1;?>.png" alt="图片"></div>
                        </div>
                        <div class="col-md-8">
                            <h4><a href="/cn/dynamic/detail/242-<?php echo $v['id']?>.html"><?php echo $v['title']?></a></h4>
                            <span><?php echo $v['createTime']?>发布</span>
                            <p><?php echo $v['answer']?></p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <a href="/cn/dynamic/body/242.html" class="seeMore">查看更多 <i class="fa fa-angle-right"></i></a>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="greyBox02 mcenter">
            <div class="blueTitle">推荐院校</div>
            <div class="school_data">
                <div class="col-md-6 l_img">
                    <img src="/cn/images/index_study04.png" alt="图片">
                </div>
                <div class="col-md-6">
                    <ul>
                        <?php foreach($schools as $key=>$v){
                            if($key > 5){break;}
                            ?>
                            <li>
                                <a href="http://schools.smartapply.cn/schools/<?php echo $v['id']?>.html"><?php echo $v['name'];?></a>
                                <span><?php echo isset($v['cnName'])?$v['cnName']:''?></span>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <a href="http://schools.smartapply.cn" class="seeMore">查看更多 <i class="fa fa-angle-right"></i></a>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="greyBox02 fr">
            <div class="blueTitle">热门专题</div>
            <div class="school_data spe_sch">
                <div class="col-md-6 l_img">
                    <img src="/cn/images/index_study05.png" alt="图片">
                </div>
                <div class="col-md-6">
                    <ul>
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer,alternatives','category' => '241','page'=>1,'pageSize' => 4]);
                        foreach($data as $v) {
                            ?>
                            <li>
                                <p><a href="/cn/dynamic/detail/241-<?php echo $v['id']?>.html"><?php echo $v['title']?></a></p>
                                <span><?php echo $v['answer']?></span>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <a href="/cn/dynamic" class="seeMore">查看更多 <i class="fa fa-angle-right"></i></a>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="last_bott">
    <ul>
        <li>
            <img src="/cn/images/index_stub01.png" alt="图标"/>
            <p>申请程序标准</p>
            <span>均为海外热门名校</span>
        </li>
        <li>
            <img src="/cn/images/index_stub02.png" alt="图标"/>
            <p>服务流程透明</p>
            <span>进度网上随时可查</span>
        </li>
        <li>
            <img src="/cn/images/index_stub03.png" alt="图标"/>
            <p>一次性收费</p>
            <span>不加收排名等其他费用</span>
        </li>
        <li>
            <img src="/cn/images/index_stub04.png" alt="图标"/>
            <p>申请流程高效</p>
            <span>4-8周即可获得OFFER</span>
        </li>
        <li>
            <img src="/cn/images/index_stub05.png" alt="图标"/>
            <p>学校录取率高</p>
            <span>99%以上成功率</span>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>


</body>
</html>