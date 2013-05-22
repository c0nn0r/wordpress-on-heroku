<?php
  
// Load main options panel file  
if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

// Load Mr MetaBox 
if(!class_exists('mrMetaBox')) {
	define('MRMETABOX_URL', TEMPLATEPATH . '/admin/mr-meta-box/');
    require_once(MRMETABOX_URL . 'mr-meta-box.php');
}

// Enable translation
// Translations can be put in the /languages/ directory
load_theme_textdomain( 'themetrust', TEMPLATEPATH . '/languages' );

// Widgets
require_once (TEMPLATEPATH . '/admin/widgets.php');

// Mobile device detection
if( !function_exists('mobile_user_agent_switch') ){
	function is_mobile(){
		$device = '';
 
		if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
			$device = "ipad";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
			$device = "iphone";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
			$device = "blackberry";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
			$device = "android";
		}
 
		if( $device ) {
			return $device; 
		} return false; {
			return false;
		}
	}
}

//////////////////////////////////////////////////////////////
// Theme Header
/////////////////////////////////////////////////////////////
	
add_action('wp_enqueue_scripts', 'ttrust_scripts');

function ttrust_scripts() {	
	
	global $wp_query;
	global $post;
	global $is_portfolio;
	
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('superfish', get_bloginfo('template_url').'/js/superfish.js', array('jquery'), '1.4.8', true);
	
	wp_enqueue_style('superfish', get_bloginfo('template_url').'/css/superfish.css', false, '1.4.8', 'all' );
	
	if(is_active_widget(false,'','ttrust_flickr')) :	
    	wp_enqueue_script('flickrfeed', get_bloginfo('template_url').'/js/jflickrfeed.js', array('jquery'), '0.8', true);
	endif;
	
	if(is_active_widget(false,'','ttrust_twitter')) :	
    	wp_enqueue_script('jquery_twitter', get_bloginfo('template_url').'/js/jquery.twitter.js', array('jquery'), '1.5', true);
	endif;
	
	if(($is_portfolio && of_get_option('ttrust_infinite_projects_enabled')) || (is_blog() && of_get_option('ttrust_infinite_posts_enabled'))) :
		wp_enqueue_script('infinite_scroll', get_bloginfo('template_url').'/js/jquery.infinitescroll.min.js', array('jquery'), '2.0', true);	
	endif;
	
	wp_enqueue_script('debouncedresize', get_bloginfo('template_url').'/js/jquery.debouncedresize.js', array('jquery'), '1.8', true);
	wp_enqueue_script('imagesloaded', get_bloginfo('template_url').'/js/jquery.imagesloaded.min.js', array('jquery'), '2.1.1', true);
	wp_enqueue_script('actual', get_bloginfo('template_url').'/js/jquery.actual.min.js', array('jquery'), '1.8.13', true);		
	
	wp_enqueue_script('fitvids', get_bloginfo('template_url').'/js/jquery.fitvids.min.js', array('jquery'), '1.0', true);		
	
	wp_enqueue_style('slideshow', get_bloginfo('template_url').'/css/flexslider.css', false, '2.0', 'all' );
	wp_enqueue_script('slideshow', get_bloginfo('template_url').'/js/jquery.flexslider-min.js', array('jquery'), '1.8', true);
	
	wp_enqueue_script('tinynav', get_bloginfo('template_url').'/js/tinynav.min.js', array('jquery'), '1.05', true);	
	
	wp_enqueue_script('theme_trust_js', get_bloginfo('template_url').'/js/theme_trust.js', array('jquery'), '1.0', true);	
	
}

add_action('wp_head','ttrust_theme_head');

