<?php

class acf_field_wc_container extends acf_field
{
    function __construct()
    {
        $this->name = 'wc_container';
        $this->label = __("Web Component", 'acf');
        $this->category = __("Layout", 'acf');
        $this->defaults = [
            'component_name' => 'div',
        ];

        parent::__construct();
    }

    function create_field($field)
    {
        $lux_count = get_field( 'room_count_lux', FESTIVAL_POST_ID);
        $econom_count = get_field( 'room_count_econom', FESTIVAL_POST_ID);
        $mini_count = get_field( 'room_count_mini', FESTIVAL_POST_ID);

        $lux_free = 12;
        $econom_free = 24;
        $mini_free = 10;
        include 'views/web-component.php';
    }

    function create_options($field)
    {
        include 'views/options.php';
    }
}

new acf_field_wc_container();
