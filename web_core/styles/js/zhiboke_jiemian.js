$(function(){
    //    ==============================================直播课界面js===========================================

    $(".zb_he_l_small").bind({

        "mouseenter":function(){
            $(this).find("img").animate({
                "width":"161px",
                "marginLeft":"-10px",
                "marginTop":"-10px"
            })
        },"mouseleave":function(){
            $(this).find("img").animate({
                "width":"139px",
                "marginLeft":"0",
                "marginTop":"0"
            })
        }
    });

    $("#zhibo_gmat_amanda ul li").live("mouseenter","#zhibo_gmat_amanda ul li",function(){
        $(this).find("div").animate({
            "height":"192px"
        },500);
        $(this).find("div .zhibo_show_font").show();
        $(this).find("div .zhibo_amanda_font").hide();
    });
    $("#zhibo_gmat_amanda ul li").live("mouseleave","#zhibo_gmat_amanda ul li",function(){
        $(this).find("div").animate({
            "height":"42px"
        },500);
        $(this).find("div .zhibo_show_font").hide();
        $(this).find("div .zhibo_amanda_font").show();

    });
//雷哥GMAT名师介绍
    jQuery("#zhibo_gmat_amanda").slide({mainCell:".zhibo_gmat_img_lunbo ul",autoPage:false,effect:"leftLoop",vis:5,trigger:"click",mouseOverStop:true});

    jQuery("#zhibo_kc_rili").slide({trigger:"click"});

    $(".zb_ke_rili_body_right ul li:nth-child(7n)").css("marginRight","0");
    //六月
    hoverClass(".body_rightOne ul li.on","div.body_left_center1 span","div.body_left_center2");
    //七月
    hoverClass(".body_rightTwo ul li.on","div.body_left_center1 span","div.body_left_center2");

});
function hoverClass(clickEle,changeSpan,changeSpanTwo){
    $(clickEle).hover(function(){
        $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpan).html($(this).find("a").html());
        var changeNum=$(this).find("a").html();
        var inputHtml=$(this).parent().parent().siblings("input:hidden").val();
        if(inputHtml=="1"){
            switch (parseInt(changeNum)){
                case 17: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.10.17 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 18: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.10.18 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 24: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.10.24 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 25: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.10.25 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 28: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT数学在线小班课】</p> <p style='font-size: 18px;'>时间：2015.10.28 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 29: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT数学在线小班课】</p> <p style='font-size: 18px;'>时间：2015.10.29 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 30: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT数学在线小班课】</p> <p style='font-size: 18px;'>时间：2015.10.30 19:00-21:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 31: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.10.31 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
            }
    }else if(inputHtml=="2"){
            switch (parseInt(changeNum)){
                case 1: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.01 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 7: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html(" <p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.07 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 8: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.08 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 14: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.14 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 15: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.15 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 21: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.21 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
                case 22: $(this).parent().parent().siblings("div.zb_ke_rili_body_left").find(changeSpanTwo).html("<p>【GMAT在线强化课程(周末班)】</p> <p style='font-size: 18px;'>时间：2015.11.22 9:30-16:00</p><p> <a>正在报名中</a></p>");
                    break;
            }
        }


    });
}
