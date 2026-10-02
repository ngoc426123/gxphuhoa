<?php
/**
 * Plugin Name: Gx Phu Hoa - Pray for Us
 * Plugin URI: http://gxphuhoa.org
 * Description: Plugin tạo Custom Post Type Nhà Chờ Phục sinh của Gx.Phú Hoà
 * Version: 1.1
 * Author: minhngoc.ith
 * Author URI: minhngoc.ith@gmail.com
*/

define('PLUGIN_URL_PRAYFORUS', plugin_dir_url( __FILE__ ));

// CUSTOM POST TYPE
function prayforus_custom_post_type() {
  $label = array(
    'name' => 'Danh sách trong Nhà Chờ Phục Sinh',
    'singular_name' => 'Danh sách Nhà Chờ',
    'add_new' => 'Thêm mới',
    'add_new_item' => 'Thêm mới',
    'edit_item' => 'Sửa',
    'new_item' => 'Thêm mới',
    'view_item' => 'Xem',
    'view_items'=>'Xem tất cả',
    'search_items'=>'Tìm kiếm',
    'not_found'=>'Không có ',
    'not_found_in_trash'=>'Không có item nào trong thùng rác',
    'parent_item_colon'=>'Danh mục cha',
    'all_items'=>'Tất cả',
    'archives'=>'Danh mục',
    'attributes'=>'Thuộc tính',
    'insert_into_item'=>'Thêm phương tiện',
    'uploaded_to_this_item'=>'Tải lên phương tiện',
    'featured_image'=>'Hình ảnh người đã khuất',
    'set_featured_image'=>'Chọn / tải lên hình ảnh',
    'remove_featured_image'=>'Xóa hình ảnh',
    'use_featured_image'=>'Sử dụng hình ảnh này',
    'menu_name'=>'Nhà Chờ Phục Sinh',
    'name_admin_bar'=>'Nhà Chờ Phục Sinh',
  );
  $support = array(
    'title',
    'thumbnail',
  );
  $arr = array(
    'labels' => $label,
    'description' => 'Danh sách trong Nhà Chờ Phục Sinh.',
    'supports' => $support,
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
  );
  register_post_type('pray-for-us', $arr);
};
add_action('init', 'prayforus_custom_post_type');

// THUMBNAIL: tự bật featured image cho CPT, không phụ thuộc theme
function prayforus_thumbnail_support() {
  add_theme_support('post-thumbnails', array('pray-for-us'));
}
add_action('after_setup_theme', 'prayforus_thumbnail_support', 11);

// PLACEHOLDER TITLE
function prayforus_title_placeholder($title, $post) {
  return $post->post_type === 'pray-for-us' ? 'Nhập Tên thánh và Họ tên người đã khuất' : $title;
}
add_filter('enter_title_here', 'prayforus_title_placeholder', 10, 2);

// CUSTOM STYLE
function prayforus_custom_style() {
  wp_enqueue_style('gxphuhoa-pray-for-us-datetimepicker', PLUGIN_URL_PRAYFORUS .'css/jquery.datetimepicker.min.css','all' );
  wp_enqueue_style('gxphuhoa-pray-for-us-admin', PLUGIN_URL_PRAYFORUS .'css/style.css','all' );
}
add_action('admin_head', 'prayforus_custom_style');

// CUSTOM SCRIPT
function prayforus_custom_script() {
  wp_enqueue_script('jquery');
  wp_enqueue_script('gxphuhoa-pray-for-us-datetimepicker', PLUGIN_URL_PRAYFORUS .'js/jquery.datetimepicker.full.min.js','all' );
  wp_enqueue_script('gxphuhoa-pray-for-us-admin', PLUGIN_URL_PRAYFORUS .'js/custom.js','all' );
}
add_action('admin_footer', 'prayforus_custom_script');

