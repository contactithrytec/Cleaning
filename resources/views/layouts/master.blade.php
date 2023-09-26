<!doctype html>

<html lang="en">
<head>
    @include('layouts.extra.meta')
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->

    @include('layouts.extra.css')
    @stack('css')
</head>
<body >
<script src="{{asset('assets/js/demo-theme.min.js?1684106062')}}"></script>
<div class="page">

    @include('layouts.navbars.navbar1')
    @include('layouts.navbars.navbar2')

    <div class="page-wrapper">
        <!-- Page header -->
        @include('layouts.header.header')
        <!-- Page body -->
        <div class="page-body">

            <div class="container-xl">
                @include('layouts.extra.flash')
            </div>

            @yield('content')

        </div>

        @include('layouts.footer.footer')

    </div>
</div>
@include('model')
@include('layouts.extra.js')
@include('layouts.extra.js.select2')
@stack('js')

</body>
</html>
