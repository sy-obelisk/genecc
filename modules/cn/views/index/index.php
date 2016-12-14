<script type="text/javascript" src="/cn/js/index.js"></script>
<link rel="stylesheet" href="/cn/css/index.css"/>

<div class="banner">
    <div class="bannerHd">
        <ul></ul>
    </div>
    <div class="bannerBd">
        <ul>
            <?php
            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '227,226']);
                foreach($data as $v) {
                    ?>
                    <li>
                        <a href="<?php echo $v['answer']?>" style="background: url('<?php echo $v['image']?>') center"></a>
                    </li>
                <?php
                }
            ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    jQuery(".banner").slide({titCell: ".bannerHd ul",mainCell:".bannerBd ul",autoPlay:true,mouseOverStop:false,effect:"leftLoop",autoPage: "<li></li>"});
</script>

<!----------------留学服务------------------>
<div class="studyAbroad">
    <h4>
        <p>出国留学</p>
<!--        <img src="/cn/images/index_titleIcon01.png" alt="标题英文图">-->
        <span>---自主选择留学定制服务，留学文书、网申、选校、实习应有尽有---</span>
    </h4>
    <div class="toggleStudy">
        <div class="toggleHd hd">
            <ul>
                <li>留学定制</li>
                <li>文书服务</li>
                <li>网申服务</li>
                <li>选校服务</li>

            </ul>
        </div>
        <div class="toggleBd">
            <div class="inToggle">
                <a href="javascript:void(0);" class="prevS">&lt;</a>

                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => 152,'pageSize' => 4]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/goods/<?php echo $v['id']?>.html">
                                <div class="pictureBig">
                                    <div class="picture">
                                        <img src="<?php echo $v['image']?>" alt="图片"/>
                                        <!--遮罩-->
                                        <div class="pic-mask">
                                            <span></span>
                                            <img src="/cn/images/index_searchIcon.png" alt="搜索图标">
                                        </div>
                                    </div>
                                </div>
                                <h4><?php echo $v['name']?></h4>
                                <ol>
                                    <li><?php echo $v['answer']?></li>
                                    <li><input type="button" value="￥<?php echo $v['price']?>"/></li>
                                </ol>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <a href="javascript:void(0);" class="nextS">&gt;</a>
            </div>
            <div class="inToggle">
                <a href="javascript:void(0);" class="prevS">&lt;</a>
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => 223,'pageSize' => 4]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/goods/<?php echo $v['id']?>.html">
                                <div class="pictureBig">
                                    <div class="picture">
                                        <img src="<?php echo $v['image']?>" alt="图片"/>
                                        <!--遮罩-->
                                        <div class="pic-mask">
                                            <span></span>
                                            <img src="/cn/images/index_searchIcon.png" alt="搜索图标"/>
                                        </div>
                                    </div>
                                </div>
                                <h4><?php echo $v['name']?></h4>
                                <ol>
                                    <li><?php echo $v['answer']?></li>
                                    <li><input type="button" value="￥<?php echo $v['price']?>"/></li>
                                </ol>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <a href="javascript:void(0);" class="nextS">&gt;</a>
            </div>
            <div class="inToggle">
                <a href="javascript:void(0);" class="prevS">&lt;</a>
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => 220,'pageSize' => 4]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/goods/<?php echo $v['id']?>.html">
                                <div class="pictureBig">
                                    <div class="picture">
                                        <img src="<?php echo $v['image']?>" alt="图片"/>
                                        <!--遮罩-->
                                        <div class="pic-mask">
                                            <span></span>
                                            <img src="/cn/images/index_searchIcon.png" alt="搜索图标">
                                        </div>
                                    </div>
                                </div>
                                <h4><?php echo $v['name']?></h4>
                                <ol>
                                    <li><?php echo $v['answer']?></li>
                                    <li><input type="button" value="￥<?php echo $v['price']?>"/></li>
                                </ol>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <a href="javascript:void(0);" class="nextS">&gt;</a>
            </div>
            <div class="inToggle">
                <a href="javascript:void(0);" class="prevS">&lt;</a>
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => 153,'pageSize' => 4]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/goods/<?php echo $v['id']?>.html">
                                <div class="pictureBig">
                                    <div class="picture">
                                        <img src="<?php echo $v['image']?>" alt="图片"/>
                                        <!--遮罩-->
                                        <div class="pic-mask">
                                            <span></span>
                                            <img src="/cn/images/index_searchIcon.png" alt="搜索图标">
                                        </div>
                                    </div>
                                </div>
                                <h4><?php echo $v['name']?></h4>
                                <ol>
                                    <li><?php echo $v['answer']?></li>
                                    <li><input type="button" value="￥<?php echo $v['price']?>"/></li>
                                </ol>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <a href="javascript:void(0);" class="nextS">&gt;</a>
            </div>
        </div>
    </div>

