<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录 - 学生心理评估管理平台</title>
    <link rel="stylesheet" type="text/css" href="/style/login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/login/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="/style/login/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="/style/login/css/iofrm-theme16.css">
    <meta name="csrf-token" content="<?= csrf_token() ?>">

</head>
<body>
<div class="form-body without-side">

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/style/login/images/graphic3.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>学生综合成长管理平台</h3>
                    <p>欢迎光临学生综合成长管理平台，在这里您可以开启心灵旅程.</p>
                    <form action="/login" method="post">

                        @error("error")
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">
                                &times;
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        @csrf
                        <input class="form-control" type="text" name="name" placeholder="姓名" required>
                        <input class="form-control" type="password" name="password" placeholder="学号" required>
                        <input class="form-control" type="text" name="captcha" placeholder="验证码" required>

                        <div class="main_bar" leftmargin="0">
                            <img id="captcha" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random()" title="点击图片重新获取验证码" />
                            <span style="cursor: pointer;" id="change_click">换一个</span>
                        </div>

                        <div class="form-button">
                            <button id="signIn" type="submit" class="ibtn">登录</button>
                        </div>
                    </form>
                    <div class="other-links">

                    </div>
                    <div class="page-links">
                        <a href="javascript:void(0)" >技术支持：海南心智智能信息咨询有限公司</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/style/login/js/jquery.min.js"></script>
<script src="/style/login/js/popper.min.js"></script>
<script src="/style/login/js/bootstrap.min.js"></script>
<script src="/style/login/js/main.js"></script>
</body>
</html>

<script type="text/javascript">

    $("#change_click").click(function (){
        $("#captcha").attr('src', '{{ captcha_src() }}'+Math.random());
    })

</script>
