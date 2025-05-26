<div class="card">
    <div class="card-body">
        <div id="schoolFeeding"></div>
    </div>
</div>
<script type="text/javascript">
    // Ensure we're in strict mode
    'use strict';

    // Debug output to verify data
    console.log('School Feeding Data:', @json($data));

    document.addEventListener('DOMContentLoaded', function() {
        // Check if Highcharts is available
        if (typeof Highcharts === 'undefined') {
            console.error('Highcharts library not loaded!');
            document.getElementById('schoolFeeding').innerHTML = 'Chart library not available';
            return;
        }

        // Get the data from PHP
        var data = @json($data);

        // Check if we have data
        if (!data || Object.keys(data).length === 0) {
            console.warn('No data available for chart');
            document.getElementById('schoolFeeding').innerHTML = 'No data available to display';
            return;
        }

        // Prepare chart data
        var chartData = [];

        // Verify the data structure before processing
        console.log('Data structure type:', typeof data);

        for (var year in data) {
            if (data.hasOwnProperty(year)) {
                var value = parseInt(data[year]);
                console.log('Processing year:', year, 'with value:', value);

                chartData.push({
                    name: 'Year ' + year,
                    y: value
                });
            }
        }

        // Debug the transformed data
        console.log('Chart data prepared:', chartData);

        // Check if the container exists
        if (!document.getElementById('schoolFeeding')) {
            console.error('Chart container #schoolFeeding not found in the DOM');
            return;
        }

        try {
            // Create the chart
            Highcharts.chart('schoolFeeding', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'School Feeding Distribution by Academic Year'
                },
                subtitle: {
                    text: 'Data Source: School Records'
                },
                accessibility: {
                    point: {
                        valueSuffix: ''
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Count',
                    data: chartData
                }]
            });
            console.log('Chart successfully rendered');
        } catch (error) {
            console.error('Error creating chart:', error);
            document.getElementById('schoolFeeding').innerHTML = 'Error creating chart: ' + error.message;
        }
    });
</script>
