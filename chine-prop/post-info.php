<?php 
/**
 * @package Modality
 */
?>
<div class="post-info">
	<?php if(has_post_format('image')) {?>
		<span><i class="fa fa-camera"></i><a href="<?php printf(esc_url( get_post_format_link( 'image' ))); ?>"><?php printf( __('Image','modality')); ?></a></span>
	<?php } elseif(has_post_format('gallery')) {?>
		<span><i class="fa fa-picture-o"></i><a href="<?php printf(esc_url( get_post_format_link( 'gallery' ))); ?>"><?php printf( __('Gallery','modality')); ?></a></span>
	<?php } elseif(has_post_format('video')) {?>
		<span><i class="fa fa-video-camera"></i><a href="<?php printf(esc_url( get_post_format_link( 'video' ))); ?>"><?php printf( __('Video','modality')); ?></a></span>
	<?php } elseif(has_post_format('aside')) {?>
		<span><i class="fa fa-file-text"></i><a href="<?php printf(esc_url( get_post_format_link( 'aside' ))); ?>"><?php printf( __('Aside','modality')); ?></a></span>
	<?php } elseif(has_post_format('audio')) {?>
		<span><i class="fa fa-music"></i><a href="<?php printf(esc_url( get_post_format_link( 'audio' ))); ?>"><?php printf( __('Audio','modality')); ?></a></span>
	<?php } else {?>
	<?php } ?>
	</div>