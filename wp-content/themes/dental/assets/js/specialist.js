document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') {
        return;
    }

    const certificateSlider = document.querySelector('.certificate__slider');
    if (certificateSlider) {
        new Swiper('.certificate__slider', {
            slidesPerView: 2,
            spaceBetween: 12,
            breakpoints: {
                867: {
                    slidesPerView: 3,
                },
            },
            navigation: {
                nextEl: '.certificate__slider-button.next',
                prevEl: '.certificate__slider-button.prev',
            },
        });
    }

    const casesSlider = document.querySelector('.specialistCasesSlider');
    if (casesSlider) {
        new Swiper('.specialistCasesSlider', {
            slidesPerView: 1,
            spaceBetween: 16,
            navigation: {
                nextEl: '.specialist-cases__arrow.next',
                prevEl: '.specialist-cases__arrow.prev',
            },
        });
    }
});
