<?php

function amHeadingWithDecoration( $options = null ) {
	$level = $options['level'] ?? '2';
	$text = $options['text'] ?? '';
	?>
    <h<?= $level ?> class="am-heading-with-decoration heading-<?= $level ?>">
        <div class="inner-wrap">
            <span class="text"><?= $text ?></span>
            <span class="decoration">
                <span class="line line-left"></span>
                <span class="dot"></span>
                <span class="line line-right"></span>
            </span>
        </div>
    </h<?= $level ?>>
<?php }