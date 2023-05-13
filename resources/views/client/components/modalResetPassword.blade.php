
<div class="container-modal" id="container-reset-password">
    <div class="inner-modal">
        <div class="modal-close" id="close-login" onclick="closeModal(this)">
            <svg class="icon close-icon">
                <use xlink:href="{{asset('images/close-icon.svg#close-icon')}}"></use>
            </svg>
        </div>

        <h2 class="modal-title">Құпия сөзді қалпына келтіру</h2>

        <form id="resetPasswordForm" class="modal-form" action="{{ route('reset_password.ajax') }}">
            @csrf

            <div class="form-input-block">
                <input id="reset_password_email" name="email"
                       class="default-input modal-form-input" type="email"
                       placeholder="example@example.com">
                <span class="invalid-feedback" role="alert" id="error-reset_password-email">
                  </span>
            </div>

            <button type="submit" class="default-btn button-login">
                Қалпына келтіру
            </button>
        </form>
        <hr class="modal-hr">

        <div class="white-btn btn-register" onclick="openRegisterLink(this)">
            Тіркелу
        </div>
    </div>
</div>

