<?php

function amLanguageSwitcher( $options = null ) {
	$extra_css = $options['extra_css'] ?? '';
	if ( function_exists( 'pll_the_languages' ) ): ?>
		<?php amLanguageSwitcherPll( [
			'extra_css' => $extra_css
		] ) ?>
	<?php elseif ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
		<?php amLanguageSwitcherWPML( [ 'with_label' => false, 'extra_css' => $extra_css ] ) ?>
	<?php endif; ?>
<?php }