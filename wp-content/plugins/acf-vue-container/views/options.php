<?php

// vars
$key = $field['name'];
$field['required'] = 1;

// validate
if (empty($field['component_name'])) {
	$field['component_name'] = 'div';
}

?>
<tr class="field_option field_option_<?php echo $this->name; ?> field_option_<?php echo $this->name; ?>_fields">
	<td class="label">
		<label><?php _e("Web Component name",'acf'); ?></label>
	</td>
	<td>
	<div class="vue_container">
		<div class="fields">
            <?php
            do_action('acf/create_field', array(
                'type'	=>	'text',
                'name'	=>	'fields[' . $key . '][component_name]',
                'value'	=>	$field['component_name'],
                'class'	=>	'name',
            ));
            ?>
		</div>
	</div>
	</td>
</tr>
