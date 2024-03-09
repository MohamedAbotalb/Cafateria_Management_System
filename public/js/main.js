window.onload = function () {
  const products = document.querySelectorAll('.product');
  const parent = document.querySelector('.list');
  let invoiceDiv = document.querySelector('.invoice-price');
  let invoice = 0;
  products.forEach((product) => {
    product.addEventListener('click', function () {
      const name = product.querySelector('.card-text');
      const priceDiv = product.querySelector('.productPrice');
      const price = parseInt(priceDiv.textContent);
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
        invoice += parseInt(priceDiv.textContent);
        const quantity = div.querySelector('.quantity');
        const priceProduct = div.querySelector('.price-product');
        let totalPrice = parseInt(priceProduct.textContent);
        let newPrice = totalPrice;
        let quantityValue = parseInt(quantity.textContent);

        div.querySelector('.increment').addEventListener('click', function () {
          quantityValue++;
          quantity.textContent = quantityValue;
          newPrice += totalPrice;
          priceProduct.textContent = newPrice;
          invoice += price;
          invoiceDiv.textContent = invoice;
        });

        div.querySelector('.decrement').addEventListener('click', function () {
          if (quantityValue > 1) {
            quantityValue--;
            quantity.textContent = quantityValue;
            newPrice -= totalPrice;
            priceProduct.textContent = newPrice;
            invoice -= price;
            invoiceDiv.textContent = invoice;
          }
        });

        div.querySelector('.close').addEventListener('click', function () {
          decrementPrice = parseInt(
            div.querySelector('.price-product').textContent
          );
          invoice -= decrementPrice;
          invoiceDiv.textContent = invoice;
          div.remove();
        });
        invoiceDiv.textContent = invoice;
      }
    });
  });

  function isProductInList(productName) {
    const existingProducts = parent.querySelectorAll('.order-item .col-3');
    for (let existingProduct of existingProducts) {
      if (existingProduct.textContent === productName) {
        return true;
      }
    }
    return false;
  }

  document.addEventListener('DOMContentLoaded', function () {
    document
      .getElementById('saveCategory')
      .addEventListener('click', function () {
        const categoryName = document.getElementById('newCategoryName').value;
        const selectElement = document.getElementById('productCategory');
        const newOption = document.createElement('option');
        newOption.textContent = categoryName;
        newOption.value = categoryName.toLowerCase();
        selectElement.appendChild(newOption);
        const modal = new bootstrap.Modal(
          document.getElementById('addCategoryModal')
        );
        modal.hide();
        document.getElementById('newCategoryName').value = '';
      });
  });

  (function () {
    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener(
        'submit',
        function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        },
        false
      );
    });
  })();

  const startDate = document.getElementById('dateFrom');
  const endDate = document.getElementById('dateTo');
  const divStartDate = document.getElementById('errorDateFrom');
  const divEndDate = document.getElementById('errorDateTo');
  var messageTag = document.createElement('div');

  startDate.onchange = function (e) {
    if (startDate.value || startDate.value < endDate.value) {
      messageTag.remove();
    }
    if (endDate.value == '') {
      messageTag.textContent = 'Please enter End Date';
      messageTag.style.cssText = 'color:red';
      divEndDate.appendChild(messageTag);
    }
  };

  endDate.onchange = function (e) {
    if (endDate.value) {
      messageTag.remove();
    }
    if (startDate.value == '') {
      messageTag.textContent = 'Please enter Start Date';
      messageTag.style.cssText = 'color:red';
      divStartDate.appendChild(messageTag);
    }
    if (startDate.value >= endDate.value) {
      messageTag.textContent = 'Start Date Must Be Smaller Than End Date';
      messageTag.style.cssText = 'color:red';
      divEndDate.appendChild(messageTag);
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach(function (form) {
      form.addEventListener(
        'submit',
        function (event) {
          const roomNum = document.getElementById('roomNum');
          const ext = document.getElementById('ext');

          if (
            !form.checkValidity() ||
            roomNum.value.startsWith('0') ||
            ext.value.startsWith('0')
          ) {
            event.preventDefault();
            event.stopPropagation();

            if (roomNum.value.startsWith('0')) {
              roomNum.classList.add('is-invalid');
            } else {
              roomNum.classList.remove('is-invalid');
            }

            if (ext.value.startsWith('0')) {
              ext.classList.add('is-invalid');
            } else {
              ext.classList.remove('is-invalid');
            }
          } else {
            roomNum.classList.remove('is-invalid');
            ext.classList.remove('is-invalid');
          }

          form.classList.add('was-validated');
        },
        false
      );

      const resetBtn = form.querySelector('[type="reset"]');
      if (resetBtn) {
        resetBtn.addEventListener('click', function () {
          form.classList.remove('was-validated');
          const invalidFeedbacks = form.querySelectorAll('.invalid-feedback');
          invalidFeedbacks.forEach(function (feedback) {
            feedback.style.display = 'none';
          });

          // Reset input fields
          const inputs = form.querySelectorAll('.form-control');
          inputs.forEach(function (input) {
            input.classList.remove('is-invalid');
            input.value = ''; // Clear input values
          });
        });
      }
    });

    // Password confirmation validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const confirmPasswordFeedback = document.querySelector(
      '#confirmPassword ~ .invalid-feedback'
    );

    confirmPassword.addEventListener('input', function () {
      if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity('Passwords do not match');
        confirmPasswordFeedback.style.display = 'block';
      } else {
        confirmPassword.setCustomValidity('');
        confirmPasswordFeedback.style.display = 'none';
      }
    });

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById(
      'toggleConfirmPassword'
    );

    togglePassword.addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });

    toggleConfirmPassword.addEventListener('click', function () {
      const confirmPasswordInput = document.getElementById('confirmPassword');
      const icon = this.querySelector('i');

      if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        confirmPasswordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });
  });
};
