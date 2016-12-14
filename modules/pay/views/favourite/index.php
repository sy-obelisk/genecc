
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/toefl/index/index">订单模块</a> <span class="divider">/</span></li>
        <li class="active">优惠活动</li>
    </ul>
    <ul class="nav nav-tabs">

        <?php
        foreach($block as $v) {
            ?>
            <?php
            if($v['value'] == 'add') {
                ?>
                <li class="dropdown pull-right">
                    <a href="<?php echo baseUrl?>/order/favourite/add">添加优惠活动</a>
                </li>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </ul>
    <legend>用户</legend>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>活动名称</th>
                <th >开始时间</th>
                <th >结束时间</th>
                <th >活动类型</th>
                <th >创建人</th>
                <th >创建时间</th>
                <th >操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><span><?php echo $v['name']?></span></td>
                    <td><span><?php echo date("Y-m-d",$v['startTime'])?></span></td>
                    <td><span><?php echo date("Y-m-d",$v['endTime'])?></span></td>
                    <td><span><?php echo $v['type'] == 1?'满减优惠':'折扣优惠';?></span></td>
                    <td><span><?php echo $v['userId']?></span></td>
                    <td><span><?php echo date("Y-m-d",$v['createTime'])?></span></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                                <?php
                                    if($val['value'] != 'add') {
                                        ?>
                                        <a class="btn"
                                           href="<?php echo baseUrl?>/order/favourite/<?php echo $val['value']?>?id=<?php echo $v['id']?>"><?php echo $val['name']?></a>
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
    </div>
</div>
<script>
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