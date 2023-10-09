song = document.getElementById("song");
progress = document.getElementById("seek");
volume = document.getElementById("volume");

playbutton = document.getElementById("play-button");
speaker = document.getElementById("speaker");

maxvalue = document.querySelector(".max-value");
progressvalue = document.querySelector(".progress-value")

song.onloadedmetadata = () => {
    progress.max = song.duration;
    progress.value = song.currentTime;
    minute = Math.floor(song.duration / 60);
    second = Math.floor(song.duration % (minute*60));
    maxvalue.textContent = minute + ":" + second;
    volume.value = song.volume;
}

if(id){
    const formData = new FormData();
    formData.append("song_id", id);
    axios({
        method:"get",
        url:"/public/song/play",
        payload:formData
    }).then((response)=>{
        var jsonObject = JSON.parse(response);
        title = document.querySelector(".title");
        artist = document.querySelector(".artist");
        title.textContent = jsonObject.title;
        artist.textContent = jsonObject.name;
        song.src = "http://localhost:8080/storage" + "/music/" + jsonObject.audio_file;
        song.load();
    }).catch((err)=>{
        console.log(err);
    })
}

function playpause() {
    if(playbutton.classList.contains("fa-play")){
        song.pause();
        playbutton.src = "./assets/images/play-button.svg"
        playbutton.classList.remove("fa-play");
        playbutton.classList.add("fa-pause");
    }else{
        song.play();
        playbutton.src = "./assets/images/pause-button.svg"
        playbutton.classList.remove("fa-pause");
        playbutton.classList.add("fa-play");
    }
 }

 if(!song.paused){
     setInterval(()=>{
         progress.value = song.currentTime;
         minute = 0
         second = 0
         if (song.currentTime !== 0) {
             minute = Math.floor(song.currentTime / 60);
             second = Math.floor(song.currentTime % 60); // Use % 60 to get seconds within the current minute.
         }
         var formattedMinute = ('0' + minute).slice(-2);

         var formattedSecond = ('0' + second).slice(-2);

         progressvalue.textContent = formattedMinute + ":" + formattedSecond;

     },500)
 }

 progress.onchange = () => {
     song.play();
     playbutton.src = "./assets/images/pause-button.svg"
     playbutton.classList.remove("fa-pause");
     playbutton.classList.add("fa-play");
     song.currentTime = progress.value;
 }

 volume.onchange = () => {
     song.volume = volume.value / 100;
     if(volume.value === 0){
         speaker.src = "./assets/images/mute.svg"
     }else{
         speaker.src = "./assets/images/speaker.svg"

     }
 }
