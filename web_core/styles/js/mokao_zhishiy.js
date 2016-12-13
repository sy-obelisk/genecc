$(function(){
//    点击叉叉去掉元素
    $(".mk_lj_r_hide ul li span").live("click",".mk_lj_r_hide ul li span",function(){
        $(this).parent().remove();
        var timuLB=$(this).parent().attr("timuLB");
        $("#"+timuLB).removeAttr("disabled");
            if(!$(".mk_lj_r_hide ul li").html()){
                $(".mk_lj_r_hide").hide();
                $(".mk_lj_r_right .dingba_tuB").show();
            }

    });
//    套题
//    jQuery(".mokao_taoti_right").slide({trigger:"click"});

   $(".mk_lj_r_ul_one li input").bind("click",testAdd);
   $(".mk_lj_r_ul_two li input").bind("click",testAdd);
    $(".mokao_liji_left ol li").hover(function(){
        $(this).animate({
            'marginBottom':'15px'
        });
    },function(){
        $(this).animate({
            'marginBottom':'10px'
        });
    });

    shesCore(".specialScore");
});

function shesCore(className){
    //四舍五入分数
    $(className).each(function(){
        var a=$(this).html();
        var b=Math.round(a/10)*10;
        $(this).html(b);
    });
}
//  选择
function  testAdd(){
    var li,input;
    var timuLY=$(".mk_lj_r_ul_one li input:checked").val();
    var timuLB=$(".mk_lj_r_ul_two li input:checked").val();
    var liIdOne=$(".mk_lj_r_ul_one li input:checked").attr("id");
    var liIdTwo=$(".mk_lj_r_ul_two li input:checked").attr("id");
    var timuId01=$(".mk_lj_r_ul_one li input:checked").attr("timuId");
    var timuId02=$(".mk_lj_r_ul_two li input:checked").attr("timuId");

    var liIdStr=liIdOne+liIdTwo;
    var inputId=timuId01+'_'+timuId02;
    if(liIdOne && liIdTwo){
        $(".mk_lj_r_hide").show();
        $(".mk_lj_r_right .dingba_tuB").hide();
          li=document.createElement("li");
        $(li).attr("timuLY",liIdOne);
        $(li).attr("timuLB",liIdTwo);
          $(li).html(""+timuLB+"&nbsp;来自&nbsp;"+timuLY+" <span class='mk_r_none'>×</span>"+"<input type='hidden' name='mdn[]' id='"+inputId+"'/>");
          $(li).attr("id",liIdStr);
          $("#"+liIdTwo).attr({"disabled":"disabled"});
        $(".mk_lj_r_ul_one li input:checked").removeAttr('checked');
        $(".mk_lj_r_ul_two li input:checked").removeAttr('checked');
        if(!document.getElementById(liIdStr)){
            if($(".mk_lj_r_right .mk_lj_r_hide ul li").length<6){
                $(".mk_lj_r_right .mk_lj_r_hide ul").append(li);
            }

        }

    }

}