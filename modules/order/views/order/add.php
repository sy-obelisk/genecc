<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <form action="/user/user/add-block" method="post">
        <div class="control-group">
            <label for="modulename" class="control-label">选择商品</label>
            <div class="controls">
                <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" multiple class="content easyui-combotree">
                </select><br/><br/>
                <input type="text" id="content"><input type="button" value="搜索内容" onclick="searchContent()">
                <select id="category">
                    <option value="151">申请服务</option>
                    <option value="152">文书服务</option>
                    <option value="153">签证服务</option>
                    <option value="154">实习服务</option>
                    <option value="155">在线课程</option>
                    <option value="165">课后服务</option>
                    <option value="170">优惠券</option>
                </select><input type="button" value="搜索分类" onclick="searchCategory()">
        </div>
        <div class="control-group">
            <label for="modulename" class="control-label">商品展示</label>
            <div class="controls">
                <ul id="goodsDetails">
<!--                    <li><input type="text" class="num"></li>-->
                </ul>
            </div>
        <div class="control-group">
            <label for="modulename" class="control-label">选择用户</label>
            <div class="controls">
                <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" class="user easyui-combotree">
                </select><br/><br/>
                <input type="text" id="user"><input type="button" value="搜索用户" onclick="searchUser()">
            </div>
        </div>

        <div id="user_consignee" class="control-group" style="display: none">
            <label for="modulename" class="control-label">选择收货人</label>
            <div class="controls">
                <select style="width: 400px" id="contentcatid" msg="您必须选择一个分类" class="consignee easyui-combotree">
                </select><br/><br/>
            </div>
            <div id="add_consignee"><input type="text" placeholder="姓名" id="consignee_name">-<input type="text" placeholder="地址" id="consignee_address">-<input type="text" placeholder="联系电话" id="consignee_phone"></div>
            <input type="button" value="添加收货人" onclick="addConsignee()">
        </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单总价格</label>
                <div class="controls">
                   <input type="text" class="totalMoney" name="disMoney" value="">
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单优惠金额</label>
                <div class="controls">
                    <input type="text" class="totalDis" name="disMoney" value="0">
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单优惠详情</label>
                <div class="controls">
                    <textarea  class="favorableDetails" style="width: 300px;height: 150px;"></textarea>
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单运费</label>
                <div class="controls">
                    <input type="text" class="freight" name="disMoney" value="0">
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单实付金额</label>
                <div class="controls">
                    <input type="text" class="payable" name="disMoney" value="">
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">支付方式</label>
                <div class="controls">
                    <select class="payType">
                        <option  value="1">在线支付</option>
                        <option  value="2">线下支付</option>
                    </select>
                </div>
            </div>

            <div class="control-group" >
                <label for="modulename" class="control-label">订单状态</label>
                <div class="controls">
                    <select class="status">
                        <option  value="1">未付款</option>
                        <option  value="2">已取消</option>
                        <option  value="3">已付款</option>
                        <option  value="4">配送中</option>
                        <option  value="5">已完成</option>
                    </select>
                </div>
            </div>

        <div class="control-group">
            <div class="controls">
                <input name="userId" type="hidden" value="">
                <input name="consignee" type="hidden" value="">
                <input name="goodsStr" type="hidden" value="">
                <input type="button"  onclick="subOrder()" class="btn btn-primary" value="提交">
            </div>
        </div>
    </div>
    </form>
</div>
<script>

function searchContent(){
    var content = $('#content').val();
    $('.content').combotree({
        url:'/order/api/search-content?keywords='+content+'&type=1',
        method:'get',
        cascadeCheck:false
    });
}

function searchCategory(){
    var category = $('#category').val();
    $('.content').combotree({
        url:'/order/api/search-content?keywords='+category+'&type=2',
        method:'get',
        cascadeCheck:false
    });
}

    function searchUser(){
        var keywords = $('#user').val();
        $('.user').combotree({
            url:'/order/api/search-user?keywords='+keywords,
            method:'get',
            cascadeCheck:false
        });
    }

    function addConsignee(){
        var name = $("#consignee_name").val();
        var address = $("#consignee_address").val();
        var phone = $("#consignee_phone").val();
        if(name == '' || name== '姓名' || address == '' || address== '地址' || phone == '' || phone== '联系电话'){
            alert('请填写完整的收货人信息');
            return false;
        }
        var userId = $('.user').combotree('getValue');
        $.post("/order/api/add-consignee",{name:name,address:address,phone:phone,userId:userId},function(re){
            $('.consignee').combotree({
                url:'/order/api/search-consignee?userId='+userId,
                method:'get',
                cascadeCheck:false
            });
        },'json')
    }

    $('.user').combotree({
        onClick: function (node) {
            $("input[name='userId']").val(node.id);
            $('#user_consignee').show();
            $('.consignee').combotree({
                url:'/order/api/search-consignee?userId='+node.id,
                method:'get',
                cascadeCheck:false
            });
        }
    })
$('.consignee').combotree({
    onClick: function (node) {
        $("input[name='consignee']").val(node.id);
    }
})
$('.content').combotree({
    onCheck:function(newValue,oldValue){
        var goodsStr = $('.easyui-combotree').combotree('getValues');
        $("input[name='goodsStr']").val(goodsStr);
        $.post('/order/api/get-goods',{goodsStr:goodsStr},function(re){
            var str = '';
            for(i=0;i<re.goods.length;i++){
                str += '<li><img src="'+re.goods[i].image+'"><span>'+re.goods[i].name+'</span><input type="text" class="num" name="num[]" value="1"></li>'
            }
            $('#goodsDetails').html(str);
            $('.totalMoney').val(re.price);
        },'json')

    }
});

    $("body").on("keyup",".num",function(){
            var goodsStr = $('.easyui-combotree').combotree('getValues');
        var num = new Array();
        $('.num').each(function(){
            if($(this).val() == ''){
                var number = 0;
            }else{
                var number = $(this).val();
            }
            num.push(number)

        })
        $.post('/order/api/get-goods',{goodsStr:goodsStr,num:num},function(re){
            $('.totalMoney').val(re.price);
        },'json')
    })

    function subOrder(){
        var goods = $('.easyui-combotree').combotree('getValues');
        if(goods == ''){
            alert('请选择商品');
            return false;
        }
        var userId = $('.user').combotree('getValue');
        if(userId == ''){
            alert('请选择用户');
            return false;
        }
        var consignee = $('.consignee').combotree('getValue');
        if(consignee == ''){
            alert('请选择收货人');
            return false;
        }
        var totalMoney = $('.totalMoney').val();
        if(totalMoney == ''){
            alert('请输入订单总金额');
            return false;
        }
        var totalDis = $('.totalDis').val();
        var favorableDetails = $('.favorableDetails').html();
        var freight = $('.freight').val();
        var payable = $('.payable').val();
        if(payable == ''){
            alert('请输入订单实付金额');
            return false;
        }
        var payType = $('.payType').val();
        var status = $('.status').val();
        var num = new Array();
        $('.num').each(function(){
            if($(this).val() == ''){
                alert('请输入商品数量');
                return false;
            }else{
                var number = $(this).val();
            }
            num.push(number)

        })
        $.post('/order/api/add-order',{num:num,goods:goods,userId:userId,consignee:consignee,totalMoney:totalMoney,totalDis:totalDis,favorableDetails:favorableDetails,freight:freight,payable:payable,payType:payType,status:status},function(re){
            alert(re.message)
        if(re.code == 1){
            window.location.href="/order/order/index";
        }
        },'json')

    }
</script>