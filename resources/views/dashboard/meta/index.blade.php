@php $titlePage = __('lang.meta_tags'); @endphp
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
                    <a href="{{ route('dashboard.' . $data->page) }}">{{ __('lang.' . $data->page) }}</a>
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
                                {{-- Include Messages Flash --}}
                                @include('dashboard.includes.flash_msg')
                                <form method="post" action="{{ route('dashboard.' . $data->page . '.meta') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body form_add">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#English" data-toggle="tab"> {{ __('lang.english') }} </a>
                                                    </li>
                                                    <li>
                                                        <a href="#Arabic" data-toggle="tab"> {{ __('lang.arabic') }} </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade active in {{ data_lang('', 'lang_en') }}" id="English">
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('en.title') ? 'has-error' : '' }}">
                                                                <label for="title">Title <span class="required">*</span></label>
                                                                <input type="text" id="title" name="en[title]" value="{{ old('en.title', $data->translate('en')->title) }}" class="form-control" placeholder="Enter Title Page">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('en.keywords') ? 'has-error' : '' }}">
                                                                <label for="keywords">Keywords <span class="required">*</span></label>
                                                                <input type="text" id="keywords" name="en[keywords]" value="{{ old('en.keywords', $data->translate('en')->keywords) }}" class="form-control" placeholder="Enter Keywords Page">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('en.description') ? 'has-error' : '' }}">
                                                                <label for="description">Description  <span class="required">*</span></label>
                                                                <textarea id="description" name="en[description]" class="form-control" placeholder="Enter Description Page">{{ old('en.description', $data->translate('en')->description) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade {{ data_lang('lang_ar', '') }}" id="Arabic">
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('ar.title') ? 'has-error' : '' }}">
                                                                <label for="title_ar"> عنوان الصفحة <span class="required">*</span></label>
                                                                <input type="text" id="title_ar" name="ar[title]" value="{{ old('ar.title', $data->translate('ar')->title) }}" class="form-control" placeholder="أدخل عنوان الصفحة">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('ar.keywords') ? 'has-error' : '' }}">
                                                                <label for="keywords_ar">الكلمات الدلالية <span class="required">*</span></label>
                                                                <input type="text" id="keywords_ar" name="ar[keywords]" value="{{ old('ar.keywords', $data->translate('ar')->keywords) }}" class="form-control" placeholder="أدخل الكلمات الدلالية">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group {{ $errors->has('ar.description') ? 'has-error' : '' }}">
                                                                <label for="description_ar">وصف الصفحة  <span class="required">*</span></label>
                                                                <textarea id="description_ar" name="ar[description]" class="form-control" placeholder="أدخل وصف الصفحة">{{ old('ar.description', $data->translate('ar')->description) }}</textarea>
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
                                                        <a href="{{ route('dashboard.' . $data->page) }}" class="btn default">{{ __('lang.cancel') }}</a>
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
@stop
