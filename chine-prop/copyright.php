<?php
/**
 * @package Modality
 */  
$modality_theme_options = modality_get_options( 'modality_theme_options' );
?>
<div id="copyright">
	<div class="copyright-wrap">
		<span class="left"><a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php echo esc_attr($modality_theme_options['footer_copyright_text']);?></a></span>
	</div>
</div><!--copyright-->