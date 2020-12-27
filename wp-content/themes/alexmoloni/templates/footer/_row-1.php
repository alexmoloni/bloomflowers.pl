<div class="footer-row-1 section">
    <div class="container">
        <div class="socials">
            <h4 class="heading-4 heading"><?= get_field( 'footer_socials_heading', 'options' ); ?></h4>
			<?php amSocialsRow(); ?>
        </div>
        <div class="links-wrap">
			<?php
			$links_top_sections = get_field( 'links_sections', 'options' );;
			if ( ! $links_top_sections ) {
				$links_top_sections = [];
			}
			foreach ( $links_top_sections as $section ):
				$links = $section['links'] ?? [];
				?>
                <div class="link-section">
					<?php if ( $section['title'] ): ?>
                        <h4 class="heading-4 heading"><?= $section['title'] ?></h4>
					<?php endif; ?>
					<?php foreach ( $links as $link ):
						$link_obj = $link['link'];
						?>
                        <a class="link" href="<?= $link_obj['url'] ?>"><?= $link_obj['title'] ?></a>
					<?php endforeach; ?>
                </div>
			<?php endforeach; ?>
            <div class="col-address link-section"><?= get_field( 'footer_bottom_text', 'options' ); ?></div>
            <div class="col-logo link-section">
                <img src="<?= get_field( 'footer_logo', 'options' )['sizes']['medium']; ?>" alt="">
            </div>
        </div>
    </div>
</div>