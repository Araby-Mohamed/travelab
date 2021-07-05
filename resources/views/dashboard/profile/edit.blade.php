@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.edit_profile') }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.edit_profile') }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ url('dashboard/home') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url('dashboard/profile') }}">{{ __('lang.profile') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.edit_profile') }}</span>
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
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.edit_profile') }}</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="tab-content">
                                            @include('dashboard.includes.flash_msg')
                                            <div class="tab-pane active provider_data" id="tab_1_1">
                                                <form method="post" action="{{ url('dashboard/profile/update') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-body form_add">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                                                        <label for="username">{{ __('lang.username') }} <span class="required">*</span> </label>
                                                                        <input type="text" name="username" id="username" value="{{ old('username', $admin->username) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.username') }}" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                                        <label for="email">{{ __('lang.email') }} <span class="required">*</span> </label>
                                                                        <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }}" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                                        <label for="phone">{{ __('lang.phone') }} <span class="required">*</span> </label>
                                                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $admin->phone) }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }}" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                                        <label for="password">{{ __('lang.password') }}</label>
                                                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.password') }}" />
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                                        <label class="display-block" for="image">{{ __('lang.choose') }} {{ __('lang.image') }} <span class="required"> {{ __('lang.best_size') }} (300 * 300)</span></label>
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-new thumbnail">
                                                                                <img src="{{ $admin->image ? asset(auth('admin')->user()->image) : asset('images/user.png') }}"/>
                                                                            </div>
                                                                            <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                                                            <div>
                                                                                <span class="btn default btn-file">
                                                                                    <span class="fileinput-new"> {{ __('lang.choose') }} {{ __('lang.image') }}</span>
                                                                                    <span class="fileinput-exists">{{ __('lang.change') }} {{ __('lang.image') }} </span>
                                                                                    <input type="file" name="image" id="image">
                                                                                </span>
                                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ __('lang.delete') }} {{ __('lang.image') }} </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class=" col-md-9">
                                                                        <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                                                                        <a href="{{ url('dashboard/profile') }}" class="btn default">{{ __('lang.cancel') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
@stop

@section('css')
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@stop