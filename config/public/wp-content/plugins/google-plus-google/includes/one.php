<?php
/*
 * register with hook 'gp_one'
 */
add_action('wp_footer', 'gp_one_script');
add_filter('the_content', 'gp_one_hook');

function gp_one($url = false, $size = false, $counter = true)
{
    echo get_gp_one($url, $size, $counter);
    
}

function get_gp_one($url = false, $size = false, $counter = true)
{
    $css = '';
    if (!is_admin())
        $css = '<div style="margin: 5px 5px 0px 0; float:left;">';
    
    $output = $css . '<g:plusone';
    
    if (!$counter)
        $output .= ' count="false"';
    
    if ($size)
        $output .= ' size="' . $size . '"';
    
    if (!$url)
        $url = get_permalink();
    
    $css = '';
    if (!is_admin())
        $css = '</div><!-- .gp-one -->';
    
    $output .= ' href="' . $url . '"></g:plusone>' . $css;
    
    return $output;
    
}

function gp_one_script()
{
    if (!GP_ONE)
        return;
    
    extract(GP::unserial(GP_ONE));
    if (!$position)
        return;
    
    echo "<script type=\"text/javascript\">
	
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>";
}


function gp_one_hook($content)
{
    if (!GP_ONE)
        return $content;
    
    extract(GP::unserial(GP_ONE));
    if (!$position)
        return $content;    
   
    if (is_single() && $post || is_page() && $page || is_attachment() && $attachment || is_home() && $home) {
        $output = get_gp_one('', $size);
        if (!$counter)
            $output = get_gp_one('', $size, false);
        
    }
    
    switch ($position) {
        case 'before':
            return $output . $content;
            break;
        case 'after':
            return $content . $output;
            break;
        case 'both':
            return $output . $content . $output;
            break;
    }
    
    return $content;
    
}


?>