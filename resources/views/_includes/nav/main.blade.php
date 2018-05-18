<nav class="navbar has-shadow">
    <div class="container">
        <div class="navbar-brand" role="navigation" aria-label="main navigation">
            <a class="navbar-item" href="{{route('home')}}">
                <img src = "{{asset('images/devmarketer-logo.png')}}" alt="DevMarketer Logo" />
                {{-- From the asset helper, we can reference anything in the public folder...we can just do the url from the public folder. --}}
            </a>

            @if(Request::segment(1) =="manage")
                {{-- we only want to show this icon when the first segment of the url (the segment right after the first /) is "manage" --}}
                <a class="navbar-item is-hidden-desktop" id="admin-slideout-button">
                    <span class="icon"><i class="fa fa-arrow-circle-o-right"></i></span>
                </a>
            @endif

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
                            <span>Hey {{Auth::user()->name}}</span>
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
                            <a href='{{route('manage.dashboard')}}' class="navbar-item">
                                <span class="icon"><i class="fa fa-fw m-r-10 fa-cog"></i></span>
                                Manage
                            </a>
                            <hr class="navbar-divider">
                            <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <span class="icon"><i class="fa fa-fw m-r-10 fa-sign-out"></i></span>
                                Logout
                            </a>
                            @include('_includes.forms.logout')
                        </div>
                    </div>
                @endif
            </div>
        </div> 
    </div>
</nav>