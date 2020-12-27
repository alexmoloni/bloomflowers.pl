<?php
$with_padding          = get_field( 'with_padding' ) ?? false;
$light_grey_background = get_field( 'light_grey_background' ) ?? false;
$heading               = get_field( 'heading' ) ?? false;
$subheading            = get_field( 'subheading' ) ?? false;
$text_align            = get_field( 'text_align' ) ?? 'left';
$images                = get_field( 'images' ) ?? [];

?>
<div class="am-gallery-section <?= $with_padding ? 'section' : '' ?> <?= $light_grey_background ? 'bg-light-grey' : '' ?>">
    <div class="container-narrow">
		<?php if ( $heading ): ?>
            <h2 class="heading-2 heading text-<?= $text_align ?>"><?= $heading ?></h2>
		<?php endif; ?>
		<?php if ( $subheading ): ?>
            <h3 class="heading-4 subheading text-<?= $text_align ?>"><?= $subheading ?></h3>
		<?php endif; ?>
        <div class="images-wrap">
			<?php foreach ( $images as $image ):
				?>
                <div class="image-item">
                    <figure>
                        <img src="<?= $image['sizes']['large'] ?>" alt="<?= $image['alt'] ?>">
                    </figure>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>