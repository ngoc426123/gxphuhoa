<?php
/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                        ADD CSS AND JS FOR STYLE                           ///
/////////////////                                               /////////////////
add_filter('use_block_editor_for_post', '__return_false');
function gxphuhoa_styles(){
  wp_enqueue_style('gxStyleTemplate', get_template_directory_uri().'/css/style.min.css','all' );
  wp_enqueue_style('gxStyleDeco', get_stylesheet_directory_uri().'/style.css','all' );
}
add_action('wp_enqueue_scripts', 'gxphuhoa_styles');
function gxphuhoa_scripts(){
  wp_enqueue_script('gxScript', get_template_directory_uri().'/js/app.min.js');

  wp_register_script('ajax','');
  $args=array(
      'url_share' => get_permalink(),
  );
  wp_localize_script('ajax','ajax_url',$args);
  wp_enqueue_script('ajax');
}
add_action('wp_footer', 'gxphuhoa_scripts');

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                               META BOX                                    ///
/////////////////                                               /////////////////
add_theme_support( 'post-thumbnails' );
function my_remove_meta_boxes() {
  remove_meta_box('slugdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('postcustom', 'post', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
  remove_meta_box('revisionsdiv', 'post', 'normal');
  remove_meta_box('commentsdiv', 'post', 'normal');
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );
// ==================REMOVE HTML EXCERPT================//
add_filter('the_excerpt','remove_html_excerpt');
function remove_html_excerpt($text){
	$result=strip_tags($text);
	return $result;
}
// ==================ADD META BOX=======================//
function callback_function($post){
?>
  <div class="form-group">
    <label for="tin-hot">
    <?php
    if(get_post_meta( $post->ID, 'wpcf-tin-hot', true )){
    ?>
      <input type="checkbox" name="wpcf-tin-hot" id="tin-hot" checked>
    <?php
    }
    else{
    ?>
      <input type="checkbox" name="wpcf-tin-hot" id="tin-hot">
    <?php
    }
    ?>
      Tin thông báo của giáo xứ.
    </label>
  </div>
  <div class="form-group">
    <label for="tin-nen-doc">
    <?php
    if(get_post_meta( $post->ID, 'wpcf-tin-nen-doc', true )){
    ?>
      <input type="checkbox" name="wpcf-tin-nen-doc" id="tin-nen-doc" checked>
    <?php
    }
    else{
    ?>
      <input type="checkbox" name="wpcf-tin-nen-doc" id="tin-nen-doc">
    <?php
    }
    ?>
      Tin nên đọc (Tin khuyến nghị).
    </label>
  </div>
<?php
}
function meta_box_tintuc(){
  add_meta_box( 'metabox-tintuc', 'Chức năng tin tức', 'callback_function', 'post' );
}
add_action( 'add_meta_boxes', 'meta_box_tintuc' );
function tintuc_save( $post_id ){
  if(isset($_POST["wpcf-tin-hot"])){
    update_post_meta( $post_id, 'wpcf-tin-hot', 'tinhot' );
  }
  if(isset($_POST["wpcf-tin-nen-doc"])){
    update_post_meta( $post_id, 'wpcf-tin-nen-doc', 'tinnendoc' );
  }
}
add_action( 'save_post', 'tintuc_save' );
function tintuc_edit( $post_id ){
  if(!$_POST["wpcf-tin-hot"]){
    delete_post_meta($post_id,'wpcf-tin-hot','tinhot');
  }
  else{
    update_post_meta( $post_id, 'wpcf-tin-hot', 'tinhot' );
  }
  if(!$_POST["wpcf-tin-nen-doc"]){
    delete_post_meta($post_id,'wpcf-tin-nen-doc','tinnendoc');
  }
  else{
    update_post_meta( $post_id, 'wpcf-tin-nen-doc', 'tinnendoc' );
  }
}
add_action( 'edit_post', 'tintuc_edit' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                        CUSTOM GET POST THUMNAIL                           ///
/////////////////                                               /////////////////
function get_thumb(){
  if(has_post_thumbnail()){
    $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_name');
    $thumbnail_img=$thumbnail[0];
    if(@getimagesize($thumbnail_img)){
      return the_post_thumbnail_url('large');
    }
    else{
      return get_template_directory_uri()."/images/no-img.jpg";
    }
  }
  else{
    return get_template_directory_uri()."/images/no-img.jpg";
  }
  // return get_template_directory_uri()."/images/no-img.jpg";
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                        CUSTOM POST TYPE GOP Y                             ///
/////////////////                                               /////////////////
$label = array(
  'name' => 'Các Góp ý',
  'singular_name' => 'góp ý',
  'add_new' => 'Thêm góp ý',
  'add_new_item' => 'Thêm góp ý mới',
  'edit_item' => 'Sửa góp ý',
  'new_item' => 'góp ý mới',
  'view_item' => 'Xem góp ý',
  'view_items'=>'Xem tất cả góp ý',
  'search_items'=>'Tìm kiếm góp ý',
  'not_found'=>'Không có góp ý',
  'not_found_in_trash'=>'Không có góp ý nào trong thùng rác',
  'parent_item_colon'=>'Danh mục cha',
  'all_items'=>'Tất cả góp ý',
  'archives'=>'Danh mục',
  'attributes'=>'Thuộc tính',
  'insert_into_item'=>'Thêm phương tiện',
  'uploaded_to_this_item'=>'Tải lên phương tiện',
  'featured_image'=>'Ảnh góp ý',
  'set_featured_image'=>'Thêm hình ảnh góp ý',
  'remove_featured_image'=>'Xóa hình ảnh góp ý',
  'use_featured_image'=>'Sử dụng hình ảnh góp ý',
  'menu_name'=>'Góp ý người dùng',
  'name_admin_bar'=>'góp ý',
);
$support = array(
  'title',
  'editor',
);
$arr = array(
  'labels' => $label,
  'description' => 'Góp ý của người dùng về website',
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
  'capabilities' => array(
      'create_posts' => 'do_not_allow',
  ),
);
// register_post_type('gop-y', $arr);
// ==================================//
function custom_columns($column, $post_id){
  return array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Tên'),
    'info'  => __('Thông tin'),
    'content' => __('Nội dung'),
    'date' => __('Ngày'),
  );
}
add_action('manage_gop-y_posts_columns', 'custom_columns');

function custom_content_columns($column, $post_id){
  switch ($column) {
    case 'content' :
      $post = get_post($post_id);
      $content = $post->post_content;
      echo $content;
      break;
    case 'info' :
      $address = get_post_meta($post_id,'contact-address',true);
      $email = get_post_meta($post_id,'contact-email',true);
      $gx = get_post_meta($post_id,'contact-gx',true);
      $info = "<p>Địa chỉ : {$address}</p>";
      $info.= "<p>Email : {$email}</p>";
      $info.= "<p>Giáo xứ : {$gx}</p>";
      echo $info;
      break;
    };
}
add_action( 'manage_gop-y_posts_custom_column' , 'custom_content_columns',10,2);
/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                              ADMIN INIT                                   ///
/////////////////                                               /////////////////

/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                           API READ MORE                                   ///
/////////////////                                               /////////////////
add_action('rest_api_init', 'regis_api_gxphuhoa');
function regis_api_gxphuhoa () {
  new api_gxphuhoa();
}
class api_gxphuhoa {
  public function __construct() {
    $this->register_routes();
  }

  public function register_routes () {
    register_rest_route('apigxphuhoa', 'posts', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_posts'),
    ));

    register_rest_route('apigxphuhoa', 'gallery-login', array(
      'methods' => 'POST',
      'callback' => array($this, 'get_gallery_login'),
    ));

    register_rest_route('apigxphuhoa', 'gallery-author-user', array(
      'methods' => 'POST',
      'callback' => array($this, 'get_gallery_author_user'),
    ));

    register_rest_route('apigxphuhoa', '/pray-for-us/(?P<month>\d+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_pray_for_us_on_month'),
    ));

    register_rest_route('apigxphuhoa', '/pray-for-us/(?P<day>\d+)/(?P<month>\d+)', array(
      'methods' => 'GET',
      'callback' => array($this, 'get_pray_for_us_on_day_month'),
    ));
  }

  public function get_posts ($request) {
    $data = [];
    $cate = $request->get_param('cate');
    $offset = $request->get_param('offset');
    $perpage = $request->get_param('perpage');
    $args = array(
      'category__in'   => array($cate),
      'order'          => 'DESC',
      'orderby'        => 'date',
      'posts_per_page' => $perpage,
      'offset'         => $offset,
    );
    $the_query = new WP_Query($args);
    $resultQuery = $the_query->posts;

    foreach ($resultQuery as $value) {
      $img = '';
      $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_name');
      $thumbnail_img=$thumbnail[0];

      if(@getimagesize($thumbnail_img)){
        $img = $thumbnail_img;
      }
      else{
        $img = get_template_directory_uri()."/images/no-img.jpg";
      }

      $data[] = array(
        'img' => $img,
        'title' => $value->post_title,
        'des' => $value->post_excerpt,
        'date' => get_the_date('h:m:s d/m/yy', $value->ID),
        'link' => get_permalink($value->ID),
        'cat' => get_the_terms($value->ID, 'category'),
      );
    }

    return new WP_REST_Response( $data, 200 );
  }

  public function get_gallery_login($request) {
    // GET PARAMS
    $username = $request->get_param('username');
    $password = $request->get_param('password');

    // LOGIN
    $signon = wp_signon([
      'user_login'    => $username,
      'user_password' => $password,
    ]);

    // LOGIN FAIL: WRONG USER OR PASSWORD
    if (is_wp_error($signon)) {
      $arrayResult = [
        'success' => false,
        'error'   => $signon->get_error_message()
      ];
      return new WP_Error('wrong_user', $signon->get_error_message(), ['status' => 400]);
    };

    // NOT GALLERY PERMISSION
    $caps = $signon->caps;
    $isGalleryRole = $caps['gallery-role'];

    if (!$isGalleryRole) {
      return new WP_Error('no_permission', 'You do not have permission to access Gallery.', ['status' => 400]);
    }

    // SUCCESS
    $role = $signon;
    $data = [
      'success' => true,
      'data'    => [
        'ID'            => $role->data->ID,
        'user_login'    => $role->data->user_login,
        'user_nicename' => $role->data->user_nicename,
        'user_email'    => $role->data->user_email,
        'display_name'  => $role->data->display_name,
      ],
    ];

    return new WP_REST_Response($data, 200);
  }

  public function get_gallery_author_user($request) {
    $ID = $request->get_param('ID');
    $user = get_user_by('ID', $ID);

    // NOT GALLERY PERMISSION
    $caps = $user->caps;
    $isGalleryRole = $caps['gallery-role'];

    if (!$isGalleryRole) {
      return new WP_Error('no_permission', 'You do not have permission to access Gallery.', ['status' => 400]);
    }

    $data = [
      'success' => true,
      'data'    => [
        'ID'            => $user->data->ID,
        'user_login'    => $user->data->user_login,
        'user_nicename' => $user->data->user_nicename,
        'user_email'    => $user->data->user_email,
        'display_name'  => $user->data->display_name,
      ],
    ];

    return new WP_REST_Response($data, 200);
  }

  public function get_pray_for_us_on_month($request) {
    $month = $request->get_param('month');
    $args = array(
      'post_type'  => 'pray-for-us',
      'order'      => 'DESC',
      'orderby'    => 'date',
      'meta_query' => [
        [
          'key'     => 'wpcf-pray-for-us-yearofdead',
          'value'   => '^[0-9]{2}\/'.$month.'/[0-9]{4}',
          'compare' => 'REGEXP'
        ]
      ]
    );
    $the_query = new WP_Query($args);
    $resultQuery = $the_query->posts;

    foreach ($resultQuery as $key => $value) {
      $ID = $value->ID;

      $resultQuery[$key]->img = get_the_post_thumbnail_url($ID);
      $resultQuery[$key]->prayID = get_post_meta( $ID, 'wpcf-pray-for-us-ID', true);
      $resultQuery[$key]->yearBirth = get_post_meta( $ID, 'wpcf-pray-for-us-yearofbirth', true);
      $resultQuery[$key]->yearDead = get_post_meta( $ID, 'wpcf-pray-for-us-yearofdead', true);
      $resultQuery[$key]->shelf = get_post_meta( $ID, 'wpcf-pray-for-us-shelf', true);
      $resultQuery[$key]->row = get_post_meta( $ID, 'wpcf-pray-for-us-row', true);
      $resultQuery[$key]->number = get_post_meta( $ID, 'wpcf-pray-for-us-number', true);
    }

    return new WP_REST_Response($resultQuery, 200);
  }

  public function get_pray_for_us_on_day_month($request) {
    $day = $request->get_param('day');
    $month = $request->get_param('month');
    $args = array(
      'post_type'  => 'pray-for-us',
      'order'      => 'DESC',
      'orderby'    => 'date',
      'meta_query' => [
        'relation' => 'AND',
        [
          'key'     => 'wpcf-pray-for-us-yearofdead',
          'value'   => '^[0-9]{2}\/'.$month.'/[0-9]{4}',
          'compare' => 'REGEXP'
        ],
        [
          'key'     => 'wpcf-pray-for-us-yearofdead',
          'value'   => $day.'/'.$month.'/[0-9]{4}',
          'compare' => 'REGEXP'
        ]
      ]
    );
    $the_query = new WP_Query($args);
    $resultQuery = $the_query->posts;

    foreach ($resultQuery as $key => $value) {
      $ID = $value->ID;

      $resultQuery[$key]->img = get_the_post_thumbnail_url($ID);
      $resultQuery[$key]->prayID = get_post_meta( $ID, 'wpcf-pray-for-us-ID', true);
      $resultQuery[$key]->yearBirth = get_post_meta( $ID, 'wpcf-pray-for-us-yearofbirth', true);
      $resultQuery[$key]->yearDead = get_post_meta( $ID, 'wpcf-pray-for-us-yearofdead', true);
      $resultQuery[$key]->shelf = get_post_meta( $ID, 'wpcf-pray-for-us-shelf', true);
      $resultQuery[$key]->row = get_post_meta( $ID, 'wpcf-pray-for-us-row', true);
      $resultQuery[$key]->number = get_post_meta( $ID, 'wpcf-pray-for-us-number', true);
    }

    return new WP_REST_Response($resultQuery, 200);
  }
}

