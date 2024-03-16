class FormValidator {
    constructor(forms) {
      this.forms = forms;
    }
  
    startsWithZero(value) {
      return /^0/.test(value);
    }
  
    validateRoomAndExtension(event) {
      let roomNumInput = document.getElementById("roomNum");
      let extInput = document.getElementById("ext");
  
      if (this.startsWithZero(roomNumInput.value)) {
        roomNumInput.setCustomValidity("Room number must not start with 0.");
      } else {
        roomNumInput.setCustomValidity("");
      }
  
      if (this.startsWithZero(extInput.value)) {
        extInput.setCustomValidity("Extension number must not start with 0.");
      } else {
        extInput.setCustomValidity("");
      }
    }
  
    validatePasswordConfirmation() {
      let passwordInput = document.getElementById("password");
      let confirmPasswordInput = document.getElementById("confirmPassword");
  
      if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordInput.setCustomValidity("Passwords do not match.");
      } else {
        confirmPasswordInput.setCustomValidity("");
      }
    }
  
    validatePasswordLength() {
      let passwordInput = document.getElementById("password");
  
      if (passwordInput.value.length < 6 || /\s/.test(passwordInput.value)) {
        passwordInput.setCustomValidity(
          "Password must be at least 6 characters long and must not contain spaces."
        );
      } else {
        passwordInput.setCustomValidity("");
      }
    }
  
    togglePasswordVisibility(inputId, buttonId) {
      let passwordInput = document.getElementById(inputId);
      let button = document.getElementById(buttonId);
      let type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
  
      if (type === "password") {
        button.innerHTML = '<i class="fa fa-eye-slash"></i>';
      } else {
        button.innerHTML = '<i class="fa fa-eye"></i>';
      }
    }
  
    setupEventListeners() {
      const togglePasswordButton = document.getElementById("togglePassword");
      togglePasswordButton.addEventListener("click", () => {
        this.togglePasswordVisibility("inputPassword", "togglePassword");
      });
  
      this.forms.forEach((form) => {
        form.addEventListener("submit", (event) => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
  
          form.classList.add("was-validated");
        });
  
        form
          .querySelector('button[type="reset"]')
          .addEventListener("click", () => {
            form.classList.remove("was-validated");
          });
  
        form.querySelector("#roomNum").addEventListener("input", (event) => {
          this.validateRoomAndExtension(event);
        });
        form.querySelector("#ext").addEventListener("input", (event) => {
          this.validateRoomAndExtension(event);
        });
  
        form
          .querySelector("#confirmPassword")
          .addEventListener("input", () => {
            this.validatePasswordConfirmation();
          });
  
        form.querySelector("#password").addEventListener("input", () => {
          this.validatePasswordLength();
        });
  
        form
          .querySelector("#togglePassword")
          .addEventListener("click", () => {
            this.togglePasswordVisibility("password", "togglePassword");
          });
  
        form
          .querySelector("#toggleConfirmPassword")
          .addEventListener("click", () => {
            this.togglePasswordVisibility(
              "confirmPassword",
              "toggleConfirmPassword"
            );
          });
      });
    }
  }
  
  document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll(".needs-validation");
    const formValidator = new FormValidator(forms);
    formValidator.setupEventListeners();
  });
  
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
  