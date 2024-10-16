<?php
get_header();
?>
<div class="the-fathers" data-fathers>
	<div class="the-fathers__heading">
		<div class="the-fathers__title">
			<h1>Danh sách linh mục</h1><span>Hình ảnh, tên và dòng tu (hoặc chủng viện) của các linh mục đã từng và đang giúp tại giáo xứ Phú Hòa, xin mọi người một lời cầu nguyện cho các ngài mạnh giỏi, đầy tràn hồng ân để luôn kiên trì trong việc Chúa.</span>
		</div>
		<div class="the-fathers__search">
			<div class="the-fathers__search-input">
				<input type="text" name="fatherName" placeholder="Nhập tên bạn muốn tìm..." data-fathers-input>
			</div>
		</div>
	</div>
	<div class="the-fathers__list">
		<?php
			$args = array(
				'post_type' => 'linh-muc',
				'posts_per_page' => -1,
			);
			$the_query = new WP_Query($args);

			if ($the_query->have_posts()):
				while($the_query->have_posts()):
					$the_query->the_post();
					get_template_part("content/content-father");
				endwhile;
			endif;
		?>
	</div>
	<div class="the-fathers__no-result d-none" data-fathers-no-result>
		<div class="the-fathers__no-result-text-1">Không tìm thấy dữ liệu so khớp</div>
		<div class="the-fathers__no-result-text-2">Có thể bạn đã tìm sai thông tin hoặc hệ thống chưa có thông tin về linh mục này, liên hệ admin để biết thêm chi tiết</div>
	</div>
</div>
<?php
get_footer();
?>