// META BOX
$prayforus_fields = [
  "wpcf-pray-for-us-ID",
  "wpcf-pray-for-us-shelf",
  "wpcf-pray-for-us-row",
  "wpcf-pray-for-us-number",
  "wpcf-pray-for-us-yearofbirth",
  "wpcf-pray-for-us-yearofdead",
];

function formCallBackPrayForUs($post) {
  global $prayforus_fields;
  $wpcf_value = [];

  foreach($prayforus_fields as $value) {
    $wpcf_value[$value] = get_post_meta($post->ID, $value, true);
  };

  ?>
    <div class="prayforus-box">
      <div class="prayforus-row">
        <div class="prayforus-col">
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="pray-for-us-ID">ID</label>
            <div class="prayforus-form-input">
              <input
                id="pray-for-us-ID"
                name="wpcf-pray-for-us-ID"
                type="text"
                class="prayforus-form-control"
                value="<?php echo $wpcf_value["wpcf-pray-for-us-ID"]?>"
                autocomplete="off"
                readonly
              >
              <span class="prayforus-form-note --red">ID được lưu trong hệ thống - phần này không chỉnh sửa được</span>
            </div>
          </div>
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="pray-for-us-yearofbirth">Năm sinh</label>
            <div class="prayforus-form-input">
              <input
                id="pray-for-us-yearofbirth"
                name="wpcf-pray-for-us-yearofbirth"
                type="text"
                class="prayforus-form-control"
                value="<?php echo $wpcf_value["wpcf-pray-for-us-yearofbirth"]?>"
                autocomplete="off"
              >
              <span class="prayforus-form-note">Ngày tháng năm sinh của người mất</span>
            </div>
          </div>
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="pray-for-us-yearofdead">Năm mất</label>
            <div class="prayforus-form-input">
              <input
                id="pray-for-us-yearofdead"
                name="wpcf-pray-for-us-yearofdead"
                type="text"
                class="prayforus-form-control"
                value="<?php echo $wpcf_value["wpcf-pray-for-us-yearofdead"]?>"
                autocomplete="off"
              >
              <span class="prayforus-form-note">Ngày tháng năm mất của người mất</span>
            </div>
          </div>
        </div>
        <div class="prayforus-col">
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="pray-for-us-shelf">Vị trí</label>
            <div class="prayforus-form-input">
              <select name="wpcf-pray-for-us-shelf" id="pray-for-us-shelf" class="prayforus-form-control">
                <option value="0">---Lựa chọn---</option>
                <option value="A" <?php echo $wpcf_value["wpcf-pray-for-us-shelf"] == 'A' ? 'selected' : '' ?>>Kệ A</option>
                <option value="B" <?php echo $wpcf_value["wpcf-pray-for-us-shelf"] == 'B' ? 'selected' : '' ?>>Kệ B</option>
                <option value="C" <?php echo $wpcf_value["wpcf-pray-for-us-shelf"] == 'C' ? 'selected' : '' ?>>Kệ C</option>
              </select>
              <span class="prayforus-form-note">Lựa chọn kệ đặt người mất trong Nhà Chờ Phục Sinh</span>
            </div>
          </div>
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="prayforus-background">Số hàng</label>
            <div class="prayforus-form-input">
              <select name="wpcf-pray-for-us-row" id="pray-for-us-row" class="prayforus-form-control">
                <option value="0">---Lựa chọn---</option>
                <?php for($i = 1; $i <= 20; $i++) { ?>
                <option value="<?php echo $i ?>" <?php echo $wpcf_value["wpcf-pray-for-us-row"] == $i ? 'selected' : '' ?>>Hàng số <?php echo $i;?></option>
                <?php } ?>
              </select>
              <span class="prayforus-form-note">Lựa chọn số hàng trong dãy kệ lựa chọn ở trên</span>
            </div>
          </div>
          <div class="prayforus-form-group">
            <label class="prayforus-form-label" for="prayforus-background">Số thứ tự trong hàng</label>
            <div class="prayforus-form-input">
              <select name="wpcf-pray-for-us-number" id="pray-for-us-number" class="prayforus-form-control">
                <option value="0">---Lựa chọn---</option>
                <?php for($i = 1; $i <= 20; $i++) { ?>
                <option value="<?php echo $i ?>" <?php echo $wpcf_value["wpcf-pray-for-us-number"] == $i ? 'selected' : '' ?>>Thứ tự: <?php echo $i;?></option>
                <?php } ?>
              </select>
              <span class="prayforus-form-note">Lựa chọn số thứ tự trong số hàng lựa chọn ở trên</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
}
function meta_box_pray_for_us() {
  add_meta_box( 'metabox-pray-for-us', 'Thông tin người mất', 'formCallBackPrayForUs', 'pray-for-us' );
}
add_action( 'add_meta_boxes', 'meta_box_pray_for_us' );

