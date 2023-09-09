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
                <h1 class="z-title-1">学生乐成长综合素养发展测评系统</h1>
                <p class="z-text text-indent">
                    本系统是由海南心智智能（海南心智智能信息咨询有限公司）联合国内知名专家倾力打造的针对中小学学生的心理健康服务系统。本系统运用生物学，心理学，社会学及其他交叉学科和交融领域的前沿科学成果，整合公共卫生分诊诊疗模式以及学校教育模式，通过分级筛查评估，采用自我评估方式，对中小学生认知、情绪、行为和社会四个层面的健康状况进行快速预警。
                </p>
                <p class="z-text text-indent">
                    另外，鉴于个体对题目理解具有认知性差异及心理特征本身的复杂性，该测评结果只能作为评估个体健康状况的一项参考指标，不作任何心理疾病或不健康状况的诊断之用。如需进一步了解个体临床心理健康状况，请寻求专业精神科医生的帮助。
                </p>
                <!--分块内容-->
                <div class="part">
                    <h1 class="z-title-2">一、报告摘要</h1>
                    <h2 class="z-title-3 mt-30 pt-30">（一）、标题标题</h2>
                    <p class="z-text text-indent">
                        本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school1"></div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-3">（二）、标题标题</h2>
                    <p class="z-text">
                        本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school2"></div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="z-title-3">（三）、标题标题</h2>
                    <p class="z-text">
                        本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问
                    </p>
                    <div class="z-image">
                        <div class="echarts-box" id="school3"></div>
                    </div>
                </div>
                <div class="part">
                    <h1 class="z-title-2 mb-30">一、测评结果</h1>
                    <p class="z-text">
                        本次测评针对{{ $data["totalStudent"] }}名学生进行测评，收获问卷共有{{ $data["totalAnswerResult"] }}，有效问卷为{{ $data["validAnswerResult"] }}。基于心理测量学对测评结果进行分析，学生心理健康风险较低人数为{{ $data["low"] }}，占有效问卷比值为{{ round($data["low"]/$data["validAnswerResult"], 2) }}%。（各个群体的详细信息见附录1）
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
                                <tr>
                                    <td width="16%">
                                        <div>具有风险</div>
                                        <div>人群</div>
                                    </td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                    <td width="16%">压力</td>
                                </tr>
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
                            在{{ $item["result"]->name }}方面，{{ $item["high"] }}人具有风险；
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
                        在自杀意念方面，{{ $data["special"][13] }}人具有危险，他们认真考虑过自杀；在自杀计划方面，{{ $data["special"][14] }}人具有危险，他们曾制定过自杀计划；在自杀或自伤行为方面，{{ $data["special"][15] }}人具有危险，他们曾出现自杀或自伤行为。
                    </p>
                    <p class="z-text text-indent">
                        在读写障碍方面，{{ $data["special"][16] }}人具有危险，他们在读写方面具有较大可能出现问题。
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
                                        <div style="margin-top: 10px;">（298）人</div>
                                    </td>
                                    <td>维度</td>
                                    <td>压力</td>
                                    <td>社交焦虑</td>
                                    <td>学习倦怠</td>
                                    <td>暴力</td>
                                    <td>社交障碍</td>
                                </tr>
                                <tr class="odd">
                                    <td>人数</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                </tr>
                                <tr class="odd">
                                    <td>占比</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                </tr>
                                <tr class="even">
                                    <td rowspan="3">
                                        <div>自杀计划</div>
                                        <div style="margin-top: 10px;">（298）人</div>
                                    </td>
                                    <td>维度</td>
                                    <td>压力</td>
                                    <td>社交焦虑</td>
                                    <td>学习倦怠</td>
                                    <td>暴力</td>
                                    <td>社交障碍</td>
                                </tr>
                                <tr class="even">
                                    <td>人数</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                </tr>
                                <tr class="even">
                                    <td>占比</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                </tr>
                                <tr class="odd">
                                    <td rowspan="3">
                                        <div>自杀行为或自伤行为</div>
                                        <div style="margin-top: 10px;">（298）人</div>
                                    </td>
                                    <td>维度</td>
                                    <td>压力</td>
                                    <td>社交焦虑</td>
                                    <td>学习倦怠</td>
                                    <td>暴力</td>
                                    <td>社交障碍</td>
                                </tr>
                                <tr class="odd">
                                    <td>人数</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                    <td>237</td>
                                </tr>
                                <tr class="odd">
                                    <td>占比</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
                                    <td>10%</td>
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
                                    <tr class="risk">
                                        <td width="11%">具体风险</td>
                                        <td width="4%">1</td>
                                        <td width="12%">323342250122</td>
                                        <td width="7%"></td>
                                        <td width="7%">李**</td>
                                        <td width="7%">女</td>
                                        <td width="32%">B社交障碍、A网瘾方面B社交障碍、A网瘾方面</td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr class="three-level">
                                        <td width="11%">三级值得关注</td>
                                        <td width="4%">1</td>
                                        <td width="12%">323342250122</td>
                                        <td width="7%"></td>
                                        <td width="7%">李**</td>
                                        <td width="7%">女</td>
                                        <td width="32%">B社交障碍、A网瘾方面B社交障碍、A网瘾方面</td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr class="two-level">
                                        <td width="11%">二级值得关注</td>
                                        <td width="4%">1</td>
                                        <td width="12%">323342250122</td>
                                        <td width="7%"></td>
                                        <td width="7%">李**</td>
                                        <td width="7%">女</td>
                                        <td width="32%">B社交障碍、A网瘾方面B社交障碍、A网瘾方面</td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr class="one-level">
                                        <td width="11%">一级值得关注</td>
                                        <td width="4%">1</td>
                                        <td width="12%">323342250122</td>
                                        <td width="7%"></td>
                                        <td width="7%">李**</td>
                                        <td width="7%">女</td>
                                        <td width="32%">B社交障碍、A网瘾方面B社交障碍、A网瘾方面</td>
                                        <td width="20%"></td>
                                    </tr>
                                    <tr class="low_risk">
                                        <td width="11%">风险极低</td>
                                        <td width="4%">1</td>
                                        <td width="12%">323342250122</td>
                                        <td width="7%"></td>
                                        <td width="7%">李**</td>
                                        <td width="7%">女</td>
                                        <td width="32%">B社交障碍、A网瘾方面B社交障碍、A网瘾方面</td>
                                        <td width="20%"></td>
                                    </tr>
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
                                    <tr>
                                        <td width="7%">1</td>
                                        <td width="15%">323342250122</td>
                                        <td width="8%"></td>
                                        <td width="10%">刘兰奇</td>
                                        <td width="10%">男</td>
                                        <td width="29%">R1错误，R1错误，R1错误，</td>
                                        <td width="14%">正常</td>
                                        <td width="7%">无效</td>
                                    </tr>
                                    <tr>
                                        <td width="7%">1</td>
                                        <td width="15%">323342250122</td>
                                        <td width="8%"></td>
                                        <td width="10%">刘兰奇</td>
                                        <td width="10%">男</td>
                                        <td width="29%">R1错误，R1错误，R1错误，</td>
                                        <td width="14%">正常</td>
                                        <td width="7%">无效</td>
                                    </tr>
                                    <tr>
                                        <td width="7%">1</td>
                                        <td width="15%">323342250122</td>
                                        <td width="8%"></td>
                                        <td width="10%">刘兰奇</td>
                                        <td width="10%">男</td>
                                        <td width="29%">R1错误，R1错误，R1错误，</td>
                                        <td width="14%">正常</td>
                                        <td width="7%">无效</td>
                                    </tr>
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
                                        <th width="8%">班级</th>
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
                                            <script>document.write(editName('{{ $item["name"] }}'))</script>
                                        </td>
                                        <td width="8%"></td>
                                        <td width="10%">
                                            <script>document.write(editName('{{ $item["name"] }}'))</script>
                                        </td>
                                        <td width="10%">男</td>
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
        var myChart1 = echarts.init(document.getElementById("school1"));
        myChart1.setOption({
            color: ["#5470C6", "#91CC75", "#FAC858", "#EE6666", "#73C0DE", "#3BA272", "#FC8452", "#9A60B4", "#EA7DCC"],
            backgroundColor: "#ecf0f5",
            title: {
                text: "问卷结果分析",
                left: 10,
                top: 15,
            },
            legend: {
                orient: "vertical",
                x: "right",
                y: "top",
                left: "45%",
                data:  [
                    { value: 335, name: "A网瘾" },
                    { value: 335, name: "B社交障碍" },
                    { value: 310, name: "C抑郁" },
                    { value: 234, name: "D压力" },
                    { value: 135, name: "E注意力下降" },
                    { value: 148, name: "F学习障碍" },
                    { value: 148, name: "G睡眠问题" },
                    { value: 148, name: "H越轨行为" },
                    { value: 148, name: "I社交焦虑" },
                    { value: 148, name: "J社交媒体成瘾" },
                    { value: 148, name: "K暴力" },
                    { value: 148, name: "l冷漠" },
                    { value: 148, name: "M自杀意念" },
                    { value: 148, name: "N自杀计划" },
                    { value: 148, name: "o自杀或自伤行为" },
                    { value: 148, name: "读写障碍" },
                    { value: 148, name: "QA-B5B-躯体化" },
                    { value: 148, name: "QA-B5B-强迫症" },
                    { value: 148, name: "QA-B5B-人际关系障碍" },
                    { value: 148, name: "QA-B5B-抑郁" },
                    { value: 148, name: "QA-B5B-焦虑" },
                    { value: 148, name: "QA-B5B-撒谎" },
                    { value: 148, name: "QA-B5B-恐吓" },
                    { value: 148, name: "QA-B5B-偏执" },
                    { value: 148, name: "QA-B5B-精神偏执" },
                    { value: 148, name: "QA-B5B-其他" },
                    { value: 148, name: "QA-B5B-注意力涣散" },
                    { value: 148, name: "QA-B5B-社会赞许性" },
                ],
                height: 280,
                top: "15%"
            },

            series: [
                {
                    name: "访问量",
                    type: "pie",
                    data: [
                        { value: 335, name: "A网瘾" },
                        { value: 335, name: "B社交障碍" },
                        { value: 310, name: "C抑郁" },
                        { value: 234, name: "D压力" },
                        { value: 135, name: "E注意力下降" },
                        { value: 148, name: "F学习障碍" },
                        { value: 148, name: "G睡眠问题" },
                        { value: 148, name: "H越轨行为" },
                        { value: 148, name: "I社交焦虑" },
                        { value: 148, name: "J社交媒体成瘾" },
                        { value: 148, name: "K暴力" },
                        { value: 148, name: "l冷漠" },
                        { value: 148, name: "M自杀意念" },
                        { value: 148, name: "N自杀计划" },
                        { value: 148, name: "o自杀或自伤行为" },
                        { value: 148, name: "读写障碍" },
                        { value: 148, name: "QA-B5B-躯体化" },
                        { value: 148, name: "QA-B5B-强迫症" },
                        { value: 148, name: "QA-B5B-人际关系障碍" },
                        { value: 148, name: "QA-B5B-抑郁" },
                        { value: 148, name: "QA-B5B-焦虑" },
                        { value: 148, name: "QA-B5B-撒谎" },
                        { value: 148, name: "QA-B5B-恐吓" },
                        { value: 148, name: "QA-B5B-偏执" },
                        { value: 148, name: "QA-B5B-精神偏执" },
                        { value: 148, name: "QA-B5B-其他" },
                        { value: 148, name: "QA-B5B-注意力涣散" },
                        { value: 148, name: "QA-B5B-社会赞许性" },
                    ],
                    radius: ["0%", "65%"],
                    center: ["20%", "50%"],
                    label: {
                        normal: {
                            show: false,
                        },
                    },
                    labelLine: {
                        normal: {
                            show: false,
                        },
                    },
                },
            ],
        });
        /* 考生分析 */
        var myChart2 = echarts.init(document.getElementById("school2"));
        myChart2.setOption({
            color: ["#5470c6"],
            backgroundColor: "#ecf0f5",
            title: {
                text: "考生分析",
                left: 10,
                top: 15,
            },
            xAxis: {
                data: ["小学", "初中", "高中"],
            },
            yAxis: {
                axisTick: {
                    show: false,
                },
                axisLine: {
                    show: false,
                },
            },
            series: [
                {
                    name: "考生分析",
                    type: "bar",
                    data: [120, 200, 150],
                    // showBackground: true,
                    // backgroundStyle: {
                    //   color: "rgba(84, 112, 198)",
                    // },
                    label: {
                        normal: {
                            show: true,
                            position: "inside",
                            textStyle: {
                                color: "#fff",
                            },
                            offset: [0, -20]
                        },

                    },
                },
            ],
        });
        /* 关键词分析 */
        var myChart3 = echarts.init(document.getElementById("school3"));
        myChart3.setOption({
            color: [{
                type: 'radial',
                x: 0.4,
                y: 0.3,
                r: 1,
                colorStops: [{
                    offset: 0, color: 'rgb(251, 118, 123)' // 0% 处的颜色
                }, {
                    offset: 1, color: 'rgb(204, 46, 72)' // 100% 处的颜色
                }],
                global: false // 缺省为 false
            }, {
                type: 'radial',
                x: 0.4,
                y: 0.3,
                r: 1,
                colorStops: [{
                    offset: 0, color: 'rgb(129, 227, 238)' // 0% 处的颜色
                }, {
                    offset: 1, color: 'rgb(25, 183, 207)' // 100% 处的颜色
                }],
                global: false // 缺省为 false
            }],
            backgroundColor: "#ecf0f5",
            title: {
                text: "关键词分析",
                left: 10,
                top: 15,
            },
            legend: {
                data: ["已完成", "未完成"],
                right: "center",
                top: "5%",
            },
            // grid: {
            //   left: "8%",
            //   top: "10%",
            // },
            xAxis: {
                splitLine: {
                    lineStyle: {
                        type: "dashed",
                    },
                },
            },
            yAxis: {
                splitLine: {
                    lineStyle: {
                        type: "dashed",
                    },
                },
                scale: true,
            },
            series: [
                {
                    name: '已完成',
                    data: [
                        [28604, 77, 17096869, 'Australia', 1990],
                        [31163, 77.4, 27662440, 'Canada', 1990],
                        [1516, 68, 1154605773, 'China', 1990],
                        [13670, 74.7, 10582082, 'Cuba', 1990],
                        [28599, 75, 4986705, 'Finland', 1990],
                        [29476, 77.1, 56943299, 'France', 1990],
                        [31476, 75.4, 78958237, 'Germany', 1990],
                        [28666, 78.1, 254830, 'Iceland', 1990],
                        [1777, 57.7, 870601776, 'India', 1990],
                        [29550, 79.1, 122249285, 'Japan', 1990],
                        [2076, 67.9, 20194354, 'North Korea', 1990],
                        [12087, 72, 42972254, 'South Korea', 1990],
                        [24021, 75.4, 3397534, 'New Zealand', 1990],
                        [43296, 76.8, 4240375, 'Norway', 1990],
                        [10088, 70.8, 38195258, 'Poland', 1990],
                        [19349, 69.6, 147568552, 'Russia', 1990],
                        [10670, 67.3, 53994605, 'Turkey', 1990],
                        [26424, 75.7, 57110117, 'United Kingdom', 1990],
                        [37062, 75.4, 252847810, 'United States', 1990]
                    ],
                    type: 'scatter',
                    symbolSize: function (data) {
                        return Math.sqrt(data[2]) / 5e2;
                    },
                    emphasis: {
                        focus: 'series',
                        label: {
                            show: true,
                            formatter: function (param) {
                                return param.data[3];
                            },
                            position: 'top'
                        }
                    },
                    itemStyle: {
                        shadowBlur: 10,
                        shadowColor: 'rgba(120, 36, 50, 0.5)',
                        shadowOffsetY: 5,
                    }
                },
                {
                    name: '未完成',
                    data: [
                        [44056, 81.8, 23968973, 'Australia', 2015],
                        [43294, 81.7, 35939927, 'Canada', 2015],
                        [13334, 76.9, 1376048943, 'China', 2015],
                        [21291, 78.5, 11389562, 'Cuba', 2015],
                        [38923, 80.8, 5503457, 'Finland', 2015],
                        [37599, 81.9, 64395345, 'France', 2015],
                        [44053, 81.1, 80688545, 'Germany', 2015],
                        [42182, 82.8, 329425, 'Iceland', 2015],
                        [5903, 66.8, 1311050527, 'India', 2015],
                        [36162, 83.5, 126573481, 'Japan', 2015],
                        [1390, 71.4, 25155317, 'North Korea', 2015],
                        [34644, 80.7, 50293439, 'South Korea', 2015],
                        [34186, 80.6, 4528526, 'New Zealand', 2015],
                        [64304, 81.6, 5210967, 'Norway', 2015],
                        [24787, 77.3, 38611794, 'Poland', 2015],
                        [23038, 73.13, 143456918, 'Russia', 2015],
                        [19360, 76.5, 78665830, 'Turkey', 2015],
                        [38225, 81.4, 64715810, 'United Kingdom', 2015],
                        [53354, 79.1, 321773631, 'United States', 2015]
                    ],
                    type: 'scatter',
                    symbolSize: function (data) {
                        return Math.sqrt(data[2]) / 5e2;
                    },
                    emphasis: {
                        focus: 'series',
                        label: {
                            show: true,
                            formatter: function (param) {
                                return param.data[3];
                            },
                            position: 'top'
                        }
                    },
                    itemStyle: {
                        shadowBlur: 10,
                        shadowColor: 'rgba(25, 100, 150, 0.5)',
                        shadowOffsetY: 5,
                    }
                }
            ]
        });


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
                    data: [{{ implode(',', $data["school6"]["value"]) }}],
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
                    data: [{{ $data["special"][13] }}, {{ $data["special"][14] }}, {{ $data["special"][15] }}, {{ $data["special"][16] }}],
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

