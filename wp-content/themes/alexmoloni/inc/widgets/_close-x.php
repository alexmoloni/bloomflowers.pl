<?php
function closeX( $options = null ) {
	$in_modal  = $options['in_modal'] ?? false;
	$extra_css = $options['extra_css'] ?? '';
	?>
	<?php if ( $in_modal ): ?>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close=""></button>
	<?php else: ?>
        <button style="" class="close-x icon -close-x-black <?= $extra_css ?>"></button>
	<?php endif; ?>
<?php }