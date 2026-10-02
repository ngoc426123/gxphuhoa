<?php
get_header();
$keyword    = get_search_query();
$paged      = get_query_var('paged') ? (int) get_query_var('paged') : 1;
$per_page   = 10;
$args = array(
's'              => $keyword,
'order'          => 'DESC',
'orderby'        => 'date',
'posts_per_page' => $per_page,
'paged'          => $paged,
);
$search_query = new WP_Query($args);
$total_posts  = (int) $search_query->found_posts;
?>
<div class="row">
<div class="col-12 col-lg-9">
<div class="searchPage" data-search-page>

<div class="searchPage-header">
<nav class="catPage-breadcrumb">
<a href="<?php echo home_url(); ?>">Trang chủ</a>
<i class="fas fa-chevron-right"></i>
<span>Kết quả tìm kiếm</span>
</nav>
<h1 class="searchPage-title"><i class="fas fa-search"></i>Kết quả tìm kiếm</h1>
<div class="searchPage-meta">
<?php if ($keyword): ?>
<span class="searchPage-keyword">Từ khoá: <strong><?php echo esc_html($keyword); ?></strong></span>
<?php endif; ?>
<span class="searchPage-count"><?php echo $total_posts; ?> kết quả</span>
</div>
</div>

<form class="searchPage-form" action="<?php echo home_url('/'); ?>" method="get" role="search">
<input class="searchPage-form__input" type="search" name="s" value="<?php echo esc_attr($keyword); ?>" placeholder="Tìm kiếm lại..." autocomplete="off">
<button class="searchPage-form__btn" type="submit">
<i class="fas fa-search"></i>&nbsp;Tìm kiếm
</button>
</form>

<?php if ($search_query->have_posts()): ?>

<div class="catPage-divider"><span><?php echo $total_posts; ?> bài viết phù hợp</span></div>

<div class="searchPage-list" data-search-results>
<?php while ($search_query->have_posts()): $search_query->the_post();
$cats     = get_the_terms($post->ID, 'category');
$cat_name = ($cats && !is_wp_error($cats)) ? esc_html($cats[0]->name) : '';
$excerpt  = wp_strip_all_tags(get_the_excerpt());
?>
<div class="catNewsRow">
<a class="catNewsRow-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<img src="<?php echo get_thumb(); ?>" alt="<?php the_title_attribute(); ?>">
</a>
<div class="catNewsRow-body">
<div class="catNewsRow-meta">
<span class="catNewsRow-cat"><?php echo $cat_name; ?></span>
<span class="catNewsRow-date"><i class="far fa-clock"></i> <?php echo get_the_date('H:i d/m/Y'); ?></span>
</div>
<a class="catNewsRow-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<p class="catNewsRow-des searchPage-excerpt" data-excerpt><?php echo esc_html($excerpt); ?></p>
</div>
</div>
<?php endwhile; wp_reset_postdata(); ?>
</div>

<?php if ($search_query->max_num_pages > 1 && $paged < $search_query->max_num_pages): ?>
<div class="catPage-more">
<a class="catPage-more-btn" href="<?php echo get_pagenum_link($paged + 1); ?>">
Xem thêm kết quả<i class="fas fa-chevron-down"></i>
</a>
</div>
<?php endif; ?>

<?php else: ?>

<div class="searchPage-empty">
<i class="fas fa-search"></i>
<p>Không tìm thấy kết quả nào<?php if ($keyword) echo ' cho từ khoá <strong>' . esc_html($keyword) . '</strong>'; ?>.</p>
<span>Hãy thử từ khoá khác hoặc kiểm tra lại chính tả.</span>
</div>

<?php endif; ?>

</div>
</div>
<div class="col-12 col-lg-3">
<?php get_sidebar(); ?>
</div>
</div>
<?php
get_footer();
?>
