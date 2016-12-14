
    <link rel="stylesheet" href="/cn/css/office-copy.css"/>
    <link rel="stylesheet" href="/cn/css/index_second.css"/>
    <script type="text/javascript" src="/cn/js/index_second.js"></script>
<div class="writ-top">
    <img src="/cn/images/office_topImg.jpg" alt="图片"/>
</div>
<div class="container">
    <div class="row">
        <div class="common-title">
            <div class="title-grey">
                <img src="/cn/images/office_title01.png" alt="左边的箭头" class="left-grey"/>
                感受不一样的文书创作流程
                <img src="/cn/images/office_title02.png" alt="右边的箭头" class="right-grey"/>
            </div>
        </div>
        <div class="writ_chuangz">
            <div class="col-md-4">
                <div class="chuan_com bg01">
                    <img src="/cn/images/writ_icon01.png" alt="图标"/>
                     <p>单科专业顾问深入了解客户背景，挖掘亮点</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chuan_com bg02">
                    <img src="/cn/images/writ_icon02.png" alt="图标"/>
                    <p>设计具有感染力的文书首段，反映申请人个性</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chuan_com bg03">
                    <img src="/cn/images/writ_icon03.png" alt="图标"/>
                    <p>结合专业特色，陈述客户优势与职业规划</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <div class="chuan_comT bg01">
                    <img src="/cn/images/writ_icon04.png" alt="图标"/>
                    <p>单专业顾问做第一次文章加工修改</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="chuan_comT bg02">
                    <img src="/cn/images/writ_icon05.png" alt="图标"/>
                    <p>客户意见反馈</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="chuan_comT bg03">
                    <img src="/cn/images/writ_icon06.png" alt="图标"/>
                    <p>专业顾问根据意见反馈做第二次修改再征求客户意见</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="chuan_comT bg04">
                    <img src="/cn/images/writ_icon07.png" alt="图标"/>
                    <p>雷哥网留学文书小组做最后修改和润色</p>
                </div>
            </div>
            <div class="clearfix"></div>
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
            <div class="clearfix"></div>
            <div class="con-page">
                <ul>
                    <?php echo $pageStr?>
                </ul>
            </div>
<!--            <div class="col-md-3">-->
<!--                <div class="outBorder">-->
<!--                    <img src="images" alt="文书图片"/>-->
<!--                    <h4>美国TOP50高端文书</h4>-->
<!--                    <p>美国留学申请全套文书，包含10所学校。</p>-->
<!--                    <a href="#">点击查看详情</a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="outBorder">-->
<!--                    <img src="images" alt="文书图片"/>-->
<!--                    <h4>美国TOP50高端文书</h4>-->
<!--                    <p>美国留学申请全套文书，包含10所学校。</p>-->
<!--                    <a href="#">点击查看详情</a>-->
<!--                </div>-->
<!--            </div>-->
            <div style="clear: both"></div>
        </div>
        <script type="text/javascript">
            $('.iPage').click(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                var page = $('.con-page').find('.on').html();
                var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
                location.href ="/cn/enact/writ/"+page+str+".html";
            })

            $('.prev').click(function(){
                var page = $('.con-page').find('.on').html();
                if(page == 1){
                    return false;
                }else{
                    page = parseInt(page)-1;
                }
                var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
                location.href ="/cn/enact/writ/"+page+str+".html";
            })

            $('.next').click(function(){
                var page = $('.con-page').find('.on').html();
                if(page == <?php echo $totalPage?>){
                    return false;
                }else{
                    page = parseInt(page)+1;
                }
                var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
                location.href ="/cn/enact/writ/"+page+str+".html";
            })
        </script>
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
                                 <div class="stu_thub">
                                     <img src="/cn/images/stu_xuey01.png" alt="学生头像" class="stu"/>
                                 </div>
                                 <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="col-md-2">
                             <div class="portrait">
                                 <div class="stu_thub">
                                     <img src="/cn/images/stu_xuey02.png" alt="学生头像" class="stu"/>
                                 </div>
                                 <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="col-md-2">
                             <div class="portrait">
                                 <div class="stu_thub">
                                     <img src="/cn/images/stu_xuey03.png" alt="学生头像" class="stu"/>
                                 </div>
                                 <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="col-md-2">
                             <div class="portrait">
                                 <div class="stu_thub">
                                     <img src="/cn/images/stu_xuey04.png" alt="学生头像" class="stu"/>
                                 </div>
                                 <img src="/cn/images/office_pupleTop.png" alt="箭头图标" class="tag"/>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="col-md-2">
                             <div class="portrait">
                                 <div class="stu_thub">
                                     <img src="/cn/images/stu_xuey05.png" alt="学生头像" class="stu"/>
                                 </div>
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
                                 在搜雷哥网留学的时候几乎没有任何负面消息，然后有打听了之前在申友做过的同学，大家评价都还是不错的。 结果也是没有让我失望，
                                 文书写的非常好，我有拿给我国外的老师看觉的写的是真心不错。 所以能拿到剑桥的录取，我个人觉的自己背景好很重要，优秀的文书也是功不可没。
                             </p>
                             <ul>
                                 <li>University of Cambridge</li>
                                 <li>Li.SR</li>
                             </ul>
                         </div>
                     </li>
                 </ul>
                 <ul>
                     <li>
                         <div class="studentInfo">
                             <p>
                                 雷哥网留学的文书老师很负责人，我是属于经历虽然比较多但是自己不知道怎么串起来的那种，
                                 就会显得文书有点乱，但最后文书老师把我的经历很好的串联，润色，文书质量很好，我很满意。
                             </p>
                             <ul>
                                 <li>Case Western Reserve University</li>
                                 <li>L.YH</li>
                             </ul>
                         </div>
                     </li>
                 </ul>
                 <ul>
                     <li>
                         <div class="studentInfo">
                             <p>
                                 我是西南财经大学保险会计专业的，我的实习经验倒是挺丰富的，参加过渣打银行的金融课，mcm建模大赛等等，这些经历在文书老师的重点包装下，
                                 我顺利取得加拿大麦克马斯特大学的offer， 奖学金3000加元，并且获得coop提供的6个月带薪实习名额，老师很厉害，很负责。
                             </p>
                             <ul>
                                 <li>McMaster University奖学金3000加元</li>
                                 <li>Qing .YC</li>
                             </ul>
                         </div>
                     </li>
                 </ul>
                 <ul>
                     <li>
                         <div class="studentInfo">
                             <p>
                                 都说世界名校难申请，但在留学的世界里没有铁定的定律。我的成绩在申请中不是很有的优势，但文书老师帮我写了一份很好的文书。在文书创作过程中，老师挖取了我在校内的金融应用比赛经历及半年的金融工作经验，
                                 进行着重包装，加大这些在申请中软性背景的优势。最后我拿到了亚洲金融第2的新大的录取，真的是太开心了，非常感谢文书老师的帮忙。
                             </p>
                             <ul>
                                 <li>National University of Singapore</li>
                                 <li>Liu.YD</li>
                             </ul>
                         </div>
                     </li>
                 </ul>
                 <ul>
                     <li>
                         <div class="studentInfo">
                             <p>
                                 我是在加拿大读的，老师给我写的文书非常对我的胃口，她把我对于北美洲的喜爱和在北美生活的各种见闻和感想都写到了文书里面，还写出了我对北美税收制度的想法，
                                 从而顺利地发展到我自己的个人职业规划。最重要的是这一篇文书让我拿到了多个学校的录取。谢谢老师哟！
                             </p>
                             <ul>
                                 <li>Depual University</li>
                                 <li>Chen.J</li>
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