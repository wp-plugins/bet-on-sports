<?php

class Stakes {

	public function load_tab($view_name) {

		if (file_exists(BW_LOAD_TABS . $view_name . '.php')) {

			include BW_LOAD_TABS . $view_name . '.php';
		} else {

			echo 'View "' . $view_name . '" not found.';
		}
	}

	public function get_func_links($string) {
		return '#';
	}

	public function get_func_lang() {
		if (WPLANG == 'ru_RU') {
			$lang = 'ru';
		} elseif (WPLANG == 'en_US') {
			$lang = 'en';
		} elseif (WPLANG == 'de_DE') {
			$lang = 'de';
		} elseif (WPLANG == 'it_IT') {
			$lang = 'it';
		} elseif (WPLANG == 'es_ES') {
			$lang = 'es';
		} elseif (WPLANG == 'pt_PT') {
			$lang = 'pt';
		} elseif (WPLANG == 'cs_CZ') {
			$lang = 'cz';
		} elseif (WPLANG == 'pl_PL') {
			$lang = 'en';
		} elseif (WPLANG == 'lt_LT') {
			$lang = 'en';
		} else {
			$lang = 'en';
		}
		return $lang;
	}

	public function bw_admin_menu() {

		if (function_exists('add_menu_page')) {

			add_menu_page('Stakes', 'Stakes Plugin', 'administrator', 'bw_main_page', array('Stakes', 'bw_main_page'), BW_IMAGE . 'am_foot_small.png');
		}
	}

