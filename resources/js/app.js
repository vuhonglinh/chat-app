import "./bootstrap";

Echo.private("status").listen("StatusUser", (e) => {
    const status = document.getElementById("status");
    status.innerHTML = e.message;
    status.classList.add("text-".e.type);
    status.classList.remove("text-danger");
});
