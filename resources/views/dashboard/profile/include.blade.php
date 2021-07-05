@php $admin = auth('admin')->user(); @endphp
<div class="profile-sidebar sidebar_profile">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="{{ $admin->image ? asset(auth('admin')->user()->image) : asset('images/user.png') }}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ $admin->username }} </div>
        </div>
        <div class="profile-userbuttons">
            <a href="{{ url('dashboard/profile/edit') }}" class="btn btn-circle orange btn-sm"><i class="fa fa-edit"></i> {{ __('lang.edit') }} {{ __('lang.profile') }}</a>
        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li class="{{ Request::is('dashboard/profile*') ? 'active' : '' }}">
                    <a href="{{ url('dashboard/profile') }}">
                        <i class="icon-user"></i> {{ __('lang.profile') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

