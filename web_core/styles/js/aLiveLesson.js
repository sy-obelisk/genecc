
$(function(){
    $('.nstSlider').nstSlider({
        "left_grip_selector": ".leftGrip",
        "value_bar_selector": ".bar",
        "value_changed_callback": function(cause, leftValue, rightValue) {
            var $container = $(this).parent(),
                g = 255 - 127 + leftValue,
                r = 255 - g,
                b = 0;
            //$container.find('.leftLabel').text(leftValue);
            submitVolume(leftValue);
            $(this).find('.bar').css('background', 'rgb(' + [r, g, b].join(',') + ')');
        }
    });
});

var flag=true,
    flagS=true;
function hideLeft(o){
    if(flag){
        $(o).parents("div.aLc-center").siblings("div.aLc-left").fadeOut(1000).end().animate({left:"0"});
        flag=false;
    }else{
        $(o).parents("div.aLc-center").siblings("div.aLc-left").show().end().animate({left:"18%"});
        flag=true;
    }

}
function hideRight(o){
    if(flagS){
        $(o).parents("div.aLc-center").siblings("div.aLc-right").fadeOut(1000).end().animate({right:"0"});
        flagS=false;
    }else{
        $(o).parents("div.aLc-center").siblings("div.aLc-right").fadeIn().end().animate({right:"18%"});
        flagS=true;
    }

}
//切换div
function toggleDiv(o){
    var slideTop=$(".slideTop").children();
    var aLc_cVideo=$(".aLc_cVideo").children();
    $(".slideTop").html("").append(aLc_cVideo);
    $(".aLc_cVideo").html("").append(slideTop);

}
