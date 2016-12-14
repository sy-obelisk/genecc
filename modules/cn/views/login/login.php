<!DOCTYPE html>
<html>
<head>
    <title>普通登录界面</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/login.css"/>
    <link rel="stylesheet" href="/cn/css/style.css"/>
</head>
<body>
<div class="login-top">
    <div class="logo">
        <a href="/"><img src="/cn/images/head_logo.png" alt="logo图标"></a>
        <b>|</b>
        <span>登陆</span>
    </div>
    <div class="reg">
        <span>还没有账号</span>
        <a href="register.html">注册</a>
    </div>
    <div style="clear: both"></div>
</div>
<div class="login-con">
    <div class="inCon">
        <div class="shop-login">
            <h4>SmartApply商城登陆</h4>
            <a href="/phone.html" class="mess messBack">短信快捷登录</a>
            <div style="clear: both"></div>
            <form class="userMessage ordinary">
                <div>
                    <ul>
                        <li>
                            <div class="leftIcon">
                                <span></span>
                                <img src="/cn/images/login_userIcon.png" alt="人人图标">
                            </div>
                            <div class="rightInput">
                                <input class="userName" type="text" placeholder="邮箱/用户名/已验证手机"
                                       datatype="s5-16" errormsg="用户名至少5个字符,最多16个字符!" onkeydown="javascript:enterLogin(event);"/>
                            </div>
                        </li>
                        <li>
                            <div class="leftIcon">
                                <span></span>
                                <img src="/cn/images/login_password.png" alt="密码图标">
                            </div>
                            <div class="rightInput">
                                <input class="userPass" type="password" placeholder="密码"
                                       datatype="*6-16" errormsg="密码范围在6~16位之间！" onkeydown="javascript:enterLogin(event);"/>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="dynamic">
                    <div class="dynamic-left">
                        <input class="loginCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！" onkeydown="javascript:enterLogin(event);"/>
                    </div>
                    <div class="dynamic-right">
                        <img src="/cn/api/verification-code" onclick="this.src='/cn/api/verification-code?'+Math.random();" alt="验证码"/>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <div class="autoLogin">
                    <input type="checkbox" id="auto" checked/>
                    <label for="auto">自动登录</label>
                    <a href="/found-pass.html">忘记密码?</a>
                </div>
                <div class="loginBtn">
                    <input onclick="subLogin()" type="button" value="登陆" id="1111btn_sub"/>
                </div>
            </form>
<!--            <div class="otherLogin">-->
<!--                <ul>-->
<!--                    <li><a href="#"><img src="/cn/images/login_qqIcon.png" alt="qq图标"></a></li>-->
<!--                    <li><a href="#"><img src="/cn/images/login_blogIcon.png" alt="微博图标"></a></li>-->
<!--                    <li><a href="#"><img src="/cn/images/login_personIcon.png" alt="人人网图标"></a></li>-->
<!--                    <li><a href="#"><img src="/cn/images/login_blogIcon02.png" alt="博客网图标"></a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</div>
<div class="login-foot">
    <ul>
        <li><a href="/study-abroad/category-152/aim-0/country-0/page-1.html">留学定制</a></li>
        <li>|</li>
        <li>
            <a href="/study-abroad/category-223/aim-0/country-0/page-1.html">文书</a>
        </li>
        <li>|</li>
        <li><a href="http://schools.smartapply.cn/schools.html">院校库</a></li>
        <li>|</li>
        <li><a href="#">案例库</a></li>
        <li>|</li>
        <li><a href="#">大学排名</a></li>
        <li>|</li>
        <!--                <li>-->
        <!--                    <a href="/study-abroad/category-151/aim-0/country-0/page-1.html">网申</a>-->
        <!--                </li>-->
        <!--                <li>-->
        <!--                    <a href="/study-abroad/category-153/aim-0/country-0/page-1.html">选校</a>-->
        <!--                </li>-->
        <!--                <li>-->
        <!--                    <a href="/after-class/category-154/page-1.html">实习</a>-->
        <!--                </li>-->
        <li>
            <a href="/course/category-162/type-0/page-1.html">GMAT</a>
        </li>
        <li>|</li>
        <li>
            <a href="/course/category-163/type-0/page-1.html">托福</a>
        </li>
        <li>|</li>
        <li>
            <a href="/public-class.html" target="_blank">公开课</a>
        </li>
        <li>|</li>
        <li>客服电话：<span>400-1816-180</span>（每天9:00-22:00）</li>
    </ul>
    <div class="clearB"></div>
    <span>Copyright &copy;2016 All Right Reserved  SmartApply 版权所有</span>
</div>
</body>
<script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/cn/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="/cn/js/login.js"></script>
</html>
<script type="text/javascript">
    /**
     * 用户登录
     */
    function subLogin(){
        var userPass = $('.userPass').val()
        var userName = $('.userName').val();
        var verificationCode = $('.loginCode').val();
        if(verificationCode == ""){
//            $('.loginCode').parent().find("p").css("visibility","visible");
            return false;
        }
        if(userName == ""){
//            $('.userName').next("p").css("visibility","visible").html("请输入用户名!");
            return false;
        }
        if(userPass == ""){
//            $('.userPass').next("p").css("visibility","visible").html("请输入密码");
            return false;
        }
        $.post('/cn/api/check-login',{verificationCode:verificationCode,userPass:userPass,userName:userName},function(re){
            if(re.code == 1){
                window.location.href="/";
            }else{
                alert(re.message);
            }
        },'json')
    }
    /**
     * enter键登录
     */
    function enterLogin(event){
       if(event.keyCode==13){
           subLogin();
       }
    }
</script>