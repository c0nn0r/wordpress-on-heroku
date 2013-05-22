<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>		
		<div id="pageHead">
			<div class="inside">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
		
		<div class="wrap">
		<div class="middle clearfix">					 
			<div id="content" class="twoThirds clearfix">
				<h2><?php _e('Archives by Month:', 'themetrust'); ?></h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<h2><?php _e('Archives by Subject:', 'themetrust'); ?></h2>
				<ul>
					<?php wp_list_categories(); ?>
				</ul>			    	
			</div>
		</div>
		</div>	
		<?php get_sidebar(); ?>		
<?php get_footer(); ?>
