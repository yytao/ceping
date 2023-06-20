<script src="/common/js/echarts.min.js"></script>

<div id="chart4" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart4 = echarts.init(document.getElementById('chart4'));

    // 指定图表的配置项和数据
    const data = [
        [
            [28604, 77, 17096869, 'Australia', '已完成'],
            [31163, 77.4, 27662440, 'Canada', '已完成'],
            [1516, 68, 1154605773, 'China', '已完成'],
            [24021, 75.4, 3397534, 'New Zealand', '已完成'],
            [10670, 67.3, 53994605, 'Turkey', '已完成'],
            [26424, 75.7, 57110117, 'United Kingdom', '已完成'],
            [37062, 75.4, 252847810, 'United States', '已完成']
        ],
        [
            [44056, 81.8, 23968973, 'Australia', '未完成'],
            [43294, 81.7, 35939927, 'Canada', '未完成'],
            [13334, 76.9, 1376048943, 'China', '未完成'],
            [21291, 78.5, 11389562, 'Cuba', '未完成'],
            [44053, 81.1, 80688545, 'Germany', '未完成'],
            [36162, 83.5, 126573481, 'Japan', '未完成'],
            [53354, 79.1, 321773631, 'United States', '未完成']
        ]
    ];
    option4 = {

        title: {
            text: '关键词分析',
        },
        legend: {
            data: ['已完成', '未完成']
        },
        grid: {
            left: '8%',
            top: '10%'
        },
        xAxis: {
            splitLine: {
                lineStyle: {
                    type: 'dashed'
                }
            }
        },
        yAxis: {
            splitLine: {
                lineStyle: {
                    type: 'dashed'
                }
            },
            scale: true
        },
        series: [
            {
                name: '已完成',
                data: data[0],
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
                    color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [
                        {
                            offset: 0,
                            color: 'rgb(251, 118, 123)'
                        },
                        {
                            offset: 1,
                            color: 'rgb(204, 46, 72)'
                        }
                    ])
                }
            },
            {
                name: '未完成',
                data: data[1],
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
                    color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [
                        {
                            offset: 0,
                            color: 'rgb(129, 227, 238)'
                        },
                        {
                            offset: 1,
                            color: 'rgb(25, 183, 207)'
                        }
                    ])
                }
            }
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart4.setOption(option4);

    window.addEventListener('resize', function() {
        myChart4.resize();
    });
</script>















