(() => {
    const countdown = document.getElementById('countdown');
    const expired = document.getElementById('expired');
    const deadline = Date.now() + Number(countdown.dataset.ms);
    let done = false;

    function check() {
        if (done) return;
        const left = deadline - Date.now();
        if (left > 0) {
            countdown.textContent = Math.ceil(left / 1000) + 's left';
            return;
        }
        done = true;
        clearInterval(timer);
        document.body.replaceChildren(expired);
        expired.hidden = false;
        scrollTo(0, 0);
        expired.focus();
    }

    const timer = setInterval(check, 100);
    // Background tabs slow timers down, so check again when the page is shown.
    document.addEventListener('visibilitychange', check);
    addEventListener('pageshow', check);
    check();
})();
