<?php

function amGrid( $options = null ) {
	$items                      = $options['items'] ?? [];
	$number_items               = count( $items );
	$with_gutter                = $options['with_gutter'] ?? true;
	$gutter_small               = $options['gutter_small'] ?? false;
	$text_on_image_with_arrow   = $options['text_on_image_with_arrow'] ?? false;
	$text_on_image_top_left     = $options['text_on_image_top_left'] ?? false;
	$text_on_image_bottom_right = $options['text_on_image_bottom_right'] ?? false;
	$black_and_white            = $options['black_and_white'] ?? true;
	$image_size                 = $options['image_size'] ?? 'normal';
	$arrow_on_image             = $options['arrow_on_image'] ?? false;
	$columns_per_row             = $options['columns_per_row'] ?? 'auto';
	$border_on_hover             = $options['border_on_hover'] ?? true;

	?>
    <div class="am-grid number-items-<?= $number_items ?> <?= $gutter_small ? 'gutter-small' : '' ?> <?= $with_gutter ? 'with-gutter' : '' ?> <?= $black_and_white ? 'black-and-white' : '' ?> image-size-<?= $image_size ?> <?= $text_on_image_top_left ? 'text-on-image-top-left' : '' ?> <?= $text_on_image_bottom_right ? 'text-on-image-bottom-right' : '' ?> <?= $arrow_on_image ? 'arrow-on-image' : '' ?> columns-per-row-<?= $columns_per_row ?> <?= $border_on_hover ? 'border-on-hover' : '' ?>">
		<?php foreach ( $items as $item ):
			$img = $item['image'];
			$content_big = $item['content_big'] ?? false;
			$link = $item['link'] ?? false;
			$text_on_image = $item['text_on_image'] ?? false;
			$heading = $item['heading'] ?? false;
			$text = $item['text'] ?? false;
			$with_content = $heading || $text;
			$content_logos = $item['content_logos'] ?? false;
			?>
            <div class="grid-item <?= $content_big ? 'content-big' : '' ?> <?= $with_content ? 'with-content' : '' ?> <?= ! $link ? 'no-link' : '' ?> <?= $content_logos ? 'with-content-logos' : '' ?>">
                <a <?= $link ? 'href="' . esc_url( $link ) . '"' : '' ?> class="image-wrap">
                    <figure>
                        <img src="<?= $img['sizes']['medium_large'] ?>" alt="<?= $img['alt'] ?>">
                    </figure>
					<?php if ( $text_on_image || $arrow_on_image ): ?>
                        <div class="text-on-image">
							<?php if ( $text_on_image_with_arrow ): ?>
								<?php ctaBtn( $text_on_image, false ); ?>
							<?php elseif ( $arrow_on_image ): ?>
								<?php ctaBtn( false, false ); ?>
							<?php else: ?>
								<?= $text_on_image ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                </a>
				<?php if ( $with_content ): ?>
                    <div class="item-content-wrap">
						<?php if ( $heading ): ?>
                            <h3 class="heading-2 heading"><?= $heading ?></h3>
						<?php endif; ?>
						<?php if ( $text ): ?>
                            <div class="text"><?= $text ?></div>
						<?php endif; ?>
						<?php if ( $content_logos ): ?>
							<?php amLogosRow([
								'logos' => $content_logos
							]) ?>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
            </div>
		<?php endforeach; ?>
    </div>
<?php }