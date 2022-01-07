
let input = span_id = message = error = message1 = message2 = "";

const USERNAME_REQUIRED = "Uživatelské jméno je povinné.";
const USERNAME_LONG = "Uživatelské je špatné.";
const PWD_REQUIRED = "Heslo je povinné.";
const PWD_INVALID = "Heslo je špatné.";

function hasValue(input) {
	return ((input.value.trim() === "") ? false : true);
}

function validateUsername(input, message1, message2) {
    error = document.getElementById("username_error");
    if (!hasValue(input)) {
        error.textContent = message1;
        return false;
    } else if (input.value.length > 30) {
        error.textContent = message2;
        return false;
    } else {
        error.textContent = "";
        return true;
    }
}

function validatePwd(input, message1, message2) {
    const regexpwd = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}$$/;
    error = document.getElementById("pwd_error");
    if (!hasValue(input)) {
        error.textContent = message1;
        return false;
    } else if (!regexpwd.test(input.value)) {
        error.textContent = message2;
        return false;
    } else {
        error.textContent = "";
        return true;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const sform = document.getElementById("signin");
    
    if (sform !== null) {

        sform.elements["username"].removeAttribute("required");
        sform.elements["pwd"].removeAttribute("required");

        sform.elements["username"].removeAttribute("pattern");
        sform.elements["pwd"].removeAttribute("pattern");

        sform.addEventListener("submit", (event) => {

            event.preventDefault();

            let usernameValid = validateUsername(sform.elements["username"], USERNAME_REQUIRED, USERNAME_LONG);
            let fpwdValid = validatePwd(sform.elements["pwd"], PWD_REQUIRED, PWD_INVALID);

            if (usernameValid && fpwdValid) {
                sform.submit();
            }
        });
    }
});
