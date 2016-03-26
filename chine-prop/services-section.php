<?php
/**
Файл отвечает за блок "Наши клиенты"

 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$services_bg_image = $modality_theme_options['services_bg_image'];

$title= "Наши клиенты";
$text = "На данном этапе мы проводим верификацию
	и листинг в ряде интернет-площадок по долевому участию,
	тем самым позволяем инвесторам еще более застраховать себя 
	от неторговых рисков, их собственный капитал. Если вы хотите
	участвовать в доверительном управлении и получать порядка 50-100%
	годовых в твердых международных валютах, напишите нам в форму обратной 
	связи или свяжитесь с кем пожелаете из сотрудников команды China-prop group. ";


if ($services_bg_image !='') { ?>
	<div id="services" style="background: url(<?php echo esc_url($services_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
	<div id="services">
<?php } ?>
	<div id="services-wrap">
		<div class="my_client">
		<?php 
		  echo '<h2>'.$title.'</h2>';
		  echo '<p>'.$text.'</p>';
		
		?>
		</div>
	</div><!--services-wrap-->
</div><!--services-->