/////////////////////////////////////////////////////////////////////////////////
/////////////////                                               /////////////////
///                             GOOGLE API                                    ///
/////////////////                                               /////////////////
// require_once locate_template('third_party/google-api/Autoload.php');

// function getYoutubePlaylist($playlistId) {
//   $developKey = "AIzaSyAPm9YuvXyOeh4u1tTtg1JL4WT2_4Ro5c0";
//   $client = new Google\Client();
//   $client->setApplicationName('Get Playlist');
//   $client->setScopes(['https://www.googleapis.com/auth/youtube.readonly']);
//   $client->setDeveloperKey($developKey);
//   $service = new Google_Service_YouTube($client);
//   $queryParamsPlaylist = [
//     'playlistId' => $playlistId,
//     'maxResults' => 50,
//   ];
//   $stringListVideos = '';
//   $return = [];
//   $responsePlaylist = $service->playlistItems->listPlaylistItems('id, contentDetails, snippet, status', $queryParamsPlaylist);
//   foreach ($responsePlaylist as $value) {
//     $stringListVideos .= $value['snippet']['resourceId']['videoId'] . ',';
//   }
//   $queryParamsListVideos = [
//     'id' => $stringListVideos
//   ];
//   $responseListVideos = $service->videos->listVideos('snippet,contentDetails,statistics', $queryParamsListVideos);
//   foreach($responseListVideos['items'] as $value) {
//     $duration = $value['contentDetails']['duration'];
//     $formatDuration = formatDuration($duration);
//     $return[] = [
//       'id' => $value['id'],
//       'duration' => $duration,
//       'durationFormat' => $formatDuration,
//       'title' => $value['snippet']['title'],
//       'liveBroadcastContent' => $value['snippet']['liveBroadcastContent'],
//       'thumbnail' => $value['snippet']['thumbnails']['standard']['url'],
//       'publishAt' => $value['snippet']['publishedAt'],
//     ];
//   };
//   return $return;
// }

// function formatDuration($input) {
//   $duration = new DateInterval($input);
//   $hour = preLeadZeroNumber($duration->h);
//   $mins = preLeadZeroNumber($duration->i);
//   $secs = preLeadZeroNumber($duration->s);

//   return $hour.":".$mins.":".$secs;
  
// }

// function preLeadZeroNumber($input) {
//   return sprintf("%02d", $input);
// }
?>