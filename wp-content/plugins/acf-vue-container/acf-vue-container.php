<?php
/*
Plugin Name: Advanced Custom Fields: Vue Container Field
Description: This premium Add-on adds a Vue Container field type for the Advanced Custom Fields plugin
Version: 1.1.1
Author: Serhii Matrunchyk
Author URI: http://matrunchyk.com/
License: GPL
Copyright: Serhii Matrunchyk
*/

// only include add-on once
if( !function_exists('acf_register_vue_container_field') ):


// add action to include field
add_action('acf/register_fields', 'acf_register_vue_container_field');

function acf_register_vue_container_field()
{
	include_once('vue-container.php');
}


/*
*  Update
*
*  if update file exists, allow this add-on to connect and recieve updates.
*  all ACF premium Add-ons which are distributed within a plugin or theme, must have the update file removed.
*
*  @type	file
*  @date	13/07/13
*
*  @param	N/A
*  @return	N/A
*/

if( is_admin() && file_exists(  dirname( __FILE__ ) . '/acf-vue-container-update.php' ) )
{
	include_once( dirname( __FILE__ ) . '/acf-vue-container-update.php' );
}

endif; // class_exists check
