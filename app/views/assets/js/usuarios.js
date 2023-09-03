$('.btn-eliminar').on("click", function (e) {
    e.preventDefault();
    var link = $(this).attr('href');
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás recuperar este registro!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Borrar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }).then((result) => {
        console.log(result)
        if (result.value) {
            window.location.href = link;
        }
    })
});