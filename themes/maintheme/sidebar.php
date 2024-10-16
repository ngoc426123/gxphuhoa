<!--<div class="imgSidebar text-center d-none d-lg-block mb-bottom-20"><img src="<?php echo get_template_directory_uri()."/images/cha-so.jpg" ?>" alt=""></div>-->
<div class="boxSidebar">
	<div class="title fa-bullhorn">Thông báo</div>
	<div class="content">
		<div class="listNote">
		<?php
			$args = array(
				'post_type'      => 'any',
				'order'          => 'DESC',
				'orderby'        => 'date',
				'posts_per_page' => 5,
				'meta_key'       => 'wpcf-tin-hot',
				'meta_value'     => 'tinhot',
			);
			$the_query = new WP_Query($args);
			if($the_query->have_posts()):
			while($the_query->have_posts()):
        $the_query->the_post();
				get_template_part("content/content-note");
			endwhile;
			endif;
			wp_reset_postdata();
		?>
		</div>
	</div>
</div>
<div class="boxSidebar hidden-sm hidden-xs">
	<div class="title fa-users">
		<ul role="tablist">
			<li class="active">
				<a href="#giaokhu" role="tab" data-bs-toggle="tab" data-bs-target="#giaokhu">Giáo khu</a>
			</li>
			<li>
				<a href="#hoidoan" role="tab" data-bs-toggle="tab" data-bs-target="#hoidoan">Hội đoàn</a>
			</li>
		</ul>
	</div>
	<div class="content">
		<div class="tab-content">
			<div class="tab-pane active" id="giaokhu">
				<div class="listGKHD">
					<ul>
						<li><a href="<?php echo get_category_link(47); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu1.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo I</span>
								<span class="ss2">Thánh Phêrô</span>
							</span>
			  		</a></li>
						<li><a href="<?php echo get_category_link(48); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu2.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo II</span>
								<span class="ss2">Thánh Giuse</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(49); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu3.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo III</span>
								<span class="ss2">Thánh Martino</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(50); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu4.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo IV</span>
								<span class="ss2">Đức Mẹ Vô Nhiễm</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(51); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu5.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo V</span>
								<span class="ss2">Thánh Phaolô</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(52); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/khu6.png" alt="">
							<span class="caption">
								<span class="ss1">Khu giáo VI</span>
								<span class="ss2">Thánh Phanxicô Xaviê</span>
							</span>
						</a></li>
					</ul>
				</div>
			</div>
			<div class="tab-pane" id="hoidoan">
				<div class="listGKHD">
					<ul>
						<li><a href="<?php echo get_category_link(23); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ban_giao_ly.png" alt="">
							<span class="caption">
								<span class="ss1">Ban giáo lý</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(24); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ban_le_sinh.png" alt="">
							<span class="caption">
								<span class="ss1">Ban lễ sinh</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(26); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/cac_ba_me.png" alt="">
							<span class="caption">
								<span class="ss1">Các bà mẹ công giáo</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(28); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/caritas.png" alt="">
							<span class="caption">
								<span class="ss1">Caritas Phú Hòa</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(27); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/gia_dinh_pttt.png" alt="">
							<span class="caption">
								<span class="ss1">gia đình phạt tạ Thánh Tâm</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(30); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/huynh_doan_da_minh.png" alt="">
							<span class="caption">
								<span class="ss1">Huynh đoàn đa minh</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(29); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/legio.png" alt="">
							<span class="caption">
								<span class="ss1">legio Mariae</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(25); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/phung_tu.png" alt="">
							<span class="caption">
								<span class="ss1">Ban phụng tự</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(9); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/thua_tac_vien.png" alt="">
							<span class="caption">
								<span class="ss1">Thừa tác viên Thánh Thể</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(10); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/tntt.png" alt="">
							<span class="caption">
								<span class="ss1">Thiếu nhi Thánh Thể</span>
							</span>
						</a></li>
						<li><a href="<?php echo get_category_link(195); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ban_ke_liet.png" alt="">
							<span class="caption">
								<span class="ss1">Ban kẻ liệt</span>
							</span>
						</a></li>
			  	</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="boxSidebar">
	<div class="title fa-calendar-check">Giờ lễ giáo xứ Phú hòa</div>
	<div class="content">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th colspan="2">Nội dung</th>
					<th>Giờ</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">Thứ hai</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Thứ ba</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Thứ tư</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Thứ năm</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Thứ sáu</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Thứ bảy</td>
					<td>17h30</td>
				</tr>
				<tr>
					<td colspan="2">Chúa nhật</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>Lễ sáng</td>
					<td>05h30</td>
				</tr>
				<tr>
					<td></td>
					<td>Lễ thiếu nhi</td>
					<td>07h30</td>
				</tr>
				<tr>
					<td></td>
					<td>Lễ chiều</td>
					<td>17h00</td>
				</tr>
				<tr>
					<td colspan="2">Chầu thánh thể vào đầu <strong>thứ năm đầu tháng</strong></td>
					<td>19h00</td>
				</tr>
				<tr>
					<td colspan="2">Rửa tội các em thiếu nhi vào <strong>sáng thứ bảy đầu tháng</strong></td>
					<td>08h00</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="boxSidebar">
	<div class="title fa-file-alt">tHỦ TỤC HÔN PHỐI</div>
	<div class="content"><strong class="d-block fs-6 text-center">HỒ SƠ HÔN PHỐI</strong>
		<div class="text-center mb-3">Chuẩn bị trước khi trình cha sở</div>
		<ul class="mb-3 listStyle listStyle--decimal">
			<li>Giấy xác nhận của Trưởng Giáo họ.</li>
			<li>Giấy giới thiệu của cha xứ bên kia.</li>
			<li>Chứng chỉ Rửa tội không quá 6 tháng.</li>
			<li>Chứng chỉ Thêm sức.</li>
			<li>Chứng chỉ Giáo lý Hôn nhân.</li>
			<li>Giấy chứng nhận Kết hôn (bản sao).</li>
			<li>Đại diện cha mẹ hai bên.</li>
		</ul>
		<div>Cha sở giải quyết tất cả các giấy tờ liên quan đến thủ tục hôn phối, vào lúc <strong>19g00 thứ Ba hàng tuần.</strong></div>
	</div>
</div>