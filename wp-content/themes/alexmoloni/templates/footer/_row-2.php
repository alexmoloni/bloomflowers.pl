<div class="footer-row-2 section">
    <div class="container">
        <div class="cols-wrap">
            <ul class="col-1-links">
				<?php
				$links = get_field( 'footer_bottom_1_link', 'options' );
				foreach ( $links as $link ):
                    $link = $link['link'];
                    ?>
                    <li class="link-item">
                        <a href="<?= esc_url( $link['url'] ) ?>"><?= $link['title'] ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
            <div class="col-2-links">
				<?php
				$links = get_field( 'footer_bottom_2_link', 'options' );
				foreach ( $links as $link ):
					$link = $link['link'];
                    ?>
                    <li class="link-item">
                        <a href="<?= esc_url( $link['url'] ) ?>"><?= $link['title'] ?></a>
                    </li>
				<?php endforeach; ?>
            </div>
            <div class="col-3-text"><?= get_field( 'footer_bottom_text', 'options' ); ?></div>

        </div>
    </div>
    <div class="logo-wrap">
        <img src="<?= get_field( 'footer_logo', 'options' )['sizes']['medium']; ?>" alt="">
    </div>
</div>