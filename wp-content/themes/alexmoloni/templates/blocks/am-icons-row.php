<?php
$items                 = get_field( 'items' ) ?? [];
$heading               = get_field( 'heading' ) ?? false;
$with_circle_icon      = get_field( 'with_circle_icon' ) ?? false;
$layout_vertical       = get_field( 'layout_vertical' ) ?? false;
$light_grey_background = get_field( 'light_grey_background' ) ?? false;


?>
<div class="section am-icons-row <?= $with_circle_icon ? 'with-circle-icon' : '' ?> <?= $layout_vertical ? 'layout-vertical' : '' ?> <?= $light_grey_background ? 'bg-light-grey' : '' ?>">
    <div class="container">
		<?php if ( $heading ): ?>
			<?= $heading ?>
		<?php endif; ?>
        <div class="items-wrap items-count-<?= count($items) ?>">
			<?php foreach ( $items

			as $item ):
			$heading = $item['heading'] ?? false;
			$link    = $item['link'] ?? false;

			?>
            <<?= $link ? 'a' : 'div' ?> <?= $link ? 'href="' . esc_url( $link ) . '"' : '' ?>  class="item <?= $link ? 'with-link' : ' no-link' ?>">
            <div class="img-wrap">
                <img src="<?= $item['image']['sizes']['medium_large'] ?>" alt="<?= $item['image']['alt'] ?>" class="icon">
            </div>
			<?php if ( $heading ): ?>
                <h3 class="heading-3 heading"><?= $heading ?></h3>
			<?php endif; ?>
            <h4 class="text"><?= $item['text'] ?></h4>
        </<?= $link ? 'a' : 'div' ?>>
	<?php endforeach; ?>
    </div>
</div>
</div>

