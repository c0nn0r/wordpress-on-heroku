<?php /*
Template Name: Portfolio
*/ 
?>
<?php global $is_portfolio; $is_portfolio = true; ?>	
<?php get_header(); ?>	
			<?php if(!is_front_page()):?>
			<div id="pageHead">
				<div class="inside">
				<h1><?php the_title(); ?></h1>
				<?php $page_description = get_post_meta($post->ID, "_ttrust_page_description", true); ?>
				<?php if ($page_description) : ?>
					<p><?php echo $page_description; ?></p>
				<?php endif; ?>	
				</div>			
			</div>
			<?php endif; ?>					
			
			<?php $p = (is_front_page()) ? $page : $paged;  ?>
			
			<div id="content" class="clearfix full">									
				<?php while (have_posts()) : the_post(); ?>											
					<?php the_content(); ?>														
				<?php endwhile; ?>				
				<?php wp_reset_query(); ?>
				<div id="projects" class="clearfix cItems">	
					
					<?php $page_skills = get_post_meta($post->ID, "_ttrust_portfolio_skills", true); ?>
					<?php $projects_per_page = of_get_option('ttrust_projects_per_page'); ?>
									
					<?php if ($page_skills) : // if there are a limited number of skills set ?>
						<?php 
							$skill_slugs = ""; $skills = explode(",", $page_skills);
							foreach ($skills as $skill) {				
								$skill = get_term_by( 'slug', trim(htmlentities($skill)), 'skill');
								if($skill) {
									$skill_slug = $skill->slug;	
									$skill_slugs .= $skill_slug . ",";					  				
								}		  
							} 
							$skill_slugs = substr($skill_slugs, 0, strlen($skill_slugs)-1);
						?>
						
						<?php query_posts( 'skill='.$skill_slugs.'&post_type=project&posts_per_page='.$projects_per_page.'&paged='.$p ); ?>	
					<?php else: ?>
						<?php query_posts( 'post_type=project&posts_per_page='.$projects_per_page.'&paged='.$p ); ?>	
					<?php endif; ?>									
					
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
							<div class="inside clearfix">
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
					<?php endwhile; ?>
					
				</div>
				
				<?php global $total_pages; $total_pages = ceil($wp_query->found_posts/$projects_per_page); ?>
				<?php $paged = $p; ?>
				<?php get_template_part( 'part-pagination'); ?>			
			</div>
	
<?php get_footer(); ?>