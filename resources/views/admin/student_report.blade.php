<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}报告</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <link rel="icon" href="/style/report/favicon.ico">
    <link href="/style/report/css/common.css" rel="stylesheet">
    <link href="/style/report/css/index.css" rel="stylesheet">
</head>

<body>
    <!--页面主体内容-->
    <div class="main">
        <div class="page index">
            <div class="container">
                <div class="cover-box">
                    <div class="cover">
                        <img src="/style/report/img/bg-student.png" alt="">
                    </div>
                    <div class="info">
                        <h2>{{ $user->name }}</h2>
                        <h3>{{ $user->school->name }}（{{ $user->grade }}{{ $user->class }}班）</h3>
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
                        本系统是由海南心智智能（海南心智智能信息咨询有限公司）联合国内知名专家倾力打造的针对中小学学生的心理健康服务系统。本系统运用生物学，心理学，社会学及其他交叉学科和交融领域的前沿科学成果，整合公共卫生分诊诊疗模式以及学校教育模式，通过分级筛查评估，采用自我评估方式，对中小学生认知、情绪、行为和社会四个层面的健康状况进行快速预警。
                    </p>
                    <p class="z-text text-indent">
                        另外，鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该测评结果只能作为评估个体健康状况的一项参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。
                    </p>
                    <div>
                        <h1 class="z-title-2 pt-30">学生信息</h1>
                        <div class="student-info">
                            <p><span>姓名</span><span>{{ $user->name }}</span></p>
                            <p><span>性别</span><span>{{ $user->gender }}</span></p>
                            <p><span>学校</span><span>{{ $user->school->name }}</span></p>
                            <p><span>班级</span><span>{{ $user->grade }}{{ $user->class }}</span></p>
                        </div>
                        <div class="student-state">
                            <p class="mb-25">声明：</p>
                            <p style="text-indent: 2em;">
                                鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该筛查结果只能作为评估个体健康状况的一项参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。
                            </p>
                        </div>
                    </div>
                    <!--分块内容-->
                    <div class="part">
                        <h2 class="z-title-3">情况概述</h2>
                        <div class="z-image">
                            <!-- <img style="width: 360px;" src="./img/image1.png" alt=""> -->
                            <div id="over-view"></div>

                        </div>
                        <p class="z-text">{{ @$data["Y_msg"] }}</p>
                        <p class="z-text-danger">注：百分比越高，出现心理问题的几率会越高，更需关注</p>
                    </div>
                    <!--关键指标-->
                    <div class="part">
                        <h2 class="z-title-3">关键指标</h2>
                        <p class="z-text-mix"><span>暴力倾向：</span>{{ $data["regular"][11]["title"] }}</p>
                        <p class="z-text-mix"><span>抑郁倾向：</span>{{ $data["regular"][3]["title"] }}</p>
                        <p class="z-text-mix">
                            <span>
                            自杀倾向：</span>{{ $data["regular"][3]["title"] }}
                            @if($data["special"] != 0)
                                该学生曾有过{{ $data["special_title"] }}
                            @else
                                ，未触发自杀答题条件
                            @endif
                        </p>
                    </div>
                    
                    <!--消极方面-->
                    <div class="part">
                        
                        <div class="fulu">
                            <h4>附录4：常规维度与特殊维度的名词解释</h4>
                            @foreach($data["regular"] as $k=>$item)
                            <p>
                                <span>{{ $item["result"]->name }}：</span>
                                {{ $item["msg"] }}
                            </p>
                            @endforeach

                        </div>
                    </div>
                    <!--名词解释-->
                    <div class="part">
                        <h2 class="z-title-3">名词解释</h2>
                        <p class="z-text">ꔷ 风险极低：该生测试结果显示，在各维度指标都处在一个相对良好的状态，其心理健康水平也能保持在一个较高的水准，无需过多关注。</p>
                        <p class="z-text">ꔷ 值得关注：该生测试结果通过综合测算，偏离正常群体的得分范围，不排除未来可能会做出发生心理健康问题，特做出预警，需要持续跟进并进行进一步的个体评估。</p>
                        <p class="z-text">ꔷ 具有风险：该生测试结果通过综合测算，偏离正常群体的得分范围较大，具有较高概率产生心理健康问题的风险，建议进一步个体评估，寻求专业精神科医生帮助。</p>
                        <p class="z-text">注：本报告最终解释权归COSICA所有。</p>
                    </div>
                    <!--免责声明-->
                    <div class="part">
                        <h2 class="z-title-3">免责声明</h2>
                        <p class="z-text text-indent">
                            鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该测评结果只能作为评估个体健康状况的一项预警参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/style/report/js/jquery-3.1.1.min.js"></script>
    <script src="/style/report/js/echarts-5.4.3.min.js"></script>
    <script src="/style/report/js/echarts-wordcloud.js"></script>
    <script src="/style/report/js/manifest.js"></script>
    <script src="/style/report/js/common.js"></script>
    <script src="/style/report/js/index.js"></script>
    <script>
        $(document).ready(function() {
            var maskImage = new Image();
            maskImage.src = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjI1NnB4IiBoZWlnaHQ9IjI1NnB4IiB2aWV3Qm94PSIwIDAgNTQ4LjE3NiA1NDguMTc2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NDguMTc2IDU0OC4xNzY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNNTI0LjE4MywyOTcuMDY1Yy0xNS45ODUtMTkuODkzLTM2LjI2NS0zMi42OTEtNjAuODE1LTM4LjM5OWM3LjgxLTExLjk5MywxMS43MDQtMjUuMTI2LDExLjcwNC0zOS4zOTkgICBjMC0yMC4xNzctNy4xMzktMzcuNDAxLTIxLjQwOS01MS42NzhjLTE0LjI3My0xNC4yNzItMzEuNDk4LTIxLjQxMS01MS42NzUtMjEuNDExYy0xOC4yNzEsMC0zNC4wNzEsNS45MDEtNDcuMzksMTcuNzAzICAgYy0xMS4yMjUtMjcuMDI4LTI5LjA3NS00OC45MTctNTMuNTI5LTY1LjY2N2MtMjQuNDYtMTYuNzQ2LTUxLjcyOC0yNS4xMjUtODEuODAyLTI1LjEyNWMtNDAuMzQ5LDAtNzQuODAyLDE0LjI3OS0xMDMuMzUzLDQyLjgzICAgYy0yOC41NTMsMjguNTQ0LTQyLjgyNSw2Mi45OTktNDIuODI1LDEwMy4zNTFjMCwyLjg1NiwwLjE5MSw2Ljk0NSwwLjU3MSwxMi4yNzVjLTIyLjA3OCwxMC4yNzktMzkuODc2LDI1LjgzOC01My4zODksNDYuNjg2ICAgQzYuNzU5LDI5OS4wNjcsMCwzMjIuMDU1LDAsMzQ3LjE4YzAsMzUuMjExLDEyLjUxNyw2NS4zMzMsMzcuNTQ0LDkwLjM1OWMyNS4wMjgsMjUuMDMzLDU1LjE1LDM3LjU0OCw5MC4zNjIsMzcuNTQ4aDMxMC42MzYgICBjMzAuMjU5LDAsNTYuMDk2LTEwLjcxNSw3Ny41MTItMzIuMTIxYzIxLjQxMy0yMS40MTIsMzIuMTIxLTQ3LjI0OSwzMi4xMjEtNzcuNTE1ICAgQzU0OC4xNzIsMzM5Ljc1Nyw1NDAuMTc0LDMxNi45NTIsNTI0LjE4MywyOTcuMDY1eiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo='
            // 情况概述
            var qkgschartDom = document.getElementById('over-view');
            var qkgsmyChart = echarts.init(qkgschartDom);
            var qkgsoption;
            qkgsoption = {
                title: {
                    text: '{{ $data["Y"] }}%',
                    subtext: "{{ @$data["Y_title"] }}",
                    textStyle: {
                        color: '#000000',
                        fontSize: 50,
                    },
                    subtextStyle: {
                        fontSize: 65,
                        fontWeight: 'bolder',
                        color: '#359246'
                    },
                    x: 'center',
                    y: '25%',
                    fontSize: 65,
                    fontWeight: 'bolder',
                    color: '#359246',
                },
                series: [{
                    type: 'pie',
                    radius: ['85%', '100%'],
                    emphasis: {
                        disabled: true,
                    },
                    label: false,
                    labelLine: false,

                    data: [{
                            value: {{ $data["Y"] }},
                            name: '1'
                        },
                        {
                            value: {{ 100-$data["Y"] }},
                            name: '2'
                        },
                    ],
                    color: ['#b23229', '#3a6eae'],

                }]
            };
            qkgsoption && qkgsmyChart.setOption(qkgsoption);


            setProgress("#sjhd", 30)
            setProgress("#cywt", 70)
            setProgress("#blxw", 50)

            function setProgress(dom, percent) {
                $(dom).children(".progress").children(".progress_bar").width(`${percent}%`)
                $(dom).children(".percent").text(`${percent}%`)
                $(dom).children(".percent").css("left", `${percent}%`)
            }
            $(window).resize(() => {
                qkgsmyChart.resize()
                jjfmbwordcloud.resize()
                xjfmbwordcloud.resize()
                xjfm2bwordcloud.resize()
            })
        })
    </script>
</body>

</html>