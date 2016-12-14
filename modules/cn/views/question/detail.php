
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/quesAnswer-public.css"/>
    <link rel="stylesheet" href="/cn/css/quesAnswer-detail.css"/>
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
    <!-- 编辑器公式插件 -->
    <script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>

    <!-- 树形菜单选择 -->
    <link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
    <script type="text/javascript" src="/cn/js/quesAnswer-public.js"></script>
    <script type="text/javascript" src="/cn/js/quesAnswer-detail.js"></script>
<!------------另一种导航------------------>
<div style="clear: both"></div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
           <div class="question-left">
               <div class="answerTop">
                   <div class="col-md-2 leftImg">
                       <div class="headPortrait">
                           <img src="<?php echo $data[0]['image']?>" alt="默认头像"/>
                       </div>
                       <p><?php echo isset($data[0]['userName'])? $data[0]['userName'] : '匿名'?></p>
                   </div>
                   <div class="col-md-7">
                        <div class="col-md-1 leftIcon">
                            <span>问</span>
                        </div>
                        <div class="col-md-11 rightInfo">
                            <h4><?php echo $data[0]['question']?></h4>
                            <span><?php echo $data[0]['addTime']?></span>
                            <p><?php echo $data[0]['content']?></p>
                        </div>
                       <div style="clear: both"></div>
                   </div>
                   <div class="col-md-3">
                       <div class="sharePurple">分享到</div>
                       <!--分享插件-->
                       <div class="bshare-custom">
                           <a title="分享到QQ好友" class="bshare-qqim" href="javascript:void(0);"></a>
                           <a title="分享到微信" class="bshare-weixin" href="javascript:void(0);"></a>
                           <a title="分享到新浪微博" class="bshare-sinaminiblog"></a>

                       </div>
                       <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
                       <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
                   </div>
                   <div style="clear: both"></div>
               </div>
               <div class="answerBottom">
                   <h2>1个回复</h2>
                   <ul>
                       <?php
                       foreach($answer as $v) { ?>

                           <li>
                               <!--注释：data-num很重要 是用来记录回复后添加到哪个节点里面的，js中拼字符串把这个拼死的，套后台需要拼活的-->
                               <!--------------一级回复展示------------->
                               <?php if (!empty($v['adviser'])) { ?>
                                       <div class="topPurple">
                                           <div class="leftHead">
                                               <img src="<?php echo $v['adviser']['image'] ?>" alt="用户头像"/>
                                           </div>
                                           <h4><?php echo $v['adviser']['name'] ?></h4>
                                           <span><?php echo $v['adviser']['time'] ?></span>
                                       </div>
                                       <?php
                                   } else {
                                       ?>
                                       <div class="topPurple">
                                           <div class="leftHead">
                                               <img src="<?php echo $v['image'] ?>" alt="用户头像"/>
                                           </div>
                                           <h4><?php echo isset($v['username']) ? $v['username'] : '匿名' ?></h4>
                                           <span><?php echo $v['addTime'] ?></span>
                                       </div>
                                       <?php
                                   }
                               ?>
                               <div class="p-content">
                                   <?php echo $v['content'] ?>
                               </div>
                               <div class="controls">
                                   <ul>
                                       <li></li>
                                       <li onclick="replyAnswer(this)" data-num="0" value="<?php echo $v['id']?>">回复（<?php echo count($v['reply'])?>）</li>
                                   </ul>
                               </div>
                               <div style="clear: both"></div>

                               <!--------------二三级评论展示------------->
                               <?php
                               foreach($v['reply'] as $va) {
                                   if (!empty($va)) {
                                       ?>
                                       <div class="secondShow">
                                           <ul>
                                               <li>
                                                   <div class="secondComment">
                                                       <div class="col-md-1">
                                                           <div class="leftHead">
                                                               <img src="<?php echo $va['image'] ?>" alt="用户头像"/>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-11 replyRight">
                                                           <h4><?php echo isset($va['username']) ? $va['username'] : '匿名' ?>回复<?php echo isset($v['adviser']['name']) ? $v['adviser']['name'] : $v['username'] ?> <span><?php echo $va['addTime']?></span></h4>
                                                           <p><?php echo $va['content']?></p>
                                                           <div style="clear: both"></div>
                                                       </div>
                                                       <div style="clear: both"></div>
                                                   </div>
                                               </li>
                                           </ul>
                                       </div>
                                       <?php
                                   }
                               }
                               ?>
                           </li>
                           <?php
                       }
                       ?>
                   </ul>
                   <!--编辑器-->
                   <form action="/cn/question/answer" method="post">
                       <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
                       <input type="hidden" name="question" value="<?php echo $_GET['id']?>">
                   <textarea class="input-xxlarge" name="contents" rows="7" id="editor"></textarea>
                   <script>
                       var editor = UE.getEditor('editor');
                       $('.easyui-combotree').combotree({
                           onClick: function (node) {
                               $("input[name='extend[pid]']").val(node.id);
                           }
                       })
                       function judgeType(_this){
                           var val = $(_this).val();
                           if(val == 5){
                               $('#typeValue').show();
                           }else{
                               $('#typeValue').hide();
                           }
                       }

                       $('.requiredValue').change(function(){
                           var val = $(this).val();
                           if(val == 1){
                               $('#required').show();
                           }else{
                               $('#required').hide();
                           }
                       })
                   </script>
                   <script>
                       //实例化编辑器
                       var o_ueditorupload = UE.getEditor('j_ueditorupload',
                           {
                               autoHeightEnabled:false
                           });
                       o_ueditorupload.ready(function ()
                       {

                           o_ueditorupload.hide();//隐藏编辑器

                           //监听图片上传
                           o_ueditorupload.addListener('beforeInsertImage', function (t,arg)
                           {
                               $('.imageFile').val(arg[0].src);

                           });

                           /* 文件上传监听
                            * 需要在ueditor.all.min.js文件中找到
                            * d.execCommand("insertHtml",l)
                            * 之后插入d.fireEvent('afterUpfile',b)
                            */
                           o_ueditorupload.addListener('afterUpfile', function (t, arg)

                           {

                           });
                       });

                       //弹出图片上传的对话框
                       function upImage()
                       {
                           var myImage = o_ueditorupload.getDialog("insertimage");
                           myImage.open();
                       }
                       //弹出文件上传的对话框
                       //    function upFiles()
                       //    {
                       //        var myFiles = o_ueditorupload.getDialog("attachment");
                       //        myFiles.open();
                       //    }

                   </script>
                   <script type="text/plain" id="j_ueditorupload"></script>
                   <!--提交按钮-->
                   <input type="submit" value="提交" class="subBtn"/>
                   </form>
                   <div style="clear: both"></div>
               </div>
           </div>
        </div>
        <div class="col-md-3">
            <div class="question-right">
                <!-------------我要提问----------------->
                <div class="wantS">
                    <div class="inWhite">
                        <h4><?php echo $num?></h4>
                        <span>个问题已经被回答啦</span>
                        <div class="quizBtn" onclick="wantSay()">
                            <span>+</span>
                            <b>我要提问</b>
                        </div>
                    </div>
                </div>
                <!----向他提问----->
                <div class="hotRank">
                    <div class="hotTop">向他提问</div>
                    <div class="hotBot">
                        <ul>
                            <?php
                            if($answer_rank){
                            foreach($answer_rank as $v) { ?>
                                <li>
                                    <div class="col-md-4">
                                        <div class="hot-left">
                                            <img src="<?php echo $v['information']['image'] ?>" alt="顾问头像"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="hot-right">
                                            <h4><?php echo $v['information']['name'] ?></h4>

                                            <p>已回答<?php echo $v['num'] ?>个问题</p>
                                            <a href="javascript:void(0);" value="<?php echo $v['information']['id'] ?>"
                                               onclick="wantSay(this)">向他提问</a>
                                        </div>
                                    </div>
                                    <div style="clear: both"></div>
                                </li>
                                <?php
                            }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearB"></div>
    </div>
</div>

<!----------------我要提问弹窗------------------>
<div class="answerMask">
    <div class="answerWhite">
        <form action="/cn/question/question" method="post">
            <h4>
                <img src="images/answer_wenhao.png" alt="问号图标">
                发起问题</h4>
            <input type="hidden" id="appoint" name="appointid" value="">
            <input type="text" name="question" placeholder="写下你的问题"/>
            <textarea name="contents" placeholder="问题背景、条件等详细信息"></textarea>
            <div class="btnGroup">
                <input type="button" value="取消" onclick="closeAnswer()"/>
                <input type="submit" value="提交问题"/>
            </div>
        </form>
    </div>
</div>

<!----------------------回复弹窗----------------->

<div class="replyMask">
    <form action="/cn/question/answer" method="post">
        <div class="replyWhite">
            <h4>回复<span onclick="closeReply()">×</span></h4>
            <textarea name="contents" placeholder="回复："></textarea>
            <input type="hidden" id="answer" name="pid" value="">
            <input type="hidden" name="question" value="<?php echo $_GET['id']?>">
            <input type="hidden" name="type" value="3">
            <input type="submit" value="提交" data-num="0"/>
        </div>
    </form>
</div>
