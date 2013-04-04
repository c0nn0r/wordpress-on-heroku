<?php
/*
  Plugin Name: Google Plus Badge
  Plugin URI: http://wp-extend.info/google-plus-badge/
  Description: Google Plus Badge for Google+ Pages.
  Author: Retio
  Author URI: http://mateuszlerczak.com
  Version: 1.3.1
  Text Domain: GPB
  Domain Path: /lang/
 */

    global $wp_version;  

    if (version_compare($wp_version, "3.0", "<"))  
        exit(_e('"Google Plus Badge" works on WP 3.0+'));  

    require_once 'define.php';
    require_once 'google-plus-badge-admin.php';
    require_once 'google-plus-badge-functions.php';

    $options = get_option("GPB_Settings");
    if ($options['pageID']) {
        add_action('init', 'RetioSlider_CSS');
        add_action('init', 'RetioSlider_JS');
        add_filter('wp_head', 'GPB_HeaderInit', 2000);
        add_action('wp_footer', 'GPB_Badge');
    }
    
    load_plugin_textdomain('GPB', null, GPB_DIR . '/lang/');