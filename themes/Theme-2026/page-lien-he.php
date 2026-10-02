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
<div class="contactPage">
	<div class="contactPage-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.450407767398!2d106.6431533148018!3d10.776774062134153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ebbeb104883%3A0xbc67f7512a83dc9b!2zR2nDoW8gWOG7qSBQaMO6IEjDsmE!5e0!3m2!1svi!2s!4v1506331367780" frameborder="0" width="100%" height="380" allowfullscreen loading="lazy"></iframe>
	</div>
	<div class="contactPage-body">
		<div class="contactPage-info">
			<div class="contactPage-info-header">
				<h2 class="contactPage-info-name">Ban truyền thông giáo xứ Phú Hòa</h2>
			</div>
			<div class="contactPage-info-items">
				<div class="contactPage-info-item">
					<i class="contactPage-info-icon fa-solid fa-location-dot"></i>
					<div class="contactPage-info-text">19/2 Hoàng Xuân Nhị, P. Phú Trung, Q. Tân Phú, Tp. HCM</div>
				</div>
				<div class="contactPage-info-item">
					<i class="contactPage-info-icon fa-solid fa-envelope"></i>
					<div class="contactPage-info-text"><a href="mailto:mvttgxphuhoa@gmail.com">mvttgxphuhoa@gmail.com</a></div>
				</div>
				<div class="contactPage-info-item">
					<i class="contactPage-info-icon fa-solid fa-phone"></i>
					<div class="contactPage-info-text"><a href="tel:0373996947">0373.996.947</a></div>
				</div>
				<div class="contactPage-info-item">
					<i class="contactPage-info-icon fa-solid fa-globe"></i>
					<div class="contactPage-info-text"><a href="http://gxphuhoa.org">gxphuhoa.org</a></div>
				</div>
			</div>
			<div class="contactPage-info-qr">
				<img src="https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=Gi%C3%A1o%20X%E1%BB%A9%20Ph%C3%BA%20h%C3%B2a%0A%C4%90%E1%BB%8Ba%20ch%E1%BB%89%20%3A%2019%2F2%20Ho%C3%A0ng%20Xu%C3%A2n%20Nh%E1%BB%8B%2C%20P.%20Ph%C3%BA%20Trung%2C%20Q.%20T%C3%A2n%20Ph%C3%BA%2C%20Tp.%20HCM%0AEmail%20%3A%20mvttgxphuhoa%40gmail.com%0ASDT%20%3A%2001673.996.947%0AWebsite%20%3A%20http%3A%2F%2Fgxphuhoa.org&choe=UTF-8&chld=H" alt="QRcode giáo xứ phú hoà"/>
				<p>Quét QR để lưu thông tin</p>
			</div>
		</div>
		<div class="contactPage-form">
			<div class="contactPage-form-intro">
				<h3 class="contactPage-form-title">Gửi lời nhắn</h3>
				<p>Quý vị đóng góp ý kiến, hoặc cần giải đáp về giáo lý. Xin vui lòng hoàn tất biểu mẫu dưới đây để chúng tôi có thể trả lời thư của quý vị. Xin cảm ơn!</p>
			</div>
			<form class="contactPage-form-body" action="<?php echo get_permalink(get_page_by_path('lien-he')); ?>" method="post">
				<small class="text-success"><?php echo (isset($success))?$success:"";?></small>
				<div class="contactPage-form-row">
					<div class="contactPage-form-group">
						<label for="contact-name">Họ tên</label>
						<input id="contact-name" name="contact-name" type="text" placeholder="Họ tên..."/>
					</div>
					<div class="contactPage-form-group">
						<label for="contact-address">Địa chỉ</label>
						<input id="contact-address" name="contact-address" type="text" placeholder="Địa chỉ..."/>
					</div>
				</div>
				<div class="contactPage-form-row">
					<div class="contactPage-form-group">
						<label for="contact-email">Email</label>
						<input id="contact-email" name="contact-email" type="email" placeholder="Email..."/>
					</div>
					<div class="contactPage-form-group">
						<label for="contact-gx">Giáo xứ</label>
						<input id="contact-gx" name="contact-gx" type="text" placeholder="Giáo xứ..."/>
					</div>
				</div>
				<div class="contactPage-form-group">
					<label for="contact-content">Nội dung</label>
					<textarea id="contact-content" name="contact-content" placeholder="Nội dung..."></textarea>
				</div>
				<div class="contactPage-form-group">
					<label>Mã bảo vệ</label>
					<div class="contactPage-form-captcha">
						<input name="ser" type="text" placeholder="Nhập mã..."/>
						<img src="<?php echo TEMPL_DIR; ?>/captcha.php" alt="Captcha"/>
					</div>
					<small class="text-danger"><?php echo (isset($error))?$error:"";?></small>
				</div>
				<div class="contactPage-form-submit">
					<button type="submit" name="ok">
						<i class="fa-solid fa-paper-plane"></i>
						<span>Gửi tin nhắn</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
get_footer();
?>