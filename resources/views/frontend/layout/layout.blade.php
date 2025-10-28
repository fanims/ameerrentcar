<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('direction', 'ltr') }}">

<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.style')
    <style>
        a:not(.btn-theme):hover,
        a:not(.btn-theme):active,
        a:not(.btn-theme):focus {
            color: #c9c9c9;
        }
    </style>
</head>

<body id="home" class="wide">
    <!-- Top contact bar -->
    @include('frontend.includes.topbar')

    <!-- PRELOADER -->
    @include('frontend.includes.preloader')
    <!-- /PRELOADER -->

    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- HEADER -->
        @include('frontend.includes.header')
        <!-- /HEADER -->

        <!-- CONTENT AREA -->
        @yield('content')
        <!-- /CONTENT AREA -->

        <!-- FOOTER -->
        @include('frontend.includes.footer')
        <!-- /FOOTER -->

        <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
    </div>
    <!-- /WRAPPER -->


    @include('frontend.includes.script')

</body>

</html>