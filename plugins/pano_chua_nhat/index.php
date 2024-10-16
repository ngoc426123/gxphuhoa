<?php
/**
 * Plugin Name: Pano Chua Nhat
 * Plugin URI: http://gxphuhoa.org
 * Description: Plugin này cho phép lựa chọn noel Chúa Nhật hằng tuần các năm A, B, C.
 * Version: 1.0 
 * Author: minhngoc.ith
 * Author URI: minhngoc.ith@gmail.com
 * License: GPLv2 or later
 */
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL', plugin_dir_url( __FILE__ ));
/*=======ĐÂY LÀ PHẦN CỦA ADMIN========*/
function pano_init_menu() {
        add_menu_page("Quản lý pano","Pano chúa chật","administrator","pano-chua-nhat","pano_controller","",25);
}
add_action('admin_menu', 'pano_init_menu'); 
function pano_controller() {
	/*=======QUERY========================*/
	if(isset($_POST["ok"])){
		$link_pano = $_POST["selectNam"]."/".$_POST["selectPano"];
		global $wpdb;
		if($wpdb->query("SELECT * FROM $wpdb->options WHERE option_name = 'link_pano'")){
			$wpdb->update($wpdb->options,
				array('option_value' => $link_pano),
				array('option_name' => 'link_pano')
			);
		}
		else{
			$wpdb->insert($wpdb->options,array(
				'option_id' => $wpdb->insert_id, 
				'option_name' => 'link_pano',
				'option_value' => $link_pano,
				)
			);
		}
	}
	$nam = scandir(PLUGIN_PATH."nam");
	array_splice($nam,0,2);
?>
	<div class="pano_wrapper">
		<div class="panoTitle">
			<div class="t1">Bảng điều khiển pano Chúa Nhật</div>
			<div class="t2">GxphuHoa.org</div>
		</div>
		<div class="panoControl">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Chọn năm phụng vụ</label>
					<div class="colRight">
						<select name="selectNam" id="selectNam">
							<option value="">------Chọn năm</option>
						<?php
							foreach ($nam as $key => $value) {
						?>
								<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
						<?php
							}
						?>
						</select>
					</div>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<label for="">Chọn pano</label>
					<div class="colRight">
						<select name="selectPano" id="selectPano">
							<option value="">------Chọn pano</option>
						</select>
					</div>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<label for=""></label>
					<div class="colRight">
						<button name="ok" class="button button-primary button-large">Đồng ý</button>
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
	</div>
<?php
}
function short_pano(){
	global $wpdb;
	$res = $wpdb->get_row("SELECT * FROM $wpdb->options WHERE option_name = 'link_pano'");
	$url = PLUGIN_URL."nam/".$res->option_value;
	return "<img src='{$url}' alt='Pano Chúa Nhật Giáo Xứ Phú Hòa' style='width:100%'/>";
}
add_shortcode( 'panochuanhat', 'short_pano');
function pano_style(){
	wp_register_style("panoStyle", PLUGIN_URL."css/style.css");
	wp_enqueue_style("panoStyle");
	wp_register_script("panoStyle", PLUGIN_URL."js/style.js");
    $args=array(
        'url'   =>  admin_url('admin-ajax.php'),
    );
    wp_localize_script('panoStyle','pano_url',$args);
    wp_enqueue_script("panoStyle");
}
add_action( 'admin_enqueue_scripts', 'pano_style' );
function ajax_pano(){
	$pano = scandir(PLUGIN_PATH."nam/".$_POST["nam"]);
	array_splice($pano,0,2);
	foreach ($pano as $key => $value) {
	?>
		<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
	<?php
	}
	die();
}
add_action( 'wp_ajax_ajax_pano', 'ajax_pano' );
add_action( 'wp_ajax_nopriv_ajax_pano', 'ajax_pano' );
/*=====ĐÂY LÀ PHẦN CỦA PLUGIN=======*/
function init(){
	echo "";
}
add_action( 'plugins_loaded', 'init' );
?>