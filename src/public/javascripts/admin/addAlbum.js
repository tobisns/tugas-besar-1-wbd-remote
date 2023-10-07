const registerForm = document.querySelector(".register-form")
const albumName = document.querySelector("#album-name");
const uploadDate = document.querySelector("#upload-date");
const fileInput = document.querySelector("#file-input");

registerForm &&
registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    // If all fields are valid, proceed with form submission
    const name = albumName.value;
    const upload_date = uploadDate.value;
    const file = fileInput.files[0];
    const formData = new FormData();

    formData.append("name", name);
    formData.append("upload_date", upload_date);
    formData.append("cover_file", file);

    axios({
        method: "post",
        url: "/public/admin/add_album",
        payload: formData,
    })
        .then((response) => {
            location.replace("http:\/\/localhost:8080\/public\/admin\/albums");
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
});