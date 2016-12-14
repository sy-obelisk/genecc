
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/caseLib-public.css"/>
    <link rel="stylesheet" href="/cn/css/case-details.css"/>
    <link rel="stylesheet" href="/cn/css/index_second.css"/>
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
                    <a href="#"><?php echo $class[0]['name']?></a>
                </li>
            </ul>
        </div>
        <div class="detailContent">
            <ul>
                <?php
                foreach($data['data'] as $v) {
                    ?>
                    <li>
                        <a href="/cn/mall-two/<?php echo $_GET['countryid'];?>-<?php echo $v['id']?>.html" class="title"><?php echo $v['name']?></a>
                        <span><?php echo $v['createTime']?></span>

                        <p><?php echo $v['answer']?>
                            <a href="/cn/mall-two/<?php echo $_GET['countryid'];?>-<?php echo $v['id']?>.html" class="detail">[详情]</a></p>

                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <!-----------分页------------>
        <div class="con-page">
            <ul>
                <?php echo $data['pageStr']?>
            </ul>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $('.iPage').click(function(){
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            var page = $('.con-page').find('.on').html();
            location.href ="/cn/mall-two/list-<?php echo $_GET['countryid'];?>-"+page+".html";
        })

        $('.prev').click(function(){
            var page = $('.con-page').find('.on').html();
            if(page == 1){
                return false;
            }else{
                page = parseInt(page)-1;
            }
            location.href ="/cn/mall-two/list-<?php echo $_GET['countryid'];?>-"+page+".html";
        })

        $('.next').click(function(){
            var page = $('.con-page').find('.on').html();
            if(page == <?php echo $data['totalPage']?>){
                return false;
            }else{
                page = parseInt(page)+1;
            }
            location.href ="/cn/mall-two/list-<?php echo $_GET['countryid'];?>-"+page+".html";
        })
    </script>
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
                    $data = \app\modules\cn\models\Content::getClass(['fields' => 'answer','category' => $_GET['countryid'],'page'=>1,'pageSize' => 10]);
                    foreach($data as $v) {
                    ?>
                    <li>
                        <i>•</i>
                        <a href="/cn/mall-two/<?php echo $_GET['countryid']?>-<?php echo $v['id']?>.html"><?php echo $v['name']?></a>
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
<!---->
    </div>
</div>
<div class="clearMB"></div>
</div>
</div>