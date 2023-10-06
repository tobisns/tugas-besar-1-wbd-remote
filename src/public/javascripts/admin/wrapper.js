const dynamicContainer = document.querySelector("#dynamic-content-container");
const albumsButton = document.querySelector("#albums-button");
const songsButton = document.querySelector("#songs-button");

albumsButton &&
albumsButton.addEventListener('change', (e) => {
    if(e.target.checked){
        updateContainer('albums');
    }
    console.log('fired');
});

songsButton &&
songsButton.addEventListener('change', (e) => {
    if(e.target.checked){
        updateContainer('songs');
    }  
});

const updateContainer = (content) => {
    if(content == 'albums') {
        const formData = new FormData();
        axios({
            method: "GET",
            url: `/public/album`,
            payload: formData,
        })
        .then((response) => {
            dynamicContainer.innerHTML = response;
            albums = document.querySelectorAll(".album");
            albumContainer = document.querySelector(".album-container");
            albumState = {};

            paginationButtons = document.querySelectorAll(".pagination-button");

            nextButton = document.querySelector(".next-button");
            prevButton = document.querySelector(".prev-button");

            reallign_album();
            reload_page_button();                                                                                           

            //set new url
            const currentURL = window.location.href;
            const parts = currentURL.split('/');
            let partIndex = parts.indexOf('admin');

            var newURL;

            const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
            newURL = urlUntilAdmin+'/albums';
            history.pushState(null, null, newURL);
        })
        .catch((error) => {
            console.log(error);
        });
    } else {
        const formData = new FormData();
        formData.append("test", "mynigga");
        const params = new URLSearchParams(formData).toString();
        axios({
            method: "GET",
            url: `/public/admin/test?${params}`,
            payload: formData,
        })
        .then((response) => {
            dynamicContainer.innerHTML = response;
        })
        .catch((error) => {
            console.log(error);
        });
    }
};



