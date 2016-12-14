
<div class="open-commonStyle">
    <ul>
        <!--        <a href="/public-class/162/1.html">more</a>-->
        <div class="open-commonTitle">
            <a href="/public-class/162/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack01">
                <h1>GMAT</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,162','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <a href="/public-class/<?php echo $v['id']?>.html"><img src="<?php echo $v['image']?>" alt="课程图"/></a>
                </div>
                <p><a href="/public-class/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                if($v['duration']) {
                    ?>
                    <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                <?php
                }else {
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
        <div style="clear: both"></div>
        <div class="open-commonTitle">
            <a href="/public-class/163/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack02">
                <h1>托福</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,163','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <a href="/public-class/<?php echo $v['id']?>.html"><img src="<?php echo $v['image']?>" alt="课程图"/></a>
                </div>
                <p><a href="/public-class/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                if($v['duration']) {
                    ?>
                    <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                <?php
                }else {
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
        <div style="clear: both"></div>

        <div class="open-commonTitle">
            <a href="/public-class/150/1.html">more</a>
            <div style="clear: both"></div>
        </div>
        <li class="noBorderLi">
            <div class="haveBG-img imgBack03">
                <h1>留学</h1>
            </div>
        </li>
        <?php
        $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','fields' => 'duration,cnName,numbering','category' => '218,150','pageSize' => 3]);
        foreach($data as $v) {
            ?>
            <li>
                <div class="topImg">
                    <a href="/public-class/<?php echo $v['id']?>.html"><img src="<?php echo $v['image']?>" alt="课程图"/></a>
                </div>
                <p><a href="/public-class/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></p>
                <span><?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                <b><?php echo $v['numbering']?></b>

                <div style="clear: both;border-bottom: 1px #cbcbcb solid"></div>
                <?php
                if($v['duration']) {
                    ?>
                    <a href="/public-class/back/<?php echo $v['id']?>.html" class="classBtn diffColor01">回放</a>
                <?php
                }else {
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
<script type="text/javascript">
    /**
     * 立即队员
     */
    function buyNow(_id){
        window.location.href="/quick-clearing/"+_id+"/1.html";
    }
</script>