// SAVE AND EDIT META DATA
function prayforus_save($post_id) {
  global $prayforus_fields;

  foreach ($prayforus_fields as $value) {
    
    if(isset($_POST[$value])){
      update_post_meta( $post_id, $value, $_POST[$value] );
    }
  }
}
add_action('save_post_pray-for-us', 'prayforus_save');

function prayforus_edit($post_id) {
  global $prayforus_fields;

  foreach ($prayforus_fields as $value) {
    // Quick Edit / trash không gửi các field này → bỏ qua để không xoá mất meta
    if(!isset($_POST[$value])){
      continue;
    }

    if(!$_POST[$value]){
      delete_post_meta($post_id, $value);
    }
    else{
      update_post_meta( $post_id, $value, $_POST[$value] );
    }
  }
}
add_action( 'edit_post_pray-for-us', 'prayforus_edit' );

// CUSTOM MANAGER LIST
function custom_columns_prayforus(){
  return array(
    'cb' => '<input type="checkbox" />',
    'prayforus-image' => __('Hình'),
    'title' => __('Tên'),
    'prayforus-info'  => __('Thông tin'),
    'prayforus-position' => __('Vị trí'),
    'date' => __('Ngày'),
  );
}
add_action('manage_pray-for-us_posts_columns', 'custom_columns_prayforus');

function custom_content_columns_prayforus($column, $post_id){
  global $prayforus_fields;
  switch ($column) {
    case 'prayforus-image':
      $image = get_prayforus_image($post_id);

      echo "<img class='prayforus-thumbnail' src='{$image}'>";
      break;
    case 'prayforus-info':
      $dateBirth = get_post_meta($post_id, $prayforus_fields[4], true);
      $dateDead = get_post_meta($post_id, $prayforus_fields[5], true);

      $info = "<p>Ngày sinh: {$dateBirth}</p>";
      $info.= "<p>Ngày mất: {$dateDead}</p>";
      echo $info;
      break;
    case 'prayforus-position':
      $shelf = get_post_meta($post_id, $prayforus_fields[1], true);
      $row = get_post_meta($post_id, $prayforus_fields[2], true);
      $number = get_post_meta($post_id, $prayforus_fields[3], true);

      $info = "<p>Dãy kệ: {$shelf}</p>";
      $info.= "<p>Hàng: {$row}</p>";
      $info.= "<p>Thứ tự: {$number}</p>";
      echo $info;
      break;
  }
}
add_action( 'manage_pray-for-us_posts_custom_column' , 'custom_content_columns_prayforus', 10, 2);

// REST API
function prayforus_register_routes() {
  register_rest_route('apigxphuhoa', '/pray-for-us/getall', array(
    'methods' => 'GET',
    'callback' => 'prayforus_api_get_all',
    'permission_callback' => '__return_true',
  ));

  register_rest_route('apigxphuhoa', '/pray-for-us/(?P<month>\d+)', array(
    'methods' => 'GET',
    'callback' => 'prayforus_api_get_on_month',
    'permission_callback' => '__return_true',
  ));

  register_rest_route('apigxphuhoa', '/pray-for-us/(?P<day>\d+)/(?P<month>\d+)', array(
    'methods' => 'GET',
    'callback' => 'prayforus_api_get_on_day_month',
    'permission_callback' => '__return_true',
  ));
}
add_action('rest_api_init', 'prayforus_register_routes');

