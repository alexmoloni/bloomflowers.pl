<?php

use alexito\Woocommerce;

function amCatalogueGrid( $options = null ) {
	$with_container = $options['with_container'] ?? false;
	$with_container_wide = $options['with_container_wide'] ?? false;
	$layout         = $options['layout'] ?? 'layout-big'; //other option in css layout-simple
	$cats           = Woocommerce::getAllProductCategoryTerms();
	$with_image     = $options['with_image'] ?? true;
	?>
    <div class="am-catalogue-grid <?= $layout ?>">
        <div class="<?= $with_container ? 'container' : '' ?> <?= $with_container_wide ? 'container-wide' : '' ?>">
            <div class="items-wrap">
				<?php
				/** @var WP_Term $cat */
				foreach ( $cats as $cat ):
					$image = Woocommerce::getProductCategoryThumbnail( $cat->term_id, 'medium_large' );
					?>
                    <a href="<?= get_term_link( $cat->term_id ) ?>" class="item">
						<?php if ( $with_image ): ?>
                            <figure class="bg-image">
                                <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                            </figure>
						<?php endif; ?>
						<?php if ( $layout === 'layout-big' ): ?>
                            <h3 class="title heading-2"><?= $cat->name ?></h3>
						<?php elseif ( $layout === 'layout-simple' ): ?>
                            <p class="title"><?= $cat->name ?></p>
						<?php endif; ?>
                    </a>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
<?php }