function ttrust_theme_head() { ?>
<meta name="generator" content="<?php global $ttrust_theme, $ttrust_version; echo $ttrust_theme.' '.$ttrust_version; ?>" />

<style type="text/css" media="screen">

<?php $slideshow_font = of_get_option('ttrust_slideshow_title_font'); ?>
<?php $heading_font = of_get_option('ttrust_heading_font'); ?>
<?php $sub_heading_font = of_get_option('ttrust_sub_heading_font'); ?>
<?php $body_font = of_get_option('ttrust_body_font'); ?>
<?php $menu_font = of_get_option('ttrust_menu_font'); ?>
<?php $home_message_font = of_get_option('ttrust_home_message_font'); ?>

<?php if ($slideshow_font) : ?>
	.home .slideshow h2 { font-family: '<?php echo $slideshow_font; ?>'; }
<?php endif; ?>

<?php if ($heading_font) : ?>
	h1, h2, h3, h4, h5, h6 { font-family: '<?php echo $heading_font; ?>'; }
<?php endif; ?>

<?php if ($sub_heading_font) : ?>
	.project .description p{ font-family: '<?php echo $sub_heading_font; ?>'; }
<?php endif; ?>

<?php if ($body_font) : ?>
	body { font-family: '<?php echo $body_font; ?>'; }
<?php endif; ?>

<?php if ($menu_font) : ?>
	#mainNav { font-family: '<?php echo $menu_font; ?>'; }
<?php endif; ?>

<?php if ($home_message_font) : ?>
	#homeMessage p { font-family: '<?php echo $home_message_font; ?>'; }
<?php endif; ?>

<?php if(of_get_option('ttrust_color_menu')) : ?>#mainNav ul a, #mainNav ul li.sfHover ul a { color: <?php echo(of_get_option('ttrust_color_menu')); ?> !important;	}<?php endif; ?>

<?php if(of_get_option('ttrust_color_menu_hover')) : ?>
	#mainNav ul li.current a,
	#mainNav ul li.current-cat a,
	#mainNav ul li.current_page_item a,
	#mainNav ul li.current-menu-item a,
	#mainNav ul li.current-post-ancestor a,	
	.single-post #mainNav ul li.current_page_parent a,
	#mainNav ul li.current-category-parent a,
	#mainNav ul li.current-category-ancestor a,
	#mainNav ul li.current-portfolio-ancestor a,
	#mainNav ul li.current-projects-ancestor a {
		color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;		
	}
	#mainNav ul li.sfHover a,
	#mainNav ul li a:hover,
	#mainNav ul li:hover {
		color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;	
	}
	#mainNav ul li.sfHover ul a:hover { color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;}	
<?php endif; ?>

<?php if(of_get_option('ttrust_color_link')) : ?>a { color: <?php echo(of_get_option('ttrust_color_link')); ?>;}<?php endif; ?>

<?php if(of_get_option('ttrust_color_link_hover')) : ?>a:hover {color: <?php echo(of_get_option('ttrust_color_link_hover')); ?>;}<?php endif; ?>

<?php if(of_get_option('ttrust_color_btn')) : ?>.button, #searchsubmit, input[type="submit"] {background-color: <?php echo(of_get_option('ttrust_color_btn')); ?> !important;}<?php endif; ?>


<?php if ( is_archive() ): ?> html {height: 101%;} <?php endif; ?>
<?php echo(of_get_option('ttrust_custom_css')); ?>


</style>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie8.css" type="text/css" media="screen" />
<![endif]-->

<?php echo "\n".of_get_option('ttrust_analytics')."\n"; ?>

<?php }

add_action('init', 'remheadlink');
function remheadlink() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}

//////////////////////////////////////////////////////////////
// Body Class
/////////////////////////////////////////////////////////////

function ttrust_body_classes($classes) {	
	
	$classes[] = of_get_option('ttrust_background');	
	return $classes;
}
add_filter('body_class','ttrust_body_classes');


//////////////////////////////////////////////////////////////
// is_blog function
/////////////////////////////////////////////////////////////

function is_blog() {
	global  $post;
	$posttype = get_post_type($post);
	return ( ((is_archive()) || (is_home()) ) && ( $posttype == 'post')  ) ? true : false;
}


//////////////////////////////////////////////////////////////
// Theme Footer
/////////////////////////////////////////////////////////////

add_action('wp_footer','ttrust_footer');

