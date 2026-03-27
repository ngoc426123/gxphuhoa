<?php
/**
 * Plugin Name: GX Phu Hoa CKEditor
 * Description: A custom CKEditor integration for WordPress.
 * Version: 1.0
 * Author: MinhNgoc.ith
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('user_can_richedit', '__return_false', 9999);

function gxphuhoa_ck_styles() {
  wp_enqueue_style(
    'gxphuhoa-ckeditor-style',
    'https://cdn.ckeditor.com/ckeditor5/47.6.1/ckeditor5.css',
    array(),
    '1.0'
  );
}

add_action('wp_head', 'gxphuhoa_ck_styles');

// Enqueues the CKEditor script in the admin area.
function gxphuhoa_enqueue_ckeditor($hook) {
  // Chỉ load ở trang viết bài hoặc sửa bài
  if (!in_array($hook, ['post.php', 'post-new.php'])) return;

  wp_enqueue_script(
    'gxphuhoa-ckeditor-libs',
    'https://cdn.ckeditor.com/ckeditor5/47.6.1/ckeditor5.umd.js',
    array(),
    '4.16.0',
    true
  );

  wp_enqueue_script(
    'gxphuhoa-ckeditor-main-js',
    plugin_dir_url( __FILE__ ) . 'assets/js/main.js',
    array(),
    '1.0',
    true
  );

  wp_enqueue_style(
    'gxphuhoa-ckeditor-style',
    'https://cdn.ckeditor.com/ckeditor5/47.6.1/ckeditor5.css',
    array(),
    '1.0'
  );

  wp_enqueue_style(
    'gxphuhoa-ckeditor-custom-style',
    plugin_dir_url( __FILE__ ) . 'assets/css/style.css',
    array(),
    '1.0'
  );

  wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'gxphuhoa_enqueue_ckeditor' );

