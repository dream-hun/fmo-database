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

                <div class="row mt-5">
                    <div class="col-md-8 mb-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $vslaChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-school-feeding-component/>
                    </div>



                    <div class="col-md-3">
                        <div class="card">

                            <div class="card-body">
                                {!! $goatDistributionChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-toolkit-component/>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $individual->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $girinkaChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                {!! $ecdChart->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $scholarshipByYear->container() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! $scholarshipOptionChart->container() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $girinkaChart->script() !!}
    {!! $individual->script() !!}
    {!! $scholarshipByYear->script() !!}
    {!! $scholarshipOptionChart->script() !!}
    {!! $goatDistributionChart->script() !!}
    {!! $ecdChart->script() !!}
    {!! $vslaChart->script() !!}
@endpush
