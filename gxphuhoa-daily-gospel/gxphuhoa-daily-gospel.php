<?php
/**
 * Plugin Name:       Lời Chúa Hàng Ngày (Vatican News)
 * Plugin URI:        https://github.com/gxphuhoa/gxphuhoa-vatican-holyweekly
 * Description:       Hiển thị Lời Chúa hằng ngày trong tuần từ RSS Vatican News tiếng Việt. Sử dụng shortcode [gxphuhoa-vaitcan-daily-gospel].
 * Version:           1.0.0
 * Author:            GX Phú Hòa
 * License:           GPL-2.0-or-later
 * Text Domain:       gxphuhoa-daily-gospel
 */

defined( 'ABSPATH' ) || exit;

define( 'GXPH_DAILY_GOSPEL_VERSION', '1.0.0' );
define( 'GXPH_DAILY_GOSPEL_DIR',     plugin_dir_path( __FILE__ ) );
define( 'GXPH_DAILY_GOSPEL_URL',     plugin_dir_url( __FILE__ ) );

/* ── Enqueue assets ──────────────────────────────────────────────────────── */

add_action( 'wp_enqueue_scripts', 'gxph_daily_gospel_enqueue' );

function gxph_daily_gospel_enqueue() {
    $assets_url = GXPH_DAILY_GOSPEL_URL . 'assets/';

    // Font Awesome (for icons used by React component)
    wp_enqueue_style(
        'font-awesome-6',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );

    // Lora — scripture/liturgical serif font (Vietnamese)
    wp_enqueue_style(
        'gxph-lora-font',
        'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400;1,600&display=swap',
        [],
        null
    );

    // Component stylesheet (built by Vite)
    wp_enqueue_style(
        'gxph-daily-gospel-css',
        $assets_url . 'loi-chua.css',
        [ 'font-awesome-6', 'gxph-lora-font' ],
        GXPH_DAILY_GOSPEL_VERSION
    );

    // React bundle (built by Vite — includes React itself)
    wp_enqueue_script(
        'gxph-daily-gospel-js',
        $assets_url . 'loi-chua.js',
        [],
        GXPH_DAILY_GOSPEL_VERSION,
        true   // load in footer
    );

    // Tell WordPress this is an ES module
    add_filter( 'script_loader_tag', 'gxph_daily_gospel_module_tag', 10, 3 );
}

/**
 * Add type="module" to the React bundle so browsers treat it as an ES module.
 */
function gxph_daily_gospel_module_tag( $tag, $handle, $src ) {
    if ( 'gxph-daily-gospel-js' !== $handle ) {
        return $tag;
    }
    // Remove classic <script> tag and replace with module version
    $tag = '<script type="module" src="' . esc_url( $src ) . '" id="gxph-daily-gospel-js"></script>' . "\n";
    return $tag;
}

/* ── Shortcode ────────────────────────────────────────────────────────────── */

add_shortcode( 'gxphuhoa-vaitcan-daily-gospel', 'gxph_daily_gospel_shortcode' );

/**
 * Render the mount point that React will attach to.
 * Usage: [gxphuhoa-vaitcan-daily-gospel]
 *
 * @return string  Safe HTML mount container.
 */
function gxph_daily_gospel_shortcode() {
    return '<div class="gxphuhoa-daily-gospel-root"></div>';
}
