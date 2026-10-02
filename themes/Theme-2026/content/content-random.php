<div class="news v2">
	<div class="img">
		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_thumb(); ?>" alt="<?php the_title() ?>"/></a>
	</div>
	<div class="caption">
		<div class="tend">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
		<div class="date"><?php echo get_the_date("H:i d/m/Y"); ?></div>
	</div>
</div>
