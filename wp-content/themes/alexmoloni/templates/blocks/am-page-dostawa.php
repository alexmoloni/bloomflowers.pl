<div class="am-page-dostawa">
	<?php amShopBreadcrumb(); ?>
    <section class="section-1">
        <div class="container">
            <div class="desktop-only" id="tabs">
				<?php $tabs = get_field( 'tabs' ) ?>
                <ul>
					<?php
					$i = 0;
					foreach ( $tabs as $tab ):
						$i ++;
						?>
                        <li><a href="#am-tab-<?= $i ?>"><?= $tab['title'] ?></a></li>
					<?php endforeach; ?>
                </ul>
				<?php
				$i = 0;
				foreach ( $tabs as $tab ):
					$i ++;
					?>
                    <div class="text-wrap" id="am-tab-<?= $i ?>">
						<?= $tab['text'] ?>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="accordion-wrap mobile-only">
                <div class="squeezebox">
			        <?php
			        $items = get_field( 'tabs' );
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
					        <?= $item['title'] ?></h4>
                        <div class="squeezecnt"><?= $item['text'] ?></div>
			        <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

</div>