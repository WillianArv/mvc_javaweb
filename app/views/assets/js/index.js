
let overlay = document.querySelector("#overlay");
let menuHamburger = document.querySelector(".menu-hamburger");
let menuResponsive = document.querySelector(".menu-responsive");
let btnClose = document.querySelector(".btn-close-responsive");

menuHamburger.addEventListener("click", () => {
    menuResponsive.classList.add("active");
    overlay.style.display = "block";
    document.body.style.overflow = "hidden";
})

btnClose.addEventListener("click", () => {
    menuResponsive.classList.remove("active");
    overlay.style.display = "none";
    document.body.style.overflow = "auto";
})

function closeSession() {
    swal({
        title: '¿Estas seguro de cerrar sesion?',
        text: '',
        buttons: ['No', 'Si']
    }).then(function (result) {
        if (result) {
            window.location.href = '/formal/login/logout';
        }
    })
}

