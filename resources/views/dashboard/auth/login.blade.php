@php $titlePage = $setting->where('key', 'site_name')->first()->val; @endphp
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8" />
    <title>{{ $titlePage }} | تسجيل الدخول </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="Tarseya | Digital Marketing" name="author" />
    <link rel="shortcut icon" href="{{ asset($setting->where('key', 'favicon')->first()->val) }}" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('admin')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin')}}/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('admin')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin')}}/assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
</head>
<body style="overflow: hidden" class=" login">
<div class="user-login-5 page_login">
    <div class="row bs-reset">
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <h1><strong class="main_color">{{ $titlePage }}</strong> Login</h1>
                <form method="POST" action="{{ url('dashboard/login') }}" class="login-form" >
                    @include('dashboard.includes.flash_msg')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" placeholder="Email Or Mobile Number" id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="off" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" placeholder="Enter Password" id="password" type="password" name="password" autocomplete="new-password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" value="1" /> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" style="height: 45px" class="btn green btn-block" value="Login">
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </form>
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="bs-reset socialLinks">
                        <ul class="login-social">
                            @if($setting->where('key', 'facebook')->first()->val)
                                <li>
                                    <a href="{{ $setting->where('key', 'facebook')->first()->val }}">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                            @endif
                            @if($setting->where('key', 'twitter')->first()->val)
                                <li>
                                    <a href="{{ $setting->where('key', 'twitter')->first()->val }}">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            @if($setting->where('key', 'youtube')->first()->val)
                                <li>
                                    <a href="{{ $setting->where('key', 'youtube')->first()->val }}">
                                        <i class="icon-social-youtube"></i>
                                    </a>
                                </li>
                            @endif
                            @if($setting->where('key', 'instagram')->first()->val)
                                <li>
                                    <a href="{{ $setting->where('key', 'instagram')->first()->val }}">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            @endif
                            @if($setting->where('key', 'pinterest')->first()->val)
                                <li>
                                    <a href="{{ $setting->where('key', 'pinterest')->first()->val }}">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-xs-12 bs-reset">
                        <div class="login-copyright text-center">
                            <p>
                                &copy; {{ date('Y') }}
                                {{ $setting->where('key', 'copyright')->first()->val }}
                                @if($setting->where('key', 'copyright_link')->first()->val && $setting->where('key', 'copyright_link_text')->first()->val)
                                    <a class="main_color" href="{{ $setting->where('key', 'copyright_link')->first()->val }}">{{ $setting->where('key', 'copyright_link_text')->first()->val }}</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 bs-reset mt-login-5-bsfix hidden-sm hidden-xs">
            <div class="login-bg" style="background-image: url({{ asset('admin/assets/pages/img/login/bg.jpg') }})">

            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
</body>
</html>
