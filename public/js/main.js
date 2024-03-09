window.onload = function () {
    const products = document.querySelectorAll(".product");
    const parent = document.querySelector(".list");
    let invoiceDiv =document.querySelector(".invoice-price");
    let invoice=0;
    products.forEach(product => {
        product.addEventListener("click", function () {
            const name= product.querySelector('.card-text');
            const priceDiv= product.querySelector('.productPrice');
            const price=parseInt(priceDiv.textContent);
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
                        <div class="col-3 price-product">${priceDiv.textContent}</div>
                        <div class="col-2 close"> &times;</div>
                    </div>`;

                parent.appendChild(div);
                invoice+=parseInt(priceDiv.textContent);
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
                    invoice+=price;
                    invoiceDiv.textContent=invoice;

                });

                div.querySelector('.decrement').addEventListener('click', function () {
                    if (quantityValue > 1) {
                        quantityValue--;
                        quantity.textContent = quantityValue;
                        newPrice -= totalPrice;
                        priceProduct.textContent = newPrice;
                        invoice-=price;
                        invoiceDiv.textContent=invoice;
                    }
                });

                div.querySelector('.close').addEventListener('click', function () {
                    decrementPrice=parseInt(div.querySelector(".price-product").textContent);
                    invoice-=decrementPrice;
                    invoiceDiv.textContent=invoice;
                    div.remove();

                });
                invoiceDiv.textContent=invoice;

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
    
      document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('saveCategory').addEventListener('click', function() {

        const categoryName = document.getElementById('newCategoryName').value;
        const selectElement = document.getElementById('productCategory');
        const newOption = document.createElement('option');
        newOption.textContent = categoryName;
        newOption.value = categoryName.toLowerCase(); 
        selectElement.appendChild(newOption);
        const modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
        modal.hide();
        document.getElementById('newCategoryName').value = '';

      });
    });

    (function () {
    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        }, false);
      });
  })();
};
