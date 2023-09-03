

document.addEventListener("DOMContentLoaded", function () {

    //Eliminar producto
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

    //Span de campo obligatorio
    const requiredLabels = document.querySelectorAll(".required-label");
    requiredLabels.forEach(label => {
        const input = label.previousElementSibling;

        input.addEventListener("input", () => {
            if (input.value.trim() === "") {
                label.style.display = "inline";
            } else {
                label.style.display = "none";
            }
        });
    });


    //Nuevo color
    const inputNewColor = document.getElementById("NewColorInput");
    const buttonNewColor = document.getElementById("NewColorButton");
    const originalButtonBackground = buttonNewColor.style.background;

    buttonNewColor.addEventListener("click", () => {
        const icon = document.getElementById("icon-button");
        icon.classList.remove('fa-plus');
        if (inputNewColor.style.display === "none") {
            inputNewColor.style.display = "block";
            icon.classList.add('fa-minus');
            buttonNewColor.style.background = "brown";
        } else {
            inputNewColor.style.display = "none";
            icon.classList.remove('fa-minus');
            icon.classList.add("fa-plus");
            buttonNewColor.style.background = originalButtonBackground;
        }
    });


    $('#insertProduct').on("click", (e) => {
        e.preventDefault();

        const nombre = document.getElementById('nombreProduct');
        const precio = document.getElementById('precio');
        const disponibilidad = document.getElementById('disponibilidad');
        const categoria = document.getElementById('selectCategory');
        const checkboxes = document.querySelectorAll(".form-check-input");
        const checkboxesSize = document.querySelectorAll(".form-check-input-tallas");

        let isAnyCheckboxSelected = false;
        let isAnyCheckboxSelectedSize = false;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                isAnyCheckboxSelected = true;
                return;
            }
        });

        checkboxesSize.forEach((checkbox) => {
            if (checkbox.checked) {
                isAnyCheckboxSelectedSize = true;
                return;
            }
        });

        if (nombre.value === '' || precio.value === '' || disponibilidad.value === '' || categoria.value === 'Ninguno') {
            swal("Por favor complete todos los campos obligatorios.", "", "error");
        } else if (!isAnyCheckboxSelected) {
            swal("SELECCIONE AL MENOS UN COLOR", "", "error");
        } else if (!isAnyCheckboxSelectedSize) {
            swal("SELECCIONE AL MENOS UNA TALLA", "", "error");
        }
        else {

            // Antes de agregar nuevos campos ocultos, elimina los campos ocultos anteriores
            const existingHiddenColorInputs = document.querySelectorAll('input[name="selected_colors[]"]');
            existingHiddenColorInputs.forEach(input => {
                input.parentNode.removeChild(input);
            });

            const existingHiddenSizeInputs = document.querySelectorAll('input[name="selected_size[]"]');
            existingHiddenSizeInputs.forEach(input => {
                input.parentNode.removeChild(input);
            });

            // Agrega los valores de los checkboxes seleccionados
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'selected_colors[]';
                    hiddenInput.value = checkbox.value;
                    formProduct.appendChild(hiddenInput);
                }
            });

            checkboxesSize.forEach((checkbox) => {
                if (checkbox.checked) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'selected_size[]';
                    hiddenInput.value = checkbox.value;
                    formProduct.appendChild(hiddenInput);
                }
            });

            formProduct.submit();
        }
    })

    // Modal de insertar nueva categoría  
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('modal-Category');

    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    //Ingresar categoría y actualizar el select del formulario de ingresar producto
    $('#modalCategoryForm').on("submit", function (e) {
        e.preventDefault();
        const categoria = document.getElementById("inputCategoriaProduct").value;
        const descripcion = document.getElementById("inputDescripcion").value;

        if (categoria == "") {
            swal("RELLENE LOS CAMPOS VACIOS", "", "error");
        } else {
            $.ajax({
                url: "/formal/category/insert_second",
                method: "POST",
                data: {
                    categoria: categoria,
                    descripcion: descripcion
                },
                success: function (response) {
                    console.log("Respuesta del servidor:", response); //Respuesta que manda el /category/insert_second
                    try {
                        const category = JSON.parse(response); //Parsear la respuesta en formato JSON
                        console.log("Categoría parseada:", category);

                        // Verificar que la categoría esté definida y que contenga las claves "id" y "nombre"
                        if (category && category.id && category.nombre) {
                            swal("Exito", "Categoría creada corretamente", "success");
                            const selectCategory = document.getElementById('selectCategory');
                            $(selectCategory).append(`<option value="${category.id}">${category.nombre}</option>`);
                            // Cerrar el modal después de agregar la categoría
                            closeModal();
                        } else {
                            console.error("La respuesta del servidor no contiene los datos esperados.");
                        }
                    } catch (error) {
                        swal("Error", "Error al crear la categoría", "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    //Funcion para cerrar el modal 
    function closeModal() {
        const modal = document.getElementById("modal-Category");
        modal.style.display = "none";
        document.getElementById("modalCategoryForm").reset();
    }

    $('#CancelarButton').on('click', function (e) {
        closeModal();
    })

    //Mostrar el archivo seleccionado en el input tipo file
    document.getElementById("file-upload").addEventListener("change", function (event) {
        var fileName = event.target.files[0].name;
        document.getElementById("selected-file").innerHTML = "Archivo seleccionado: " + fileName;
    });

});
