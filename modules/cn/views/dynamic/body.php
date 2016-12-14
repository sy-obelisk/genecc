
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/StudyingD-detail.css"/>
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
                         <a href="/cn/dynamic">留学动态</a>
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
                            <a href="/cn/dynamic/detail/<?php echo $_GET['catid']?>-<?php echo $v['id']?>.html" class="title"><?php echo $v['title']?></a>
                            <span><?php echo $v['age']?></span>

                            <p><?php echo $v['answer']?>
                                <a href="/cn/dynamic/detail/<?php echo $_GET['catid']?>-<?php echo $v['id']?>.html" class="detail">[详情]</a></p>

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
                location.href ="/cn/dynamic/body/page-"+page+"/<?php echo $_GET['catid']?>.html";
            })

            $('.prev').click(function(){
                var page = $('.con-page').find('.on').html();
                if(page == 1){
                    return false;
                }else{
                    page = parseInt(page)-1;
                }
                location.href ="/cn/dynamic/body/page-"+page+"/<?php echo $_GET['catid']?>.html";
            })

            $('.next').click(function(){
                var page = $('.con-page').find('.on').html();
                if(page == <?php echo $data['totalPage']?>){
                    return false;
                }else{
                    page = parseInt(page)+1;
                }
                location.href ="/cn/dynamic/body/page-"+page+"/<?php echo $_GET['catid']?>.html";
            })
        </script>
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
        <div class="clearMB"></div>
    </div>
</div>