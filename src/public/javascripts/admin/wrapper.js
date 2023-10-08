const dynamicContainer = document.querySelector("#dynamic-content-container");
const albumsButton = document.querySelector("#albums-button");
const songsButton = document.querySelector("#songs-button");

reload_add_button();

albumsButton &&
albumsButton.addEventListener('click', (e) => {
    if(e.target.checked){
        const formData = new FormData();
        axios({
            method: "GET",
            url: `/public/album?admin=true`,
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
            button = document.querySelector(".add-button");

            reallign_album();
            reload_page_button();  
            reload_add_button();                                                                                  

            //set new url
            const currentURL = window.location.href;
            history.pushState(null, null, currentURL);

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
    }
    console.log('fired');
});

songsButton &&
songsButton.addEventListener('click', (e) => {
    if(e.target.checked){
        const formData = new FormData();
        axios({
            method:"get",
            url:"/public/admin/song_render",
            payload: formData
        }).then((response)=>{
            dynamicContainer.innerHTML = response;
            //set new url
            const currentURL = window.location.href;
            history.pushState(null, null, currentURL);

            reload_add_button();
    
            const parts = currentURL.split('/');
            let partIndex = parts.indexOf('admin');
    
            var newURL;
    
            const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
            newURL = urlUntilAdmin+'/songs';
            history.pushState(null, null, newURL);
        }).catch((e)=>{
            console.log("error")
        })
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
            history.pushState(null, null, currentURL);

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
        const username = "aaa";
        const formData = new FormData();
        formData.append("test", username);
        axios({
            method: "GET",
            url: "/public/admin/test",
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

function reload_add_button() {
    const addSongButton = document.querySelector("#add-song");
    const addAlbumButton = document.querySelector("#add-album");

    addSongButton &&
    addSongButton.addEventListener(
        "click",
        () => {
            history.pushState(null, null, window.location.href);
            location.replace("http:\/\/localhost:8080\/public\/admin\/add_song");
        }
    );

    addAlbumButton &&
    addAlbumButton.addEventListener(
        "click",
        () => {
            history.pushState(null, null, window.location.href);
            location.replace("http:\/\/localhost:8080\/public\/admin\/add_album");
        }
    );
}

