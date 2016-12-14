<script type="text/javascript" src="/cn/js/jquery1.42.min.js"></script>
<script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<h1>收货人信息</h1>
<form method="post" id="shopCart" action="">
    <div>
        <div>
            <input onclick="addConsignee()" type="button" value="新增收货人">
        </div>
        <?php
            if(count($consignee)>0) {
                ?>
                <table id="consignee_list">
                    <tr>
                        <td></td>
                        <td>姓名</td>
                        <td>地址</td>
                        <td>联系电话</td>
                        <td>操作</td>
                    </tr>
                    <?php foreach ($consignee as $v) { ?>
                        <tr>
                            <td><input class="consignee" type="radio" value="<?php echo isset($v['id']) ? $v['id'] : '' ?>" name="consignee">
                            </td>
                            <td><?php echo $v['name'] ?></td>
                            <td><?php echo $v['address'] ?></td>
                            <td><?php echo $v['phone'] ?></td>
                            <td>
                                <a data-value="<?php echo $v['id']?>" onclick="deleteConsignee(this)" href="javascript:;">删除</a>
                                <a data-value="<?php echo $v['id']?>" onclick="editConsignee(this)" href="javascript:;">编辑</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            }else {
                ?>
                <div>请添加收货人信息</div>
            <?php
            }
        ?>
        <div id="consignee_add" style="display: none">
            <input type="text" name="name" placeholder="姓名" value="">
            <input type="text" name="address" placeholder="地址" value="">
            <input type="text" name="phone" placeholder="联系电话" value="">
            <input type="hidden" name="id" value="">
            <input type="button" value="保存" onclick="saveConsignee()">
        </div>
    </div>
</form>
<h1>支付方式</h1>
<div>
    <input type="radio" class="payType" checked name="payType" value="1">在线支付
</div>
<h1>商品详情</h1>
<div>
    <table>
        <tr>
            <td>课程介绍</td>
            <td>单价</td>
            <td>数量</td>
            <td>优惠</td>
        </tr>

        <tr>
            <?php foreach ($goods as $v) { ?>
        <tr>
            <td><?php echo $v['contentName'] ?></br><?php echo $v['tag'] ?></td>
            <td><?php echo $v['price'] ?></td>
            <td><?php echo $v['num'] ?></td>
            <td><?php echo $v['fStr'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tr>

    </table>
</div>
<div>
    <h6>总计：<?php echo $totalMoney?></h6>
    <h6>共优惠：-<?php echo $totalDis?></h6>
    <h6>运费：0.00</h6>
    <h6>应付：<?php echo $totalMoney-$totalDis?></h6>
</div>
<div><input onclick="subOrder()" type="button" value="提交订单"></div>
<script type="text/javascript">
    //添加收货人
    function addConsignee(){
        $('#consignee_add').show();
    }
    //保存收货人
    function saveConsignee(){
        var name = $('input=[name="name"]').val();
        var address = $('input=[name="address"]').val();
        var phone = $('input=[name="phone"]').val();
        var id = $('input=[name="id"]').val();
        $.post("/pay/api/save-consignee",{id:id,name:name,address:address,phone:phone},function(re){
            alert(re.message);
            if(re.code == 1){
//                $('#consignee_add').hide('');
//                $('input=[name="name"]').val('');
//                $('input=[name="address"]').val('');
//                $('input=[name="phone"]').val('');
//                var str = "";
//                str+='<tr>';
//                str+='<td><input type="radio" value="'+re.id+'" name="consignee">';
//                str+='</td>';
//                str+='<td>'+name+'</td>';
//                str+='<td>'+address+'</td>';
//                str+='<td>'+phone+'</td>';
//                str+='<td>';
//                str+='<a href="javascript:;">删除</a>';
//                str+='<a href="javascript:;">编辑</a>';
//                str+='</td>';
//                str+='</tr>';
//                $('#consignee_list').append(str);
                window.location.reload();
            }
        },'json')
    }

    //编辑收货人信息
    function editConsignee(_this){
        var id = $(_this).attr('data-value');
        var name = $(_this).parent().prev().prev().prev().html();
        var address = $(_this).parent().prev().prev().html();
        var phone = $(_this).parent().prev().html();
        $('input=[name="name"]').val(name);
        $('input=[name="address"]').val(address);
        $('input=[name="phone"]').val(phone);
        $('input=[name="id"]').val(id);
        $('#consignee_add').show();
    }

    //删除收货人信息
    function deleteConsignee(_this){
        var id = $(_this).attr('data-value');
        $.post("/pay/api/delete-consignee",{id:id},function(re){
            alert(re.message);
            if(re.code == 1){
                $(_this).closest('tr').remove();
            }
        },'json')
    }

    /**
     * 提交订单
     */
    function subOrder(){
        var consignee = $('.consignee:checked').val();
        if(consignee == undefined){
            alert('请选择收货人');
            return false;
        }
        var payType = $('.payType:checked').val();
        if(payType == undefined){
            alert('请选择支付方式');
            return false;
        }
        $.post("/pay/api/sub-order",{consignee:consignee,payType:payType},function(re){
            alert(re.message);
            if(re.code == 1){
                window.location.href="/pay/order/pay?orderId="+re.orderId;
            }
        },'json')
    }
</script>
