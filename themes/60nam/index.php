<?php
get_header();
?>
<!--===60 NAM HOME==-->
<div class="gx-60-nam" style="margin-top: -40px;">
	<div class="wrapper">
		<div class="title-60">
			<div class="title">
				<h2><a href="">Chặng đường hồng ân</a></h2>
			</div>
			<div class="dess">1959 - 2019</div>
		</div>
		<div class="content-60">
			<div class="row">
				<?php
				$args = array(
					'order'               => 'DESC',
					'orderby'             => 'date',
					'posts_per_page'         => 7,
					'category__in'     => array(199),
				);
				$the_query = new WP_Query($args);
				if ($the_query->have_posts()) :
					while ($the_query->have_posts()) :
						$the_query->the_post();
						get_template_part("content/content-60nam-newss");
						break;
					endwhile;
				endif;
				if ($the_query->have_posts()) :
					while ($the_query->have_posts()) :
						$the_query->the_post();
						get_template_part("content/content-60nam-news");
					endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</div>
<!--======-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div id="soundHome">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
						<?php
						$args = array(
							'order'               => 'DESC',
							'orderby'             => 'date',
							'posts_per_page'         => 1,
							'category__in'     => array(142),
						);
						$the_query = new WP_Query($args);
						if ($the_query->have_posts()) :
							while ($the_query->have_posts()) :
								$the_query->the_post();
								get_template_part("content/content-soundfirst");
							endwhile;
						endif;
						wp_reset_postdata();
						?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
						<?php
						$args = array(
							'order'               => 'DESC',
							'orderby'             => 'date',
							'posts_per_page'         => 5,
							'category__in'     => array(185),
						);
						$the_query = new WP_Query($args);
						if ($the_query->have_posts()) :
							while ($the_query->have_posts()) :
								$the_query->the_post();
								get_template_part("content/content-sounditem");
							endwhile;
						endif;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<div id="videoHome">
				<div id="slideVideo">
					<?php
					$args = array(
						'category__in'     => array(184),
						'order'               => 'DESC',
						'orderby'             => 'date',
						'posts_per_page'         => 4,
					);
					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) :
						while ($the_query->have_posts()) :
							$the_query->the_post();
							get_template_part("content/content-video");
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</div>
			</div>
			<?php
			$array_category = array(
				"1" => array(41, 44, 43),
				"2" => array(106, 112, 111),
				"3" => array(133, 132, 131),
				"4" => array(34, 36, 35),
				"5" => array(165, 153, 150),
				"7" => array(146, 58, 149),
				"8" => array(128, 149, 92),
				"9" => array(124, 126, 125),
			);
			foreach ($array_category as $value) {
				$array_cate = $value;
			?>
				<div class="boxHome">
					<div class="listTitle">
						<ul>
							<li class="current"><a href="<?php echo get_term_link($array_cate[0]); ?>"><?php echo get_term($array_cate[0])->name; ?></a></li>
							<li><a href="<?php echo get_term_link($array_cate[1]); ?>"><?php echo get_term($array_cate[1])->name; ?></a></li>
							<li><a href="<?php echo get_term_link($array_cate[2]); ?>"><?php echo get_term($array_cate[2])->name; ?></a></li>
						</ul>
					</div>
					<div class="boxContent">
						<div class="grid">
							<div class="col1">
								<?php
								$args = array(
									'category__in'   => array($array_cate[0]),
									'order'          => 'DESC',
									'orderby'        => 'date',
									'posts_per_page' => 6,
								);
								$the_query = new WP_Query($args);
								while ($the_query->have_posts()) :
									$the_query->the_post();
									get_template_part("content/content-newsfocus");
									break;
								endwhile;
								?>
							</div>
							<div class="col2">
								<div class="listNewsBoxhome">
									<ul>
										<?php
										while ($the_query->have_posts()) :
											$the_query->the_post();
											get_template_part("content/content-newslist");
											if ($the_query->current_post + 1 == 5) {
												break;
											}
										endwhile;
										?>
									</ul>
								</div>
							</div>
							<div class="col3">
								<?php
								while ($the_query->have_posts()) :
									$the_query->the_post();
									get_template_part("content/content-newsnor");
									break;
								endwhile;
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
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<?php
			get_sidebar();
			?>
		</div>
	</div>
</div>
<?php
get_footer();
?>