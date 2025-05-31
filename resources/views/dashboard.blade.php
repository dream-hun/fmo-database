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
                    <a href="#" class="small-box-footer">&nbsp;</a>
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
                        <i class="bi bi-people"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>

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
                        <i class="bi bi-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $musa }}</h3>

                        <p>Health insurance Beneficiaries</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-add"></i>
                    </div>
                    <a href="{{route('admin.musas.index')}}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">

                <div class="row mt-5">
                    <div class="col-md-12 mb-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $vslaChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <x-school-feeding-component/>
                    </div>



                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">
                                {!! $goatDistributionChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">
                                {!! $support->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="card">
                           <div class="card-body">
                               {!! $toolkitChart->container() !!}
                           </div>
                       </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">

                            <div class="card-body">
                                {!! $individual->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">
                                {!! $girinkaChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $ecdChart->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body">
                                {!! $scholarshipByYear->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                {!! $mvtc->container() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>



@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $girinkaChart->script() !!}
    {!! $individual->script() !!}
    {!! $scholarshipByYear->script() !!}
    {!! $goatDistributionChart->script() !!}
    {!! $ecdChart->script() !!}
    {!! $vslaChart->script() !!}
    {!! $mvtc->script() !!}
    {!! $toolkitChart->script() !!}
    {!! $support->script() !!}

@endpush
