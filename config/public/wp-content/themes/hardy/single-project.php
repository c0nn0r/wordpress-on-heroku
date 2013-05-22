<?php get_header(); ?>	
			

			<div id="content" class="clearfix full">									
				
				<div id="projects" class="clearfix cItems">				
					<?php $projects_per_page = of_get_option('ttrust_projects_per_page'); ?>								
					
					<?php  while (have_posts()) : the_post(); ?>
						
							<?php
							$project_repeat_bkg = get_post_meta($post->ID, "_ttrust_project_repeat_background", true);
							$project_bkg_is_dark = get_post_meta($post->ID, "_ttrust_project_bkg_is_dark", true);
							$project_description = get_post_meta($post->ID, "_ttrust_project_description", true);
							$project_head_alignment = get_post_meta($post->ID, "_ttrust_project_head_alignment", true);
							$project_background_color = get_post_meta($post->ID, "_ttrust_project_background_color", true);
							$project_background_img = wp_get_attachment_image_src(get_post_meta($post->ID, "_ttrust_project_background_image", true), 'full');
							$project_background_img = $project_background_img[0];
							$p_styles = "";
							$p_class = "";
							if($project_background_img){
								$p_styles .= "background-image: url(".$project_background_img.");";
							}
							if(!$project_repeat_bkg){
								$p_styles .= "background-repeat: no-repeat;";
								$p_styles .= "background-position: center center;";
								$p_styles .= "background-size: cover;";			
							}
							if($project_background_color){
								$p_styles .= "background-color: ".$project_background_color.";";
							}
							if($project_bkg_is_dark){
								$p_class .= "darkBkg ";
							}
							$p_class .= $project_head_alignment; 
							?>
												
						<div <?php post_class($p_class); ?> id="project-<?php echo $post->post_name;?>" style="<?php echo $p_styles;?>">
							<div class="inside">
								<span class="topLine"></span>
								<div class="head">
								<?php if(of_get_option('ttrust_link_projects')) : ?>															
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>
								<?php else: ?>	
									<h2><?php the_title(); ?></h2>
								<?php endif; ?>	
								<div class="description"><p><?php echo $project_description; ?></p></div>									
								</div>				
								<?php the_content(); ?>
							</div>																																
						</div>
						<?php comments_template('', true); ?>
					<?php endwhile; ?>
					
				</div>				
				
			</div>
	
<?php get_footer(); ?>