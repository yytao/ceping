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
                <p>
                    {{ $examination->name }}
                </p>
            </header>
            <div class="body_class" id="questionZone">





            </div>

            <div class="bottom_class" id="answerZone">

            </div>
            <input type="hidden" id="questionId" value="" />
            <input type="hidden" id="modularId" value="" />

        </div>
    </div>
</body>

</html>
<script src="/common/js/jquery-3.7.0.min.js"></script>
<script>
    var question;
    var answer = []
    var type = '';

    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/exam/getQuestion',
            data: {id:{{ $examination->id }}},
            dataType: 'json',
            success: function (resp){
                if(resp.code == 400) {

                    let questionHtml = "<div class='body_left'><img src='/common/image/head2.png' class='touxiang'><span class='bubble'>"+resp.msg+"</span></div>"
                    $("#questionZone").append(questionHtml)

                }else if(resp.code == 200) {
                    $("#questionZone").html('')
                    question = resp.data
                    nextQuestion()
                }
            }
        });
    });

    var number = 0;
    function nextQuestion() {
        let item = question.shift()

        let questionHtml = "<div class='body_left'><img src='/common/image/head2.png' class='touxiang'><span class='bubble'>"+item["question"]+"</span></div>"
        $("#questionId").val(item["id"]);
        $("#modularId").val(item["modular_id"]);

        let answerHtml = "";
        var answer = item["answer"]
        for( var key in answer){
            answerHtml += "<div class='btn answerBtn' data-type='"+item["type"]+"' data-title='"+answer[key].title+"' data-score='"+answer[key].score+"'>"+answer[key].title+"</div>"
        }

        $("#answerZone").html('')
        $("#answerZone").append(answerHtml)
        $("#questionZone").append(questionHtml)
        var height = document.getElementById('questionZone').scrollHeight;
        document.getElementById('questionZone').scroll({ top: height , left: 0, behavior: 'smooth'})
    }


    function nextQuestionExtra(type) {
        let item = question[type].shift()

        let questionHtml = "<div class='body_left'><img src='/common/image/head2.png' class='touxiang'><span class='bubble'>"+item["question"]+"</span></div>"
        $("#questionId").val(item["id"]);
        $("#modularId").val(item["modular_id"]);

        let answerHtml = "";
        var answer = item["answer"]
        for( var key in answer){
            answerHtml += "<div class='btn answerBtnExtra' data-type='"+item["type"]+"' data-title='"+answer[key].title+"' data-score='"+answer[key].score+"'>"+answer[key].title+"</div>"
        }

        $("#answerZone").html('')
        $("#answerZone").append(answerHtml)
        $("#questionZone").append(questionHtml)
        var height = document.getElementById('questionZone').scrollHeight;
        document.getElementById('questionZone').scroll({ top: height , left: 0, behavior: 'smooth'})
    }
</script>

<script defer="defer">
    $(function (){
        $("#answerZone").on('click', '.answerBtn', function (){
            var title = $(this).attr('data-title')
            var score = $(this).attr('data-score')
            var type = $(this).attr('data-type')
            var question_id = $("#questionId").val()
            var modular_id = $("#modularId").val()

            answer.push({title:title, score:score, type:type, question_id:question_id, modular_id:modular_id})

            answerHtml = "<div class='body_right'><span class='bubble_right'>"+title+"</span><img src='/common/image/head2.png' class='touxiang'></div>"

            $("#questionZone").append(answerHtml)
            var height = document.getElementById('questionZone').scrollHeight;
            document.getElementById('questionZone').scroll({ top: height , left: 0, behavior: 'smooth'})

            if(Object.keys(question).length == 0){

                $("#answerZone").html("<div class='btn submitBtn'>提交</div>")
            }else{
                nextQuestion()
            }
        })

        $("#answerZone").on('click', '.answerBtnExtra', function (){
            var title = $(this).attr('data-title')
            var score = $(this).attr('data-score')
            var type = $(this).attr('data-type')
            var question_id = $("#questionId").val()
            var modular_id = $("#modularId").val()

            answer.push({title:title, score:score, type:type, question_id:question_id, modular_id:modular_id})

            answerHtml = "<div class='body_right'><span class='bubble_right'>"+title+"</span><img src='/common/image/head2.png' class='touxiang'></div>"

            $("#questionZone").append(answerHtml)
            var height = document.getElementById('questionZone').scrollHeight;
            document.getElementById('questionZone').scroll({ top: height , left: 0, behavior: 'smooth'})

            if(Object.keys(question[type]).length == 0){

                if(type == 'A') {
                    type = 'B'
                } else {
                    $("#answerZone").html("<div class='btn submitBtnExtra'>提交</div>")
                    return;
                }
            }

            if((type == 'A' && score == 0) || Object.keys(question['A']).length == 0) {
                type = 'B'
            }
            nextQuestionExtra(type)
        })


        $("#answerZone").on('click', '.submitBtn', function (){
            if(confirm("确认要提交吗？")){

                $.ajax({
                    type: 'POST',
                    url: '/exam/result',
                    data: {id:{{ $examination->id }}, result:answer},
                    dataType: 'json',
                    success: function (resp){
                        if(resp.code == 200) {
                            alert(resp.msg)
                            window.location.href = "/user"

                        }else if(resp.code == 300) {

                            console.log(resp.data)
                            question = resp.data
                            if(resp.data['A']) {
                                type = 'A'
                            }else {
                                type = 'B'
                            }
                            nextQuestionExtra(type)

                        }else if(resp.code == 400) {
                            alert(resp.msg)
                        }
                    }
                });
            }
        })


        $("#answerZone").on('click', '.submitBtnExtra', function (){
            if(confirm("确认要提交吗？")){

                $.ajax({
                    type: 'POST',
                    url: '/exam/resultExtra',
                    data: {id:{{ $examination->id }}, result:answer},
                    dataType: 'json',
                    success: function (resp){
                        if(resp.code == 200) {
                            alert(resp.msg)
                            window.location.href = "/user"

                        }else if(resp.code == 300) {

                            console.log(resp.data)
                            question = resp.data
                            if(resp.data['A']) {
                                type = 'A'
                            }else {
                                type = 'B'
                            }
                            nextQuestionExtra(type)

                        }else if(resp.code == 400) {
                            alert(resp.msg)
                        }
                    }
                });
            }
        })

    })

</script>
