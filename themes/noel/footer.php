			</div>
			</div>
			<!--===FOOTER===-->
			<footer id="gx-footer">
				<div id="footerMain">
					<div class="wrapper">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<div class="boxBot">
									<div class="title">Ban truyền thông giáo xứ Phú Hòa</div>
									<div class="content">
										<div class="addressFoot">
											<div class="be fa-home">19/2 Hoàng Xuân Nhị, P. Phú Trung, Q. Tân Phú, Tp. HCM</div>
											<div class="be fa-envelope"><a href="mailto:mvttgxphuhoa@gmail.com">mvttgxphuhoa@gmail.com</a></div>
											<div class="be fa-globe"><a href="http://gxphuhoa.org">http://gxphuhoa.org</a></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 hidden-sm hidden-xs">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="boxBot">
											<div class="title">Giáo Xứ Phú Hòa</div>
											<div class="content">
												<div class="botLink">
													<ul>
														<li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
														<li><a class="iAbout fancybox.ajax" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>">Giới thiệu</a></li>
														<li><a href="http://thuvienanh.gxphuhoa.org">Thư viện ảnh</a></li>
														<li><a href="<?php echo get_permalink(get_page_by_path('tin-tuc-tong-hop')); ?>">Lưu trữ</a></li>
														<li><a href="<?php echo get_permalink(get_page_by_path('lien-he')); ?>">Liên hệ</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="boxBot">
											<div class="title">Mạng xã hội</div>
											<div class="content">
												<div class="socialFoot">
													<ul>
														<li><a target="_blank" href="https://www.facebook.com/gxphuhoa/"><i class="fab fa-facebook"></i><span>facebook</span></a></li>
														<li><a target="_blank" href=""><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
														<li><a target="_blank" href=""><i class="fab fa-google"></i><span>Google</span></a></li>
														<li><a target="_blank" href="https://www.youtube.com/user/MVTTGxPhuHoa"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="boxBot">
											<div class="title">Hỗ trợ độc giả</div>
											<div class="content">
												<div class="hotlineFoot">
													<div class="title">Hỗ trợ nội dung</div>
													<div class="hotline"><a href="0903378512"><span>090.337.8512</span></a></div>
													<div class="title">Hỗ trợ hình ảnh</div>
													<div class="hotline"><a href="0903378512"><span>090.337.8512</span></a></div>
													<div class="title">Hỗ trợ kỹ thuật</div>
													<div class="hotline"><a href="0373996947"><span>0373.996.947</span></a></div>
												</div>
											</div>
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
					</div>
				</div>
			</footer>
			<!--==BEGIN: MENU_MOBILE_NAV==-->
			<div class="menuMobile" data-menu-mobile>
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
											'title_li'           => __(''),
											'show_option_none'   => __('No categories'),
											'echo'               => 1,
											'current_category'   => 0,
										);
										wp_list_categories($args);
										?>
									</ul>
								</li>
								<li><a href="">Hội đồng mục vụ</a>
									<ul>
										<?php
										$args = array(
											'child_of'           => '45',
											'include'            => '',
											'title_li'           => __(''),
											'show_option_none'   => __('No categories'),
											'echo'               => 1,
											'current_category'   => 0,
										);
										wp_list_categories($args);
										?>
									</ul>
								</li>
								<li><a href="">Các hội đoàn</a>
									<ul>
										<?php
										$args = array(
											'child_of'           => '8',
											'include'            => '',
											'title_li'           => __(''),
											'show_option_none'   => __('No categories'),
											'echo'               => 1,
											'current_category'   => 0,
										);
										wp_list_categories($args);
										?>
									</ul>
								</li>
								<li><a href="">Ca đoàn</a>
									<ul>
										<?php
										$args = array(
											'child_of'           => '86',
											'include'            => '',
											'title_li'           => __(''),
											'show_option_none'   => __('No categories'),
											'echo'               => 1,
											'current_category'   => 0,
										);
										wp_list_categories($args);
										?>
									</ul>
								</li>
								<li><a href="<?php echo get_term_link(122); ?>">Lịch phụng vụ</a></li>
								<li><a href="http://thuvienanh.gxphuhoa.org">Thư viện ảnh</a></li>
								<li><a href="<?php echo get_permalink(get_page_by_path('tin-tuc-tong-hop')); ?>">Lưu trữ</a></li>
							</ul>
						</div>
						<div class="close-mmenu"><i class="fa fa-times"></i></div>
					</div>
					<div class="divmmbg"></div>
				</div>
			</div>
			<!--==END: MENU_MOBILE_NAV==-->
			<!--==BEGIN LOADING==-->
			<div class="loading-bg" data-loading>
				<div class="loadingio-spinner-spin-jrpb44twqj">
					<div class="ldio-fvykqwmeirb">
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
						<div>
							<div></div>
						</div>
					</div>
				</div>
			</div>
			<!--==END LOADING==-->
			</div>
			</body>
			<?php
			wp_footer();
			?>

			</html>