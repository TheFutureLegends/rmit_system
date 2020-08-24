<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.backend._partials._stylesheet')

    @yield('stylesheet')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        @include('layouts.backend._partials._header')

        {{-- @if (Auth::user()->hasRole('super-admin')) --}}
            @include('layouts.backend._partials._options')
        {{-- @endif --}}

        <div class="app-main">
            @include('layouts.backend._partials._sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                    <!-- Content -->

                    <!-- End Content -->
                </div>
                @include('layouts.backend._partials._footer')
            </div>
            {{-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> --}}
        </div>
    </div>
    @include('layouts.backend._partials._javascript')
    @yield('javascript')
</body>

</html>
