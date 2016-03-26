<?php
/**
Файл отвечает за вывод последних новостей

 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$getin_bg_image = $modality_theme_options['getin_bg_image'];

$text_block = "Последние новости";


if ($getin_bg_image != '') { ?>
	<div class="get-in-touch" style="background: url(<?php echo esc_url($getin_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="get-in-touch">
<?php } ?>
	<div id="get-in-touch-wrap">
	      <div class="row">
	      <div class="last_news col-md-5">
		<div>
			<h2 class="last_news_title"><?php echo $text_block; ?></h2>
			<p>Здесь будет выводиться последняя запись</p>
	        </div>
		</div>
		<div class="col-md-7"></div>
	      </div>	
	</div>
</div>