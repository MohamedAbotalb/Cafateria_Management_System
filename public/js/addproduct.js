// Define a FormValidator class
class FormValidator {
    constructor() {
      this.forms = document.querySelectorAll(".needs-validation");
      this.initFormValidation();
    }
  
    initFormValidation() {
      this.forms.forEach((form) => {
        form.addEventListener("submit", this.validateForm.bind(this));
      });
  
      document
        .querySelector('button[type="reset"]')
        .addEventListener("click", this.resetFormValidation.bind(this));
  
      document
        .getElementById("saveCategory")
        .addEventListener("click", this.saveCategory.bind(this));
  
      document
        .querySelector("#addCategoryModal .btn-secondary")
        .addEventListener("click", this.hideCategoryErrorMessage.bind(this));
  
      $("#addCategoryModal").on("hidden.bs.modal", this.clearCategoryInput.bind(this));
  
      document.getElementById("productPrice").addEventListener("input", this.validateProductPrice);
    }
  
    validateForm(event) {
      const form = event.target;
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add("was-validated");
    }
  
    resetFormValidation() {
      document.querySelectorAll(".is-invalid").forEach((element) => {
        element.classList.remove("is-invalid");
      });
      this.forms.forEach((form) => {
        form.classList.remove("was-validated");
      });
    }
  
    saveCategory() {
      const categoryNameInput = document.getElementById("newCategoryName");
      const categoryName = categoryNameInput.value.trim();
  
      if (!/^[A-Za-z][A-Za-z\s]{3,}$/.test(categoryName)) {
        categoryNameInput.classList.add("is-invalid");
      } else {
        categoryNameInput.classList.remove("is-invalid");
  
        // Send an AJAX request to add the new category
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/addCategoryController.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              if (response.success) {
                const newCategoryOption = document.createElement("option");
                newCategoryOption.value = response.categoryName;
                newCategoryOption.text = response.categoryName;
                document.getElementById("productCategory").appendChild(newCategoryOption);
                $("#addCategoryModal").modal("hide");
              } else {
                // Display error message
                const errorMessageContainer = document.getElementById("categoryError");
                errorMessageContainer.innerText = response.message;
                errorMessageContainer.style.display = "block";
              }
            } else {
              alert("Error: Unable to add category.");
            }
          }
        };
  
        xhr.send("categoryName=" + encodeURIComponent(categoryName));
      }
    }
  
    hideCategoryErrorMessage() {
      const errorMessageContainer = document.getElementById("categoryError");
      errorMessageContainer.innerText = "";
      errorMessageContainer.style.display = "none";
    }
  
    clearCategoryInput() {
      const categoryNameInput = document.getElementById("newCategoryName");
      categoryNameInput.value = "";
      categoryNameInput.classList.remove("is-invalid");
      this.hideCategoryErrorMessage();
    }
  
    validateProductPrice() {
      const productPriceInput = this;
      const productPriceValue = productPriceInput.value;
  
      if (/^0/.test(productPriceValue) || productPriceValue < 1 || productPriceValue > 100) {
        productPriceInput.setCustomValidity("Please enter a valid price between 1 and 100 without starting with 0.");
        productPriceInput.classList.add("is-invalid");
      } else {
        productPriceInput.setCustomValidity("");
        productPriceInput.classList.remove("is-invalid");
      }
    }
  }
  
  // Create an instance of FormValidator
  const formValidator = new FormValidator();
  
   // Hide error and success messages after 3 seconds
   setTimeout(() => {
    let errorAlerts = document.querySelectorAll(".alert-danger");
    let successAlerts = document.querySelectorAll(".alert-success");
  
    errorAlerts.forEach((alert) => {
      alert.style.display = "none";
    });
  
    successAlerts.forEach((alert) => {
      alert.style.display = "none";
    });
  }, 3000);
  