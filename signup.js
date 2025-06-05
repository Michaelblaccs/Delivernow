//signup.js
window.addEventListener("DOMContentLoaded", function () {
    if (window.location.pathname.includes("createaccount.php")||window.location.pathname.includes("login.php")) {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            urlParams.delete('error');
            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
            window.history.replaceState({}, document.title, newUrl);
        }
    }
});