</div>
<!----------------在线课程--------------------->
<div class="onlineTest">
    <h4>
        <span>留学考试</span><br>
        <b>---在线选课，GMATONLINE网络课程、TOEFLONLINE网络课程---</b>
    </h4>
    <div class="onlineContent">
        <div class="online-left onlineMr">
            <div class="leftT-blue">GMAT</div>
            <a href="/course/category-162/type-0/page-1.html" class="rightMore">MORE+</a>
            <div class="onlineUl">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => '162,155','pageSize' => 5]);
                    foreach($data as $k=>$v) {
                        ?>
                        <li>
                            <b></b>
                            <a href="/goods/<?php echo $v['id']?>.html" class="nameTitle">【直播】<?php echo $v['name']?></a>
                            <a href="/goods/<?php echo $v['id']?>.html" class="aBtn">立即报名&gt;</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="online-left">
            <div class="leftT-blue">托福</div>
            <a href="/course/category-163/type-0/page-1.html" class="rightMore">MORE+</a>
            <div class="onlineUl">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'price,answer','category' => '163,155','pageSize' => 5]);
                    foreach($data as $k=>$v) {
                    ?>
                    <li>
                         <b></b>
                        <a href="/goods/<?php echo $v['id']?>.html" class="nameTitle"><?php echo $v['name']?></a>
                        <a href="/goods/<?php echo $v['id']?>.html" class="aBtn">立即报名&gt;</a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>

</div>
<!------------------课后服务---------------->
<div class="afterService">
    <h2>
        <span>增值服务</span><br>
<!--        <img src="/cn/images/index_titleIcon02.png" alt="课后服务图片"/>-->
        <b>---更多课后贴心服务，解决课后疑难杂症---</b>
    </h2>
    <div class="afterSlide">
        <div class="afterHd hd">
            <span class="small-diamonds pos01"></span>
            <span class="small-diamonds pos02"></span>
            <span class="small-diamonds pos03"></span>
            <span class="small-diamonds pos04"></span>
            <ul>
                <?php
                $category = \app\modules\cn\models\Category::find()->where("pid=165")->all();
                foreach($category as $v) {
                    ?>
                    <li><?php echo $v['name']?></li>
                <?php }?>

            </ul>
        </div>
        <div class="afterBd">
            <?php
            foreach($category as $v) {
                ?>
                <ul>
                    <li>
                        <div class="afterS-left">
                            <h4><?php echo $v['name']?></h4>

                            <div class="afterS-lCon">
                                <?php echo $v['description']?>
                            </div>
                            <a href="/after-class/category-<?php echo $v['id']?>/page-1.html">点击查看 &gt;</a>
                        </div>
                    </li>
                </ul>
            <?php
            }
            ?>

        </div>
    </div>
    <div style="clear: both"></div>
</div>
<!-------------------优惠礼品----------------------->
<div class="wishList">
    <div class="inWish">
        <h2>
            <span>留学图书</span><br>
<!--            <img src="/cn/images/index_titleIcon03.png" alt="标题英文图片"/>-->
            <b>---SmartApply留学专家精心编排，名校学员鼎力推荐---</b>
        </h2>
        <ul>
            <?php
            $category = \app\modules\cn\models\Category::find()->where('pid=170')->limit(3)->all();
                foreach($category as $val) {
                    ?>
                    <li>
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0', 'fields' => 'alternatives,price,answer', 'category' => "170,{$val['id']}", 'pageSize' => 4]);
                        ?>
                        <h4>
                            <span><?php echo $val['name']?></span>
                            <a href="/voucher/category-<?php echo $val['id']?>/page-1.html">MORE+</a>
                        </h4>
                        <?php
                        foreach ($data as $v) {
                            ?>
                            <div class="wish-left">
                                <img src="<?php echo $v['image'] ?>" alt="详情图片"/>
                            </div>
                            <div class="wish-right">
                                <h5><?php echo $v['name'] ?></h5>
                                <span><?php echo $v['alternatives'] ?>人已兑换</span>
                                <b><span><?php echo $v['price'] * 100 ?></span>积分</b>
                                <a href="/goods/<?php echo $v['id'] ?>.html">去看看 &gt;</a>
                            </div>
                            <?php
                            break;
                        }
                        unset($data[0]);
                        ?>
                        <div class="clearDiv"></div>
                        <div class="wishBot">
                            <ul>
                                <?php
                                foreach ($data as $v) {
                                    ?>
                                    <li>
                                        <span><?php echo $v['name'] ?>  <?php echo $v['price'] * 100 ?>积分</span>
                                        <a href="/goods/<?php echo $v['id'] ?>.html">立即兑换</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                <?php
                }
            ?>

        </ul>
    </div>
</div>
