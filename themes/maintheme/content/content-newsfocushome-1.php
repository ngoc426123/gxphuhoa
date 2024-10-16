<div class="news">
	<div class="img">
		<a href="<?php the_permalink() ?>" style="background-image: url(<?php echo get_thumb(); ?>);"></a>
	</div>
	<div class="caption">
		<div class="date"><?php echo get_the_date("H:i d/m/Y"); ?></div>
		<div class="cat"><?php echo get_the_terms($post->ID,'category')[0]->name; ?></div>
		<div class="tend"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
	</div>
</div>