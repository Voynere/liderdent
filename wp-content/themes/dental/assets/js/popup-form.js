(function () {
    'use strict';

    window.dataLayer = window.dataLayer || [];

    function config() {
        return window.POPUP_FORM || {};
    }

    function metrikaId() {
        return Number(config().metrikaId || 0);
    }

    function reachGoal(name) {
        var id = metrikaId();
        if (!id || typeof window.ym !== 'function') {
            return;
        }
        window.ym(id, 'reachGoal', name);
    }

    function pushEcommerce(payload) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({ ecommerce: payload });
    }

    function productFromForm(form) {
        var service = (form.getAttribute('data-service') || '').trim();
        var type = (form.getAttribute('data-form-type') || 'callback').trim();
        var source = (form.getAttribute('data-form-source') || form.id || 'lead').trim();
        var priceRaw = (form.getAttribute('data-price') || '').replace(/\D+/g, '');
        var price = priceRaw ? Number(priceRaw) : 0;
        var name = service || 'Запись на приём';
        var hiddenService = form.querySelector('[name="service_title"]');
        if (hiddenService && hiddenService.value.trim()) {
            name = hiddenService.value.trim();
            service = name;
        }
        var hiddenDoctor = form.querySelector('[name="doctor_title"]');
        if (hiddenDoctor && hiddenDoctor.value.trim() && !service) {
            name = 'Запись к врачу';
        }
        return {
            id: source || ('lead-' + type),
            name: name,
            category: 'Заявка / ' + type,
            price: price,
            quantity: 1
        };
    }

    function syncServiceFromPopup(form) {
        var popupEl = form.closest('.popup-callback');
        if (!popupEl) {
            return;
        }
        var serviceInput = form.querySelector('input[name="service_title"]');
        if (serviceInput && !serviceInput.value && popupEl.dataset.serviceTitle) {
            serviceInput.value = popupEl.dataset.serviceTitle;
            form.setAttribute('data-service', popupEl.dataset.serviceTitle);
        }
        var doctorInput = form.querySelector('input[name="doctor_title"]');
        if (doctorInput && !doctorInput.value && popupEl.dataset.doctorTitle) {
            doctorInput.value = popupEl.dataset.doctorTitle;
        }
    }

    function trackImpression(form) {
        if (form.dataset.ecomImpression === '1') {
            return;
        }
        form.dataset.ecomImpression = '1';
        var product = productFromForm(form);
        pushEcommerce({
            currencyCode: 'RUB',
            impressions: [product]
        });
    }

    function trackDetail(form) {
        if (form.dataset.ecomDetail === '1') {
            return;
        }
        form.dataset.ecomDetail = '1';
        pushEcommerce({
            currencyCode: 'RUB',
            detail: { products: [productFromForm(form)] }
        });
    }

    function trackAdd(form) {
        if (form.dataset.ecomAdd === '1') {
            return;
        }
        form.dataset.ecomAdd = '1';
        pushEcommerce({
            currencyCode: 'RUB',
            add: { products: [productFromForm(form)] }
        });
        reachGoal('form_start');
    }

    function trackCheckout(form) {
        if (form.dataset.ecomCheckout === '1') {
            return;
        }
        form.dataset.ecomCheckout = '1';
        pushEcommerce({
            currencyCode: 'RUB',
            checkout: {
                actionField: { step: 1 },
                products: [productFromForm(form)]
            }
        });
    }

    function trackPurchase(form, leadId) {
        if (form.dataset.ecomPurchase === '1') {
            return;
        }
        form.dataset.ecomPurchase = '1';
        var product = productFromForm(form);
        pushEcommerce({
            currencyCode: 'RUB',
            purchase: {
                actionField: {
                    id: String(leadId),
                    revenue: product.price || 0
                },
                products: [product]
            }
        });
        reachGoal('form_submit_success');
    }

    function trackOpen(form) {
        trackImpression(form);
        trackDetail(form);
        reachGoal('form_open');
    }

    function setStatus(form, text, kind) {
        var box = form.querySelector('.lead-form__status');
        if (!box) {
            box = document.createElement('p');
            box.className = 'lead-form__status';
            box.setAttribute('role', 'status');
            box.setAttribute('aria-live', 'polite');
            form.appendChild(box);
        }
        box.hidden = !text;
        box.textContent = text || '';
        box.classList.remove('lead-form__status--ok', 'lead-form__status--err');
        if (kind) {
            box.classList.add('lead-form__status--' + kind);
        }
    }

    function digitsPhone(value) {
        return String(value || '').replace(/\D+/g, '');
    }

    function validate(form) {
        var phone = form.querySelector('[name="phone"]');
        var name = form.querySelector('[name="name"]');
        var policy = form.querySelector('[name="policy"]');
        var phoneDigits = phone ? digitsPhone(phone.value) : '';

        if (name && name.hasAttribute('required') && !String(name.value || '').trim()) {
            return 'Укажите имя';
        }
        if (!phone || phoneDigits.length < 10) {
            return 'Укажите телефон';
        }
        if (policy && !policy.checked) {
            return 'Нужно согласие с политикой персональных данных';
        }
        return '';
    }

    function closePopup(popupEl) {
        if (!popupEl) {
            return;
        }
        popupEl.classList.remove('active');
        var overlay = document.querySelector('.overlay');
        if (overlay) {
            overlay.classList.remove('active');
        }
        document.documentElement.classList.remove('no-scroll');
        document.body.classList.remove('no-scroll');
    }

    function bindForm(form) {
        if (form.dataset.ajaxAttached) {
            return;
        }
        form.dataset.ajaxAttached = '1';

        form.addEventListener('focusin', function () {
            syncServiceFromPopup(form);
            trackAdd(form);
        });

        form.addEventListener('input', function () {
            trackCheckout(form);
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            syncServiceFromPopup(form);

            var error = validate(form);
            if (error) {
                setStatus(form, error, 'err');
                return;
            }

            var submitBtn = form.querySelector('[type="submit"], .popup-callback__form-submit, .request__submit');
            if (submitBtn) {
                submitBtn.disabled = true;
            }
            setStatus(form, 'Отправляем заявку…', '');

            var fd = new FormData(form);
            if (!fd.get('type')) {
                fd.set('type', form.getAttribute('data-form-type') || 'callback');
            }
            if (!fd.get('page')) {
                fd.set('page', form.getAttribute('data-page') || window.location.pathname);
            }
            fd.set('action', 'send_popup_form');
            fd.set('nonce', config().nonce || '');

            fetch(config().ajax_url, {
                method: 'POST',
                body: fd,
                credentials: 'same-origin'
            })
                .then(function (res) {
                    return res.text().then(function (text) {
                        return { status: res.status, text: text };
                    });
                })
                .then(function (obj) {
                    var json;
                    try {
                        json = JSON.parse(obj.text);
                    } catch (err) {
                        throw new Error('bad-json');
                    }
                    if (!json.success) {
                        var code = json.data || 'server error';
                        throw new Error(String(code));
                    }
                    var leadId = (json.data && json.data.lead_id) ? json.data.lead_id : ('lead-' + Date.now());
                    trackPurchase(form, leadId);
                    setStatus(form, 'Заявка отправлена. Мы перезвоним.', 'ok');
                    form.reset();
                    var popupEl = form.closest('.popup-callback');
                    if (popupEl) {
                        window.setTimeout(function () {
                            closePopup(popupEl);
                            setStatus(form, '', '');
                        }, 1600);
                    }
                })
                .catch(function () {
                    reachGoal('form_submit_error');
                    setStatus(form, 'Не удалось отправить. Позвоните +7 (391) 234 09 09 или попробуйте ещё раз.', 'err');
                })
                .finally(function () {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                    }
                });
        });
    }

    function observeInlineForms() {
        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('form.request__form[data-lead-form]').forEach(trackImpression);
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    trackImpression(entry.target);
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.35 });
        document.querySelectorAll('form.request__form[data-lead-form]').forEach(function (form) {
            io.observe(form);
        });
    }

    document.addEventListener('liderdent:popup-open', function (event) {
        var popup = event.target;
        if (!popup || !popup.querySelector) {
            return;
        }
        var form = popup.querySelector('form[data-lead-form], .popup-callback__form');
        if (form) {
            syncServiceFromPopup(form);
            trackOpen(form);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form[data-lead-form], .popup-callback__form, .request__form').forEach(bindForm);
        observeInlineForms();
    });
})();
