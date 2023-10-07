const searchInput = document.querySelector("#search");
const typeInput = document.querySelector("filtertype");
const filterInput = document.querySelector("#filtergenre");
const sortInput = document.querySelector("#sort");

const searchButton = document.querySelector(".search-form");
// const result = document.querySelector(".result-list");

searchButton &&
searchButton.addEventListener(
    "submit",
    debounce(() => {
        const formData = new FormData();
        formData.append("keyword", searchInput.value);
        formData.append("type", typeInput.value);
        formData.append("genre", filterInput.value);
        formData.append("sort", sortInput.value);
        axios({
            method:"GET",
            url:`/public/album/search?type=${typeInput.value}&q=${searchInput.value}&genre=${filterInput.value}&sort=${sortInput.value}`,
            payload: formData
        }).then((response)=>{       
            let data = JSON.parse(response);
            let resultHTML = "";
            let paginationHTML = "";

            data.songs.forEach(song => {
                resultHTML += `
                <div class="result">
                    <div class="result-song-list">
                        <a href="">
                            <div class="result-song">
                                <div class="result-song-cover">
                                    <img class="result-cover-img" src="${STORAGE_URL}/images/${song.cover_file}">
                                </div>
                                <div class="result-song-title">${song.title}</div>
                                <div class="new-song-artist">${song.name}</div>
                                <div class="result-song-genre">${song.genre}</h3>
                                <div class="result-song-duration">${song.duration}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                `;
                
            });

            const resultContainer = document.querySelector(".result-container");
            if (resultContainer) {
                resultContainer.innerHTML = resultHTML;
            }
            songs = document.querySelector(".song")
            
            const currentURL = window.location.href;
            const parts = currentURL.split('/');
            let partIndex = parts.indexOf('explore');
            var newURL;
            const urlUntilExplore = parts.slice(0, partIndex+1).join('/');
            newURL = urlUntilExplore+'/albums';
            history.pushState(null, null, newURL);
        })
    })
);
