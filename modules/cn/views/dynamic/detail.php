
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/StudyingD-threeL.css"/>
    <script type="text/javascript" src="js/bootstrap.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>
<div class="container">
<div class="row">
<div class="col-md-9">
    <div class="commonLeft">
        <div class="subNav">
            <ul>
                <li>
                    <a href="#">留学商城</a>
                    &gt;
                    <a href="/cn/dynamic">留学动态</a>
                    &gt;
                    <a href="/cn/dynamic/body/<?php echo $_GET['catid']?>.html"><?php echo $class[0]['name']?></a>
                    &gt;
                    <a href="#">正文</a>
                </li>
            </ul>
        </div>
        <div class="threeTitle">
              <h1><?php echo $data[0]['title']?></h1>
              <span>来源：<?php echo $data[0]['createTime']?></span>
        </div>
        <div class="threeContent">
            <?php echo $data[0]['alternatives']?>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="commonRight">
        <div class="TopList">
            <div class="common-title">
                热销排行榜
            </div>
            <div class="ProductList">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['where' => 'c.pid=0','category' => '223','pageSize' => 10]);
                    foreach($data as $key=>$v){?>
                        <li>
                            <div class="numDiv"><?php echo $key+1;?></div>
                            <a href="/goods/<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="common-title">
                你可能感兴趣的学校
            </div>
            <div class="interestSchool">
                <ul>
                    <?php foreach($ranking as $key=>$v){ ?>
                        <li>
                            <div class="numDiv"><?php echo $key+1;?></div>
                            <a href="http://schools.smartapply.cn/schools/<?php echo $v['id']?>.html"><?php echo $v['name'];?></a>
                            <span>排名<?php echo $v['article'];?></span>
                            <p>
                                <img src="/cn/images/studying_person.png" alt="人人图标"/>
                                <?php echo $v['viewCount']?>人查看
                            </p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>
<!--<div class="clearMB"></div>-->
</div>
</div>
