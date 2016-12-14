<link rel="stylesheet" href="/cn/css/index_threeLevel.css"/>
<script type="text/javascript" src="/cn/js/index_threeLevel.js"></script>
<div class="bigThree" data-value="<?php echo $pid;?>">
    <div class="topContent">
        <div class="topC-left">
            <div class="topC-grey">
                <img src="<?php echo $data['image']?>" alt="图片">
            </div>
            <div class="bot-grey">
                <span>商品编号：toefl<?php echo $data['id']?></span>
                <div class="bshare-custom">
                    <span>分享到</span>&nbsp;&nbsp;
                    <a title="分享到QQ空间" class="bshare-qzone">空间</a>
                    <a title="分享到微信" class="bshare-weixin">微信</a>
                    <a title="分享到新浪微博" class="bshare-sinaminiblog">微博</a>
                </div>
                <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=0a13f29f-a6de-4905-9fd0-2a39d906a0ef&amp;pophcol=1&amp;lang=zh"></script>
                <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="topC-right">
            <h1><?php echo $data['name']?></h1>
            <div class="buyBlue">
                <ul>
                    <li>购买人数：<span><?php echo $parent['alternatives']?></span></li>
                    <li><b>|</b></li>
                    <li>累计评价：<span><?php echo $parent['article']?></span></li>
                    <li><b>|</b></li>
                    <li>送雷豆：<span><?php echo $parent['listeningFile']?></span></li>
                </ul>
            </div>
            <div class="shopInfo">
                <ul>
                    <?php
                    foreach($tag as $v) {
                        ?>
                        <li class="mb"><?php echo $v['name']?>：
                            <?php
                            foreach($v['child'] as $val) {
                                ?>
                                <a class="changePrice <?php echo $val['select']?'on':''?>" data-value="<?php echo $val['id']?>"
                                   href="javascript:;"><?php echo $val['name']?></a>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="lineThough">
                        <span>价格：￥<?php echo $data['originalPrice']?></span>
                    </li>
                    <li class="chuxiao">
                        <span>促销价：<span>￥<?php echo $data['price']?></span></span>
                    </li>
                    <li class="numLi">
                        <span>数量：</span>
                        <div class="numMore">
                            <span class="add" onclick="addTotal(this)">+</span>
                            <input class="shop_number" type="text" value="1" readonly='readonly'/>
                            <span class="subtract" onclick="subTotal(this)">-</span>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                </ul>
            </div>
            <div class="redBtn">
                <ul>
                    <li>
                        <input onclick="buyNow(<?php echo $id?>)" type="button" value="立即兑换"/>
                    </li>
                    <li>
                        <input onclick="addShop(<?php echo $id?>)" type="button" value="加入购物车"/>
                    </li>
                </ul>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="leftContent">
        <div class="leftChd hd">
            <ul>
                <li>商品详情</li>
                <li>累计评价</li>
            </ul>
        </div>
        <div class="leftCbd">
            <ul>
                <li><?php echo $parent['description']?></li>
            </ul>
            <ul class="pj">
                <li>
                    <div class="leftGrade">
                        <b><?php echo '9.'.rand(3,9)?></b>
                        <br><span>综合评分</span>
                    </div>
                    <div class="allSee">大家都写到</div>
                    <div class="rightEvaluate">
                        <ul>
                            <?php
                                foreach($plate as $v) {
                                    ?>
                                    <li><span class="orange"><?php echo $v['name']?>(<?php echo rand(10,$parent['article'])?>)</span></li>
                                <?php
                                }
                            ?>
                        </ul>
                    </div>
                    <div style="clear: both"></div>
                    <div class="pj-content">
                        <div class="classifyHd hd">
                            <ul>
                                <li>
                                    <input type="radio" name="sort" id="sort01" checked/>
                                    <label for="sort01">全部(<?php echo $parent['article']?>)</label>
                                </li>
                                <li>
                                    <input type="radio" name="sort" id="sort02"/>
                                    <label for="sort02">好评(<?php echo $parent['article']-1?>)</label>
                                </li>
                                <li>
                                    <input type="radio" name="sort" id="sort03"/>
                                    <label for="sort03">中评(<?php echo 1?>)</label>
                                </li>
                                <li>
                                    <input type="radio" name="sort" id="sort04"/>
                                    <label for="sort04">差评(<?php echo 0?>)</label>
                                </li>
                            </ul>
                        </div>
                        <div class="classifyBd">
                            <ul>

                                <?php foreach($discuss as $v) { ?>
                                    <li>
                                        <div class="classifyBd-left">
                                            <img src="<?php echo $v['image']?$v['image']:Yii::$app->params['defaultImg']?>" alt="用户头像"/>
                                        </div>
                                        <div class="classifyBd-right">
                                            <p><?php echo $v['discussContent']?></p>
                                            <span><?php echo date("Y.m.d",$v['createTime'])?></span>
                                        </div>
                                        <div style="clear: both"></div>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                    for($i=0;$i<$parent['article']-count($discuss);$i++) {
                                        ?>
                                        <li>
                                            <div class="classifyBd-left">
                                                <img src="/cn/images/threeLevel_headIcon0<?php echo rand(1,9)?>.png" alt="用户头像"/>
                                            </div>
                                            <div class="classifyBd-right">
                                                <p><?php echo Yii::$app->params['shopEvaluate'][rand(0,23)]?></p>
                                                <span><?php echo '2016.'.rand(1,5).'.'.rand(1,28)?></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        </li>
                                    <?php
                                    }
                                ?>
                            </ul>
                            <ul>

                                <?php foreach($discuss as $v) {
                                    if ($v['stars'] >= 4) {
                                        ?>
                                        <li>
                                            <div class="classifyBd-left">
                                                <img
                                                    src="<?php echo $v['image'] ? $v['image'] : Yii::$app->params['defaultImg']?>"
                                                    alt="用户头像"/>
                                            </div>
                                            <div class="classifyBd-right">
                                                <p><?php echo $v['discussContent']?></p>
                                                <span><?php echo date("Y.m.d", $v['createTime'])?></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                                <?php
                                for($i=0;$i<$parent['article']-count($discuss)-1;$i++) {
                                    ?>
                                    <li>
                                        <div class="classifyBd-left">
                                            <img src="/cn/images/threeLevel_headIcon0<?php echo rand(1,9)?>.png" alt="用户头像"/>
                                        </div>
                                        <div class="classifyBd-right">
                                            <p><?php echo Yii::$app->params['shopEvaluate'][rand(0,23)]?></p>
                                            <span><?php echo '2016.'.rand(1,5).'.'.rand(1,28)?></span>
                                        </div>
                                        <div style="clear: both"></div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <ul>

                                <?php foreach($discuss as $v) {
                                    if ($v['stars'] <= 3 && $v['stars'] >=2) {
                                        ?>
                                        <li>
                                            <div class="classifyBd-left">
                                                <img
                                                    src="<?php echo $v['image'] ? $v['image'] : Yii::$app->params['defaultImg']?>"
                                                    alt="用户头像"/>
                                            </div>
                                            <div class="classifyBd-right">
                                                <p><?php echo $v['discussContent']?></p>
                                                <span><?php echo date("Y.m.d", $v['createTime'])?></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                                <li>
                                    <div class="classifyBd-left">
                                        <img
                                            src="/cn/images/threeLevel_headIcon09.png"
                                            alt="用户头像"/>
                                    </div>
                                    <div class="classifyBd-right">
                                        <p>还行吧，服务差不多</p>
                                        <span><?php echo '2015.10.25'?></span>
                                    </div>
                                    <div style="clear: both"></div>
                                </li>
                            </ul>
                            <ul>

                                <?php foreach($discuss as $v) {
                                    if ($v['stars'] <= 1) {
                                        ?>
                                        <li>
                                            <div class="classifyBd-left">
                                                <img
                                                    src="<?php echo $v['image'] ? $v['image'] : Yii::$app->params['defaultImg']?>"
                                                    alt="用户头像"/>
                                            </div>
                                            <div class="classifyBd-right">
                                                <p><?php echo $v['discussContent']?></p>
                                                <span><?php echo date("Y.m.d", $v['createTime'])?></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="rightContent">
        <h4>联系客服</h4>
        <div class="customer">
            <div class="customer-left">
                <img src="/cn/images/threeLevel_qq.png" alt="qq图标"/>
            </div>
            <div class="customer-right">
                <p>Chris老师</p>
                <a target="blank" href="tencent://message/?uin=1746295647&amp;Site=www.cnclcy&amp;Menu=yes">
                    QQ：1746295647</a>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="record">
            <h4>报名记录</h4>
            <ul>
                <?php
                    foreach($bought as $v) {
                        ?>
                        <li>
                            <img src="<?php echo $v['image']?$v['image']:'/cn/images/details_defaultImg.png'?>" alt="头像"/>

                            <p><?php echo $v['nickname']?$v['nickname']:$v['userName']?></p>
                        </li>
                    <?php
                    }
?>
                <?php
                    for($i=0;$i<(10-count($bought));$i++) {
                        ?>
                        <li>
                            <img src="/cn/images/threeLevel_headIcon0<?php echo rand(1,9)?>.png" alt="头像"/>

                            <p><?php echo \app\libs\Method::randStr(8)?></p>
                        </li>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
