<div class="newsInner">
	<div class="img"><a href="<?php the_permalink() ?>" style="background-image: url(<?php echo get_thumb(); ?>);"></a></div>
	<div class="caption">
		<div class="cat"><?php echo get_the_terms($post->ID,'category')[0]->name; ?></div>
		<div class="tend"><?php the_title(); ?></div>
	</div>
</div>