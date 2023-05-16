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
    <title>首页</title>
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

        .bottom_btn {
            display: flex;
            width: 25%;
            justify-content: space-around;
            position: absolute;
            bottom: 5%;
        }

        .head_name {
            text-align: center;
            font-family: cursive;
            font-weight: bolder;
            font-size: 34px;
        }

        .text {
            text-align: center;
            line-height: 14px;
            font-size: 14px;
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
            margin-top: 50px;
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
            margin: 0 1%;
        }

        .head>img {
            width: 90px;
            height: 90px;
            border-radius: 100%;
        }

        .register_btn {
            width: 25%;
        }

        .login_btn {
            width: 25%;
        }

        header {
            display: flex;
            align-items: center;
            height: 10%;
            justify-content: center;
        }

        .home_img {
            margin: 7% 0 0 0;
            width: 100%;
        }

        .home_img>img {
            width: 100%;
        }

        .home_text {
            font-size: 16px;
            color: #3C3C3C;
            padding: 15px 5px 0 5px;
            line-height: 25px;
        }

        .home_text>p:nth-child(1) {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
            font-weight: 600;
            font-size: 18px;
        }

        @media screen and (max-width:480px) {
            .home_text>p:nth-child(1) {
                font-size: 16px;
            }

            .home_text {
                font-size: 13px;
                line-height: 20px;
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
                width: 90%;
                height: 90%;
                border-radius: 100%;
            }

            .input-item {
                height: 10px;
            }

            .head {
                text-align: center;
                width: 20%;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="login-wrapper">
            <!-- <div class="email_img">
                <img src="./img/email.png" alt="">
                <p>2</p>
            </div> -->
            <header>
                <div class="head">
                    <!-- <img src="https://bkimg.cdn.bcebos.com/pic/8326cffc1e178a82b90121e08855648da9773912426e?x-bce-process=image/watermark,image_d2F0ZXIvYmFpa2UyNzI=,g_7,xp_5,yp_5"
                        alt=""> -->
                    <img src="/common/image/chongqing_University.png" alt="">
                </div>
                <div>
                    <div class="head_name">
                        重慶醫科大學
                    </div>
                    <div class="text">chongqing Medical University</div>
                </div>
            </header>
            <div class="home_img"><img src="/common/image/home.png" alt=""></div>
            <div class="home_text">
                <p>
                    Exam Service</p>
                <p style="margin: 2% 0;">The exam service is the important service of Center of Study in China
                    Assessment. It is organized and
                    operated by Sichuan Education Association forinternational. Exchange and several well-known
                    universities , and supported by the Expert Committee for Overseas Study, and the purpose is to
                    provide
                    a source of highquality students for colleges and ...</p>
            </div>
            <div class="bottom_btn">
                <div class="login_btn btn btns" id="submit" type="submit" class="btns">登录</div>
                <div class="register_btn btn btns">注册</div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="/common/js/jquery-3.7.0.min.js"></script>
<script>
    $("#submit").click(function (){
        window.location.href = "/login"
    })
</script>
