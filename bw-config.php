<?php

$rr = explode("/", $_SERVER['REQUEST_URI']);
if ($rr[1] == 'wp-admin') {
	$url = '';
} else {
	$url = '/' . $rr[1] . '/';
}

define('BW_ABSPATH', dirname(__FILE__) . '/');
define('BW', 'wp-content/plugins/bet-on-sports/');
define('BW_WIDGET', 'wp-content/plugins/bet-on-sports/widget/');
define('BW_JS', WP_PLUGIN_URL . '/bet-on-sports/js/');
define('BW_CSS', WP_PLUGIN_URL . '/bet-on-sports/css/');
define('BW_IMAGES', $url . '/wp-content/plugins/bet-on-sports/images/');
define('BW_IMAGE', WP_PLUGIN_URL . '/bet-on-sports/images/');
define('BW_LOAD_TABS', BW_ABSPATH . 'admin_page_tab/');

include 'bw_xml.php';
?>
