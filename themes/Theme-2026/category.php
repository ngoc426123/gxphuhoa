<?php
get_header();
$query_var = get_query_var('cat');
$term = get_term_by('id', $query_var, 'category');
$post_count = ($term && !is_wp_error($term)) ? $term->count : 0;
?>
<div class="row">
	<div class="col-12 col-lg-9">
		<div class="catPage" data-category>
			<div class="catPage-header">
				<nav class="catPage-breadcrumb">
					<a href="<?php echo home_url(); ?>">Trang chủ</a>
					<i class="fas fa-chevron-right"></i>
					<span><?php echo $term ? esc_html($term->name) : ''; ?></span>
				</nav>
				<h1 class="catPage-title"><i class="fas fa-bookmark"></i><?php echo $term ? esc_html($term->name) : ''; ?></h1>
				<span class="catPage-count"><?php echo $post_count; ?> bài viết</span>
			</div>
			<?php
			$carg = array(
				'order'          => 'DESC',
				'orderby'        => 'date',
				'posts_per_page' => 6,
				'tax_query' => array(array('taxonomy'=>'category','field'=>'id','terms'=>$term->term_id))
			);
			$hero_query = new WP_Query($carg);
			?>
			<div class="catPage-hero">
				<div class="catPage-hero-main">
					<?php if($hero_query->have_posts()): $hero_query->the_post(); ?>
					<?php get_template_part("content/content-tophome-v1"); ?>
					<?php endif; ?>
				</div>
				<div class="catPage-hero-side">
					<?php while($hero_query->have_posts()): $hero_query->the_post(); ?>
					<?php get_template_part("content/content-tophome-v2"); ?>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="catPage-divider"><span>Bài viết mới nhất</span></div>
			<div class="catPage-list" data-list-news>
				<?php
				$larg = array(
					'category__in'   => array($term->term_id),
					'order'          => 'DESC',
					'orderby'        => 'date',
					'posts_per_page' => 10,
					'offset'         => 6,
				);
				$list_query = new WP_Query($larg);
				if($list_query->have_posts()):
				while($list_query->have_posts()):
					$list_query->the_post();
					get_template_part("content/content-catNewsRow");
				endwhile;
				endif;
				wp_reset_postdata();
				?>
			</div>
			<div class="catPage-more">
				<button class="catPage-more-btn" data-load-more data-perpage="10" data-cate="<?php echo $term->term_id; ?>" data-offset="16">
					Xem thêm bài viết<i class="fas fa-chevron-down"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-3">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
?>
