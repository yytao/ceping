<script src="/common/js/echarts.min.js"></script>

<div id="chart2" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('chart2'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: "问卷结果分析"
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            right: 10,
            top: 30,
            bottom: 30,
            data: ['A网瘾','第二校区']
        },
        series: [
            {
                name: '学校统计',
                type: 'pie',
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 20,
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    { value: 1, name: '第一校区' },
                    { value: 1, name: '第二校区' }
                ]
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>















