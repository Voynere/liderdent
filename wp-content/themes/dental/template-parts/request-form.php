<?php
/**
 * Inline lead form (.request__form) — same AJAX as header popups.
 *
 * @var array $args
 */
$args     = is_array( $args ?? null ) ? $args : [];
$form_id  = (string) ( $args['form_id'] ?? 'form-request' );
$source   = (string) ( $args['source'] ?? $form_id );
$variant  = (string) ( $args['variant'] ?? 'generic' );
$service  = (string) ( $args['service'] ?? ( $variant === 'implant' ? 'Имплантация' : 'Запись на приём' ) );
$policy_id = $form_id . '-policy';
?>
<form <?php liderdent_lead_form_atts( [
	'id'      => $form_id,
	'class'   => 'request__form',
	'type'    => 'request',
	'source'  => $source,
	'service' => $service,
] ); ?>>
	<h3 class="request__title">Оставьте заявку на приём</h3>
	<div class="request__info">
		<?php if ( $variant === 'implant' ) : ?>
			<p class="request__info-text">Запишитесь на первичную консультацию имплантолога, где вы получите:</p>
			<p class="request__info-text">— Подберём импланты специально для вас.</p>
			<p class="request__info-text">— Рассчитаем 3 варианта лечения с подробной сметой.</p>
		<?php else : ?>
			<p class="request__info-text">Оставьте телефон — администратор перезвонит, уточнит задачу и запишет на удобное время.</p>
		<?php endif; ?>
	</div>
	<?php
	liderdent_lead_hidden_fields( [
		'type'    => 'request',
		'form_id' => $form_id,
		'source'  => $source,
		'service' => $service,
	] );
	?>
	<div class="request__content">
		<input class="request__phone" type="text" name="name" autocomplete="name" placeholder="Ваше имя" required>
		<input class="request__phone" type="tel" name="phone" autocomplete="tel" inputmode="tel" placeholder="+7 (___) ___-__-__" required>
		<button class="request__submit btn-gold" type="submit">
			Заказать звонок
			<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M0.353516 0.5H16.3535M16.3535 0.5V16.5M16.3535 0.5L0.353516 16.5" stroke="#404040"/>
			</svg>
		</button>
	</div>
	<div class="request__policy">
		<input class="request__policy-input" type="checkbox" name="policy" id="<?php echo esc_attr( $policy_id ); ?>" value="1" required>
		<label class="request__policy-text" for="<?php echo esc_attr( $policy_id ); ?>">
			Отправляя заявку, вы соглашаетесь с <a href="<?php echo esc_url( liderdent_privacy_policy_url() ); ?>">политикой обработки персональных данных</a>.
		</label>
	</div>
	<p class="lead-form__status" role="status" aria-live="polite" hidden></p>
</form>
