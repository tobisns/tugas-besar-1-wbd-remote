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
        if (method !== "get"){
            console.log(url);
            xhr.open(method,`${url}`);
            xhr.send(payload)
        }else{
            const params = new URLSearchParams(payload).toString();
            console.log(params)
            xhr.open(method,`${url}?${params}`);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
        }
    })
}