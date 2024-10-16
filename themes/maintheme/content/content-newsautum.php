<div class="col">
    <div class="newsM">
        <div class="img">
            <a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo get_thumb(); ?>)"></a>
            <div class="cat"><?php echo get_the_terms($post->ID,'category')[0]->name; ?></div>
        </div>
        <div class="date"><?php echo get_the_date("H:i d/m/Y"); ?></div>
        <div class="tend"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
        <div class="des"><?php the_excerpt(); ?></div>
    </div>
</div>