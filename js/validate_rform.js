
let input = span_id = message = error = message1 = message2 = "";

const USERNAME_REQUIRED = "Uživatelské jméno je povinné.";
const USERNAME_LONG = "Uživatelské jméno je příliš dlouhé.";
const MAIL_REQUIRED = "Email je povinný.";
const MAIL_INVALID = "Email není ve správném formátu.";
const BIRTHYEAR_INVALID = "Zadejte, prosím, rok narození v rozmezí 1910-2017.";
const PROGRAMMED_INVALID = "Zaškrtněte, prosím, jedno z polí.";
const PWD_REQUIRED = "Heslo je povinné.";
const PWD_INVALID = "Heslo by mělo obsahovat minimálně 8 znaků a z toho alespoň 1 číslo, 1 malé písmeno, 1 velké písmeno a 1 speciální znak.";
const PWD_NOMATCH = "Hesla se neshodují.";

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

function validateMail(input, message1, message2) {
    const regexmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    error = document.getElementById("mail_error");
    if (!hasValue(input)) {
        error.textContent = message1;
        return false;
    } else if (!regexmail.test(input.value) || input.value.length > 50) {
        error.textContent = message2;
        return false;
    } else {
        error.textContent = "";
        return true;
    }  
}

function validateBirthyear(input, message) {
    error = document.getElementById("birthyear_error");
    if (hasValue(input) && input.value >= 1910 && input.value <= 2017) {
        error.textContent = "";
        return true;
    } else {
        error.textContent = message;
        return false;
    }
}

function validatePwd(input, message1, message2) {
    const regexpwd = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$$/;
    error = document.getElementById("pwd_error");
    if (!hasValue(input)) {
        error.textContent = message1;
        return false;
    } else if (!regexpwd.test(input.value) || input.value.length > 100) {
        error.textContent = message2;
        return false;
    } else {
        error.textContent = "";
        return true;
    }
}

function validateMatch(input1, input2, message) {
    error = document.getElementById("match_error");
    if (input1.value === input2.value) {
        error.textContent = "";
        return true;
    } else {
        error.textContent = message;
        return false;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const rform = document.getElementById("register");

    if (rform !== null) {

        rform.elements["username"].removeAttribute("required");
        rform.elements["mail"].removeAttribute("required");
        rform.elements["birthyear"].removeAttribute("required");
        rform.elements["fpwd"].removeAttribute("required");
        rform.elements["spwd"].removeAttribute("required");

        rform.elements["username"].removeAttribute("pattern");
        rform.elements["mail"].removeAttribute("pattern");
        rform.elements["birthyear"].removeAttribute("pattern");
        rform.elements["fpwd"].removeAttribute("pattern");
        rform.elements["spwd"].removeAttribute("pattern");

        rform.addEventListener("submit", (event) => {

            event.preventDefault();
            
            let usernameValid = validateUsername(rform.elements["username"], USERNAME_REQUIRED, USERNAME_LONG);
            let mailValid = validateMail(rform.elements["mail"], MAIL_REQUIRED, MAIL_INVALID);
            let birthyearValid = validateBirthyear(rform.elements["birthyear"], BIRTHYEAR_INVALID);
            let fpwdValid = validatePwd(rform.elements["fpwd"], PWD_REQUIRED, PWD_INVALID);
            let pwdMatch = validateMatch(rform.elements["fpwd"], rform.elements["spwd"], PWD_NOMATCH);
            
            if (usernameValid && mailValid && birthyearValid && fpwdValid && pwdMatch) {
                rform.submit();
            }
        });
    }
});
