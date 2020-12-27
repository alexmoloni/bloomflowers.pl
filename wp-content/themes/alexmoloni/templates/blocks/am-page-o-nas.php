<div class="am-page-o-nas">
	<?php amShopBreadcrumb(); ?>
    <section class="section-1">
        <div class="container">
            <h2 class="heading-2 page-title"><?= get_field( 'heading' ) ?></h2>
            <div class="cols-wrap">
                <div class="col-media">
					<?php $yt_id = get_field( 'yt_id' ); ?>
                    <img class="ratio" src="http://placehold.it/560x315" alt="">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $yt_id ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-text">
                    <div class="text"><?= get_field( 'text' ) ?></div>
                </div>
            </div>
            <div class="text-bottom"><?= get_field( 'text_bottom' ); ?></div>

        </div>
    </section>
    <section class="section section-2">
        <div class="container">
            <div class="boxes-wrap">
				<?php
				$boxes = get_field( 'boxes' );
				foreach ( $boxes as $box ): ?>
                    <div class="box">
                        <div data-number="<?= $box['number'] ?>" class="number">0</div>
                        <h4 class="heading-4 text"><?= $box['text'] ?></h4>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </section>


</div>