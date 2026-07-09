<?php
$phone_display = '+7 (391) 234-09-09';
$phone_href    = 'tel:+73912340909';
$telegram_url  = 'https://t.me/liderdent_clinic';
$max_url       = 'https://max.ru/u/f9LHodD0cOLEgcwoIN8sRWKYYJaLpnt0OsHcD3OcpCaKDOIcYMDemq9smVU';
?>
<div class="messenger-widget" id="messenger-widget">
    <button type="button" class="messenger-widget__toggle" aria-expanded="false" aria-controls="messenger-widget-panel" aria-label="Связаться с клиникой">💬</button>
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
    btn.addEventListener('click', function () {
        var open = root.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
        if (!root.contains(e.target)) {
            root.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>
