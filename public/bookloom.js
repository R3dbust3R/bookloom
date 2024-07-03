window.onload = function () {


    // for search form
    let searchForm = document.getElementById('search-form');
    let searchButton = document.getElementById('search-btn');
    let overlayCLose = document.getElementById('overlay-close');
    
    searchButton.addEventListener('click', function (e) {searchForm.classList.add('show');});
    overlayCLose.addEventListener('click', function (e) {searchForm.classList.remove('show');});
    // for search form
    


    // for rating system
    let reviewRating = document.querySelectorAll('#review-rating i.rating-icon');
    let ratingInput = document.getElementById('rating-input');

    reviewRating.forEach(ratingValue => {
        ratingValue.addEventListener('click', function () {
            // Convert NodeList to array
            let reviewRatingArray = Array.from(reviewRating);

            // Reset all icons to 'fa-regular'
            reviewRatingArray.forEach(ratingValueSiblings => { 
                ratingValueSiblings.classList.remove('fa-solid'); 
                ratingValueSiblings.classList.add('fa-regular'); 
            });

            // Set the clicked and previous icons to 'fa-solid'
            reviewRatingArray.slice(0, parseInt(this.dataset.value)).forEach(elm => {
                elm.classList.remove('fa-regular');
                elm.classList.add('fa-solid');
            });

            // assign the value to the form input
            ratingInput.value = this.dataset.value;
        });
    });
    // for rating system 


    // scroll to top
    let scrollTopBtn = document.getElementById('scroll-to-top');
    scrollTopBtn.addEventListener('click', function () {
        window.document.body.scrollIntoView(-1);
    });

    window.onscroll = function () {
        if (this.scrollY >= 500) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    }
    // scroll to top

}
