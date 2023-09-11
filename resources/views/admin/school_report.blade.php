<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8" />
    <title>{{ $examination->school->name }}报告</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
    <link rel="icon" href="/style/report/favicon.ico" />
    <link href="/style/report/css/common.css" rel="stylesheet" />
    <link href="/style/report/css/school.css" rel="stylesheet" />
    <script>
        function editName(str){
            var replcenem='';
            //三位姓名的中间变星号
            if(str.length >= 3){
                var strSplit=str.split('');
                var strSplitone = strSplit[0];
                replcenem = strSplitone+'**';
                return replcenem
            }
            if (str.length == 2){  //两位的姓名，后面以为变星号
                var strSplit=str.split('');
                var strSplitone = strSplit[0];
                replcenem = strSplitone+'*';
                return replcenem
            }
        }
    </script>

    <style>
        .page_break{page-break-after:always;}
    </style>
</head>

<body>
<!--页面主体内容-->
<div class="main">
    <div class="page index">
        <div class="container">
            <div class="cover-box">
                <div class="cover">
                    <img src="/style/report/img/bg-school.png" alt="" />
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
                <div class="page_break">
                    <h1 class="z-title-1">学生乐成长综合素养发展测评系统</h1>
                    <p class="z-text text-indent">
                        本系统是由海南心智智能（海南心智智能信息咨询有限公司）联合国内知名专家倾力打造的针对中小学学生的心理健康服务系统。本系统运用生物学，心理学，社会学及其他交叉学科和交融领域的前沿科学成果，整合公共卫生分诊诊疗模式以及学校教育模式，通过分级筛查评估，采用自我评估方式，对中小学生认知、情绪、行为和社会四个层面的健康状况进行快速预警。
                    </p>
                    <p class="z-text text-indent">
                        另外，鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该测评结果只能作为评估个体健康状况的一项参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。
                    </p>
                </div>

                <div class="part">
                    <h1 class="z-title-2 mb-30">一、测评结果</h1>
                    <p class="z-text">
                        本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问卷比值为{{ @round(($data["low"]??0 / $data["validAnswerResult"]??0)*100, 2) }}%。（各个群体的详细信息见附录1）
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school4"></div>
                    </div>

                    <div class="z-image">
                        <h4>表1：不同人群普遍具有危险的前五个维度</h4>
                        <div class="risk_top5">
                            <table>
                                <thead>
                                <tr border-width="0">
                                    <th width="16%">风险人群</th>
                                    <th width="16%">1</th>
                                    <th width="16%">2</th>
                                    <th width="16%">3</th>
                                    <th width="16%">4</th>
                                    <th width="16%">5</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($data["highRegular"])
                                <tr>
                                    <td width="16%">
                                        <div>具有风险</div>
                                        <div>人群</div>
                                    </td>
                                    @foreach($data["highRegular"] as $k=>$item)
                                        <td width="16%">{{ config("customParams.modular")[$k] }}</td>
                                    @endforeach
                                </tr>
                                @endif

                                @if($data["level3Regular"])
                                <tr>
                                    <td width="16%">
                                        <div>三级值得</div>
                                        <div>关注人群</div>
                                    </td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                </tr>
                                @endif

                                @if($data["level2Regular"])
                                <tr>
                                    <td width="16%">
                                        <div>二级值得</div>
                                        <div>关注人群</div>
                                    </td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                </tr>
                                @endif


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-2 mb-30">二、常规维度</h2>
                    <p class="z-text text-indent">
                        @foreach($data["regular"] as $k=>$item)
                            @if($item["result"]->name == "P读写障碍")
                                @continue
                            @endif
                            在{{ $item["result"]->name }}方面，{{ $item["high"]??0 }}人具有风险；
                        @endforeach
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school6"></div>

                        <h6>注：常规维度的名词解释如附录4。</h6>
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-2 mb-30">三、特殊维度</h2>
                    <p class="z-text text-indent">
                        在自杀意念方面，{{ @$data["special"][13]??0 }}人具有危险，他们认真考虑过自杀；在自杀计划方面，{{ @$data["special"][14]??0 }}人具有危险，他们曾制定过自杀计划；在自杀或自伤行为方面，{{ @$data["special"][15]??0 }}人具有危险，他们曾出现自杀或自伤行为。
                    </p>
                    <p class="z-text text-indent">
                        在读写障碍方面，{{ @$data["special"][16]??0 }}人具有危险，他们在读写方面具有较大可能出现问题。
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school7"></div>
                    </div>
                    <div class="z-image">
                        <h4>表2： 特殊维度群体普遍具有危险的前五个维度</h4>
                        <div class="special_top5">
                            <table>
                                <thead border-width="0">
                                <tr class="zsys">
                                    <th width="18%">
                                        <div>特殊维度学生</div>
                                        <div>群体</div>
                                    </th>
                                    <th></th>
                                    <th width="14%">1</th>
                                    <th width="14%">2</th>
                                    <th width="14%">3</th>
                                    <th width="14%">4</th>
                                    <th width="14%">5</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd">
                                    <td rowspan="3">
                                        <div>自杀意识</div>
                                        <div style="margin-top: 10px;">（{{ $data["special"][13]??0 }}）人</div>
                                    </td>
                                    <td>维度</td>
                                    @foreach($data["highSpecial"][13] as $k=>$item)
                                        <td>{{ config("customParams.modular")[$k] }}</td>
                                    @endforeach
                                </tr>
                                <tr class="odd">
                                    <td>人数</td>
                                    @foreach($data["highSpecial"][13] as $k=>$item)
                                        <td>{{ $item }}</td>
                                    @endforeach
                                </tr>
                                <tr class="odd">
                                    <td>占比</td>
                                    @foreach($data["highSpecial"][13] as $k=>$item)
                                        <td>{{ round(($item / $data["special"][13])*100, 2) }}%</td>
                                    @endforeach
                                </tr>
                                <tr class="even">
                                    <td rowspan="3">
                                        <div>自杀计划</div>
                                        <div style="margin-top: 10px;">（{{ $data["special"][14]??0 }}）人</div>
                                    </td>
                                    <td>维度</td>
                                    @foreach($data["highSpecial"][14] as $k=>$item)
                                        <td>{{ config("customParams.modular")[$k] }}</td>
                                    @endforeach
                                </tr>
                                <tr class="even">
                                    <td>人数</td>
                                    @foreach($data["highSpecial"][14] as $k=>$item)
                                        <td>{{ $item }}</td>
                                    @endforeach
                                </tr>
                                <tr class="even">
                                    <td>占比</td>
                                    @foreach($data["highSpecial"][14] as $k=>$item)
                                        <td>{{ round(($item / $data["special"][14])*100, 2) }}%</td>
                                    @endforeach
                                </tr>
                                <tr class="odd">
                                    <td rowspan="3">
                                        <div>自杀行为或自伤行为</div>
                                        <div style="margin-top: 10px;">（{{ $data["special"][15]??0 }}）人</div>
                                    </td>
                                    <td>维度</td>
                                    @foreach($data["highSpecial"][15] as $k=>$item)
                                        <td>{{ config("customParams.modular")[$k] }}</td>
                                    @endforeach
                                </tr>
                                <tr class="odd">
                                    <td>人数</td>
                                    @foreach($data["highSpecial"][15] as $k=>$item)
                                        <td>{{ $item }}</td>
                                    @endforeach
                                </tr>
                                <tr class="odd">
                                    <td>占比</td>
                                    @foreach($data["highSpecial"][15] as $k=>$item)
                                        <td>{{ round(($item / $data["special"][15])*100, 2) }}%</td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="fulu">
                        <h4>附录1：不同群体的具体维度情况</h4>
                        <div class="z-image">
                            <div class="risk_info">
                                <table>
                                    <thead>
                                    <tr>
                                        <th width="11%">风险等级</th>
                                        <th width="4%">序号</th>
                                        <th width="12%">登录账号</th>
                                        <th width="7%">班级</th>
                                        <th width="7%">姓名</th>
                                        <th width="7%">姓别</th>
                                        <th width="32%">具有危险的常规维度</th>
                                        <th width="20%">具有危险的特殊维度</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["result"]["high"] as $k=>$item)
                                        <tr class="risk">
                                            <td width="11%">具体风险</td>
                                            <td width="4%">{{ $k+1 }}</td>
                                            <td width="12%">
                                                {{ $item->user->name }}
                                            </td>
                                            <td width="15%">
                                                {{ $item->user->grade }}
                                            </td>
                                            <td width="7%"><script>document.write(editName('{{ $item->user->name }}'))</script></td>
                                            <td width="7%">{{ $item->user->gender }}</td>
                                            <td width="32%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                    @endforeach

                                    @foreach($data["result"]["level3"] as $k=>$item)
                                        <tr class="three-level">
                                            <td width="11%">三级值得关注</td>
                                            <td width="4%">{{ $k+1 }}</td>
                                            <td width="12%">
                                                {{ $item->user->name }}
                                            </td>
                                            <td width="15%">
                                                {{ $item->user->grade }}
                                            </td>
                                            <td width="7%"><script>document.write(editName('{{ $item->user->name }}'))</script></td>
                                            <td width="7%">{{ $item->user->gender }}</td>
                                            <td width="32%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                    @endforeach

                                    @foreach($data["result"]["level2"] as $k=>$item)
                                        <tr class="two-level">
                                            <td width="11%">二级值得关注</td>
                                            <td width="4%">{{ $k+1 }}</td>
                                            <td width="12%">
                                                {{ $item->user->name }}
                                            </td>
                                            <td width="15%">
                                                {{ $item->user->grade }}
                                            </td>
                                            <td width="7%"><script>document.write(editName('{{ $item->user->name }}'))</script></td>
                                            <td width="7%">{{ $item->user->gender }}</td>
                                            <td width="32%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                    @endforeach

                                    @foreach($data["result"]["level1"] as $k=>$item)
                                        <tr class="one-level">
                                            <td width="11%">一级值得关注</td>
                                            <td width="4%">{{ $k+1 }}</td>
                                            <td width="12%">
                                                {{ $item->user->name }}
                                            </td>
                                            <td width="15%">
                                                {{ $item->user->grade }}
                                            </td>
                                            <td width="7%"><script>document.write(editName('{{ $item->user->name }}'))</script></td>
                                            <td width="7%">{{ $item->user->gender }}</td>
                                            <td width="32%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                    @endforeach


                                    @foreach($data["result"]["low"] as $k=>$item)
                                        <tr class="low_risk">
                                            <td width="11%">风险极低</td>
                                            <td width="4%">{{ $k+1 }}</td>
                                            <td width="12%">
                                                {{ $item->user->name }}
                                            </td>
                                            <td width="15%">
                                                {{ $item->user->grade }}
                                            </td>
                                            <td width="7%"><script>document.write(editName('{{ $item->user->name }}'))</script></td>
                                            <td width="7%">{{ $item->user->gender }}</td>
                                            <td width="32%"></td>
                                            <td width="20%"></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h4>附录2:问题问卷作答情况</h4>
                        <p class="z-text-near">注：</p>
                        <p class="z-text-near">
                            1.作答判定为无效,建议24小时后进行重测，再测无效，建议与学生沟通交流。
                        </p>
                        <p class="z-text-near">
                            2.判定标准为“有效*”表示该生具有社会赞许性倾向，问卷作答结果经过该生的美化，无法保证真实性。
                        </p>
                        <div class="z-image">
                            <div class="question1">
                                <table>
                                    <thead>
                                    <tr>
                                        <th width="7%">序号</th>
                                        <th width="15%">登陆账号</th>
                                        <th width="8%">班级</th>
                                        <th width="10%">姓名</th>
                                        <th width="10%">性别</th>
                                        <th width="29%">甄别题</th>
                                        <th width="14%">社会赞许性</th>
                                        <th width="7%">判定</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["invalidAnswerResult"] as $k=>$item)
                                    <tr>
                                        <td width="7%">{{ $k+1 }}</td>
                                        <td width="15%">
                                            {{ $item->user->name }}
                                        </td>
                                        <td width="15%">
                                            {{ $item->user->grade }}
                                        </td>
                                        <td width="10%">
                                            <script>document.write(editName('{{ $item->user->name }}'))</script>
                                        </td>
                                        <td width="7%">{{ $item->user->gender }}</td>
                                        <td width="29%">{{ $item->wrongTitle }}</td>
                                        <td width="14%">{{ $item->S }}</td>
                                        <td width="7%">无效</td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h4>附录3:问题问卷作答情况</h4>
                        <div class="z-image">
                            <div class="question2">
                                <table>
                                    <thead>
                                    <tr>
                                        <th width="7%">序号</th>
                                        <th width="15%">登陆账号</th>
                                        <th width="15%">班级</th>
                                        <th width="10%">姓名</th>
                                        <th width="10%">性别</th>
                                        <th width="50%">未参加测评原因（学校填写）</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data["unExamUser"] as $k=>$item)
                                    <tr>
                                        <td width="7%">{{ $k+1 }}</td>
                                        <td width="15%">
                                            {{ $item["name"] }}
                                        </td>
                                        <td width="15%">
                                            {{ $item["grade"] }}
                                        </td>
                                        <td width="10%">
                                            <script>document.write(editName('{{ $item["name"] }}'))</script>
                                        </td>
                                        <td width="7%">{{ $item["gender"] }}</td>
                                        <td width="50%"></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script src="/style/report/js/echarts-5.4.3.min.js"></script>
