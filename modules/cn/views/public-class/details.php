<link rel="stylesheet" href="/cn/css/openDetails.css"/>
<script type="text/javascript" src="/cn/js/openDetails.js"></script>
<div class="open-detailsTitle">
    <ul>
        <li>
            <img src="/cn/images/openD_titleIcon.png" alt="标题图片"/>
        </li>
        <li><b>SmartApply私塾</b></li>
        <li><a href="/public-class.html">SmartApply公开课</a></li>
        <li> &gt;</li>
        <li><a href="#"><?php echo $data['name']?></a></li>
    </ul>
</div>
<div style="clear: both"></div>

<div class="open-detailsC">
    <div class="open-Dleft">
        <div class="detail-top">
            <div class="detailT-left">
                <img src="<?php echo $data['image']?>" alt="课程图片">
            </div>
            <div class="detailT-right">
                <h4><?php echo $data['name']?></h4>
                <ul>
                    <li>开课时间：<?php echo $parent['cnName']?></li>
                    <li>时长：<?php echo $parent['problemComplement']?></li>
                </ul>
                <div class="xian"></div>
                <!--时间过了下面按钮的文字就是课程回放，没过就是报名-->
                <?php
                    if($parent['duration']) {
                        ?>
                        <a href="/public-class/back/<?php echo $parent['id']?>.html">课程回放</a>
                    <?php
                    }else {
                        ?>
                        <a href="javascript:;" onclick="buyNow(<?php echo $data['id']?>)">报名</a>
                    <?php
                    }
                ?>
                <!--<span><img src="/cn/images/open_love.png" alt="心图标">201</span>-->
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="detail-center">
            <h4>
                <span> <img src="/cn/images/openD_titleIcon01.png" alt="标题图标"/><span>课程内容</span></span>
            </h4>
            <ul>
                <li><?php echo $parent['sentenceNumber']?></li>
            </ul>
        </div>

        <div class="open-commonTitle">
            <h4><img src="/cn/images/openD_titleIcon02.png" alt="图标"><a href="#">您可能感兴趣...</a></h4><a href="/public-class.html">更多</a>
        </div>

        <div class="open-commonStyle">
            <ul>
                <?php
                $inter = \app\modules\cn\models\Content::getClass(['order'=>'c.viewCount DESC','fields' => 'cnName,numbering,duration','category' => '218','pageSize' => 4,'where' => 'c.pid = 0']);
                foreach($inter as $v) {
                ?>
                <li>
                    <img src="<?php echo $v['image'] ?>" alt="课程图"/>

                    <p><?php echo $v['name'] ?></p>
                    <b><?php echo $v['numbering'] ?></b>

                    <div style="clear: both;margin-bottom: 5px"></div>
                    <span><?php echo date("Y-m-d H:i", strtotime($v['cnName'])) ?></span>

                    <div style="border-bottom: 1px #cbcbcb solid;margin-top: 5px"></div>
                    <?php
                    if ($v['duration']) {
                        ?>
                        <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                    <?php
                    } else{
                        ?>
                        <a href="javascript:;" onclick="buyNow(<?php echo $v['id']?>)" class="classBtn diffColor01">报名</a>
                    <?php
                    }
                        ?>
                        <a href="/public-class/<?php echo $v['id']?>.html" class="classBtn diffColor02">详情</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>


    </div>
    <div class="open-Dright">
        <div class="instructor">
            <h4>
                <img src="/cn/images/openD_titleIcon03.png" alt="标题图"/>
                <span>授课老师</span>
            </h4>
            <div class="teacher-left">
                <img src="<?php echo $parent['article']?$parent['article']:Yii::$app->params['defaultImg']?>" alt="老师照片">
            </div>
            <div class="teacher-right">
                <span><span>■</span><?php echo $parent['listeningFile']?></span>
            </div>
            <div style="clear: both"></div>
            <div>
                <p><?php echo $parent['answer']?></p>
            </div>
        </div>
        <!--日历-->
        <div class="dissRight conR-eiji">
            <div class="newActive">
                <img src="/cn/images/academy_calendar.png" alt="最新活动图标"/>
                <b>最新活动</b>
            </div>
            <?php
            $re = \app\modules\cn\models\Content::getActive();
            $activity = $re['activity'];
            $activityDate = $re['activityDate'];
            ?>
            <div class="calendar">
                <div class="calendarHd calendarHd-erji">
                    <ul>
                        <li><?php echo date('Y年m月')?></li>
                    </ul>
                    <a href="javascript:;" class="prev"><i class="fa fa-caret-left"></i></a>
                    <a href="javascript:;" class="next"><i class="fa fa-caret-right "></i></a>
                </div>
                <div style="clear: both"></div>
                <div class="calendarBd">
                    <?php
                    $week = date("N",strtotime(date("Y-m-01")));
                    ?>
                    <ul class="calUl01">
                        <li>
                            <ul>
                                <li>Sun.</li>
                                <li>Mon.</li>
                                <li>Tues.</li>
                                <li>Wed.</li>
                                <li>Thur.</li>
                                <li>Fri.</li>
                                <li>Sat.</li>
                                <?php
                                if($week<7) {
                                    for ($a = 1; $a <= $week; $a++) {
                                        ?>
                                        <li></li>
                                    <?php
                                    }
                                }
                                ?>
                                <?php
                                $StartMonth   = date("Y-m-01"); //开始日期
                                $EndMonth     = date("Y-m-d",strtotime("$StartMonth +1 month -1 day")); //结束日期
                                $ToStartMonth = strtotime( $StartMonth ); //转换一下
                                $ToEndMonth   = strtotime( $EndMonth ); //一样转换一下
                                $i            = false; //开始标示
                                while( $ToStartMonth < $ToEndMonth ) {
                                    $NewMonth = !$i ? date('Y-m-d', strtotime('+0 Month', $ToStartMonth)) : date('Y-m-d', strtotime('+1 day', $ToStartMonth));
                                    $ToStartMonth = strtotime($NewMonth);
                                    $i = true;
                                    ?>
                                    <li>
                                        <?php
                                        if (in_array($NewMonth, $activityDate)){
                                            ?>
                                            <a href="/public-class/<?php echo $activity[$NewMonth]['id']?>.html" class="on on-erji"><?php echo date("d", strtotime($NewMonth)) ?></a>

                                            <div class="classOn classOn-erji">
                                                <?php echo $activity[$NewMonth]['name']?>
                                            </div>
                                        <?php
                                        }else {
                                            ?>
                                            <?php echo date("d", strtotime($NewMonth)) ?>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php
                    $StartMonth   = date("Y-m-01");
                    $week = date("N",strtotime(date("Y-m-01",strtotime("$StartMonth +1 month"))));
                    ?>
                    <ul class="calUl02">
                        <li>
                            <ul>
                                <li>Sun.</li>
                                <li>Mon.</li>
                                <li>Tues.</li>
                                <li>Wed.</li>
                                <li>Thur.</li>
                                <li>Fri.</li>
                                <li>Sat.</li>
                                <?php
                                for($a=1;$a<=$week;$a++) {
                                    ?>
                                    <li></li>
                                <?php
                                }
                                ?>
                                <?php
                                $StartMonth   = date("Y-m-01",strtotime("$StartMonth +1 month")); //开始日期
                                $EndMonth     = date("Y-m-d",strtotime("$StartMonth +1 month -1 day")); //结束日期
                                $ToStartMonth = strtotime( $StartMonth ); //转换一下
                                $ToEndMonth   = strtotime( $EndMonth ); //一样转换一下
                                $i            = false; //开始标示
                                while( $ToStartMonth < $ToEndMonth ) {
                                    $NewMonth = !$i ? date('Y-m-d', strtotime('+0 Month', $ToStartMonth)) : date('Y-m-d', strtotime('+1 day', $ToStartMonth));
                                    $ToStartMonth = strtotime($NewMonth);
                                    $i = true;
                                    ?>
                                    <li>
                                        <?php
                                        if (in_array($NewMonth, $activityDate)){
                                            ?>
                                            <a href="/public-class/<?php echo $activity[$NewMonth]['id']?>.html" class="on on-erji"><?php echo date("d", strtotime($NewMonth)) ?></a>

                                            <div class="classOn classOn-erji">
                                                <?php echo $activity[$NewMonth]['name']?>
                                            </div>
                                        <?php
                                        }else {
                                            ?>
                                            <?php echo date("d", strtotime($NewMonth)) ?>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div style="clear: both"></div>
<?php
$inter = \app\modules\cn\models\Content::getClass(['fields' => 'listeningFile,article,alternatives','category' => '219,155','pageSize' => 1,'where' => 'c.pid = 0']);
foreach($inter as $v) {
    ?>
    <!--热门课程-->
    <div class="hotClass">
        <h4>热门课程</h4>

        <div class="hotImg">
            <img src="<?php echo $v['image']?>" alt="热门课程图片">
            <span>购买人数:<?php echo $v['alternatives']?></span>&nbsp;&nbsp;
            <span>累计评价:<?php echo $v['article']?></span>&nbsp;&nbsp;
            <span>送雷豆:<?php echo $v['listeningFile']?></span>
        </div>
        <div class="hotBtn">
            <a href="/goods/<?php echo $v['id']?>.html">查看详情</a><a href="#">立即咨询</a>
        </div>
    </div>
<?php
}
?>

    </div>
    <div style="clear: both"></div>
</div>
<script type="text/javascript">
    moth(".calUl02",".calendarHd ul li",'<?php echo date("Y年m月")?>','<?php $firstday=date("Y-m"); echo date("Y年m月",strtotime("$firstday +1 month"))?>');
    moth(".evecalUl02",".everyCahd ul li",'<?php echo date("Y年m月")?>','<?php $firstday=date("Y-m"); echo date("Y年m月",strtotime("$firstday +1 month"))?>');
    /**
     * 立即队员
     */
    function buyNow(_id){
        window.location.href="/quick-clearing/"+_id+"/1.html";
    }
</script>
