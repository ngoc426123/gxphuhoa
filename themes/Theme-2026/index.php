<?php get_header(); ?>

<?php
// ── HERO BANNER SLIDER — bài đánh dấu wpcf-tin-nen-doc ──────
$heroArgs = array(
  'posts_per_page' => 5,
  'meta_key'       => 'wpcf-tin-nen-doc',
  'meta_value'     => 'tinnendoc',
  'order'          => 'DESC',
  'orderby'        => 'date',
);
$heroQuery = new WP_Query($heroArgs);

if ($heroQuery->have_posts()):
  $heroStyles = array('is-glass', 'is-gradient', 'is-duotone', 'is-bright', 'is-ribbon');
  $heroIndex  = 0;
?>
<div class="heroBanner" data-hero-banner-slider>
  <div class="swiper heroBanner-swiper">
    <div class="swiper-wrapper">
      <?php while ($heroQuery->have_posts()): $heroQuery->the_post();
        $styleClass = $heroStyles[$heroIndex % count($heroStyles)];
        $heroIndex++;
        $heroLink   = get_permalink();
        $heroTitle  = get_the_title();
        $heroDate   = get_the_date('H:i d/m/Y');
        $heroCats   = get_the_terms(get_the_ID(), 'category');
        $heroCat    = ($heroCats && !is_wp_error($heroCats)) ? $heroCats[0]->name : 'Tin Giáo Xứ';
      ?>
      <div class="swiper-slide heroBanner-slide <?php echo esc_attr($styleClass); ?>">
        <div class="heroBanner-inner">
          <div class="heroBanner-img">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri().'/images/no-img.jpg'); ?>" alt="<?php echo esc_attr($heroTitle); ?>">
          </div>
          <a class="heroBanner-card" href="<?php echo esc_url($heroLink); ?>" title="<?php echo esc_attr($heroTitle); ?>">
            <span class="heroBanner-tag"><i class="fas fa-bookmark"></i> <?php echo esc_html($heroCat); ?></span>
            <h2 class="heroBanner-title"><?php echo esc_html($heroTitle); ?></h2>
            <div class="heroBanner-meta"><i class="far fa-clock"></i><span><?php echo esc_html($heroDate); ?></span></div>
            <div class="heroBanner-cta"><span>Đọc bài viết</span><i class="fas fa-arrow-right"></i></div>
          </a>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="heroBanner-controls">
      <div class="heroBanner-pagination"></div>
      <div class="heroBanner-prev"><i class="fas fa-chevron-left"></i></div>
      <div class="heroBanner-pause"><i class="fas fa-pause"></i></div>
      <div class="heroBanner-next"><i class="fas fa-chevron-right"></i></div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="topHome">
	<?php
	$args = array('order'=>'DESC','orderby'=>'date','posts_per_page'=>13);
	$tq = new WP_Query($args);
	?>
	<div class="topHome-left">
		<?php if($tq->have_posts()): $tq->the_post(); ?>
		<?php get_template_part("content/content-tophome-v1"); ?>
		<?php endif; ?>
		<div class="topHome-left-sub">
			<?php $n=0; while($tq->have_posts() && $n<3): $tq->the_post(); $n++; ?>
			<?php get_template_part("content/content-tophome-v2"); ?>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="topHome-mid">
		<?php $n=0; while($tq->have_posts() && $n<2): $tq->the_post(); $n++; ?>
		<?php get_template_part("content/content-tophome-v1"); ?>
		<?php endwhile; ?>
	</div>
	<div class="topHome-right">
		<div class="topHome-right-featured">
			<?php if($tq->have_posts()): $tq->the_post(); ?>
			<?php get_template_part("content/content-tophome-v2"); ?>
			<?php endif; ?>
		</div>
		<div class="topHome-right-list">
			<?php while($tq->have_posts()): $tq->the_post(); ?>
			<?php get_template_part("content/content-tophome-text"); ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<?php echo do_shortcode('[gxphuhoa-vaitcan-daily-gospel]') ?>
