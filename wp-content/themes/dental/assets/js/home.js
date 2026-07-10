// var swiper = new Swiper(".heroSlider", {
//     slidesPerView: 1,
//     spaceBetween: 12,
//     autoplay: {
//         delay: 10000,
//     },
//     loop: true,
// });

(function initHomePage() {
    function repositionOurCentreSlider() {
        const slider = document.querySelector('.our-centre__slider');
        const content = document.querySelector('.our-centre__content');
        const title = document.querySelector('.our-centre__title');
        const info = document.querySelector('.our-centre__info');
        const inner = document.querySelector('.our-centre__inner');

        if (!slider || !content || !title || !info || !inner) return;

        const mediaQuery = window.matchMedia('(max-width: 578px)');

        if (mediaQuery.matches) {
            title.insertAdjacentElement('afterend', slider);
        } else if (!inner.contains(slider)) {
            inner.appendChild(slider);
        }
    }

    function initHeroVideo() {
        const video = document.querySelector('.hero__video');
        const container = document.querySelector('.hero__video-container');
        if (!video || !container) return;

        const markReady = () => {
            video.classList.add('is-ready');
            container.classList.add('is-ready');
        };

        const resumeOnGesture = () => {
            video.play().then(markReady).catch(function () {});
        };

        const tryPlay = () => {
            if (!video.paused) {
                return;
            }

            const playPromise = video.play();
            if (playPromise && typeof playPromise.then === 'function') {
                playPromise.then(markReady).catch(function () {
                    container.classList.remove('is-ready');
                    video.classList.remove('is-ready');
                    document.addEventListener('touchstart', resumeOnGesture, { once: true, passive: true });
                    document.addEventListener('click', resumeOnGesture, { once: true });
                });
            } else {
                markReady();
            }
        };

        video.addEventListener('loadeddata', tryPlay, { once: true });
        video.addEventListener('canplay', tryPlay, { once: true });
        video.addEventListener('error', function () {
            const webm = video.querySelector('source[type="video/webm"]');
            if (webm) {
                webm.remove();
                video.load();
            }
        });

        if (video.readyState >= 2) {
            tryPlay();
        } else {
            video.load();
        }
    }

    function initSwipers() {
        if (typeof Swiper === 'undefined') return;

        if (document.querySelector('.serviceSlider')) {
            new Swiper('.serviceSlider', {
                slidesPerView: 1,
                spaceBetween: 12,
                navigation: {
                    nextEl: '.our-centre__slider-arrow.next',
                    prevEl: '.our-centre__slider-arrow.prev',
                },
            });
        }

        if (document.querySelector('.promotionSlider')) {
            new Swiper('.promotionSlider', {
                slidesPerView: 1,
                spaceBetween: 12,
                navigation: {
                    nextEl: '.promotion__slider-arrow.next',
                    prevEl: '.promotion__slider-arrow.prev',
                },
            });
        }
    }

    function boot() {
        repositionOurCentreSlider();
        initHeroVideo();
        initSwipers();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    window.addEventListener('resize', debounce(function () {
        repositionOurCentreSlider();
    }, 150));
})();

var swiper = null; // legacy: слайдеры инициализируются в boot()
// Перемещение блока слайдера на странице "о нас"
(function () {
    const BREAKPOINT = 680;
    document.addEventListener('DOMContentLoaded', init);

    function init() {
        const slider = document.querySelector('.page-about__slider');
        const content = document.querySelector('.page-about__content');

        if (!slider || !content) return;

        const title = content.querySelector('.page-about__title');
        const info = content.querySelector('.page-about__info');

        const originalParent = slider.parentNode;
        const originalNextSibling = slider.nextElementSibling;

        function moveForMobile() {
            if (window.innerWidth < BREAKPOINT) {

                const beforeNode = info || (title ? title.nextElementSibling : null);
                if (!content.contains(slider)) {
                    content.insertBefore(slider, beforeNode);
                }
            } else {

                if (content.contains(slider)) {
                    if (originalNextSibling && originalParent.contains(originalNextSibling)) {
                        originalParent.insertBefore(slider, originalNextSibling);
                    } else {
                        originalParent.appendChild(slider);
                    }
                }
            }
        }

        // Вызываем при загрузке
        moveForMobile();

        // Дебаунс для ресайза
        let resizeTimer = null;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(moveForMobile, 120);
        });
    }
})();

