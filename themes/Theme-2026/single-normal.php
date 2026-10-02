<?php
$category = get_the_terms($post->ID, 'category');
$cat_name  = ($category && !is_wp_error($category)) ? $category[0]->name : '';
$cat_link  = ($category && !is_wp_error($category)) ? get_term_link($category[0]) : '#';
$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<div class="the-single" data-single>
	<nav class="the-breadcrumb">
		<a href="<?php echo home_url(); ?>">Trang chủ</a>
		<i class="fas fa-angle-right"></i>
		<a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a>
		<i class="fas fa-angle-right"></i>
		<span><?php the_title(); ?></span>
	</nav>
	<div class="row">
		<div class="col-12 col-lg-9">
			<header class="the-article-head">
				<span class="the-article-cat"><?php echo esc_html($cat_name); ?></span>
				<h1 class="the-article-title"><?php the_title(); ?></h1>
				<div class="the-article-meta">
					<span class="the-article-meta-item"><i class="far fa-calendar-alt"></i>&nbsp;<?php echo get_the_date("l, d/m/Y"); ?></span>
					<span class="the-article-meta-item"><i class="far fa-clock"></i>&nbsp;<?php echo get_the_date("H:i"); ?></span>
					<span class="the-article-meta-item"><i class="far fa-user"></i>&nbsp;Ban Truyền Thông</span>
				</div>
			</header>
			<div class="the-content ck-content">
				<?php the_content(); ?>
			</div>
			<nav class="the-article-nav">
				<?php if($prev_post): ?>
				<a class="the-article-nav-item the-article-nav-prev" href="<?php echo get_permalink($prev_post->ID); ?>">
					<div class="the-article-nav-thumb">
						<?php $prev_thumb = get_the_post_thumbnail_url($prev_post->ID, 'medium'); ?>
						<img src="<?php echo $prev_thumb ? esc_url($prev_thumb) : ''; ?>" alt="<?php echo esc_attr($prev_post->post_title); ?>">
					</div>
					<div class="the-article-nav-body">
						<span class="the-article-nav-label"><i class="fas fa-arrow-left"></i> Bài trước</span>
						<span class="the-article-nav-title"><?php echo esc_html($prev_post->post_title); ?></span>
					</div>
				</a>
				<?php endif; ?>
				<?php if($next_post): ?>
				<a class="the-article-nav-item the-article-nav-next" href="<?php echo get_permalink($next_post->ID); ?>">
					<div class="the-article-nav-body">
						<span class="the-article-nav-label">Bài sau <i class="fas fa-arrow-right"></i></span>
						<span class="the-article-nav-title"><?php echo esc_html($next_post->post_title); ?></span>
					</div>
					<div class="the-article-nav-thumb">
						<?php $next_thumb = get_the_post_thumbnail_url($next_post->ID, 'medium'); ?>
						<img src="<?php echo $next_thumb ? esc_url($next_thumb) : ''; ?>" alt="<?php echo esc_attr($next_post->post_title); ?>">
					</div>
				</a>
				<?php endif; ?>
			</nav>
			<div class="the-related">
				<div class="the-related-head"><span class="the-related-title">Bài viết liên quan</span></div>
				<div class="the-related-grid">
					<?php
					$rel_args = array(
						'posts_per_page' => 3,
						'category__in'   => wp_get_post_categories($post->ID),
						'post__not_in'   => array($post->ID),
						'orderby'        => 'date',
						'order'          => 'DESC',
					);
					$rel_query = new WP_Query($rel_args);
					while($rel_query->have_posts()): $rel_query->the_post();
						get_template_part("content/content-tophome-v1");
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-3">
			<?php get_sidebar('single'); ?>
		</div>
	</div>
	<div class="single-fixed" data-single-fixed>
		<div class="wrapper">
			<div class="left">
				<div class="lg d-none d-lg-block"><img src="<?php echo TEMPL_DIR; ?>/images/logo.png" alt="Logo Giáo Xứ Phú Hoà"/></div>
				<div class="cat d-none d-lg-block"><?php echo esc_html($cat_name); ?></div>
				<div class="title"><?php the_title(); ?></div>
			</div>
			<div class="social" data-share>
				<ul>
					<li><div class="item-share"><a href="#" title="Share Facebook" data-share-facebook></a><div class="icon" style="background-color:#3b5998;"><i class="fab fa-facebook"></i></div><div class="tend"><div class="t1">Chia sẻ</div><div class="t2">Facebook</div></div></div></li>
					<li><div class="item-share"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title=""></a><div class="icon" style="background-color:#dc4e41;"><i class="fab fa-google"></i></div><div class="tend"><div class="t1">Chia sẻ</div><div class="t2">Google</div></div></div></li>
					<li><div class="item-share"><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>"></a><div class="icon" style="background-color:#1da1f2;"><i class="fab fa-twitter"></i></div><div class="tend"><div class="t1">Chia sẻ</div><div class="t2">Twitter</div></div></div></li>
					<li><div class="item-share"><a href="" title="" style="background-color:#cb2027;"></a><div class="icon" style="background-color:#cb2027;"><i class="fab fa-pinterest"></i></div><div class="tend"><div class="t1">Chia sẻ</div><div class="t2">Pinterest</div></div></div></li>
				</ul>
			</div>
		</div>
	</div>
</div>