function ttrust_footer() {
	wp_reset_query();
	
	global $wp_query;
	global $post;
	global $is_portfolio;		
		
	if ( is_front_page() ) {
		include(TEMPLATEPATH . '/js/slideshow_home.php');
	}
		
	if ( $is_portfolio || false !== strpos($post->post_content, '[slideshow') ) {
		include(TEMPLATEPATH . '/js/slideshow.php');
	}
	
	if(($is_portfolio && of_get_option('ttrust_infinite_projects_enabled')) || (is_blog() && of_get_option('ttrust_infinite_posts_enabled'))) {	
		include(TEMPLATEPATH . '/js/infinite_scrolling.php');
	}	
}

//////////////////////////////////////////////////////////////
// Remove
/////////////////////////////////////////////////////////////

// #more from more-link
function ttrust_remove($content) {
	global $id;
	return str_replace('#more-'.$id.'"', '"', $content);
}
add_filter('the_content', 'ttrust_remove');


//////////////////////////////////////////////////////////////
// Custom Excerpt
/////////////////////////////////////////////////////////////

function excerpt_ellipsis($text) {
	return str_replace('[...]', '...', $text);
}
add_filter('the_excerpt', 'excerpt_ellipsis');

//////////////////////////////////////////////////////////////
// Pagination Styles
/////////////////////////////////////////////////////////////

add_action( 'wp_print_styles', 'ttrust_deregister_styles', 100 );
function ttrust_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
remove_action('wp_head', 'pagenavi_css');
remove_action('wp_print_styles', 'pagenavi_stylesheets');


//////////////////////////////////////////////////////////////
// Navigation Menus
/////////////////////////////////////////////////////////////

add_theme_support('menus');
register_nav_menu('main', 'Main Navigation Menu');

function default_nav() {
	echo '<ul class="sf-menu clearfix" >';					
		wp_list_pages('sort_column=menu_order&title_li='); 
	echo '</ul>';
}


//////////////////////////////////////////////////////////////
// Custom Background
/////////////////////////////////////////////////////////////

add_theme_support( 'custom-background');


//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

add_theme_support('post-thumbnails');

set_post_thumbnail_size(100, 100, true);
add_image_size('ttrust_post_thumb_big', 960, 260, true);
add_image_size('ttrust_post_thumb_small', 150, 150, true);
add_image_size('ttrust_post_thumb_tiny', 50, 50, true);


//////////////////////////////////////////////////////////////
// Button Shortcode
/////////////////////////////////////////////////////////////

function ttrust_button($a) {
	extract(shortcode_atts(array(
		'label' 	=> 'Button Text',
		'id' 	=> '1',
		'url'	=> '',
		'target' => '_parent',		
		'size'	=> '',
		'color'	=> '',		
		'ptag'	=> false
	), $a));
	
	$link = $url ? $url : get_permalink($id);
	$s = "";
	
	if($color) $s .= "background-color:".$color." !important;";
		
	
	if($ptag) :
		return  wpautop('<a href="'.$link.'" target="'.$target.'" style="'.$s.'" class="button '.$size.'">'.$label.'</a>');
	else :
		return '<a href="'.$link.'" target="'.$target.'" style="'.$s.'" class="button '.$size.'">'.$label.'</a>';
	endif;
}

add_shortcode('button', 'ttrust_button');

//////////////////////////////////////////////////////////////
// Column Shortcodes
/////////////////////////////////////////////////////////////

function ttrust_one_third( $atts, $content = null ) {
   return '<div class="one_third column">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'ttrust_one_third');

function ttrust_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'ttrust_one_third_last');

function ttrust_two_third( $atts, $content = null ) {
   return '<div class="two_third column">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'ttrust_two_third');

function ttrust_two_third_last( $atts, $content = null ) {
   return '<div class="two_third column last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'ttrust_two_third_last');

function ttrust_one_half( $atts, $content = null ) {
   return '<div class="one_half column">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'ttrust_one_half');

function ttrust_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'ttrust_one_half_last');

function ttrust_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth column">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'ttrust_one_fourth');

function ttrust_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'ttrust_one_fourth_last');

function ttrust_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth column">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'ttrust_three_fourth');

function ttrust_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth column last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'ttrust_three_fourth_last');

