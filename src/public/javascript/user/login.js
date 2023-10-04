const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const loginForm = document.querySelector(".login-form");
const usernameAlert = document.querySelector("#username-alert");
const passwordAlert = document.querySelector("#password-alert");
const submitAlert = document.querySelector("#login-alert");

//username and password only have character a-zA-Z0-9
const invalidRegex = /\W$/;

let usernameValid = false;
let passwordValid = false;

usernameInput &&
usernameInput.addEventListener(
    "keypress",
    debounce(() => {
        const username = usernameInput.value;

        if (invalidRegex.test(username)) {
            usernameAlert.innerText = "Invalid username format!";
            usernameAlert.className = "alert-show";
            usernameValid = false;
        } else {
            usernameAlert.innerText = "";
            usernameAlert.className = "alert-hide";
            usernameValid = true;
        }
    }, DEBOUNCE_DELAY)
);

passwordInput &&
passwordInput.addEventListener(
    "keypress",
    debounce(() => {
        const password = passwordInput.value;

        if (invalidRegex.test(password)) {
            passwordAlert.innerText = "Invalid password format!";
            passwordAlert.className = "alert-show";
            passwordValid = false;
        } else {
            passwordAlert.innerText = "";
            passwordAlert.className = "alert-hide";
            passwordValid = true;
        }
    })
);

loginForm &&
loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = usernameInput.value;
    const password = passwordInput.value;

    if (!username) {
        usernameAlert.innerText = "Please fill out your username first!";
        usernameAlert.className = "alert-show";
        usernameValid = false;
    } else if (invalidRegex.test(username)) {
        usernameAlert.innerText = "Invalid username format!";
        usernameAlert.className = "alert-show";
        usernameValid = false;
    } else {
        usernameAlert.innerText = "";
        usernameAlert.className = "alert-hide";
        usernameValid = true;
    }

    if (!password) {
        passwordAlert.innerText = "Please fill out your password first!";
        passwordAlert.className = "alert-show";
        passwordValid = false;
    } else if (invalidRegex.test(password)) {
        passwordAlert.innerText = "Invalid password format!";
        passwordAlert.className = "alert-show";
        passwordValid = false;
    } else {
        passwordAlert.innerText = "";
        passwordAlert.className = "alert-hide";
        passwordValid = true;
    }

    if (!usernameValid || !passwordValid) {
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/public/user/login");

    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);
    formData.append("csrf_token", CSRF_TOKEN);

    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 201) {
                document.querySelector("#login-alert").className =
                    "alert-hide";
                const data = JSON.parse(this.responseText);
                location.replace(data.redirect_url);
            } else {
                document.querySelector("#login-alert").className =
                    "alert-show";
            }
        }
    };
});