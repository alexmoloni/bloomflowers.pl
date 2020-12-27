<?php
$heading    = get_field( 'heading' ) ?? false;
$text       = get_field( 'text' ) ?? '';
$image      = get_field( 'image' ) ?? [];
$extra_css  = get_field( 'extra_css' ) ?? '';
$section_id = get_field( 'section_id' ) ?? '';
?>

<div id="<?= $section_id ?>" class="am-section-text-and-image section <?= $extra_css ?>">
    <div class="container-narrow-2">
        <div class="cols-wrap">
            <div class="col-text">
				<?php if ( $heading ): ?>
                    <h3 class="heading heading-3"><?= $heading ?></h3>
				<?php endif; ?>
                <div class="text-wrap">
					<?= $text ?>
                </div>
            </div>
            <div class="col-image">
                <figure>
                    <img src="<?= $image['sizes']['large'] ?>" alt="<?= $image['alt'] ?>">
                </figure>
            </div>

        </div>
    </div>
</div>
