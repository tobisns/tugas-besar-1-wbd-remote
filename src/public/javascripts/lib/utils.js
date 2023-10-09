function play(id) {
    console.log(id);
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
        console.log(song.src)
        song.load();
        location.reload();
    }).catch((err)=>{
        console.log(err);
    })
}

async function axios({
    method,url,payload =null
}){
    return new Promise((resolve,reject) => {
        const xhr = new XMLHttpRequest();

        var hiddenInput = document.querySelector('input[name="csrftoken"]');

        if (hiddenInput) {
            // Get the value of the hidden input
            var tokenValue = hiddenInput.value;
            payload.append(
                "csrftoken",tokenValue
            )
        } else {
            console.log("crsf token not found");
        }


        if (method === "POST" || method === "post"){
            xhr.open(method,`${url}`);
            xhr.send(payload)
        }else if(method === "put" || method === "PUT"){
            xhr.open(method,`${url}`);
            var object = {};
            payload.forEach((value, key) => {
                if(!Reflect.has(object, key)){
                    object[key] = value;
                    return;
                }
                if(!Array.isArray(object[key])){
                    object[key] = [object[key]];
                }
                object[key].push(value);
            });
            var json = JSON.stringify(object);
            xhr.send(json);
        }else{
            const params = new URLSearchParams(payload).toString();
            console.log(params)
            xhr.open(method,`${url}?${params}`);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
        }

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                        resolve(this.responseText);
                } else {
                        reject(this.responseText);
                }
            }
        };
    })
}