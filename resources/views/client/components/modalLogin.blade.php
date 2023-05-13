
<div class="container-modal" id="container-login">
    <div class="inner-modal">
        <div class="modal-close" id="close-login" onclick="closeModal(this)">
            <svg class="icon close-icon">
                <use xlink:href="{{asset('images/close-icon.svg#close-icon')}}"></use>
            </svg>
        </div>

        <h2 class="modal-title">Өз аккаунтыма кіру</h2>

        <form id="loginForm" class="modal-form" action="{{ route('login.ajax') }}">
            @csrf

            <div class="form-input-block">
{{--                <input id="login_email" name="email"--}}
{{--                       class="default-input modal-form-input" type="email"--}}
{{--                       placeholder="example@example.com">--}}
                <input id="login_phone" name="phone"
                       class="default-input modal-form-input" type="text"
                       placeholder="+7 (700)-999-99-99">
                <span class="invalid-feedback" role="alert" id="error-login-phone">
                                </span>
            </div>

            <div class="form-input-block">
                <input id="login_password" name="password" class="default-input modal-form-input"
                       type="password" placeholder="Құпия сөз">
                <span class="invalid-feedback" role="alert" id="error-login-password">
                </span>
            </div>

            <button type="submit" class="default-btn button-login">
                Кіру
            </button>
        </form>

        <div class="modal-desc-block">
            <p class="desc-info">Құпия сөзді ұмытып қалдыңыз ба?</p>
            <a onclick="openResetPasswordLink(this)" class="desc-info-link">Қалпына келтіру</a>
        </div>

        <hr class="modal-hr">

        <div class="white-btn btn-register" onclick="openRegisterLink(this)">
            Тіркелу
        </div>
    </div>
</div>

