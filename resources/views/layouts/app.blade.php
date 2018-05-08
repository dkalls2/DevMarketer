<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevMarketer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar has-shadow">
            <div class="container">
                <div class="navbar-brand" role="navigation" aria-label="main navigation">
                    <a class="navbar-item" href="{{route('home')}}">
                        <img src = "{{asset('images/devmarketer-logo.png')}}" alt="DevMarketer Logo" />
                        {{-- From the asset helper, we can reference anything in the public folder...we can just do the url from the public folder. --}}
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div class="navbar-menu" role="navigation" aria-label="main navigation">
                    <div class="navbar-start">
                        <a href="#" class="navbar-item is-tab is-hidden-mobile m-l-10">Learn</a>
                        <a href="#" class="navbar-item is-tab is-hidden-mobile">Discuss</a>
                        <a href="#" class="navbar-item is-tab is-hidden-mobile">Share</a>
                    </div>

                    <div class="navbar-end">
                        @if (Auth::guest())
                            <a href="{{route('login')}}" class="navbar-item is-tab">Login</a>
                            <a href="{{route('register')}}" class="navbar-item is-tab">Join the Community</a>
                        @else
                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-item is-tab">
                                    <span>Hey Alex</span>
                                    <span class="icon"><i class="fa fa-caret-down"></i></span>
                                </a>
                            
                                <div class="navbar-dropdown is-right">
                                    <a href="#" class="navbar-item">
                                        <span class="icon"><i class="fa fa-fw m-r-10 fa-user-circle-o"></i></span>
                                        Profile
                                    </a>
                                    <a href="#" class="navbar-item">
                                        <span class="icon"><i class="fa fa-fw m-r-10 fa-bell"></i></span>
                                        Notifications
                                    </a>
                                    <a href="#" class="navbar-item">
                                        <span class="icon"><i class="fa fa-fw m-r-10 fa-cog"></i></span>
                                        Settings
                                    </a>
                                    <hr class="navbar-divider">
                                    <a href="#" class="dropdown-item">
                                        <span class="icon"><i class="fa fa-fw m-r-10 fa-sign-out"></i></span>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div> 
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
