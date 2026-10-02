<div class="news v2">
	<div class="img">
		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_thumb(); ?>" alt="<?php the_title() ?>"/></a>
	</div>
	<div class="caption">
		<div class="date"><?php echo get_the_date("H:i d/m/Y"); ?></div>
		<div class="cat"><?php $cats=get_the_terms($post->ID,'category'); echo $cats ? esc_html($cats[0]->name) : ''; ?></div>
		<div class="tend"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
	</div>
</div>
