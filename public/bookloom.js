window.onload = function () {


    let searchForm = document.getElementById('search-form');
    let searchButton = document.getElementById('search-btn');
    let overlayCLose = document.getElementById('overlay-close');

    searchButton.addEventListener('click', function (e) {searchForm.classList.add('show');});
    overlayCLose.addEventListener('click', function (e) {searchForm.classList.remove('show');});



}