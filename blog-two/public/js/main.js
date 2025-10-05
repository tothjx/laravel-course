document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.uk-alert');

    if (alert) {
        setTimeout(function () {
            UIkit.alert(alert).close();
        }, 4000);
    }
});
