<?php
define('GPB_ID', 'Google-Plus-Badge');
define('GPB_NAME', 'Google Plus Badge');
define('GPB_VERSION', '1.3.1');
define('GPB_AUTHOR', 'Mateusz "Retio" Lerczak');

define('GPB_DIR', basename(dirname(__FILE__)));
define('GPB_IMAGE_DIR', WP_PLUGIN_DIR. '/' . GPB_DIR . '/img/');
define('GPB_IMAGE_URL', WP_PLUGIN_URL. '/' . GPB_DIR . '/img/');

define('GPB_MAIN_FILE', GPB_DIR.'.php');
define('GPB_PLUGIN_URL', WP_PLUGIN_URL . '/' . GPB_DIR . '/');

define('GPB_GP_URL', 'https://plus.google.com/116820438831110052424');
define('GPB_FB_URL', 'https://www.facebook.com/WP.Extend');
define('GPB_URL', 'http://wp-extend.info/plugins/google/google-plus-badge/');

$GPB_DefaultOptions = array(
    'pageID'                => '',
    'badge_lang'            => (WPLANG == 'pl_PL') ? 'pl' : 'en_US',
    'badge_size'            => 'badge',
    
    'border_color'          => '#ca3e2e',
    
    'position'              => 'right',
    'left_position'         => 50,
    'top_position'          => 100,
    'logo_position'         => 0,
    'action'                => 'hover',
    'icon'                  => 'gplus-32.png',
    'open_time'             => 500,
    'close_time'            => 500,
    'start_opacity'         => 75,
    'open_opacity'          => 100,
    'close_opacity'         => 75,
);

$GPB_StringValParams = array(
    'action',
    'direction'
);

$GPB_IconsArray = array(
    'gplus-64.png',
    'gplus-32.png',
    'gplus-16.png',
    'left.png',
    'right.png',
    'top.png',
    'bottom.png',
    'left2.png',
    'right2.png',
    'top2.png',
    'bottom2.png',
    'sngp-icon1.png',
    'sngp-icon2.png',
    'sngp-icon3.png',
    'sngp-icon4.png',
    'sngp-icon5.png',
    'sngp-icon6.png',
    'sngp-icon7.png',
    'sngp-icon8.png',
);

$GPB_buttonLangs = array(
    'ar' => 'العربية',
    'bg' => 'български',
    'ca' => 'català',
    'zh-CN' => '中文 ‏（簡体）',
    'zh-TW' => '中文 ‏（繁體）',
    'hr' => 'hrvatski',
    'cs' => 'čeština',
    'da' => 'dansk',
    'nl' => 'Nederlands',
    'en-US' => 'English ‏(US)',
    'en-GB' => 'English ‏(UK)',
    'et' => 'eesti',
    'fil' => 'Filipino',
    'fi' => 'suomi',
    'fr' => 'français',
    'de' => 'Deutsch',
    'el' => 'Ελληνικά',
    'iw' => 'עברית',
    'hi' => 'हिन्दी',
    'hu' => 'magyar',
    'id' => 'Bahasa Indonesia',
    'it' => 'italiano',
    'ja' => '日本語',
    'ko' => '한국어',
    'lv' => 'latviešu',
    'lt' => 'lietuvių',
    'ms' => 'Bahasa Melayu',
    'no' => 'norsk',
    'fa' => 'فارسی',
    'pl' => 'polski',
    'pt-BR' => 'português ‏(Brasil)',
    'pt-PT' => 'Português ‏(Portugal)',
    'ro' => 'română',
    'ru' => 'русский',
    'sr' => 'српски',
    'sv' => 'svenska',
    'sk' => 'slovenský',
    'sl' => 'slovenščina',
    'es' => 'español',
    'es-419' => 'español ‏(Latinoamérica y el Caribe)',
    'th' => 'ไทย',
    'tr' => 'Türkçe',
    'uk' => 'українська',
    'vi' => 'Tiếng Việt'
);