
reload_song_button();

function reload_song_button(){
    const deleteButtons = document.querySelectorAll(".delete-music");
    deleteButtons.forEach(button => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            const formData = new FormData();
            const music_id = button.getAttribute('music_id');
            formData.append("music_id", music_id);
            if (window.confirm('Are you sure you want to delete this record?')) {
                axios({
                    method: "post",
                    url: "/public/admin/songs",
                    payload: formData,
                })
                .then((response) => {
                    console.log(response);
                    location.replace("http:\/\/localhost:8080\/public\/admin\/songs");
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        })
    });
}