<?php get_header(); ?>

<?php $show_full_post = of_get_option('ttrust_post_show_full'); ?>
<?php $blog_full_width = of_get_option('ttrust_post_full_width'); ?>
<?php $bw = ($blog_full_width) ? "full" : "twoThirds"; ?>


		<div id="pageHead">
			<div class="inside">
				<?php global $wp_query; $current_author = $wp_query->get_queried_object(); ?>
				<h1><?php _e('Author:', 'themetrust'); ?> <?php echo $current_author->display_name; ?></h1>
			</div>
		</div>
		
		<div class="wrap">
		<div class="middle clearfix">				 
		<div id="content" class="<?php echo $bw; ?> clearfix">	
			<?php while (have_posts()) : the_post(); ?>			    
				<div <?php post_class(); ?>>					
					<div class="inside">															
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>
						<div class="meta clearfix">
							<?php $post_show_author = of_get_option('ttrust_post_show_author'); ?>
							<?php $post_show_date = of_get_option('ttrust_post_show_date'); ?>
							<?php $post_show_category = of_get_option('ttrust_post_show_category'); ?>
							<?php $post_show_comments = of_get_option('ttrust_post_show_comments'); ?>
										
							<?php if($post_show_author || $post_show_date || $post_show_category){ _e('Posted ', 'themetrust'); } ?>					
							<?php if($post_show_author) { _e('by ', 'themetrust'); the_author_posts_link(); }?>
							<?php if($post_show_date) { _e('on', 'themetrust'); ?> <?php the_time( 'M j, Y' ); } ?>
							<?php if($post_show_category) { _e('in', 'themetrust'); ?> <?php the_category(', '); } ?>
							<?php if(($post_show_author || $post_show_date || $post_show_category) && $post_show_comments){ echo " | "; } ?>
							
							<?php if($post_show_comments) : ?>
								<a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'themetrust'), __('One Comment', 'themetrust'), __('% Comments', 'themetrust')); ?></a>
							<?php endif; ?>
						</div>						
						
						<?php if($show_full_post) : ?>
							<?php the_content(); ?>
						<?php else: ?>

							<?php if(has_post_thumbnail()) : ?>
								<?php if(of_get_option('ttrust_post_featured_img_size')=="large") : ?>											
				    				<a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_post_thumbnail('ttrust_post_thumb_big', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>		    	
								<?php else: ?>
									<a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_post_thumbnail('ttrust_post_thumb_small', array('class' => 'postThumb alignleft', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
								<?php endif; ?>
							<?php endif; ?>			
							<?php the_excerpt(); ?>
							<?php more_link(); ?>					

						<?php endif; ?>
					</div>																				
			    </div>				
			
			<?php endwhile; ?>
			
			<?php global $total_pages; $total_pages = floor($wp_query->found_posts/get_option('posts_per_page')); ?>
			<?php $paged = get_query_var('paged'); ?>
			<?php get_template_part( 'part-pagination'); ?>
					    	
		</div>		
		<?php if($bw == "twoThirds") get_sidebar(); ?>		
		</div>
		</div>	
<?php get_footer(); ?>