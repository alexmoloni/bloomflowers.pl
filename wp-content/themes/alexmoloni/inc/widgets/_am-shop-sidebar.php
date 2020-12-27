<?php

function amShopSidebar( $options = null ) {
	$current_cat = $options['current_cat'] ?? null;
	?>
    <div class="am-shop-sidebar">
        <div class="section-categories mobile-toggle-parent">
            <h3 class="sidebar-inner-section mobile-only js-shop-mobile-toggle shop-mobile-toggle"><?= __('Kategorie', 'alexmoloni') ?></h3>
			<?php $cats = \alexito\Woocommerce::getAllProductCategoryTerms(); ?>
            <ul class="categories-list mobile-toggle-target">
				<?php
				/** @var WP_Term $cat */
				foreach ( $cats as $cat ):
					$selected = false;
					if ( $current_cat && ( $current_cat->term_id == $cat->term_id ) ) {
						$selected = true;
					}
					?>
                    <li class="category-item sidebar-inner-section <?= $selected ? 'selected' : '' ?>">
                        <a href="<?= get_term_link( $cat->term_id ) ?>"><?= $cat->name ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
        <form class="mobile-toggle-parent" action="" method="get">
            <h3 class="sidebar-inner-section mobile-only js-shop-mobile-toggle shop-mobile-toggle"><?= __( 'Filtruj', 'alexmoloni' ) ?></h3>
            <div class="sidebar-inner-section section-filters-title desktop-only">
				<?= __( 'Filtruj', 'alexmoloni' ) ?>
            </div>
            <div class="filters-wrap mobile-toggle-target">
                <div class="sidebar-inner-section section-price">
		            <?php
		            $args = [
			            'heading'                      => __( 'Cena', 'alexmoloni' ),
			            'show_interactive_text_inputs' => true,
			            'show_static_price_labels'     => true,
			            'max'                          => \alexito\Woocommerce::getMinMaxPriceInAllProducts('max')
		            ];

		            if ( isset( $_GET['filter_price_min'] ) && is_numeric( $_GET['filter_price_min'] ) ) {
			            $args['current_min'] = $_GET['filter_price_min'];
		            }

		            if ( isset( $_GET['filter_price_max'] ) && is_numeric( $_GET['filter_price_max'] ) ) {
			            $args['current_max'] = $_GET['filter_price_max'];
		            }
		            amRangeSlider( $args ) ?>
                </div>
                <div class="sidebar-inner-section section-suggestions">
                    <p class="section-title"><?= __( 'Nasze Sugestie', 'alexmoloni' ) ?></p>
		            <?php
		            $args = [
			            'label_text'  => __( 'Polecany', 'alexmoloni' ),
			            'input_name'  => 'recommended',
			            'input_value' => 1
		            ];
		            if ( isset( $_GET['recommended'] ) && $_GET['recommended'] === '1' ) {
			            $args['checked'] = true;
		            }
		            amPrettyCheckbox( $args ); ?>
		            <?php
		            $args = [
			            'label_text'  => __( 'Nowość', 'alexmoloni' ),
			            'input_name'  => 'new',
			            'input_value' => 1
		            ];
		            if ( isset( $_GET['new'] ) && $_GET['new'] === '1' ) {
			            $args['checked'] = true;
		            }
		            amPrettyCheckbox( $args ); ?>
                </div>
                <div class="sidebar-inner-section section-sizes">
                    <p class="section-title"><?= __( 'Rozmiar bukietu', 'alexmoloni' ) ?></p>
		            <?php $sizes = get_terms( [
			            'taxonomy'   => 'pa_rozmiar-zestawu',
			            'orderby'    => 'meta_value_num',
			            'meta_key'   => 'order',
			            'order'      => 'ASC',
			            'hide_empty' => false,
		            ] );
		            ?>
		            <?php
		            /** @var WP_Term $size */
		            foreach ( $sizes as $size ): ?>
			            <?php
			            $args = [
				            'label_text'  => $size->name,
				            'input_name'  => "size_" . $size->slug,
				            'input_value' => 1
			            ];
			            if ( isset( $_GET[ 'size_' . $size->slug ] ) && $_GET[ 'size_' . $size->slug ] === '1' ) {
				            $args['checked'] = true;
			            }
			            amPrettyCheckbox( $args ); ?>

		            <?php endforeach; ?>
                </div>
                <div class="btns-wrap sidebar-inner-section">
                    <button class="btn-submit btn-cta-1"><?= __( 'Filtruj', 'alexmoloni' ) ?></button>
                    <a href="?" class="btn-reset btn-cta-2"><?= __( 'Resetuj', 'alexmoloni' ) ?></a>
                </div>
            </div>

            <input type="hidden" name="filters_on">
            <input type="hidden" name="lang" value="<?= \alexito\Helpers::wpmlGetCurrentLanguage() ?>">

        </form>
		<?php amNewsletterSignupSidebar( [
			'extra_css' => 'desktop-only'
		] ); ?>

    </div>
<?php }
