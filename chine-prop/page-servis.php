<style>
    .from-blog {
    padding: 50px 8px !important;
    }
    a.btn.btn-default.my_butt{
        display:none;

    }
    .page_img {
        width: 100%;
    }
    .sohranim_vashu_sredstva {
        width: 100%;
        height: auto;
    }
    .from_page_servis {
        border-top: 1px solid rgba(160, 160, 159, 1);
        border-bottom: 1px solid rgba(160, 160, 159, 1);
    }
    
    .post-single {
	width: 100% !important;
	float: right;
	padding-right: 15%;
	padding-left: 15%;
	text-align: center;
    }

    .banner{
        position: absolute;
        top: 0px;
        width: 1351px;
        height: 275px !important;
        overflow: hidden;
        clip: rect(0px 1351px 275px -186px);
        background-color: rgb(255, 255, 255);
        background: url("../wp-content/themes/chine-prop/images/page_service/page_service.png") 50% 0px / cover no-repeat fixed !important;
        opacity: 1;
        text-align: left !important;



    }
    .from-blog{
        margin-bottom: -25px;
    }

    .small_text{
        display:none;
    }

    .big_text{
        font: normal normal normal 56px/1.4em avenir-lt-w01_35-light1475496,sans-serif !important;
        font-weight: 100 !important;
        padding-top: 7% !important;
        padding-left: 14%;
        letter-spacing: 0.05em;
    }

    .cont{
        width:100%;
    }

    .page_service{
        padding-left:15%;
        padding-right:15%;
        padding-top:5%;
    }
    .page_title p {
        font: normal normal normal 20px/1.4em avenir-lt-w01_35-light1475496,sans-serif;
        color: #2F2E2E;

    }
    .page_title {
        padding-top: 3%;
    }
    .page_text {
        position: relative;
        left: 3%;
        font: normal normal normal 14px/1.4em avenir-lt-w01_35-light1475496,sans-serif;
        color: #2F2E2E;
    }

    @media screen and (max-width: 1000px){
        a.btn.btn-default.quest-btn{
            right:0;
            height: 90px;
            color:green;

        }
        .from-blog h2{
            color:green;
        }

    }


</style>
<?php
/**
 * Template Name: Page Servis
 *
 * @package Modality
 */

get_header();
servis_unslider_slider();

$text_title = "Спрашивать можно и нужно!";

?>
<div class="container-fluid">
    <div class="content">
	    <div id="main" class="<?php echo esc_attr($modality_theme_options['layout_settings']);?>">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post(); ?>

			<div class="content-posts-wrap">
				<div id="content-box">
					<div id="post-body">
						<div <?php post_class('post-single'); ?>>
							
							<?php
							if ($modality_theme_options['breadcrumbs'] == '1') { ?>
								!--breadcrumbs-->
							<?php }

							if ( has_post_thumbnail() ) {

								if ($modality_theme_options['featured_img_post'] == '1') {?>
									<div class="thumb-wrapper">
										<?php the_post_thumbnail('full'); ?>
									</div><!--thumb-wrapper-->
									<?php
								}

							} ?>
							<div id="article">
								<?php the_content();
								the_tags('<p class="post-tags"><span>'.__('Tags:','modality').'</span> ','','</p>');
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'modality' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );

								//Displays navigation to next/previous post.
								if ( $modality_theme_options['post_navigation'] == 'below') { get_template_part('post','nav'); }

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template( '', true );
								} ?>

							</div><!--article-->
						</div><!--post-single-->
					</div><!--post-body-->
				</div><!--content-box-->
				
			</div><!--content-posts-wrap-->
			<?php
		endwhile;
		?>
	</div><!--main-->
    </div>
</div>



<div class="from-blog" style="background: url(<?php echo esc_url($blog_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">

    <div class="from-blog from_page_servis">

        <div id="from-blog-wrap ">
            <div class="row">
                <div class="quest col-md-8">
                    <div> <h2 class="text_title_quest"><?php echo $text_title; ?></h2>
                    </div>

                </div>
                <div class="col-md-4">
                    <a class="btn btn-default quest-btn" role="button" href="http://www.stop-lossov.net/?page_id=32"><div class="read_more_text qu">Напишите нам</div></a>
                </div>
            </div>
        </div>
    </div>
</div>





<?php

get_template_part( 'social', 'section' );

get_footer(); ?>



