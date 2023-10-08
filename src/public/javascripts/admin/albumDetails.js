const button = document.querySelector(".add-button");




button &&
button.addEventListener(
    "click",
    () => {
        history.pushState(null, null, window.location.href);
        location.replace("http:\/\/localhost:8080\/public\/admin\/add_album");
    }
);