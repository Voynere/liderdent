// Header menu
document.addEventListener('DOMContentLoaded', () => {
    const parents = document.querySelectorAll('.header__menu-parent');

    // Обработка кликов по родительским элементам для раскрытия вложенных пунктов
    parents.forEach(parent => {
        parent.addEventListener('click', (e) => {
            const subMenu = parent.querySelector('.header__list-second');
            if (subMenu) {
                subMenu.classList.toggle('active'); // Показать/скрыть вложенное меню
                parent.classList.toggle('expanded'); // Поворот стрелки
            }
        });
    });
});



// Popup
document.addEventListener('DOMContentLoaded', function () {
    const openButtons = document.querySelectorAll('.open_callback');
    const popup = document.getElementById('callbackPopup');
    const closePopup = popup.querySelector('.close-popup');

    openButtons.forEach(button => {
        button.addEventListener('click', function () {
            popup.classList.add('active');
        });
    });

    closePopup.addEventListener('click', function () {
        closePopupWithAnimation();
    });

    window.addEventListener('click', function (e) {
        if (e.target === popup) {
            closePopupWithAnimation();
        }
    });

    function closePopupWithAnimation() {
        popup.classList.add('closing');
        setTimeout(() => {
            popup.classList.remove('active', 'closing');
        }, 700); // Время анимации 
    }

    // Маска для телефона
    const phoneInput = document.getElementById('phone');

    function setMask(value) {
        let x = value.replace(/\D/g, '').slice(1); // Убираем все символы, кроме цифр
        let formattedValue = '+7 (___) ___ __-__'; // Шаблон маски
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

    phoneInput.addEventListener('input', function (e) {
        const currentValue = phoneInput.value;
        phoneInput.value = setMask(currentValue);
    });

    phoneInput.addEventListener('focus', function () {
        if (phoneInput.value === '') {
            phoneInput.value = setMask('+7 ');
        }
    });

    phoneInput.addEventListener('blur', function () {
        if (phoneInput.value === '+7 (___) ___ __-__') {
            phoneInput.value = '';
        }
    });

    // Отправка формы через AJAX
    const form = document.getElementById('callbackForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert('Заявка успешно отправлена!');
                form.reset();
                closePopupWithAnimation();
            })
            .catch(error => {
                alert('Ошибка отправки, попробуйте позже.');
            });
    });
});