function ttrust_reformat($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'ttrust_reformat', 99);
add_filter('widget_text', 'ttrust_reformat', 99);


//////////////////////////////////////////////////////////////
// Slideshow Shortcode
/////////////////////////////////////////////////////////////

function ttrust_slideshow( $atts, $content = null ) {	
    $content = str_replace('<br />', '', $content);
	$content = preg_replace("/<a\b[^>]*>/", "", $content);
	$content = preg_replace("/<\/a>/", "", $content);
	$content = str_replace('<img', '<li><img', $content);
	$content = str_replace('/>', '/></li>', $content);
	return '<div class="flexslider"><ul class="slides">' . $content . '</ul></div>';
}
add_shortcode('slideshow', 'ttrust_slideshow');

//////////////////////////////////////////////////////////////
// Elastic Video
/////////////////////////////////////////////////////////////

function ttrust_elasticVideo( $atts, $content = null ) {    
	return '<div class="videoContainer">' . $content . '</div>';
}
add_shortcode('elastic-video', 'ttrust_elasticVideo');

//////////////////////////////////////////////////////////////
// Add conainers to all videos
/////////////////////////////////////////////////////////////

function add_video_containers($content) { 
	$content = str_replace('<object', '<div class="videoContainer"><object', $content);
	$content = str_replace('</object>', '</object></div>', $content);
	
	$content = str_replace('<embed', '<div class="videoContainer"><embed', $content);
	$content = str_replace('</embed>', '</embed></div>', $content);
	
	$content = str_replace('<iframe', '<div class="videoContainer"><iframe', $content);
	$content = str_replace('</iframe>', '</iframe></div>', $content);
	
	return $content;
}

add_action('the_content', 'add_video_containers');  


//////////////////////////////////////////////////////////////
// Custom More Link
/////////////////////////////////////////////////////////////

function more_link() {
	global $post;	
	$more_link = '<p class="moreLink"><a href="'.get_permalink().'" title="'.get_the_title().'">';
	$more_link .= '<span>'.__('Read More', 'themetrust').'</span>';
	$more_link .= '</a></p>';
	echo $more_link;	
}

//////////////////////////////////////////////////////////////
// Custom Sanitize for Theme Options
/////////////////////////////////////////////////////////////

add_action('admin_init','optionscheck_change_santiziation', 100);
 

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
 
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    
      $custom_allowedtags["script"] = array();
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}


//////////////////////////////////////////////////////////////
// Custom Post Types and Custom Taxonamies
/////////////////////////////////////////////////////////////

// Project post type
function register_projects() {	
	$labels = array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add New Project' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Project' ),
		'new_item' => __( 'New Project' ),
		'view' => __( 'View Project' ),
		'view_item' => __( 'View Project' ),
		'search_items' => __( 'Search Projects' ),
		'not_found' => __( 'No projects found' ),
		'not_found_in_trash' => __( 'No projects found in Trash' ),
		'parent' => __( 'Parent Project' ),
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,		
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'comments', 'revisions')
	); 	
	
	register_post_type( 'project' , $args );	
}


//Skill taxonomy
function register_skills() {
	$labels = array(
    	'name' => __( 'Skills' ),
    	'singular_name' => __( 'Skill' ),
    	'search_items' =>  __( 'Search Skills' ),
    	'all_items' => __( 'All Skills' ),
    	'parent_item' => __( 'Parent Skill' ),
    	'parent_item_colon' => __( 'Parent Skill:' ),
    	'edit_item' => __( 'Edit Skill' ),
    	'update_item' => __( 'Update Skill' ),
    	'add_new_item' => __( 'Add New Skill' ),
    	'new_item_name' => __( 'New Skill Name' )
  	); 	

  	register_taxonomy('skill','project',array(
    	'hierarchical' => false,
    	'labels' => $labels
  	));	
}


