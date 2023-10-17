<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $examination->name }} - 学生心理评估管理平台</title>
    <link rel="stylesheet" href="/style/web_exam/css/index.css">
    <link rel="stylesheet" href="/style/web_exam/css/common.css">
    <meta name="csrf-token" content="<?= csrf_token() ?>">

</head>

<body>
<div class="content">
    <div class="contetn_box">
        <div class="content_name">学生综合成长管理平台</div>
        <div class="content_info">
            <div class="info_title">{{ $examination->name }}</div>
            <div class="info_box">
                <div class="info_select">
                    <div class="user_info">
                        <!-- 如果有头像使用下面节点 -->
                        <div class="user_img" >
                            <span >{{ $user->name }}</span>
                            <div class="user_plus">+</div>
                        </div>

                        <!-- <div class="user_img" style="background-color: #1D88F6;">
                            <div class="user_plus">+</div>
                        </div> -->
                        <div class="user_name">{{ $user->name }}</div>
                        <div class="user_code">学号: <span>{{ $user->student_code }}</span></div>
                        <div class="from_class">{{ $user->grade }}年级{{ $user->class }}班</div>
                    </div>
                    <div class="massage_select" id="massage_select">
                        <!-- 此处填充的是问题的序号 -->
                    </div>
                </div>
                <div class="info_dialog">
                    <div class="dialog_box" id="dialog_box">
                        <!-- 此处填充的是问题 -->
                    </div>
                    <div class="select_box" id="select_box">
                        <!-- 此处填充的是问题的选项 -->
                    </div>

                    <input type="hidden" id="questionId" value="" />
                    <input type="hidden" id="modularId" value="" />

                </div>
            </div>
        </div>
{{--        <div class="company_info">技术支持：<span>海南心智智能信息咨询有限公司</span></div>--}}
{{--        <div class="company_mobile">联系电话：<span>13601116871</span></div>--}}
    </div>

</div>
</body>
</html>
<script src="/style/login/js/jquery.min.js"></script>

<script>
    var question;
    var answer = []
    var type = '';

    /*
     * 获取问题
     */
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

                    let questionHtml = "<div class='dialog_massage Robot'><div class='massage'>"+resp.msg+"</div></div>"
                    $("#dialog_box").append(questionHtml)

                }else if(resp.code == 200) {
                    $("#dialog_box").html('')
                    question = resp.data
                    massage_select(question.length)

                    nextQuestion()
                }
            }
        });
    });

    function massage_select(length)
    {
        for(var i = 1; i <= length; i++)
        {
            var questionHtml = "<div class='select_item' id='select_item"+i+"'>"+i+"</div>"
            $("#massage_select").append(questionHtml)
        }
    }

    /*
     * 下一题逻辑
     */
    var number = 0;
    var answerCount = 0;    //计数，只保留前三个题目历史
    function nextQuestion() {
        if(answerCount >= 3) {
            $("#dialog_box div:first").remove()
            $("#dialog_box div:first").remove()
        } else {
            answerCount++;
        }

        let item = question.shift()

        let questionHtml = "<div class='dialog_massage Robot'><div class='massage'>"+item["question"]+"</div></div>"
        $("#questionId").val(item["id"]);
        $("#modularId").val(item["modular_id"]);

        let answerHtml = "";
        var answer = item["answer"]
        for( var key in answer){
            answerHtml += "<div class='select_item answerBtn' data-status='"+item["status"]+"' data-title='"+answer[key].title+"' data-score='"+answer[key].score+"'>"+answer[key].title+"</div>"
        }

        //选项框
        $("#select_box").html('')
        $("#select_box").append(answerHtml)

        //问题框
        $("#dialog_box").append(questionHtml)
    }

    /*
     * 钩子问题的下一题逻辑
     */
    function nextQuestionExtra(type) {
        if(answerCount >= 3) {
            $("#dialog_box div:first").remove()
            $("#dialog_box div:first").remove()
        } else {
            answerCount++;
        }

        let item = question[type].shift()
        let questionHtml = "<div class='dialog_massage Robot'><div class='massage'>"+item["question"]+"</div></div>"

        $("#questionId").val(item["id"]);
        $("#modularId").val(item["modular_id"]);

        let answerHtml = "";
        var answer = item["answer"]
        for( var key in answer){
            answerHtml += "<div class='select_item answerBtnExtra' data-type='"+type+"' data-status='"+item['status']+"' data-title='"+answer[key].title+"' data-score='"+answer[key].score+"'>"+answer[key].title+"</div>"
        }

        //选项框
        $("#select_box").html('')
        $("#select_box").append(answerHtml)

        //问题框
        $("#dialog_box").append(questionHtml)
    }
