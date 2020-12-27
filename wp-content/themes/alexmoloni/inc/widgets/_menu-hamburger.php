<?php

function menuHamburger($options) {
	$id = $options['id'] ?? '';

	?>

	<button tabindex="0" aria-label="Menu" role="button" aria-controls="navigation" id="<?= $id ?>" class="hamburger hamburger--collapse">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
	</button>

<?php }