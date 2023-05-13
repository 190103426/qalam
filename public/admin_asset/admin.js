$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if (link === location2) {
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');
        }
    });
    // $('.delete-btn').click(function () {
    //     var res = confirm('Подтвердите действия');
    //     if (!res) {
    //         return false;
    //     }
    // });
    $('.delete-btn').click(function (e) {
        e.preventDefault()
        let id = e.target.id
        console.log('id', id)
        console.log('e.target', e.target)
        Swal.fire({
            title: 'Вы действительно хотите удалить ' + id +' ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет',
        }).then((res) => {
            console.log('res', res)
            if (res.isConfirmed) {
                $(`#delete-form-${id}`).submit();
            }
        })
    });
    $('.logout').click(function (e) {
        e.preventDefault();
        $('#logout-form').submit();
    });

    // $('#register_phone').mask("+7 (999)-999-99-99");



        $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

})


