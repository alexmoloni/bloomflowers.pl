<?php

function amPrettyCheckbox( $options = null ) {
$label_text = $options['label_text'] ?? '';
$input_name = $options['input_name'] ?? '';
$input_value = $options['input_value'] ?? '';
$checked = $options['checked'] ?? false;


	?>
	<label class="am-pretty-checkbox">
		<input <?= $checked ? 'checked' : '' ?> name="<?= $input_name ?>" value="<?= $input_value ?>" type="checkbox">
		<span class="checkmark"></span>
		<span><?= $label_text ?></span>
	</label>
<?php }
