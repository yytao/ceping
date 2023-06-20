<h3>学校进度</h3>
<canvas id="myChart5" width="800" height="200"></canvas>
<script>
    $(function () {
        var ctx = document.getElementById("myChart5").getContext('2d');

        const data = {
            datasets: [
                {
                    label: '# of Votes',
                    radius:12,
                    data: [
                        {x:4,y:20,r:6},
                        {x:11,y:10,r:16},
                        {x:18,y:23,r:20},
                        {x:25,y:4,r:12},
                        {x:29,y:4,r:10},
                    ],
                    backgroundColor: "#F0CCD9",
                    borderColor: "#F0CCD9",
                    borderWidth: 1
                },
                {
                    label: '# of Votes',
                    radius:12,
                    data: [
                        {x:3,y:12,r:10},
                        {x:10,y:22,r:12},
                        {x:18,y:10,r:24},
                        {x:24,y:30,r:16},
                        {x:28,y:25,r:6},
                    ],
                    backgroundColor: "#C0E0F6",
                    borderColor: "#C0E0F6",
                    borderWidth: 1
                }
            ]
        };

        const config = {
            type: 'scatter',
            data: data,
            options: {
                legend: {
                    position: 'top',
                }
            },
        };

        var myChart = new Chart(ctx, config);
    });
</script>
