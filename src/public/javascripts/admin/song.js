var songs = document.querySelectorAll(".search-song-container");
var songContainer = document.querySelector(".search-content");
var button = document.querySelector(".add-button");
var albumState = {};

const searchBar = document.querySelector(".search-bar");

reallign_songs();
reload_page_button();
get_current_album_page();

songs &&
window.addEventListener('resize', async () => {
    var i = 0;
    songs.forEach(album => {
        if(album.offsetLeft + album.offsetWidth > songContainer.offsetLeft + songContainer.offsetWidth){
            album.style.display = "none";
        } else {
            if(i>0 && getComputedStyle(songs[i-1]).getPropertyValue("display") != "none"){
                album.style.display = "block";
            }
        }
        i++;
    });

});

const updateSongPage = (page) => {
    console.log("fired");
    const params = new URLSearchParams(window.location.search);
    const formData = new FormData();
    var sort = params.get("sort");
    var search = params.get("search");
    var filter = params.get("filtergenre");
    if(!sort) {sort = 'name'}
    if(!search) {search = ''}
    if(!filter) {filter = ''}
    axios({
        method: "GET",
        url: `/public/song/fetch?search=${search}&sort=${sort}&filter=${filter}`,
        payload: formData,
    })
    .then((response) => {
        let data = JSON.parse(response);
        let songGridHTML = "";
        let paginationHTML = "";
        
        data.songs.forEach((song) => {            
            song.cover_file = song.cover_file == null ? "no_image.png" : song.cover_file;

            songGridHTML += `
            <a href="">
                <div class="search-song-cover">
                    <img class="cover-img" src="${STORAGE_URL}/images/${song.cover_file}">
                </div>
                <h3 class="search-song-title">${song.title}</h3>
                <h3 class="search-song-artist">${song.name}</h3>
                <h3 class="search-song-duration">${song.duration}</h3>
                <button class="edit-music" music_id="<?= $music['music_id'] ?>">edit</button>
                <button class="delete-music" music_id="<?= $music['music_id'] ?>">delete</button>
            </a>
            `;
        });

        const albumGrid = document.querySelector(".search-content");
        if(albumGrid){
            albumGrid.innerHTML = albumGridHTML;
        }
        songs = document.querySelectorAll(".search-song-container");

        albumState = {};

        reallign_songs();
        // reload_page_button();                                                                      

        //set new url
        const currentURL = window.location.href;
        history.pushState(null, null, currentURL);

        const parts = currentURL.split('/');
        let partIndex = parts.indexOf('admin');

        var newURL;

        const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
        newURL = urlUntilAdmin+`/songs`;
        if(params.get("sort") || params.get("search")){newURL += '?'}
        if(params.get("search")){newURL += `search=${search}`}
        if(params.get("sort") && params.get("search")){newURL += '&'}
        if(params.get("sort")){newURL += `sort=${sort}`}
        if(params.get("filtergenre") && params.get("search")){newURL += '&'}
        if(params.get("filtergenre")){newURL += `filter=${filter}`}
        history.pushState(null, null, newURL);
    })
    .catch((error) => {
        console.log(error);
    });
}

// function reload_page_button(){
//     paginationButtons &&
//     paginationButtons.forEach(pageButton => {
//         totalPage = parseInt(pageButton.innerHTML) > totalPage ? parseInt(pageButton.innerHTML) : totalPage;
//         pageButton.addEventListener('click', () => {
//             updateAlbumPage(parseInt(pageButton.innerHTML));
//         });
//     });

//     prevButton &&
//     prevButton.addEventListener('click', () => {
//         updateAlbumPage(get_current_album_page() - 1);
//     })

//     nextButton &&
//     nextButton.addEventListener('click', () => {
//         updateAlbumPage(get_current_album_page() + 1);
//     })
// }


function reallign_songs(){
    var i = 0;
    songs.forEach(song => {
        if(song.offsetLeft + song.offsetWidth > songContainer.offsetLeft + songContainer.offsetWidth){
            song.style.display = "none";
        } else {
            if(i>0 && getComputedStyle(songs[i-1]).getPropertyValue("display") != "none"){
                song.style.display = "block";
            }
        }
        i++;
    });
}


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