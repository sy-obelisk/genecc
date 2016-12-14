
<link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
<link rel="stylesheet" href="/cn/css/index_second.css"/>
<link rel="stylesheet" href="/cn/css/universityRanking.css"/>
<link rel="stylesheet" href="/cn/css/universityR-detail.css"/>

<!------------另一种导航------------------>
<div style="clear: both"></div>

<div class="rankD-top">
    <div class="container">
        <div class="row">
            <div class="lucency">
                <ul>
                    <li>
                        <b>排名类型</b>
                    </li>
                    <?php
                    $University = \app\modules\cn\models\Category::find()->where("pid=292")->orderBy("CAST(sort as SIGNED) ASC")->all();
                    foreach($University as $v) {
                        ?>
                        <li<?php if($v['id'] == (isset($_GET['type'])?$_GET['type']:'')){?> class="on" <?php } ?>><a href="/cn/ranking/<?php echo $v['id']?>-<?php echo isset($_GET['year'])?$_GET['year']:0?>.html"><?php echo $v['name']?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="clearfix" style="margin-bottom: 20px"></div>
                <ul>
                    <li>
                        <b>年份</b>
                    </li>
                    <?php
                    $year = \app\modules\cn\models\Category::find()->where("pid=305")->orderBy("id desc")->all();
                    foreach($year as $v) {
                        ?>
                        <li <?php if($v['id'] == (isset($_GET['year'])?$_GET['year']:'')){?> class="on" <?php } ?>><a href="/cn/ranking/<?php echo isset($_GET['type'])?$_GET['type']:0?>-<?php echo $v['id']?>.html"><?php echo $v['name']?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="rankD-bot">
            <div class="rankDb-right">
                <ul>
                    <li>
                        <div class="dataUl">
                            <ul>
                                <?php foreach($data['data'] as $v){?>
                                    <li>
                                        <div class="indata">
                                            <div class="blackDiv">
                                                NO.<?php echo $v['article']?>
                                                <img src="/cn/images/rankD_rightJ.png" alt="三角图标"/>
                                            </div>
                                            <div class="centerF">
                                                <span><?php echo $v['name']?></span> <br/>
                                                <span><?php echo $v['title']?></span>
                                            </div>
                                            <div class="WorkDetails">
                                                <a href="http://schools.smartapply.cn/schools<?php if($v['alternatives']){ echo '/'.$v['alternatives'].'.html';} else{ echo '.html';}?>">查看学校</a>
                                                <div class="clearfix"></div>
                                                <span>查看人数:<b><?php echo round(($v['id'])*10/3+5)?></b> &nbsp;评论:<b><?php echo round(($v['id'])*3/2+10)?></b></span>
                                            </div>
                                            <div style="clear: both"></div>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="con-page">
                            <ul>
                                <?php echo $data['pageStr']?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <script type="text/javascript">
                $('.iPage').click(function(){
                    $(this).siblings().removeClass('on');
                    $(this).addClass('on');
                    var page = $('.con-page').find('.on').html();
                    location.href ="/cn/ranking/<?php echo isset($_GET['type'])?$_GET['type']:0?>-<?php echo isset($_GET['year'])?$_GET['year']:0?>-"+page+".html";
                })

                $('.prev').click(function(){
                    var page = $('.con-page').find('.on').html();
                    if(page == 1){
                        return false;
                    }else{
                        page = parseInt(page)-1;
                    }
                    location.href ="/cn/ranking/<?php echo isset($_GET['type'])?$_GET['type']:0?>-<?php echo isset($_GET['year'])?$_GET['year']:0?>-"+page+".html";
                })

                $('.next').click(function(){
                    var page = $('.con-page').find('.on').html();
                    if(page == <?php echo $data['totalPage']?>){
                        return false;
                    }else{
                        page = parseInt(page)+1;
                    }
                    location.href ="/cn/ranking/<?php echo isset($_GET['type'])?$_GET['type']:0?>-<?php echo isset($_GET['year'])?$_GET['year']:0?>-"+page+".html";
                })
            </script>
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

<!--                <div class="common-title">-->
<!--                    录取捷报-->
<!--                </div>-->
<!--                <div class="report">-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="orange">奖</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span>录</span>-->
<!--                            <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->

                <div class="common-title">
                    USnews美国大学排名
                </div>
                <div class="greyDiv">
                    <div class="greyB-ul">
                        <ul>
                            <?php
                            $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'answer,alternatives,article','category' => '292,293,307','page'=>1,'pageSize' => 10,'order'=>' CAST(article as SIGNED)']);
                            foreach($data as $v) {
                                ?>
                                <li>
                                    <i>•</i>
                                    <a href="http://schools.smartapply.cn/schools<?php if($v['alternatives']){ echo '/'.$v['alternatives'].'.html';} else{ echo '.html';}?>"><?php echo $v['name']?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
<!--<script type="text/javascript">-->
<!--    jQuery(".rankD-bot").slide({-->
<!--        titCell:".rankDb-left li",mainCell:".rankDb-right",trigger:"mouseover"-->
<!--    });-->
<!--</script>-->