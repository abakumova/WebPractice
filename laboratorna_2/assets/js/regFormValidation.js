function validateAndSignUp() {
    if (validateFirstName() && validateLastName() && validateRegLogin() && validateRegPassword() && validateRegPasswordRepeat() && validateRole()) {
        signUp();
    }
}


function validateRegLogin() {

    let emailField = document.getElementById("reg-login");
    let usersEmail = emailField.value;
    let hint = document.getElementById("reg-login-hint");

    hint.innerText = "";

    function isValidEmail(usersEmail) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(usersEmail);
    }

    if (!usersEmail) {
        hint.innerText = "Enter your email.";
        return;
    } else if (!isValidEmail(usersEmail)) {
        hint.innerText = "Provide a valid email address.";
        return;
    }

    return true;
}

function validateRegPassword() {
    let passwordField = document.getElementById("reg-pwd");
    let password = passwordField.value;
    let hint = document.getElementById('reg-password-hint');

    passwordField.style.borderColor = "initial";
    hint.innerText = "";

    if (!password) {
        hint.innerText = 'Enter your password.';
        return;
    } else if (!isValidPassword(password)) {
        hint.innerText = 'At least 6 characters, 1 digit and 1 uppercase letter.';
        return;
    }

    return true;
}

function validateRegPasswordRepeat() {
    let passwordField = document.getElementById("reg-pwd");
    let password = passwordField.value;

    let passwordRepeatField = document.getElementById("reg-pwd-r");
    let passwordRepeat = passwordRepeatField.value;
    let hint = document.getElementById('reg-password-r-hint');

    passwordRepeatField.style.borderColor = "initial";
    hint.innerText = "";

    if (!passwordRepeat) {
        hint.innerText = 'Repeat your password.';
        return;
    } else if (passwordRepeat !== password) {
        hint.innerText = 'Passwords are different';
        return;
    }

    return true;
}

function validateRole() {
    let roleField = document.getElementById("role");
    let role = roleField.value;
    let hint = document.getElementById("reg-role-hint");

    hint.innerText = "";

    if (!role) {
        hint.innerText = 'Choose the role.';
        return;
    }

    return true;
}

function validateName(name) {
    return /^[a-zA-Z]+$/.test(name);
}

function validateFirstName() {
    let firstNameField = document.getElementById("first_name");
    let firstName = firstNameField.value;
    let hint = document.getElementById('reg-first-name-hint');

    firstNameField.style.borderColor = "initial";
    hint.innerText = "";

    if (!validateName(firstName)) {
        hint.innerText = 'Provide a valid first name';
        return;
    }

    return true;
}

function validateLastName() {
    let lastNameField = document.getElementById("last_name");
    let lastName = lastNameField.value;
    let hint = document.getElementById('reg-last-name-hint');

    lastNameField.style.borderColor = "initial";
    hint.innerText = "";

    if (!validateName(lastName)) {
        hint.innerText = 'Provide a valid last name';
        return;
    }

    return true;
}

function sendRequest(method, url, body = null) {
    const headers = {
        'Content-Type': 'application/json'
    };
    return fetch(url, {
        method: method,
        body: JSON.stringify(body),
        headers: headers
    }).then(response => {
        return response.json()
    })
}
//At least 6 characters, 1 digit and 1 uppercase letter.
function isValidPassword(password) {
    let re = /^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z]{6,}$/;
    return re.test(password);
}

function signUp() {
    let email = document.getElementById("reg-login").value;
    let password = document.getElementById("reg-pwd").value;
    let firstName = document.getElementById("first_name").value;
    let lastName = document.getElementById("last_name").value;
    let role = document.getElementById("role").value;
    let password_r = document.getElementById("reg-pwd-r").value;

    let xhr = new XMLHttpRequest();

    var params = 'email=' + email + '&password=' + password + '&firstName=' + firstName + '&lastName=' + lastName + '&role=' + role + '&password_r=' + password_r;

    xhr.onload = () => {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            if (response === 'invalidData') {
                let hint = document.getElementById('reg-password-hint');
                hint.innerText = 'There is an error, please, try again, please:)';
            } else if (response === 'notOriginalEmail') {
                let hint = document.getElementById('reg-login-hint');
                hint.innerText = 'Your email is already in use. Login using it.';
            } else if (response === 'success') {
                window.location.reload(true);
            }
        }
    }

    xhr.open("POST", '../laboratorna_2/controllers/signUpController.php', true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(params);
}