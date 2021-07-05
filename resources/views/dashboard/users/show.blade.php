@php $titlePage = $data->username; @endphp
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
                    <a href="{{ route('dashboard.users') }}">{{ __('lang.users') }}</a>
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
                                    <p><strong>{{ __('lang.username') }}: </strong> {{ $data->username }}</p>
                                </div>
                                @if(!empty($data->email))
                                    <div class="text_view">
                                        <p><strong>{{ __('lang.email') }}: </strong> {{ $data->email }}</p>
                                    </div>
                                @endif
                                @if(!empty($data->phone))
                                    <div class="text_view">
                                        <p><strong>{{ __('lang.phone') }}: </strong> {{ $data->phone }}</p>
                                    </div>
                                @endif
                                @if(!empty($data->date_of_birth))
                                    <div class="text_view">
                                        <p><strong>Date Of Birth: </strong> {{ $data->date_of_birth }}</p>
                                    </div>
                                @endif
                                @if(!empty($data->gender))
                                    <div class="text_view">
                                        <p><strong>Gender: </strong> {{ $data->gender == 'F' ? 'Female' : 'Male' }}</p>
                                    </div>
                                @endif
                                @if(!empty($data->interests))
                                    <div class="text_view">
                                        <p><strong>Interests: </strong>
                                            @foreach($data->interests as $item)
                                                <span style="background: #0e7886;color: #fff;padding: 0 5px;border-radius: 4px;">{{ $item }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                @endif
                                @if(!empty($data->currency_id))
                                    <div class="text_view">
                                        <p><strong>Currency: </strong> {{ ($data->currency_id != null ? $data->currency->title : '' ) }}</p>
                                    </div>
                                @endif
                                <img src="{{ ($data->image != null ? url($data->image) : url('images/user.png') ) }}" class="thumbnail" width="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


