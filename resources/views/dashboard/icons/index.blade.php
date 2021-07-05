@php $titlePage = 'الأيقونات'; @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ url('dashboard/home') }}">لوحة التحكم</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-pane">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold uppercase">{{ $titlePage }}</span>
                                </div>
                                <div class="pull-right">
                                    <div class="input-group" style="width: 350px">
                                        <span class="input-group-addon">
                                            <small>حجم الأيقون بالبيكسل</small>
                                        </span>
                                        <input type="number" step="1" max="100" min="40" class="form-control" id="changeIconSize" value="40" style="height: 30px">
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <table class="table table-bordered icons_table table-striped table-condensed flip-content">
                                    <tbody>
                                    @foreach($chunk as $get)
                                        <tr>
                                        @foreach($get as $data)
                                            @php $code = substr(strstr($data, ':', true), 1); @endphp
                                            <td style="width: 200px;padding: 0;">
                                                <div class="icon_box" data-content="{{ $code }}">
                                                    <div class="icon_shape">
                                                        <i class="{{ $code }}"></i>
                                                    </div>
                                                    <div class="icon_info">
                                                        {{ $code }}
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if(count($chunk) == 0)
                                    <div class="text-center">
                                        <p>لا توجد بيانات</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('flaticons/flaticon.css') }}" rel="stylesheet" type="text/css" />
@stop
