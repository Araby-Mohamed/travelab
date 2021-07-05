@php $titlePage = __('lang.setting'); @endphp
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
                            <div class="portlet-body form {{ !auth('admin')->user()->hasPermission('update-settings') ? 'not_permission_setting' : '' }}">
                                {{-- Include Messages Flash --}}
                                @include('dashboard.includes.flash_msg')
                                @permission('update-settings')
                                <form method="post" action="{{ route('update-setting') }}" enctype="multipart/form-data">
                                    @csrf
                                @endpermission
                                    <div class="form-body form_add">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('site_name') ? 'has-error' : '' }}">
                                                        <label for="site_name">Web site name <span class="required">*</span> </label>
                                                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->where('key', 'site_name')->first()->val) }}" class="form-control" placeholder="Enter The Site Name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                        <label for="address">Headquarters address </label>
                                                        <input type="text" name="address" id="address" value="{{ old('address', $setting->where('key', 'address')->first()->val) }}" class="form-control" placeholder="Enter The Address" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('sm_description') ? 'has-error' : '' }}">
                                                        <label for="sm_description">Short description <span class="required">*</span> </label>
                                                        <input name="sm_description" id="sm_description" value="{{ old('sm_description', $setting->where('key', 'sm_description')->first()->val) }}" class="form-control" placeholder="Enter A Short Description">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('terms') ? 'has-error' : '' }}">
                                                        <label for="sm_description">Terms <span class="required">*</span> </label>
                                                        <textarea name="terms" id="terms" class="form-control" placeholder="Enter Terms">{{ old('terms', $setting->where('key', 'terms')->first()->val) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group {{ $errors->has('copyright') ? 'has-error' : '' }}">
                                                        <label for="copyright">Copyrights </label>
                                                        <input type="text" name="copyright" id="copyright" value="{{ old('copyright', $setting->where('key', 'copyright')->first()->val) }}" class="form-control" placeholder="Enter Copyright" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group {{ $errors->has('copyright_link_text') ? 'has-error' : '' }}">
                                                        <label for="copyright_link_text">Copyright link address </label>
                                                        <input type="text" name="copyright_link_text" id="copyright_link_text" value="{{ old('copyright_link_text', $setting->where('key', 'copyright_link_text')->first()->val) }}" class="form-control" placeholder="Enter The Title Of The Copyright Link" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group {{ $errors->has('copyright_link') ? 'has-error' : '' }}">
                                                        <label for="copyright_link">Copyright link </label>
                                                        <input type="url" name="copyright_link" id="copyright_link" value="{{ old('copyright_link', $setting->where('key', 'copyright_link')->first()->val) }}" class="form-control" placeholder="Enter The Copyright Link" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('phone_1') ? 'has-error' : '' }}">
                                                        <label for="phone_1">{{ __('lang.phone') }} 1 <span class="required">*</span> </label>
                                                        <input type="text" name="phone_1" id="phone_1" value="{{ old('phone_1', $setting->where('key', 'phone_1')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }} 1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('phone_2') ? 'has-error' : '' }}">
                                                        <label for="phone_2">{{ __('lang.phone') }} 2 </label>
                                                        <input type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', $setting->where('key', 'phone_2')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }} 2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('email_1') ? 'has-error' : '' }}">
                                                        <label for="email_1">{{ __('lang.email') }} 1<span class="required">*</span>  <code style="font-size: 11px;">{{ __('lang.email_receive') }}</code></label>
                                                        <input type="text" name="email_1" id="email_1" value="{{ old('email_1', $setting->where('key', 'email_1')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }} 1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('email_2') ? 'has-error' : '' }}">
                                                        <label for="email_1">{{ __('lang.email') }} 2<span class="required">*</span> </label>
                                                        <input type="text" name="email_2" id="email_2" value="{{ old('email_2', $setting->where('key', 'email_2')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }}2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                                        <label for="location">{{ __('lang.map_link') }}</label>
                                                        <input type="text" name="location" id="location" value="{{ old('location', $setting->where('key', 'location')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.map_link') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                                                        <label for="facebook">{{ __('lang.facebook') }}</label>
                                                        <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $setting->where('key', 'facebook')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.facebook') }} {{ __('lang.link') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
                                                        <label for="twitter">{{ __('lang.twitter') }}</label>
                                                        <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $setting->where('key', 'twitter')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.twitter') }} {{ __('lang.link') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                                                        <label for="instagram">{{ __('lang.instagram') }}</label>
                                                        <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $setting->where('key', 'instagram')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.instagram') }} {{ __('lang.link') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('snapchat') ? 'has-error' : '' }}">
                                                        <label for="snapchat">{{ __('lang.snapchat') }}</label>
                                                        <input type="url" name="snapchat" id="snapchat" value="{{ old('snapchat', $setting->where('key', 'snapchat')->first()->val) }}" class="form-control dir_ltr_links" placeholder="{{ __('lang.enter') }} {{ __('lang.snapchat') }} {{ __('lang.link') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                                                        <label class="display-block" for="logo">{{ __('lang.choose') }} {{ __('lang.logo') }} <span class="required"> {{ __('lang.best_size') }} ({{ __('lang.width') }}:180 * {{ __('lang.height') }}:64)</span></label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="{{ asset($setting->where('key', 'logo')->first()->val) }}"/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                                            <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> {{ __('lang.choose') }} {{ __('lang.logo') }}</span>
                                                                            <span class="fileinput-exists">{{ __('lang.change') }} {{ __('lang.logo') }} </span>
                                                                            <input type="file" name="logo" id="logo">
                                                                        </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ __('lang.delete') }} {{ __('lang.image') }} </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('favicon') ? 'has-error' : '' }}">
                                                        <label class="display-block" for="favicon">{{ __('lang.choose') }} {{ __('lang.favicon') }} <span class="required"> {{ __('lang.best_size') }} (50 * 50)</span></label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img style="width: 70px;" src="{{ asset($setting->where('key', 'favicon')->first()->val) }}"/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> {{ __('lang.choose') }} {{ __('lang.favicon') }}</span>
                                                                    <span class="fileinput-exists">{{ __('lang.change') }} {{ __('lang.favicon') }} </span>
                                                                    <input type="file" name="favicon" id="favicon">
                                                                </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ __('lang.delete') }} {{ __('lang.image') }} </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @permission('update-settings')
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                                                            <a href="{{ route('dashboard') }}" class="btn default">{{ __('lang.cancel') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('admin/assets') }}/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="{{ asset('admin/assets') }}/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@stop
