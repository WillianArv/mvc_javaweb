$(document).ready(function () {
    $("#frm_login").on("submit", function (e) {
        e.preventDefault();
        const email = document.getElementById("floatingInput");
        const clave = document.getElementById("floatingPassword");
        if (email.value === '' || clave.value === '') {
            swal("RELLENE LOS CAMPOS VACIOS", "", "error");
        } else {
            $("#btn_login").prop("disabled", true);
            var frm = $(this).serialize();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: frm,
                success: function (data) {
                    responseObj = JSON.parse(data);
                    if (responseObj.success) {
                        console.log(responseObj.rol);
                        if (responseObj.rol == 'admin')
                            window.location.href = "/formal/admin";
                        else
                            window.location.href = "/formal/";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: responseObj.error,
                            confirmButtonText: 'Aceptar'
                        })
                        $("#btn_login").prop("disabled", false);
                    }
                }
            });
        }

    });
});