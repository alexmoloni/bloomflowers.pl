<?php

function amPrettyRadio( $options = null ) {
$label_text = $options['label_text'] ?? '';
$input_name = $options['input_name'] ?? '';
$input_value = $options['input_value'] ?? '';
$checked = $options['checked'] ?? false;
$input_extra_data = $options['input_extra_data'] ?? '';
$input_extra_css = $options['input_extra_css'] ?? '';


	?>
	<label class="am-pretty-radio">
		<input class="<?= $input_extra_css ?>" <?= $input_extra_data ?> <?= $checked ? 'checked' : '' ?> name="<?= $input_name ?>" value="<?= $input_value ?>" type="radio">
		<span class="label-text"><?= $label_text ?></span>
	</label>
<?php }
