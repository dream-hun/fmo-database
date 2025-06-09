@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <x-numbers-component />
        <!--Child protection program -->

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {!! $malnutritionChart->container() !!}
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
                <x-school-feeding-component />
            </div>


            <!-- House Hold Strengthening-->
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
                        {!! $girinkaChart->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        {!! $fruitsChart->container() !!}
                    </div>
                </div>
            </div>



            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            {!! $individual->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            {!! $vslaChart->container() !!}
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
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            {!! $mvtc->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            {!! $trainingChart->container() !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $urgentCommunity->container() !!}
                        </div>
                    </div>
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
    {!! $goatDistributionChart->script() !!}
    {!! $ecdChart->script() !!}
    {!! $vslaChart->script() !!}
    {!! $mvtc->script() !!}
    {!! $toolkitChart->script() !!}
    {!! $urgentCommunity->script() !!}
    {!! $malnutritionChart->script() !!}
    {!! $fruitsChart->script() !!}
    {!! $trainingChart->script() !!}
@endpush
