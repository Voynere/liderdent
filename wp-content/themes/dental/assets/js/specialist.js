var swiper = new Swiper(".certificate__slider", {
    slidesPerView: 2,
    spaceBetween: 12,
    breakPoints: {
        867: {
            slidesPerView: 3,
        },
    },
    navigation: {
        nextEl: '.certificate__slider-button.next',
        prevEl: '.certificate__slider-button.prev',
    }
});