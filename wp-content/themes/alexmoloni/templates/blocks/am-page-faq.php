<div class="am-page-faq">
	<?php amShopBreadcrumb(); ?>
    <section class="section-1 section">
        <div class="container">
            <h1 class="heading-1 page-title"><?= get_the_title() ?></h1>
            <div class="accordion-wrap">
                <div class="squeezebox">
					<?php
					$items = get_field( 'faq' );
					if ( ! $items ) {
						$items = [];
					} ?>
					<?php
                    $i = 0;
					foreach ( $items as $item ):
                        $i++;
                        ?>
                        <h4 class="squeezhead">
                            <span class="number"><?= $i ?></span>
                            <?= $item['question'] ?></h4>
                        <div class="squeezecnt"><?= $item['answer'] ?></div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


</div>