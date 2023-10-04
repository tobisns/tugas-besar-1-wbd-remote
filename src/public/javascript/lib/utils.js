async function axios({
    method,url,payload
}){
    return new Promise((resolve,reject) => {
        const xhr = new XMLHttpRequest();

        xhr.onload = ()=>{
            return resolve(xhr.responseText);
        }

        xhr.onerror = ()=>{
            return reject(
                new Error(xhr.statusText)
            );
        }
        var hiddenInput = document.querySelector('input[name="csrftoken"]');

        // Check if the hidden input element exists
        if (hiddenInput) {
            // Get the value of the hidden input
            var tokenValue = hiddenInput.value;
            console.log(tokenValue); // Output the value to the console
        } else {
            console.log("Hidden input not found");
        }

        payload.append(
            "csrftoken",tokenValue
        )

        if (method !== "get"){
            console.log(url);
            xhr.open(method,`${url}`);
            xhr.send(payload)
        }else{
            const params = new URLSearchParams(payload).toString();

            xhr.open(method,`${url}?${params}`);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
        }
    })
}