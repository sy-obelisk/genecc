
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/caseLib-public.css"/>
    <link rel="stylesheet" href="/cn/css/case-threeL.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
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
                    <a href="/cn/mall-two">案例库</a>
                    &gt;
                    <a href="/cn/mall-two/list-<?php echo$class[0]['id']?>.html"><?php echo $class[0]['name']?></a>
                    &gt;
                    <a href="#">正文</a>
                </li>
            </ul>
        </div>
        <div class="threeTitle">
            <h1><?php echo $data[0]['name']?></h1>
            <span>来源：<?php echo $data[0]['createTime']?></span>
        </div>
        <div class="threeContent">
            <?php echo $data[0]['alternatives']?>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="univer-right">
        <div class="common-title">
            成功案例
        </div>
        <div class="greyDiv">
            <div style="clear: both"></div>
            <div class="greyB-ul">
                <ul>
                    <?php
                    $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => $_GET['countryid'],'page'=>1,'pageSize' => 8]);
                    foreach($data as $v) {
                        ?>
                        <li>
                            <i>•</i>
                            <a href="/cn/mall-two/<?php echo $_GET['countryid']?>-<?php echo $v['id']?>.html"><?php echo $v['name'] ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

<!--        <div class="common-title">-->
<!--            录取捷报-->
<!--        </div>-->
<!--        <div class="report">-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span class="orange">奖</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span>录</span>-->
<!--                    <a href="#">[牛津大学]&nbsp;&nbsp;&nbsp;&nbsp;[mmxe1990]</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->

    </div>
</div>
<div class="clearMB"></div>
</div>
</div>