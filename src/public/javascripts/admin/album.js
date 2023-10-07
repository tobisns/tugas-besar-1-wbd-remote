var nextButton = document.querySelector(".next-button");
var prevButton = document.querySelector(".prev-button");
var paginationButtons = document.querySelectorAll(".pagination-button");
var albums = document.querySelectorAll(".album");
var albumContainer = document.querySelector(".album-container");
var button = document.querySelector(".add-button");
var albumState = {};

const searchBar = document.querySelector(".search-bar");

var totalPage = 0;

reallign_album();
reload_page_button();
get_current_album_page();
console.log(paginationButtons);


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

const updateAlbumPage = (page) => {
    console.log("fired");
    const params = new URLSearchParams(window.location.search);
    const formData = new FormData();
    var sort = params.get("sort");
    var search = params.get("search");
    if(!sort) {sort = 'name'}
    if(!search) {search = ''}
    axios({
        method: "GET",
        url: `/public/album/fetch?page=${page}&search=${search}&sort=${sort}`,
        payload: formData,
    })
    .then((response) => {
        let data = JSON.parse(response);
        let albumGridHTML = "";
        let paginationHTML = "";
        
        data.albums.forEach((album) => {            
            album.cover_file = album.cover_file == null ? "no_image.png" : album.cover_file;

            albumGridHTML += `
            <a href="">
                <div class="album">
                    <div class="album-cover">
                        <img src="${STORAGE_URL}/images/${album.cover_file}" alt="${album.cover_file}" class="cover-img">
                    </div>
                    <div>
                        <label class="title">${album.name}</label>
                    </div>
                    <div>
                        <label class="upload_date">${album.upload_date}</label>
                    </div>
                </div>
            </a>
            `;
        });
        if(page > 1){
            paginationHTML += `
            <button class="prev-button">
                <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.875 0.9375L0 7.57875L7.875 14.0625V8.8125H21V6.1875H7.875V0.9375Z" fill="#74B18F"/>
                </svg>
                prev
            </button>
            `;
        }
        if(data.total_page > 10){
            if(page <= 5){
                for(var i = 1; i <= 5; i++){
                    paginationHTML += `
                    <button class=pagination-button>${i}</button>
                    `;
                } 
            } else {
                paginationHTML += `
                <button class=pagination-button>1</button>
                <button class=pagination-button>2</button>
                <label>...</label>
                <button class=pagination-button>${Math.min(data.total_page - 4,page)-2}</button>
                <button class=pagination-button>${Math.min(data.total_page - 4,page)-1}</button>
                `;
            }
            if (!(page <= 5 || page >= data.total_page - 4)){
                paginationHTML += `
                <button class=pagination-button>${page}</button>
                `
            }
            if(page >= data.total_page - 4){
                for(var i = Math.min(data.total_page - 4,page); i <= data.total_page; i++){
                    paginationHTML += `
                    <button class=pagination-button>${i}</button>
                    `;
                } 
            } else {
                paginationHTML += `
                <button class=pagination-button>${Math.max(5,page)+1}</button>
                <button class=pagination-button>${Math.max(5,page)+2}</button>
                <label>...</label>
                <button class=pagination-button>${data.total_page-1}</button>
                <button class=pagination-button>${data.total_page}</button>
                `;
            }
        } else {
            for(var i = 1; i <= data.total_page; i++){
                paginationHTML += `
                <button class=pagination-button>${i}</button>
                `;
            } 
        }
        if(page < data.total_page){
            paginationHTML += `
            <button class="next-button">
                next
                <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.125 0.9375L21 7.57875L13.125 14.0625V8.8125H0V6.1875H13.125V0.9375Z" fill="#74B18F"/>
                </svg>
            </button>
            `
        }

        console.log(paginationHTML);

        const albumGrid = document.querySelector(".album-grid");
        if(albumGrid){
            albumGrid.innerHTML = albumGridHTML;
        }
        albums = document.querySelectorAll(".album");
        
        const pagination = document.querySelector(".pagination");
        if(pagination){
            pagination.innerHTML = paginationHTML;
        }
        paginationButtons = document.querySelectorAll(".pagination-button");
        
        nextButton = document.querySelector(".next-button");
        prevButton = document.querySelector(".prev-button");
        

        albumState = {};

        reallign_album();
        reload_page_button();                                                                      

        //set new url
        const currentURL = window.location.href;
        history.pushState(null, null, currentURL);

        const parts = currentURL.split('/');
        let partIndex = parts.indexOf('admin');

        var newURL;

        const urlUntilAdmin = parts.slice(0, partIndex + 1).join('/');
        newURL = urlUntilAdmin+`/albums/${page}`;
        if(params.get("sort") || params.get("search")){newURL += '?'}
        if(params.get("search")){newURL += `search=${search}`}
        if(params.get("sort") && params.get("search")){newURL += '&'}
        if(params.get("sort")){newURL += `sort=${sort}`}
        history.pushState(null, null, newURL);
    })
    .catch((error) => {
        console.log(error);
    });
}

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

    button &&
    button.addEventListener(
        "click",
        () => {
            history.pushState(null, null, window.location.href);
            location.replace("http:\/\/localhost:8080\/public\/admin\/add_album");
        }
    );
}


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

function update_album_list(){
    
}