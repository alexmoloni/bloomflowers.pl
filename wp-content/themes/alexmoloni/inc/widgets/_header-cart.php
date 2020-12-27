<?php

use alexito\Pages;



function headerCart($options = null) {
	$extra_css = $options['extra_css'] ?? '';
	?>
	<a id="header-cart" href="<?= Pages::getCartPageUrl(); ?>" class="header-cart dropdown-toggle cart-contents shopping-cart-icon <?= $extra_css ?>" data-toggle="dropdown">
		<samp class="cart-count pa"><?= \alexito\Woocommerce::getCartCount() ?></samp>
	</a>


<?php }