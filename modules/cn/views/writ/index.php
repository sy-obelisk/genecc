<link rel="stylesheet" href="/cn/css/office-copy.css"/>
<div class="container">
    <div class="row">
        <div class="writ-top">
            <img src="/cn/images/office_topImg.jpg" alt="图片"/>
        </div>
        <div class="common-title">
            <div class="title-grey">
                <img src="/cn/images/office_title01.png" alt="左边的箭头" class="left-grey"/>
                购买流程
                <img src="/cn/images/office_title02.png" alt="右边的箭头" class="right-grey"/>
            </div>
        </div>
        <div class="purchase">
            <ul>
                <li>
                    <div class="purple">01</div>
                    <p>立即下单<br>购买服务</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">02</div>
                    <p>提交个人<br>信息资料</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">03</div>
                    <p>联系商家<br>详细沟通</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">04</div>
                    <p>确认开始<br>文书写作</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">05</div>
                    <p>写作完成<br>提交初稿</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">06</div>
                    <p>多次沟通<br>提交定稿</p>
                </li>
                <li>
                    <img src="/cn/images/office_greyJ.png" alt="灰色箭头"/>
                </li>
                <li>
                    <div class="purple">07</div>
                    <p>入学成功<br>全额返现</p>
                </li>
            </ul>
        </div>
        <div class="common-title">
            <div class="title-grey">
                <img src="/cn/images/office_title01.png" alt="左边的箭头" class="left-grey"/>
                文书推荐
                <img src="/cn/images/office_title02.png" alt="右边的箭头" class="right-grey"/>
            </div>
        </div>
        <div class="Director">
<?php
$data  = \app\modules\cn\models\Content::getClass(['fields' => 'answer','pageSize' => 4,'category' => '150,152']);
    foreach($data as $v) {
        ?>
        <div class="col-md-3">
            <div class="outBorder">
                <img src="<?php echo $v['image']?>" alt="文书图片"/>
                <h4><?php echo $v['name']?></h4>

                <p><?php echo $v['answer']?></p>
                <a href="/goods/<?php echo $v['id']?>.html">点击查看详情</a>
            </div>
        </div>
    <?php
    }
?>
            <div style="clear: both"></div>
        </div>
        <div class="common-title">
            <div class="title-grey">
                <img src="/cn/images/office_title01.png" alt="左边的箭头" class="left-grey"/>
                学生们说
                <img src="/cn/images/office_title02.png" alt="右边的箭头" class="right-grey"/>
            </div>
        </div>

        <div class="studentSay">
            <div class="studentSayHd">
                <ul>
                    <li>
                        <div class="col-md-2">
                            <div class="portrait">
                                <img src="images" alt="学生头像" class="stu"/>
                                <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-md-2">
                            <div class="portrait">
                                <img src="images" alt="学生头像" class="stu"/>
                                <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-md-2">
                            <div class="portrait">
                                <img src="images" alt="学生头像" class="stu"/>
                                <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-md-2">
                            <div class="portrait">
                                <img src="images" alt="学生头像" class="stu"/>
                                <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-md-2">
                            <div class="portrait">
                                <img src="images" alt="学生头像" class="stu"/>
                                <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="clear: both"></div>
            <div class="studentSayBd">
                <ul>
                    <li>
                        <div class="studentInfo">
                            <p>
                                文书收到啦....好开心好开心...质量超高有木有啊...3天初稿就出来了..2次微调,
                                终于完成了我的整套文书..强烈推荐我的文书老师，谢老师啊....各位路过看到我的小伙伴，
                                不要怀疑，点这家客服找亲哥，绝对总统级别的服务！！！！
                            </p>
                            <ul>
                                <li>The University of St Andrews</li>
                                <li>鞠同学</li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <div class="studentInfo">
                            <p>
                                jkjk文书收到啦....好开心好开心...质量超高有木有啊...3天初稿就出来了..2次微调,
                                终于完成了我的整套文书..强烈推荐我的文书老师，谢老师啊....各位路过看到我的小伙伴，
                                不要怀疑，点这家客服找亲哥，绝对总统级别的服务！！！！
                            </p>
                            <ul>
                                <li>The University of St Andrews</li>
                                <li>鞠同学</li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <div class="studentInfo">
                            <p>
                                bnjbnmj文书收到啦....好开心好开心...质量超高有木有啊...3天初稿就出来了..2次微调,
                                终于完成了我的整套文书..强烈推荐我的文书老师，谢老师啊....各位路过看到我的小伙伴，
                                不要怀疑，点这家客服找亲哥，绝对总统级别的服务！！！！
                            </p>
                            <ul>
                                <li>The University of St Andrews</li>
                                <li>鞠同学</li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <div class="studentInfo">
                            <p>
                                k;lk;l文书收到啦....好开心好开心...质量超高有木有啊...3天初稿就出来了..2次微调,
                                终于完成了我的整套文书..强烈推荐我的文书老师，谢老师啊....各位路过看到我的小伙伴，
                                不要怀疑，点这家客服找亲哥，绝对总统级别的服务！！！！
                            </p>
                            <ul>
                                <li>The University of St Andrews</li>
                                <li>鞠同学</li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <div class="studentInfo">
                            <p>
                                gfhg文书收到啦....好开心好开心...质量超高有木有啊...3天初稿就出来了..2次微调,
                                终于完成了我的整套文书..强烈推荐我的文书老师，谢老师啊....各位路过看到我的小伙伴，
                                不要怀疑，点这家客服找亲哥，绝对总统级别的服务！！！！
                            </p>
                            <ul>
                                <li>The University of St Andrews</li>
                                <li>鞠同学</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".studentSay").slide({titCell:".studentSayHd li",mainCell:".studentSayBd",trigger:"mouseover",effect:"fold"});
        </script>
        <div class="common-title">
            <div class="title-grey">
                <img src="/cn/images/office_title01.png" alt="左边的箭头" class="left-grey"/>
                我们的优势
                <img src="/cn/images/office_title02.png" alt="右边的箭头" class="right-grey"/>
            </div>
        </div>

        <div class="advantage">
            <div class="col-md-3 col-md-offset-1">
                <div class="commonAdv adv01">
                    <h2>严审核</h2>
                    <p>只要靠谱的文书</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="commonAdv adv02">
                    <h2>时间快</h2>
                    <p>标准化服务流程</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="commonAdv adv03">
                    <h2>有保障</h2>
                    <p>申请全拒绝信全额退</p>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>

    </div>
</div>
