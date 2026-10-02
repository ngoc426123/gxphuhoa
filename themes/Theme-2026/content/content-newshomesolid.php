<div class="newsCard">
	<div class="newsCard-img">
		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
			<img src="<?php echo get_thumb(); ?>" alt="<?php the_title() ?>"/>
			<span class="newsCard-cat"><?php $cats=get_the_terms($post->ID,'category'); echo $cats ? esc_html($cats[0]->name) : ''; ?></span>
		</a>
	</div>
	<div class="newsCard-body">
		<span class="newsCard-cat-text"><?php $cats=get_the_terms($post->ID,'category'); echo $cats ? esc_html($cats[0]->name) : ''; ?></span>
		<a class="newsCard-title" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
	</div>
</div>
