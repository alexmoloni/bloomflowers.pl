<?php

use alexito\Helpers;
use alexito\Pages;
use alexito\Woocommerce;

function mainHeader( $options ) {
	$topbar                           = $options['topbar'] ?? false;
	$hide_topbar_on_scroll            = $options['hide_topbar_on_scroll'] ?? true;
	$hamburger_location               = $options['hamburger_location'] ?? 'left';
	$sticky_on_load                   = $options['sticky_on_load'] ?? false;
	$sticky_on_load_on_content        = $options['sticky_on_load_on_content'] ?? false;
	$sticky_on_scroll                 = $options['sticky_on_scroll'] ?? false;
	$has_cart                         = $options['has_cart'] ?? false;
	$has_shadow                       = $options['has_shadow'] ?? false;
	$logo_text_to_right               = $options['logo_text_to_right'] ?? false;
	$mobile_menu_header               = $options['mobile_menu']['header'] ?? 'text';
	$mobile_menu_full_width           = $options['mobile_menu']['full_width'] ?? false;
	$mobile_menu_show_current_page    = $options['mobile_menu']['show_current_page'] ?? false;
	$show_close_x_inside_mobile_menu  = $options['mobile_menu']['show_close_x_inside_mobile_menu'] ?? true;
	$menu_from_side                   = $options['mobile_menu']['menu_from_side'] ?? 'left';
	$mobile_menu_from_top             = $options['mobile_menu']['mobile_menu_from_top'] ?? false;
	$mobile_menu_top_0                = $options['mobile_menu']['mobile_menu_top_0'] ?? false;
	$mobile_menu_fade_in              = $options['mobile_menu']['fade_in'] ?? false;
	$keep_close_x_on_menu_open        = $options['mobile_menu']['keep_close_x_on_menu_open'] ?? false;
	$mobile_menu_align_items          = $options['mobile_menu']['align_items'] ?? 'center';
	$with_language_switcher           = $options['with_language_switcher'] ?? false;
	$language_switcher_mobile_outside = $options['language_switcher_mobile_outside'] ?? false;
	$menu_item_has_underline          = $options['menu_item_has_underline'] ?? false;
	?>

	<?php if ( $sticky_on_load ): ?>
        <div id="header-spacer"></div>
	<?php endif; ?>
    <header id="main-header" class="main-header hamburger-location-<?= $hamburger_location ?> <?= $sticky_on_load ? 'sticky-on-load' : '' ?> <?= $sticky_on_load_on_content ? 'sticky-on-load-on-content' : '' ?> <?= $sticky_on_scroll ? 'sticky-on-scroll' : '' ?> <?= $topbar ? 'has-topbar' : '' ?> menu-from-<?= $menu_from_side ?> <?= $mobile_menu_full_width ? 'mobile-menu-full-width' : '' ?> <?= $mobile_menu_show_current_page ? 'mobile-menu-show-curent-page' : '' ?> <?= $has_shadow ? 'has-shadow' : '' ?> <?= $with_language_switcher ? 'with-language-switcher' : '' ?> <?= $menu_item_has_underline ? 'menu-item-has-underline' : '' ?> <?= $mobile_menu_from_top ? 'mobile-menu-from-top' : '' ?> <?= $mobile_menu_top_0 ? 'mobile-menu-top-0' : ''; ?> <?= 'mobile-menu-align-items-' . $mobile_menu_align_items ?> <?= $mobile_menu_fade_in ? 'mobile-menu-fade-in' : '' ?> <?= $keep_close_x_on_menu_open ? 'keep-close-x-on-menu-open' : '' ?> <?= $hide_topbar_on_scroll ? 'hide-topbar-on-scroll' : '' ?>">
		<?php if ( $topbar ): ?>
            <div class="topbar">
                <div class="container-wide">
                    <div class="topbar-inner">
                        <div class="phone-wrap inner-wrap">
                            <img src="<?= get_field( 'phone_icon', 'options' )['sizes']['thumbnail']; ?>" alt="" class="phone-icon">
                            <a href="tel: <?= str_replace( ' ', '', get_field( 'phone', 'options' ) ); ?>"><?= get_field( 'phone', 'options' ); ?></a>
                            <a href="tel: <?= str_replace( ' ', '', get_field( 'phone', 'options' ) ); ?>" class="phone-text"><?= get_field( 'call_us_text', 'options' ); ?></a>
                        </div>
                        <div class="cart-wrap">
                            <a class="inner-wrap" href="<?= Helpers::wpmlLinkMaintainingLanguage( 'koszyk' ) ?>">
                                <div class="cart-total-items cart-total-circle-icon"><?= Woocommerce::getCartCount() ?></div>
                                <img src="<?= get_field( 'cart_icon', 'options' )['sizes']['thumbnail']; ?>" alt="" class="cart-icon">
                                <span class="text"><?= __( 'Koszyk', 'alexmoloni' ) ?></span>
                            </a>
                            <div class="mini-cart-wrap">
								<?php amMiniCart(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		<?php endif; ?>
        <div class="container-wide">
            <div class="header-inner-wrap">
				<?php menuHamburger( [ 'id' => 'header-menu-hamburger' ] ) ?>
				<?php
				$options = [
					'use_acf_logo'  => true,
					'text_to_right' => get_field( 'text_next_to_logo', 'options' )
				];
				mainLogo( $options ) ?>

                <nav class="main-navigation" role="navigation" id="main-navigation">

					<?php if ( $mobile_menu_header ): ?>
                        <div class="mobile-menu-header">
							<?php if ( $mobile_menu_header === 'text' ): ?>
                                <p class="">Menu</p>
							<?php elseif ( $mobile_menu_header === 'logo' ): ?>
								<?php mainLogo( [
									'use_acf_logo'  => true,
									'text_to_right' => __( '', 'alexmoloni' )

								] ) ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>

					<?php if ( $show_close_x_inside_mobile_menu && ! $mobile_menu_top_0 ): ?>
						<?php closeX( 'js-close-main-navigation' ) ?>
					<?php endif; ?>

                    <div class="desktop-menu-wrap">
                        <style>
                            .menu-item.menu-item-shop > a:after {
                                content: "<?= get_field('text_above_menu_item_shop', 'options') ?>";
                            }
                        </style>
						<?php
						wp_nav_menu( [
							'menu'       => 2,
							'menu_class' => 'header-menu header-menu-desktop'
						] );
						?>
                    </div>

                    <div class="mobile-menu-wrap">
						<?php
						wp_nav_menu( [
							'menu'       => 2,
							'menu_class' => 'header-menu header-menu-mobile'
						] );
						?>
                    </div>

					<?php if ( $has_cart ): ?>

						<?php headerCart( [
							'extra_css' => 'desktop-only'
						] ) ?>
					<?php endif; ?>
					<?php if ( $with_language_switcher ):
						?>
						<?php amLanguageSwitcher( [
						'extra_css' => $language_switcher_mobile_outside ? 'desktop-only' : ''
					] ) ?>
					<?php endif; ?>
                </nav>

				<?php if ( $has_cart ): ?>
					<?php headerCart( [
						'extra_css' => 'mobile-only'
					] ) ?>
				<?php endif; ?>

				<?php if ( $with_language_switcher && $language_switcher_mobile_outside ): ?>
					<?php amLanguageSwitcher( [
						'extra_css' => 'mobile-only'
					] ) ?>
				<?php endif; ?>

            </div>
            <div class="header-categories">
				<?php
				amCatalogueGrid( [
					'with_image' => false,
					'layout'     => 'layout-simple',
				] );
				?>
            </div>
        </div>
    </header>

<?php }
