<div class="card">
    <div class="card-body">
        <div id="container"></div>
    </div>
</div>
<script>
    const years = @json($years);      // e.g., ['2021', '2022', '2023']
    const series = @json($series);    // e.g., [{ name: 'Carpentry', data: [3, 4, 5] }, ...]

    Highcharts.chart('container', {
        chart: {
            type: 'column',
            style: {
                fontFamily: 'Inter, sans-serif'
            }
        },
        title: {
            text: 'Toolkits Received per Year'
        },
        subtitle: {
            text: 'Source: Internal Data'
        },
        xAxis: {
            categories: years,
            crosshair: true,
            accessibility: {
                description: 'Years'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Received'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' toolkits'
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: series
    });
</script>
