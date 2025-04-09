@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total}}</h3>

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
                        <h3>{{$female}}</h3>

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
                        <h3>65</h3>

                        <p>Scholarships</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('admin.scholarships.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
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

                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">MVTC Registration</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                    </div>

                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6">

                <!-- Map card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-map"></i>
                            Work Force Development
                        </h3>

                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">

                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"><canvas width="80" height="50"
                                        style="width: 80px; height: 50px;"></canvas></div>
                                <div class="text-white">Visitors</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"><canvas width="80" height="50"
                                        style="width: 80px; height: 50px;"></canvas></div>
                                <div class="text-white">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"><canvas width="80" height="50"
                                        style="width: 80px; height: 50px;"></canvas></div>
                                <div class="text-white">Sales</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- solid sales graph -->
                <div class="card bg-gradient-info">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Sales Graph
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas class="chart chartjs-render-monitor" id="line-chart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 256px;"
                            width="256" height="250"></canvas>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                        height="60"></canvas><input type="text" class="knob"
                                        data-readonly="true" value="20" data-width="60" data-height="60"
                                        data-fgcolor="#39CCCC" readonly="readonly"
                                        style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                </div>

                                <div class="text-white">Mail-Orders</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                        height="60"></canvas><input type="text" class="knob"
                                        data-readonly="true" value="50" data-width="60" data-height="60"
                                        data-fgcolor="#39CCCC" readonly="readonly"
                                        style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                </div>

                                <div class="text-white">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                        height="60"></canvas><input type="text" class="knob"
                                        data-readonly="true" value="30" data-width="60" data-height="60"
                                        data-fgcolor="#39CCCC" readonly="readonly"
                                        style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                </div>

                                <div class="text-white">In-Store</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                    data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a href="#" class="dropdown-item">Add new event</a>
                                    <a href="#" class="dropdown-item">Clear events</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">View calendar</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%">
                            <div class="bootstrap-datetimepicker-widget usetwentyfour">
                                <ul class="list-unstyled">
                                    <li class="show">
                                        <div class="datepicker">
                                            <div class="datepicker-days" style="">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                    class="fa fa-chevron-left"
                                                                    title="Previous Month"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Month">April 2025</th>
                                                            <th class="next" data-action="next"><span
                                                                    class="fa fa-chevron-right" title="Next Month"></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="dow">Su</th>
                                                            <th class="dow">Mo</th>
                                                            <th class="dow">Tu</th>
                                                            <th class="dow">We</th>
                                                            <th class="dow">Th</th>
                                                            <th class="dow">Fr</th>
                                                            <th class="dow">Sa</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="03/30/2025"
                                                                class="day old weekend">30</td>
                                                            <td data-action="selectDay" data-day="03/31/2025"
                                                                class="day old">31</td>
                                                            <td data-action="selectDay" data-day="04/01/2025"
                                                                class="day">1</td>
                                                            <td data-action="selectDay" data-day="04/02/2025"
                                                                class="day">2</td>
                                                            <td data-action="selectDay" data-day="04/03/2025"
                                                                class="day">3</td>
                                                            <td data-action="selectDay" data-day="04/04/2025"
                                                                class="day active today">4</td>
                                                            <td data-action="selectDay" data-day="04/05/2025"
                                                                class="day weekend">5</td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="04/06/2025"
                                                                class="day weekend">6</td>
                                                            <td data-action="selectDay" data-day="04/07/2025"
                                                                class="day">7</td>
                                                            <td data-action="selectDay" data-day="04/08/2025"
                                                                class="day">8</td>
                                                            <td data-action="selectDay" data-day="04/09/2025"
                                                                class="day">9</td>
                                                            <td data-action="selectDay" data-day="04/10/2025"
                                                                class="day">10</td>
                                                            <td data-action="selectDay" data-day="04/11/2025"
                                                                class="day">11</td>
                                                            <td data-action="selectDay" data-day="04/12/2025"
                                                                class="day weekend">12</td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="04/13/2025"
                                                                class="day weekend">13</td>
                                                            <td data-action="selectDay" data-day="04/14/2025"
                                                                class="day">14</td>
                                                            <td data-action="selectDay" data-day="04/15/2025"
                                                                class="day">15</td>
                                                            <td data-action="selectDay" data-day="04/16/2025"
                                                                class="day">16</td>
                                                            <td data-action="selectDay" data-day="04/17/2025"
                                                                class="day">17</td>
                                                            <td data-action="selectDay" data-day="04/18/2025"
                                                                class="day">18</td>
                                                            <td data-action="selectDay" data-day="04/19/2025"
                                                                class="day weekend">19</td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="04/20/2025"
                                                                class="day weekend">20</td>
                                                            <td data-action="selectDay" data-day="04/21/2025"
                                                                class="day">21</td>
                                                            <td data-action="selectDay" data-day="04/22/2025"
                                                                class="day">22</td>
                                                            <td data-action="selectDay" data-day="04/23/2025"
                                                                class="day">23</td>
                                                            <td data-action="selectDay" data-day="04/24/2025"
                                                                class="day">24</td>
                                                            <td data-action="selectDay" data-day="04/25/2025"
                                                                class="day">25</td>
                                                            <td data-action="selectDay" data-day="04/26/2025"
                                                                class="day weekend">26</td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="04/27/2025"
                                                                class="day weekend">27</td>
                                                            <td data-action="selectDay" data-day="04/28/2025"
                                                                class="day">28</td>
                                                            <td data-action="selectDay" data-day="04/29/2025"
                                                                class="day">29</td>
                                                            <td data-action="selectDay" data-day="04/30/2025"
                                                                class="day">30</td>
                                                            <td data-action="selectDay" data-day="05/01/2025"
                                                                class="day new">1</td>
                                                            <td data-action="selectDay" data-day="05/02/2025"
                                                                class="day new">2</td>
                                                            <td data-action="selectDay" data-day="05/03/2025"
                                                                class="day new weekend">3</td>
                                                        </tr>
                                                        <tr>
                                                            <td data-action="selectDay" data-day="05/04/2025"
                                                                class="day new weekend">4</td>
                                                            <td data-action="selectDay" data-day="05/05/2025"
                                                                class="day new">5</td>
                                                            <td data-action="selectDay" data-day="05/06/2025"
                                                                class="day new">6</td>
                                                            <td data-action="selectDay" data-day="05/07/2025"
                                                                class="day new">7</td>
                                                            <td data-action="selectDay" data-day="05/08/2025"
                                                                class="day new">8</td>
                                                            <td data-action="selectDay" data-day="05/09/2025"
                                                                class="day new">9</td>
                                                            <td data-action="selectDay" data-day="05/10/2025"
                                                                class="day new weekend">10</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="datepicker-months" style="display: none;">
                                                <table class="table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                    class="fa fa-chevron-left"
                                                                    title="Previous Year"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Year">2025</th>
                                                            <th class="next" data-action="next"><span
                                                                    class="fa fa-chevron-right"
                                                                    title="Next Year"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectMonth"
                                                                    class="month">Jan</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Feb</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Mar</span><span
                                                                    data-action="selectMonth"
                                                                    class="month active">Apr</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">May</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Jun</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Jul</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Aug</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Sep</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Oct</span><span
                                                                    data-action="selectMonth"
                                                                    class="month">Nov</span><span
                                                                    data-action="selectMonth" class="month">Dec</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="datepicker-years" style="display: none;">
                                                <table class="table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                    class="fa fa-chevron-left"
                                                                    title="Previous Decade"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5" title="Select Decade">2020-2029</th>
                                                            <th class="next" data-action="next"><span
                                                                    class="fa fa-chevron-right"
                                                                    title="Next Decade"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectYear"
                                                                    class="year old">2019</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2020</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2021</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2022</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2023</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2024</span><span
                                                                    data-action="selectYear"
                                                                    class="year active">2025</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2026</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2027</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2028</span><span
                                                                    data-action="selectYear"
                                                                    class="year">2029</span><span
                                                                    data-action="selectYear"
                                                                    class="year old">2030</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="datepicker-decades" style="display: none;">
                                                <table class="table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th class="prev" data-action="previous"><span
                                                                    class="fa fa-chevron-left"
                                                                    title="Previous Century"></span></th>
                                                            <th class="picker-switch" data-action="pickerSwitch"
                                                                colspan="5">2000-2090</th>
                                                            <th class="next" data-action="next"><span
                                                                    class="fa fa-chevron-right"
                                                                    title="Next Century"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="7"><span data-action="selectDecade"
                                                                    class="decade old"
                                                                    data-selection="2006">1990</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2006">2000</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2016">2010</span><span
                                                                    data-action="selectDecade" class="decade active"
                                                                    data-selection="2026">2020</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2036">2030</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2046">2040</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2056">2050</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2066">2060</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2076">2070</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2086">2080</span><span
                                                                    data-action="selectDecade" class="decade"
                                                                    data-selection="2096">2090</span><span
                                                                    data-action="selectDecade" class="decade old"
                                                                    data-selection="2106">2100</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="picker-switch accordion-toggle"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div>
@endsection

@push('scripts')
    @apexchartsScripts
    {!! $beneficiariesChart->script() !!}
    {!! $girinkaChart->script() !!}
@endpush

