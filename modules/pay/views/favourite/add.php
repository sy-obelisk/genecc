<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<!-- 编辑器公式插件 -->
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/addKityFormulaDialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/getKfContent.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/kityformula-plugin/defaultFilterFix.js"></script>
<script type="text/javascript" src="/My97DatePicker/WdatePicker.js"></script>
<!-- 树形菜单选择 -->
<link rel="stylesheet" type="text/css" href="/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

<div class="span10" id="datacontent">
    <ul class="breadcrumb">
        <li><a href="<?php echo baseUrl?>/content/index/index">订单模块</a> <span class="divider">/</span></li>
        <li><a href="<?php echo baseUrl?>/content/content/index">优惠活动</a> <span class="divider">/</span></li>
        <li class="active">添加活动</li>
    </ul>
    <form action="<?php echo baseUrl?>/order/favourite/add" method="post" class="form-horizontal">
        <fieldset>
            <div class="control-group">
                <label for="modulename" class="control-label">活动名称</label>
                <div class="controls">
                    <input type="text" id="input1" name="favourable[name]" value="<?php echo isset($data['name'])?$data['name']:''?>" datatype="userName" needle="needle" msg="您必须输入中英文字符的分类名称">
                    <span class="help-block">请输入活动名称名称</span>
                </div>
            </div>
            <div class="control-group">
                <label for="catdes" class="control-label">优惠活动开始时间</label>

                <div class="controls">
                        <input type="text"  class="Wdate" onclick="WdatePicker()" name="favourable[startTime]" value="<?php echo isset($data['startTime'])?date("Y-m-d",$data['startTime']):''?>" datatype=""
                               needle="needle" msg="">
                </div>
            </div>
            <div class="control-group">
                <label for="catdes" class="control-label">优惠活动结束时间</label>

                <div class="controls">
                    <input type="text"  class="Wdate" onclick="WdatePicker()" name="favourable[endTime]" value="<?php echo isset($data['endTime'])?date("Y-m-d",$data['endTime']):''?>" datatype=""
                           needle="needle" msg="">
                </div>
            </div>
            <div class="control-group">
                <label for="catdes" class="control-label">优惠范围</label>

                <div class="controls" id="extShow">
                    <select onchange="changeExt(this)" id="rangeType" name="favourable[rangeType]"  msg="您必须选择一个分类">
                        <option <?php echo isset($data) && $data['rangeType'] == 1?'selected="selected"':''?> value="1">全部商品</option>
                        <option <?php echo isset($data) && $data['rangeType'] == 2?'selected="selected"':''?> value="2">以下分类</option>
                        <option <?php echo isset($data) && $data['rangeType'] == 3?'selected="selected"':''?> value="3">以下商品</option>
                    </select>
                    <?php
                        if(isset($content)){
                            ?>
                            <?php
                            foreach($content as $v){
                            ?>
                                <span class="rowShow" id="<?php echo $v['id']?>"><?php echo $v['name']?><span onclick="deleteExt(this,<?php echo $v['id']?>)">X</span></span>
                            <?php
                    }
                    ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div id="search" class="control-group" <?php echo isset($data)&&$data['rangeType']!=1?'':'style="display: none;"'?>>
                <label for="catdes" class="control-label">选择加入优惠范围</label>
                <div class="controls">
                    <input type="text" id="searchKeywords"><input onclick="searchContent(this)" type="button" value="搜索"><select id="searchRow"></select><input onclick="addExt()" type="button" value="+">
                </div>
            </div>
            <div class="control-group">
                <label for="modulename" class="control-label">优惠方式</label>
                <div class="controls">
                    <select name="favourable[type]" onchange="changeType(this)"  msg="您必须选择一个分类">
                        <option <?php echo isset($data) && $data['type'] == 1?'selected="selected"':''?> value="1">满减优惠</option>
                        <option <?php echo isset($data) && $data['type'] == 2?'selected="selected"':''?> value="2">折扣优惠</option>
                    </select>
                </div>
                <div class="controls" id="typeDetails">
                    <?php
                        if((isset($data) && $data['type'] == 1) || !isset($data)) {
                            ?>
                            满<input value="<?php echo isset($data['typeExt'])?$data['typeExt']:''?>" type="text" name="favourable[typeExt]">减<input type="text" value="<?php echo isset($data['details'])?$data['name']:''?>"
                                                                                   name="favourable[details]">
                        <?php
                        }
                    ?>
                    <?php
                    if(isset($data) && $data['type'] == 2 ) {
                        ?>
                        <input type="text" value="<?php echo isset($data['details'])?$data['details']:''?>" name="favourable[details]">折扣量
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls submitRow">
                    <input name="id" type="hidden" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="submit" class="btn btn-primary" value="提交">
                    <?php
                    if(isset($content)){
                        ?>
                        <?php
                        foreach($content as $v){
                            ?>
                            <input type="hidden" name="favourable[rangeExt][]" value="<?php echo $v['id']?>">
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    //修改范围
    function changeExt(_this){
        var rangeType = $(_this).val();
        if(rangeType == 1){
            $('#search').hide();
            $('.rowShow').remove();
            $('input[name="favourable[rangeExt][]"]').remove();
        }
        if(rangeType == 2 || rangeType == 3){
            $('#search').show();
            $('.rowShow').remove();
            $('#searchRow').html('');
            $('#searchKeywords').val('');
            $('input[name="favourable[rangeExt][]"]').remove();
        }
    }
    //修改优惠类型
    function changeType(_this){
        var Type = $(_this).val();
        if(Type == 1){
            var str= '满<input type="text" name="favourable[typeExt]">减<input type="text" name="favourable[details]">';
        }
        if(Type == 2){
            var str = '<input type="text" name="favourable[details]">折扣量';
        }
        $('#typeDetails').html(str)
    }
//查询内容
    function searchContent(_this){
        var rangeType = $('#rangeType').val();
        var searchKeywords = $('#searchKeywords').val();
        if(rangeType == 3 && searchKeywords == ''){
            alert('请输入关键字');
            return false;
        }
        $.post('/order/api/get-content',{rangeType:rangeType,searchKeywords:searchKeywords},function(re){
            var str = "";
            for(i=0;i<re.length;i++){
                str += '<option value="'+re[i].id+'">'+re[i].name+'</option>';
            }
            $('#searchRow').html(str);
        },'json')
    }
//添加分类或者商品
    function addExt(){
        var name = $('#searchRow').find('option:selected').text();
        var id = $('#searchRow').val();
        alert(name);
        if(id == null){
            alert('请先搜索');
            return false;
        }
        var nameStr = ' <span class="rowShow" id="'+id+'">'+name+'<span onclick="deleteExt(this,'+id+')">X</span></span> ';
        var idStr ='<input type="hidden" name="favourable[rangeExt][]" value="'+id+'">';
        $('#extShow').append(nameStr);
        $('.submitRow').append(idStr);
    }

    function deleteExt(_this,_id){
        $('#'+_id).remove();
        $('input[value="'+_id+'"]').remove();
    }
</script>
