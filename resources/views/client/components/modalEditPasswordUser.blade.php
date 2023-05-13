<div class="container-modal" id="container-edit-password">
    <div class="inner-modal">
        <div class="modal-close" id="close-edit-password" onclick="closeModal(this)">
            <svg class="icon close-icon">
                <use xlink:href="{{'images/close-icon.svg#close-icon'}}"></use>
            </svg>
        </div>

        <h2 class="modal-title">Құпия сөзді өзгерту </h2>

        <form action="{{ route('profile.change_password') }}" id="editUserPassword"
              class="modal-form">
            @csrf
            <div class="form-input-block">
                <input name="password" class="default-input modal-form-input"
                       id="edit-password"
                       type="password" placeholder="Құпия сөз">
                <span class="invalid-feedback" role="alert" id="error-edit-password"></span>
            </div>
            <div class="form-input-block">
                <input name="password_confirmation" class="default-input modal-form-input"
                       id="edit-password_confirm"
                       type="password" placeholder="Құпия сөзді қайталаңыз">
                <span class="invalid-feedback" role="alert" id="error-edit-password_confirmation"></span>
            </div>
            <br>
            <button type="submit" class="btn default-btn btn-editUser">
                Сақтау
            </button>
        </form>
    </div>
</div>
