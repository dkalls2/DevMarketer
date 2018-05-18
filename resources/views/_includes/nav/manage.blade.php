<div class="side-menu" id = "admin-side-menu">
    <aside class="menu m-t-30 m-l-10">
        <p class="menu-label">
            General
        </p>

        <ul class="menu-list">
            <li><a href="{{route('manage.dashboard')}}" class="{{Nav::isRoute('manage.dashboard')}}">Dashboard</a></li>
                {{-- The class Nav::isRoute is from the easynav package we installed here:
                https://github.com/DevMarketer/LaravelEasyNav
                This helps us to highlight active navigation elements if there is a certain route, resource, segment, or word in a url.
                This example will only be active if we are in the manage.dashboard route. --}}
        </ul>

        <p class="menu-label">
            Content
        </p>

        <ul class="menu-list">
            <li><a href="{{route('posts.index')}}" class="{{Nav::isResource('posts', 2)}}">Blog Posts</a></li>
                {{-- this will allow this nav item to be active if we are using anything in the posts resource (index, show, edit, create) in the 2nd position after /manage --}}
        </ul>

        <p class="menu-label">
            Administration
        </p>

        <ul class="menu-list">
            <li><a href="{{route('users.index')}}" class="{{Nav::isResource('users')}}">Manage Users</a></li>
                {{-- this will allow this nav item to be active if we are using anything in the users resource (index, show, edit, create) --}}
            <li>
                <a class="has-submenu {{Nav::hasSegment(['roles', 'permissions'], 2)}}">Roles &amp; Permissions</a>
                    {{-- this will highlight if we are either in the roles or the permissions --}}
                <ul class="submenu">
                    <li><a href="{{route('roles.index')}}" class="{{Nav::isResource('roles')}}">Roles</a></li>
                    <li><a href="{{route('permissions.index')}}" class="{{Nav::isResource('permissions')}}">Permissions</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>