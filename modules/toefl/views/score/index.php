
<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="/toefl/index/index">托福模块</a> <span class="divider">/</span></li>
        <li class="active">分数管理</li>
    </ul>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="javascript:;" onclick="javascript:openall();">分数管理</a>
        </li>
    </ul>
    <legend>用户</legend>
    <form action="/user/discuss/publish" id="checkPush" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width="80">ID</th>
                <th>正确题数</th>
                <th >分数</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $v) {
                ?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><span><?php echo $v['number']?></span></td>
                    <td><span><?php echo $v['score']?></span></td>
                    <td>
                        <div>
                            <?php
                            foreach($block as $val) {
                                ?>
                                <a class="btn"
                                   href="<?php echo baseUrl?>/toefl/score/<?php echo $val['value']?>?id=<?php echo $v['id']?>"><?php echo $val['name']?></a>
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