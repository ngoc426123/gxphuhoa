<div class="news v2">
	<div class="img">
		<a href="<?php the_permalink() ?>" style="background-image: url(<?php echo get_thumb(); ?>);"></a>
	</div>
	<div class="caption">
		<div class="date"><?php echo get_the_date("H:i d/m/Y"); ?></div>
		<div class="tend"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
	</div>
</div>