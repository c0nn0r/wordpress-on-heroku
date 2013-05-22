<?php
query_posts( array(
	'ignore_sticky_posts' => 1,
	'posts_per_page' => 20,
	'post_type' => 'slide'
));
?>
<?php if(have_posts()) :?>
<div class="slideshow">
			
	<div class="flexslider">		
		<ul class="slides">
			<?php $i = 1; while (have_posts()) : the_post(); ?>
			<?php
			//Get slide options
			$slide_description = get_post_meta($post->ID, "_ttrust_slide_description", true);					
			$slide_show_text = get_post_meta($post->ID, "_ttrust_slide_show_text", true);
			$slide_text_alignment = get_post_meta($post->ID, "_ttrust_slide_text_alignment", true);
			?>					
		
			<li id="slide<?php echo $i; ?>">				
				<?php the_content(); ?>				
				<?php if($slide_show_text) : ?>				
				<div class="details <?php echo $slide_text_alignment; ?>">
					<div class="box">
						<div class="inside">
							<div class="text">
								<h2><span><?php the_title(); ?></span></h2>
							<?php echo wpautop(do_shortcode($slide_description)); ?>
						</div>
						</div>
					</div>					
				</div>
				<?php endif; ?>				
			</li>		
			
			<?php $i++; ?>			
		
			<?php endwhile; ?>
		</ul>
	</div>	
	
	
</div>
<?php endif; ?>
<?php wp_reset_query();?>






