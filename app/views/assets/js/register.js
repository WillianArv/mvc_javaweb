$(document).ready(function () {
    $("#frm_registro").on("submit", function (e) {
        e.preventDefault();

        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");

        if (password.value != confirmPassword.value) {
            swal("LAS CONTRASEÑAS NO COINCIDEN", "", "error");
        } else {
            var frm = $(this).serialize();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: frm,
                success: function (data) {
                    responseObj = JSON.parse(data);
                    if (responseObj.success) {
                        swal({
                            icon: 'success',
                            title: 'Cuenta Creada',
                            text: 'Ahora puede iniciar sesión',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.location.href = "/formal/login";
                        })
                    } else {
                        swal({
                            icon: 'error',
                            title: 'Error',
                            text: responseObj.error,
                            confirmButtonText: 'Aceptar'
                        })
                        $("#btn_registro").prop("disabled", false);
                    }
                }
            })
        }
    });
});