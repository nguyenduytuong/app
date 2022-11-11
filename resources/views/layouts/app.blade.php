<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>{{ __('App') }}</title>
</head>

<body class="text-blueGray-700 bg-blueGray-800 antialiased">
    <main>
        @yield('content')
    </main>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
        <a href="#"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
            class="sidebar-nav">
            <i class="fa-fw fas fa-sign-out-alt"></i>
            Logout
        </a>
</body>

</html>