</script>

<script defer="defer">

    /*
     * 回答按钮点击后，将结果写入answer数组内
     */
    $(function (){
        var current = 1;
        $("#select_box").on('click', '.answerBtn', function (){
            var title = $(this).attr('data-title')
            var score = $(this).attr('data-score')
            var type = $(this).attr('data-type')
            var status = $(this).attr('data-status')
            var question_id = $("#questionId").val()
            var modular_id = $("#modularId").val()

            answer.push({title:title, score:score, status:status, question_id:question_id, modular_id:modular_id})

            answerHtml = "<div class='dialog_massage user'><div class='massage'>"+title+"</div></div>"

            $("#dialog_box").append(answerHtml)

            if(Object.keys(question).length == 0){

                $("#select_item"+current).addClass("active")
                $("#select_box").html("<div class='select_item submitBtn'>提交</div>")
            }else{
                $("#select_item"+current).addClass("active")
                document.getElementById("select_item"+current).scrollIntoView()
                current++
                nextQuestion()
            }
        })

        /*
         * 钩子问题回答按钮点击后，将结果写入answer数组内
         */
        $("#select_box").on('click', '.answerBtnExtra', function (){
            var title = $(this).attr('data-title')
            var score = $(this).attr('data-score')
            var type = $(this).attr('data-type')
            var status = $(this).attr('data-status')
            var question_id = $("#questionId").val()
            var modular_id = $("#modularId").val()

            answer.push({title:title, score:score, status:status, question_id:question_id, modular_id:modular_id})

            answerHtml = "<div class='dialog_massage user'><div class='massage'>"+title+"</div></div>"

            $("#dialog_box").append(answerHtml)

            if(Object.keys(question[type]).length == 0){

                if(type == 'A') {
                    type = 'B'
                } else {
                    $("#select_box").html("<div class='select_item submitBtnExtra'>提交</div>")
                    return;
                }
            }

            if((type == 'A' && score == 0) || Object.keys(question['A']).length == 0) {
                if(Object.keys(question['B']).length == 0){
                    $("#select_box").html("<div class='select_item submitBtnExtra'>提交</div>")
                    return;
                }
                type = 'B'
            }
            nextQuestionExtra(type)
        })

        /*
         * 提交
         */
        $("#select_box").on('click', '.submitBtn', function (){
            if(confirm("确认要提交吗？")){

                $.ajax({
                    type: 'POST',
                    url: '/exam/result',
                    data: {id:{{ $examination->id }}, result:answer},
                    dataType: 'json',
                    success: function (resp){
                        if(resp.code == 200) {
                            alert(resp.msg)
                            window.location.href = "/logout"

                        }else if(resp.code == 300) {

                            console.log(resp.data)
                            question = resp.data
                            if(resp.data['A'] && Object.keys(question['A']).length>0) {
                                type = 'A'
                            }else {
                                type = 'B'
                            }
                            $("#massage_select").html("")
                            nextQuestionExtra(type)

                        }else if(resp.code == 400) {
                            alert(resp.msg)
                        }
                    }
                });
            }
        })

        /*
         * 钩子问题最终提交
         */
        $("#select_box").on('click', '.submitBtnExtra', function (){
            if(confirm("确认要提交吗？")){

                $.ajax({
                    type: 'POST',
                    url: '/exam/resultExtra',
                    data: {id:{{ $examination->id }}, result:answer},
                    dataType: 'json',
                    success: function (resp){
                        if(resp.code == 200) {
                            alert(resp.msg)
                            window.location.href = "/logout"

                        }else if(resp.code == 400) {
                            alert(resp.msg)
                        }
                    }
                });
            }
        })
    })
</script>
