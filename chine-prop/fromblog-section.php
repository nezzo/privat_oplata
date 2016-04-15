<?php
/**

Файл отвечает за блок "Обратная связь"
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$blog_bg_image = $modality_theme_options['blog_bg_image'];
$blog_cat = $modality_theme_options['blog_cat'];
$num_posts = $modality_theme_options['num_posts'];
$text_title = "Обратная связь";
$text = "Все предложения о сотрудничестве, вопросы по работе с проектом присылайте через форму обратной связи.";
?>


	<div class="from-blog" style="background: url(<?php echo esc_url($blog_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 

	<div class="from-blog">

	<div id="from-blog-wrap">
	    <div class="row">
	      <div class="quest col-md-8">
		<div> <h2 class="text_title_quest"><?php echo $text_title; ?></h2>
		<div class="text_quest"><?php echo $text;?></div>
		</div>
		 
		 </div>
		 <div class="col-md-4">
		 <a class="btn btn-default quest-btn" role="button" href="http://www.stop-lossov.net/?page_id=32"><div class="read_more_text qu">Напишите нам</div></a>
		 </div>
	   </div>	
		</div>
	</div>
</div>
