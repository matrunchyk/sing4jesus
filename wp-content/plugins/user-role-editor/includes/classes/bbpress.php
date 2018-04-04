<?php
/**
 * Support for bbPress user roles and capabilities
 * 
 * Project: User Role Editor WordPress plugin
 * Author: Vladimir Garagulya
 * Author email: vladimir@shinephp.com
 * Author URI: http://shinephp.com
 * 
 **/

class URE_bbPress {

    public static $instance = null;
    
    protected $lib = null;
    
    
    protected function __construct(URE_Lib $lib) {
        
        $this->lib = $lib;
        self::load_bbpress_files();
        
    }
    // end of __construct()
    
    
    static protected function load_bbpress_files() {
        
        if (function_exists('bbp_get_caps_for_role')) {
            return;
        }
        
        // extract bbPress installation directory
        $full_list = (array) get_option('active_plugins', array());
        if (is_multisite()) {
            $list1 = get_site_option('active_sitewide_plugins', array());
            if (!empty($list1)) {
                $full_list = array_merge($full_list, array_keys($list1));
            }
        }
        $plugin_path = '';
        foreach($full_list as $plugin_path) {
            $needle = DIRECTORY_SEPARATOR .'bbpress.php';
            if (strpos($plugin_path, $needle)!==false) {
                break;
            }
        }
        if (empty($plugin_path)) {
            return;
        }
        $bbpress_dir = ABSPATH .'wp-content/plugins/'. dirname($plugin_path) .'/';
        require_once($bbpress_dir .'includes/core/capabilities.php');
        
    }
    // end of load_bbpress_files()
    
    
    static public function get_instance(URE_Lib $lib) {

        if (!function_exists('is_plugin_active')) {
            require_once(ABSPATH .'/wp-admin/includes/plugin.php');
        }
        if (!is_plugin_active('bbpress/bbpress.php')) {  // bbPress plugin is not active
            return null;            
        }                
        
        if (self::$instance!==null) {
            return self::$instance;
        }        
        
        if ($lib->is_pro()) {
            self::$instance = new URE_bbPress_Pro($lib);
        } else {
            self::$instance = new URE_bbPress($lib);
        }
        
        return self::$instance;
    }
    // end of get_instance()
    

    /**
     * Exclude roles created by bbPress
     * 
     * @global array $wp_roles
     * @return array
     */
    public function get_roles() {
        
        global $wp_roles;
                        
        $roles = bbp_filter_blog_editable_roles($wp_roles->roles);  // exclude bbPress roles	         
        
        return $roles;
    }
    // end of get_roles()
    
    
    /**
     * Get full list user capabilities created by bbPress
     * 
     * @return array
     */   
    public function get_caps() {
        $caps = array_keys(bbp_get_caps_for_role(bbp_get_keymaster_role()));
        
        return $caps;
    }
    // end of get_caps()
    
    
    /**
     * Return empty array in order do not include bbPress roles into selectable lists: supported by Pro version only
     * @return array
     */
    public function get_bbp_editable_roles() {
        
        $all_bbp_roles = array();
        
        return $all_bbp_roles;        
    }
    // end of get_bbp_editable_roles()
    
    
    /**
     * Return bbPress roles found at $roles array. Used to exclude bbPress roles from processing as free version should not support them
     * 
     * @param array $roles
     * @return array
     */
    public function extract_bbp_roles($roles) {
                
        $all_bbp_roles = array_keys(bbp_get_dynamic_roles());
        $user_bbp_roles = array();
        foreach($roles as $role) {
            if (in_array($role, $all_bbp_roles)) {
                $user_bbp_roles[] = $role;                    
            }            
        }
        
        return $user_bbp_roles;        
    }
    // end of extract_bbp_roles()


}
// end of URE_bbPress class