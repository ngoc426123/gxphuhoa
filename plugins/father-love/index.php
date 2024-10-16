<?php
/**
 * Plugin Name: Father Lover
 * Plugin URI: http://gxphuhoa.org
 * Description: Plugin tạo Custom Post Type cho danh sách các linh mục của Gx. Phú Hoà.
 * Version: 1.0 
 * Author: minhngoc.ith
 * Author URI: minhngoc.ith@gmail.com
*/

define('PLUGIN_URL', plugin_dir_url( __FILE__ ));

// CUSTOM POST TYPE
function linhmuc_custom_post_type() {
  $label = array(
    'name' => 'Danh sách linh mục',
    'singular_name' => 'linh mục',
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
    'featured_image'=>'Ảnh',
    'set_featured_image'=>'Thêm hình ảnh',
    'remove_featured_image'=>'Xóa hình ảnh',
    'use_featured_image'=>'Sử dụng hình ảnh',
    'menu_name'=>'Linh mục',
    'name_admin_bar'=>'linh mục',
  );
  $support = array(
    'title',
    'editor',
    'thumbnail',
  );
  $arr = array(
    'labels' => $label,
    'description' => 'Danh sách linh mục đã và đang giúp đỡ giáo xứ',
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
  register_post_type('linh-muc', $arr);
};
add_action('init', 'linhmuc_custom_post_type');

// CUSTOM STYLE
function linhmuc_custom_style() {
  wp_enqueue_style('linhmucStyleDatetimepicker', PLUGIN_URL .'css/jquery.datetimepicker.min.css','all' );
  wp_enqueue_style('linhmucStyle', PLUGIN_URL .'css/style.css','all' );
}
add_action('admin_head', 'linhmuc_custom_style');

// CUSTOM SCRIPT
function linhmuc_custom_script() {
  wp_enqueue_script('jquery');
  wp_enqueue_script('linhmucScriptDatetimepicker', PLUGIN_URL .'js/jquery.datetimepicker.full.min.js','all' );
  wp_enqueue_script('linhmucScript', PLUGIN_URL .'js/custom.js','all' );
}
add_action('admin_footer', 'linhmuc_custom_script');

// META BOX
$wpcf_arr = [
  "wpcf-father-position",
  "wpcf-father-background",
  "wpcf-father-birthday",
  "wpcf-father-phone",
];

function formCallBackLinhMuc($post) {
  global $wpcf_arr;
  $wpcf_value = [];

  foreach($wpcf_arr as $value) {
    $wpcf_value[$value] = get_post_meta($post->ID, $value, true);
  };

  ?>
    <div class="father-form-group">
      <label class="father-form-label" for="father-position">Vị trí</label>
      <div class="father-form-input">
        <select name="wpcf-father-position" id="father-position" class="father-form-control">
          <option value="0">---Lựa chọn---</option>
          <option value="1" <?php echo $wpcf_value["wpcf-father-position"] == 1 ? 'selected' : '' ?>>Cha khách</option>
          <option value="2" <?php echo $wpcf_value["wpcf-father-position"] == 2 ? 'selected' : '' ?>>Chánh xứ</option>
          <option value="3" <?php echo $wpcf_value["wpcf-father-position"] == 3 ? 'selected' : '' ?>>Nguyên chánh xứ</option>
        </select>
        <span class="father-form-note">Lựa chọn vị trí cho linh mục, cha khách, chánh xứ hoặc nguyên chánh xứ</span>
      </div>
    </div>
    <div class="father-form-group">
      <label class="father-form-label" for="father-background">Xuất thân</label>
      <div class="father-form-input">
        <input type="input" name="wpcf-father-background" id="father-background" class="father-form-control" value="<?php echo $wpcf_value["wpcf-father-background"]?>">
        <span class="father-form-note">Nội dung là dòng hoặc chủng viện của linh mục</span>
      </div>
    </div>
    <div class="father-form-group">
      <label class="father-form-label" for="father-birthday">Ngày sinh</label>
      <div class="father-form-input">
        <input type="text" name="wpcf-father-birthday" id="father-birthday" class="father-form-control" value="<?php echo $wpcf_value["wpcf-father-birthday"]?>" autocomplete="off">
        <span class="father-form-note --red">* Phần này sẽ không hiển thị ngoài trang</span>
        <span class="father-form-note">Ngày tháng năm sinh - có thể để trống</span>
      </div>
    </div>
    <div class="father-form-group">
      <label class="father-form-label" for="father-phone">Điện thoại</label>
      <div class="father-form-input">
        <input type="text" name="wpcf-father-phone" id="father-phone" class="father-form-control" value="<?php echo $wpcf_value["wpcf-father-phone"]?>">
        <span class="father-form-note --red">* Phần này sẽ không hiển thị ngoài trang</span>
        <span class="father-form-note">Số điện thoại liên lạc - có thể để trống</span>
      </div>
    </div>
  <?php
}
function meta_box_linhmuc() {
  add_meta_box( 'metabox-linhmuc', 'Thông tin thêm', 'formCallBackLinhMuc', 'linh-muc' );
}
add_action( 'add_meta_boxes', 'meta_box_linhmuc' );

function linhmuc_save($post_id) {
  global $wpcf_arr;

  foreach ($wpcf_arr as $value) {
    
    if(isset($_POST[$value])){
      update_post_meta( $post_id, $value, $_POST[$value] );
    }
  }
}
add_action('save_post_linh-muc', 'linhmuc_save');

function linhmuc_edit($post_id) {
  global $wpcf_arr;

  foreach ($wpcf_arr as $value) {
    echo $_POST[$value];
    if(!$_POST[$value]){
      delete_post_meta($post_id, $value, $_POST[$value]);
    }
    else{
      update_post_meta( $post_id, $value, $_POST[$value] );
    }
  }
}
add_action( 'edit_post_linh-muc', 'linhmuc_edit' );

// CUSTOM MANAGER LIST
function custom_columns_linhmuc(){
  return array(
    'cb' => '<input type="checkbox" />',
    'father-image' => __('Hình'),
    'title' => __('Tên'),
    'father-info'  => __('Thông tin'),
    'date' => __('Ngày'),
  );
}
add_action('manage_linh-muc_posts_columns', 'custom_columns_linhmuc');

function custom_content_columns_linhmuc($column, $post_id){
  global $wpcf_arr;
  switch ($column) {
    case 'father-image' :
      $image = get_father_image($post_id);

      echo "<img class='father-thumbnail' src='{$image}'>";
      break;
    case 'father-info' :
      $position = '';
      switch (get_post_meta($post_id, $wpcf_arr[0], true)) {
        case '1':
          $position = "Cha khách";
          break;
        case '2':
          $position = "Chánh xứ";
          break;
        case '3':
          $position = "Nguyên chánh xứ";
          break;
        default:
          $position = "Chưa xác định";
      }
      $date = get_post_meta($post_id, $wpcf_arr[2], true);
      $background = get_post_meta($post_id, $wpcf_arr[1], true);
      $phone = get_post_meta($post_id, $wpcf_arr[3], true);
      $info = "<p>Ngày sinh: {$date}</p>";
      $info.= "<p>Vị trí: {$position}</p>";
      $info.= "<p>Xuất thân: {$background}</p>";
      $info.= "<p>Số điện thoại: {$phone}</p>";
      echo $info;
      break;
    };
}
add_action( 'manage_linh-muc_posts_custom_column' , 'custom_content_columns_linhmuc', 10, 2);

// FUNCTION
function get_father_image($postID){
  $thumbnail = get_the_post_thumbnail_url($postID);

  return strlen($thumbnail) > 0 ? $thumbnail : get_template_directory_uri()."/images/no-img.jpg";
}
?>