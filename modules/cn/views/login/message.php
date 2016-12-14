<!DOCTYPE html>
<html>
<head>
    <title>手机登录界面</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/login.css"/>
    <link rel="stylesheet" href="/cn/css/style.css"/>
</head>
<body>
<div class="login-top">
    <div class="logo">
        <img src="/cn/images/head_logo.png" alt="logo图标">
        <b>|</b>
        <span>登陆</span>
    </div>
    <div class="reg">
        <span>还没有雷哥账号</span>
        <a href="register.html">注册</a>
    </div>
    <div style="clear: both"></div>
</div>
<div class="login-con">
    <div class="inCon">
        <div class="shop-login">
            <h4>雷哥商城登陆</h4>
            <a href="login.html" class="mess">账号密码登录</a>
            <div style="clear: both"></div>
            <form class="userMessage">
                <div>
                    <ul>
                        <li>
                            <div class="leftIcon">
                                <span></span>
                                <img src="/cn/images/login_phoneIcon.png" alt="电话图标">
                            </div>
                            <div class="rightInput">
                                <input class="phone" type="text" placeholder="手机号"  datatype="m" errormsg="手机号格式不正确(不能小于11位)!"/>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--动态密码-->
                <div class="dynamic">
                    <div class="dynamic-left">
                        <input class="code" type="text" placeholder="动态密码" datatype="*" errormsg="动态密码不能为空！"/>
                    </div>
                    <div class="dynamic-right">
                        <input type="button" onclick="clickDX(this,60,1);" value="发送动态密码"/>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <div class="loginBtn">
                    <input onclick="phoneLogin()" type="button" value="登陆" />
                </div>
            </form>
            <div class="otherLogin">
                <ul>
                    <li><a href="#"><img src="/cn/images/login_qqIcon.png" alt="qq图标"></a></li>
                    <li><a href="#"><img src="/cn/images/login_blogIcon.png" alt="微博图标"></a></li>
                    <li><a href="#"><img src="/cn/images/login_personIcon.png" alt="人人网图标"></a></li>
                    <li><a href="#"><img src="/cn/images/login_blogIcon02.png" alt="博客网图标"></a></li>
                </ul>
            </div>
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
<script type="text/javascript" src="/cn/js/public.js"></script>
<script type="text/javascript" src="/cn/js/login.js"></script>
</html>
<script type="text/javascript">
    /**
     * 用户登录
     */
    function phoneLogin(){
        var phone = $('.phone').val();
        var code = $('.code').val();
        if(phone == ""){
            return false;
        }
        if(code == ""){
            return false;
        }
        $.post('/cn/api/phone-login',{phone:phone,code:code},function(re){
            if(re.code == 1){
                window.location.href="/";
            }else{
                alert(re.message);
            }
        },'json')
    }
</script>