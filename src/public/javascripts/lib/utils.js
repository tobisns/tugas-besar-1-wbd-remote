async function axios({
    method,url,payload
}){
    return new Promise((resolve,reject) => {
        const xhr = new XMLHttpRequest();

        var hiddenInput = document.querySelector('input[name="csrftoken"]');

        // Check if the hidden input element exists
        if (hiddenInput) {
            // Get the value of the hidden input
            var tokenValue = hiddenInput.value;
        } else {
            console.log("crsf token not found");
        }

        payload.append(
            "csrftoken",tokenValue
        )

        if (method !== "get"){
            xhr.open(method,`${url}`);
            xhr.send(payload)
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