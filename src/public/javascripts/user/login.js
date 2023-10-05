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

function isFormValid() {
    return usernameValid && passwordValid;
}

loginForm &&
loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!isFormValid()) {
        submitAlert.textContent = "Please fill in all fields correctly.";
        submitAlert.className = "alert-show";
        return; // Stop form submission
    }

    const username = usernameInput.value;
    const password = passwordInput.value;

    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    axios({
        method: "post",
        url: "/public/user/login",
        payload: formData,
    })
        .then((response) => {
            location.replace("http:\/\/localhost:8080\/public\/home");
        })
        .catch((error) => {
            console.log(error);
        });
});