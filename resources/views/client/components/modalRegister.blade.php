
<div class="container-modal" id="container-register">
    <div class="inner-modal">
        <div class="modal-close" id="close-login" onclick="closeModal(this)">
            <svg class="icon close-icon">
                <use xlink:href="{{asset('images/close-icon.svg#close-icon')}}"></use>
            </svg>
        </div>

        <h2 class="modal-title">Тіркелу</h2>

        <form action="{{route('register.ajax') }}" method="post" id="registerForm" class="modal-form">
            @csrf
            <div class="form-input-block">
                <input name="register_full_name"
                       id="register_full_name"
                       class="default-input modal-form-input"
                       type="text" placeholder="Аты-жөніңіз">

                <span class="invalid-feedback" role="alert" id="error-register-full_name">
                                </span>
            </div>

            <div class="form-input-block">
                <input  name="register_phone"
                        id="register_phone"
                        class="default-input modal-form-input" type="text"
                       placeholder="87071234567">
                <span class="invalid-feedback" role="alert" id="error-register-phone">
                                </span>
            </div>

            <div class="form-input-block">
                <input name="email"
                       id="register_email"
                       class="default-input modal-form-input" type="email" placeholder="Email">
                <span class="invalid-feedback" role="alert" id="error-register-email">
                </span>
            </div>

            <div class="form-input-block">
                <input name="password" class="default-input modal-form-input"
                       id="register_password"
                       type="password" placeholder="Құпия сөз">
                <span class="invalid-feedback" role="alert" id="error-register-password">
                                </span>
            </div>

            <div class="form-input-block">
                <input name="password_confirmation" class="default-input modal-form-input"
                       id="register_password_confirm"
                       type="password" placeholder="Құпия сөзді қайталаңыз">
                <span class="invalid-feedback" role="alert" id="error-register-password_confirmation">
                                </span>
            </div>

            <button type="submit" id="register-button" class="default-btn btn-register">
                Тіркелу
            </button>
        </form>

{{--        <div class="modal-desc-block">--}}
{{--            <input type="checkbox" class="" id="register-confirm-policy" name="happy" value="yes">--}}
{{--            <div class="desc-checked">Публичная офертаны қабылдаймын</div>--}}
{{--        </div>--}}
        <div class="default-form-confirm modal-desc-block hidden">
            <div class="d-flex align-items-center mb-10">
                <input type="checkbox" name="confirm_policy" onchange="enableDisableRegisterButton()" id="register_confirm_policy" checked="checked">
                    <a class="confirm-policy-text" onclick="javascript:void(0)" >
                        Публичная офертаны қабылдаймын
                    </a>

            </div>
            <span class="invalid-feedback" role="alert" id="error-register-confirm_policy">
                                </span>
        </div>
        <hr class="modal-hr">

        <div class="white-btn btn-register" onclick="openLoginLink(this)">
            Кіру
        </div>
    </div>
</div>

