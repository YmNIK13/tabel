<?php

/**
 * Implement hook_form_FORM_ID_alter()
 */
function hrd_form_system_theme_settings_alter(&$form, &$form_state) {
	
	$form['my_text'] = [
		'#type' => 'textfield',
		'#title' => t('My text'),
		'#description' => t('First settings'),
		'#default_value' => theme_get_setting('my_text'),
	];
}