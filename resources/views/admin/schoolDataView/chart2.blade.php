<script src="/common/js/echarts.min.js"></script>

<div id="chart2" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart2 = echarts.init(document.getElementById('chart2'));

    // 指定图表的配置项和数据
    var option2 = {
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
            data: [@foreach($result as $k=>$item) '{{$item->name}}',@endforeach]
        },
        series: [
            {
                type: 'pie',

                radius: '70%',
                center: ['20%', '50%'],
                left: 0,
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
                    @foreach($result as $k=>$item)
                        { value:{{count($item->question)}}, name:'{{$item->name}}'},
                    @endforeach
                ]
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart2.setOption(option2);

    window.addEventListener('resize', function() {
        myChart2.resize();
    });
</script>















