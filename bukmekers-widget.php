<?php
/*
  Plugin Name: Stakes on sport. Prognoses.
  Plugin URI: http://www.bukmekerskajakontora.ru/
  Description: Tables, stakes on sport, prognoses. There are two widgets - the upper and the side ones, where the coefficients for stakes of bookmaker's office betathome are shown, the visitors of your site can enter stakes at once! The partner reference can be changed, there is an opportunity to screen different types of sport.
  Version: 2.5.1
  Author: SEOAlbion
  Author URI: http://www.bukmekerskajakontora.ru/
  Tags: sport, stakes, sport prognoses, coefficients, tables of stakes , bookmaker's coefficient, bookmaker's office, stakes on sport, sport widgets,  widgets , affiliate
 */

register_activation_hook(__FILE__, 'bw_set_options');
register_deactivation_hook(__FILE__, 'bw_unset_options');

$url = explode("/", get_bloginfo('url'));
$uri = ( isset( $url[3] ) ) ? $url[3] . '/' : '/';
add_action('plugins_loaded', 'myplugin_init');
function myplugin_init() {
     load_plugin_textdomain( 'bet-on-sports', false, dirname( plugin_basename( __FILE__ )).'/language/' );
}


require 'bw-config.php';
require 'bw-stakes.php';
require 'bw-ajax.php';
require 'bw-shortcode.php';
require 'bw-functions.php';

function bw_set_options() {
	Stakes::bw_set_options();
//	$Bw_ajax = new Bw_ajax();
//	$Bw_ajax->my_action_callback( false );
//	unset( $Bw_ajax );
}

function bw_unset_options() {
	Stakes::bw_unset_options();
}

if (is_admin()) {
	add_action('admin_menu', array('Stakes', 'bw_admin_menu'));
}

add_shortcode('bw_get_id_tournament', array('Bw_shortcode', 'bw_get_tournament'));
add_action('wp_print_styles', array('Stakes', 'bw_user_css'));
add_action('wp_enqueue_scripts', array('Stakes', 'bw_user_js'));


if (@$_GET['page'] == 'bw_main_page') {
	add_action('admin_init', array('Stakes', 'bw_admin_js'));
	add_action('admin_init', array('Stakes', 'bw_admin_css'));
}


require 'widget/widget_top.php';
require 'widget/widget_sports.php';

add_action('wp_ajax_my_action', array('Bw_ajax', 'my_action_callback'));
add_action('wp_ajax_nopriv_my_action', array('Bw_ajax', 'my_action_callback'));
add_action('wp_ajax_set_default', array('Bw_ajax', 'set_default_callback'));
add_action('wp_ajax_nopriv_set_default', array('Bw_ajax', 'set_default_callback'));
add_action('wp_ajax_update_lang', array('Bw_ajax', 'update_lang_callback'));

add_action('widgets_init', create_function('', 'register_widget( "Bw_top_widget" );'));
add_action('widgets_init', create_function('', 'register_widget( "Bw_sports_widget" );'));
?>