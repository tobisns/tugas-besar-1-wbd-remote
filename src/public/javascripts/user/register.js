//input field
const usernameInput = document.querySelector("#username");
const displayNameInput = document.querySelector("#display-name");
const phoneNumberInput = document.querySelector("#phone-number");
const passwordInput = document.querySelector("#password");
const confirmPasswordInput = document.querySelector("#confirm-password");
const fileInput = document.querySelector("#file-input")

//form
const registerForm = document.querySelector(".register-form");

//alert
const usernameAlert = document.querySelector("#username-alert");
const displayNameAlert = document.querySelector("#display-name-alert");
const phoneNumberAlert = document.querySelector("#phone-number-alert");
const passwordAlert = document.querySelector("#password-alert");
const confirmPasswordAlert = document.querySelector("#confirm-password-alert");
const submitAlert = document.querySelector("#register-alert");

// username,displayName, and password only have character a-zA-Z0-9
const invalidRegex = /\W$/;
const phoneNumberRegex = /\d{12}$/;

// field status
let usernameValid = false;
let displayNameValid = false;
let phoneNumberValid = false;
let passwordValid = false;
let confirmPasswordValid = false;

usernameInput &&
usernameInput.addEventListener(
    "keypress",
    debounce(() => {
        const username = usernameInput.value;
        const formData = new FormData();
        formData.append("username", username);
        axios({
            method:"get",
            url:"/public/user/username",
            payload: formData
        }).then((e)=>{
            if (invalidRegex.test(username)) {
                usernameAlert.innerText = "Invalid username format!";
                usernameAlert.className = "alert-show";
                usernameValid = false;
            } else if(e == "true"){
                usernameAlert.innerText = "Username already taken!";
                usernameAlert.className = "alert-show";
                usernameValid = false;
            } else {
                usernameAlert.innerText = "";
                usernameAlert.className = "alert-hide";
                usernameValid = true;
            }
        }).catch((e)=>{
            console.log("error")
        })


    }, DEBOUNCE_DELAY)
);

displayNameInput &&
displayNameInput.addEventListener(
    "keypress",
    debounce(() => {
        const displayName = displayNameInput.value;
        console.log((displayName));
        if (invalidRegex.test(displayName)) {
            displayNameAlert.innerText = "Invalid display name format!";
            displayNameAlert.className = "alert-show";
            displayNameValid = false;
        } else {
            displayNameAlert.innerText = "";
            displayNameAlert.className = "alert-hide";
            displayNameValid = true;
        }
    }, DEBOUNCE_DELAY)
);

phoneNumberInput &&
phoneNumberInput.addEventListener(
    "keypress",
    debounce(() => {
        const phoneNumber = phoneNumberInput.value;

        if (!phoneNumberRegex.test(phoneNumber) || phoneNumber.length !== 12 ) {
            phoneNumberAlert.innerText = "Invalid phone number format!";
            phoneNumberAlert.className = "alert-show";
            phoneNumberValid = false;
        } else {
            phoneNumberAlert.innerText = "";
            phoneNumberAlert.className = "alert-hide";
            phoneNumberValid = true;
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

confirmPasswordInput &&
confirmPasswordInput.addEventListener(
    "keypress",
    debounce(() => {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            confirmPasswordAlert.innerText = "Password doesn't match";
            confirmPasswordAlert.className = "alert-show";
            confirmPasswordValid = false;
        } else {
            confirmPasswordAlert.innerText = "";
            confirmPasswordAlert.className = "alert-hide";
            confirmPasswordValid = true;
        }
    })
);

fileInput &&
fileInput.addEventListener(
    "change",
    (event)=>{
        const files = event.target.files;
        // Check if any file is selected
        if (files && files.length > 0) {
            // Display the selected file's name in the "file-name" element
            document.getElementById('file-name').textContent = files[0].name;
        } else {
            // No file is selected, display a default message
            document.getElementById('file-name').textContent = 'no file selected';
        }
    }
)


// ...

// Function to check if all fields are valid
function isFormValid() {
    return usernameValid && displayNameValid && phoneNumberValid && passwordValid && confirmPasswordValid;
}

registerForm &&
registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Check if all form fields are valid
    if (!isFormValid()) {
        submitAlert.textContent = "Please fill in all fields correctly.";
        submitAlert.className = "alert-show";
        return; // Stop form submission
    }

    // If all fields are valid, proceed with form submission
    const username = usernameInput.value;
    const displayName = displayNameInput.value;
    const phoneNumber = phoneNumberInput.value;
    const password = passwordInput.value;
    const file = fileInput.files[0];
    const formData = new FormData();

    formData.append("username", username);
    formData.append("displayname", displayName);
    formData.append("phonenumber", phoneNumber);
    formData.append("password", password);
    formData.append("file", file);

    axios({
        method: "post",
        url: "/public/user/register",
        payload: formData,
    })
        .then((response) => {
            console.log(response)
        })
        .catch((error) => {
            console.log(error);
        });
});