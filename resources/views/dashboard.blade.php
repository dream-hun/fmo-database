@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
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
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $scholarships }}</h3>

                        <p>Scholarships</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('admin.scholarships.index') }}" class="small-box-footer">More info <i
                            class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <!-- Gender Distribution Chart -->
                <div class="row mt-5">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Microcredit Individual Loan Distribution</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" height="120px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">


                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-body">
                                {!! $beneficiariesChart->container() !!}
                            </div>
                        </div>

                    </div>


                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Girinka (One Milky Cow) Per Family
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                                {!! $girinkaChart->container() !!}

                            </div><!-- /.card-body -->
                        </div>
                    </div>

                    <!-- /.card -->
                </div>


            </section>
            <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $beneficiariesChart->script() !!}
    {!! $girinkaChart->script() !!}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var people = {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Individuals Receiving Loans Per Year',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: true,
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
            document.getElementById('myChart'),
            config
        );
    </script>
@endpush
