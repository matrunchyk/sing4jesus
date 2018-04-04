<?php

class acf_field_vue_container extends acf_field
{
	public $settings = [];

	public $name = 'vue_container';

	function __construct()
	{
		$this->label = __("Vue Container",'acf');
		$this->category = __("Layout",'acf');
		$this->defaults = [
			'component_name'	=>	'div',
		];

		// do not delete!
    	parent::__construct();
    	

    	// settings
		$this->settings = [
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '0.0.1',
		];
	}
	
	function input_admin_enqueue_scripts()
	{
		// register acf scripts
		wp_register_script( 'acf-input-vue-container', $this->settings['dir'] . 'js/input.js', array('acf-vue-container'), $this->settings['version'] );
		wp_register_style( 'acf-input-vue-container', $this->settings['dir'] . 'css/input.css', array('acf-vue-container'), $this->settings['version'] );
		
		
		// scripts
		wp_enqueue_script([
			'acf-input-vue-container',
		]);

		// styles
		wp_enqueue_style([
			'acf-input-vue-container',
		]);
		
	}
	
	function create_field( $field )
	{
		include( $this->settings['path'] . 'views/web-component.php' );
	}

	function create_options( $field )
	{
		include( $this->settings['path'] . 'views/options.php' );
	}
}

new acf_field_vue_container();
