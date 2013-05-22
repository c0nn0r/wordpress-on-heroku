<?php $num_pages = $wp_query->max_num_pages; if($num_pages > 1) : ?>	
<?php global $is_portfolio; ?>
<?php 
if($is_portfolio) :
	$infinite_scrolling = of_get_option('ttrust_infinite_projects_enabled');	
else :
	$infinite_scrolling = of_get_option('ttrust_infinite_posts_enabled'); 
endif;
?>

<?php if($infinite_scrolling) : ?>
	<div class="infscrBtn button"><span>Load More</span></div>
	<div class="pagination clearfix hidden">	
		<p class="pagination-next">
	    	<?php next_posts_link('&larr; Older entries'); ?>
		</p>
		<p class="pagination-prev">
	 		<?php previous_posts_link('Newer entries &rarr;'); ?>
		</p>
	</div><!-- end pagination -->
<?php else: ?>
	<?php kriesi_pagination(); ?>
<?php endif; ?>

<?php endif; // endif num_pages ?>