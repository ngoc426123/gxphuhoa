<?php
get_header();
$query_var=get_query_var('cat');
$term=get_term_by('id',$query_var, 'category');
?>
<div class="row">
	<div class="col-12 col-lg-9">
		<div class="newsCategory" data-category>
			<div class="title"><?php echo $term->name?></div>
			<?php
				$args = array(
					'order'               => 'DESC',
					'orderby'             => 'date',
					'posts_per_page'         => 5,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $term->term_id
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
			  			get_template_part("content/content-newshomesolid");
			  		endif;
					?>
				</div>
				<div class="col2">
					<div class="grid">
						<?php
						if($the_query->have_posts()):
				  		while($the_query->have_posts()):
				  			$the_query->the_post();
				  		?>
				  			<div class="col3">
							<?php get_template_part("content/content-audiohome"); ?>
							</div>
				  		<?php
				  		endwhile;
				  		endif;
				  		wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<div class="listNewsCategory" data-list-news>
			<?php
			$args = array(
				'category__in'     => array($term->term_id),
				'order'               => 'DESC',
				'orderby'             => 'date',
				'posts_per_page'         => 10,
				'offset'                 => 5,
			);
			$the_query = new WP_Query($args);
			if($the_query->have_posts()):
			while($the_query->have_posts()):
				$the_query->the_post();
				get_template_part("content/content-newshomehorizontal-3");
			endwhile;
			endif;
			wp_reset_postdata();
			?>
			</div>
			<div class="moreNewsCategory"><a data-load-more data-offset="20" data-perpage="20" data-cate="<?php echo $term->term_id; ?>"><span>Xem thêm...</span></a></div>
		</div>
	</div>
	<div class="col-12 col-lg-3">
	<?php
	get_sidebar();
	?>
	</div>
</div>
<?php
get_footer();
?>