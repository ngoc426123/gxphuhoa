<?php
get_header();
if(have_posts()):
while(have_posts()):
	the_post();
	$id=get_the_id();
	$luotxem=get_post_meta( $id, 'wpcf-luot-xem',true);
	$luotxem++;
	update_post_meta( $id,'wpcf-luot-xem', $luotxem);
endwhile;
endif;
?>
<!--===BEGIN FACEBOOK SHARE===-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=429770550507123';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--===END FACEBOOK SHARE===-->
<?php
if(in_category(142) OR in_category(185)){
    include get_stylesheet_directory()."/single-audio.php";
}
else{
    include get_stylesheet_directory()."/single-normal.php";
}
?>
<?php
get_footer();
?>