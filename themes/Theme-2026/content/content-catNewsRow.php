<div class="catNewsRow">
	<a class="catNewsRow-img" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
		<img src="<?php echo get_thumb(); ?>" alt="<?php the_title() ?>">
	</a>
	<div class="catNewsRow-body">
		<div class="catNewsRow-meta">
			<span class="catNewsRow-cat"><?php $cats=get_the_terms($post->ID,'category'); echo $cats ? esc_html($cats[0]->name) : ''; ?></span>
			<span class="catNewsRow-date"><i class="far fa-clock"></i> <?php echo get_the_date("H:i d/m/Y"); ?></span>
		</div>
		<a class="catNewsRow-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<p class="catNewsRow-des"><?php the_excerpt() ?></p>
	</div>
</div>
