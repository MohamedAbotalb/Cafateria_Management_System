window.onload = function () {
  const products = document.querySelectorAll(".product");
  const parent = document.querySelector(".list");
  let invoiceDiv = document.querySelector(".invoice-price");
  let invoiceInput = document.querySelector(".invoicePriceInput");
  let invoice = 0;
  let productsData = [];
  const productDetailsInput = document.querySelector(
    'input[name="productDetails"]'
  );

  products.forEach((product) => {
    product.addEventListener("click", function () {
      const name = product.querySelector(".card-text");
      const priceDiv = product.querySelector(".productPrice");
      const productId = product.querySelector(".productId").value;
      const price = parseInt(priceDiv.textContent);
      if (!isProductInList(productId)) {
        let div = document.createElement("div");
        div.classList.add("border","my-3");
        div.innerHTML = `
                    <div class="row container text-center order-item align-items-center">
                        <input class="id" type="hidden" value="${productId}">
                        <div class="col-4 text-capitalize">${name.textContent}</div>
                        <div class="col-2 border quantity fs-5">1</div>
                        <div class="col-2 my-1">
                            <div class="increment fs-4">+</div>
                            <div class="decrement fs-4">-</div>
                        </div>
                        <div class="col-3 price-product fs-5">${priceDiv.textContent}</div>
                        <div class="col-1 close fs-4"> &times;</div>
                    </div>`;

        parent.appendChild(div);
        invoice += parseInt(priceDiv.textContent);
        productsData.push({
          product_id: productId,
          quantity: 1,
          amount: price,
        });

        const quantity = div.querySelector(".quantity");
        const priceProduct = div.querySelector(".price-product");
        let totalPrice = parseInt(priceProduct.textContent);
        let newPrice = totalPrice;
        let quantityValue = parseInt(quantity.textContent);

        div.querySelector(".increment").addEventListener("click", function () {
          quantityValue++;
          quantity.textContent = quantityValue;
          newPrice += totalPrice;
          priceProduct.textContent = newPrice;
          invoice += price;
          invoiceDiv.textContent = invoice;
          invoiceInput.value = invoice;
          const existingProductIndex = productsData.findIndex(
            (product) => product.product_id === productId
          ); 
          if (existingProductIndex !== -1) {
            productsData[existingProductIndex].quantity = quantityValue;
            productsData[existingProductIndex].amount = price * quantityValue;
          }
          productDetailsInput.value = JSON.stringify(productsData);
        });

        div.querySelector(".decrement").addEventListener("click", function () {
          if (quantityValue > 1) {
            quantityValue--;
            quantity.textContent = quantityValue;
            newPrice -= totalPrice;
            priceProduct.textContent = newPrice;
            invoice -= price;
            invoiceDiv.textContent = invoice;
            invoiceInput.value = invoice;
            const existingProductIndex = productsData.findIndex(
              (product) => product.product_id === productId
            ); 
            if (existingProductIndex !== -1) {
              productsData[existingProductIndex].quantity = quantityValue;
              productsData[existingProductIndex].amount = price * quantityValue;
            }
            productDetailsInput.value = JSON.stringify(productsData);
          }
        });

        div.querySelector(".close").addEventListener("click", function () {
          const removedProductName = div.querySelector(".col-3").textContent;
          productsData = productsData.filter(
            (product) => product.product_id !== removedProductName
          );

          decrementPrice = parseInt(
            div.querySelector(".price-product").textContent
          );
          invoice -= decrementPrice;
          invoiceDiv.textContent = invoice;
          invoiceInput.value = invoice;
          const removedProductIndex = productsData.findIndex(
            (product) => product.product_id === productId
          );

          div.remove();
        });
        invoiceDiv.textContent = invoice;
        invoiceInput.value = invoice;
        productDetailsInput.value = JSON.stringify(productsData);
        
      }
      if(invoice>0 && document.querySelector('.selectedUser')){
        document.querySelector('.button').disabled=false;
      }
      else{
        let message = document.querySelector(".selectOptionUser p");

      if (!message) {
          message = document.createElement('p');
          message.classList.add('alert','alert-danger','w-50');
          message.textContent = "You must choose a user";
          document.querySelector(".selectOptionUser").appendChild(message);
      }
      }
    });
    setTimeout(function() {
      var successAlert = document.querySelector('.successAlert');
      if (successAlert) {
        successAlert.style.display = "none";
      }
  }, 2000);
  });
  document.querySelector('.userSelect').addEventListener('change',function(){
    let userID= this.value;
    let Input = document.createElement('input');
    Input.type = 'hidden';
    Input.name = 'userID';
    Input.value = userID;
    Input.classList.add('selectedUser');
    document.querySelector(".order-details").appendChild(Input);
    if (invoice > 0 && document.querySelector('.selectedUser')) {
      document.querySelector('.button').disabled = false;
      let messageElement = document.querySelector(".selectOptionUser").querySelector('p');
      if (messageElement) {
          messageElement.parentNode.removeChild(messageElement);
      }
  }
  });
  function isProductInList(productId) {
    const existingProducts = parent.querySelectorAll(".order-item .id");
    for (let existingProduct of existingProducts) {
      if (existingProduct.value === productId) {
        return true;
      }
    }
    return false;
  }

  document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("saveCategory")
      .addEventListener("click", function () {
        const categoryName = document.getElementById("newCategoryName").value;
        const selectElement = document.getElementById("productCategory");
        const newOption = document.createElement("option");
        newOption.textContent = categoryName;
        newOption.value = categoryName.toLowerCase();
        selectElement.appendChild(newOption);
        const modal = new bootstrap.Modal(
          document.getElementById("addCategoryModal")
        );
        modal.hide();
        document.getElementById("newCategoryName").value = "";
      });
  });

  (function () {
    const forms = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener(
        "submit",
        function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add("was-validated");
        },
        false
      );
    });
  })();

};
