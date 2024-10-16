<?php
get_header();
?>
<div class="wrapper">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="titleSearch"><h1>Tìm kiếm với từ khóa : <span><?php echo get_query_var('s'); ?></span></h1></div>
			<div id="listNewsCategory" class="listNewsCategory">
			<?php
			$args = array(
				'category__in'     => array($term->term_id),
				'order'               => 'DESC',
				'orderby'             => 'date',
				'posts_per_page'         => -1,
			);
			if(have_posts()):
			while(have_posts()):
				the_post();
				get_template_part("content/content-newsfocus");
			endwhile;
			endif;
			wp_reset_postdata();
			?>
			</div>
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