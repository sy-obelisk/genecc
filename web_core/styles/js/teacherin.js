
var nameNum,ageNum,contentNum,phoneNum,emailNum;
//验证姓名
function nameYZ(o){
    if($(o).val()==''){
        $(o).next("span").show();
        nameNum=false;
    }else{
        $(o).next("span").hide();
        nameNum=true;
    }
    return nameNum;
}
//验证年龄
function ageYZ(o){
    if($(o).val()==''){
        $(o).next("span").show();
        ageNum=false;
    }else{
        $(o).next("span").hide();
        ageNum=true;
    }
    return ageNum;
}
//验证主讲内容
function contentZJ(o){
    if($(o).val()==''){
        $(o).next("span").show();
        contentNum=false;
    }else{
        $(o).next("span").hide();
        contentNum=true;
    }
    return contentNum;
}
//验证手机
function phoneYZ(o){
    var reg=/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/;
    if($(o).val()=='' || !reg.test($(o).val())){
        $(o).next("span").show();
        phoneNum=false;
    }else{
        $(o).next("span").hide();
        phoneNum=true;
    }
    return phoneNum;
}
//验证邮箱
function emailYZ(o){
    var reg=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
    if($(o).val()=='' || !reg.test($(o).val())){
        $(o).next("span").show();
        emailNum=false;
    }else{
        $(o).next("span").hide();
        emailNum=true;
    }
    return emailNum;
}
//提交
function present(o){
    if(!nameNum || !ageNum || !contentNum || !phoneNum || !emailNum){
        alert("请检查你的信息是否填写正确!")
    }else{
      var name = $('#name').val();
      var photo = $('#photo').val();
      var age = $('#age').val();
      var phone = $('#phone').val();
      var email = $('#email').val();
      var speaker = $('#speaker').val();
      var experience = $('#experience').val();
      var feature = $('#feature').val();
      var Former_structure = $('#Former_structure').val();
      var GMAT_score = $('#GMAT_score').val();
      var TOEFL_score = $('#TOEFL_score').val();
      var IELTS_score = $('#IELTS_score').val();
      var book = $('#book').val();
      var Teaching_way = $('#Teaching_way').val();
        $.ajax({
            url:'/teachers/ajaxGmatTeacher/',
            data:{
                name:name,
                photo:photo,
                age:age,
                phone:phone,
                email:email,
                speaker:speaker,
                experience:experience,
                feature:feature,
                Former_structure:Former_structure,
                GMAT_score:GMAT_score,
                TOEFL_score:TOEFL_score,
                IELTS_score:IELTS_score,
                book:book,
                Teaching_way:Teaching_way
            },
            type: 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if(data.code == 1){
                    alert(data.message);
                    location.href="/teachers/teacherin/";
                }else{
                   alert(data.message);
                }
            },
            error:function(){
                alert('网络连接失败！');
            }
        });
    }
}