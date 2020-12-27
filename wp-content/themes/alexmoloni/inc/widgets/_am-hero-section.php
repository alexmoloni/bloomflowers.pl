<?php

function amHeroSection( $options = null ) {
	$text      = $options['text'] ?? get_field('am_hero_section_text') ?? false;
	$image = $options['image'] ?? get_field( 'am_hero_section_image' ) ?? [];
	$image_mobile = $options['image_mobile'] ?? get_field( 'am_hero_section_image_mobile' ) ?? $image;
	?>
    <div class="am-hero-section">
        <figure>
			<?php if ( $image ): ?>
                <picture>
                    <source media="(max-width: 600px)" srcset="<?= $image_mobile['sizes']['medium_large'] ?>">
                    <source media="(max-width: 1000px)" srcset="<?= $image['sizes']['large'] ?>">
                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                </picture>
			<?php endif; ?>
        </figure>
		<?php if ( $text ): ?>
            <div class="container">
                <div class="text-wrap"><?= $text ?></div>
            </div>
		<?php endif; ?>
    </div>
<?php }