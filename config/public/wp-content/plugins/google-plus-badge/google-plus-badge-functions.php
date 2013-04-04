<?php

    if (!function_exists('GPB_ScriptInit')) {
        function GPB_ScriptInit() {
            $jsReady = GPB_JSReady();
            $html .= '<script type="text/javascript">'."\n";
            $html .= "  jQuery(document).ready(function(){jQuery('.".GPB_ID."').retioSlider({".$jsReady."});});\n";
            $html .= '</script>'."\n";
            return $html;
        }
    }

    if (!function_exists('GPB_HeaderInit')) {
        function GPB_HeaderInit() {
            global $GPB_DefaultOptions;

            $options = get_option("GPB_Settings");
            if (!$options)
                $options = $GPB_DefaultOptions;   
            
            $html  = '<!-- '.GPB_NAME.' '.GPB_VERSION.' START -->'."\n";
            $html .= '<link href="https://plus.google.com/'.$options['pageID'].'" rel="publisher" />'."\n";
            $html .= '<script type="text/javascript">'."\n";
            $html .= 'window.___gcfg = {lang: \''.$options['badge_lang'].'\'};'."\n";
            $html .= '(function()'."\n";
            $html .= '{var po = document.createElement("script");'."\n";
            $html .= 'po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";'."\n";
            $html .= 'var s = document.getElementsByTagName("script")[0];'."\n";
            $html .= 's.parentNode.insertBefore(po, s);'."\n";
            $html .= '})();</script>'."\n";
            $html .= '<!-- '.GPB_NAME.' '.GPB_VERSION.' END -->'."\n";
            echo $html;
        }
    }
    
    if (!function_exists('GPB_Footer')) {
        function GPB_Footer() {
            return '<div class="sn-footer-url"><a href="'.GPB_URL.'" title="'.GPB_NAME.'">'.GPB_NAME.'</a></div>'."\n";
        }
    }

    if (!function_exists('GPB_Badge')) {
        function GPB_Badge() {
            global $GPB_DefaultOptions;

            $options = get_option("GPB_Settings");
            if (!$options)
                $options = $GPB_DefaultOptions;   

            
            $imageURL = GPB_IMAGE_URL . $options['icon'];
            list ($iWidth, $iHeight) = getimagesize(GPB_IMAGE_DIR . $options['icon']);
            list ($bWidth, $bHeight, $bMarginLeft) = GPB_BoxDimensions($options['badge_size'], $options['position']);
            
            
            $html  = '<!-- '.GPB_NAME.' '.GPB_VERSION.' START -->'."\n";
            $html .= GPB_ScriptInit();
            $html .= '<div class="'.GPB_ID.' slider-box">'."\n";
            $html .= '  <div class="slider-content" style="width:'.$bWidth.';height:'.$bHeight.';border-color:'.$options['border_color'].'">'."\n";
            $html .= '  <g:plus';
            if ($options['pageID'])
                $html .= ' href="https://plus.google.com/'.$options['pageID'].'"';
            if ($options['badge_size'])
                $html .= ' size="'.$options['badge_size'].'"';
            $html .= '></g:plus>'."\n";
            $html .=    GPB_Footer();
            $html .=    '</div>'."\n";
            $html .= '  <div class="slider-logo"><img src="'.$imageURL.'" width="'.$iWidth.'" height="'.$iHeight.'" /></div>'."\n";
            $html .= '</div>'."\n";
            $html .= '<!-- '.GPB_NAME.' '.GPB_VERSION.' END -->'."\n";
            echo $html;
        }
    }
    
    if (!function_exists('RetioSlider_CSS')) {
        function RetioSlider_CSS() {
            wp_register_style("GPB_CSS", GPB_PLUGIN_URL . 'css/retioSlider.css', null, GPB_VERSION);
            wp_enqueue_style('GPB_CSS');
        }
    }
    
    if (!function_exists('RetioSlider_JS')) {
        function RetioSlider_JS() {
            wp_enqueue_script('jquery');
            wp_register_script('GPB_JS', GPB_PLUGIN_URL . 'js/retioSlider.min.js');
            wp_enqueue_script('GPB_JS');
        }
    }
    

/**
 * Others func
 */
    function GPB_comma2dot($val) {
        $newVal = str_replace(',', '.', $val);
        return $newVal;
    }
    

    function GPB_JSReady() {
        global $GPB_DefaultOptions, $GPB_StringValParams;
        
        $options = get_option("GPB_Settings");
        if (!$options)
            $options = $GPB_DefaultOptions;    
        
        $params = array();
        $params['direction'] = $options['position'];
        switch ($params['direction']) {
            case 'left':
            case 'right':
                if ($options['top_position'] >= 0)
                    $params['topPosition'] = $options['top_position'];
            break;
            case 'top':
            case 'bottom':
                if ($options['left_position'] >= 0)
                    $params['leftPosition'] = $options['left_position'];
            break;
        }
        

        $params['startOpacity'] = GPB_comma2dot($options['start_opacity'] / 100);
        $params['openOpacity']  = GPB_comma2dot($options['open_opacity'] / 100);
        $params['closeOpacity'] = GPB_comma2dot($options['close_opacity'] / 100);
        

        $params['openTime']     = ($options['open_time'] >= 0) ? $options['open_time'] : 0;
        $params['closeTime']    = ($options['close_time'] >= 0) ? $options['close_time'] : 0;
        $params['action']       = $options['action'];
        $params['logoPosition'] = ($options['logo_position'] >= 0) ? $options['logo_position'] : 0;

        $p = '';
        foreach($params as $name => $value)
            $p .= (in_array($name, $GPB_StringValParams)) ? "'$name':'$value'," : "'$name':$value,";

        $p = (substr($p, -1) == ',') ? substr($p, 0, -1) : $p;
        return $p;
    }
    
    function GPB_BoxDimensions($size, $direction) {
        switch (true) {
            case ($size == 'badge'):
                $width  = 300;
                $height = 131; 
            break;
            case ($size == 'smallbadge'):
                $width  = 300;
                $height = 69; 
            break;
        }
        
        $width = $width . 'px';
        $height = $height . 'px';
        
        switch ($direction) {
            case 'left':
            case 'right':
                $height = 'auto';
            break;
            case 'top':
            case 'bottom':
                $width = 'auto';
            break;        
        }
        
        return array($width, $height);
    }