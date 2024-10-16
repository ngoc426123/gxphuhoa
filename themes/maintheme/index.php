<?php
	// $youtubeListLearn = getYoutubePlaylist('PLu2A8RFX_PoOpRO5dcJZrQNvY8PFxgP5C');
?>
<?php
get_header();
?>
<div class="topHome">
	<div class="grid">
		<?php
		$args = array(
			'order'               => 'DESC',
			'orderby'             => 'date',
			'posts_per_page'         => 4,
		);
		$the_query = new WP_Query($args);
		?>
		<div class="col">
			<?php
			if($the_query->have_posts()):
				$the_query->the_post();
				get_template_part("content/content-tophome-v1");
			endif;
			?>
		</div>
		<div class="col">
			<?php
			if($the_query->have_posts()):
				$the_query->the_post();
				get_template_part("content/content-tophome-v1");
			endif;
			?>
		</div>
		<div class="col">
			<?php
			if($the_query->have_posts()):
				$the_query->the_post();
				get_template_part("content/content-tophome-v2");
				$the_query->the_post();
				get_template_part("content/content-tophome-v2");
			endif;
			?>
		</div>
		
		<?php
		wp_reset_postdata();
		?>
	</div>
</div>
<div class="audioHome">
	<div class="grid">
		<?php
	  	$args = array(
            'order'               => 'DESC',
            'orderby'             => 'date',
            'posts_per_page'         => 10,
            'category__in'     => array(142),
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
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="newsFocusHome">
					<?php
					  	$args = array(
									'order'               => 'DESC',
									'orderby'             => 'date',
									'posts_per_page'         => 5,
									'category__in'     => array(41),
							);
			        $the_query = new WP_Query($args);
				  		if($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-1");
				  		endif;
				  		if($the_query->have_posts()):
				  		while($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-2");
				  		endwhile;
				  		endif;
				  		wp_reset_postdata();
			  		?>
		  		</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="newsFocusHome">
					<?php
					  	$args = array(
								'order'               => 'DESC',
								'orderby'             => 'date',
								'posts_per_page'         => 5,
								'category__in'     => array(44),
							);
							$the_query = new WP_Query($args);
				  		if($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-1");
				  		endif;
				  		if($the_query->have_posts()):
				  		while($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-2");
				  		endwhile;
				  		endif;
				  		wp_reset_postdata();
			  		?>
		  		</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="newsFocusHome">
					<?php
						$args = array(
								'order'               => 'DESC',
								'orderby'             => 'date',
								'posts_per_page'         => 5,
								'category__in'     => array(43),
							);
							$the_query = new WP_Query($args);
				  		if($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-1");
				  		endif;
				  		if($the_query->have_posts()):
				  		while($the_query->have_posts()):
				  			$the_query->the_post();
				  			get_template_part("content/content-newsfocushome-2");
				  		endwhile;
				  		endif;
				  		wp_reset_postdata();
			  		?>
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
						'order'               => 'DESC',
						'orderby'             => 'date',
						'posts_per_page'         => 6,
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
		<div class="faqHome">
			<?php 
			$id_category = 53; 
			$term = get_term($id_category);
			?>
			<div class="title"><?php echo $term->name; ?></div>
			<div class="grid">
				<?php
				  	$args = array(
								'order'               => 'DESC',
								'orderby'             => 'date',
								'posts_per_page'         => 10,
								'category__in'     => array($id_category),
						);
						$the_query = new WP_Query($args);
						if($the_query->have_posts()):
						while($the_query->have_posts()):
							$the_query->the_post();
						?>
							<div class="col">
							<?php get_template_part("content/content-newshomefaq"); ?>
							</div>
						<?php
						endwhile;
						endif;
						wp_reset_postdata();
		  		?>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<?php get_sidebar() ?>
	</div>
</div>
<?php
get_footer();
?>