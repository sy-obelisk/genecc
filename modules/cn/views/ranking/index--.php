
<link rel="stylesheet" href="/cn/css/bootstrap.css"/>
<link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
<link rel="stylesheet" href="/cn/css/universityRanking.css"/>
<script type="text/javascript" src="/cn/js/bootstrap.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="univer-left">
                <!--------------------幻灯片start----------------------->
                <div class="bs-example">
                    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img  src="/cn/images/TFindex_lunbo1.png"
                                      alt="First slide image">
                                <div class="carousel-caption">
                                    <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>
                                    <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="/cn/images/TFindex_lunbo4.png"
                                     alt="Second slide image">
                                <div class="carousel-caption">
                                    <h3>Second slide label</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img  src="/cn/images/TFindex_lunbo1.png"
                                      alt="First slide image">
                                <div class="carousel-caption">
                                    <h3>我的好文书留学“黑科技”来袭，映客直播间进入攻略</h3>
                                    <p>我的好文书留学“黑科技”来袭，映客直播间进入攻略</p>
                                </div>
                            </div>
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
                <div class="rank-title">
                    <span>世界大学排名</span>
                    <a href="/cn/ranking/298.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '298','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/298-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '298','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/298-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!--美国大学排名-->
                <div class="rank-title">
                    <span>美国大学排名</span>
                    <a href="/cn/ranking/293.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '293','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/293-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '293','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/293-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!--英国-->
                <div class="rank-title">
                    <span>英国大学排名</span>
                    <a href="/cn/ranking/294.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '294','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/294-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '294','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/306-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!--欧洲-->
                <div class="rank-title">
                    <span>欧洲大学排名</span>
                    <a href="/cn/ranking/295.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '295','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/295-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '295','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/295-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!--亚洲-->
                <div class="rank-title">
                    <span>亚洲大学排名</span>
                    <a href="/cn/ranking/296.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '296','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/296-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '296','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/296-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div style="clear: both"></div>
                <!--澳洲-->
                <div class="rank-title">
                    <span>澳洲大学排名</span>
                    <a href="/cn/ranking/297.html">MORE</a>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '297','page'=>1,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/297-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="botUl">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '297','page'=>2,'pageSize' => 1]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i class="fa fa-caret-right"></i>
                                    <a href="/cn/ranking/297-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
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
        <div class="col-md-3">
            <div class="univer-right">
                <div class="common-title">
                    成功案例
                </div>
                <div class="greyDiv">
                    <div class="greyB-ul">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '240','page'=>1,'pageSize' => 10]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i>•</i>
                                    <a href="/cn/mall-two/281-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="common-title">
                    录取捷报
                </div>
                <div class="report">
                    <ul>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span class="orange">奖</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                        <li>
                            <span>录</span>
                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>
                        </li>
                    </ul>
                </div>

                <div class="common-title">
                    最新大学排名
                </div>
                <div class="greyDiv">
                    <div class="greyB-ul">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer','category' => '298','page'=>1,'pageSize' => 10]);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i>•</i>
                                    <a href="/cn/ranking/298-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearB"></div>
    </div>
</div>