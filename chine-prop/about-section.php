<?php
/**
 Файл отвечает за блок "НАША КОМАНДА"
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$about_bg_image = $modality_theme_options['about_bg_image'];

$title = "Наша команда";
$text = "В компании работают люди с
	большим жизненным опытом. Опыт - сын ошибок трудных.
	Трудности закалили наших сотрудников. Сотрудники нашей 
	компании из разных стран, но все мы познакомились в Китае,
	объеденившись для создания достойной проп-компании на рынке Азии!";

if ($about_bg_image != '') { ?>
	<div class="about" style="background: url(<?php echo esc_url($about_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="about">
<?php } ?>
	<div id="about-wrap">
	<div class="row">
	   <div class="command col-md-7">
		<div>
			<h2 class="command_title"><?php echo $title; ?></h2>
			<p class="command_text"><?php echo $text; ?> </p>
			<a class="btn btn-default read_more" role="button" href="#"><div class="read_more_text">Читать еще</div></a>

		</div>
		
	   </div>
	    <div class="command_img col-md-5"></div>
	   
	</div>
	
	</div>
</div>