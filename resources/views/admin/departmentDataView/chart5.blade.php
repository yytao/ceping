<script src="/common/js/echarts.min.js"></script>

<div id="chart5" style="width: 100%; height: 380px;padding: 20px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart5 = echarts.init(document.getElementById('chart5'));

    // 指定图表的配置项和数据
    option5 = {
        title: {
          text: '学校进度'
        },
        dataset: [
            {
                dimensions: ['name', 'score'],
                source: [
                    ['朱辛庄1中', 30],
                    ['朱辛庄2中', 14.2],
                    ['朱辛庄3中', 15.2],
                    ['朱辛庄4中', 16.8],
                    ['朱辛庄5中', 16.1],
                    ['朱辛庄6中', 21.5],
                    ['朱辛庄7中', 23.5],
                    ['朱辛庄8中', 24.3],
                ]
            },
            {
                transform: {
                    type: 'sort',
                    config: { dimension: 'score', order: 'desc' }
                }
            }
        ],
        xAxis: {
            type: 'category',
            axisLabel: { interval: 0, rotate: 30 }
        },
        yAxis: {},
        series: {
            type: 'bar',
            label: {
                show: true,
                position: 'inside'
            },
            encode: { x: 'name', y: 'score' },
            datasetIndex: 1
        }
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart5.setOption(option5);

    window.addEventListener('resize', function() {
        myChart5.resize();
    });
</script>















