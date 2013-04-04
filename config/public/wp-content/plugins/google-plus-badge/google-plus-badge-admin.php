<?php
   
    if (!function_exists('GPB_AdminCSS')) {
        function GPB_AdminCSS() {
            wp_register_style("GPB_ColorPickerCSS", GPB_PLUGIN_URL . 'lib/colorpicker/css/colorpicker.css', null, GPB_VERSION);
            wp_enqueue_style('GPB_ColorPickerCSS');
            wp_register_style("GPB_AdminCSS", GPB_PLUGIN_URL . 'css/admin.css', null, GPB_VERSION);
            wp_enqueue_style('GPB_AdminCSS');
        }
    }
   
    if (!function_exists('GPB_AdminJS')) {
        function GPB_AdminJS() {
            wp_enqueue_script('jquery');
            
            wp_register_script('GPB_ColorPickerJS', GPB_PLUGIN_URL . 'lib/colorpicker/js/colorpicker.js');
            wp_enqueue_script('GPB_ColorPickerJS');
            
            wp_register_script('GPB_AdminJS', GPB_PLUGIN_URL . 'js/admin.js');
            wp_enqueue_script('GPB_AdminJS');
        }
    }
    
    function GPB_PluginSettings($action_links) {
        $settings_link = '<a href="options-general.php?page='.GPB_ID.'">' . _e('Settings', 'SNGP') . '</a>';
        array_unshift($action_links, $settings_link);

        return $action_links;
    }
    
    if (!function_exists('GPB_MenuOptions')) {
        function GPB_MenuOptions() {
            add_options_page(GPB_NAME, GPB_NAME, 'manage_options', GPB_ID, 'GPB_SettingsPage');
        }
    }
    

    if (!function_exists('GPB_SettingsPage')) {

        function GPB_SettingsPage() {
            global $GPB_IconsArray, $GPB_DefaultOptions, $GPB_buttonLangs;
            $options = get_option("GPB_Settings");
            if (!is_array($options))
                $options = $GPB_DefaultOptions;

            if (isset($_POST['GPB_action']) && !empty($_POST['GPB_action'])) {
                switch ($_POST['GPB_action']) {
                    case 'slider':
                        $options['position']            = strip_tags(stripslashes($_POST['position']));
                        $options['left_position']       = intval($_POST['left_position']);
                        $options['top_position']        = intval($_POST['top_position']);
                        $options['logo_position']       = intval($_POST['logo_position']);
                        $options['action']              = strip_tags(stripslashes($_POST['action']));
                        $options['icon']                = strip_tags(stripslashes($_POST['icon']));
                        
                        $options['border_color']        = strip_tags(stripslashes($_POST['border_color']));
                        
                        $options['start_opacity']       = intval($_POST['start_opacity']);
                        $options['open_opacity']        = intval($_POST['open_opacity']);
                        $options['close_opacity']       = intval($_POST['close_opacity']);
                        
                        $options['open_time']           = intval($_POST['open_time']);
                        $options['close_time']          = intval($_POST['close_time']);
                    break;
                    case 'primary':
                        $options['pageID']              = (is_numeric($_POST['pageID'])) ? $_POST['pageID'] : 0;
                        $options['badge_size']          = strip_tags(stripslashes($_POST['badge_size']));
                        $options['badge_lang']          = (array_key_exists($_POST['badge_lang'], $GPB_buttonLangs)) ? $_POST['badge_lang'] : 'en_US';
                    break;
                }
                update_option("GPB_Settings", $options);
            }
            
            $border_color           = $options['border_color'];
            
            $pageID                 = $options['pageID'];
            $badge_lang             = htmlspecialchars($options['badge_lang'], ENT_QUOTES);
            $badge_size             = htmlspecialchars($options['badge_size'], ENT_QUOTES);
            
            $availableLanguages     = $GPB_buttonLangs;
            
            $css_styles     = $options['css_styles'];
            
            $position       = $options['position'];
            $top_position   = $options['top_position'];
            $left_position  = $options['left_position'];
            $logo_position  = $options['logo_position'];
            
            $open_time      = $options['open_time'];
            $close_time     = $options['close_time'];
            
            $start_opacity  = $options['start_opacity'];
            $open_opacity   = $options['open_opacity'];
            $close_opacity  = $options['close_opacity'];
            
            $action         = $options['action'];
            $icon           = $options['icon'];
            
            require_once 'admin/main.php';
        }

    }
    add_action('admin_menu', 'GPB_MenuOptions');
    add_action('admin_init', 'GPB_AdminCSS');
    add_action('admin_init', 'GPB_AdminJS');