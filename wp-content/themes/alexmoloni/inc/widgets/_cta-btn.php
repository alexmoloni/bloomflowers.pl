<?php
function ctaBtn( $options ) {
	$theme       = $options['theme'] ?? 'theme-1';//other optio theme-plain
	$text        = $options['text'];
	$extra_css   = $options['extra_css'] ?? '';
	$link        = $options['link'] ?? '/';
	$with_border = $options['with_border'] ?? false;
	$with_arrow_right = $options['with_arrow_right'] ?? false;

	?>
    <a href="<?= $link ?>" class="
	cta-btn -<?= $theme ?>
	<?= $extra_css ?>
	<?= $with_arrow_right ? 'with-arrow-right' : '' ?>
    <?= $with_border ? 'with-border' : '' ?>">
		<?= $text ?>
    </a>

<?php }

