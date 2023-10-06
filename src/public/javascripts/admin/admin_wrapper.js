const dynamicContainer = document.querySelector("#dynamic-content-container");
const albumsButton = document.querySelector("#albums-button");
const songsButton = document.querySelector("#songs-button");
var nextButton = document.querySelector(".next-button");
var prevButton = document.querySelector(".prev-button");
var paginationButtons = document.querySelectorAll(".pagination-button");
var albums = document.querySelectorAll(".album");
var albumContainer = document.querySelector(".album-container");
var albumState = {};

var totalPage = 0;

reallign_album();
reload_page_button();
get_current_album_page();
console.log(paginationButtons);

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

const updateAlbumPage = (page) => {
    console.log('fired');
    const xhr = new XMLHttpRequest();
    xhr.open(
        "GET",
        `/public/admin/get_sub_div/albums/${page}`
    );

    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (this.status === 201) {
                dynamicContainer.innerHTML = this.responseText;
                albums = document.querySelectorAll(".album");
                albumContainer = document.querySelector(".album-container");
                paginationButtons = document.querySelectorAll(".pagination-button");

                nextButton = document.querySelector(".next-button");
                prevButton = document.querySelector(".prev-button");
                

                albumState = {};

                reallign_album();
                reload_page_button();                                                                                              

                //set new url
                const currentURL = window.location.href;
                const parts = currentURL.split('/');
                let partIndex = parts.indexOf('admin');

                var newURL;

                const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
                newURL = urlUntilAdmin+`/albums/${page}`;
                history.pushState(null, null, newURL);
            } else {
                alert("An error occured, please try again!");
            }
        }
    };
}

const updateContainer = (content) => {
    if(content == 'albums') {
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/admin/get_sub_div/${content}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    dynamicContainer.innerHTML = this.responseText;
                    albums = document.querySelectorAll(".album");
                    albumContainer = document.querySelector(".album-container");
                    albumState = {};

                    reallign_album();

                    //set new url
                    const currentURL = window.location.href;
                    const parts = currentURL.split('/');
                    let partIndex = parts.indexOf('admin');

                    var newURL;

                    const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
                    newURL = urlUntilAdmin+'/albums';
                    history.pushState(null, null, newURL);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    } else {
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/admin/get_sub_div/${content}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    console.log(this.responseText);
                    dynamicContainer.innerHTML = this.responseText;
                    
                    //set new url
                    const currentURL = window.location.href;
                    const parts = currentURL.split('/');
                    let partIndex = parts.indexOf('admin');

                    var newURL;

                    const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
                    newURL = urlUntilAdmin+'/songs';
                    history.pushState(null, null, newURL);
                } else {
                    alert("An error occured, please try again!");
                }
            }
        };
    }
};

function get_current_album_page(){
    const currentURL = window.location.href;
    const parts = currentURL.split('/');
    if(currentPage = parseInt(parts[parts.indexOf('albums') + 1])){
        console.log(currentPage);
        return currentPage;
    }
    return 1;
}

function reload_page_button(){
    paginationButtons &&
    paginationButtons.forEach(pageButton => {
        totalPage = parseInt(pageButton.innerHTML) > totalPage ? parseInt(pageButton.innerHTML) : totalPage;
        pageButton.addEventListener('click', () => {
            console.log('fired');
            updateAlbumPage(parseInt(pageButton.innerHTML));
        });
    });

    prevButton &&
    prevButton.addEventListener('click', () => {
        updateAlbumPage(get_current_album_page() - 1);
    })

    nextButton &&
    nextButton.addEventListener('click', () => {
        updateAlbumPage(get_current_album_page() + 1);
    })
}

albums &&
window.addEventListener('resize', async () => {
    var i = 0;
    albums.forEach(album => {
        if(album.offsetLeft + album.offsetWidth > albumContainer.offsetLeft + albumContainer.offsetWidth){
            album.style.display = "none";
        } else {
            if(i>0 && getComputedStyle(albums[i-1]).getPropertyValue("display") != "none"){
                album.style.display = "block";
            }
        }
        i++;
    });

});

function reallign_album(){
    var i = 0;
    albums.forEach(album => {
        if(album.offsetLeft + album.offsetWidth > albumContainer.offsetLeft + albumContainer.offsetWidth){
            album.style.display = "none";
        } else {
            if(i>0 && getComputedStyle(albums[i-1]).getPropertyValue("display") != "none"){
                album.style.display = "block";
            }
        }
        i++;
    });
}