const button = document.querySelector(".add-button");
const delbutton = document.querySelector(".delete-button")

delbutton.addEventListener("click", () => {
    const formData = new FormData();
    const album_id = delbutton.getAttribute('album_id');
    console.log(album_id);
    if (window.confirm('Are you sure you want to delete this record?')) {
        axios({
            method: "post",
            url: `/public/album/album_details/${album_id}`,
            payload: formData,
        })
        .then((response) => {
            console.log(response);
            location.replace("http:\/\/localhost:8080\/public\/admin\/albums");
        })
        .catch((error) => {
            console.log(error);
        });
    }
})

button &&
button.addEventListener(
    "click",
    () => {
        const album_id = delbutton.getAttribute('album_id');
        history.pushState(null, null, window.location.href);
        location.replace(`http://localhost:8080/public/admin/add_to_album/${album_id}`);
    }
);

