<div class="container-modal" id="container-edituser">
    <div class="inner-modal">
        <div class="modal-close" id="close-edituser" onclick="closeModal(this)">
            <svg class="icon close-icon">
                <use xlink:href="{{'images/close-icon.svg#close-icon'}}"></use>
            </svg>
        </div>

        <h2 class="modal-title">Жеке ақпараттарды өзгерту</h2>

        <form id="editUserForm" class="modal-form" action="{{ route('profile.update') }}">
            @csrf
            <div class="form-input-block">
                <input name="full_name" class="default-input modal-form-input"
                       id="edit-full_name"
                       type="text" placeholder="Аты-жөніңіз" value="{{ $user->full_name }}">
                <span class="invalid-feedback" role="alert" id="error-edit-full_name"></span>
            </div>

            <div class="form-input-block">
                <input name="email" class="default-input modal-form-input"
                       id="edit-email"
                       type="email" placeholder="Email" value="{{ $user->email }}">
                <span class="invalid-feedback" role="alert" id="error-edit-email">
                </span>
            </div>

            <div class="form-input-block">
{{--                <input  name="phone_edit"--}}
{{--                        class="default-input modal-form-input" type="text"--}}
{{--                        id="edit-phone"--}}
{{--                        placeholder="87071234567" value="{{ $user->phone }}">--}}
{{--                <span class="invalid-feedback" role="alert" id="error-edit-phone"></span>--}}
                <input id="edit-phone" name="phone_edit"
                       class="default-input modal-form-input" type="text"
                       value="{{ $user->phone }}"
                       placeholder="+7 (700)-999-99-99">
                <span class="invalid-feedback" role="alert" id="error-edit-phone">
                                </span>
            </div>
            <br>
            <button type="submit" class="default-btn btn-editUser">
                Сақтау
            </button>
        </form>
    </div>
</div>

