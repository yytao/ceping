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
    <title>登录</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="login-wrapper">
            <!-- <div class="email_img">
                <img src="./img/email.png" alt="">
                <p>2</p>
            </div> -->
            <div class="header">
                <div class="head">
                    <!-- <img src="https://bkimg.cdn.bcebos.com/pic/8326cffc1e178a82b90121e08855648da9773912426e?x-bce-process=image/watermark,image_d2F0ZXIvYmFpa2UyNzI=,g_7,xp_5,yp_5"
                        alt=""> -->
                    <img src="/common/image/chongqing_University.png" alt="">
                </div>
                <div class="head_name">
                    重慶醫科大學
                </div>
                <div class="text">chongqing Medical University</div>
            </div>
            <div class="form-wrapper">
                <div style="display: flex;justify-content: space-between;height: 25px;
                font-size: 13px;"><span>Evaluation of Adaptability</span><span>Sign in</span></div>
                <input type="text" name="Name" placeholder="Email / Registration No" class="input-item">
                <input type="text" name="password" placeholder="Passsword" class="input-item">
                <input type="texts" id="input-val" name="Number" placeholder="Type the text below" class="input-item"
                    value="" onfocus="this.value=''" onblur="if(this.value=='')this.value=''" />

                <div class="main_bar" leftmargin="0" onload="changeImg()">
                    <form action="login.html" onsubmit="return check()" style="display: flex;">
                        <!-- <span id="code"
                            title="change">8576</span> --> <canvas id="canvas" width="100" height="30"></canvas>
                        <div id="search_pass_link">
                        </div>
                        <!-- <input type="submit" id="submit" value="登陆" class="btns"
                            onmouseover="this.style.backgroundColor='#FF8D00'"
                            onmouseout="this.style.backgroundColor='#FC5628'"> -->
                        <!-- <input type="reset" value="取消" class="btns" onmouseover="this.style.backgroundColor='#FF8D00'"
                            onmouseout="this.style.backgroundColor='#FC5628'"> -->
                        <p id="change_click">Change</p>
                    </form>


                    <a class="main_bar_right" href="">
                        <p><span>?</span></p>
                        <p><span>Forgot password</span></p>
                    </a>
                </div>
                <div class="sigin_btn btn" id="signIn">Sign in</div>
                <div class="msg">
                    Don't have account?
                    <a href="#" style="color: #000;">Sign up</a>
                </div>
            </div>

        </div>
    </div>
</body>
<script src="/common/js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">

    $("#signIn").click(function (){
        window.location.href = "/user"
    })

    $(function () {
        var show_num = [];
        draw(show_num);

        $("#change_click").on('click', function () {
            draw(show_num);
            console.log("draw(show_num);");
        })
        $("#submit").on('click', function () {
            var val = $("#input-val").val().toLowerCase();
            var num = show_num.join("");
            if (val == '') {
                alert('请输入验证码！');
            } else if (val == num) {
                alert('提交成功！');
                $("#input-val").val('');
                // draw(show_num);

            } else {
                alert('验证码错误！请重新输入！');
                $("#input-val").val('');
                // draw(show_num);
            }
        })
    })

    //生成并渲染出验证码图形
    function draw(show_num) {
        var canvas_width = $('#canvas').width();
        var canvas_height = $('#canvas').height();
        var canvas = document.getElementById("canvas");//获取到canvas的对象，演员
        var context = canvas.getContext("2d");//获取到canvas画图的环境，演员表演的舞台
        canvas.width = canvas_width;
        canvas.height = canvas_height;
        // a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,s,t,u,v,w,x,y,z,A,B,C,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,W,X,Y,Z,
        var sCode = "1,2,3,4,5,6,7,8,9,0";
        var aCode = sCode.split(",");
        var aLength = aCode.length;//获取到数组的长度

        for (var i = 0; i < 4; i++) {  //这里的for循环可以控制验证码位数（如果想显示6位数，4改成6即可）
            var j = Math.floor(Math.random() * aLength);//获取到随机的索引值
            // var deg = Math.random() * 30 * Math.PI / 180;//产生0~30之间的随机弧度
            var deg = Math.random() - 0.5; //产生一个随机弧度
            var txt = aCode[j];//得到随机的一个内容
            show_num[i] = txt.toLowerCase();
            var x = 10 + i * 20;//文字在canvas上的x坐标
            var y = 20 + Math.random() * 8;//文字在canvas上的y坐标
            context.font = "bold 23px 微软雅黑";

            context.translate(x, y);
            context.rotate(deg);

            context.fillStyle = randomColor();
            context.fillText(txt, 0, 0);

            context.rotate(-deg);
            context.translate(-x, -y);
        }
        for (var i = 0; i <= 5; i++) { //验证码上显示线条
            context.strokeStyle = randomColor();
            context.beginPath();
            context.moveTo(Math.random() * canvas_width, Math.random() * canvas_height);
            context.lineTo(Math.random() * canvas_width, Math.random() * canvas_height);
            context.stroke();
        }
        for (var i = 0; i <= 30; i++) { //验证码上显示小点
            context.strokeStyle = randomColor();
            context.beginPath();
            var x = Math.random() * canvas_width;
            var y = Math.random() * canvas_height;
            context.moveTo(x, y);
            context.lineTo(x + 1, y + 1);
            context.stroke();
        }
    }

    //得到随机的颜色值
    function randomColor() {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return "rgb(" + r + "," + g + "," + b + ")";
    }
</script>

</html>
