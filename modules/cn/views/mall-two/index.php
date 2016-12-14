
    <link rel="stylesheet" href="/cn/css/caseLib-public.css"/>
    <link rel="stylesheet" href="/cn/css/caseLibrary.css"/>

<!------------另一种导航------------------>
<div style="clear: both"></div>

<div class="container">
    <div class="row">
<!--        <div class="caseNav">-->
<!--            <ul>-->
<!--                <li class="on">-->
<!--                    <a href="/cn/mall-two"><span>留学案例</span></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="/cn/mall-two/gmat"><span>GMAT案例</span></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="/cn/mall-two/toefl"><span>托福案例</span></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="/cn/mall-two/offer"><span>名校offer</span></a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <div class="caseSearch">-->
<!--                <input type="text"/>-->
<!--                <input type="button" value="搜索"/>-->
<!--            </div>-->
<!--            <div style="clear: both"></div>-->
<!--        </div>-->
        <!--        轮播图-->
        <div class="caseSlide">
            <div class="caseHd"><ul></ul></div>
            <div class="caseBd">
                <ul>
                    <li>
                        <a href="/cn/mall-two/282-648.html">
                            <img src="/cn/images/case_banner01.png" alt="banner图"/>
                        </a>
                    </li>
                    <li>
                        <a href="/cn/mall-two/283-653.html">
                            <img src="/cn/images/case_banner02.png" alt="banner图"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".caseSlide").slide({titCell:".caseHd ul",mainCell:".caseBd ul",effect:"leftLoop",autoPlay:true,autoPage:"<li>$</li>"});
        </script>
        <!--        轮播图 end-->
        <div class="col-md-9 diffSix">
            <!--------------------幻灯片start----------------------->
            <div class="bs-example">
                <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '309','page'=>1,'pageSize' => 3]);
                        foreach($data as $key=>$v) {
                            if ($key == 0) {
                                ?>
                                <div class="item active">
                                    <img src="<?php echo $v['image'] ?>"
                                         alt="First slide image">

                                    <div class="carousel-caption">
                                        <h3><?php echo $v['name'] ?></h3>

                                        <p><?php echo $v['title'] ?></p>
                                    </div>
                                </div>
                                <?php
                            }else{ ?>
                                <div class="item">
                                    <img src="<?php echo $v['image'] ?>"
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
<!--                        <div class="item active">-->
<!--                            <img  src="/cn/images/TFindex_lunbo1.png"-->
<!--                                  alt="First slide image">-->
<!--                            <div class="carousel-caption">-->
<!--                                <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>-->
<!--                                <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item">-->
<!--                            <img src="/cn/images/TFindex_lunbo4.png"-->
<!--                                 alt="Second slide image">-->
<!--                            <div class="carousel-caption">-->
<!--                                <h3>Second slide label</h3>-->
<!--                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item">-->
<!--                            <img  src="/cn/images/TFindex_lunbo1.png"-->
<!--                                  alt="First slide image">-->
<!--                            <div class="carousel-caption">-->
<!--                                <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>-->
<!--                                <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">-->
<!--                        <span class="glyphicon glyphicon-chevron-left"></span>-->
<!--                    </a>-->
<!--                    <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">-->
<!--                        <span class="glyphicon glyphicon-chevron-right"></span>-->
<!--                    </a>-->
                </div>
            </div>
            <!--------------------幻灯片end----------------------->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">热门案例<a href="/cn/mall-two/list-281.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '281','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                            ?>
                            <div class="bookB">
                                <img src="<?php echo $v['image']?>" alt="图片">
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '281','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/281-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
            <!--美国成功案例-->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">美国留学成功案例<a href="/cn/mall-two/list-282.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '282','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <div class="bookB">
                                    <img src="<?php echo $v['image']?>" alt="图片">
                                </div>
                            <?php }?>
<!--                            <p>杜克早录录取的卡夫卡</p>-->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '282','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/282-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
            <!--英国成功案例-->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">英国留学成功案例<a href="/cn/mall-two/list-283.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '283','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                            ?>
                            <div class="bookB">
                                <img src="<?php echo $v['image']?>" alt="图片">
                            </div>
                                <?php
                            }
                            ?>
<!--                            <p>杜克早录录取的卡夫卡</p>-->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '283','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/283-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
            <!--澳洲成功案例-->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">澳洲加拿大留学成功案例<a href="/cn/mall-two/list-284.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '284','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                            ?>
                            <div class="bookB">
                                <img src="<?php echo $v['image']?>" alt="图片">
                            </div>
                                <?php
                            }
                            ?>
<!--                            <p>杜克早录录取的卡夫卡</p>-->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '284','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/284-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
            <!--亚洲成功案例-->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">新加坡香港留学成功案例<a href="/cn/mall-two/list-285.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '285','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <div class="bookB">
                                    <img src="<?php echo $v['image']?>" alt="图片">
                                </div>
                            <?php }?>
<!--                            <p>杜克早录录取的卡夫卡</p>-->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '285','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/285-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
            <!--欧洲成功案例-->
            <div class="col-md-6">
                <div class="caseBorder">
                    <div class="purple-title">欧洲留学成功案例<a href="/cn/mall-two/list-286.html">MORE</a></div>
                    <div class="col-md-3">
                        <div class="book-left">
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '286','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <div class="bookB">
                                    <img src="<?php echo $v['image']?>" alt="图片">
                                </div>
                            <?php }?>
<!--                            <p>杜克早录录取的卡夫卡</p>-->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="book-right">
                            <ul>
                                <?php
                                $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '286','page'=>1,'pageSize' => 6]);
                                foreach($data as $v) {
                                    ?>
                                    <li>
                                        <a href="/cn/mall-two/286-<?php echo $v['id']?>.html">●<?php echo $v['name']?></a>
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
        </div>
        </div>
        <div class="col-md-3">
            <div class="rightEnroll">
                 <div class="newEnroll">最新录取</div>
                 <div class="newData">
                     <table>
                         <tr>
                             <th>姓名</th>
                             <th>录取学校</th>
                             <th>录取专业</th>
                         </tr>
                         <?php
                         $data = \app\modules\cn\models\Content::getClass(['fields' => 'cnName,article,problemComplement','category' => '281','page'=>1,'pageSize' => 10]);
                         foreach($data as $v) {
                         ?>
                         <tr>
                             <td><?php echo $v['cnName']?></td>
                             <td><?php echo $v['problemComplement']?></td>
                             <td><?php echo $v['article']?></td>
                         </tr>
                         <?php }?>
                     </table>
                 </div>
            </div>
        </div>
        <div class="clearB"></div>
  </div>
</div>