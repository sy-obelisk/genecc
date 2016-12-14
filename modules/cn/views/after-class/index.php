<link rel="stylesheet" href="/cn/css/index_second.css"/>
<script type="text/javascript" src="/cn/js/index_second.js"></script>
<!--二级导航-->
<div class="secondNav">
    <ul>
        <li><a href="/">留学商城</a></li>
        <li>&gt;</li>
        <li><a href="#">增值服务</a></li>
    </ul>
</div>
<!--灰色选择类别-->
<div class="greyChoose">
    <ul>
        <li class="diffLi">课程分类：</li>
        <li  data-value="0" class="<?php echo isset($_GET['category'])&&$_GET['category']==0?'on':''?> category diffLi" diff-value='1'>全部</li>
        <?php
        $category = \app\modules\cn\models\Category::find()->where("pid=165")->orderBy('sort DESC')->all();
        foreach($category as $v) {
            ?>
            <li data-value="<?php echo $v['id']?>" class="<?php echo isset($_GET['category'])&&strstr($_GET['category'],"{$v['id']}")?'on':''?> category"><?php echo $v['name']?></li>
        <?php
        }
        ?>
    </ul>
</div>
<!--按照什么搜索-->
<div class="synthesize">
    <ul>
        <li><a href="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-<?php echo isset($_GET['page'])?$_GET['page']:1?>.html">综合</a></li>
        <li><a href="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-<?php echo isset($_GET['page'])?$_GET['page']:1?>/buyNum-<?php echo isset($_GET['buyNum'])&&$_GET['buyNum'] == 1?2:1?>.html">销量 <?php if(!isset($_GET['buyNum'])){echo '';}elseif($_GET['buyNum'] == 1){echo '<i class="fa  fa-long-arrow-down"></i>';}else{echo '<i class="fa  fa-long-arrow-up"></i>';}?></a></li>
        <li><a href="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-<?php echo isset($_GET['page'])?$_GET['page']:1?>/price-<?php echo isset($_GET['price'])&&$_GET['price'] == 1?2:1?>.html">价格 <i class="fa  fa-caret-up <?php echo isset($_GET['price'])&&$_GET['price'] == 2?'blue':''?>"></i><i class="fa  fa-caret-down <?php echo isset($_GET['price'])&&$_GET['price'] == 1?'blue':''?>"></i></a></li>
        <li><a href="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-<?php echo isset($_GET['page'])?$_GET['page']:1?>/time-<?php echo isset($_GET['time'])&&$_GET['time'] == 1?2:1?>.html">最新 <?php if(!isset($_GET['time'])){echo '';}elseif($_GET['time'] == 1){echo '<i class="fa  fa-long-arrow-down"></i>';}else{echo '<i class="fa  fa-long-arrow-up"></i>';}?></a></li>
    </ul>
</div>
<!--内容部分-->
<div class="allContent">
    <div class="con-font">
        <ul>
            <?php
            foreach($data as $v) {
                ?>
                <li>
                    <h2><?php echo $v['name']?></h2>

                    <p><?php echo $v['answer']?></p>
                    <h4>￥<?php echo $v['price']?></h4>
                    <strong>原价￥<?php echo $v['originalPrice']?></strong><br>
                    <a href="/goods/<?php echo $v['id']?>.html">查看详情</a>
                    <a href="#">立即咨询</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="con-page">
        <ul>
            <?php echo $pageStr?>
        </ul>
        <?php
        if($totalPage>1) {
            ?>
            <select onchange="selectPage(this)">
                <?php
                for ($i = 1; $i <= $totalPage; $i++) {
                    ?>
                    <option <?php echo $page==$i?'selected':''?> value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
                }
                ?>
            </select>
        <?php
        }
        ?>
        <div style="clear: both"></div>
    </div>
</div>
<script type="text/javascript">

    function selectPage(_this){
        var page = $(_this).val();
        var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
        location.href ="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-"+page+str+".html";
    }

    function clickClassify(){
        var str='',allHtml='';
        var _that=$(this);//点击的li对象
        if(_that.attr("diff-value")=='1'){//留学目标,点击全部
            $(_that).siblings().removeClass("on");
        } else{//点击除了全部和第一个li
            $(this).siblings(".diffLi").removeClass("on");
        }
        _that.addClass("on");
        var category = '';
        $('.category.on').each(function(){
            var id = $(this).attr('data-value');
            category += id+',';
        })
        category = category.substr(0,category.length-1);
        if(category==''){
            category = 0;
        }
        location.href ="/after-class/category-"+category+"/page-1"+".html"
    }

    $('.iPage').click(function(){
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
        var page = $('.con-page').find('.on').html();
        var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
        location.href ="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-"+page+str+".html";
    })

    $('.prev').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == 1){
            return false;
        }else{
            page = parseInt(page)-1;
        }
        var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
        location.href ="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-"+page+str+".html";
    })

    $('.next').click(function(){
        var page = $('.con-page').find('.on').html();
        if(page == <?php echo $totalPage?>){
            return false;
        }else{
            page = parseInt(page)+1;
        }
        var str = "<?php if(isset($_GET['buyNum'])){echo "/buyNum-{$_GET['buyNum']}";}elseif(isset($_GET['price'])){echo "/price-{$_GET['price']}";}elseif(isset($_GET['time'])){echo "/time-{$_GET['time']}";}else{echo "";}?>";
        location.href ="/after-class/category-<?php echo isset($_GET['category'])?$_GET['category']:0?>/page-"+page+str+".html";
    })
</script>
