<link rel="stylesheet" href="/cn/css/openT-detail.css"/>
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
        <div class="openD-inLeft">
            <h4><?php echo $data['name']?></h4>
            <div><?php echo $data['duration']?></div>
        </div>

    </div>
    <div class="open-Dright">
        <div class="instructor">
            <h4>
                <img src="/cn/images/openD_titleIcon03.png" alt="标题图"/>
                <span>授课老师</span>
            </h4>
            <div class="teacher-left">
                <img src="<?php echo $data['article']?$data['article']:Yii::$app->params['defaultImg']?>" alt="老师照片">
            </div>
            <div class="teacher-right">
                <span><span>■</span><?php echo $data['listeningFile']?></span>
            </div>
            <div style="clear: both"></div>
            <div>
                <p><?php echo $data['answer']?></p>
            </div>
        </div>
        <div class="erweima">
            <h4>[报名公开课或获取往期音频加微信为好友]</h4>
            <ul>
                <li>
                    <img src="/cn/images/openList_erweima01.jpg" alt="二维码">
                    <p>Lindy老师微信</p>

                </li>
                <li>
                    <img src="/cn/images/openList_erweima03.jpg" alt="二维码">
                    <p>chris老师微信</p>

                </li>
                <li>
                    <img src="/cn/images/openList_erweima02.jpg" alt="二维码">
                    <p>雷哥GMAT APP下载</p>

                </li>

            </ul>
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

