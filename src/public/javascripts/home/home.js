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
