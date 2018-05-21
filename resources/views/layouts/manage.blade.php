<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevMarketer - MANAGEMENT</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    {{-- This is so I can add CSS stylesheets to specific pages. 
    So all the pages will have app.css but lets say i want to link a stylesheet for chart.js on my dashboard page 
    to show charts on that page. On that one blade file I would add a @section('styles') and then put the stylesheet 
    link in there and that will append it after my app.css file but only on that one page that needs that CSS sheet.
    If my page doesn't need any custom css then i don't need to do anything and it will simply ignore it. So it gives 
    me future flexibility. --}}

</head>
<body>
    @include('_includes.nav.main')

    @include('_includes.nav.manage')


    <div class="management-area" id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('_includes.notifications.toast')
    @yield('scripts')

</body>
</html>
