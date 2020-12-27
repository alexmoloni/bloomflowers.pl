<?php

function amRangeSlider( $options = null ) {
	$max                          = $options['max'] ?? 1000;
	$current_max                  = $options['current_max'] ?? $max;
	$min                          = $options['min'] ?? 0;
	$current_min                  = $options['current_min'] ?? $min;
	$unit                         = $options['unit'] ?? 'zł';
	$heading                      = $options['heading'] ?? false;
	$show_interactive_text_inputs = $options['show_interactive_text_inputs'] ?? false;
	$show_dynamic_price_labels    = $options['show_dynamic_price_labels'] ?? false;
	$show_static_price_labels     = $options['show_static_price_labels'] ?? true;
	?>
    <div class="am-range-slider <?= $show_interactive_text_inputs ? 'show-interactive-text-inputs' : 'not-show-interactive-text-inputs' ?> <?= $show_dynamic_price_labels ? 'show-dynamic-price-labels' : 'not-show-dynamic-price-labels' ?>" data-min="<?= $min ?>" data-max="<?= $max ?>" data-current-max="<?= $current_max ?>" data-current-min="<?= $current_min ?>" data-unit="<?= $unit ?>">
		<?php if ( $heading ): ?>
            <p class="heading"><?= $heading ?></p>
		<?php endif; ?>
        <div class="inputs-wrap">
			<?php if ( $show_interactive_text_inputs ): ?>
                <input value="<?= $current_min ?>" type="text" name="filter_price_min">
                <input value="<?= $current_max ?>" type="text" name="filter_price_max">
			<?php else: ?>
                <input value="<?= $current_min ?>" type="hidden" name="filter_price_min">
                <input value="<?= $current_max ?>" type="hidden" name="filter_price_max">
			<?php endif; ?>
        </div>
		<?php if ( $show_dynamic_price_labels ): ?>
            <div class="dynamic-labels labels-wrap">
                <label class="dynamic-label-price-min"></label>
                <label class="dynamic-label-price-max"></label>
            </div>
		<?php endif; ?>
		<?php if ( $show_static_price_labels ): ?>
            <div class="static-labels labels-wrap">
                <label class="static-label-price-min"><?= $min ?></label>
                <label class="static-label-price-max"><?= $max ?></label>
            </div>
		<?php endif; ?>
        <div class="price-range"></div>
    </div>
<?php }