// --- Липкий хэдер ---
(function () {
    const header = document.querySelector('.header');
    const follow = document.querySelector('.header__follow');

    if (!header || !follow) return;

    let threshold = computeThreshold();
    let ticking = false;

    function computeThreshold() {
        // высота header + 20px запас
        return header.offsetHeight + 20;
    }

    function checkScroll() {
        const scrollY = window.scrollY || window.pageYOffset;
        if (scrollY > threshold) {
            if (!follow.classList.contains('active')) follow.classList.add('active');
        } else {
            if (follow.classList.contains('active')) follow.classList.remove('active');
        }
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                checkScroll();
                ticking = false;
            });
            ticking = true;
        }
    }

    function onResize() {
        // пересчитать порог при изменении размера окна
        threshold = computeThreshold();
        // и сразу проверить текущее положение
        checkScroll();
    }

    // init
    document.addEventListener('DOMContentLoaded', () => {
        // на случай, если скрипт подключён внизу: проверим сразу
        threshold = computeThreshold();
        checkScroll();
    });

    window.addEventListener('scroll', onScroll, {
        passive: true
    });
    window.addEventListener('resize', debounce(onResize, 150));

    // простая debounce для ресайза
    function debounce(fn, ms = 200) {
        let t;
        return () => {
            clearTimeout(t);
            t = setTimeout(fn, ms);
        };
    }
})();
// --- Конец хэдер ---


document.addEventListener('DOMContentLoaded', function () {

    const WP_AJAX_URL = '/wp-admin/admin-ajax.php';

    function createOverlay() {
        let ov = document.querySelector('.overlay');
        if (!ov) {
            ov = document.createElement('div');
            ov.className = 'overlay';
            document.body.appendChild(ov);
        }
        return ov;
    }

    function setNoScroll(enabled) {
        if (enabled) {
            document.documentElement.classList.add('no-scroll');
            document.body.classList.add('no-scroll');
        } else {
            document.documentElement.classList.remove('no-scroll');
            document.body.classList.remove('no-scroll');
        }
    }

    // маска телефона
    function formatPhoneMask(value) {
        let x = value.replace(/\D/g, '').slice(1);
        let formattedValue = '+7 (___) ___ __-__';
        if (x.length > 0) {
            formattedValue = '+7 (' + x.substring(0, 3);
        }
        if (x.length >= 4) {
            formattedValue += ') ' + x.substring(3, 6);
        }
        if (x.length >= 7) {
            formattedValue += ' ' + x.substring(6, 8);
        }
        if (x.length >= 9) {
            formattedValue += '-' + x.substring(8, 10);
        }
        return formattedValue;
    }

    // Инициализация
    const overlay = createOverlay();
    const popups = Array.from(document.querySelectorAll('.popup-callback'));

    if (!popups.length) return;

    const openButtons = Array.from(document.querySelectorAll('[data-popup-target], .open-popup-callback, .open-popup-credit, .open-popup-service'));

    // вспомогательная функция: открыть конкретный popup элемент
    function openPopupElement(popupEl, opener) {
        if (!popupEl) return;
        // сохранение фокуса
        popupEl._lastOpener = opener || document.activeElement;
        popupEl.classList.add('active');
        overlay.classList.add('active');
        setNoScroll(true);

        // фокус на первом текстовом input
        const firstInput = popupEl.querySelector('.popup-callback__form-item[type="text"], .popup-callback__form-item, input, textarea');
        if (firstInput && typeof firstInput.focus === 'function') {
            setTimeout(() => firstInput.focus(), 80);
        }
    }

    // закрыть
    function closePopupElement(popupEl) {
        if (!popupEl) return;
        popupEl.classList.remove('active');
        overlay.classList.remove('active');
        setNoScroll(false);

        // вернуть фокус на кнопку-открыватель если есть
        const last = popupEl._lastOpener;
        if (last && typeof last.focus === 'function') last.focus();
    }

    // Закрыть все (удобно)
    function closeAllPopups() {
        popups.forEach(p => p.classList.remove('active'));
        overlay.classList.remove('active');
        setNoScroll(false);
    }

    openButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault && e.preventDefault();

            //  data-popup-target
            let targetSelector = btn.getAttribute('data-popup-target');

            // fallback по старым классам
            if (!targetSelector) {
                if (btn.classList.contains('open-popup-credit')) targetSelector = '#popup-credit';
                else if (btn.classList.contains('open-popup-callback')) targetSelector = '#popup-callback';
                else if (btn.classList.contains('open-popup-service')) targetSelector = '#popup-service';
            }

            if (!targetSelector) return;

            const popupEl = document.querySelector(targetSelector);
            if (!popupEl) return;

            if (targetSelector === '#popup-service') {
                let serviceTitle = btn.getAttribute('data-service-title') || '';
                if (!serviceTitle) {
                    const line = btn.closest('.page-price__line');
                    const titleEl = line ? line.querySelector('.form-service-title') : null;
                    serviceTitle = titleEl ? titleEl.textContent.trim() : '';
                }
                popupEl.dataset.serviceTitle = serviceTitle || '';
                const input = popupEl.querySelector('input[name="service_title"]');
                if (input) input.value = serviceTitle;
            }
            if (targetSelector === '#popup-doctors') {
                let doctorTitle = btn.getAttribute('data-doctor-title') || '';
                if (!doctorTitle) {
                    const titleEl = document.querySelector('.single-specialist__info-title');
                    doctorTitle = titleEl ? titleEl.textContent.trim() : '';
                }
                popupEl.dataset.doctorTitle = doctorTitle || '';
                const input = popupEl.querySelector('input[name="doctor_title"]');
                if (input) input.value = doctorTitle;
            }

            openPopupElement(popupEl, btn);
        });
    });

    // обработчики на каждый popup
    popups.forEach(popup => {
        // крестик
        const closeBtn = popup.querySelector('.popup-callback__head-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault && e.preventDefault();
                closePopupElement(popup);
            });
        }

        // клик внутри попапа — не закрывать
        popup.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        // маска телефона: второй input[type="text"] внутри формы
        const textInputs = popup.querySelectorAll('input.popup-callback__form-item[type="text"]');
        const phoneInput = (textInputs && textInputs.length >= 2) ? textInputs[1] : null;

        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                phoneInput.value = formatPhoneMask(phoneInput.value);
            });
            phoneInput.addEventListener('focus', function () {
                if (phoneInput.value === '') phoneInput.value = formatPhoneMask('+7 ');
            });
            phoneInput.addEventListener('blur', function () {
                if (phoneInput.value === '+7 (___) ___ __-__') phoneInput.value = '';
            });
        }

        // отправка формы обрабатывается в assets/js/popup-form.js
    });

    overlay.addEventListener('click', function () {
        closeAllPopups();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            closeAllPopups();
        }
    });
});





