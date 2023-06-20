<script src="/common/js/echarts.min.js"></script>

<div id="chart3" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart3 = echarts.init(document.getElementById('chart3'));

    // 指定图表的配置项和数据
    var option3 = {
        title: {
            text: "考生分析"
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            right: 10,
            top: 30,
            bottom: 30,
            data: ['小学', '初中', '高中']
        },
        xAxis: {
            type: 'category',
            data: ['小学', '初中', '高中']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                type: 'bar',
                avoidLabelOverlap: false,
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
                label: {
                    show: true,
                    position: 'inside'
                },
                data: [120, 200, 150],
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart3.setOption(option3);

    window.addEventListener('resize', function() {
        myChart3.resize();
    });
</script>















