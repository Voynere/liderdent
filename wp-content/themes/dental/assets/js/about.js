(function initAboutPage() {
    function initSwipers() {
        if (typeof Swiper === 'undefined') {
            return;
        }

        if (document.querySelector('.license__slider')) {
            new Swiper('.license__slider', {
                slidesPerView: 2,
                spaceBetween: 30,
                breakpoints: {
                    769: {
                        slidesPerView: 2,
                    },
                    576: {
                        slidesPerView: 3,
                    },
                },
            });
        }

        if (document.querySelector('.aboutSlider')) {
            new Swiper('.aboutSlider', {
                slidesPerView: 1,
                spaceBetween: 12,
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSwipers);
    } else {
        initSwipers();
    }
})();
