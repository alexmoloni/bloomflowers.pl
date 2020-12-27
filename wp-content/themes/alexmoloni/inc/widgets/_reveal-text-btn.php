<?php

use alexito\Helpers;

function revealTextBtn( $options = null ) {
	$extra_css    = $options['extra_css'] ?? '';
	$initial_text = $options['initial_text'] ?? __( 'Contact', 'alexmoloni' );
	$hidden_text  = $options['hidden_text'] ?? get_field( 'phone_number', 'options' );
	$with_icon    = $options['with_icon'] ?? false;
	$type         = $options['type'] ?? false;

	?>
    <div data-type="<?= $type ?>" data-hidden-text="<?= $hidden_text ?>" class="reveal-text-btn js-reveal-text <?= $extra_css ?>">
		<?php if ( $with_icon ): ?>
			<?php Helpers::includeSVG( '/call-icon.svg' ); ?>
		<?php endif; ?>
		<?= $initial_text ?></div>
<?php }