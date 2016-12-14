<link rel="stylesheet" href="/cn/css/openList.css"/>
<div class="open-detailsTitle">
    <ul>
        <li>
            <img src="/cn/images/openD_titleIcon.png" alt="标题图片"/>
        </li>
        <li><b>SmartApply公开课</b></li>
        <li><a href="/public-class.html">SmartApply公开课</a></li>
        <li> &gt;</li>
        <li><a href="#"><?php echo $name?></a></li>
    </ul>
</div>
<div style="clear: both"></div>

<div class="list-content">
    <div class="list-left">
        <ul>
            <?php
                foreach($data as $v) {
                    ?>
                    <li>
                        <div class="inlist-left">
                            <h4><?php echo $v['name']?></h4>
                            <ul>
                                <li><b>【课程介绍】</b><?php echo $v['alternatives']?></li>
                                <li><b>【授课老师】</b> <?php echo $v['listeningFile']?></li>
                            </ul>
                            <div class="bottList">
                                <img src="/cn/images/openList_time.png" alt="开课时间图标"/>
                                <span>开课时间：<?php echo date("Y-m-d H:i",strtotime($v['cnName'])) ?></span>
                                <span class="mlTime">时长：<?php echo $v['problemComplement']?></span>
                                <span class="blackC"><img src="/cn/images/open_love.png" alt="心图标"/><?php echo $v['numbering']?></span>
                                <a href="/public-class/<?php echo $v['id']?>.html">查看详情</a>
                            </div>
                        </div>
                        <div class="inlist-right">
                            <img src="<?php echo $v['image']?>" alt="课程图片">
                        </div>
                        <div style="clear: both"></div>
                    </li>
                <?php
                }
            ?>
        </ul>
        <!--分页-->
        <script type="text/javascript">
            function goPage(){
                var page = $('.pageNumber').val();
                var total = <?php echo $total?>;
                if(page = "" || page > total || page<1){
                    alert("请输入正确数字");
                    return false;
                }
                var page = $('.pageNumber').val();
                location.href="/public-class/<?php echo $category?>/"+page+".html";
            }
        </script>
        <div class="page pagetop">
            <ul>
                <li>总数：<?php echo $count?></li>
                <li><a href="<?php echo "/public-class/".$category."/1.html"?>">首页</a></li>
                <li><a href="<?php echo ($page >1)?'/public-class/'.$category.'/'.($page-1).'.html':'javascript:;'?>">上一页</a></li>
                <li><a href="<?php echo ($page <$total)?'/public-class/'.$category.'/'.($page+1).'.html':'javascript:;'?>">下一页</a></li>
                <li class="mr"><a href="<?php echo "/public-class/".$category."/$total.html"?>">尾页</a></li>
                <li class="mr02">页次：<span class="colorRed"><?php echo $page?></span>/<?php echo $total?></li>
                <li class="mr02"><input class="pageNumber" type="text"/></li>
                <li><input onclick="goPage()" type="button" value="GO"/></li>
            </ul>
            <div style="clear: both"></div>
        </div>
    </div>

    <div class="list-right">
        <div class="dimension">
            <span></span>
            <img src="/cn/images/openList_erweima01.jpg" alt="二维码图片"/>
        </div>
        <div class="dimensionFont">
            <h4>Lindy老师微信</h4>
            <span>报名公开课或获取往期课程音频</span><br>
            <span>加“Lindy老师”微信为好友！</span>
        </div>
        <div class="dimension">
            <span></span>
            <img src="/cn/images/openList_erweima03.jpg" alt="二维码图片"/>
        </div>

        <div class="dimensionFont">
            <h4>chris老师微信</h4>
            <span>报名公开课或获取往期课程音频</span><br>
            <span>加“chris老师”微信为好友！</span>
        </div>

        <div class="dimension">
            <span></span>
            <img src="/cn/images/openList_erweima02.jpg" alt="二维码图片"/>
        </div>
        <div class="dimensionFont">
            <h4>雷哥GMAT APP下载</h4>
            <span>下载雷哥GMAT题库APP，随时随地练习GMAT</span>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<script type="text/javascript">
    /**
     * 立即队员
     */
    function buyNow(_id){
        window.location.href="/quick-clearing/"+_id+"/1.html";

    }
</script>

