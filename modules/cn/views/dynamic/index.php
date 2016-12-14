
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/StudyingDynamic.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="commonLeft">
                <!--------------------幻灯片start----------------------->
                <div class="bs-example">
                    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
<!--                        <ol class="carousel-indicators">-->
<!--                            <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>-->
<!--                            <li data-target="#carousel-example-captions" data-slide-to="1"></li>-->
<!--                            <li data-target="#carousel-example-captions" data-slide-to="2"></li>-->
<!--                        </ol>-->
                        <div class="carousel-inner">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '310','page'=>1,'pageSize' => 3]);
                            foreach($data as $key=>$v) {
                                if ($key == 0) {
                                    ?>
                                    <div class="item active">
                                        <img data-src="holder.js/900x500/auto/index.htm#777:#777"
                                             src="<?php echo $v['image'] ?>"
                                             alt="First slide image">

                                        <div class="carousel-caption">
                                            <h3><?php echo $v['name'] ?></h3>

                                            <p><?php echo $v['title'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }else{ ?>
                                    <div class="item">
                                        <img data-src="holder.js/900x500/auto/index.htm#777:#777"
                                             src="<?php echo $v['image'] ?>"
                                             alt="First slide image">

                                        <div class="carousel-caption">
                                            <h3><?php echo $v['name'] ?></h3>

                                            <p><?php echo $v['title'] ?></p>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
<!--                            <div class="item">-->
<!--                                <img data-src="holder.js/900x500/auto/index.htm#666:#666" src="/cn/images/TFindex_lunbo4.png"-->
<!--                                     alt="Second slide image">-->
<!--                                <div class="carousel-caption">-->
<!--                                    <h3>Second slide label</h3>-->
<!--                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="item">-->
<!--                                <img data-src="holder.js/900x500/auto/index.htm#777:#777"  src="/cn/images/TFindex_lunbo1.png"-->
<!--                                     alt="First slide image">-->
<!--                                <div class="carousel-caption">-->
<!--                                    <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>-->
<!--                                    <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">-->
<!--                            <span class="glyphicon glyphicon-chevron-left"></span>-->
<!--                        </a>-->
<!--                        <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">-->
<!--                            <span class="glyphicon glyphicon-chevron-right"></span>-->
<!--                        </a>-->
                    </div>
                </div>
                <!--------------------幻灯片end----------------------->
                <!------今日头条------->
                <div class="HeadlinesToday">
                    <div class="col-md-6 TodayBorder">
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer,article','category' => '241','order'=>'article DESC','page'=>1,'pageSize' => 1]);
                        foreach($data as $v) {
                            ?>
                            <div class="col-md-4">
                                <div class="todayImg"><img src="<?php echo $v['image']?>" alt="今日头条图片"></div>
                            </div>
                            <div class="col-md-8 headlines">
                                <h4>今日头条</h4>

                                <span><?php echo $v['answer']?></span><a href="/cn/dynamic/body/241.html">[更多]</a>
                            </div>
                            <div style="clear: both"></div>
                            <a href="/cn/dynamic/detail/241-<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-6 todayInfo">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer,article','category' => '241','order'=>'article DESC','page'=>1,'pageSize' => 5]);
                            foreach($data as $key=>$v) {
                                if($key > 0) {
                                    ?>
                                    <li>
                                        <a href="/cn/dynamic/detail/241-<?php echo $v['id'] ?>.html"><?php echo $v['title'] ?></a>
                                        <span><?php echo $v['article'] ?></span>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
<!--                            <li>-->
<!--                                <a href="#">· 我的好文书留学“黑科技”来袭，映客直播间进入攻略...</a>-->
<!--                                <span>2016-06-14</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">· 我的好文书留学“黑科技”来袭，映客直播间进入攻略...</a>-->
<!--                                <span>2016-06-14</span>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">· 我的好文书留学“黑科技”来袭，映客直播间进入攻略...</a>-->
<!--                                <span>2016-06-14</span>-->
<!--                            </li>-->
                        </ul>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <!--------留学手续---------->
                <!--注：Hd里面有几个li，Bd里面就有几个ul；由于ul太多，有些我就没有复制了-->
                <div class="formalities formalSlide01">
                    <div class="formalHd">
                        <h4><a href="/cn/dynamic/body/242.html">留学手续</a></h4>
                        <p><a href="/cn/dynamic/body/242.html">More</a></p>
<!--                        <ul>-->
<!--                            <li><a href="#">留学流程</a></li>-->
<!--                            <li><a href="#">留学文书</a></li>-->
<!--                            <li><a href="#">留学简历</a></li>-->
<!--                            <li><a href="#">留学推荐信</a></li>-->
<!--                            <li><a href="#">留学PS</a></li>-->
<!--                            <li><a href="#">留学Eassy</a></li>-->
<!--                            <li><a href="#">留学申请</a></li>-->
<!--                            <li><a href="#">留学面授</a></li>-->
<!--                            <li><a href="#">留学签证</a></li>-->
<!--                        </ul>-->
                    </div>
                    <div class="formalBd">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '242','page'=>1,'pageSize' => 10]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <a href="/cn/dynamic/detail/242-<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                                    <span><?php echo $v['createTime']?></span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(".formalSlide01").slide({titCell:".formalHd li",mainCell:".formalBd",trigger:"mouseover"});
                </script>

                <!--------留学考试---------->
                <div class="formalities formalSlide02">
                <div class="formalHd">
                    <h4><a href="/cn/dynamic/body/243.html">留学考试</a></h4>
                    <p><a href="/cn/dynamic/body/243.html">More</a></p>
                    <ul>
                        <?php
                        foreach($ks_class as $v){ ?>
                            <li><a href="#"><?php echo $v['name']?></a></li>
                           <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="formalBd">
                    <?php
                    foreach($ks_class as $v){ ?>
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => $v['id'],'page'=>1,'pageSize' => 10]);
                    foreach($data as $va) {
                        ?>
                        <li>
                            <a href="/cn/dynamic/detail/243-<?php echo $va['id']?>.html"><?php echo $va['title']?></a>
                            <span><?php echo $va['createTime']?></span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                    <?php }?>
                </div>
                </div>
                <script type="text/javascript">
                    jQuery(".formalSlide02").slide({titCell:".formalHd li",mainCell:".formalBd",trigger:"mouseover"});
                </script>

                <!--------留学国家---------->
                <div class="formalities formalSlide03">
                    <div class="formalHd">
                        <h4><a href="/cn/dynamic/body/244.html">留学国家</a></h4>
                        <p><a href="/cn/dynamic/body/244.html">More</a></p>
<!--                        <ul>-->
<!--                            <li><a href="#">美国</a></li>-->
<!--                            <li><a href="#">英国</a></li>-->
<!--                            <li><a href="#">香港</a></li>-->
<!--                            <li><a href="#">澳大利亚</a></li>-->
<!--                            <li><a href="#">新加坡</a></li>-->
<!--                            <li><a href="#">亚洲国家</a></li>-->
<!--                            <li><a href="#">欧洲国家</a></li>-->
<!--                        </ul>-->
                    </div>
                    <div class="formalBd">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '244','page'=>1,'pageSize' => 10]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <a href="/cn/dynamic/detail/244-<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                                    <span><?php echo $v['createTime']?></span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(".formalSlide03").slide({titCell:".formalHd li",mainCell:".formalBd",trigger:"mouseover"});
                </script>

                <!--------留学规划---------->
                <div class="formalities formalSlide04">
                    <div class="formalHd">
                        <h4><a href="/cn/dynamic/body/245.html">留学规划</a></h4>
                        <p><a href="/cn/dynamic/body/245.html">More</a></p>
<!--                        <ul>-->
<!--                            <li><a href="#">高中留学</a></li>-->
<!--                            <li><a href="#">本科转学</a></li>-->
<!--                            <li><a href="#">本科留学</a></li>-->
<!--                            <li><a href="#">硕士留学</a></li>-->
<!--                            <li><a href="#">博士留学</a></li>-->
<!--                        </ul>-->
                    </div>
                    <div class="formalBd">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '245','page'=>1,'pageSize' => 10]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <a href="/cn/dynamic/detail/245-<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                                    <span><?php echo $v['createTime']?></span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(".formalSlide04").slide({titCell:".formalHd li",mainCell:".formalBd",trigger:"mouseover"});
                </script>

            </div>
        </div>
        </div>
        <div class="col-md-3">
            <div class="commonRight">
                <div class="TopList">
                     <div class="common-title">
                         热销排行榜
                     </div>
                    <div class="ProductList">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','category' => '223','pageSize' => 10]);
                            foreach($data as $key=>$v){?>
                                <li>
                                    <div class="numDiv"><?php echo $key+1;?></div>
                                    <a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                               <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="common-title">
                        你可能感兴趣的学校
                    </div>
                    <div class="interestSchool">
                        <ul>
                            <?php foreach($ranking as $key=>$v) {
                                if ($key < 8) {
                                    ?>
                                    <li>
                                        <div class="numDiv"><?php echo $key + 1; ?></div>
                                        <a href="http://schools.smartapply.cn/schools/<?php echo $v['id'] ?>.html"><?php echo $v['name']; ?></a>
                                        <span>排名<?php echo $v['article']; ?></span>

                                        <p>
                                            <img src="/cn/images/studying_person.png" alt="人人图标"/>
                                            <?php echo $v['viewCount'] ?>人查看
                                        </p>
                                    </li>
                                    <?php
                                }
                            }
                            ?>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearMB"></div>
</div>
</div>