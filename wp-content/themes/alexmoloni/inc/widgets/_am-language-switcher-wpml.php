<?php
/**
 * Created by PhpStorm.
 * User: Aleksander
 * Date: 03-Jul-18
 * Time: 15:30
 */

//create custom language switcher
/**
 * @param $options
 */
function amLanguageSwitcherWPML( $options ) {
	$with_label  = $options['with_label'] ?? false;
	$extra_css   = $options['extra_css'] ?? '';
	$as_dropdown = $options['as_dropdown'] ?? false;
	$flags_only  = $options['flags_only'] ?? true;


	$args           = [
		'skip_missing' => 0,
	];
	$switcher_array = apply_filters( 'wpml_active_languages', null, $args );

	//search for index of the object in array where 'active' == 1
	$current_language_object_index_position = array_search( '1', array_column( $switcher_array, 'active' ) );

	$switcher_array_of_keys = array_keys( $switcher_array );

	$current_language_object_key_name = $switcher_array_of_keys[ $current_language_object_index_position ];


	$current_language_object = $switcher_array[ $current_language_object_key_name ];


	$switcher          = [
		'switcher_array'          => $switcher_array,
		'current_language_object' => $current_language_object,
	];
	$current_lang_slug = $current_language_object['code'];
	?>

<div class="am-language-switcher am-language-switcher-wpml <?= $as_dropdown ? 'as-dropdown' : 'no-dropdown' ?> <?= $extra_css ?> <?= $flags_only ? 'flags-only' : 'flags-and-text' ?> <?= $with_label ? 'with-label' : 'no-label' ?>">
	<?php if ( $with_label ): ?>
        <span class="label"><?= __( 'Language' ) ?>:</span>
	<?php endif; ?>
	<?php if ( $as_dropdown ): ?>
        <div class="dropdown">

            <a href="#" class="dropdown-toggle">
                <span class="flag-img-wrap">
                <img src="/images/prod/header/country-flag-<?= $switcher['current_language_object']['language_code'] ?>.png"
                     alt="<?= $switcher['current_language_object']['native_name'] ?>">
                </span>
            </a>

            <ul class="dropdown-menu">

				<?php
				foreach ( $switcher['switcher_array'] as $language_object ) { ?>
                    <li class="language-row <?php if ( $language_object['active'] == 1 ) {
						echo 'active';
					} ?>">
                        <a class="language-link" href="<?= $language_object['url'] ?>">
                            <span class="flag-img-wrap">
                            <img src="/images/prod/header/country-flag-<?= $language_object['language_code'] ?>.png"
                                 alt="<?= $language_object['native_name'] ?>">
                            </span>
							<?php if ( ! $flags_only ): ?>
                                <span class="native-name"><?= $language_object['native_name'] ?></span>
							<?php endif; ?>
                        </a>
                    </li>
				<?php }
				?>
            </ul>

        </div>
	<?php else: ?>
		<?php
        $get = $_GET;
		if ( isset( $get['lang'] ) ) {
			unset( $get['lang'] );
		}
		$get = http_build_query( $get );

		?>

		<?php foreach ( $switcher['switcher_array'] as $language_object ):
			$url = http_build_url( $language_object['url'], [
				'query' => $get
			], HTTP_URL_JOIN_QUERY );
			?>
            <a class="language-link <?= $language_object['code'] === $current_lang_slug ? 'current' : '' ?>" href="<?= $language_object['url'] ?>">
                <img class="flag-img" src="<?= get_field( "flag_{$language_object['language_code']}", 'options' )['sizes']['thumbnail']; ?>"
                     alt="<?= $language_object['native_name'] ?>">
				<?php if ( ! $flags_only ): ?>
                    <span class="native-name"><?= $language_object['native_name'] ?></span>
				<?php endif; ?>
            </a>
		<?php endforeach; ?>
	<?php endif; ?>

<?php }