<div class="audioHome">
	<div class="grid">
		<?php
		$args = array(
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => 10,
			'category__in'   => array(142),
		);
		$the_query = new WP_Query($args);
		if($the_query->have_posts()):
		while($the_query->have_posts()):
			$the_query->the_post();
		?>
			<div class="col">
			<?php get_template_part("content/content-audiohome"); ?>	
			</div>
		<?php
		endwhile;
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>
<div class="row">
	<div class="col-12 col-lg-9">
		<div class="newsFocusTabs">
			<ul class="nav newsFocusTabs-nav" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" type="button" role="tab" data-bs-toggle="tab" data-bs-target="#tab-tingiaoxu" aria-selected="true">Tin Giáo Xứ</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" type="button" role="tab" data-bs-toggle="tab" data-bs-target="#tab-suyniem" aria-selected="false">Tin Giáo Hội Việt Nam</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" type="button" role="tab" data-bs-toggle="tab" data-bs-target="#tab-thongbao" aria-selected="false">Tin Giáo Hội Hoàn Vũ</button>
				</li>
			</ul>
			<div class="tab-content newsFocusTabs-content">
				<div class="tab-pane fade show active" id="tab-tingiaoxu" role="tabpanel">
					<div class="newsFocusTabs-pane">
						<div class="newsFocusTabs-feature">
							<?php $args=array('order'=>'DESC','orderby'=>'date','posts_per_page'=>7,'category__in'=>array(41)); $tq1=new WP_Query($args); if($tq1->have_posts()): $tq1->the_post(); get_template_part("content/content-newsfocushome-1"); endif; ?>
						</div>
						<div class="newsFocusTabs-grid">
							<?php while($tq1->have_posts()): $tq1->the_post(); get_template_part("content/content-newsfocushome-2"); endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tab-suyniem" role="tabpanel">
					<div class="newsFocusTabs-pane">
						<div class="newsFocusTabs-feature">
							<?php $args=array('order'=>'DESC','orderby'=>'date','posts_per_page'=>7,'category__in'=>array(44)); $tq2=new WP_Query($args); if($tq2->have_posts()): $tq2->the_post(); get_template_part("content/content-newsfocushome-1"); endif; ?>
						</div>
						<div class="newsFocusTabs-grid">
							<?php while($tq2->have_posts()): $tq2->the_post(); get_template_part("content/content-newsfocushome-2"); endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="tab-thongbao" role="tabpanel">
					<div class="newsFocusTabs-pane">
						<div class="newsFocusTabs-feature">
							<?php $args=array('order'=>'DESC','orderby'=>'date','posts_per_page'=>7,'category__in'=>array(43)); $tq3=new WP_Query($args); if($tq3->have_posts()): $tq3->the_post(); get_template_part("content/content-newsfocushome-1"); endif; ?>
						</div>
						<div class="newsFocusTabs-grid">
							<?php while($tq3->have_posts()): $tq3->the_post(); get_template_part("content/content-newsfocushome-2"); endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$id_category = [45,8,86,33,61,129];
		foreach ($id_category as $value) {
			$term = get_term($value);
		?>
			<div class="boxNewsHome">
				<div class="titleHome"><span class="fa-newspaper"><?php echo $term->name; ?></span></div>
				<div class="contentHome">
				<?php
					$args = array(
						'order'          => 'DESC',
						'orderby'        => 'date',
						'posts_per_page' => 6,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'id',
								'terms'    => $term->term_id
							)
						)
					);
					$the_query = new WP_Query($args);
				?>
					<div class="grid">
						<div class="col1">
							<?php
						if($the_query->have_posts()):
							$the_query->the_post();
							get_template_part("content/content-newshomehorizontal-1");
						endif;
							?>
						</div>
						<div class="col2">
						<?php
						if($the_query->have_posts()):
							while($the_query->have_posts()):
								$the_query->the_post();
								get_template_part("content/content-newshomehorizontal-2");
							endwhile;
						endif;
						wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
	<div class="col-12 col-lg-3">
		<?php get_sidebar() ?>
	</div>
</div>
<div class="faqHome">
	<?php
	$args = array(
		'order'          => 'DESC',
		'orderby'        => 'date',
		'posts_per_page' => 10,
		'category__in'   => array(53),
	);
	$faq_query = new WP_Query($args);
	?>
	<?php if($faq_query->have_posts()): $faq_query->the_post(); ?>
	<div class="faqHome-featured">
		<div class="faqHome-featured-icon"><i class="fas fa-question"></i></div>
		<div class="faqHome-featured-body">
			<span class="faqHome-featured-label">Hỏi Đáp</span>
			<h3 class="faqHome-featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="faqHome-featured-excerpt"><?php the_excerpt(); ?></p>
			<div class="faqHome-featured-footer"><a class="faqHome-featured-cta" href="<?php the_permalink(); ?>">Đọc bài đầy đủ<i class="fas fa-arrow-right"></i></a></div>
			<div class="faqHome-featured-date"><i class="far fa-clock"></i> <?php echo get_the_date("H:i d/m/Y"); ?></div>
		</div>
	</div>
	<?php endif; ?>
	<div class="faqHome-list">
		<div class="faqHome-list-head">Các câu hỏi khác</div>
		<?php $faq_num = 2; while($faq_query->have_posts()): $faq_query->the_post(); ?>
		<a class="faqHome-row" href="<?php the_permalink(); ?>">
			<span class="faqHome-row-num"><?php printf('%02d', $faq_num++); ?></span>
			<span class="faqHome-row-title"><?php the_title(); ?></span>
			<span class="faqHome-row-date"><?php echo get_the_date("H:i d/m/Y"); ?></span>
		</a>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</div>
<?php
get_footer();
?>
