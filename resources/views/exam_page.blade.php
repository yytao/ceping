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
    <title>心测</title>
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

        .wrap {
            margin: 0;
            padding: 0;
            width: 70%;
        }

        header {
            background-color: #5D60EF;
            height: 5vh;
            color: #fff;
            font-size: 18px;
            text-align: center;
            font-weight: 500;
            line-height: 28px;
            padding: 5% 0 2% 0;
        }

        .touxiang {
            width: 50px;
            height: 50px;
            vertical-align: middle;
        }

        .bubble {
            padding: 10px 15px;
            position: relative;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            background-color: #EDF4FC;
            display: table;
            word-break: keep-all;
            margin-left: 2%;
        }

        .bubble_right {
            padding: 10px 15px;
            position: relative;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            background-color: #C2C4F5;
            display: table;
            word-break: keep-all;
            margin-right: 2%;
            color: #fff;
        }

        .bubble::after {
            position: absolute;
            top: 12px;
            left: -11px;
            content: '';
            border: 6px solid transparent;
            border-right-color: #EDF4FC;
        }

        .bubble_right::after {
            position: absolute;
            top: 9px;
            left: 100%;
            content: '';
            border: 6px solid transparent;
            border-left-color: #C2C4F5;
        }

        .body_left {
            display: flex;
            margin: 2% 6%;
            line-height: 16px;
            align-items: center;
        }

        .body_right {
            display: flex;
            margin: 2% 6%;
            align-items: center;
            justify-content: end;
            line-height: 16px;
        }

        .body_class {
            margin: 5% 0 18% 0;
            height: 60vh;
            overflow-y: auto;
        }

        .btn {
            width: 25%;
            margin: 0 10px;
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            background-color: #8687F3;
            color: #fff;
            cursor: pointer;
        }

        .bottom_class {
            position: relative;
            display: flex;
            width: 100%;
            justify-content: space-around;
            margin-top: 10%;
            bottom: 18%;
        }

        .min_wrap {
            display: flex;
            justify-content: center;
        }

        @media screen and (max-width: 480px) {
            .body_left {
                margin: 10% 6%;
            }

            .body_right {
                margin: 10% 6%;
            }

            .body_class {
                margin: 5% 0 0% 0;
                height: 55vh;
            }

            .min_wrap {
                display: block;
                width: 100%;
            }

            .wrap {
                width: 100%;
            }

            header {
                font-size: 12px;
                height: 6vh;
                font-family: monospace;
                line-height: 22px;
                padding: 9% 0 1% 0;
            }

            header>p:nth-child(1) {
                line-height: 12px;
                width: 90%;
                margin: 0 auto;
            }

            .bubble {
                line-height: 14px;
                font-size: 12px;
                height: 10px;
            }

            .bubble_right {
                line-height: 14px;
                font-size: 12px;
                height: 10px;
            }

            .touxiang {
                width: 10%;
                height: 10%;
            }

            .bubble>p {
                line-height: 16px;
                padding: 4px 0 0px 0;
            }

            .bubble_right>p {
                line-height: 16px;
                padding: 4px 0 0px 0;
            }
        }
    </style>
</head>

<body>
    <div class="min_wrap">
        <div class="wrap">
            <header>
                <p>Health Status Quick Screening Checklist for International Students in China</p>
                <p>2022-O6-08 16:34:53 to 2022-06-08 17:04:53</p>
            </header>
            <div class="body_class">
                <div class="body_left">
                    <img src="/common/image/head2.png" alt="" class="touxiang">
                    <span class="bubble">
                        l will go out with a friend if they invite me over.
                    </span>
                </div>
                <div class="body_right">
                    <span class="bubble_right">
                        YES
                    </span>
                    <img src="/common/image/head2.png" alt="" class="touxiang">
                </div>
                <div class="body_left">
                    <img src="/common/image/head2.png" alt="" class="touxiang">
                    <div class="bubble">
                        l will go out with a friend if theyinvite me over.
                        <p>a. dddddd</p>
                        <p>b. ddcccc</p>
                        <p>c. dddddd</p>
                        <p>d.22222222</p>
                    </div>
                </div>
            </div>
            <div class="bottom_class">
                <div class="btn" id="btn_a">A</div>
                <div class="btn" id="btn_b">B</div>
                <div class="btn" id="btn_c">C</div>
                <div class="btn" id="btn_d">D</div>
            </div>
        </div>
    </div>
</body>

</html>
