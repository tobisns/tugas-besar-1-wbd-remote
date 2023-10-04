var albums = document.querySelectorAll(".album");
var albumContainer = document.querySelector(".album-container")
var albumState = {};

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