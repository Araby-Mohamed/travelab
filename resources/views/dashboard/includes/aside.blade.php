<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start {{ Request::is('dashboard/home') || Request::is('dashboard') ? 'active open' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">{{ __('lang.dashboard') }}</span>
                </a>
            </li>
            {{-- Start Roles Link --}}
            @permission('read-roles')
                <li class="nav-item {{ Request::routeIs('dashboard.roles*') ? 'active open' : '' }}">
                    <a href="{{ route('dashboard.roles') }}" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">{{ __('lang.roles') }}</span>
                    </a>
                </li>
            @endpermission
            {{-- Start Admins Link --}}
            @permission('read-admins')
                <li class="nav-item {{ Request::routeIs('dashboard.admins*') ? 'active open' : '' }}">
                    <a href="{{ route('dashboard.admins') }}" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">{{ __('lang.admins') }}</span>
                    </a>
                </li>
            @endpermission

            {{-- Start Users Link --}}
            @permission('read-users')
            <li class="nav-item {{ Request::routeIs('dashboard.users*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.users') }}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{ __('lang.users') }}</span>
                </a>
            </li>
            @endpermission

            @permission('read-packages')
            <li class="nav-item {{ Request::routeIs('dashboard.packages*') || Request::routeIs('dashboard.activities*') || Request::routeIs('dashboard.links*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.packages') }}" class="nav-link nav-toggle">
                    <i class="fa fa-archive"></i>
                    <span class="title">Packages</span>
                </a>
            </li>
            @endpermission

            @permission('read-rating')
            <li class="nav-item {{ Request::routeIs('dashboard.ratings*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.ratings') }}" class="nav-link nav-toggle">
                    <i class="fa fa-star"></i>
                    <span class="title">Ratings</span>
                </a>
            </li>
            @endpermission


            @permission('read-currency')
                <li class="nav-item {{ Request::is('dashboard/currency*') ? 'active open' : '' }}">
                    <a href="{{ route('dashboard.currency') }}" class="nav-link nav-toggle">
                        <i class="fa fa-usd"></i>
                        <span class="title">Currency</span>
                    </a>
                </li>
            @endpermission

            @permission('read-country')
            <li class="nav-item {{ Request::is('dashboard/country*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.country') }}" class="nav-link nav-toggle">
                    <i class="fa fa-flag"></i>
                    <span class="title">Country</span>
                </a>
            </li>
            @endpermission

            @permission('read-interests')
            <li class="nav-item {{ Request::is('dashboard/interests*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.interests') }}" class="nav-link nav-toggle">
                    <i class="fa fa-tags"></i>
                    <span class="title">Interests</span>
                </a>
            </li>
            @endpermission


            @permission('read-messages')
            <li class="nav-item {{ Request::is('dashboard/messages*') ? 'active open' : '' }}">
                <a href="{{ route('dashboard.messages') }}" class="nav-link nav-toggle">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Messages</span>
                </a>
            </li>
            @endpermission

            {{-- Start Settings Link --}}
            @permission('read-settings')
                <li class="nav-item {{ Request::is('dashboard/setting*') ? 'active open' : '' }}">
                    <a href="{{ url('dashboard/setting') }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('lang.setting') }}</span>
                    </a>
                </li>
            @endpermission


        </ul>
    </div>
</div>
