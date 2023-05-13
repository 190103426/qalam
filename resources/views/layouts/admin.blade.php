<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/admin_asset/plugins/fontawesome-free/css/all.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/admin_asset/plugins/fontawesome-free/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{asset('/admin_asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin_asset/plugins/sweetalert2/sweetalert2.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/admin_asset/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin_asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin_asset/admin_main.css')}}">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.9/plyr.min.css"
          integrity="sha512-9NS6wyLGVddfu8MvjH2muvHT+3lPxYifn5SDMigU+cgsQY91MTP72x8OpbnK9ucbjfZc6TMP3hajTCFrvFWxxg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @yield('custom_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link logout" style="cursor: pointer" data-toggle="dropdown"
                   href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-24"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('index') }}" class="brand-link">
            <span class="brand-text font-weight-light">Qalam</span>
        </a>
{{--        <a href="{{ route('index') }}" class="brand-link ml-4">--}}
            {{--            <img src="{{asset('images/Logo.svg')}}" alt="InveStore Logo" class="brand-image" style="width: 40px;">--}}
{{--            <span class="brand-text font-weight-light" style="font-size: 14px">{{ config('app.name') }}</span>--}}
{{--        </a>--}}
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('images/user512.svg')}}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('profile')}}" class="d-block">{{auth()->user()->full_name}}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index')}}" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>
                                Басты бет
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{(request()->routeIs('admin.users.*') ? 'active':'')}}">
                            <i class="fas fa-users"></i>
                            <p>
                                Қолданушылар
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.courses.index')}}" class="nav-link {{(request()->routeIs('admin.courses.*') ? 'active':'')}}">
                            <i class="fas fa-shopping-bag"></i>
                            <p>
                                Курстар
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.questions.index') }}" class="nav-link {{(request()->routeIs('admin.questions.*') ? 'active':'')}}">
                            <i class="fas fa-question-circle"></i>
                            <p>
                                Сұрақ-жауап
                            </p>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('admin.comments.index') }}" class="nav-link {{(request()->routeIs('admin.comments.*') ? 'active':'')}}">--}}
{{--                            <i class="fas fa-comment"></i>--}}
{{--                            <p>--}}
{{--                                Пікірлер--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>
                                Профиль
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('profile')}}"
                                   class="nav-link {{(request()->routeIs('profile') ? 'active':'')}}">
                                    <i class="far fa-circle"></i>
                                    <p> Жеке кабинет </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <form action="{{route('logout')}}" class="logout-form" method="post" id="logout" style="cursor: pointer">
                                    @csrf
                                    <a onclick="$('#logout').submit()" class="nav-link">
                                        <i class="far fa-circle"></i>
                                        Шығу
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        @include('admin.components.result_messages')
        @yield('content')
    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.9/plyr.min.js"
        integrity="sha512-Wt3CCBrK4mMw9PUEzDpKPMN7cLCq7/Uu7vxRtG+EQv+DO9Yae/LKSQTfziDj51y1yeSqqLt142lNyJtBXG/gSw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    Array.from(document.querySelectorAll('.plyr__video-embed')).map(p => new Plyr(p, {}));
</script>

<script src="{{asset('/admin_asset/plugins/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('ckeditor_description');
    CKEDITOR.replace('answer_1');
    CKEDITOR.replace('answer_2');
    CKEDITOR.replace('answer_3');
    CKEDITOR.replace('answer_4');
    CKEDITOR.replace('answer_5');
    CKEDITOR.replace('question_text');
</script>
<script src="{{asset('/admin_asset/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<script src="{{asset('/admin_asset/plugins/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('/admin_asset/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{asset('/admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/admin_asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
{{--<script src="{{asset('js/maskinput.js')}}"></script>--}}
<script src="{{asset('js/maskinput.js')}}"></script>

<script src="{{asset('/admin_asset/dist/js/adminlte.js')}}"></script>
<script src="{{asset('/admin_asset/admin.js?v=2')}}"></script>

<script>
    $('#register_phone').mask("+7 (999)-999-99-99");
    $('#login_phone').mask("+7 (999)-999-99-99");
</script>
@yield('admin_js')
</body>
</html>
