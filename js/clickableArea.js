
// Make the divs clickable by redirecting to the same URL as their respective anchor tags
document.getElementById('exist').addEventListener('click', function () {
    window.location.href = 'register-exist.php';
});

document.getElementById('new').addEventListener('click', function () {
    window.location.href = 'register-new.php';
});

document.getElementById('printID').addEventListener('click', function () {
    window.location.href = '/ams/action/printID.php';
});

// Prevent the anchor tags from triggering the div click event
document.getElementById('existLink').addEventListener('click', function (e) {
    e.stopPropagation();
});

document.querySelector('.newLink').addEventListener('click', function (e) {
    e.stopPropagation();
});

document.querySelector('.printLink').addEventListener('click', function (e) {
    e.stopPropagation();
});