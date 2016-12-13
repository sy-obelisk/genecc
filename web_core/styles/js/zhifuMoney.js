//num表示要四舍五入的数,v表示要保留的小数位数。
function decimal(num,v)
{
    var vv = Math.pow(10,v);
    return Math.round(num*vv)/vv;
}
//加减
function ck(e,n){
    var order = $("#order").val();
    var num = $("#num").val();
    if(n=='+'){
        num++;
    }
    if(n=='-'){
        num--;
        if(num<1){
            num=1;
        }
    }
    $("#num").val(num);
    var price = $("#oldprice").val();//原价
    var now = $("#hidenLD").val();//已有的豆
    var zongjia = adjust(price*num,$("#adjust").val());
    var zongjialeidou = zongjia*100;
    $("#p_num").val(num);
    $("#py_price").val(zongjia);
    $(".totalP").html(zongjia);
    $("#value_l").html(zongjia);
    if(zongjialeidou<now){
        $("#jifenMoney").val(zongjialeidou);
        $("#p_integral").val(zongjialeidou);
        $("#zhehe").html(zongjialeidou/100);//折合
        $("#dikou").html(zongjialeidou/100);//抵扣
        var yingfu = parseFloat(zongjia-(zongjialeidou/100));
        var floats =Math.round(yingfu*100)/100;
        $("#yingfu").html(floats)
    }
    if(zongjialeidou>now){
        $("#jifenMoney").val(now);
        $("#p_integral").val(now);
        $("#zhehe").html(now/100);//折合
        $("#dikou").html(now/100);//抵扣
        var yingfu = parseFloat(zongjia-(now/100));
        var floats =Math.round(yingfu*100)/100;
        $("#yingfu").html(floats)
    }
}
//输入框
function sr(e){
    var order = $("#order").val();
    var num = Number($("#num").val());
    var price = Number($("#oldprice").val());//单价
    var now = Number($("#hidenLD").val());//已有的豆
    var zongjia = adjust(price*num,$("#adjust").val());
    var zongjialeidou = zongjia*100;
    var leidou = Number($("#jifenMoney").val());//输入的雷豆
    $("#p_num").val(num);
    $("#py_price").val(zongjia);
    $("#userleidou").val(leidou);
    if(Number(leidou)<Number(zongjialeidou)){
        if( Number(leidou) < Number(now) ){
            $("#jifenMoney").val(leidou);
            $("#p_integral").val(leidou);
            $("#zhehe").html(leidou/100);//折合
            $("#dikou").html(leidou/100);//抵扣
            var yingfu = parseFloat(zongjia-(leidou/100));
            var floats =Math.round(yingfu*100)/100;
            $("#yingfu").html(floats);
            $("#jifenP").html(now-leidou);
        }else{
            $("#jifenMoney").val(now);
            $("#zhehe").html(now/100);//折合
            $("#dikou").html(now/100);//抵扣
            var yingfu = parseFloat(zongjia-(now/100));
            var floats =Math.round(yingfu*100)/100;
            $("#yingfu").html(floats);
            $("#jifenP").html(now-leidou);
        }
    }
    if(Number(leidou)>=zongjialeidou){
        if(zongjialeidou<Number(now)){
            $("#jifenMoney").val(zongjialeidou);
            $("#p_integral").val(zongjialeidou);
            $("#zhehe").html(zongjialeidou/100);//折合
            $("#dikou").html(zongjialeidou/100);//抵扣
            var yingfu = parseFloat(zongjia-(zongjialeidou/100));
            var floats =Math.round(yingfu*100)/100;
            $("#yingfu").html(floats);
        }else{
            $("#jifenMoney").val(now);
            $("#zhehe").html(now/100);//折合
            $("#dikou").html(now/100);//抵扣
            var yingfu = parseFloat(zongjia-(now/100));
            var floats =Math.round(yingfu*100)/100;
            $("#yingfu").html(floats)
        }
    }
}

function adjust(a,e){
   var zongjia = Number(a)+Number(e);
    return zongjia;

}
//修改订单
function updaorder(){
    var order = $("#order").val();
    var num = $("#num").val();
    var integral = $("#jifenMoney").val();//使用雷豆
    var price = $("#oldprice").val();//实付款
    var adjust = $("#adjust").val();//调价
    var check = $("#leidou_check").val();
    $.ajax({
        url: 'index.php?web/pay/updaorder', // 跳转到
        data: {
            order_id: order,
            num: num,
            integral: integral,
            price: price,
            adjust: adjust,
            check: check
        },
        type: 'post',
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
            $("#WIDtotal_fee").val(data.order.account);
            if(data.order.account ==0){
                location.href="/pay/show-"+order+".html";
            }
        },
        error: function () {
            alert("网络通讯失败,请检查网络连接，或者联系网站管理员！");
        }
    });
}
