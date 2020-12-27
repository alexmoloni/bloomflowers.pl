<?php

function amNewsletterSignupSidebar( $options = null ) {
	$heading    = get_field( 'newsletter_sidebar_heading', 'options' ) ?? false;
	$subheading = get_field( 'newsletter_sidebar_subheading' , 'options') ?? false;
	$extra_css = $options['extra_css'] ?? '';
	?>
    <div class="am-newsletter-signup-sidebar <?= $extra_css ?>">
        <img class="bg-icon" src="/images/svg/send-mail.svg" alt="">
        <div class="content-wrap">
	        <?php if ( $heading ): ?>
                <h3 class="heading"><?= $heading ?></h3>
	        <?php endif; ?>
	        <?php if ( $subheading ): ?>
                <p class="subheading"><?= $subheading ?></p>
	        <?php endif; ?>
            <div class="form-wrap">
	            <?= do_shortcode( '[mc4wp_form id="748"]' ) ?>
            </div>
        </div>
    </div>
<?php }
