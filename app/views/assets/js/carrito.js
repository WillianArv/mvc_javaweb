$(document).ready(function () {
    $(".btn-anadir").click(function (e) {
        var id = $(this).data("id");
        $.ajax({
            url: "/formal/product/json_producto/" + id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.error == false) {
                    console.log(data.producto)
                    anadirProducto(data.producto);
                }
            },
            error: function (xhr, status, error) {

            }
        });
    });
});


function anadirProducto(producto) {
    const countProduct = document.querySelector("#count-product");
    $.ajax({
        url: '/formal/carrito/anadir_producto',
        type: 'POST',
        data: {
            id_producto: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            imagen: producto.imagen_principal,
            cantidad: parseInt(countProduct.textContent),
            sumar: true
        },
        dataType: 'json',
        success: function (data) {
            if (!data.error) {
                swal({
                    icon: 'success',
                    title: 'Producto añadido',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            }
        }
    });
}

function actualizarCantidad(cantidad, id) {
    $.ajax({
        url: '/formal/carrito/actualizar_cantidad',
        type: 'POST',
        data: {
            id_producto: id,
            cantidad: cantidad
        },
        dataType: 'json',
        success: function (data) {
            if (!data.error) {
                location.reload();
            } else {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: data.mensaje
                }).then(() => {
                    location.reload();
                });
            }
        }
    });
}