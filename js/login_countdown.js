// login_countdown.js
// Live countdown for the account lockout message on login_form.php.
// Runs only if a <span id="countdown"> element is present on the page.

(function () {
    const span = document.getElementById('countdown');
    if (!span) return; // No countdown on this page

    let seconds = parseInt(span.textContent, 10);
    if (isNaN(seconds) || seconds <= 0) return;

    const interval = setInterval(() => {
        seconds--;
        if (seconds <= 0) {
            clearInterval(interval);
            span.textContent = '0';
            window.location.reload();
            return;
        }
        span.textContent = seconds;
    }, 1000);
})();