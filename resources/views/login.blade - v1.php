<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- 响应式页面 -->
    <meta name="format-detection" content="telephone=no">
    <!-- 禁止数字被识别成电话号码 -->
    <meta name="format-detection" content="email=no">
    <!-- 禁止被识别成邮箱 -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- 禁止链接高亮 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- 删除默认的苹果工具栏和菜单栏。 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- 苹果手机控制状态栏显示样式 -->
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,viewport-fit=cover">

    <meta name="csrf-token" content="<?= csrf_token() ?>">

    <title>登录 - 学生心理评估管理平台</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        html {
            height: 100%;
        }

        body {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            /* background-image: linear-gradient(to right, #ffdefb, #e0edef); */

        }

        .login-wrapper {
            width: 25%;
            height: 588px;
            border-radius: 15px;
            height: 90%;
        }

        .head_name {
            text-align: center;
            font-family: cursive;
            font-weight: bolder;
            font-size: 34px;
            padding-bottom: 50px;
        }

        .text {
            text-align: center;
            line-height: 20px;
            height: 40px;
        }

        .input-item {
            display: block;
            width: 94%;
            margin-bottom: 20px;
            border: 0;
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
            outline: none;
            border-radius: 10px;
        }

        .input-item:placeholder {
            text-transform: uppercase;
        }

        .btn {
            text-align: center;
            padding: 10px;
            background-color: #8687F3;
            color: #fff;
            cursor: pointer;
        }

        .sigin_btn {
            width: 92%;
            margin-top: 3%;
            border-radius: 10px;
        }

        .msg {
            color: #BCBCBC;
            font-size: 14px;
            line-height: 40px;
        }

        a {
            text-decoration-line: none;
            color: #abc1ee;
        }

        .head {
            text-align: center;
        }

        .email_img {
            position: absolute;
        }

        .email_img>img {
            width: 55%;
            height: 55%;
        }

        .email_img>p {
            border-radius: 100%;
            background: #5D5EEC;
            border: 1px solid #5D5EEC;
            width: 16px;
            height: 16px;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            font-weight: bold;
            color: #fff;
            position: absolute;
            left: 45%;
            bottom: 66%;
        }

        .email_img {
            position: absolute;
            right: 10%;
            top: 9%;
        }

        .head>img {
            width: 150px;
            height: 150px;
            border-radius: 100%;
        }

        .form-wrapper {
            padding: 20px;
            border-radius: 10px;
            background-color: #F6F9FE;
        }

        .register_btn {
            width: 25%;
        }

        .login_btn {
            width: 25%;
        }

        #code {
            color: #000000;
            /*字体颜色白色*/
            background-color: #ffffff;
            font-size: 20pt;
            font-family: "华康娃娃体W5";
            padding: 5px 25px 5px 25px;
            margin-left: 5%;
        }

        #change_click {
            cursor: pointer;
        }

        #search_pass_link {
            width: 70%;
            text-align: right;
            margin: 0 auto;
            padding: 5px;
        }

        .main_bar {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 12px;
        }

        .main_bar>form>p {
            line-height: 50px;
        }

        .main_bar_right {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #666;
        }

        .main_bar_right>p:nth-child(1) {
            border-radius: 100%;
            width: 15px;
            background-color: #8A8A8C;
            height: 15px;
            margin: 0 2px;
            font-size: 12px;
            display: flex;
        }

        .main_bar_right>p:nth-child(1)>span {
            border-radius: 100%;
            width: 15px;
            color: #fff;

            line-height: 15px;
            background-color: #8A8A8C;
            height: 15px;
            font-size: 14px;
            text-align: center;
        }

        .bottom_btn {
            display: flex;
            width: 25%;
            justify-content: space-around;
            position: absolute;
            bottom: 5%;
        }

        @media screen and (max-width:480px) {
            .form-wrapper>input {
                font-size: 13px;
            }

            .input-item {
                margin-bottom: 15px;
            }

            .login-wrapper {
                width: 92%;
            }

            .bottom_btn {
                width: 92%;
            }

            .text {
                font-size: 13px;
            }

            .head>img {
                width: 20%;
                height: 20%;
                border-radius: 100%;
            }

            .input-item {
                height: 10px;
            }
        }

        @media (min-width:480px) and (max-width:700px) {
            .login-wrapper {
                width: 75%;
            }

            .bottom_btn {
                width: 75%;
            }
        }

        @media (min-width:700px) and (max-width:1000px) {
            .login-wrapper {
                width: 50%;
            }

            .bottom_btn {
                width: 50%;
            }
        }

        @media (min-width:1000px) and (max-width:1400px) {
            .login-wrapper {
                width: 35%;
            }

            .bottom_btn {
                width: 35%;
            }
        }

        .footer{
            position: absolute;
            bottom: 50px;
            text-align: center;
            font-size: 15px;
            color: gray;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="header">
                <div class="head_name">
                    学生心理评估管理平台
                </div>
            </div>
            <div class="form-wrapper">
                <div style="display: flex;justify-content: space-between;height: 25px;
                font-size: 13px; color: red;">
                    <span id="msg"></span>
                </div>

                <input type="text" name="name" placeholder="姓名" class="input-item">
                <input type="password" name="password" placeholder="学号" class="input-item">
                <input type="text" name="captcha" placeholder="验证码" class="input-item" value="" />

                <div class="main_bar" leftmargin="0">
                    <img id="captcha" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random()" title="点击图片重新获取验证码" />
                    <p style="margin-right: 45%;margin-top: 10px;" id="change_click">换一个</p>

                </div>

                <div class="sigin_btn btn" id="signIn">登录</div>
            </div>

            <div class="footer">
                技术支持：海南心智智能信息咨询有限公司
            </div>

        </div>

    </div>
</body>
<script src="/common/js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">

    $("#change_click").click(function (){
        $("#captcha").attr('src', '{{ captcha_src() }}'+Math.random());
    })

    $("#signIn").click(function (){

        $('#msg').html('');
        var name = $("input[name='name']").val();
        var password = $("input[name='password']").val();
        var captcha = $("input[name='captcha']").val();

        if(!name || !password || !captcha){
            alert("请将信息填写完整！")
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/login',
            data: {name:name, password:password, captcha:captcha},
            dataType: 'json',
            success: function (resp){
                $('#msg').html(resp.msg);

                if(resp.statusCode == 401) {

                    $("#captcha").attr('src', '{{ captcha_src() }}'+Math.random());
                }else if(resp.statusCode == 200) {

                    window.location.href = "/user"
                }
            }
        });

    })

</script>
</html>
