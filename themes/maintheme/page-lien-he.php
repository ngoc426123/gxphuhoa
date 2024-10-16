<?php
if(isset($_POST["ok"])){
	session_start();
	if($_POST["ser"] == $_SESSION["ttcapt"]){
		$null_val = "Không có thông tin";
		$args = array(
			'post_title' => $_POST["contact-name"],
			'post_content' => $_POST["contact-content"],
			'post_type' => 'gop-y',
			'post_status' => 'private',
		);
		$id = wp_insert_post($args);
		$address = empty($_POST["contact-address"])?$null_val:$_POST["contact-address"];
		$email = empty($_POST["contact-email"])?$null_val:$_POST["contact-email"];
		$gx = empty($_POST["contact-gx"])?$null_val:$_POST["contact-gx"];
		add_post_meta($id, 'contact-address', $address);
		add_post_meta($id, 'contact-email', $email);
		add_post_meta($id, 'contact-gx', $gx);
		$success = "Chúng tôi đã nhận dc những góp ý từ bạn, cảm ơn bạn đã theo dõi và ủng hộ chúng tôi !!!";
	}
	else{
		$error = "Sai mã bảo vệ rồi !!!";
	}
}
get_header();
?>
<div class="wrapContact" style="background-image:url(https://gxphuhoa.org/wp-content/themes/maintheme/images/contact_bg.jpg);">
	<div class="map-contact">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.450407767398!2d106.6431533148018!3d10.776774062134153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ebbeb104883%3A0xbc67f7512a83dc9b!2zR2nDoW8gWOG7qSBQaMO6IEjDsmE!5e0!3m2!1svi!2s!4v1506331367780" frameborder="0" width="100%" height="450"></iframe>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="info-contact">
				<div class="qrCode hidden-sm hidden-xs"><img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=Gi%C3%A1o%20X%E1%BB%A9%20Ph%C3%BA%20h%C3%B2a%0A%C4%90%E1%BB%8Ba%20ch%E1%BB%89%20%3A%2019%2F2%20Ho%C3%A0ng%20Xu%C3%A2n%20Nh%E1%BB%8B%2C%20P.%20Ph%C3%BA%20Trung%2C%20Q.%20T%C3%A2n%20Ph%C3%BA%2C%20Tp.%20HCM%0AEmail%20%3A%20mvttgxphuhoa%40gmail.com%0ASDT%20%3A%2001673.996.947%0AWebsite%20%3A%20http%3A%2F%2Fgxphuhoa.org&choe=UTF-8&chld=H" alt=""></div>
				<div class="info">
					<div class="name">Ban truyền thông giáo xứ Phú Hòa</div>
					<div class="be fa-home">19/2 Hoàng Xuân Nhị, P. Phú Trung, Q. Tân Phú, Tp. HCM</div>
					<div class="be fa-envelope"><a href="mailto:mvttgxphuhoa@gmail.com">mvttgxphuhoa@gmail.com</a></div>
					<div class="be fa-phone"><a href="tel:0373996947">0373.996.947</a></div>
					<div class="be fa-globe"><a href="http://gxphuhoa.org">http://gxphuhoa.org</a></div>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div class="form-contact">
				<small class="text-success"><?php echo (isset($success))?$success:"";?></small>
				<div class="txt-contact">
					<p>Quý vị đóng góp ý kiến, hoặc cần giải đáp về giáo lý.</p>
					<p>Xin vui lòng hoàn tắt biểu mẫu dưới đây để chúng tôi có thể trả lời  thư của quý vị.</p>
					<p>Xin cảm ơn !</p>
				</div>
				<div class="form">
					<form action="<?php echo get_permalink(get_page_by_path('lien-he')); ?>" method="post">
						<div class="form-group">
							<input name="contact-name" type="text" placeholder="Họ tên...">
						</div>
						<div class="form-group">
							<input name="contact-address" type="text" placeholder="Địa chỉ...">
						</div>
						<div class="form-group">
							<input name="contact-email" type="text" placeholder="Email...">
						</div>
						<div class="form-group">
							<input name="contact-gx" type="text" placeholder="Giáo xứ...">
						</div>
						<div class="form-group">
							<textarea name="contact-content" id="" placeholder="Nội dung..."></textarea>
						</div>
						<div class="form-group">
							<div class="df">
								<input name="ser" type="text" placeholder="Mã bảo vệ...">
								<img src="<?php echo TEMPL_DIR."/"; ?>captcha.php" alt="">
							</div>
							<small class="text-danger"><?php echo (isset($error))?$error:"";?></small>
						</div>
						<div class="form-group">
							<button type="submit" name="ok"><span>Gởi</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>