<?php
/**
Файл отвечает  за вывод на главной "НАШ СЕРВИС"
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$features_bg_image = $modality_theme_options['features_bg_image'];

$title= "Наш Сервис";

$text ="
Больше половины ресурсов компании
отвечает за сохранение и 
приумножение капитала инвесторов.Да, мы
предлагаем не много финансовых инструментов и 
услуг, для нас качестве важнее количества! 
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