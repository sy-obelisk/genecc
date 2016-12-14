<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">订单模块</a> <span class="divider">/</span></li>
        <li class="active">订单管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">订单管理</a>
        </li>
        <?php
        foreach($block as $v) {
            ?>
            <?php
            if($v['value'] == 'add') {
                ?>
                <li class="dropdown pull-right">
                    <a href="<?php echo baseUrl?>/order/order/add">添加订单</a>
                </li>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </ul>
    <legend>订单</legend>
    <form action="<?php echo baseUrl?>/order/order/index/" method="get" class="form-horizontal">
        <table class="table">
            <tr>
                <td>
                    订单Id：
                </td>
                <td>
                    <input name="id" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['id'])?$_GET['id']:''?>"/>
                </td>
                <td>
                    下单时间：
                </td>
                <td>
                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="<?php echo isset($_GET['beginTime'])?$_GET['beginTime']:''?>"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="<?php echo isset($_GET['endTime'])?$_GET['endTime']:''?>"/>
                </td>
                <td>
                    订单编号：
                </td>
                <td>
                    <input class="input-small" name="orderNumber" size="25" type="text" value="<?php echo isset($_GET['orderNumber'])?$_GET['orderNumber']:''?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    用户Id：
                </td>
                <td>
                    <input name="userId" class="input-small" size="25" type="text" class="number" value="<?php echo isset($_GET['userId'])?$_GET['userId']:''?>"/>
                </td>
                <td>
                    订单状态：
                </td>
                <td>
                    <select name="status">
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == ''?'selected=selected':''?> value="">全部</option>
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == 1?'selected=selected':''?> value="1">未付款</option>
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == 2?'selected=selected':''?> value="2">已取消</option>
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == 3?'selected=selected':''?> value="3">已付款</option>
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == 4?'selected=selected':''?> value="4">配送中</option>
                        <option <?php echo isset($_GET['status']) && $_GET['status'] == 5?'selected=selected':''?> value="5">已完成</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" type="submit">提交</button>
                </td>
            </tr>
        </table>
    </form>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>订单编号</th>
                <th>用户Id</th>
                <th>收货人信息</th>
                <th>订单总计</th>
                <th>订单总优惠</th>
                <th>优惠详情</th>
                <th>运费</th>
                <th>总调价</th>
                <th>调价原因</th>
                <th>订单实付</th>
                <th>支付方式</th>
                <th>订单状态</th>
                <th>下单时间</th>
                <th>付款时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['orderNumber']?></td>
                    <td><?php echo $v['userId']?></td>
                    <td><?php echo $v['consignee']?></td>
                    <td><?php echo $v['totalMoney']?></td>
                    <td><?php echo $v['totalDis']?></td>
                    <td><?php echo $v['favorableDetails']?></td>
                    <td><?php echo $v['freight']?></td>
                    <td><?php echo $v['disCount']?></td>
                    <td><?php echo $v['disReason']?></td>
                    <td><?php echo $v['payable']?></td>
                    <td><?php echo $v['payType'] == 1?'在线支付':'线下支付'?></td>
                    <?php   switch($v['status'])
                    {
                        case 1:$status='未付款';break;
                        case 2:$status='已取消';break;
                        case 3:$status='已付款';break;
                        case 4:$status='配送中';break;
                        case 5:$status='已完成';break;
                    } ?>
                    <td><?php echo $status?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['createTime'])?></td>
                    <td><?php echo $v['payTime']?date("Y-m-d H:i:s",$v['payTime']):''?></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                            <?php if($val['value'] == 'delete') { ?>
                                    <a class="btn"
                                       href="javascript:;" onclick="checkDelete(<?php echo $v['id']?>)"><?php echo $val['name']?></a>
                                <?php
                                }else if($val['value'] != 'add'){
                                    ?>
                                    <a class="btn"
                                       href="<?php echo baseUrl ?>/order/order/<?php echo $val['value'] ?>?id=<?php echo $v['id'] ?>&url=<?php echo Yii::$app->request->getUrl() ?>"><?php echo $val['name'] ?></a>
                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </form>
    <div class="pagination pagination-right">
        <?php use yii\widgets\LinkPager;?>
        <?php echo LinkPager::widget([
            'pagination' => $page,
        ])?>
    </div>
</div>
<script type="text/javascript">
    function checkDelete(id){
        if(confirm("确定删除用户吗？删除后用户资料将不可恢复")){
            location.href = "/content/content/delete?url=<?php echo Yii::$app->request->getUrl()?>&id="+id;
        }

    }
    $(function() {
        $(".checkAll").change(function () {
            var sss = $(this).is(":checked");
            if(sss){
                $(".childCheck").prop("checked", true);
            }else{
                $(".childCheck").prop("checked", false);
            }
        })

        $(".push").on('click',function(){
            $("input[name='status']").val(1);
            $("#checkPush").submit();
        })
        $(".noPush").on('click',function(){
            $("input[name='status']").val(0);
            $("#checkPush").submit();
        })
    })
</script>