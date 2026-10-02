<?php
define('TEMPL_DIR', get_template_directory_uri());
define('STYLE_DIR', get_stylesheet_directory_uri());
if(is_single()){
  $exc=strip_tags($post->post_excerpt,"");
  $meta["name"]=$post->post_title;
  $meta["description"]=$exc;
  $meta["og_url"]=get_permalink($post->ID);
  $meta["og_title"]=$post->post_title;
  $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
  $thumbnail = $thumbnail ? $thumbnail[0] : '';
  $meta["og_image"] =  $thumbnail;
  $meta["og_site_name"]=$post->post_title;
  $meta["og_description"]=$exc;
  $meta["itemprop_name"]=$post->post_title;
  $meta["itemprop_description"]=$exc;
  $meta["itemprop_image"]=  $thumbnail;
  $meta["itemprop_href"]=home_url();
  $meta["link_title"]=$post->post_title;
  $meta["link_href"]=get_permalink($post->ID);
  $meta["link_canonical"]=get_permalink($post->ID);
}
else if(is_category()){
  $query_var=get_query_var('cat');
  $term=get_term_by('id',$query_var, 'category');
  $meta["name"]=$term->name;
  $meta["description"]=get_bloginfo('description');
  $meta["og_url"]=get_term_link($term->term_id);
  $meta["og_title"]=$term->name;
  $meta["og_image"]=TEMPL_DIR."/images/logo.png";
  $meta["og_site_name"]=get_bloginfo('name');
  $meta["og_description"]=get_bloginfo('description');
  $meta["itemprop_name"]=$term->name;
  $meta["itemprop_description"]=get_bloginfo('description');
  $meta["itemprop_image"]=TEMPL_DIR."/images/logo.png";
  $meta["itemprop_href"]=home_url();
  $meta["link_title"]=$term->name;
  $meta["link_href"]=get_term_link($term->term_id);
  $meta["link_canonical"]=$term->name;
}
else{
  $meta["name"]=get_bloginfo('name');
  $meta["description"]=get_bloginfo('description');
  $meta["og_url"]=get_bloginfo('url');
  $meta["og_title"]=get_bloginfo('name');
  $meta["og_image"]=TEMPL_DIR."/images/logo.png";
  $meta["og_site_name"]=get_bloginfo('name');
  $meta["og_description"]=get_bloginfo('description');
  $meta["itemprop_name"]=get_bloginfo('name');
  $meta["itemprop_description"]=get_bloginfo('description');
  $meta["itemprop_image"]=TEMPL_DIR."/images/logo.png";
  $meta["itemprop_href"]=home_url();
  $meta["link_title"]=get_bloginfo('name');
  $meta["link_href"]=get_bloginfo('url');
  $meta["link_canonical"]=get_bloginfo('url');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="google-site-verification" content="VUa6IUNocXA8KpA8r3XwF8SnbhG5Q_Llyord2qEDMTM" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="UTF-8">
	<!-- META FACEBOOK -->
	<meta property="fb:app_id" content="429770550507123"/>
	<meta property="og:url" content="<?php echo $meta["og_url"]; ?>"> 
	<meta property="og:type" content="article">
	<meta property="og:title" content="<?php echo $meta["og_title"]; ?>"> 
	<meta property="og:image" content="<?php echo $meta["og_image"]; ?>"> 
	<meta property="og:site_name" content="<?php echo $meta["og_site_name"]; ?>">
	<meta property="og:description" content="<?php echo $meta["og_description"]; ?>">
	<!-- META GOOGLE -->
	<meta name="google" content="nositelinkssearchbox" />
	<meta name="description" content="<?php echo $meta["description"]; ?>">
	<meta name="keywords" content="<?php echo $meta["name"]; ?>">
	<meta name="robots" content="nofollow" />
	<meta name="googlebot" content="nofollow" />
	<!-- FAVICON -->
	<link rel=icon href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" sizes="16x16" type="image/png">
	<!-- META -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="UTF-8">
	<title><?php echo $meta["name"]; ?></title>
	<?php wp_head(); ?>
</head>
<body>
	<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.init({
			appId            : '429770550507123',
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v9.0'
		});
	};
	</script>
	<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
	<div id="gx-topbar" data-head-top>
		<div class="topbar-inner">
			<div class="topbar-left">
				<a class="topbar-phone" href="tel:0903378512" title="090.337.8512"><i class="fas fa-phone"></i></a>
			</div>
			<nav class="topbar-nav">
				<a href="<?php echo home_url(); ?>">Trang chủ</a>
				<a class="iAbout" href="<?php echo get_permalink(get_page_by_path('gioi-thieu-giao-xu')); ?>">Giới thiệu</a>
				<a href="<?php echo get_permalink(get_page_by_path('lien-he')); ?>">Liên hệ</a>
			</nav>
		</div>
	</div>
	<div id="gx-header">
		<div class="header-inner">
			<div class="header-logo">
				<a href="<?php echo home_url(); ?>" title="Giáo Xứ Phú Hòa">
					<img src="<?php echo TEMPL_DIR ?>/images/logo.png" alt="Giáo Xứ Phú Hòa">
					<span class="site-name">
						<span class="site-name-top">Giáo Xứ</span>
						<span class="site-name-bot">PHÚ HOÀ</span>
					</span>
				</a>
			</div>
			<form class="header-search" action="<?php echo home_url('/'); ?>" method="get" role="search">
				<input class="header-search__input" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Tìm kiếm bài viết..." autocomplete="off">
				<button class="header-search__btn" type="submit" aria-label="Tìm kiếm">
					<i class="fas fa-search"></i>
				</button>
			</form>
			<div class="header-actions">
				<div class="iconMenu">
					<div class="styleMenu"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="gx-navbar">
		<div class="navbar-inner">
			<nav class="navbar-nav">
				<ul>
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
					<li><a href="" title="Mùa phụng vụ"><span>Mùa phụng vụ</span></a>
						<ul><?php wp_list_categories(['child_of'=>'180','title_li'=>'','show_option_none'=>'']); ?></ul>
					</li>
					<li><a href="" title="Thư giãn"><span>Thư giãn</span></a>
						<ul><?php wp_list_categories(['child_of'=>'33','title_li'=>'','show_option_none'=>'']); ?></ul>
					</li>
					<li><a href="" title="Thường thức đời sống"><span>Thường thức đời sống</span></a>
						<ul><?php wp_list_categories(['child_of'=>'61','title_li'=>'','show_option_none'=>'']); ?></ul>
					</li>
					<li><a href="" title="Tin tổng hợp"><span>Tin tổng hợp</span></a>
						<ul><?php wp_list_categories(['child_of'=>'129','title_li'=>'','show_option_none'=>'']); ?></ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div id="gx-container">
		<div class="wrapper">
			<div id="gx-content">
