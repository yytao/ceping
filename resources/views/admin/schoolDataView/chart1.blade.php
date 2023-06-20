<script src="/common/js/echarts.min.js"></script>

<div id="chart1" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart1 = echarts.init(document.getElementById('chart1'));

    // 指定图表的配置项和数据
    var option1 = {
        title: {
            text: "学校统计"
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            right: 10,
            top: 30,
            bottom: 30,
            data: ['第一校区','第二校区']
        },
        series: [
            {
                type: 'pie',
                radius: ['40%', '70%'],
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
    myChart1.setOption(option1);

    window.addEventListener('resize', function() {
        myChart1.resize();
    });
</script>















