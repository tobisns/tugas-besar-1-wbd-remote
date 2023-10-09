const artistInput = document.querySelector('#artist');
const musicTitle = document.querySelector('#music-title');
const uploadDate = document.querySelector('#upload-date');
const artistId = document.getElementById('selectedArtistId')
const musicGenre = document.querySelector('#genre');
const musicDuration = document.querySelector('#duration');
const audioInput = document.querySelector("#audio-input");
const coverInput = document.querySelector("#cover-input");
const baseCover = document.querySelector("#base-cover");
const baseAudio = document.querySelector("#base-audio");
const musicId = document.querySelector("#music-id");




const registerForm = document.querySelector(".register-form")


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
    const base_cover = baseCover.value;
    const base_audio = baseAudio.value;
    const music_id = musicId.value;

    
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
    formData.append("base_cover", base_cover);
    formData.append("base_audio", base_audio);



    axios({
        method: "post",
        url: `/public/admin/edit_song/${music_id}`,
        payload: formData,
    })
    .then((response) => {
        console.log(response);
        location.replace("http:\/\/localhost:8080\/public\/admin\/songs");
    })
    .catch((response) => {
        console.log(response);
    });
});