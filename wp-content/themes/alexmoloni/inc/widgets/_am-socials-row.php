<?php

function amSocialsRow( $options = null ) {
	?>
	<ul class="am-socials-row">
		<?php
		$socials = get_field( 'socials', 'options' );;
		if ( ! $socials ) {
			$socials = [];
		}
		foreach ( $socials as $social ):?>
			<li class="item">
				<a href="<?= esc_url( $social['link'] ) ?>">
					<?php $image = $social['image']; ?>
					<img src="<?= $image['sizes']['thumbnail'] ?>" alt="<?= $image['alt'] ?>" class="icon">
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php }
