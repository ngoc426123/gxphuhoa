<div class="the-audio-wrap" data-single>
	<div class="row flex-lg-row-reverse mb-bottom-20">
		<div class="col-12 col-lg-4">
			<div class="the-wrap">
        <div class="the-title"><h1><?php the_title(); ?></h1></div>
        <div class="the-date"><span><?php echo get_the_terms($post->ID,'category')[0]->name; ?></span> - <?php the_date("M d/m/Y"); ?></div>
      </div>
      <div class="ds_share">
        <ul>
          <li>
            <div class="item-share">
              <a class="share-facebook" href="javascript:" title=""></a>
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
		<div class="col-12 col-lg-8">
      <div class="the-content">
        <?php the_content(); ?>
      </div>
		</div>
	</div>
  <div class="the-audio-other">
    <div class="grid" data-list-audio-other>
      <?php
      $args = array(
        'post__not_in' => array($post->ID),
        'category__in'     => get_the_category()[0]->term_id,
        'posts_per_page'         => 30,
      );
      $the_query = new WP_Query($args);
      if($the_query->have_posts()):
      while ($the_query->have_posts()):
        $the_query->the_post();
      ?>
        <div class="col">
      <?php
          get_template_part("content/content-audioother");
      ?>
        </div>
      <?php
      endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
  <div class="moreNewsCategory"><a data-load-more data-offset="20" data-perpage="20" data-cate="<?php echo get_the_category()[0]->term_id; ?>"><span>Xem thêm</span></a></div>
</div>
