<?php
get_header();
?>
<div class="wrapper">
	<div class="gridMansory">
		<div class="col colC"></div>
		<?php
		$args = array(
			'post_type'   => 'post',
			'order'               => 'DESC',
			'orderby'             => 'date',
			'posts_per_page'         => 10,
		);
		query_posts($args);
		if(have_posts()):
		while(have_posts()):
			the_post();
			get_template_part("content/content-newsautum");
		endwhile;
		endif;
		wp_reset_query();
		?>
	</div>
	<div class="moreNewsCategory"><a data-page="10" id="autum-readmore" href="javascript:void(0)"><span>Xem thêm</span></a></div>
</div>
<?php
get_footer();
?>