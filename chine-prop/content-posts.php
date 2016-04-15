<?php 
/**
 * @package Modality
 *
 */ 
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$blog_posts_home_image = $modality_theme_options['blog_posts_home_image'];
$blog_posts_top_image = $modality_theme_options['blog_posts_top_image'];

if ( have_posts() ) : ?>
<div class="clear"></div>
<?php if ($blog_posts_home_image != '') { ?>
	<div class="home-blog" style="background: url(<?php echo esc_url($blog_posts_home_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">	
<?php } else { ?>
	<div class="home-blog">	
	<div class="slider">
		<?php news_unslider_slider();?>
		</div>
<?php } 
	 if ($blog_posts_top_image !='') { ?>
	
	
	<?php } else { ?>
		
		
<?php } ?>
		  
			<div>
				
			</div>
		</div>
	<div class="content-posts-wrap">
		<div class="standard-posts-wrapper">
			<div class="posts-wrapper">	
				<div id="post-body">
					<div class="post-single">
					 <?php // Start the Loop.
					while ( have_posts() ) : the_post();					
						get_template_part('content');		
					endwhile; 		
					if ($modality_theme_options['simple_paginaton'] == '1') {			
						// Displays links for next and previous pages. ?>
						<div class="clear"></div>
						<div class="simple-pagination">
							<?php posts_nav_link();	?>
						</div> <?php
					} else {		
						// Previous/next post navigation. ?>
						<div class="clear"></div> <?php 
						modality_paging_nav();		
					} ?>
					</div>
				</div><!--posts-body-->
			</div><!--posts-wrapper-->
		</div><!--standard-posts-wrapper-->
		
	<?php 
else: ?>
	<?php get_template_part( 'content', 'none' );
endif; ?>
</div>