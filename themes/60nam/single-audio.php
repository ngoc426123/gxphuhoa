<div class="wrapper">
	<div class="the-audio-wrap">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-push-8 col-md-pull-8">
				<div class="the-title"><h1><?php the_title(); ?></h1></div>
				<div class="the-date-share">
		            <div class="ds_date"><?php the_date("M d/m/Y"); ?></div>
		            <div class="ds_share">
		                <ul>
		                    <li><a class="share-facebook" href="" title="" style="background-color: #3b5998;"><i class="fa fa-facebook-f"></i></a></li>
		                    <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;" title="" style="background-color: #dc4e41;"><i class="fa fa-google-plus"></i></a></li>
		                    <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" title="" style="background-color: #1da1f2;"><i class="fa fa-twitter"></i></a></li>
		                    <li><a href="" title="" style="background-color: #cb2027;"><i class="fa fa-pinterest-p"></i></a></li>
		                </ul>
		            </div>
		            <div class="clear"></div>
		        </div>
				<div class="the-attr">
					<ul>
						<li>
							<div class="at">Chuyên mục</div>
							<div class="as"><?php the_category(); ?></div>
							<div class="clear"></div>
						</li>
						<li>
							<div class="at">Người đăng</div>
							<div class="as"><?php the_author(); ?></div>
							<div class="clear"></div>
						</li>
						<li>
							<div class="at">Lượt xem</div>
							<div class="as">Null</div>
							<div class="clear"></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-pull-4 col-md-pull-4">
			<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="the-audio-other">
		<div class="row" id="resultAudio">
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
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
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
		<div class="moreNewsCategory"><a data-page="30" data-cate="<?php echo get_the_category()[0]->term_id; ?>" id="audio-readmore" href="javascript:void(0)"><span>Xem thêm</span></a></div>
	</div>
</div>