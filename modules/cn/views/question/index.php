<?php
use app\libs\Method;
?>
    <link rel="stylesheet" href="/cn/css/bootstrap.css"/>
    <link rel="stylesheet" href="/cn/css/studyingPublic.css"/>
    <link rel="stylesheet" href="/cn/css/quesAnswer-public.css"/>
    <link rel="stylesheet" href="/cn/css/quesAndAnswer.css"/>
    <link rel="stylesheet" href="/cn/css/index_second.css"/>
    <script type="text/javascript" src="/cn/js/bootstrap.js"></script>
    <script type="text/javascript" src="/cn/js/quesAnswer-public.js"></script>
<!------------另一种导航------------------>

<div style="clear: both"></div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="question-left">
                <div class="questionL-hd">
                    <p>发现</p>
                    <ul>

                        <li<?php if((isset($_GET['cat'])?$_GET['cat']:'1')==1){ ?> class="on" <?php } ?> ><a href="/cn/question/1-1.html">推荐</a></li>
                        <li<?php if((isset($_GET['cat'])?$_GET['cat']:'1')==2){ ?> class="on" <?php } ?>><a href="/cn/question/1-2.html">最新</a></li>
                        <li<?php if((isset($_GET['cat'])?$_GET['cat']:'1')==3){ ?> class="on" <?php } ?>><a href="/cn/question/1-3.html">等待回复</a></li>
                    </ul>
                </div>
                <div class="questionL-bd">
                    <ul>
                        <li>
                            <div class="bdUl">
                                <ul>
                                    <?php
                                    foreach($question['data'] as $v){ ?>
                                        <li>
                                            <div class="col-md-2 leftDefault">
                                                <div class="defaultImg">
                                                    <img src="<?php echo isset($v['image'])?$v['image']:'/cn/images/default.png' ?>" alt="图片">
                                                </div>
                                                <p><?php echo isset($v['username'])?$v['username']:'匿名'?></p>
                                            </div>
                                            <div class="col-md-10 rightInfo">
                                                <div class="col-md-1 leftQues"><span class="back01">问</span></div>
                                                <div class="col-md-11 rightFont">
                                                    <a href="/cn/question/<?php echo $v['id']?>.html"><?php echo $v['question']?></a>
                                                </div>
                                                <div style="clear: both;margin-bottom: 20px"></div>
                                                <div class="col-md-1 leftQues"><span class="back02">答</span></div>
                                                <div class="col-md-11 rightFont">
                                                    <?php if(isset($v['answer'][0]['content'])) { ?>
                                                        <p><?php echo $v['answer'][0]['content']?></p>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <a href="/cn/question/<?php echo $v['id']?>.html" class="orange">还没有人回答，直接回复</a>
                                                    <?php }?>
                                                    <span><?php echo isset($v['username'])?$v['username']:'匿名'?> 发起了问题 • <?php echo $v['follow']?>人关注 • <?php echo isset($v['answer'])?count($v['answer']): 0?>个回复 • <?php echo $v['browse']?>次浏览<?php if(isset($v['answer'][0]['addTime'])) {$gettime = new Method();$sj = time() - strtotime($v['answer'][0]['addTime']);echo " • ".$gettime->gmstrftimeA($sj);
                                                        } ?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
                                            <div style="clear: both"></div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!------------分页------------>
                            <div class="con-page">
                                <ul>
                                    <?php echo $question['pageStr']?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(".question-left").slide({titCell:".questionL-hd li",mainCell:".questionL-bd",trigger:"click"});
            </script>
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
<script type="text/javascript">
    $('.iPage').click(function(){
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        var page = $('.con-page').find('.on').html();
        location.href ="/cn/question/"+page+"-<?php echo isset($_GET['cat'])?$_GET['cat']:'1'?>.html";
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        location.href ="/cn/question/"+page+"-<?php echo (isset($_GET['cat'])?$_GET['cat']:'1')?>.html";
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $question['totalPage']?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        location.href ="/cn/question/"+page+"-<?php echo (isset($_GET['cat'])?$_GET['cat']:'1')?>.html";
    })
</script>

</body>
</html>