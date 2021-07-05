@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.dashboard') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1> {{ __('lang.dashboard') }}
                        <small>{{ __('lang.statistics_reports') }}</small>
                    </h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <span class="active"> {{ __('lang.dashboard') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-haze">
                                    <span data-counter="counterup" data-value="{{ $packagesCount }}">{{ $packagesCount }}</span>
                                </h3>
                                <small>{{ __('lang.total') }} Packages</small>
                            </div>
                            <div class="icon">
                                <i class="icon-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="{{ $usersCount }}">{{ $usersCount }}</span>
                                </h3>
                                <small>{{ __('lang.total') }} {{ __('lang.users') }}</small>
                            </div>
                            <div class="icon">
                                <i class="icon-user-following"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 bordered">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-blue-sharp">
                                    <span data-counter="counterup" data-value="{{ $messagesCount }}">{{ $messagesCount }}</span>
                                </h3>
                                <small>{{ __('lang.total') }} {{ __('lang.messages') }}</small>
                            </div>
                            <div class="icon">
                                <i class="icon-envelope"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                Latest Ratings
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed flip-content" style="margin-bottom: 0">
                                <thead class="flip-content">
                                <tr>
                                    <th width="20%"> Name </th>
                                    <th> Rate </th>
                                    @permission('approve-rating')
                                    <th class="numeric"> Status </th>
                                    @endpermission
                                    @permission('read-packages')
                                    <th class="numeric"> Package </th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ratings as $item)
                                    <tr>
                                        <td> {{ $item->users->username }} </td>
                                        <td>
                                            @for($i=1;$i <= 5; $i++)
                                                <span class="fa fa-star {{ $item->rate >= $i ? 'checked' : '' }}"></span>
                                            @endfor
                                        </td>
                                        @permission('read-packages')
                                            <td><a href="{{ route('dashboard.packages.show',$item->package->id) }}">{{ $item->package->title }}</a> </td>
                                        @endpermission
                                        @permission('approve-rating')
                                            <td>
                                                <a href="javascript:;" data-id="{{ route('dashboard.ratings.status',$item->id) }}" style="{{ $item->status == 1 ? 'background-color: #27ae60 !important;' : 'background-color: #c0392b !important;' }} " title="{{ $item->status == 0 ? 'قبول' : 'رفض' }}" class="btn btn-default btn-new BtnStatus"><i style="color: #fff !important;" class="fa {{ $item->status == 0 ? 'fa-eye-slash' : 'fa-eye' }}"></i></a> </td>
                                            </td>
                                        @endpermission
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                Latest Messages
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body flip-scroll">
                            <table class="table table-bordered table-striped table-condensed flip-content" style="margin-bottom: 0">
                                <thead class="flip-content">
                                <tr>
                                    <th> Username </th>
                                    <th> Email </th>
                                    <th> Subject </th>
                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $get)
                                    <tr style="{{ ($get->read_at == '0' ? 'background: #d4faff' : '' ) }}">
                                        <td>{{ $get->username }}</td>
                                        <td>{{ $get->email }}</td>
                                        <td>{{ $get->subject }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.messages.show', $get->id) }}" title="{{ __('lang.show') }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    @permission('approve-rating')
    <form id="statusForm" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop



@section('css')
    <link href="{{ asset('flaticons/flaticon.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="{{ asset('admin/assets') }}/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var packages =  <?php echo json_encode($chart) ?>;

        Highcharts.chart('chart', {
            title: {
                text: 'New Packages'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Number of New Packages'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Packages',
                data: packages
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 2000
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@stop
