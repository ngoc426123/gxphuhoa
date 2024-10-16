<?php
define('TEMPL_DIR', get_template_directory_uri());
define('STYLE_DIR', get_stylesheet_directory_uri());
if (is_single()) {
  $exc = strip_tags($post->post_excerpt, "");
  $meta["name"] = $post->post_title;
  $meta["description"] = $exc;
  $meta["og_url"] = get_permalink($post->ID);
  $meta["og_title"] = $post->post_title;
  $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
  $meta["og_image"] = $thumbnail[0];
  $meta["og_site_name"] = $post->post_title;
  $meta["og_description"] = $exc;
  $meta["itemprop_name"] = $post->post_title;
  $meta["itemprop_description"] = $exc;
  $meta["itemprop_image"] = $thumbnail[0];
  $meta["itemprop_href"] = home_url();
  $meta["link_title"] = $post->post_title;
  $meta["link_href"] = get_permalink($post->ID);
  $meta["link_canonical"] = get_permalink($post->ID);
} else if (is_category()) {
  $query_var = get_query_var('cat');
  $term = get_term_by('id', $query_var, 'category');
  $meta["name"] = $term->name;
  $meta["description"] = get_bloginfo('description');
  $meta["og_url"] = get_term_link($term->term_id);
  $meta["og_title"] = $term->name;
  $meta["og_image"] = TEMPL_DIR . "/images/logo.png";
  $meta["og_site_name"] = get_bloginfo('name');
  $meta["og_description"] = get_bloginfo('description');
  $meta["itemprop_name"] = $term->name;
  $meta["itemprop_description"] = get_bloginfo('description');
  $meta["itemprop_image"] = TEMPL_DIR . "/images/logo.png";
  $meta["itemprop_href"] = home_url();
  $meta["link_title"] = $term->name;
  $meta["link_href"] = get_term_link($term->term_id);
  $meta["link_canonical"] = $term->name;
} else {
  $meta["name"] = get_bloginfo('name');
  $meta["description"] = get_bloginfo('description');
  $meta["og_url"] = get_bloginfo('url');
  $meta["og_title"] = get_bloginfo('name');
  $meta["og_image"] = TEMPL_DIR . "/images/logo.png";
  $meta["og_site_name"] = get_bloginfo('name');
  $meta["og_description"] = get_bloginfo('description');
  $meta["itemprop_name"] = get_bloginfo('name');
  $meta["itemprop_description"] = get_bloginfo('description');
  $meta["itemprop_image"] = TEMPL_DIR . "/images/logo.png";
  $meta["itemprop_href"] = home_url();
  $meta["link_title"] = get_bloginfo('name');
  $meta["link_href"] = get_bloginfo('url');
  $meta["link_canonical"] = get_bloginfo('url');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="google-site-verification" content="VUa6IUNocXA8KpA8r3XwF8SnbhG5Q_Llyord2qEDMTM" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="UTF-8">
  <!-- META FACEBOOK -->
  <meta property="fb:app_id" content="429770550507123" />
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
        appId: '429770550507123',
        autoLogAppEvents: true,
        xfbml: true,
        version: 'v9.0'
      });
    };
  </script>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
  <div id="gx-container">
    <!--===BANNER===-->
    <div id="headBanner" class="hidden-sm hidden-xs">
      <div class="wrapper">
        <a href="<?php echo home_url(); ?>"><img src="<?php echo STYLE_DIR ?>/images/banner.png" alt=""></a>
      </div>
    </div>
    <div id="gx-header">
      <div class="wrapper">
        <div id="headMenu" class="hidden-sm hidden-xs">
          <ul>
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
            <li><a href="">Mùa phụng vụ</a>
              <ul>
                <?php
                $args = array(
                  'child_of'           => '180',
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
            <li><a href="">Thư giãn</a>
              <ul>
                <?php
                $args = array(
                  'child_of'           => '33',
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
            <li><a href="">Thường thức đời sống</a>
              <ul>
                <?php
                $args = array(
                  'child_of'           => '61',
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
            <li><a href="">Tin tổng hợp</a>
              <ul>
                <?php
                $args = array(
                  'child_of'           => '129',
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
          </ul>
        </div>
        <div id="headMobile">
          <div class="logo">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo TEMPL_DIR ?>/images/logo.png" alt=""></a>
          </div>
          <div class="hotlineMobile"><a href="tel:0373996947"></a></div>
          <div class="menuMobile" data-menu-mobile>
            <div class="iconMenu">
              <div class="styleMenu"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--===HEADER===-->
    <div class="wrapper">
      
      <!--===CONTENT===-->
      <div id="gx-content">