@php
    $admin = auth('admin')->user();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Devnile" name="author" />
    <link rel="shortcut icon" href="{{ asset($setting->where('key', 'favicon')->first()->val) }}" />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/assets') }}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('admin/assets') }}/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('admin/assets') }}/css/style.css" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo ">
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="{{ url('dashboard/home') }}">
                <img src="{{ asset($setting->where('key', 'logo')->first()->val) }}" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{ $admin->username }} </span>
                            <img class="img-circle" src="{{ $admin->image ? asset(auth('admin')->user()->image) : asset('images/user.png') }}">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ url('dashboard/profile') }}">
                                    <i class="icon-user"></i>{{ __('lang.profile') }}
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="{{ url('dashboard/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i>  {{ __('lang.logout') }}
                                </a>
                                <form id="logout-form" action="{{ url('dashboard/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"> </div>
<div class="page-container">
    @include('dashboard.includes.aside')
    @yield('content')
</div>
<div class="page-footer">
    <div class="page-footer-inner">
        &copy; {{ date('Y') }}
        {{ $setting->where('key', 'copyright')->first()->val }}
        @if($setting->where('key', 'copyright_link')->first()->val && $setting->where('key', 'copyright_link_text')->first()->val)
            <a class="main_color" target="_blank" href="{{ $setting->where('key', 'copyright_link')->first()->val }}">{{ $setting->where('key', 'copyright_link_text')->first()->val }}</a>
        @endif
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
@yield('quick')
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.bs-select, .selectpicker').attr({'data-container': 'body', 'data-none-results-text': 'لا توجد نتائج مطابقة {0}', 'data-live-search-placeholder': 'بحث...'});
    });
</script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/pages/scripts/ui-general.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="{{ asset('admin/assets') }}/js/tinymce/tinymce.min.js"></script>
<script src="{{ asset('admin/assets') }}/js/tinymce/tiny-init.js"></script>
@yield('js')
<script>
    const CONFIRMATION_MSG = '{{ __('lang.your_sure') }}';
</script>
<script src="{{ asset('admin/assets') }}/js/work.js"></script>
</body>
</html>
