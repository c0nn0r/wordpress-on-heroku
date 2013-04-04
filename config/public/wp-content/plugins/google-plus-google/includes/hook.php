<?php

/*
 * register with hook 'gp_admin_head'
 */
function gp_admin_head()
{
    echo '<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>';
    
}

add_action('admin_head', 'gp_admin_head');

/*
 * register with hook 'gp_actions'
 */

function gp_actions($links, $file)
{
    if ($file == 'google-plus-google/gp.php') {
        $settings_link = '<a href="admin.php?page=gp_dashboard">' . __("Settings", "Google Plus") . '</a>';
        array_unshift($links, $settings_link);
    } //$file == $this_plugin
    return $links;
}
add_filter('plugin_action_links', 'gp_actions', 10, 2);

/*
 * register with hook 'gp_admin_menu'
 */
add_action('admin_menu', 'gp_admin_menu');
function gp_admin_menu()
{
    add_menu_page('GP Dashboard', 'GP Dashboard', 0, 'gp_dashboard', 'gp_dashboard', GP_URL . '/img/admin-menu.png', 1);
    add_submenu_page('gp_dashboard', 'GP One', 'GP One', 0, 'gp_one', 'gp_one_settings');
    
}
require_once GP_DIR . '/includes/admin.php';



/*
 * register with hook 'widgets_init'
 */
add_action('widgets_init', 'gp_widgets');
function gp_widgets()
{
    register_widget('gp_profile_widget');
   // register_widget('gp_circles_widget');
   // register_widget('gp_circlers_widget');
    register_widget('gp_stream_widget');
}


/*
 * register with hook 'wp_print_styles'
 */
add_action('wp_print_styles', 'gp_stylesheet');
function gp_stylesheet()
{
    wp_register_style('gp', GP_URL . '/style.css');
    wp_enqueue_style('gp');
    
}
require_once GP_DIR . '/includes/widget.php';

?>