document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.popup-callback__form');

    // Защита от двойного навешивания
    forms.forEach(form => {
        if (form.dataset.ajaxAttached) return;
        form.dataset.ajaxAttached = '1';

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = form.querySelector('[type="submit"], .popup-callback__form-submit');
            if (submitBtn) submitBtn.disabled = true;

            const popupEl = form.closest('.popup-callback');

            const serviceInput = form.querySelector('input[name="service_title"]');
            if (serviceInput && !serviceInput.value && popupEl && popupEl.dataset.serviceTitle) {
                serviceInput.value = popupEl.dataset.serviceTitle;
            }

            const doctorInput = form.querySelector('input[name="doctor_title"]');
            if (doctorInput && !doctorInput.value && popupEl && popupEl.dataset.doctorTitle) {
                doctorInput.value = popupEl.dataset.doctorTitle;
            }


            const fd = new FormData(form);
            if (!fd.has('type')) {
                let type = 'popup';
                if (popupEl) {
                    if (popupEl.id === 'popup-credit') type = 'credit';
                    else if (popupEl.id === 'popup-service') type = 'service';
                    else if (popupEl.id === 'popup-doctors') type = 'doctor';
                    else if (popupEl.id === 'popup-callback') type = 'callback';
                }
                fd.append('type', type);
            }
            fd.append('action', 'send_popup_form');
            fd.append('nonce', POPUP_FORM.nonce);

            console.log('Sending AJAX to', POPUP_FORM.ajax_url, 'Form data:', Array.from(fd.entries()));

            fetch(POPUP_FORM.ajax_url, {
                method: 'POST',
                body: fd,
                credentials: 'same-origin'
            })
            .then(res => {
                // логируем статус и текст (иногда сервер возвращает HTML с ошибкой)
                console.log('Status:', res.status, res.headers.get('content-type'));
                return res.text().then(text => ({ status: res.status, text }));
            })
            .then(obj => {
                console.log('AJAX response text:', obj.text);
                // если это JSON — парсим
                try {
                    const json = JSON.parse(obj.text);
                    if (json.success) {
                        alert('Заявка отправлена!');
                        form.reset();
                        if (popupEl) popupEl.classList.remove('active');
                        const overlay = document.querySelector('.overlay');
                        if (overlay) overlay.classList.remove('active');
                        document.documentElement.classList.remove('no-scroll');
                        document.body.classList.remove('no-scroll');
                    } else {
                        alert('Ошибка: ' + (json.data || 'server error'));
                    }
                } catch (e) {
                    // не JSON — покажем текст для диагностики
                    alert('Непредвиденный ответ сервера. Смотри консоль.');
                    console.error('Non-JSON response:', obj.text);
                }
            })
            .catch(err => {
                console.error('Fetch error:', err);
                alert('Ошибка сети. Подробности в консоли.');
            })
            .finally(() => {
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    });
});
