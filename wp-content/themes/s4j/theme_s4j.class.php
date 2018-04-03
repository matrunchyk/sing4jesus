<?php
/*
Theme Name: Theme S4J
Theme URI: http://matrunchyk.net/
Description: "Sing For Jesus" festival Theme
Version: 0.1.0
Author: Sergii Matrunchyk
Author URI: http://matrunchyk.net/
License: GPL
Copyright: Sergii Matrunchyk
*/

use WP_CLI\Iterators\Exception;

if ( ! class_exists('Theme_S4J')):

    class Theme_S4J
    {
        const ASSETS_VER         = 2;
        const SCHEDULE_DATES_MIN = 'ASC';
        const SCHEDULE_DATES_MAX = 'DESC';

        /** @var SC_Guest */
        private $guest;

        function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'wp_enqueue_scripts']);
            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
            add_action('after_setup_theme', [$this, 'after_setup_theme']);
            add_filter('wp_head', [$this, 'wp_head'], 99);
            add_action('admin_head', [$this, 'admin_head']);
            add_action('wp_ajax_register', [$this, 'registerAction']);
            add_action('wp_ajax_nopriv_register', [$this, 'registerAction']);

            add_filter('show_admin_bar', '__return_false');
            remove_action('wp_head', 'wp_generator');
        }

        function admin_enqueue_scripts($hook)
        {
            if (WP_DEBUG) {
                wp_enqueue_script(
                    'vue-js', '//cdn.jsdelivr.net/npm/vue/dist/vue.js', [], null, true
                );
            } else {
                wp_enqueue_script(
                    'vue-js', '//cdn.jsdelivr.net/npm/vue', [], null, true
                );
            }
            if ('edit.php' != $hook) {
                return;
            }
            wp_enqueue_script('admin_script', get_template_directory_uri() . '/js/admin.js');
        }

        private function checkNonce()
        {
            if ( ! WPSimpleNonce::checkNonce($_REQUEST['nonce_field'], $_REQUEST[$_REQUEST['nonce_field']])) {
                throw new \Exception('Invalid nonce.');
            }
        }

        function registerAction()
        {
            $this::checkNonce();
            header('Content-Type: application/json');

            require_once 'sc_guest.php';

            $this->guest = new SC_Guest();
            $this->guest->load($_REQUEST);

            $saveResult = $this->guest->save();
            if (is_wp_error($saveResult)) {
                throw new Exception('Guest Save Error');
            }

            $ticket_id = $this->guest->getTicket();

            $response = [
                'result' => 'ok',
                'amount' => get_field('amount', $ticket_id),
            ];

            die(json_encode($response));
        }

        function after_setup_theme()
        {
            add_theme_support('post-thumbnails');
        }

        /**
         * Enqueue scripts and styles.
         */
        function wp_enqueue_scripts()
        {
            // Header Assets
            wp_enqueue_style('Ubuntu-Font', '//fonts.googleapis.com/css?family=Ubuntu:700', [], null);
            wp_enqueue_style('Roboto-Font', '//fonts.googleapis.com/css?family=Roboto:100,300,700', [], null);

            wp_enqueue_style(
                'Bootstrap-Framework', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', [], null
            );
            wp_enqueue_style(
                'Animate-Framework', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.6/animate.min.css', [], null
            );
            wp_enqueue_style(
                'FA-Font', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], null
            );


            wp_enqueue_style('LineIcons-Font', get_template_directory_uri() . '/css/font-lineicons.css', [], null);
            wp_enqueue_style('Fancybox-Style', get_template_directory_uri() . '/css/jquery.fancybox.css', [], null);
            wp_enqueue_style('Blue-Style', get_template_directory_uri() . '/css/style-blue.css', [], null);

            wp_enqueue_style('Main-Style', get_stylesheet_uri(), [], 'v1');

            // Conditional polyfills
            $conditional_scripts = [
                'html5shiv'           => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js',
                'html5shiv-printshiv' => '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv-printshiv.js',
                'respond'             => '//cdn.jsdelivr.net/respond/1.4.2/respond.min.js',
            ];
            foreach ($conditional_scripts as $handle => $src) {
                wp_enqueue_script($handle, $src, [], null, false);
            }
            add_filter(
                'script_loader_tag', function ($tag, $handle) use ($conditional_scripts) {
                if (array_key_exists($handle, $conditional_scripts)) {
                    $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
                }

                return $tag;
            }, 10, 2
            );


            // Footer Assets
            wp_deregister_script('jquery');
            wp_register_script(
                'jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"), [], null, true
            );
            wp_enqueue_script('jquery');

            wp_enqueue_script(
                'googlemaps-js',
                '//maps.googleapis.com/maps/api/js?key=AIzaSyCs4-EtuPpsPJhFc4YyRFtybdyi5O78TQ8&v=3.exp', ['jquery'],
                null, true
            );
            if (WP_DEBUG) {
                wp_enqueue_script(
                    'vue-js', '//cdn.jsdelivr.net/npm/vue/dist/vue.js', [], null, true
                );
            } else {
                wp_enqueue_script(
                    'vue-js', '//cdn.jsdelivr.net/npm/vue', [], null, true
                );
            }
            wp_enqueue_script(
                'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', ['jquery'], null, true
            );
            wp_enqueue_script(
                'one-page-nav-js', '//cdnjs.cloudflare.com/ajax/libs/jquery-one-page-nav/3.0.0/jquery.nav.min.js',
                ['jquery'], null, true
            );
            wp_enqueue_script(
                'jquery.countTo-js', get_template_directory_uri() . '/js/jquery.countTo.js', ['jquery'], null, true
            );
            wp_enqueue_script(
                'jquery.appear-js', get_template_directory_uri() . '/js/jquery.appear.js', ['jquery'], null, true
            );
            wp_enqueue_script(
                'wayp-js', '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js', ['jquery'], null, true
            );
            wp_enqueue_script(
                'wayp-sticky-js',
                '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/shortcuts/sticky-elements/waypoints-sticky.min.js',
                ['jquery'], null, true
            );
            wp_enqueue_script(
                'fancybox-js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js', ['jquery'],
                null, true
            );
            wp_enqueue_script(
                'holder-js', '//cdnjs.cloudflare.com/ajax/libs/holder/2.7.1/holder.min.js', ['jquery'], null, true
            );

            wp_enqueue_script(
                'main-script', get_template_directory_uri() . '/js/functions.js', [], self::ASSETS_VER, true
            );

            wp_localize_script(
                'main-script', 'wp_settings', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]
            );
        }

        // css override for the frontend
        function wp_head()
        {
            echo '<style type="text/css" media="screen">
                html { margin-top: 0px !important; }
                * html body { margin-top: 0px !important; }
            </style>';
        }

        function admin_head()
        {
            echo '<style type="text/css">
		#wp-admin-bar-view, #wp-admin-bar-comments, .edit-timestamp, .misc-pub-visibility, #minor-publishing-actions,
		#post-preview, #view-post-btn{display: none !important;}
	</style>';
        }

        static function getScheduleDate($order = self::SCHEDULE_DATES_MIN)
        {
            // args
            $posts = get_posts(
                [
                    'posts_per_page' => -1,
                    'post_type'      => 'schedule',
                    'meta_key'       => 'date',
                    'orderby'        => 'meta_value_num',
                    'order'          => $order,
                ]
            );

            return strtotime(get_field('date', $posts[0]->ID));
        }

        static function getOption($name, $default = false)
        {

            $optionsframework_settings = get_option('optionsframework');

            // Gets the unique option id
            $option_name = $optionsframework_settings['id'];

            if (get_option($option_name)) {
                $options = get_option($option_name);
            }

            if (isset($options[$name])) {
                return $options[$name];
            } else {
                return $default;
            }
        }

        /**
         * @param string $post
         *
         * @return array
         */
        static function getPosts($post = 'page', $order = '')
        {
            return get_posts(
                [
                    'posts_per_page' => 100,
                    'post_type'      => $post,
                    'post_status'    => 'publish',
                    'order'          => 'ASC',
                ]
            );
        }

        static function getJudges()
        {
            return get_posts(
                [
                    'posts_per_page' => 100,
                    'post_type'      => 'team',
                    'post_status'    => 'publish',
                    'order'          => 'ASC',
                    'category_name'  => 'judges',
                ]
            );
        }

        static function getOptions()
        {
            $options = [];

            $options[] = [
                'name' => __('Основні налаштування', 'options_check'),
                'type' => 'heading',
            ];

            // Pull all the pages into an array
            $options_pages     = [];
            $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
            $options_pages[''] = 'Оберіть сторінку:';

            foreach ($options_pages_obj as $page) {
                $options_pages[$page->ID] = $page->post_title;
            }

            $options[] = [
                'name'    => __('Оберіть сторінку 404', 'options_check'),
                'desc'    => __('Вміст даної сторінки буде відображений при помилці HTTP-404', 'options_check'),
                'id'      => 'page404',
                'type'    => 'select',
                'options' => $options_pages,
            ];

            $options[] = [
                'name' => __('Акаунт Google Analytics', 'options_check'),
                'desc' => __('Приклад: UA-1234567-89', 'options_check'),
                'id'   => 'ga_account',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Реєстрація доступна', 'options_check'),
                'id'   => 'guest_registration',
                'type' => 'checkbox',
            ];

            $options[] = [
                'name' => __('Запланована кількість виконавців', 'options_check'),
                'id'   => 'planned_performers_count',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Запланована кількість гостей', 'options_check'),
                'id'   => 'planned_guests_count',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Запланована тривалість в годинах', 'options_check'),
                'id'   => 'planned_hours_count',
                'type' => 'text',
            ];


            /** Contact Info */

            $options[] = [
                'name' => __('Контактна інформація', 'contact_info'),
                'type' => 'heading',
            ];

            $options[] = [
                'name' => __('Контактний телефон', 'contact_info'),
                'desc' => __('Приклад: (123) 456-7890', 'contact_info'),
                'id'   => 'contact_phone',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Адреса', 'contact_info'),
                'desc' => __('Приклад: 45 Park Avenue, New York', 'contact_info'),
                'id'   => 'contact_address',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Адреса електронної пошти', 'contact_info'),
                'desc' => __('Приклад: hello@sand.camp', 'contact_info'),
                'id'   => 'contact_email',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Географічна широта', 'contact_info'),
                'desc' => __('Приклад: 37.42242', 'contact_info'),
                'id'   => 'contact_latitude',
                'type' => 'text',
            ];

            $options[] = [
                'name' => __('Географічна довгота', 'contact_info'),
                'desc' => __('Приклад: -122.08585', 'contact_info'),
                'id'   => 'contact_longitude',
                'type' => 'text',
            ];


            return $options;
        }

        function log($item)
        {
            ob_start();
            var_dump($item);
            $cont = ob_get_contents();
            ob_end_clean();
            file_put_contents(ABSPATH . 'system.log', $cont, FILE_APPEND);
        }
    }

    $theme_s4j = new Theme_S4J();

endif;