<?php
/*
  Plugin Name: Ставки на спорт. Прогнозы.
  Plugin URI: http://www.bukmekerskajakontora.ru/
  Description: Таблицы, ставки на спорт, прогнозы. Посетители вашего сайта смогут делать ставки, используя два виджета - верхний и боковой, где выводятся коэффициенты ставок букмекерской конторы bet-at-home! В этих виджетах можно менять партнерскую ссылку, а также выводить разные виды спорта.
  Version: 1.2
  Author: SEOAlbion
  Author URI: http://www.bukmekerskajakontora.ru/
  Tags: widgets, Stakes
 */

register_activation_hook(__FILE__, 'bw_set_options');
register_deactivation_hook(__FILE__, 'bw_unset_options');

$url = explode("/", get_bloginfo('url'));
$uri = ($url[3]) ? $url[3] . '/' : '/';

require 'bw-config.php';
require 'bw-stakes.php';
require 'bw-ajax.php';
require 'bw-shortcode.php';

function bw_set_options() {
	Stakes::bw_set_options();
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
add_action('wp_footer', array('Stakes', 'bw_func_carusel'), 900);

if (@$_GET['page'] == 'bw_main_page') {
	add_action('admin_init', array('Stakes', 'bw_admin_js'));
	add_action('admin_init', array('Stakes', 'bw_admin_css'));
}

require 'bw-functions.php';
require 'widget/widget_top.php';
require 'widget/widget_sports.php';

add_action('wp_ajax_my_action', array('Bw_ajax', 'my_action_callback'));
add_action('wp_ajax_nopriv_my_action', array('Bw_ajax', 'my_action_callback'));
add_action('wp_ajax_set_default', array('Bw_ajax', 'set_default_callback'));
add_action('wp_ajax_nopriv_set_default', array('Bw_ajax', 'set_default_callback'));

add_action('widgets_init', create_function('', 'register_widget( "Bw_top_widget" );'));
add_action('widgets_init', create_function('', 'register_widget( "Bw_sports_widget" );'));
?>