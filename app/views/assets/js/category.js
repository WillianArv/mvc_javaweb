
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const modal = document.getElementById('modal-Category');

openModalBtn.addEventListener('click', () => {
    modal.style.display = 'block';
});

closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    if (accion) {
        window.location.href = "/formal/category";
    }
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
        if (accion) {
            window.location.href = "/formal/category";
        }
    }
});


$(document).ready(function () {
    const formulario = document.getElementById("formCategory");
    $('#formCategory').on("submit", function (e) {
        e.preventDefault();

        const categoria = document.getElementById("inputCategoria");

        if (categoria.value == "") {
            swal("RELLENE LOS CAMPOS VACIOS", "", "error");
        } else {
            formulario.submit();
        }
    })
})

$(document).ready(function () {
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
})
