<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:type" content="profile"/>
    <meta property="og:title" content="Qalam онлайн академиясы"/>
    <meta property="og:description" content="Qalam онлайн академиясы"/>
    <meta property="og:image" content="{{ env('APP_URL') . '/images/Logo.svg'}}"/>
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:site_name" content="Qalam онлайн академиясы"/>
    <meta property="og:see_also" content="{{env('APP_URL')}}"/>


    <meta itemprop="name" content="Qalam онлайн академиясы"/>
    <meta itemprop="description" content="Qalam онлайн академиясы"/>
    <meta itemprop="image" content="{{env('APP_URL') . '/images/Logo.svg'}}"/>

{{--    <link rel="shortcut icon" type="image/svg" href="/images/Logo.svg">--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Qalam онлайн академиясы')</title>
    <link rel="shortcut icon" href="{{asset('images/Logo.svg')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/fonts.css?v=5')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/default.css?v=5')}}">
    <link rel="stylesheet" href="{{asset('css/breadcrumb.css?v=5')}}">
    <link rel="stylesheet" href="{{asset('css/header.css?v=5')}}">
    <link rel="stylesheet" href="{{asset('css/modal.css?v=5')}}">

    <link rel="stylesheet" href="{{asset('css/style.css?v=5')}}">
    <link rel="stylesheet" href="{{asset('css/loader.css?v=5')}}">

    <link rel="stylesheet" href="{{asset('/admin_asset/plugins/sweetalert2/sweetalert2.css?v=9')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.9/plyr.min.css"
          integrity="sha512-9NS6wyLGVddfu8MvjH2muvHT+3lPxYifn5SDMigU+cgsQY91MTP72x8OpbnK9ucbjfZc6TMP3hajTCFrvFWxxg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body class="wrap d-flex flex-column min-vh-100">
<div class="loader">
    @include('client.components.loader')
</div>
<div class="flex-fill">
    @include('client.components.header')

    @yield('content')
    @guest
    @include('client.components.modalLogin')
    @include('client.components.modalResetPassword')
    @include('client.components.modalRegister')
        @endguest
</div>
@include('client.components.footer')



<!-- Scripts -->
<script src="{{asset('js/jquery.min.js')}}"></script>
{{--<script src="{{asset('js/swiper-bundle.min.js')}}"></script>--}}
<script src="{{asset('js/maskinput.js')}}"></script>

{{--<script src="{{ asset('js/bootstrap.min.js')}}"></script>--}}
<script src="{{asset('/admin_asset/plugins/sweetalert2/sweetalert2.js?v=9')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.9/plyr.min.js"
        integrity="sha512-Wt3CCBrK4mMw9PUEzDpKPMN7cLCq7/Uu7vxRtG+EQv+DO9Yae/LKSQTfziDj51y1yeSqqLt142lNyJtBXG/gSw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/script.js?v=5')}}"></script>

<script>
    Array.from(document.querySelectorAll('.plyr__video-embed')).map(p => new Plyr(p, {}));
    @if(session('success'))
        alertModal("{{session('success')}}")
    @endif
</script>

@yield('custom_js')

</body>
</html>
