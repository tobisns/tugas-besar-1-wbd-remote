const artistInput = document.querySelector('#artist');
const musicTitle = document.querySelector('#music-title');
const uploadDate = document.querySelector('#upload-date');
const artistId = document.getElementById('selectedArtistId')
const musicGenre = document.querySelector('#genre');
const musicDuration = document.querySelector('#duration');
const audioInput = document.querySelector("#audio-input");
const coverInput = document.querySelector("#cover-input");

const registerForm = document.querySelector(".register-form")



audioInput &&
audioInput.addEventListener(
    "change",
    (event)=>{
        const files = event.target.files;
        // Check if any file is selected
        if (files && files.length > 0) {
            // Display the selected file's name in the "file-name" element
            document.getElementById('file-name-audio').textContent = files[0].name;
        } else {
            // No file is selected, display a default message
            document.getElementById('file-name-audio').textContent = 'no file selected';
        }
    }
)

coverInput &&
coverInput.addEventListener(
    "change",
    (event)=>{
        const files = event.target.files;
        // Check if any file is selected
        if (files && files.length > 0) {
            // Display the selected file's name in the "file-name" element
            document.getElementById('file-name-cover').textContent = files[0].name;
        } else {
            // No file is selected, display a default message
            document.getElementById('file-name-cover').textContent = 'no file selected';
        }
    }
)

artistInput &&
artistInput.addEventListener(
    "keypress",
    debounce(() => {
        const name = artistInput.value;
        const formData = new FormData();
        formData.append("search", name);
        axios({
            method:"get",
            url:"/public/artist/fetch",
            payload: formData
        }).then((response)=>{
            const artists = JSON.parse(response);
            updateSelectionBox(artists);
            
        }).catch((response)=>{
            console.log("error")
        })


    }, DEBOUNCE_DELAY)
);

function updateSelectionBox(artists) {
    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';

    if (artists.length > 0) {
        const selectList = document.createElement('select');
        selectList.addEventListener('click', function() {
            const selectedOption = selectList.options[selectList.selectedIndex];
            const artistId = selectedOption.getAttribute('data-artist-id');
            document.getElementById('selectedArtistId').value = artistId;
            artistInput.value = selectedOption.value;
        });

        artists.forEach(function(artist) {
            const option = document.createElement('option');
            option.value = artist.name;
            option.text = artist.name;
            option.setAttribute('data-artist-id', artist.artist_id); // Store artist ID as data attribute
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
    const title = musicTitle.value;
    const upload_date = uploadDate.value;
    const artist_id = artistId.value;
    const genre = musicGenre.value;
    const duration = musicDuration.value;
    const audio_file = audioInput.files[0];
    const cover_file = coverInput.files[0];
    console.log(cover_file);
    console.log(audio_file);

    const formData = new FormData();

    formData.append("title", title);
    formData.append("upload_date", upload_date);
    formData.append("duration", duration);
    formData.append("artist_id", artist_id);
    formData.append("genre", genre);
    formData.append("audio_file", audio_file);
    formData.append("cover_file", cover_file);

    axios({
        method: "post",
        url: "/public/admin/add_song",
        payload: formData,
    })
    .then((response) => {
        console.log(response);
        location.replace("http:\/\/localhost:8080\/public\/admin\/songs");
    })
    .catch((reponse) => {
        console.log(reponse);
    });
});