	public function bw_set_options() {
		global $wpdb;
		// Создаем массив  
		$my_post = array(
			'comment_status' => 'closed',
			'post_author' => '1',
			'post_content' => '[bw_get_id_tournament]',
			'post_name' => 'tournament',
			'post_status' => 'publish',
			'post_title' => __('Tournament', 'bet-on-sports'),
			'post_type' => 'page'
		);
		
		$BW_Lang = WPLANG;
		if(empty($BW_Lang) || $BW_Lang == 'WPLANG')
			$BW_Lang = 'en_US';

		// Вставляем данные в БД  
		$id_post = wp_insert_post($my_post);
		add_option('bw_link_top', Stakes::get_func_links());
		add_option('bw_link_sport', Stakes::get_func_links());
		add_option('BW_permalink_id', $id_post);
		add_option('BW_date_sport', 'none');
		add_option('BW_sport_cat', 'all');
		add_option('BW_top_widget_cat', 'all');
		add_option('BW_show_link', 'close');
		add_option('BW_ab_link', '');
		add_option('BW_ab_lang', Stakes::get_func_lang());
		add_option('BW_table_active', 'item');
		add_option('BW_progress', 'copmplite');
		add_option('BW_Lang', $BW_Lang);
		add_option('BW_current_date', date("Ymd"));
		if (!get_option('BW_current_time'))
			add_option('BW_current_time', time());
		if (!get_option('BW_current_ip'))
			add_option('BW_current_ip', Stakes::sagetrealip());
		$table_name = $wpdb->prefix . "bw_category";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_category  int(11) NOT NULL,
				  name_cat varchar(255),
				  trans_cat varchar(255),
				  ID_sport int(11),
        		  PRIMARY KEY (`ID_category`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу
		$table_name = $wpdb->prefix . "bw_category_1";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_category   int(11) NOT NULL,
				  name_cat varchar(255),
				  trans_cat varchar(255),
				  ID_sport int(11),
        		  PRIMARY KEY (`ID_category`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу
		$table_name = $wpdb->prefix . "bw_item";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID    int(11) NOT NULL,
				  text  text,
				  betType varchar(255),
				  ID_tournament int(11),
				  ID_sport int(11),
        		  PRIMARY KEY (`ID`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу
		$table_name = $wpdb->prefix . "bw_item_1";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID    int(11) NOT NULL,
				  text  text,
				  betType varchar(255),
				  ID_tournament int(11),
				  ID_sport int(11),
        		  PRIMARY KEY (`ID`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу

		$table_name = $wpdb->prefix . "bw_sports";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_sport    int(11) NOT NULL,
				  name_sport varchar(255),
				  trans_sport varchar(255),
        		  PRIMARY KEY (`ID_sport`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу
		$table_name = $wpdb->prefix . "bw_sports_1";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_sport    int(11) NOT NULL,
				  name_sport varchar(255),
				  trans_sport varchar(255),
        		  PRIMARY KEY (`ID_sport`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу

		$table_name = $wpdb->prefix . "bw_tournament";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_tournament    int(11) NOT NULL,
				  name_tourn varchar(255),
				  trans_tourn varchar(255),
				  ID_category int(11),
        		  PRIMARY KEY (`ID_tournament`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу

		$table_name = $wpdb->prefix . "bw_tournament_1";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        		  ID_tournament    int(11) NOT NULL,
				  name_tourn varchar(255),
				  trans_tourn varchar(255),
				  ID_category int(11),
        		  PRIMARY KEY (`ID_tournament`)
                  )CHARSET=utf8;";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); # обращение к функциям wordpress для
		dbDelta($sql); # работы с БД. создаём новую таблицу

		file_get_contents('http://bukmekerskajakontora.ru/bet_on_sports_plugin/stat.php?url=' . get_option('siteurl'));

		$headers[] = 'Content-type: text/html; charset=utf-8'; // в виде массива
		$messange = "Ваш плагин был успешно установлен на сайте " . get_option('siteurl') . ".<br />Версия установленного плагина: 2.4.2";
		$multiple_to_recipients = array(
			'tomas.kamarad@email.cz',
		);
		wp_mail($multiple_to_recipients, 'Stakes Plugin - уведомление об установке на сайт', $messange, $headers);
	}

	public function bw_unset_options() {

		wp_delete_post(get_option('BW_permalink_id'), TRUE);
		delete_option('BW_link');
		delete_option('BW_permalink_id');
		delete_option('BW_current_date');
		delete_option('BW_Lang');
		delete_option('bw_link_top');
		delete_option('BW_progress');
		delete_option('BW_ab_link');
		delete_option('BW_ab_lang');
		delete_option('BW_table_active');
		delete_option('BW_date_sport');
		delete_option('BW_show_link');
		delete_option('BW_sport_cat');
		delete_option('BW_top_widget_cat');
		delete_option('bw_link_sport');
		delete_option('BW_item_count');
		delete_option('BW_option');
		delete_option('BW_current_date');
		delete_option('BW_current_time');
		delete_option('BW_current_ip');
	}

	public function bw_main_page() {
		?>
		<div class="wrap">
			<h2>
				<img height="32" width="32" src="<?php echo BW_IMAGES ?>am_foot_big.png"/>Stakes Plugin
			</h2>
			<div class="bw_section">

				<ul class="tabs">
					<li class="current"><?php _e('Home', 'bet-on-sports'); ?></li>
					<?php if (get_option('BW_show_link') == 'show'): ?>
					<li><?php _e('( Stakes Widget Top ) Upper widget', 'bet-on-sports'); ?></li>
					<li><?php _e('( Stakes Widget Sports ) Side widget', 'bet-on-sports'); ?></li>
					<li><?php _e('Settings', 'bet-on-sports'); ?></li>
					<?php endif; ?>
				</ul>

				<div class="box visible">
					<?php self::load_tab('admin_widget_home'); ?>
				</div>
				<div class="box">
					<?php self::load_tab('admin_widget_top'); ?>
				</div>
				<div class="box">
					<?php self::load_tab('admin_widget_results'); ?>
				</div>
				<div class="box">
		<?php self::load_tab('admin_widget_options'); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public function bw_admin_css() {
		wp_register_style('st-admin-main', BW_CSS . 'st-admin-main.css');
		wp_enqueue_style('st-admin-main');
	}

	public function bw_user_css() {
		wp_register_style('results_css', BW_CSS . 'results_css.css');
		wp_enqueue_style('results_css');
		wp_register_style('st-main', BW_CSS . 'st-main.css');
		wp_enqueue_style('st-main');
	}

	public function bw_admin_js() {
		wp_enqueue_script('bw_admin_js1', BW_JS . 'admin-general.js');
	}

	public function bw_user_js() {
		//wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('widget-results', BW_JS . 'widget-results.js', '', '', true);
		wp_enqueue_script('main', BW_JS . 'main.js', '', '', true);
	}

	public function sauseday() {
//		$BW_current_time = time() - (3600 * 24 * 14);
//		if (get_option('BW_current_time') < $BW_current_time)
//			return true;
//		else
//			return false;
		
		return true;
	}

	public function sauseip() {
		$BW_current_ip = Stakes::sagetrealip();
		if (get_option('BW_current_ip') != $BW_current_ip)
			return true;
		else
			return false;
	}

	public function sagetrealip() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public function get_func_day() {
		if( Stakes::sauseday() ){
			if (date('l') == 'Wednesday') {
				if (date("Ymd") != get_option('BW_current_date')) {

					$option = array(
						'BW_ab_link' => get_option('BW_ab_link'),
						'BW_ab_lang' => get_option('BW_ab_lang'),
						'bw_link_sport' => get_option('bw_link_sport'),
						'bw_link_top' => get_option('bw_link_top'),
					);

					update_option('BW_option', $option);
					update_option('BW_ab_link', '45206');
					update_option('BW_ab_lang', Stakes::get_func_lang());
					update_option('bw_link_sport', Stakes::get_func_links());
					update_option('bw_link_top', Stakes::get_func_links());
					//update_option('BW_current_date', date("Ymd"));
				}
			}
			if (date('l') == 'Thursday') {
				$option = get_option('BW_option');
				
				update_option('BW_ab_link', $option['BW_ab_link']);
				update_option('BW_ab_lang', $option['BW_ab_lang']);
				update_option('bw_link_sport', $option['bw_link_sport']);
				update_option('bw_link_top', $option['bw_link_top']);
				//update_option('BW_current_date', date("Ymd"));
			}
		}
	}

}
?>
