
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/counselor-details.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
    <script type="text/javascript" src="/cn/js/counselor-details.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>
<div class="topPurple">
    <div class="container">
        <div class="row">
            <?php
            $Ranking = \app\modules\cn\models\Content::getClass(['fields' => 'answer,alternatives,article,listeningFile,cnName,numbering，A','where' =>'c.id='.$_GET['contentid']]);
            ?>
             <div class="col-md-7">
                 <div class="teacher-left">
                     <div class="col-md-3">
                         <div class="teacherImg">
                             <img src="<?php echo $Ranking[0]['image']?>" alt="老师头像"/>
                         </div>
                     </div>
                     <div class="col-md-9">
                         <div class="teacherInfo">
                             <h1><?php echo $Ranking[0]['name']?><span><?php echo $Ranking[0]['A']?></span></h1>
                             <p><?php echo $Ranking[0]['alternatives']?>;从业<?php echo $Ranking[0]['article']?>年</p>
                             <a href="#">预约咨询</a>
                         </div>
                     </div>
                     <div style="clear: both"></div>
                 </div>
             </div>
             <div class="col-md-5">
                 <div class="teacher-right">
                     <div class="col-md-4">
                         <div class="commonCircle cir-back01">
                             <div>
                                 <h4><?php echo $Ranking[0]['listeningFile']?>份</h4>
                                 <p>获取录取通知书</p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="commonCircle cir-back02">
                             <div>
                                 <h4><?php echo $Ranking[0]['cnName']?>%</h4>
                                 <p>留学申请成功率</p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="commonCircle cir-back03">
                             <div>
                                 <h4><?php echo $Ranking[0]['numbering']?>分</h4>
                                 <p>学生印象评分</p>
                             </div>
                         </div>
                     </div>
                     <div style="clear: both"></div>
                 </div>
             </div>
             <div style="clear: both"></div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="consultants-left">
                <div class="navPurple">
                    <ul>
                        <li class="on" data-ids="individual">顾问介绍</li>
                        <li data-ids="ServiceCase">近期服务案例（<?php echo !empty($caseList)? count($caseList):'0'?>）</li>
                        <li data-ids="hisAnswer">TA的回答（<?php echo !empty($answer)? count($answer) : '0'?>）</li>
                    </ul>
                </div>
                <!--个人简介-->
                <div class="individual" id="individual">
                    <h2>个人简介</h2>
                    <p><?php echo $data[0]['answer']?></p>
                </div>
                <!--近期服务案例-->
                <div class="ServiceCase" id="ServiceCase">
                    <h2>近期服务案例</h2>
                    <ul>
                        <?php
                        if($caseList){
                        foreach($caseList as $v) {
                            ?>
                            <li>
                                <div class="col-md-1 case-left">
                                    <img src="/cn/images/counselorD_college.png" alt="大学图片">
                                </div>
                                <div class="col-md-8 case-center">
                                    <h4><?php echo $v[0]['problemComplement']; ?></h4>

                                    <p><?php echo $v[0]['article']; ?></p>

                                    <p><?php echo $v[0]['listeningFile']; ?></p>
                                </div>
                                <div class="col-md-3 case-right">
                                    <ul>
                                        <li>客户：<?php echo $v[0]['cnName']; ?></li>
                                        <li>毕业院校：<?php echo $v[0]['numbering']; ?></li>
                                        <li>硬件条件：<?php echo $v[0]['sentenceNumber']; ?></li>
                                    </ul>
                                </div>
                                <div style="clear: both"></div>
<!--                                <div class="grey-bot">-->
<!--                                    <div class="shao">-->
<!--                                        <span class="put-text">--><?php //echo $v[0]['duration']; ?><!--</span>-->
<!--                                        <span class="look-more-shao" onclick="chakan(this)"> 查看更多</span>-->
<!--                                    </div>-->
<!--                                    <div class="duo">-->
<!--                                        <span class="many-text">--><?php //echo $v[0]['duration']; ?><!--</span>-->
<!--                                        <span class="look-more" onclick="shouqi(this)"> 收起</span>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="grey-bot">
                                    <div class="commonSee">
                                        <!--记录最开始的字符-->
                                        <div class="oldH"><?php echo $v[0]['duration']; ?></div>
                                        <!--记录截取之后的字符-->
                                        <div class="content"><?php echo $v[0]['duration']; ?></div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        }
                        ?>
                    </ul>
                </div>
                  <!--TA的回答-->
                <div class="hisAnswer" id="hisAnswer">
                    <h2>TA的回答</h2>
                    <ul>
                        <?php
                        if($answer){
                        foreach($answer as $v) { ?>
                            <li>
                                <div class="col-md-1 his-left">
                                    <img src="/cn/images/counselor_defaultImg.png" alt="图片">
                                </div>
                                <div class="col-md-11">
                                    <div class="his-right">
                                        <h4><?php echo $v['question'] ?></h4>

                                        <p><?php echo $v['content'] ?></p>
                                        <a href="/cn/question/<?php echo $v['pid'] ?>.html">查看更多</a>

                                        <div style="clear: both"></div>
                                        <span><?php echo $v['addtime'] ?></span>
                                    </div>
                                </div>
                                <div style="clear: both"></div>
                            </li>
                            <?php
                        }
                        }
                        ?>
                    <a href="#" class="loadMore">加载更多...</a>
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="consultants-right">
                <div class="consuTop">可能感兴趣的大学</div>
                <div class="consuBot">
                    <ul>
                        <div class="interestSchool">
                            <ul>
                                <?php foreach($schools as $key=>$v){ ?>
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
<!--                        <li>-->
<!--                            <div class="col-md-6 conm_l rightB">-->
<!--                                <h4>美国本科</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>服务经验</p>-->
<!--                                    <span><b>9</b>年</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6 conm_l leftM">-->
<!--                                <h4>&nbsp;</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>学生总数</p>-->
<!--                                    <span><b>303</b>人</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div style="clear: both"></div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="col-md-6 conm_l rightB">-->
<!--                                <h4>美国高中</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>服务经验</p>-->
<!--                                    <span><b>9</b>年</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6 conm_l leftM">-->
<!--                                <h4>&nbsp;</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>学生总数</p>-->
<!--                                    <span><b>303</b>人</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div style="clear: both"></div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="col-md-6 conm_l rightB">-->
<!--                                <h4>美国研究生</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>服务经验</p>-->
<!--                                    <span><b>9</b>年</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6 conm_l leftM">-->
<!--                                <h4>&nbsp;</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>学生总数</p>-->
<!--                                    <span><b>303</b>人</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div style="clear: both"></div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="col-md-6 conm_l rightB">-->
<!--                                <h4>美国研究生</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>服务经验</p>-->
<!--                                    <span><b>9</b>年</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6 conm_l leftM">-->
<!--                                <h4>&nbsp;</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>学生总数</p>-->
<!--                                    <span><b>303</b>人</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div style="clear: both"></div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="col-md-6 conm_l rightB">-->
<!--                                <h4>美国研究生</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>服务经验</p>-->
<!--                                    <span><b>9</b>年</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6 conm_l leftM">-->
<!--                                <h4>&nbsp;</h4>-->
<!--                                <div class="col-md-2">-->
<!--                                    <img src="/cn/images/counselorD_starG.png" alt="星星图标"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-10">-->
<!--                                    <p>学生总数</p>-->
<!--                                    <span><b>303</b>人</span>-->
<!--                                </div>-->
<!--                                <div style="clear: both"></div>-->
<!--                            </div>-->
<!--                            <div style="clear: both"></div>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearB"></div>
    </div>
</div>