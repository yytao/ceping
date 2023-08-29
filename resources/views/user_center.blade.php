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
    <meta name="viewport"
        content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,viewport-fit=cover">
    <title>个人中心 - 中小学生心理评估管理平台</title>
    <style>
        * {
            margin: 0;
            padding: 0;
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
            background-image: linear-gradient(to right, #FEF8E8, #ECF4F6);

        }

        .login-wrapper {
            width: 25%;
            height: 88%;
            border-radius: 15px;
        }

        .head_name {
            font-size: 38px;
            text-align: center;
        }

        .text {
            color: #9D9F9E;
            text-align: center;
            line-height: 20px;
            height: 60px;
        }

        a {
            text-decoration-line: none;
            color: #abc1ee;
        }

        .head {
            text-align: center;
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
            right: 38%;
            top: 6%;
        }

        .head>img {
            width: 30%;
            height: 30%;
            border-radius: 100%;
        }

        .body_flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .body_flex>p {
            cursor: pointer;
            width: 28%;
            height: 40px;
            border-radius: 10px;
            justify-content: center;
            display: flex;
            align-items: center;
            text-align: center;
            background-color: #EDF4FC;
            border: 1px solid #EDF4FC;
            padding: 5px;
        }

        .flex_wrap {
            display: flex;
            height: 50%;
            margin: 10% 0;
        }

        .flex_left {
            padding: 20px;
            width: 35%;
            border-radius: 10px;
            height: 80%;
            cursor: pointer;
            background-color: #BEBEFA;
            position: relative;
        }

        .flex_left>p {
            border-radius: 100%;
            background: #8587F2;
            border: 1px solid #8587F2;
            width: 16px;
            height: 16px;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            font-weight: bold;
            color: #fff;
            position: absolute;
            right: 10%;
            bottom: 5%;
        }

        .flex_right {
            width: 40%;
            margin: 0 5%;
        }

        .flex_right>p {
            height: 30%;
            cursor: pointer;
            padding: 20px;
            width: 85%;
            border-radius: 10px;

        }

        .flex_right>p:nth-child(1) {
            margin-bottom: 15%;
            background-color: #D7D7FB;
        }

        .flex_right>p:nth-child(2) {
            background-color: #EDECFE;
        }

        .botttom_class {
            display: flex;
            justify-content: space-around;
            position: relative;
            bottom: 5%;
        }

        .botttom_class>img {
            width: 6%;
        }

        @media screen and (max-width:480px) {
            .email_img {
                right: 10%;
            }

            .login-wrapper {
                width: 90%;
                font-size: 14px;
            }

            .text {
                font-size: 13px;
            }

            .head>img {
                width: 28%;
                height: 28%;
                border-radius: 100%;
            }

            .head_name {
                font-size: 24px;
            }

            .flex_right>p:nth-child(1) {
                margin-bottom: 10%;
            }
        }

        @media (min-width:480px) and (max-width:700px) {
            .login-wrapper {
                width: 75%;
            }
        }

        @media (min-width:700px) and (max-width:1000px) {
            .login-wrapper {
                width: 50%;
            }
        }

        @media (min-width:1000px) and (max-width:1400px) {
            .login-wrapper {
                width: 35%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="header">
                <div class="head">
                    <img src="/common/image/head.png" alt="">
                </div>
                <div class="head_name">
                    {{ $user->name }}
                </div>
                <div class="text"></div>
            </div>
            <div class="body_flex">
                <p>修改信息</p>
                <p>修改密码</p>
                <p id="logout">退出</p>
            </div>
            <div class="flex_wrap">
                <div class="flex_left">
                    个人心理评估系统
                    <br>
                    <br>
                    <br>

                    @foreach($examination as $k=>$item)
                        <a href="/exam/{{ $item->id }}" style="color: black;">
                            试卷{{ $k+1 }}：{{ $item->name }}
                        </a>
                        <br />
                        <br />
                    @endforeach

                </div>

                <div class="flex_right">
                    <p>学习能力评价</p>
                    <p>学习潜能评估</p>
                </div>
            </div>

            <div class="botttom_class">
                <img src="/common/image/bottom1.png" alt="">
                <img src="/common/image/bottom2.png" alt="">
                <img src="/common/image/bottom3.png" onclick="window.location.href='/user'" alt="">
            </div>
        </div>
    </div>
</body>

</html>
<script src="/common/js/jquery-3.7.0.min.js"></script>
<script>

    $("#logout").click(function (){
        window.location.href = "/logout"
    })
</script>
