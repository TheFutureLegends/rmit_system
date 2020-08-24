<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="{{ route('dashboard.index') }}" {!! set_full_request_class(['dashboard'], 'class="mm-active"') !!}>
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Widgets</li>
                <li>
                    <a href="{{ route('profile.index') }}" {!! set_full_request_class(['dashboard/profile'], 'class="mm-active"') !!}>
                        <i class="metismenu-icon pe-7s-user"></i>
                        @if (Auth::user()->hasRole('president'))
                        Club Profile
                        @else
                        User Profile
                        @endif
                    </a>
                </li>
                <li class="app-sidebar__heading">Components</li>
                @if (Auth::user()->can('event.view'))
                <li {!! set_full_request_class(['dashboard/event*', 'dashboard/events'], 'class="mm-active"') !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Events
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('events.index') }}" {!! set_full_request_class(['dashboard/events', 'dashboard/event/edit/*', 'dashboard/event/show/*'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                List of events
                            </a>
                        </li>
                        {{-- @if (Auth::user()->can('event.create')) --}}
                        <li>
                            <a href="{{ route('event.create') }}" {!! set_full_request_class(['dashboard/event/create'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                Create new event
                            </a>
                        </li>
                        {{-- @endif --}}

                    </ul>
                </li>
                @endif

                @if (Auth::user()->can('club.view'))
                <li {!! set_full_request_class(['dashboard/club*', 'dashboard/clubs'], 'class="mm-active"') !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-study"></i>
                        Clubs
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('clubs.index') }}" {!! set_full_request_class(['dashboard/clubs', 'dashboard/club/edit/*'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                List of clubs
                            </a>
                        </li>
                        {{-- @if (Auth::user()->can('event.create')) --}}
                        <li>
                            <a href="{{ route('club.create') }}" {!! set_full_request_class(['dashboard/club/create'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                Create new club
                            </a>
                        </li>
                        {{-- @endif --}}

                    </ul>
                </li>
                @endif

                @if (Auth::user()->can('user.view'))
                <li class="app-sidebar__heading">
                    @if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']))
                    Security
                    @else
                    Members
                    @endif
                </li>
                <li {!! set_full_request_class(['dashboard/user*', 'dashboard/users'], 'class="mm-active"') !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Users
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('users.index') }}" {!! set_full_request_class(['dashboard/users', 'dashboard/user/edit/*', 'dashboard/user/transfer/*'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                List of users
                            </a>
                        </li>
                        {{-- @if (Auth::user()->can('event.create')) --}}
                        <li>
                            <a href="{{ route('user.create') }}" {!! set_full_request_class(['dashboard/user/create'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                Create new user
                            </a>
                        </li>
                        {{-- @endif --}}
                    </ul>
                </li>
                @if (Auth::user()->hasRole('super-admin'))
                <li {!! set_full_request_class(['dashboard/roles*', 'dashboard/role/*'], 'class="mm-active"') !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-door-lock"></i>
                        Roles
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('roles.index') }}" {!! set_full_request_class(['dashboard/roles', 'dashboard/role/edit/*'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                List of roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('role.create') }}" {!! set_full_request_class(['dashboard/role/create'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                Create new role
                            </a>
                        </li>
                    </ul>
                </li>
                <li {!! set_full_request_class(['dashboard/permissions*', 'dashboard/permission/*'], 'class="mm-active"') !!}>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-key"></i>
                        Permissions
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('permissions.index') }}" {!! set_full_request_class(['dashboard/permissions', 'dashboard/permission/edit/*'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                List of permissions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permission.create') }}" {!! set_full_request_class(['dashboard/permission/create'], 'class="mm-active"') !!}>
                                <i class="metismenu-icon"></i>
                                Create new permission
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @endif

                @if (Auth::user()->hasRole('super-admin'))
                <li class="app-sidebar__heading">PRO Version</li>
                <li>
                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>
                        Upgrade to PRO
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
