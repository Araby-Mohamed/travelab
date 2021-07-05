@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.profile') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.profile') }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ url('dashboard/home') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.profile') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.profile.include')
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.profile') }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            @include('dashboard.includes.flash_msg')
                                            <div class="tab-pane active provider_data" id="tab_1_1">
                                                <p><strong>{{ __('lang.username') }}: </strong> {{ $admin->username }}</p>
                                                <p><strong>{{ __('lang.email') }}: </strong> {{ $admin->email }}</p>
                                                <p><strong>{{ __('lang.phone') }}: </strong> {{ $admin->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