<script src="/style/report/js/manifest.js"></script>
<script src="/style/report/js/common.js"></script>
<script src="/style/report/js/school.js"></script>
<!-- 引入echarts JQ -->

<script src="/style/login/js/jquery.min.js"></script>

<script type="text/javascript">

    // 学生总数
    studentTotal = {{ $data["totalStudent"] }}

    /* 问卷结果分析 */
    $(document).ready(function () {
        // 指定图标的配置和数据



        /* 测评结果 */
        var myChart4 = echarts.init(document.getElementById("school4"));
        myChart4.setOption({
            backgroundColor: "#ecf0f5",
            color: ["#FF0000", "#FFFF00", "#7030A0", "#0000FF", "#00FF00"],
            // title: {
            //   text: "问卷结果分析",
            //   left: 10,
            //   top: 15,
            // },
            legend: {
                orient: "horizontal",
                itemWidth: 8, // 图例图形宽度
                itemHeight: 8, // 图例图形高度
                x: "center",
                y: "bottom",
                data: ["风险极低", "一级值得关注", "二级值得关注", "三级值得关注", "具有风险"],
            },
            series: [
                {
                    clockwise: false,
                    name: "访问量",
                    type: "pie",
                    data: [
                        { value: {{ $data["high"] }}, name: "具有风险" },
                        { value: {{ $data["level3"] }}, name: "三级值得关注" },
                        { value: {{ $data["level2"] }}, name: "二级值得关注" },
                        { value: {{ $data["level1"] }}, name: "一级值得关注" },
                        { value: {{ $data["low"] }}, name: "风险极低" },
                    ],
                    label: {
                        color: "#000",
                        fontSize: 18,
                        // show: false,
                        formatter: `{b},{c}人`
                    },
                    labelLine: {
                        lineStyle: {
                            color: "#000"
                        }
                    },
                    itemStyle: {
                        borderColor: "#fff",
                        borderWidth: 2
                    }
                },
            ],
        });



        /* 常规维度 */
        var myChart6 = echarts.init(document.getElementById("school6"));
        myChart6.setOption({
            color: ["#5b9bd5"],
            grid: {
                bottom: 90,
            },
            xAxis: {
                data: [
                    "A网瘾",
                    "B社交障碍",
                    "C抑郁",
                    "D压力",
                    "E注意力缺陷",
                    "F学习倦怠",
                    "G睡眠问题",
                    "H越轨行为",
                    "I社交焦虑",
                    "J社交媒体成瘾",
                    "K暴力",
                    "L冷漠",
                ],
                axisLabel: {
                    //展示角度
                    rotate: 60,
                    interval: 0,
                    color: "#000",
                    fontSize: 16
                },
                axisTick: {
                    alignWithLabel: true,
                    lineStyle: {
                        color: "#5B9BD5",
                        width: 2
                    }
                },
                axisLine: {
                    lineStyle: {
                        color: "#5B9BD5",
                        width: 2
                    }
                }
            },
            yAxis: [
                {
                    type: "value",
                    nameTextStyle: { color: "#666666" },
                    axisTick: { show: false },
                    axisLine: { show: false },
                    axisLabel: {
                        show: true,
                        // formatter: "{value}%",
                    },
                },
            ],
            series: [
                {
                    name: "考生分析",
                    type: "bar",
                    data: [{{ @implode(',', $data["school6"]["value"]) }}],
                    barWidth: 25,
                    label: {
                        normal: {
                            show: true,
                            position: "top",
                            textStyle: {
                                color: "#000",
                                fontSize: 16,
                                lineHeight: 20,
                                fontWeight: "blod"
                            },
                            formatter: function (params) {
                                return `${params.value}人\n${(params.value / studentTotal * 100).toFixed(2)}%`
                            }
                        },

                    },
                },
            ],
        });



        /* 特殊维度 */
        var myChart7 = echarts.init(document.getElementById("school7"));
        myChart7.setOption({
            xAxis: {
                data: ["M自杀意念", "M自杀计划", "0自杀或自伤行为", "P读写障碍"],
                axisTick: {
                    show: false,
                },
                axisLabel: {
                    interval: 0,
                    fontSize: 18,
                    color: "#000"
                },
            },
            yAxis: [
                {
                    type: "value",
                    nameTextStyle: { color: "#666666" },
                    axisTick: { show: false },
                    axisLine: { show: false },
                    axisLabel: {
                        show: true,
                    },
                },
            ],
            series: [
                {
                    name: "考生分析",
                    type: "bar",
                    data: [{{ $data["special"][13]??0 }}, {{ $data["special"][14]??0 }}, {{ $data["special"][15]??0 }}, {{ $data["special"][16]??0 }}],
                    // showBackground: true,
                    // backgroundStyle: {
                    //   color: "rgba(84, 112, 198)",
                    // },
                    barWidth: 55,
                    itemStyle: {
                        normal: {
                            color: function (params) {
                                var colorList = [
                                    "#ffc000",
                                    "#c55a11",
                                    "#ff0000",
                                    "#5b9bd5",
                                ];
                                return colorList[params.dataIndex];
                            },
                        },
                    },
                    label: {
                        normal: {
                            show: true,
                            position: "top",
                            textStyle: {
                                color: "#000",
                                fontSize: 14,
                                lineHeight: 20,

                                fontWeight: "blod"
                            },
                            formatter: function (params) {
                                return `${params.value}人\n${(params.value / studentTotal * 100).toFixed(2)}%`
                            }
                        },
                    },
                },
            ],
        });


        function sum(arr) {
            // 数组求和
            return eval(arr.join("+"));
        }
        $(window).resize(function () {
            myChart1.resize()
            myChart2.resize()
            myChart3.resize()
            myChart4.resize()
            myChart6.resize()
            myChart7.resize()
        })
    })

</script>
<style>
    .echarts-box {
        width: 100%;
        height: 380px;
        background: #ecf0f5;
        margin-bottom: 10px;
    }

    #shool6,
    #shool7 {
        border: 2px solid #9f9f9f;
    }
</style>

