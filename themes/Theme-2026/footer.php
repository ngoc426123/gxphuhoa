			</div><!-- /#gx-content -->
		</div><!-- /.wrapper -->
		<div id="gx-footer">
			<div id="footerMain">
				<div class="wrapper">
					<div class="footerGrid">
						<div class="footerCol footerCol--brand">
							<a class="footerBrand" href="<?php echo home_url(); ?>" title="Giáo Xứ Phú Hòa">
								<img src="<?php echo TEMPL_DIR ?>/images/logo.png" alt="Giáo Xứ Phú Hòa">
								<div class="footerBrand-name">
									<span class="footerBrand-top">Giáo Xứ</span>
									<span class="footerBrand-bot">PHÚ HOÀ</span>
								</div>
							</a>
							<p class="footerTagline">Ban truyền thông Giáo xứ Phú Hòa – Giáo hạt Phú Thọ, Tổng Giáo phận TP.HCM.</p>
							<div class="footerSocialLinks">
								<a class="footerSocialLinks-item" href="https://www.facebook.com/gxphuhoa/" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
								<a class="footerSocialLinks-item" href="https://www.youtube.com/user/MVTTGxPhuHoa" title="Youtube" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
								<a class="footerSocialLinks-item" href="#" title="Twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
								<a class="footerSocialLinks-item" href="#" title="Google" aria-label="Google"><i class="fab fa-google"></i></a>
							</div>
						</div>
						<div class="footerCol">
							<h4 class="footerCol-title">Điều hướng</h4>
							<ul class="footerLinks">
								<li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
								<li><a class="iAbout" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>">Giới thiệu</a></li>
								<li><a href="<?php echo get_permalink(get_page_by_path('danh-sach-linh-muc')); ?>">Linh mục giúp xứ</a></li>
								<li><a href="<?php echo get_permalink(get_page_by_path('nha-cho-phuc-sinh')); ?>">Nhà chờ Phục Sinh</a></li>
								<li><a href="http://thuvienanh.gxphuhoa.org">Thư viện ảnh</a></li>
								<li><a href="<?php echo get_permalink(get_page_by_path('lien-he')); ?>">Liên hệ</a></li>
							</ul>
						</div>
						<div class="footerCol">
							<h4 class="footerCol-title">Liên hệ</h4>
							<div class="footerAddress">
								<div class="footerAddress-row"><i class="fas fa-map-marker-alt"></i><span>19/2 Hoàng Xuân Nhị, P. Phú Trung, Q. Tân Phú, TP. HCM</span></div>
								<div class="footerAddress-row"><i class="fas fa-envelope"></i><a href="mailto:mvttgxphuhoa@gmail.com">mvttgxphuhoa@gmail.com</a></div>
								<div class="footerAddress-row"><i class="fas fa-globe"></i><a href="http://gxphuhoa.org">gxphuhoa.org</a></div>
							</div>
						</div>
						<div class="footerCol">
							<h4 class="footerCol-title">Hỗ trợ</h4>
							<div class="footerHotline">
								<div class="footerHotline-group">
									<span class="footerHotline-label">Hỗ trợ nội dung</span>
									<a class="footerHotline-num" href="tel:0903378512"><i class="fas fa-phone-alt"></i><span>090.337.8512</span></a>
								</div>
								<div class="footerHotline-group">
									<span class="footerHotline-label">Hỗ trợ hình ảnh</span>
									<a class="footerHotline-num" href="tel:0903378512"><i class="fas fa-phone-alt"></i><span>090.337.8512</span></a>
								</div>
								<div class="footerHotline-group">
									<span class="footerHotline-label">Hỗ trợ kỹ thuật</span>
									<a class="footerHotline-num" href="tel:0373996947"><i class="fas fa-phone-alt"></i><span>0373.996.947</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="footerBot">
				<div class="wrapper">
					<div class="footerBottom">
						<span>&copy; 2024 Giáo Xứ Phú Hoà. All rights reserved.</span>
						<span>Ban truyền thông<a href="http://gxphuhoa.org"> Giáo Xứ Phú Hoà</a></span>
					</div>
				</div>
			</div>
		</div>
		<!-- MOBILE MENU -->
		<div class="menuMobile" data-menu-mobile>
			<div class="divmm">
				<div class="mmContent">
					<div class="mmHead">
						<div class="mmHead-brand">
							<img class="mmHead-logo" src="<?php echo TEMPL_DIR ?>/images/logo.png" alt="Giáo Xứ Phú Hòa">
							<span class="mmHead-name">
								<span class="mmHead-top">Giáo Xứ</span>
								<span class="mmHead-bot">PHÚ HOÀ</span>
							</span>
						</div>
						<button class="mmClose" type="button" aria-label="Đóng menu">
							<i class="fa-solid fa-xmark"></i>
						</button>
					</div>
					<div class="mmBody">
						<form class="mmSearch" action="<?php echo home_url('/'); ?>" method="get" role="search">
							<input class="mmSearch__input" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Tìm kiếm bài viết..." autocomplete="off">
							<button class="mmSearch__btn" type="submit" aria-label="Tìm kiếm">
								<i class="fas fa-search"></i>
							</button>
						</form>
						<nav class="mmNav">
							<ul>
								<li><a href="<?php echo home_url(); ?>" title="Trang chủ"><span>Trang chủ</span></a></li>
								<li><a href="" title="Thông tin"><span>Thông tin</span></a>
									<ul><?php wp_list_categories(['child_of'=>'40','title_li'=>'','show_option_none'=>'']); ?></ul>
								</li>
								<li><a href="" title="Hội đồng mục vụ"><span>Hội đồng mục vụ</span></a>
									<ul><?php wp_list_categories(['child_of'=>'45','title_li'=>'','show_option_none'=>'']); ?></ul>
								</li>
								<li><a href="" title="Các hội đoàn"><span>Các hội đoàn</span></a>
									<ul><?php wp_list_categories(['child_of'=>'8','title_li'=>'','show_option_none'=>'']); ?></ul>
								</li>
								<li><a href="" title="Ca đoàn"><span>Ca đoàn</span></a>
									<ul><?php wp_list_categories(['child_of'=>'86','title_li'=>'','show_option_none'=>'']); ?></ul>
								</li>
								<li><a href="<?php echo get_term_link(122); ?>" title="Lịch phụng vụ"><span>Lịch phụng vụ</span></a></li>
								<li><a href="http://thuvienanh.gxphuhoa.org" title="Thư viện ảnh"><span>Thư viện ảnh</span></a></li>
								<li><a href="<?php echo get_permalink(get_page_by_path('tin-tuc-tong-hop')); ?>" title="Lưu trữ"><span>Lưu trữ</span></a></li>
							</ul>
						</nav>
						<div class="mmFoot">
							<a class="mmFoot-link" href="<?php echo home_url(); ?>">
								<i class="fa-solid fa-house"></i>
								<span>Trang chủ</span>
							</a>
							<a class="mmFoot-link iAbout" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>">
								<i class="fa-solid fa-church"></i>
								<span>Giới thiệu</span>
							</a>
							<a class="mmFoot-link" href="<?php echo get_permalink(get_page_by_path('danh-sach-linh-muc')); ?>">
								<i class="fa-solid fa-church"></i>
								<span>Linh mục giúp xứ</span>
							</a>
							<a class="mmFoot-link" href="<?php echo get_permalink(get_page_by_path('nha-cho-phuc-sinh')); ?>">
								<i class="fa-solid fa-church"></i>
								<span>Nhà chờ Phục Sinh</span>
							</a>
							<a class="mmFoot-link" href="<?php echo get_permalink(get_page_by_path('lien-he')); ?>">
								<i class="fa-solid fa-envelope"></i>
								<span>Liên hệ</span>
							</a>
							<a class="mmFoot-phone" href="tel:0373996947">
								<i class="fa-solid fa-phone"></i>
								<span>037 399 6947</span>
							</a>
						</div>
					</div>
				</div>
				<div class="divmmbg"></div>
			</div>
		</div>
		<!-- LOADING -->
		<div class="loading-bg" data-loading>
			<div class="loadingio-spinner-spin-jrpb44twqj">
				<div class="ldio-fvykqwmeirb">
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
					<div><div></div></div>
				</div>
			</div>
		</div>
	</div><!-- /#gx-container -->
</body>
<?php
wp_footer();
?>
</html>
