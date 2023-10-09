const songInput = document.querySelector('#song-title');
const submitButton = document.querySelector('#submit');

const songId = document.getElementById('selectedSongId')

const registerForm = document.querySelector(".register-form")


songInput &&
songInput.addEventListener(
    "keypress",
    debounce(() => {
        console.log("fired");
        const search = songInput.value;
        const formData = new FormData();
        formData.append("search", search);
        axios({
            method:"get",
            url:"/public/song/fetch",
            payload: formData
        }).then((response)=>{
            const result = JSON.parse(response);
            updateSelectionBox(result);
            
        }).catch((response)=>{
            console.log(response)
        })


    }, DEBOUNCE_DELAY)
);

function updateSelectionBox(songs) {
    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';

    if (songs.length > 0) {
        const selectList = document.createElement('select');
        selectList.addEventListener('click', function() {
            const selectedOption = selectList.options[selectList.selectedIndex];
            const songId = selectedOption.getAttribute('data-song-id');
            document.getElementById('selectedSongId').value = songId;
            songInput.value = selectedOption.value;
        });

        songs.forEach(function(song) {
            const option = document.createElement('option');
            option.value = song.title;
            option.text = song.title;
            option.setAttribute('data-song-id', song.music_id); // Store artist ID as data attribute
            selectList.appendChild(option);
        });

        searchResults.appendChild(selectList);
    } else {
        searchResults.innerHTML = 'No matching artists found.';
    }
}

registerForm &&
registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    // If all fields are valid, proceed with form submission
    const music_id = songId.value;
    const album_id = submitButton.getAttribute('album_id');
    const formData = new FormData();
    console.log(album_id);

    formData.append("music_id", music_id);

    axios({
        method: "post",
        url: `/public/admin/add_to_album/${album_id}`,
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