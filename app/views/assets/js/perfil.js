document.getElementById('botonSeleccionarArchivo').addEventListener('click', function () {
    document.getElementById('inputArchivo').click();
});

$(document).ready(function () {
    $('#inputArchivo').on('change', function (event) {
        const archivo = event.target.files[0];
        const formData = new FormData();
        formData.append('pictureProfile', archivo);

        $.ajax({
            url: "/formal/perfil/edit_profile_picture",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                responseObj = JSON.parse(data);
                if (responseObj.success) {
                    swal({
                        icon: 'success',
                        title: 'EXITO',
                        text: 'Imagen actualizada correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = "/formal/perfil";
                    })
                } else {
                    swal({
                        icon: 'error',
                        title: 'Error',
                        text: responseObj.error,
                        confirmButtonText: 'Aceptar'
                    })
                }
            },
            error: function (xhr, status, error) {
                // Aquí puedes manejar errores en la solicitud AJAX
                console.error(error);
            }
        });
    });
});