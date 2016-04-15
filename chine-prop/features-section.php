<?php
/**
Файл отвечает  за вывод на главной "НАШ СЕРВИС"
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$features_bg_image = $modality_theme_options['features_bg_image'];

$title= "Stop-Lossov.net";

$text ="
Это проект созданный опытными инвесторами,
трейдерами и аналитиками. Наш опыт позволил 
создать хороший, прибыльный инвестиционный инструмент,
которого не хватает в наше время на рынке инвестиций. 
Целью проекта является получение стабильной прибыли
не только для нас, но и для наших партнеров.
";

if ($features_bg_image !='') { ?>
<div id="features" style="background: url(<?php echo esc_url($features_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	<?php } else { ?>
	<div id="features">
		<?php } ?>
		<div id="features-wrap">
			<div class="grafik">
			<div class="row">
			  <div class="img_grafik col-md-5">
			    <div class="img_grafik_hover"></div>
			  </div>
			    <div class="grafik_text col-md-7">
			    <?php 
				    echo '<h1>'.$title.'</h1>'; // Выводим заголовок записи;
				    echo '<p>'.$text.'</p>'; // Выводим контент записи;
			    ?>
			    <a class="btn btn-default read_more" role="button" href="http://www.stop-lossov.net/?page_id=14"><div class="read_more_text">Читать еще</div></a>
			    </div>
			</div>    
		        </div>
		</div><!--features-wrap-->
	</div><!--features-->