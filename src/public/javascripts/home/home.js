let newAlbumList = document.querySelector('.new-album-list');

function play(id) {
    const formData = new FormData();
    formData.append("song_id", id);
    axios({
        method:"get",
        url:"/public/song/",
        payload:formData
    }).then((response)=>{
        var jsonObject = JSON.parse(response);
        title = document.querySelector(".title");
        artist = document.querySelector(".artist");
        title.textContent = jsonObject.title;
        artist.textContent = jsonObject.name;
        song.src = "http://localhost:8080/storage" + "/music/" + jsonObject.audio_file;
        song.load();
        location.reload();
    }).catch((err)=>{
        console.log(err);
    })
}


let listAlbum = [];
let albums = [{
    id: 1,
    title: 'La La Land',
    artist: 'Some Artists',
    image: '../../../storage/images/contoh.jpg'
}, {
    id: 2,
    title: 'Nicole',
    artist: 'NIKI',
    image: '../../../storage/images/contoh.jpg'
}, {
    id: 3,
    title: 'Viva La Vida and the Death of His Friends',
    artist: 'Coldplay',
    image: '../../../storage/images/contoh.jpg'
}, {
    id: 4,
    title: 'Fearless',
    artist: 'Taylor Swift',
    image: '../../../storage/images/contoh.jpg'
}, {
    id: 5,
    title: 'folklore',
    artist: 'Taylor Swift',
    image: '../../../storage/images/contoh.jpg'
}]



// function initHome() {
//     albums.forEach((value,key) => {
//         let newDiv = document.createElement('div');
//         newDiv.classList.add('new-album')
//         newDiv.innerHTML = `
//             <img class="new-album-cover" src="${value.image}">
//             <div class="new-album-title">${value.title}</div>
//             <div class="new-album-artist">${value.artist}</div>
//         `;
//         newAlbumList.appendChild(newDiv);
//     });
// }

// initHome();