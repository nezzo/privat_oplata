<?php 
/**
 * @package Modality
 */
?>
<?php if (!is_single()) { ?>
	<div class="clear"></div>
	<div class="meta">
		<span><i class="fa fa-calendar"></i><a class="p-date" title="<?php esc_attr(the_time()); ?>" href="<?php esc_url(the_permalink()); ?>"><span class="post_date date updated"><?php esc_attr(the_time('F j, Y')); ?></span></a></span>
	</div>
<?php } ?>