<?php
get_header();
$query_var=get_query_var('cat');
$term=get_term_by('id',$query_var, 'category');
?>
<div class="wrapper">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div id="topHome">
				<div class="row">
					<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
						<div id="slideNews">
						<?php
						$args = array(
							'category__in'   => array($term->term_id),
							'order'          => 'DESC',
							'orderby'        => 'date',
							'posts_per_page' => 10,
						);
						$the_query = new WP_Query($args);
						if($the_query->have_posts()):
						while($the_query->have_posts()):
							$the_query->the_post();
							get_template_part("content/content-slidenews");
							break;
						endwhile;
						endif;
						?>
						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
						<div id="slideNewsL" class="v2">
						<?php
						if($the_query->have_posts()):
						while($the_query->have_posts()):
							$the_query->the_post();
							get_template_part("content/content-slidenewsl");
						endwhile;
						endif;
						wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</div>
			<div id="listNewsCategory" class="listNewsCategory">
			<?php
			$args = array(
				'category__in'     => array($term->term_id),
				'order'               => 'DESC',
				'orderby'             => 'date',
				'posts_per_page'         => 10,
				'offset'                 => 10,
			);
			$the_query = new WP_Query($args);
			if($the_query->have_posts()):
			while($the_query->have_posts()):
				$the_query->the_post();
				get_template_part("content/content-newsfocus");
			endwhile;
			endif;
			wp_reset_postdata();
			?>
			</div>
			<div class="moreNewsCategory"><a data-page="20" data-cate="<?php echo $term->term_id; ?>" id="category-readmore" href="javascript:void(0)"><span>Xem thêm</span></a></div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
		<?php
		get_sidebar();
		?>
		</div>
	</div>
</div>
<?php
get_footer();
?>