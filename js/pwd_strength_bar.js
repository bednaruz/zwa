
function checkpassword(input) {
    var strength = 0;
    if (/[a-z]+/.test(input)) {
        strength += 1;
    }
    if (/[A-Z]+/.test(input)) {
        strength += 1;
    }
    if (/[0-9]+/.test(input)) {
        strength += 1;
    }
    if (/[$@#&!]+/.test(input)) {
        strength += 1;
    }
    if (input.length >= 8) {
        strength += 1;
    }

    switch (strength) {
        case 0:
            document.getElementById("pwd_meter").value = 0;
            break;
        case 1:
            document.getElementById("pwd_meter").value = 20;
            break;
        case 2:
            document.getElementById("pwd_meter").value = 40;
            break;
        case 3:
            document.getElementById("pwd_meter").value = 60;
            break;
        case 4:
            document.getElementById("pwd_meter").value = 80;
            break;
        case 5:
            document.getElementById("pwd_meter").value = 100;
            break;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const password = document.getElementById("fpwd");
    
    if (password !== null) {
        password.addEventListener("keyup", () => {
            checkpassword(password.value);
        });
    }
});
