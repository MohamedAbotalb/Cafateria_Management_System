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
      if (!isProductInList(name.textContent)) {
        let div = document.createElement("div");

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
          ); // Set the actual product_id here
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

          if (removedProductIndex !== -1) {
            const removedProductAmount =
              productsData[removedProductIndex].amount;
            productsData.splice(removedProductIndex, 1);

            invoice -= removedProductAmount;
            invoiceDiv.textContent = invoice;
            invoiceInput.value = invoice;
            productDetailsInput.value = JSON.stringify(productsData);
          }

          div.remove();
        });
        invoiceDiv.textContent = invoice;
        invoiceInput.value = invoice;
        productDetailsInput.value = JSON.stringify(productsData);
      }
    });
    setTimeout(function() {
      var successAlert = document.querySelector('.successAlert');
      if (successAlert) {
        successAlert.style.display = "none";
      }
  }, 2000);
  });

  function isProductInList(productId) {
    const existingProducts = parent.querySelectorAll(".order-item .col-3");
    for (let existingProduct of existingProducts) {
      if (existingProduct.textContent === productId) {
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

  const startDate = document.getElementById("dateFrom");
  const endDate = document.getElementById("dateTo");
  const divStartDate = document.getElementById("errorDateFrom");
  const divEndDate = document.getElementById("errorDateTo");
  var messageTag = document.createElement("div");

  startDate.onchange = function (e) {
    if (startDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (endDate.value == "") {
      messageTag.textContent = "Please enter End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value >= endDate.value) {
      messageTag.textContent = "Start Date Must Be Smaller Than End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value && endDate.value && startDate.value < endDate.value) {
      window.location.assign(
        `http://localhost:8080/cafateria/Cafateria_Management_System/views/myOrdersView.php?startDate=${startDate.value}&endDate=${endDate.value}`
      );
    }
  };

  endDate.onchange = function (e) {
    if (endDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (startDate.value == "") {
      messageTag.textContent = "Please enter Start Date";
      messageTag.style.cssText = "color:red";
      divStartDate.appendChild(messageTag);
      return;
    }
    if (startDate.value >= endDate.value) {
      messageTag.textContent = "Start Date Must Be Smaller Than End Date";
      messageTag.style.cssText = "color:red";
      divEndDate.appendChild(messageTag);
      return;
    }
    if (startDate.value && endDate.value && startDate.value < endDate.value) {
      window.location.assign(
        `http://localhost:8080/cafateria/Cafateria_Management_System/views/myOrdersView.php?startDate=${startDate.value}&endDate=${endDate.value}`
      );
    }
  };
};
