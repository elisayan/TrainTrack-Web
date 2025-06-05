document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const passwordFeedback = document.getElementById('password-feedback');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const confirmPasswordFeedback = document.getElementById('confirm-password-feedback');
    const registerButton = document.getElementById('registerButton');

    let passwordValidations = {
        length: false,
        number: false,
        special: false,
        match: false
    };

    function updatePasswordFeedback() {
        let messages = [];
        if (passwordInput.value.length > 0) { 
            if (passwordInput.value.length < 8) {
                messages.push("<span class='text-danger'>Mancano " + (8 - passwordInput.value.length) + " caratteri.</span>");
                passwordValidations.length = false;
            } else {
                messages.push("<span class='text-success'>Lunghezza minima di 8 caratteri raggiunta.</span>");
                passwordValidations.length = true;
            }

            if (!/\d/.test(passwordInput.value)) {
                messages.push("<span class='text-danger'>Manca un numero.</span>");
                passwordValidations.number = false;
            } else {
                messages.push("<span class='text-success'>Contiene un numero.</span>");
                passwordValidations.number = true;
            }

            if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(passwordInput.value)) {
                messages.push("<span class='text-danger'>Manca un carattere speciale.</span>");
                passwordValidations.special = false;
            } else {
                messages.push("<span class='text-success'>Contiene un carattere speciale.</span>");
                passwordValidations.special = true;
            }
        } else {
             passwordValidations.length = false;
             passwordValidations.number = false;
             passwordValidations.special = false;
        }
        passwordFeedback.innerHTML = messages.join('<br>');
        validateAll();
    }

    function updateConfirmPasswordFeedback() {
        if (confirmPasswordInput.value.length > 0) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordFeedback.innerHTML = "<span class='text-danger'>Le password non coincidono.</span>";
                passwordValidations.match = false;
            } else {
                confirmPasswordFeedback.innerHTML = "<span class='text-success'>Le password coincidono.</span>";
                passwordValidations.match = true;
            }
        } else {
            confirmPasswordFeedback.innerHTML = "";
            passwordValidations.match = false;
        }
        validateAll();
    }

    function validateAll() {
        let allValid = passwordValidations.length &&
                       passwordValidations.number &&
                       passwordValidations.special &&
                       (confirmPasswordInput.value.length === 0 || passwordValidations.match); 
        if (allValid && passwordInput.value.length > 0) {
             registerButton.disabled = false;
        } else {
             registerButton.disabled = true;
        }
    }


    if (passwordInput) {
        passwordInput.addEventListener('keyup', updatePasswordFeedback);
        updatePasswordFeedback();
    }

    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('keyup', updateConfirmPasswordFeedback);
        updateConfirmPasswordFeedback();
    }

    validateAll();
    
});