// Slide post type
function register_slides() {
	register_post_type( 'slide',
		array(
			'labels' => array(
				'name' => __( 'Slides', 'themetrust'),
				'menu_name' => __( 'Slides', 'themetrust'),
				'singular_name' => __( 'Slide', 'themetrust'),
				'all_items' => __( 'All Slides', 'themetrust'),
		        'add_new' => __( 'Add New', 'themetrust' ),
				'add_new_item' => __( 'Add New Slide', 'themetrust' ),
				'edit_item' => __( 'Edit Slide', 'themetrust' ),
				'new_item' => __( 'New Slide', 'themetrust' ),
				'view_item' => __( 'View Slide', 'themetrust' ),
				'search_items' => __( 'Search Slides', 'themetrust' ),
				'not_found' => __( 'No slides found', 'themetrust' ),
				'not_found_in_trash' => __( 'No slides found in Trash', 'themetrust' )
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'menu_icon' => get_template_directory_uri(). '/images/image-empty.png', 
			'show_in_menu' => true,
			'show_in_nav_menus' => false,
			'menu_position ' => 20,
			'supports' => array( 'title', 'editor', 'revisions' ),
			'hierarchical' => false,
			'taxonomies' => array( 'section' ),
			'has_archive' => true,
			'rewrite' => 'slide'
		)
	);
}


function custom_flush_rules(){	
	//defines the post type so the rules can be flushed.
	register_slides();
	register_projects();
	register_skills();

	//and flush the rules.
	flush_rewrite_rules();	
}
add_action('after_switch_theme', 'custom_flush_rules');
add_action( 'init', 'register_projects' );
add_action( 'init', 'register_skills' );
add_action( 'init', 'register_slides' );




// List custom post type taxonomies

function ttrust_get_terms( $id = '' ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $post_taxonomies = array();
    $post_type = get_post_type( $id );
    $taxonomies = get_object_taxonomies( $post_type , 'names' );

    foreach ( $taxonomies as $taxonomy ) {
      $term_links = array();
      $terms = get_the_terms( $id, $taxonomy );

      if ( is_wp_error( $terms ) )
        return $terms;

      if ( $terms ) {
        foreach ( $terms as $term ) {
          $link = get_term_link( $term, $taxonomy );
          if ( is_wp_error( $link ) )
            return $link;
          $term_links[] = '<li><span><a href="'.$link.'">' . $term->name . '</a></span></li>';
        }
      }

      $term_links = apply_filters( "term_links-$taxonomy" , $term_links );
      $post_terms[$taxonomy] = $term_links;
    }
    return $post_terms;
  } else {
    return false;
  }
}

function ttrust_get_terms_list( $id = '' , $echo = true ) {
  global $post;

  if ( empty( $id ) )
    $id = $post->ID;

  if ( !empty( $id ) ) {
    $my_terms = ttrust_get_terms( $id );
    if ( $my_terms ) {
      $my_taxonomies = array();
      foreach ( $my_terms as $taxonomy => $terms ) {
        $my_taxonomy = get_taxonomy( $taxonomy );
        if ( !empty( $terms ) ) $my_taxonomies[] = implode( $terms);
      }

      if ( !empty( $my_taxonomies ) ) {
	    $output = "";
        foreach ( $my_taxonomies as $my_taxonomy ) {
          $output .= $my_taxonomy . "\n";
        }        
      }

      if ( $echo )
        if(isset($output)) echo $output;
      else
        if(isset($output)) return $output;
    } else {
      return;
    }
  } else {
    return false;
  }
}



//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////

$prefix = "_ttrust_";
$text_alignment = array("center" => "Center", "left" => "Left", "right" => "Right");
$text_color = array("light" => "Light", "dark" => "Dark");
$bkg_repeat = array("repeat" => "Repeat", "no-repeat" => "No Repeat");

//Project options

