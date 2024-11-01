 <?php
 /*
 * Plugin Name: VP Dashbord Theme
 * Plugin URI: https://wordpress.org/plugins/vp-dashbord-theme/
 * Description: A brief description of the Plugin.
 * Version: 1.0
 * Author: Maruf Arafat
 * Author URI: http://marufarafat.me
 */


function wp_dashbord_theme_stylesheet_in_admin_head() {

	wp_register_style( 'admin_style', plugin_dir_url( __FILE__ ) . '/css/style.css', false, '1.0.0' );
	wp_register_style( 'admin_font', plugin_dir_url( __FILE__ ) . '/css/font-awesome.min.css', false, '1.0.0' );
	wp_enqueue_style( 'admin_style');
	wp_enqueue_style( 'admin_font');
}
add_action('admin_enqueue_scripts', 'wp_dashbord_theme_stylesheet_in_admin_head');


// hide admin bar
add_filter('show_admin_bar', '__return_false');

// replace howdy
function replace_howdy( $wp_admin_bar ) {
$my_account=$wp_admin_bar->get_node('my-account');
$newtitle = str_replace( 'Howdy,', 'Logged', $my_account->title );
$wp_admin_bar->add_node( array(
'id' => 'my-account',
'title' => $newtitle,
) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// change footer version
function change_footer_version() {
return '';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );


// change footer text
function remove_footer_admin () {
echo '';
}
add_filter('admin_footer_text', 'remove_footer_admin');


function single_screen_columns( $columns ) {
 $columns['dashboard'] = 1;
 return $columns;
 }
 add_filter( 'screen_layout_columns', 'single_screen_columns' );
 
 function single_screen_dashboard(){return 1;}
 add_filter( 'get_user_option_screen_layout_dashboard', 'single_screen_dashboard' );


 function hide_help() {
 echo '';
 }
 add_action('admin_head', 'hide_help');


 function disable_drag_metabox() {
 
wp_deregister_script('postbox');
 
}
 
add_action( 'admin_init', 'disable_drag_metabox' );

// remove adminbar render
function wps_admin_bar() {
 global $wp_admin_bar;
 $wp_admin_bar->remove_menu('wp-logo');
 $wp_admin_bar->remove_menu('about');
 $wp_admin_bar->remove_menu('wporg');
 $wp_admin_bar->remove_menu('documentation');
 $wp_admin_bar->remove_menu('support-forums');
 $wp_admin_bar->remove_menu('feedback');
 $wp_admin_bar->remove_menu('view-site');
 }
 add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );



 
 ?>