function prayforus_api_query($meta_query = array()) {
  global $prayforus_fields;
  $respondData = [];
  $args = array(
    'post_type'      => 'pray-for-us',
    'order'          => 'DESC',
    'orderby'        => 'date',
    'posts_per_page' => -1,
    'meta_query'     => $meta_query,
  );
  $the_query = new WP_Query($args);

  foreach ($the_query->posts as $value) {
    $ID = $value->ID;

    $respondData[] = [
      'ID' => $ID,
      'name' => $value->post_title,
      'positionID' => get_post_meta($ID, $prayforus_fields[0], true),
      'img' => get_the_post_thumbnail_url($ID, 'medium') ?: '',
      'yearOfBirth' => get_post_meta($ID, $prayforus_fields[4], true),
      'yearOfDead' => get_post_meta($ID, $prayforus_fields[5], true),
      'shelf' => get_post_meta($ID, $prayforus_fields[1], true),
      'row' => get_post_meta($ID, $prayforus_fields[2], true),
      'number' => get_post_meta($ID, $prayforus_fields[3], true),
    ];
  }

  return new WP_REST_Response($respondData, 200);
}

function prayforus_api_get_all() {
  return prayforus_api_query();
}

function prayforus_api_get_on_month($request) {
  $month = sprintf('%02d', $request->get_param('month'));

  return prayforus_api_query([
    [
      'key'     => 'wpcf-pray-for-us-yearofdead',
      'value'   => '^[0-9]{4}\-'.$month.'\-[0-9]{2}',
      'compare' => 'REGEXP'
    ]
  ]);
}

function prayforus_api_get_on_day_month($request) {
  $day = sprintf('%02d', $request->get_param('day'));
  $month = sprintf('%02d', $request->get_param('month'));

  return prayforus_api_query([
    [
      'key'     => 'wpcf-pray-for-us-yearofdead',
      'value'   => '^[0-9]{4}\-'.$month.'\-'.$day,
      'compare' => 'REGEXP'
    ]
  ]);
}

// SPA: luôn enqueue asset React (build copy vào /app/static) ở front-end, app tự bỏ qua nếu trang không có div mount
function prayforus_spa_script() {
  $dir = plugin_dir_path(__FILE__) . 'app/static/';

  // Cache-bust bằng thời gian sửa file, vì tên file build cố định
  wp_enqueue_style('gxphuhoa-pray-for-us-spa', PLUGIN_URL_PRAYFORUS . 'app/static/css/main.css', array(), filemtime($dir . 'css/main.css'));
  wp_enqueue_script('gxphuhoa-pray-for-us-spa', PLUGIN_URL_PRAYFORUS . 'app/static/js/main.js', array(), filemtime($dir . 'js/main.js'), true);
  wp_add_inline_script('gxphuhoa-pray-for-us-spa', 'window.PRAY_FOR_US = ' . wp_json_encode(array(
    'api' => rest_url('apigxphuhoa/pray-for-us'),
    'publicPath' => PLUGIN_URL_PRAYFORUS . 'app/',
  )) . ';', 'before');
}
add_action('wp_enqueue_scripts', 'prayforus_spa_script');

// SPA: shortcode [pray_for_us] in div mount
function prayforus_spa_shortcode() {
  return '<div id="root-pray-for-us"></div>';
}
add_shortcode('pray_for_us', 'prayforus_spa_shortcode');

// FUNCTION
function get_prayforus_image($postID){
  $thumbnail = get_the_post_thumbnail_url($postID);

  return strlen($thumbnail) > 0 ? $thumbnail : get_template_directory_uri()."/images/no-img.jpg";
}
?>