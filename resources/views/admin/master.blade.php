@include('admin.partials.header')
    <body class="sb-nav-fixed">
        @include('admin.partials.nav')
        <div id="layoutSidenav">
            @include('admin.partials.sidebar')
            <div id="layoutSidenav_content">
               @yield('content')
                @include('admin.partials.footer')
    </body>
</html>
