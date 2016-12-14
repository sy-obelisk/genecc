<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/user/index/index">订单模块</a> <span class="divider">/</span></li>
        <li class="active">订单管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">订单商品</a>
        </li>
    </ul>
    <legend>订单商品</legend>
<!--    <form action="--><?php //echo baseUrl?><!--/order/order/index/" method="get" class="form-horizontal">-->
<!--        <table class="table">-->
<!--            <tr>-->
<!--                <td>-->
<!--                    订单Id：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input name="id" class="input-small" size="25" type="text" class="number" value="--><?php //echo isset($_GET['id'])?$_GET['id']:''?><!--"/>-->
<!--                </td>-->
<!--                <td>-->
<!--                    下单时间：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input class="input-small Wdate" onclick="WdatePicker()" type="text" size="10"  name="beginTime" value="--><?php //echo isset($_GET['beginTime'])?$_GET['beginTime']:''?><!--"/> - <input class="input-small Wdate" onclick="WdatePicker()"  size="10" type="text" name="endTime"  value="--><?php //echo isset($_GET['endTime'])?$_GET['endTime']:''?><!--"/>-->
<!--                </td>-->
<!--                <td>-->
<!--                    订单编号：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input class="input-small" name="orderNumber" size="25" type="text" value="--><?php //echo isset($_GET['orderNumber'])?$_GET['orderNumber']:''?><!--"/>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    用户Id：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input name="userId" class="input-small" size="25" type="text" class="number" value="--><?php //echo isset($_GET['userId'])?$_GET['userId']:''?><!--"/>-->
<!--                </td>-->
<!--                <td>-->
<!--                    订单状态：-->
<!--                </td>-->
<!--                <td>-->
<!--                    <select name="status">-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == ''?'selected=selected':''?><!-- value="">全部</option>-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == 1?'selected=selected':''?><!-- value="1">未付款</option>-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == 2?'selected=selected':''?><!-- value="2">已取消</option>-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == 3?'selected=selected':''?><!-- value="3">已付款</option>-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == 4?'selected=selected':''?><!-- value="4">配送中</option>-->
<!--                        <option --><?php //echo isset($_GET['status']) && $_GET['status'] == 5?'selected=selected':''?><!-- value="5">已完成</option>-->
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <button class="btn btn-primary" type="submit">提交</button>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </form>-->
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>商品名称</th>
                <th>商品Id</th>
                <th>商品标签</th>
                <th>商品分类</th>
                <th>数量</th>
                <th>用户Id</th>
                <th>单价</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['contentName']?></td>
                    <td><?php echo $v['contentId']?></td>
                    <td><?php echo $v['contentTag']?></td>
                    <td><?php echo $v['catName']?></td>
                    <td><?php echo $v['num']?></td>
                    <td><?php echo $v['userId']?></td>
                    <td><?php echo $v['price']?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </form>
</div>
