/* Acordeon */
const acordeonButtons = document.querySelectorAll('.acordeon-button');

acordeonButtons.forEach(button => {
    button.addEventListener("click", function () {
        const icon = this.querySelector("i");
        if (icon.classList.contains('fa-plus')) {
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        } else {
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        }
        this.classList.toggle('active');
        const content = this.nextElementSibling;
        console.log(content);
        if (content.style.height) {
            content.style.height = null;
            content.style.padding = "0px";

        } else {
            const padding = 20;
            content.style.height = content.scrollHeight + padding * 2 + "px";
            content.style.padding = `${padding}px`;
        }
    })
})

/* Card payment  */

const valueColor = document.querySelector('#value-color');
const colorButtons = document.querySelectorAll('.container-color');

colorButtons.forEach(button => {
    button.addEventListener("click", e => {
        colorButtons.forEach(btn => btn.classList.remove('selected'));
        e.currentTarget.classList.add('selected');
        const color = e.target.dataset.color; //data-color="negro"
        valueColor.innerText = color;
    })
})

const valueSize = document.querySelector('#value-size');
const sizeButtons = document.querySelectorAll('.btn-size');

sizeButtons.forEach(button => {
    button.addEventListener("click", e => {
        sizeButtons.forEach(btn => btn.classList.remove('selected'));
        e.currentTarget.classList.add('selected');
        const size = e.target.textContent;
        valueSize.innerText = size;
    })
})

const btnIncrement = document.querySelector("#btn-increment");
const btnDecrement = document.querySelector("#btn-decrement");
const countProduct = document.querySelector("#count-product");

const priceProduct = document.querySelector(".price");
const quantityProduct = document.querySelector("#quantity-product");
const priceTotal = document.querySelector(".price-total");
const totalValue = document.querySelector(".value").querySelector('p');

const updateButtonState = () => {
    if (parseInt(countProduct.textContent) <= 1) {
        btnDecrement.disabled = true;
    } else {
        btnDecrement.disabled = false;
    }
}

const updateButtonStateIncrement = () => {
    if (parseInt(countProduct.textContent) >= disponibilidad) {
        btnIncrement.disabled = true;
    } else {
        btnIncrement.disabled = false;
    }
}

// Incrementar
btnIncrement.addEventListener("click", () => {
    countProduct.textContent = parseInt(countProduct.textContent) + 1;
    updateButtonState();
    updateButtonStateIncrement();
    updateValueQuantity();
})

btnDecrement.addEventListener("click", () => {
    countProduct.textContent = parseInt(countProduct.textContent) - 1;
    updateButtonState();
    updateButtonStateIncrement();
    updateValueQuantity();
})

//Al cargar la pagina actualiza el estado
updateButtonState();

/* btnAddToCart.addEventListener("click", () => {
     countProduct.textContent = 1;
     updateButtonState();
 }) */

const updateValueQuantity = () => {
    let quantity = parseInt(countProduct.textContent);
    let price = parseInt(priceProduct.textContent.replace('$', ''));
    let total = `$${quantity * price}.00`;
    quantityProduct.textContent = quantity;
    totalValue.textContent = total;
    priceTotal.textContent = total;
}







