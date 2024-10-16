		</div>
		<!--===FOOTER===-->
		<footer id="gx-footer">
			<div id="footerMain">
				<div class="wrapper">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden-sm hidden-xs">
							<div class="logoFoot text-center"><a href="<?php echo home_url(); ?>"><img src="<?php echo TEMPL_DIR ?>/images/logo.png" alt=""></a></div>
							<div class="desFoot">Hơn 50 năm hình thành và phát triển, Phú Hòa ngày một ổn định vững vàng trong tình yêu quan phòng của Chúa. Nhìn lại những chặng đường đã qua, cộng đoàn giáo xứ Phú Hòa có được như hôm nay chính là nhờ hồng ân bao la của Chúa. Xin hiệp lời hân hoan tạ ơn Chúa, vì: “Tất cả là hồng ân”.</div>
							<div class="clear"></div>
							<div class="linkMore text-right"><a class="iAbout fancybox.ajax" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>"><span>Xem thêm</span></a></div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
							<div class="boxBot">
								<div class="title">Ban truyền thông giáo xứ Phú Hòa</div>
								<div class="content">
									<div class="addressFoot">
										<div class="be fa-home">19/2 Hoàng Xuân Nhị, P. Phú Trung, Q. Tân Phú, Tp. HCM</div>
										<div class="be fa-envelope"><a href="mailto:mvttgxphuhoa@gmail.com">mvttgxphuhoa@gmail.com</a></div>
										<div class="be fa-phone"><a href="tel:01673996947">01673.996.947</a></div>
										<div class="be fa-globe"><a href="http://gxphuhoa.org">http://gxphuhoa.org</a></div>
										<div class="be fa-map-marker"><a class="viewMap fancybox.iframe" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.450407767398!2d106.6431533148018!3d10.776774062134153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ebbeb104883%3A0xbc67f7512a83dc9b!2zR2nDoW8gWOG7qSBQaMO6IEjDsmE!5e0!3m2!1svi!2s!4v1506331367780">Xem bản đồ</a></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
							<div class="boxBot">
								<div class="title">Giáo Xứ Phú Hòa</div>
								<div class="content">
									<div class="botLink">
										<ul>
											<li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
											<li><a class="iAbout fancybox.ajax" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>">Giới thiệu</a></li>
											<li><a href="">Thư viện ảnh</a></li>
											<li><a href="<?php echo get_permalink(get_page_by_path('tin-tuc-tong-hop')); ?>">Lưu trữ</a></li>
											<li><a href="">Liên hệ</a></li>
											<li><a href="/baihatchuanhat.docx">Bài hát Chúa Nhật</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="footerBot">
				<div class="wrapper">
					<div class="copyright">
						<div class="be">Power by <a href="http://wordpress.org">Wordpress</a></div>
						<div class="be">Design by <a href="mailto:minhngoc.ith@gmail.com">minhngoc.ith</a></div>
					</div>
					<div class="socialFoot">
						<ul>
							<li><a target="_blank" href="https://www.facebook.com/gxphuhoa/"><i class="fa fa-facebook"></i></a></li>
							<li><a target="_blank" href=""><i class="fa fa-twitter"></i></a></li>
							<li><a target="_blank" href=""><i class="fa fa-google"></i></a></li>
							<li><a target="_blank" href="https://www.youtube.com/user/MVTTGxPhuHoa"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!--==BEGIN: MENU_MOBILE_NAV==-->
	    <div class="menu_mobile">
	        <div class="divmm">
	            <div class="mmContent">
	                <div class="mmMenu">
	                    <ul>
							<li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
							<li><a href="">Thông tin</a>
								<ul>
									<?php
				                    $args = array(
				                        'child_of'           => '40',
				                        'include'            => '',
				                        'title_li'           => __( '' ),
				                        'show_option_none'   => __('No categories'),
				                        'echo'               => 1,
				                        'current_category'   => 0,
				                    );
				                    wp_list_categories( $args );
				                    ?>
								</ul>
							</li>
							<li><a href="">Hội đồng mục vụ</a>
								<ul>
									<?php
				                    $args = array(
				                        'child_of'           => '45',
				                        'include'            => '',
				                        'title_li'           => __( '' ),
				                        'show_option_none'   => __('No categories'),
				                        'echo'               => 1,
				                        'current_category'   => 0,
				                    );
				                    wp_list_categories( $args );
				                    ?>
								</ul>
							</li>
							<li><a href="">Các hội đoàn</a>
								<ul>
									<?php
				                    $args = array(
				                        'child_of'           => '8',
				                        'include'            => '',
				                        'title_li'           => __( '' ),
				                        'show_option_none'   => __('No categories'),
				                        'echo'               => 1,
				                        'current_category'   => 0,
				                    );
				                    wp_list_categories( $args );
				                    ?>
								</ul>
							</li>
							<li><a href="">Ca đoàn</a>
								<ul>
									<?php
				                    $args = array(
				                        'child_of'           => '86',
				                        'include'            => '',
				                        'title_li'           => __( '' ),
				                        'show_option_none'   => __('No categories'),
				                        'echo'               => 1,
				                        'current_category'   => 0,
				                    );
				                    wp_list_categories( $args );
				                    ?>
								</ul>
							</li>
							<li><a href="<?php echo get_term_link(122); ?>">Lịch phụng vụ</a></li>
							<li><a href="http://thuvienanh.gxphuhoa.org">Thư viện ảnh</a></li>
							<li><a href="<?php echo get_permalink(get_page_by_path('tin-tuc-tong-hop')); ?>">Lưu trữ</a></li>
						</ul>
	                </div>
	                <div class="mmSearch">
	                    <form action="">
							<input type="text" id="s" name="s" placeholder="Từ khóa tìm kiếm ...">
							<button class="btn-search"><i class="fa fa-search"></i></button>
						</form>
	                </div>
	                <div class="close-mmenu"><i class="fa fa-times"></i></div>
	            </div>
	            <div class="divmmbg"></div>
	        </div>
	    </div>
	    <!--==END: MENU_MOBILE_NAV==-->
		<!--==BEGIN LOADING==-->
		<div class="loading-bg">
			<img src="<?php echo TEMPL_DIR ?>/images/loading.svg" alt="">
		</div>
		<!--==END LOADING==-->
	</div>
</body>
<?php
wp_footer();
?>
</html>
