@php $titlePage = $data->users->username; @endphp
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
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('dashboard.ratings') }}">Ratings</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold uppercase">{{ $titlePage }}</span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="text_view">
                                    <p><strong>Name: </strong> {{ $data->users->username }}</p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Comment: </strong> {{ $data->comment }}</p>
                                </div>
                                <div class="text_view">
                                    <p>
                                        <strong>Rate: </strong>
                                        @for($i=1;$i <= 5; $i++)
                                            <span class="fa fa-star {{ $data->rate >= $i ? 'checked' : '' }}"></span>
                                        @endfor
                                    </p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Package: </strong> <a href="{{ route('dashboard.packages.show',$data->package->id) }}">{{ $data->package->title }}</a></p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Status: </strong> {{ $data->status == 0 ? 'Hide' : 'Show' }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


