<header class="header">
    <div class="container">
        <div class="header-body">
            <div id="burger-btn" class="burger-btn">
                <img src="{{asset('images/mobile-burger-orange.svg')}}" width="30" height="auto" alt="burger">
            </div>

            <div class="header-left">
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{asset('images/Logo.svg')}}" loading="lazy" width="102" height="75"
                             alt="platform Logo">
                    </a>
                </div>
                <div class="mobile-menu">
                    <nav class="header-menu">
                        <ul class="header-menu-items">
                            <li class="header-menu-item">
                                <a href="{{ route('courses.index') }}"
                                   class="header-menu-link {{ request()->routeIs('courses.*') ? 'menu-active' : '' }}">
                                    Курстар тізімі
                                </a>
                            </li>
                            <li class="header-menu-item">
                                <a href="{{ route('questions') }}"
                                   class="header-menu-link {{ request()->routeIs('questions') ? 'menu-active' : '' }}">
                                    Сұрақ жауап
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="phones-block">
                        <div class="title">
                            Байланыс тел: <span></span>
                        </div>
                        <div class="phones">
                            <a href="tel:">
                                +7 778 364 8876
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="header-right">
                <div class="phones">
                    <img src="{{asset('images/call.svg')}}" alt="">
                    <a href="tel:"> +7 (778) 364-88-76</a>
                </div>
				<div class="phoness visible-xs">
                    <a href="tel:+77783648876">
                        <img src="{{asset('images/call.svg')}}" alt="">
                    </a>
                </div>

                @guest
                    <div class="auth">
                        <button class="default-btn btn-login-mob" onclick="openLogin(this)">
                            <img src="{{asset('images/usericon.svg')}}" alt="">
                            <div class="hidden-xs">Кіру/Тіркелу</div>
                        </button>
                    </div>
                @endguest
                @auth
                    <div class="auth-buttons">
                        <div class="dropdown-user-menu">
                                <span class="dropdown-body">
                                    <img class="user-icon" width="40" height="40" src="{{ asset(auth()->user()->image
                                        ? (\App\Models\User::IMAGE_PATH .auth()->user()->image)
                                        : 'images/user.svg') }}" alt="userIcon">

                                    <div class="user-info">
                                    {{ auth()->user()->full_name }}
                                        <svg style="margin-left: 10px" width="16" height="10" viewBox="0 0 16 10"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2.34375" y="0.65686" width="10" height="2" rx="1"
                                                  transform="rotate(45 2.34375 0.65686)" fill="#11A50E"/>
                                            <rect x="15.0723" y="2.07104" width="10" height="2" rx="1"
                                                  transform="rotate(135 15.0723 2.07104)" fill="#11A50E"/>
                                        </svg>
                                    </div>
                                </span>
                            <div class="dropdown-content">
                                @if(auth()->user()->is_admin)
                                    <a class="dropdown-item-custom" href="{{route('admin.index')}}">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M20.5901 22C20.5901 18.13 16.7402 15 12.0002 15C7.26015 15 3.41016 18.13 3.41016 22" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Админ панель
                                    </a>
                                    <div class="line"></div>
                                @endif
                                <a class="dropdown-item-custom {{ request()->routeIs('profile') ? 'menu-active' : '' }}"
                                   href="{{route('profile')}}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M20.5901 22C20.5901 18.13 16.7402 15 12.0002 15C7.26015 15 3.41016 18.13 3.41016 22" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Жеке кабинет
                                </a>
                                <div class="line"></div>
                                <a class="dropdown-item-custom {{ request()->routeIs('user.courses') ? 'menu-active' : '' }}"
                                   href="{{route('user.courses')}}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.35 2H9.65001C8.61001 2 7.76001 2.84 7.76001 3.88V4.82C7.76001 5.86 8.60001 6.7 9.64001 6.7H14.35C15.39 6.7 16.23 5.86 16.23 4.82V3.88C16.24 2.84 15.39 2 14.35 2Z" fill="#11A50E"></path>
                                        <path d="M17.24 4.82001C17.24 6.41001 15.94 7.71001 14.35 7.71001H9.65004C8.06004 7.71001 6.76004 6.41001 6.76004 4.82001C6.76004 4.26001 6.16004 3.91001 5.66004 4.17001C4.25004 4.92001 3.29004 6.41001 3.29004 8.12001V17.53C3.29004 19.99 5.30004 22 7.76004 22H16.24C18.7 22 20.71 19.99 20.71 17.53V8.12001C20.71 6.41001 19.75 4.92001 18.34 4.17001C17.84 3.91001 17.24 4.26001 17.24 4.82001ZM12.38 16.95H8.00004C7.59004 16.95 7.25004 16.61 7.25004 16.2C7.25004 15.79 7.59004 15.45 8.00004 15.45H12.38C12.79 15.45 13.13 15.79 13.13 16.2C13.13 16.61 12.79 16.95 12.38 16.95ZM15 12.95H8.00004C7.59004 12.95 7.25004 12.61 7.25004 12.2C7.25004 11.79 7.59004 11.45 8.00004 11.45H15C15.41 11.45 15.75 11.79 15.75 12.2C15.75 12.61 15.41 12.95 15 12.95Z" fill="#11A50E"></path>
                                    </svg>
{{--                                    <img src="{{asset('images/profile-icon.svg')}}" alt="profile icon">--}}
                                    Менің курстарым
                                </a>
                                <div class="line"></div>

                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="dropdown-item-custom" type="submit">

                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.90039 7.55999C9.21039 3.95999 11.0604 2.48999 15.1104 2.48999H15.2404C19.7104 2.48999 21.5004 4.27999 21.5004 8.74999V15.27C21.5004 19.74 19.7104 21.53 15.2404 21.53H15.1104C11.0904 21.53 9.24039 20.08 8.91039 16.54" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.0001 12H3.62012" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.85 8.64999L2.5 12L5.85 15.35" stroke="#11A50E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

{{--                                        <img src="{{asset('images/logout-icon.svg')}}" alt="profile icon">--}}
                                        Шығу
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
