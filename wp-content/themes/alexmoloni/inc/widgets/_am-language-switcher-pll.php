<?php


function amLanguageSwitcherPll( $options = null ) {
	$extra_css  = $options['extra_css'] ?? '';
	$with_names = $options['with_names'] ?? false;

	if ( ! function_exists( 'pll_the_languages' ) ) {
		return;
	}

	$languages = pll_the_languages( [
		'display_names_as'       => 'name',
		'hide_if_no_translation' => 0,
		'raw'                    => true
    ] );

	if ( empty( $languages ) ) {
		return;
	}
	?>

    <ul class="am-language-switcher-pll am-language-switcher <?= $extra_css ?>">
		<?php foreach ( $languages as $language ) {

			// Variables containing language data
			$id             = $language['id'];
			$name           = $language['name'];
			$slug           = $language['slug'];
			$url            = $language['url'];
			$no_translation = $language['no_translation'];
			$current        = $language['current_lang'];
			?>

            <li class="lang-item <?= $current ? 'current' : '' ?> lang-<?= $slug ?>">
                <a href="<?= $url ?>">
                    <img src="<?= get_field( 'flag_' . $slug, 'options' )['url']; ?>" alt="<?= $name ?>" class="icon">
					<?php if ( $with_names ): ?>
                        <span class="text"><?= $name ?></span>
					<?php endif; ?>
                </a>
            </li>

		<?php } ?>
    </ul>
<?php }