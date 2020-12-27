<?php

function amVideoEmbed($options = null) {
$embed = $options['embed'] ?? '';
	?>
	<div class="am-video-embed">
			<div class="embed-container">
				<?= $embed ?>
			</div>
	</div>
<?php }