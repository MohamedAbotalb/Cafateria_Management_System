window.onload = function () {
    const products = document.querySelectorAll(".product");
    const parent = document.querySelector(".list");

    products.forEach(product => {
        product.addEventListener("click", function () {
            const name= product.querySelector('.card-text');
            const price= product.querySelector('.productPrice');

            if (!isProductInList(name.textContent)) {
                let div = document.createElement('div');

                div.innerHTML = `
                    <div class="row container text-center order-item border align-items-center my-2">
                        <div class="col-3 ">${name.textContent}</div>
                        <div class="col-2 border quantity">1</div>
                        <div class="col-2 my-1">
                            <div class="increment fs-5">+</div>
                            <div class="decrement fs-5">-</div>
                        </div>
                        <div class="col-3 price-product">${price.textContent}</div>
                        <div class="col-2 close"> &times;</div>
                    </div>`;

                parent.appendChild(div);

                const quantity = div.querySelector('.quantity');
                const priceProduct = div.querySelector('.price-product');
                let totalPrice = parseInt(priceProduct.textContent);
                let newPrice=totalPrice;
                let quantityValue = parseInt(quantity.textContent);

                div.querySelector('.increment').addEventListener('click', function () {
                    quantityValue++;
                    quantity.textContent = quantityValue;
                    newPrice += totalPrice;
                    priceProduct.textContent = newPrice;
                });

                div.querySelector('.decrement').addEventListener('click', function () {
                    if (quantityValue > 1) {
                        quantityValue--;
                        quantity.textContent = quantityValue;
                        newPrice -= totalPrice;
                        priceProduct.textContent = newPrice;
                    }
                });

                div.querySelector('.close').addEventListener('click', function () {
                    div.remove();
                });
            } 
        });
    });

    
    function isProductInList(productName) {
        const existingProducts = parent.querySelectorAll(".order-item .col-3");
        for (let existingProduct of existingProducts) {
            if (existingProduct.textContent === productName) {
                return true;
            }
        }
        return false;
    }
};
