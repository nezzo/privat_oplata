<?php
/**
Файл отвечает за блок "Наши клиенты"

 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$services_bg_image = $modality_theme_options['services_bg_image'];

$title= "Наши клиенты";
$text = "Основными нашими клиентами являются
трейдеры и инвесторы. Трейдеры, показывающие 
хорошие результаты в ходе проп-отбора, получают 
счет в управление, и без своих вложений имеют 
возможность получать хороший доход. Инвесторы 
предоставляют капитал для торговли, для реализации
наших идей и получают прибыль с каждого инвестированного
доллара. Если вы хотите стать нашим клиентом, то зайдите
к нам на форум, ознакомьтесь с имеющейся там информацией
и свяжитесь с нами.";


if ($services_bg_image !='') { ?>
	<div id="services" style="background: url(<?php echo esc_url($services_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
	<div id="services">
<?php } ?>
	<div id="services-wrap">
	
		<div class="my_client">
		<div class="col-md-5">
		<img src="/wp-content/themes/chine-prop/images/Nashi_klienty.png" />
		</div>
		<div class="col-md-7 client">
		<?php 
		  echo '<h2>'.$title.'</h2>';
		  echo '<p>'.$text.'</p>';
		
		?>
		</div>
		</div>
	</div><!--services-wrap-->
</div><!--services-->