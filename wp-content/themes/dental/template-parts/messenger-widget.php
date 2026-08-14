<?php
$phone_display = '+7 (391) 234-09-09';
$phone_href    = 'tel:+73912340909';
$telegram_url  = 'https://t.me/liderdent_clinic';
$max_url       = 'https://max.ru/u/f9LHodD0cOLEgcwoIN8sRWKYYJaLpnt0OsHcD3OcpCaKDOIcYMDemq9smVU';
?>
<div class="messenger-widget" id="messenger-widget">
    <button type="button" class="messenger-widget__toggle" aria-expanded="false" aria-controls="messenger-widget-panel" aria-label="Связаться с клиникой">
        <span class="messenger-widget__pulse" aria-hidden="true"></span>
        <span class="messenger-widget__icon" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v7A2.5 2.5 0 0 1 17.5 16H10l-4.2 3.15A.75.75 0 0 1 4.5 18.6V16A2.5 2.5 0 0 1 4 13.5v-7Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                <circle cx="9" cy="10" r="1" fill="currentColor"/>
                <circle cx="12" cy="10" r="1" fill="currentColor"/>
                <circle cx="15" cy="10" r="1" fill="currentColor"/>
            </svg>
        </span>
        <span class="messenger-widget__badge" aria-hidden="true">1</span>
        <span class="messenger-widget__hint">Напишите нам — ответим быстро</span>
    </button>
    <div class="messenger-widget__panel" id="messenger-widget-panel">
        <p class="messenger-widget__title">Связаться с нами</p>
        <a class="messenger-widget__link" href="<?php echo esc_url( $telegram_url ); ?>" target="_blank" rel="noopener">Telegram</a>
        <a class="messenger-widget__link" href="<?php echo esc_url( $max_url ); ?>" target="_blank" rel="noopener">MAX</a>
        <a class="messenger-widget__link" href="<?php echo esc_url( $phone_href ); ?>">Позвонить <?php echo esc_html( $phone_display ); ?></a>
    </div>
</div>
<script>
(function () {
    var root = document.getElementById('messenger-widget');
    if (!root) return;
    var btn = root.querySelector('.messenger-widget__toggle');
    var hintKey = 'liderdent_messenger_hint_seen';

    function setOpen(open) {
        root.classList.toggle('is-open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) {
            root.classList.remove('is-attention');
            try { sessionStorage.setItem(hintKey, '1'); } catch (e) {}
        }
    }

    btn.addEventListener('click', function () {
        setOpen(!root.classList.contains('is-open'));
    });

    document.addEventListener('click', function (e) {
        if (!root.contains(e.target)) {
            setOpen(false);
        }
    });

    btn.addEventListener('mouseenter', function () {
        root.classList.add('is-hovered');
    });
    btn.addEventListener('mouseleave', function () {
        root.classList.remove('is-hovered');
    });

    if (!root.classList.contains('is-open')) {
        try {
            if (!sessionStorage.getItem(hintKey)) {
                window.setTimeout(function () {
                    if (!root.classList.contains('is-open')) {
                        root.classList.add('is-attention');
                    }
                }, 4000);
                window.setTimeout(function () {
                    root.classList.remove('is-attention');
                    try { sessionStorage.setItem(hintKey, '1'); } catch (e) {}
                }, 12000);
            }
        } catch (e) {}
    }
})();
</script>
