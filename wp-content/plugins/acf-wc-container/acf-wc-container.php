<?php
/*
Plugin Name: Advanced Custom Fields: Web Component Container Field
Description: This premium Add-on adds a Web Component Container field type for the Advanced Custom Fields plugin
Version: 1.1.1
Author: Serhii Matrunchyk
Author URI: http://matrunchyk.com/
License: GPL
Copyright: Serhii Matrunchyk
*/

// only include add-on once
if( !function_exists('acf_register_wc_container_field') ):

    // add action to include field
    add_action('acf/register_fields', 'acf_register_wc_container_field');

    function acf_register_wc_container_field()
    {
        include_once('wc-container.php');
    }

endif; // class_exists check
