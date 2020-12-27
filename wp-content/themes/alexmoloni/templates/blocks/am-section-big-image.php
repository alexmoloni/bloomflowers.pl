<?php

$slides         = get_field( 'slides' ) ?? [];
$heading        = get_field( 'heading' ) ?? false;
$with_container = get_field( 'with_container' ) ?? false;
$with_padding   = get_field( 'with_padding' ) ?? false;
$with_slider    = count( $slides ) > 1;

?>
<div class="am-section-big-image <?= $with_padding ? 'section' : '' ?> <?= $with_slider ? 'with-slider' : 'no-slider' ?>">
    <div class="<?= $with_container ? 'container' : '' ?>">
		<?php if ( $heading ): ?>
            <h2 class="heading-2 heading"><?= $heading ?></h2>
		<?php endif; ?>
        <div class="slides-wrap <?= $with_slider ? 'js-am-slider' : '' ?>">
			<?php foreach ( $slides as $slide ):
				$link = $slide['link'] ?? false;
				$image = $slide['image'];
				$image_with_filter = $slide['image_with_filter'];
				$with_text_on_image = $slide['with_text_on_image'];
				$text_top = $slide['text_top'] ?? false;
				$text_bottom = $slide['text_bottom'] ?? false;
				$with_button = $slide['button'] && ! empty( $slide['button'] ) ? $slide['button'] : false;
				$button = $slide['button'] ?? [];
				$button_smooth_scroll = $slide['button_smooth_scroll'] ?? false;
				?>
                <<?= $link ? 'a' : 'div' ?> <?= $link ? 'href="' .  esc_url( $link ) . '"' : '' ?> class="slide <?= $link ? 'with-link' : 'no-link no-style' ?> <?= $with_text_on_image ? 'with-text-on-image' : '' ?> <?= $image_with_filter ? 'image-with-filter' : '' ?>">
                    <figure>
                        <picture>
                            <source media="(max-width: 600px)" srcset="<?= $image['sizes']['medium_large'] ?>">
                            <source media="(max-width: 1000px)" srcset="<?= $image['sizes']['large'] ?>">
                            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                        </picture>
                    </figure>
					<?php if ( $with_text_on_image ): ?>
                        <div class="texts-wrap">
							<?php if ( $text_top ): ?>
                                <h3 class="text-top heading-3"><?= $text_top ?></h3>
							<?php endif; ?>
							<?php if ( $text_bottom ): ?>
                                <h2 class="text-bottom heading-1"><?= $text_bottom ?></h2>
							<?php endif; ?>
                            <?php if ($with_button): ?>
                                <a <?= $button_smooth_scroll ? 'data-scroll-to="' . $button['url'] . '"' : ''  ?> class="btn btn-cta-1 <?= $button_smooth_scroll ? 'js-scroll-to' : '' ?>" href="<?= $button['url'] ?>"><?= $button['title'] ?></a>
                            <?php endif; ?>
                        </div>
					<?php endif; ?>
                </<?= $link ? 'a' : 'div' ?>>

			<?php endforeach; ?>
        </div>
    </div>
</div>
