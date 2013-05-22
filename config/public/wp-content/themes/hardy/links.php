<?php get_header(); ?>
		<div id="pageHead">
			<div class="inside">
			<h1><?php _e('Links', 'themetrust'); ?></h1>
			</div>
		</div>
		
		<div class="wrap">
		<div class="middle clearfix">				 
			<div id="content" class="twoThirds clearfix">			    
				<div class="post">					
					<ul>
						<?php get_links_list(); ?>
					</ul>				
				</div>						    	
			</div>	
		</div>	
		</div>		
		<?php get_sidebar(); ?>	
<?php get_footer(); ?>
