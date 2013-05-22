<?php get_header(); ?>

	<div id="pageHead">
		<div class="inside">
		<h1><?php _e('Search Results', 'themetrust'); ?></h1>
		</div>
	</div>
	<div class="wrap">
	<div class="middle clearfix">				 
	<div id="content" class="twoThirds clearfix">
		<div id="posts" class="cItems">
		<?php $c=0; $post_count = $wp_query->post_count; ?>	
		<?php while (have_posts()) : the_post(); ?>
			<?php $c++; ?>				
			<div <?php post_class('post'); ?> >																				
				<div class="inside">
					<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>	
					<?php the_excerpt('',TRUE); ?>					
				</div>																									
			</div>				
			
		<?php endwhile; ?>
		</div>
		<?php get_template_part( 'part-pagination'); ?>		    	
	</div>
	<?php get_sidebar(); ?>	
	</div>
	</div>	
	
	
<?php get_footer(); ?>