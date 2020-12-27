<?php

function amPopup( $options = null ) {
	$id      = $options['id'] ?? '';
	$content = $options['content'] ?? '';
	?>
    <div class="am-popup micromodal-slide" id="<?= $id ?>" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
				<?= $content ?>
            </div>
        </div>
    </div>
<?php }