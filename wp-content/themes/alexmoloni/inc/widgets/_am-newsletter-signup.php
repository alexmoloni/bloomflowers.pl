<?php
function amNewsletterSignup( $options = null ) {
	$heading = $options['heading'] ?? get_field( 'heading' ) ?? false;
	$in_container = $options['in_container'] ?? get_field( 'in_container' ) ?? true;
	?>
    <div class="am-newsletter-signup section">
        <div class="<?= $in_container ? 'container-narrow' : '' ?>">
			<?php if ( $heading ): ?>
                <h3 class="heading-4 heading"><?= $heading ?></h3>
			<?php endif; ?>
            <div class="form-wrap">
				<?= do_shortcode( '[mc4wp_form id="748"]' ) ?>
            </div>
        </div>
    </div>
<?php }

?>
