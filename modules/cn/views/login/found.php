<!DOCTYPE html>
<html>
<head>
    <title>找回密码界面</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="/cn/css/fonts/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/cn/css/public.css"/>
    <link rel="stylesheet" href="/cn/css/register.css"/>
    <link rel="stylesheet" href="/cn/css/style.css"/>
</head>
<body>
<div class="login-top">
    <div class="logo">
        <a href="/"><img src="/cn/images/head_logo.png" alt="logo图标"></a>
        <b>|</b>
        <span>找回密码</span>
    </div>
    <div class="reg">
        <span>我想起来了，现在就</span>
        <a href="login.html">登录</a>
    </div>
    <div style="clear: both"></div>
</div>
<div class="login-con">
    <div class="inCon">
        <div class="shop-login">
            <h4>找回密码</h4>
            <div class="toggleReg">
                <div class="toggleHd hd">
                    <ul>
                        <li>
                            <input type="radio" name="reg" id="phoneR" checked/><label for="phoneR">手机号找回密码</label>
                        </li>
                        <li>
                            <input type="radio" name="reg" id="emailR"/><label for="emailR">邮箱找回密码</label>
                        </li>
                    </ul>
                </div>
                <div style="clear: both;margin-bottom: 8px;"></div>
                <div class="toggleBd">
                    <ul>
                        <li>
                            <form class="userMessage regPhone">
                                <div>
                                    <ul>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_phoneIcon.png" alt="电话图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="findPhone phone" type="text" placeholder="手机号"  datatype="m" errormsg="手机号格式不正确(不能小于11位)!"/>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_password.png" alt="密码图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="findPhonePass userPass" type="password" placeholder="新密码" datatype="*6-16" errormsg="密码范围在6~16位之间！"/>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!--动态密码-->
                                <div class="dynamic">
                                    <div class="dynamic-left">
                                        <input class="findPhoneCode" type="text" placeholder="验证码" datatype="*" errormsg="验证码不能为空！"/>
                                    </div>
                                    <div class="dynamic-right">
                                        <input type="button" onclick="clickDX(this,60,1);" value="获取短信验证码"/>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="loginBtn">
                                    <input onclick="findPhone()" type="button" value="提交" />
                                </div>
                            </form>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <form class="userMessage regEmail">
                                <div>
                                    <ul>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_phoneIcon.png" alt="电话图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="email findEmail" type="text" placeholder="邮箱"  datatype="e" errormsg="邮箱格式不正确!"/>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="leftIcon">
                                                <span></span>
                                                <img src="/cn/images/login_password.png" alt="密码图标">
                                            </div>
                                            <div class="rightInput">
                                                <input class="findEmailPass userPass" type="password" placeholder="新密码" datatype="*6-16" errormsg="密码范围在6~16位之间！"/>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!--图片验证码-->
<!--                                <div class="dynamic imgNamic">-->
<!--                                    <div class="dynamic-left">-->
<!--                                        <input type="text"  datatype="*" errormsg="验证码不能为空！"/>-->
<!--                                        <img src="/cn/images/found_yzm.png" alt="验证码图片"/>-->
<!--                                    </div>-->
<!--                                    <div class="dynamic-right">-->
<!--                                        <a href="#">换一张</a>-->
<!--                                    </div>-->
<!--                                    <div style="clear: both"></div>-->
<!--                                </div>-->
                                <!--动态密码-->
                                <div class="dynamic">
                                    <div class="dynamic-left">
                                        <input class="findEmailCode" type="text" placeholder="验证码" datatype="*" errormsg="动态密码不能为空！"/>
                                    </div>
                                    <div class="dynamic-right">
                                        <input type="button" onclick="clickDX(this,120,2);" value="获取邮件验证码"/>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="loginBtn">
                                    <input onclick="findEmail()" type="button" value="提交" />
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
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
    <span>Copyright &copy; 2016 All Right Reserved 小申教育 版权所有</span>
</div>
</body>
<script type="text/javascript" src="/cn/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/cn/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="/cn/js/public.js"></script>
<script type="text/javascript" src="/cn/js/foundPassword.js"></script>
</html>
<script type="text/javascript">
    /**
     * 邮箱找回密码
     * @returns {boolean}
     */
    function findEmail(){
        var findEmail = $('.findEmail').val()
        var findEmailCode = $('.findEmailCode').val()
        var findEmailPass = $('.findEmailPass').val()
        if(findEmail == ""){
            $('.findEmail').next("p").css("visibility","visible").html("请输入您的电话!");
            return false;
        }
        if(findEmailCode == ""){
            $('.findEmailCode').next().next("p").css("visibility","visible").html("请输入电话验证码");
            return false;
        }
        if(findEmailPass == ""){
            $('.findEmailPass').next("p").css("visibility","visible").html("请输入您的新密码");
            return false;
        }
        $.post('/cn/api/find-pass',{type:2,registerStr:findEmail,code:findEmailCode,pass:findEmailPass},function(re){
            if(re.code == 1){
                alert(re.message);
                location.href='/login.html';
            }else{
                alert(re.message);
            }
        },'json')
    }

    /**
     * 手机找回密码
     * @returns {boolean}
     */
    function findPhone(){
        var findPhone = $('.findPhone').val()
        var findPhoneCode = $('.findPhoneCode').val()
        var findPhonePass = $('.findPhonePass').val()
        if(findPhone == ""){
            $('.findPhone').next("p").css("visibility","visible").html("请输入您的电话!");
            return false;
        }
        if(findPhoneCode == ""){
            $('.findPhoneCode').next().next("p").css("visibility","visible").html("请输入电话验证码");
            return false;
        }
        if(findPhonePass == ""){
            $('.findPhonePass').next("p").css("visibility","visible").html("请输入您的新密码");
            return false;
        }
        $.post('/cn/api/find-pass',{type:1,registerStr:findPhone,code:findPhoneCode,pass:findPhonePass},function(re){
            if(re.code == 1){
                alert(re.message);
                location.href='/login.html';
            }else{
                alert(re.message);
            }
        },'json')
    }
</script>