@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total }}</h3>

                        <p>Total Beneficiaries</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-primary">
                    <div class="inner">
                        <h3>{{ $female }}</h3>

                        <p>Female Beneficiaries</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>{{ $male }}</h3>

                        <p>Male Beneficiaries</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <!-- Gender Distribution Chart -->
                <div class="row mt-5">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Microcredit Individual Loan Distribution</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="individualCredit" height="150px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        coming soon
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Girinka (One Milky Cow) Per Family
                                </h3>
                            </div>
                            <div class="card-body">
                                {!! $girinkaChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Scholarship Chart</div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Scholarship Beneficiaries by Year
                </div>
                <div class="card-body">
                    <canvas id="scholarshipBarChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Scholarship Combo Chart: Beneficiaries by Year & Students by Study Option
                </div>
                <div class="card-body">
                    <canvas id="scholarshipComboChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const years = @json($scholarshipYears);
        const beneficiaries = @json($scholarshipCounts);
        const studyOptions = @json($studyOptionLabels);
        const studyOptionCounts = @json($studyOptionCounts);

        // Pad studyOptionCounts to match years length for combo chart overlay
        let paddedStudyOptionCounts = Array(years.length).fill(null);
        // Only show study option counts at the end of the chart (or overlay as needed)
        studyOptionCounts.forEach((count, idx) => {
            if (years.length - studyOptionCounts.length + idx >= 0) {
                paddedStudyOptionCounts[years.length - studyOptionCounts.length + idx] = count;
            }
        });

        const ctxScholarshipCombo = document.getElementById('scholarshipComboChart').getContext('2d');
        const scholarshipComboChart = new Chart(ctxScholarshipCombo, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [
                    {
                        label: 'Number of Beneficiaries (by Year)',
                        data: beneficiaries,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y',
                        type: 'bar',
                    },
                    {
                        label: 'Number of Students (by Study Option)',
                        data: paddedStudyOptionCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        yAxisID: 'y1',
                        type: 'line',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        spanGaps: true,
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if(context.datasetIndex === 1 && context.parsed.y !== null) {
                                    // Map study option label to the correct point
                                    const idx = context.dataIndex - (years.length - studyOptions.length);
                                    if (idx >= 0 && studyOptions[idx]) {
                                        return `${studyOptions[idx]}: ${context.parsed.y}`;
                                    }
                                }
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Number of Beneficiaries (by Year)'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                        title: {
                            display: true,
                            text: 'Number of Students (by Study Option)'
                        }
                    }
                }
            }
        });
    </script>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $girinkaChart->script() !!}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var people = {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Individuals Receiving Loans Per Year',
                backgroundColor: '#657278',
                borderColor: '#657278',
                fill: false,
                data: people,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Yearly Loan Distribution'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Individuals'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('individualCredit'),
            config
        );
    </script>
@endpush
