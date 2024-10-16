<div class="boxSidebar sidebar-single">
	<div class="title fa-share-alt">Chia sẻ</div>
	<div class="content">
		<div class="ds_share" data-share>
			<ul>
				<li>
					<div class="item-share">
						<a class="share-facebook" href="javascript:void(0)" title="" data-share-facebook></a>
						<div class="icon" style="background-color: #3b5998"><i class="fab fa-facebook"></i></div>
						<div class="tend">
							<div class="t1">Chia sẻ</div>
							<div class="t2">Facebook</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-share">
						<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;" title=""></a>
						<div class="icon" style="background-color: #dc4e41;"><i class="fab fa-google"></i></div>
						<div class="tend">
							<div class="t1">Chia sẻ</div>
							<div class="t2">Google</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-share">
						<a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" title=""></a>
						<div class="icon" style="background-color: #1da1f2;"><i class="fab fa-twitter"></i></div>
						<div class="tend">
							<div class="t1">Chia sẻ</div>
							<div class="t2">Twitter</div>
						</div>
					</div>
				</li>
				<li>
					<div class="item-share">
						<a href="" title=""></a>
						<div class="icon" style="background-color: #cb2027;"><i class="fab fa-pinterest-p"></i></div>
						<div class="tend">
							<div class="t1">Chia sẻ</div>
							<div class="t2">Pinterest</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="boxSidebar">
	<div class="title fa-newspaper-o">Bài viết cũ hơn</div>
	<div class="content">
		<div class="listRandom">
		<?php
			$category = get_the_terms($post->ID,'category');
			$term_id = $category ? $category[0]->term_id : 0;
    	$args = array(
			'post__not_in'   => array($post->ID),
			'category__in'   => $term_id,
			'posts_per_page' => 10,
      );
      $the_query = new WP_Query($args);
      if($the_query->have_posts()):
      while($the_query->have_posts()):
        $the_query->the_post();
		    get_template_part("content/content-random");
	    endwhile;
	    endif;
	    wp_reset_postdata();
	    ?>
		</div>
	</div>
</div>