
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/counselor.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/index_second.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
    <script type="text/javascript" src="/cn/js/counselor.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>
<div class="container">
    <div class="row">
        <!--头部选项栏-->
        <div class="chooseClass classMT">
            <div class="col-md-1">
                <span>申请国家:</span>
            </div>
            <div class="col-md-11">
                <ul>
                    <li <?php
                        if((isset($_GET['country'])?$_GET['country']:'0')==0){?> class="on" <?php }?>>
                        <a href="/cn/consultant/1.html">全部</a>
                    </li>
                    <?php
                    $country = \app\modules\cn\models\Category::find()->where("pid=239")->all();
                    foreach($country as $v) {
                        ?>
                        <li <?php
                        if($v['id'] == (isset($_GET['country'])?$_GET['country']:'0')){?> class="on" <?php }?>>
                            <a href="/cn/consultant/country-<?php echo $v['id']?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-1.html">
                                <?php echo $v['name']?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div style="clear: both"></div>
        </div>
  <!--      <div class="chooseClass classMT02">
            <div class="col-md-1"><span>顾问所在地:</span></div>
            <div class="col-md-11">
                <ul>
                    <li <?php
/*                    if((isset($_GET['regionid'])?$_GET['regionid']:'0')==0){*/?> class="on" <?php /*}*/?>>
                        <a href="/cn/consultant/<?php /*echo isset($_GET['country']) ? $_GET['country'] : '0' */?>/1.html">
                            全部
                        </a>
                    </li>
                    <?php
/*                    $region = \app\modules\cn\models\Category::find()->where("pid=255")->all();
                    foreach($region as $key=>$v) {
                        */?>
                        <li <?php
/*                        if($v['id'] == (isset($_GET['regionid'])?$_GET['regionid']:'0')){*/?> class="on" <?php /*}*/?>>
                            <a href="/cn/consultant/country-<?php /*echo isset($_GET['country']) ? $_GET['country'] : '0' */?>/-<?php /*echo $v['id'] */?>-1.html">
                                <?php /*echo $v['name'] */?>
                            </a>
                        </li>
                        <?php
/*                    }
                    */?>
                </ul>
            </div>
            <div style="clear: both"></div>
        </div>-->
<!--------------展示老师信息部分------------------->
        <div class="col-md-9">
            <div class="teacherLeft">
                <div class="chooseL">
                    <ul>
                        <li <?php if(!isset($_GET['num'])){?> class="on" <?php }?> ><a href="/cn/consultant/country-<?php echo isset($_GET['country']) ? $_GET['country'] : '0' ?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-1.html">默认排序</a></li>
                        <li>|</li>
                        <li <?php if(isset($_GET['num'])){?> class="on" <?php }?> ><a href="/cn/consultant/country-<?php echo isset($_GET['country']) ? $_GET['country'] : '0' ?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-1-1.html">按以服务学生总数排序</a></li>
                    </ul>
                </div>
                <div class="chooseInfo">
                    <ul>
                        <?php
                        foreach($data['data'] as $v) {
                            ?>
                            <li>
                                <div class="col-md-2">
                                    <div class="leftImg">
                                        <div class="headImg">
                                            <img src="<?php echo $v['image']?>" alt="老师头像">
                                        </div>
                                        <div class="botStar">
                                            <ul>
                                                <li>
                                                    <img src="/cn/images/counselor_star.png" alt="星星图标">
                                                </li>
                                                <li>
                                                    <img src="/cn/images/counselor_star.png" alt="星星图标">
                                                </li>
                                                <li>
                                                    <img src="/cn/images/counselor_star.png" alt="星星图标">
                                                </li>
                                                <li>
                                                    <img src="/cn/images/counselor_star.png" alt="星星图标">
                                                </li>
                                                <li>
                                                    <img src="/cn/images/counselor_star.png" alt="星星图标">
                                                </li>
                                                <li><span>5分</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="centerInfo">
                                        <h1><a href="/cn/consultant/details/<?php echo $v['id'];?>.html"><?php echo $v['name']?></a>
                                            <span><?php echo isset($v['source']) ? $v['source']:'申友专家讲师' ?></span>
                                        </h1>

                                        <p><?php echo $v['buyNum']?></p>

                                        <p>从业<?php echo $v['age']?>年</p>
                                        <a href="/cn/consultant/details/<?php echo $v['id'];?>.html">点击咨询</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="rightInfo">
                                        <ul>
                                            <li>
                                                已帮助<span><?php echo isset($v['students'])?$v['students']:'0'?></span>位学生拿到录取
                                            </li>
                                            <?php foreach(explode(",",$v['sid']) as $key=>$va){
                                                foreach($schools as $s){
                                                    if($va == $s['id']){?>
                                                        <li><a href="http://schools.smartapply.cn/schools/<?php echo $s['id']?>.html"><?php echo $s['name']?></a></li>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div style="clear: both"></div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            <!-----------------分页--------------------->
                <div class="con-page">
                    <ul>
                        <?php echo $data['pageStr']?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="teacherRight">
                <a href="#">
                    <img src="/cn/images/counselor_ruzhu.png" alt="图片"/>
                </a>
                <!----热门顾问排行----->
                <div class="hotRank">
                     <div class="hotTop">热门顾问排行</div>
                     <div class="hotBot">
                         <ul>
                             <?php
                             $Ranking = \app\modules\cn\models\Content::getClass(['fields' => 'alternatives','category' => '239','page'=>1,'pageSize' => 10]);
                             foreach($Ranking as $v) {
                                 ?>
                                 <li>
                                     <div class="col-md-4">
                                         <div class="hot-left">
                                             <img src="<?php echo $v['image'];?>" alt="顾问头像"/>
                                         </div>
                                     </div>
                                     <div class="col-md-8">
                                         <div class="hot-right">
                                             <h4><?php echo $v['name'] ?></h4>

                                             <p><?php echo $v['alternatives']; ?></p>
                                             <a href="/cn/consultant/details/<?php echo $v['id'];?>.html">点击咨询</a>
                                         </div>
                                     </div>
                                     <div style="clear: both"></div>
                                 </li>
                                 <?php
                             }
                             ?>
                         </ul>
                     </div>
                </div>
            </div>
        </div>
        <div class="clearBox"></div>
    </div>
</div>
    <script type="text/javascript">
        $('.iPage').click(function(){
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            var page = $('.con-page').find('.on').html();
            location.href ="/cn/consultant/country-<?php echo isset($_GET['country'])?$_GET['country']:0?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-"+page+".html";
        })

        $('.prev').click(function(){
            var page = $('.con-page').find('.on').html();
            if(page == 1){
                return false;
            }else{
                page = parseInt(page)-1;
            }
            location.href ="/cn/consultant/country-<?php echo isset($_GET['country'])?$_GET['country']:0?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-"+page+".html";
        })

        $('.next').click(function(){
            var page = $('.con-page').find('.on').html();
            if(page == <?php echo $data['totalPage']?>){
                return false;
            }else{
                page = parseInt(page)+1;
            }
            location.href ="/cn/consultant/country-<?php echo isset($_GET['country'])?$_GET['country']:0?>/-<?php echo isset($_GET['regionid'])?$_GET['regionid']:0?>-"+page+".html";
        })
    </script>