$config = array(
    'id' => 'project_options', 
    'title' => 'Project Options',
    'prefix' => $prefix."project_",
    'postType' => array('project'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$project_options_meta_box = new mrMetaBox($config);

$project_options_meta_box->addField(array(
	'type' => 'Textarea',
	'id' => 'description', 
	'label' => __('Description: ','themetrust')
));

$project_options_meta_box->addField(array(
	'type' => 'Select', 
	'id' => "head_alignment", 
	'label' => __('Header Alignment: ','themetrust'),
	'default' => '', 
	'options' => $text_alignment
));

$project_options_meta_box->addField(array(
	'type' => 'Image', 
	'id' => 'background_image', 
	'label' => __('Background Image: ','themetrust'),
	'attachToPost' => false 
));

$project_options_meta_box->addField(array(
	'type' => 'Checkbox', 
	'id' => 'repeat_background', 
	'label' => __('Repeat Background Image: ','themetrust')
));

$project_options_meta_box->addField(array(
	'type' => 'Checkbox', 
	'id' => 'bkg_is_dark', 
	'label' => __('Background is Dark: ','themetrust')
));

$project_options_meta_box->addField(array(
	'type' => 'Color', 
	'id' => 'background_color', 
	'label' => __('Background Color: ','themetrust')
));

//Page Options

$config = array(
    'id' => 'page_options', 
    'title' => 'Page Options',
    'prefix' => $prefix."page_",
    'postType' => array('page'),
    'context' => 'side', 
    'priority' => 'default', 
    'usage' => 'theme', 
    'showInColumns' => false 
);

$page_options_meta_box = new mrMetaBox($config);

$page_options_meta_box->addField(array(
	'type' => 'Textarea',
	'id' => 'description', 
	'label' => __('Page Description: ','themetrust')
));

//Portfolio Options

$config = array(
    'id' => 'portfolio_options', 
    'title' => 'Portfolio Page Options',
    'prefix' => $prefix."portfolio_",
    'postType' => array('page'),
    'context' => 'side', 
    'priority' => 'default', 
    'usage' => 'theme', 
    'showInColumns' => false 
);

$portfolio_options_meta_box = new mrMetaBox($config);

$portfolio_options_meta_box->addField(array(
	'type' => 'Textarea',
	'id' => 'skills', 
	'label' => __('Skills: ','themetrust')
));

//Slide options

$config = array(
    'id' => 'slide_options', 
    'title' => 'Slide Options',
    'prefix' => $prefix."slide_",
    'postType' => array('slide'),
    'context' => 'normal', 
    'priority' => 'high', 
    'usage' => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
	'type' => 'Checkbox', 
	'id' => 'show_text', 
	'label' => __('Show Text: ','themetrust')
));

$slide_options_meta_box->addField(array(
	'type' => 'Textarea',
	'id' => 'description', 
	'label' => __('Description: ','themetrust')
));

$slide_options_meta_box->addField(array(
	'type' => 'Select', 
	'id' => "text_alignment", 
	'label' => __('Text Alignment: ','themetrust'),
	'default' => '', 
	'options' => $text_alignment
));



//////////////////////////////////////////////////////////////
// Comments
/////////////////////////////////////////////////////////////

function ttrust_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>		
	<li id="li-comment-<?php comment_ID() ?>">		
		
		<div class="comment <?php echo get_comment_type(); ?>" id="comment-<?php comment_ID() ?>">						
			
			<?php echo get_avatar($comment,'75',get_bloginfo('template_url').'/images/default_avatar.png'); ?>			
   	   			
   	   		<h5><?php comment_author_link(); ?></h5>
			<span class="date"><?php comment_date(); ?></span>
				
			<?php if ($comment->comment_approved == '0') : ?>
				<p><span class="message"><?php _e('Your comment is awaiting moderation.', 'themetrust'); ?></span></p>
			<?php endif; ?>
				
			<?php comment_text() ?>				
				
			<?php
			if(get_comment_type() != "trackback")
				comment_reply_link(array_merge( $args, array('add_below' => 'comment','reply_text' => '<span>'. __('Reply', 'themetrust') .'</span>', 'login_text' => '<span>'. __('Log in to reply', 'themetrust') .'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'])))
			
			?>
				
		</div><!-- end comment -->
			
<?php
}

function ttrust_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<li class="comment" id="comment-<?php comment_ID() ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php
}

//////////////////////////////////////////////////////////////
// Pagination function // http://goo.gl/njhZ
/////////////////////////////////////////////////////////////

function kriesi_pagination($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination clearfix'><div class='inside'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>\n";
     }
}

?>