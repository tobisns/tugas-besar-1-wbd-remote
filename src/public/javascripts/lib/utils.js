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