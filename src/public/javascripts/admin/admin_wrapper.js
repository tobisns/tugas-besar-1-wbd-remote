const dynamicContainer = document.querySelector("#dynamic-content-container");
const albumsButton = document.querySelector("#albums-button");
const songsButton = document.querySelector("#songs-button");
var albums = document.querySelectorAll(".album");
var albumContainer = document.querySelector(".album-container");
var albumState = {};

console.log(dynamicContainer);

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
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/public/admin/get_sub_div/${content}`
        );

        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    console.log(this.responseText);
                    dynamicContainer.innerHTML = this.responseText;
                    albums = document.querySelectorAll(".album");
                    albumContainer = document.querySelector(".album-container");
                    albumState = {};

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
                if (this.status === 200) {
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