// ----------- Начало моб слайдера до/после -----------
// Состояние для хранения оригинала
let originalItems = null;
let beforeAfterSwiper = null;

function handleBeforeAfterLayout() {
    const contentContainer = document.querySelector('.before-after__content');
    const sliderWrapper = document.querySelector('.beforeAfterSlider .swiper-wrapper');
    const mobileBreakpoint = 578;

    if (!contentContainer || !sliderWrapper) return;

    if (window.innerWidth < mobileBreakpoint) {
        // Мобильный режим
        if (!originalItems) {
            originalItems = document.createDocumentFragment();

            // Берём только элементы .before-after__item (без текстовых нод)
            const items = Array.from(contentContainer.querySelectorAll('.before-after__item'));

            items.forEach(item => {
                // Перемещаем оригинал в fragment
                originalItems.appendChild(item);

                // Создаём слайд на основе клона
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                slide.appendChild(item.cloneNode(true));
                sliderWrapper.appendChild(slide);
            });
        }

        // Инициализация Swiper если ещё не создан
        if (!beforeAfterSwiper && typeof Swiper !== 'undefined') {
            beforeAfterSwiper = new Swiper('.beforeAfterSlider', {
                slidesPerView: 1,
                spaceBetween: 12,
                navigation: {
                    nextEl: '.before-after__slider-arrow.next',
                    prevEl: '.before-after__slider-arrow.prev',
                }
            });
        } else {
            // обновим если уже есть (на всякий случай)
            beforeAfterSwiper.update();
        }
    } else {
        // Десктопный режим — вернуть оригиналы
        if (originalItems) {
            // очистим слайды
            while (sliderWrapper.firstChild) {
                sliderWrapper.removeChild(sliderWrapper.firstChild);
            }

            // вернуть элементы обратно в контейнер
            contentContainer.appendChild(originalItems);
            originalItems = null;
        }

        // уничтожим свипер и уберём все изменения, чтобы всё вернулось в исходное состояние
        if (beforeAfterSwiper) {
            beforeAfterSwiper.destroy(true, true);
            beforeAfterSwiper = null;
        }
    }
}

// Debounce функция
function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
}

// Инициализация
document.addEventListener('DOMContentLoaded', () => {
    handleBeforeAfterLayout();
    window.addEventListener('resize', debounce(handleBeforeAfterLayout));
});
// ----------- Конец моб слайдера до/после -----------


// our-centre slider layout: initHomePage()


// ---------- Контакты в мобильной версии ----------
document.addEventListener('DOMContentLoaded', function () {
    const mobileContacts = document.querySelector('.mobile-contacts');
    const overlay = document.querySelector('.overlay');
    const openBtn = document.querySelector('.open-mobile-contacts');

    openBtn.addEventListener('click', function () {
        mobileContacts.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function () {
        mobileContacts.classList.remove('active');
        overlay.classList.remove('active');
    });
});


// ---------- Мобильное меню - бургер ----------
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenu = document.querySelector('.mobile-menu');
    const overlay = document.querySelector('.overlay');
    const openBtns = document.querySelectorAll('.open-mobile-menu');

    if (!mobileMenu || !overlay || !openBtns.length) return;

    openBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            mobileMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });
    });

    overlay.addEventListener('click', function () {
        mobileMenu.classList.remove('active');
        overlay.classList.remove('active');
    });
});
