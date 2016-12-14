
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/caseLib-public.css"/>
    <link rel="stylesheet" href="/cn/css/caseLibrary.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>

<div class="container">
<div class="row">
<div class="caseNav">
    <ul>
        <li>
            <a href="/cn/mall-two"><span>留学案例</span></a>
        </li>
        <li class="on">
            <a href="/cn/mall-two/gmat"><span>GMAT案例</span></a>
        </li>
        <li>
            <a href="/cn/mall-two/toefl"><span>托福案例</span></a>
        </li>
        <li>
            <a href="/cn/mall-two/offer"><span>名校offer</span></a>
        </li>
    </ul>
    <div class="caseSearch">
        <input type="text"/>
        <input type="button" value="搜索"/>
    </div>
    <div style="clear: both"></div>
</div>
<div class="col-md-9">
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
<!--            <div class="item active">-->
<!--                <img  src="/cn/images/TFindex_lunbo1.png"-->
<!--                      alt="First slide image">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>-->
<!--                    <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <img src="/cn/images/TFindex_lunbo4.png"-->
<!--                     alt="Second slide image">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>Second slide label</h3>-->
<!--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <img  src="/cn/images/TFindex_lunbo1.png"-->
<!--                      alt="First slide image">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>-->
<!--                    <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<!--------------------幻灯片end----------------------->

<div class="caseBorder">
    <div class="purple-title">
        <span>GMAT高分捷报</span>
        <a href="/cn/mall-two/list-287.html">MORE</a>
    </div>
    <div class="col-md-6">
        <div class="col-md-3">
            <div class="book-left">
                <div class="bookB">
                    <img src="images" alt="图片">
                </div>
                <p>GMAT 710</p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="book-right">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '287','page'=>1,'pageSize' => 5]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/cn/mall-two/287-<?php echo $v['id']?>.html"><i>•</i><?php echo $v['name']?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="col-md-6">
        <div class="col-md-3">
            <div class="book-left">
                <div class="bookB">
                    <img src="images" alt="图片">
                </div>
                <p>GMAT 710</p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="book-right">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '287','page'=>2,'pageSize' => 5]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <a href="/cn/mall-two/287-<?php echo $v['id']?>.html"><i>•</i><?php echo $v['name']?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
    <div style="clear: both"></div>
</div>

    <div class="caseBorder">
        <div class="purple-title">
            <span>GMAT高分学员备考经验</span>
            <a href="/cn/mall-two/list-288.html">MORE</a>
        </div>
        <div class="col-md-6">
            <div class="col-md-3">
                <div class="book-left">
                    <div class="bookB">
                        <img src="images" alt="图片">
                    </div>
                    <p>杜克早录取地方</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="book-right">
                    <ul>
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '288','page'=>1,'pageSize' => 5]);
                        foreach($data as $v) {
                            ?>
                            <li>
                                <a href="/cn/mall-two/288-<?php echo $v['id']?>.html"><i>•</i><?php echo $v['name']?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="col-md-6">
            <div class="col-md-3">
                <div class="book-left">
                    <div class="bookB">
                        <img src="images" alt="图片">
                    </div>
                    <p>杜克早录取地方</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="book-right">
                    <ul>
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '288','page'=>2,'pageSize' => 5]);
                        foreach($data as $v) {
                            ?>
                            <li>
                                <a href="/cn/mall-two/288-<?php echo $v['id']?>.html"><i>•</i><?php echo $v['name']?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>
<div class="col-md-3">
    <div class="rightEnroll">
        <div class="univer-right">
            <div class="common-title">
                最新案例
            </div>
            <div class="greyDiv">
                <div style="clear: both"></div>
                <div class="greyB-ul">
                    <ul>
                        <?php
                        $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => '267','page'=>1,'pageSize' => 10]);
                        foreach($data as $v) {
                        ?>
                            <li>
                                <i>•</i>
                                <a href="/cn/mall-two/267-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="clearB"></div>
</div>
</div>