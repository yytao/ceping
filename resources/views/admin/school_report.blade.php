<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>{{ $examination->school->name }}报告</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <link rel="icon" href="favicon.ico">
    <link href="/report/css/common.css" rel="stylesheet">
    <link href="/report/css/school.css" rel="stylesheet">
</head>
<body>
<!--页面主体内容-->
<div class="main">
    <div class="page index">
        <div class="container">
            <div class="cover-box">
                <div class="cover">
                    <img src="/report/img/bg-school.png" alt="">
                </div>
                <div class="info">
                    <h2>{{ $examination->school->name }}</h2>
                    <h4>{{ date("Y年m月d日") }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <div class="content">
                <h1 class="z-title-1">学生乐成长综合素养发展测评系统</h1>
                <p class="z-text text-indent">
                    本系统是由海南心智智能（海南心智智能信息咨询有限公司）联合国内知名专家倾力打造的针对中小学学生的心理健康服务系统。本系统运用生物学，心理学，社会学及其他交叉学科和交融领域的前沿科学成果，整合公共卫生分诊诊疗模式以及学校教育模式，通过分级筛查评估，采用自我评估方式，对中小学生认知、情绪、行为和社会四个层面的健康状况进行快速预警。</p>
                <p class="z-text text-indent">
                    另外，鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该测评结果只能作为评估个体健康状况的一项参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。</p>
                <!--分块内容-->
                <div class="part">
                    <h1 class="z-title-2">一、报告摘要</h1>
                    <h2 class="z-title-3 mt-30 pt-30">（一）、标题标题</h2>
                    <p class="z-text text-indent">本次测评针对{{ $data["totalStudent"] }}
                        名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}
                        。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问</p>
                    <div class="z-image">
                        <img src="/report/img/image-school1.png" alt="">
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-3">（二）、标题标题</h2>
                    <p class="z-text">本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}
                        ，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问</p>
                    <div class="z-image">
                        <img src="/report/img/image-school2.png" alt="">
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-3">（三）、标题标题</h2>
                    <p class="z-text">本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}
                        ，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问</p>
                    <div class="z-image">
                        <img src="/report/img/image-school3.png" alt="">
                    </div>
                </div>
                <div class="part">
                    <h1 class="z-title-2 mb-30">一、测评结果</h1>
                    <p class="z-text">本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}
                        ，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}
                        ，占有效问卷比值为{{ round($data["low"]/$data["validAnswerResult"], 2) }}%。（各个群体的详细信息见附录1）</p>
                    <div class="z-image">
                        <img src="/report/img/image-school4.png" alt="">
                    </div>
                    <div class="z-image">
                        <h4>表1：不同人群普遍具有危险的前五个维度</h4>
                        <img src="/report/img/image-school5.png" alt="">
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-2 mb-30">二、常规维度</h2>
                    <p class="z-text text-indent">
                        @foreach($data["regular"] as $k=>$item)
                            在{{ $item["result"]->name }}方面，{{ $item["high"] }}人具有风险；

                        @endforeach
                    </p>
                    <div class="z-image">
                        <img src="/report/img/image-school6.png" alt="">
                        <h6>注：常规维度的名词解释如附录4。</h6>
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-2 mb-30">三、特殊维度</h2>
                    <p class="z-text text-indent">
                        在自杀意念方面，294人具有危险，他们认真考虑过自杀；在自杀计划方面，160人具有危险，他们曾制定过自杀计划；在自杀或自伤行为方面，63人具有危险，他们曾出现自杀或自伤行为。</p>
                    <p class="z-text text-indent">在读写障碍方面，75人具有危险，他们在读写方面具有较大可能出现问题。</p>
                    <div class="z-image">
                        <img src="/report/img/image-school7.png" alt="">
                    </div>
                    <div class="z-image">
                        <h4>表2： 特殊维度群体普遍具有危险的前五个维度</h4>
                        <img src="/report/img/image-school8.png" alt="">
                    </div>
                    <div class="fulu">
                        <h4>附录1：不同群体的具体维度情况</h4>
                        <div class="z-image">
                            <img src="/report/img/image-school9.png" alt="">
                            <img src="/report/img/image-school10.png" alt="">
                            <img src="/report/img/image-school13.png" alt="">
                        </div>
                        <h4>附录2:问题问卷作答情况</h4>
                        <p class="z-text-near">注：</p>
                        <p class="z-text-near">1.作答判定为无效,建议24小时后进行重测，再测无效，建议与学生沟通交流。</p>
                        <p class="z-text-near">2.判定标准为“有效*”表示该生具有社会赞许性倾向，问卷作答结果经过该生的美化，无法保证真实性。</p>
                        <div class="z-image">
                            <img src="/report/img/image-school11.png" alt="">
                        </div>
                        <h4>附录3:问题问卷作答情况</h4>
                        <div class="z-image">
                            <img src="/report/img/image-school12.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/report/js/manifest.js"></script>
<script src="/report/js/common.js"></script>
<script src="/report/js/school.js"></script>
</body>
</html>
