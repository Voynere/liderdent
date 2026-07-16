document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-ba-compare]').forEach(function (root) {
        const range = root.querySelector('.ba-compare__range');
        if (!range) {
            return;
        }

        const setPos = function (value) {
            const pos = Math.max(0, Math.min(100, Number(value)));
            root.style.setProperty('--ba-pos', pos + '%');
            range.value = String(pos);
        };

        range.addEventListener('input', function () {
            setPos(range.value);
        });

        // Keep horizontal drag on compare, don't start Swiper swipe.
        ['pointerdown', 'touchstart'].forEach(function (evt) {
            root.addEventListener(evt, function (e) {
                e.stopPropagation();
            }, { passive: true });
        });

        if (!root.dataset.baIntroDone && window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
            root.dataset.baIntroDone = '1';
            let frame = 0;
            const from = 72;
            const to = 52;
            const steps = 24;
            setPos(from);
            const tick = function () {
                frame += 1;
                const t = frame / steps;
                const eased = 1 - Math.pow(1 - t, 3);
                setPos(from + (to - from) * eased);
                if (frame < steps) {
                    requestAnimationFrame(tick);
                }
            };
            requestAnimationFrame(function () {
                setTimeout(function () {
                    requestAnimationFrame(tick);
                }, 350);
            });
        }
    });

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
