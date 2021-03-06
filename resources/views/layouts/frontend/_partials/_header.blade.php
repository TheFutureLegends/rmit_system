<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route("home.index") }}">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li {!! set_full_request_class(['/'], 'class="active"') !!}><a href="{{ route("home.index") }}">Home</a></li>
                    <li {!! set_full_request_class(['events', 'event/*'], 'class="active"') !!}><a href="{{ route('events.frontend.index') }}">Events</a></li>
                    <!-- Dropdown -->
                    @guest
                    <li {!! set_full_request_class(['login'], 'class="active"') !!}><a href="{{ route('login') }}">Login</a></li>
                    @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="metismenu-icon pe-7s-power"></i>&nbsp;{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
