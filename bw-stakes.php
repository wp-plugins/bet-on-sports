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
		if ($string == 'top') {
			if (WPLANG == 'ru_RU') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_ru';
			} elseif (WPLANG == 'en_US') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_en';
			} elseif (WPLANG == 'de_DE') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_de';
			} elseif (WPLANG == 'it_IT') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_it';
			} elseif (WPLANG == 'es_ES') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_es';
			} elseif (WPLANG == 'pt_PT') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_pt';
			} elseif (WPLANG == 'cs_CZ') {
				$link = 'http://www.bukmekerskajakontora.ru/go/wh2_cs';
			}
			return $link;
		}
		if ($string == 'sport') {
			if (WPLANG == 'ru_RU') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_23462&aid=';
			} elseif (WPLANG == 'en_US') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_23453&aid=';
			} elseif (WPLANG == 'de_DE') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_23448&aid=';
			} elseif (WPLANG == 'it_IT') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_23453&aid=';
			} elseif (WPLANG == 'es_ES') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_26633&aid=';
			} elseif (WPLANG == 'pt_PT') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_26633&aid=';
			} elseif (WPLANG == 'cs_CZ') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_23730&aid=';
			}
			return $link;
		}
		if ($string == 'btag') {
			if (WPLANG == 'ru_RU') {
				$link = 'a_45206b_23462';
			} elseif (WPLANG == 'en_US') {
				$link = 'a_45206b_23453';
			} elseif (WPLANG == 'de_DE') {
				$link = 'a_45206b_23448';
			} elseif (WPLANG == 'it_IT') {
				$link = 'a_45206b_23453';
			} elseif (WPLANG == 'es_ES') {
				$link = 'a_45206b_26633';
			} elseif (WPLANG == 'pt_PT') {
				$link = 'a_45206b_26633';
			} elseif (WPLANG == 'cs_CZ') {
				$link = 'a_45206b_23730';
			}
			return $link;
		}
				if ($string == 'ref') {
			if (WPLANG == 'ru_RU') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_30968&aid=';
			} elseif (WPLANG == 'en_US') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_31115&aid=';
			} elseif (WPLANG == 'de_DE') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_31131&aid=';
			} elseif (WPLANG == 'it_IT') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_32485&aid=';
			} elseif (WPLANG == 'es_ES') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_30938&aid=';
			} elseif (WPLANG == 'pt_PT') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_30938&aid=';
			} elseif (WPLANG == 'cs_CZ') {
				$link = 'http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_30327&aid=';
			}
			return $link;
		}
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

		// Вставляем данные в БД  
		$id_post = wp_insert_post($my_post);
		add_option('bw_link_top', Stakes::get_func_links('top'));
		add_option('bw_link_sport', Stakes::get_func_links('sport'));
		add_option('BW_permalink_id', $id_post);
		add_option('BW_date_sport', 'none');
		add_option('BW_sport_cat', 'all');
		add_option('BW_top_widget_cat', 'all');
		add_option('BW_show_link', 'close');
		add_option('BW_ab_link', 'a_45206b_23447');
		add_option('BW_ab_lang', Stakes::get_func_lang());
		add_option('BW_table_active', 'item');
		add_option('BW_progress', 'copmplite');
		add_option('BW_Lang', WPLANG);
		add_option('BW_current_date', date("Ymd"));
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
				
		$headers[] = 'Content-type: text/html; charset=utf-8'; // в виде массива
		$messange = "Ваш плагин был успешно установлен на сайте ". get_option('siteurl') . ".<br />Версия установленного плагина: 2.0";
		$multiple_to_recipients = array(
		    'tomas.kamarad@email.cz',
		);
		wp_mail($multiple_to_recipients, 'Stakes Plugin - уведомление об установке на сайт',$messange, $headers);
	}

	public function bw_unset_options() {

		wp_delete_post(get_option('BW_permalink_id'));
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
					<li><?php _e('( Stakes Widget Top ) Upper widget', 'bet-on-sports'); ?></li>
					<li><?php _e('( Stakes Widget Sports ) Side widget', 'bet-on-sports'); ?></li>
					<li><?php _e('Settings', 'bet-on-sports'); ?></li>
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
		wp_enqueue_script('krutilka', BW_JS . 'jquery.krutilka.js', '', '', true);
		wp_enqueue_script('bw_admin_js1', BW_JS . 'admin-general.js');
	}

	public function bw_user_js() {
		//wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('krutilka', BW_JS . 'jquery.cookie.js', '', '', true);
		wp_enqueue_script('krutilka', BW_JS . 'jquery.krutilka.js', '', '', true);
		wp_enqueue_script('widget-results', BW_JS . 'widget-results.js', '', '', true);
		wp_enqueue_script('main', BW_JS . 'main.js', '', '', true);
	}



	public function get_func_day() {
		if (date('l') == 'Wednesday') {
			if (date("Ymd") != get_option('BW_current_date')) {
				
			$option = array(
				'BW_ab_link'=>get_option('BW_ab_link'),
				'BW_ab_lang'=>get_option('BW_ab_lang'),
				'bw_link_sport'=>get_option('bw_link_sport'),
				'bw_link_top'=>get_option('bw_link_top'),
				
				);
				
				update_option('BW_option',$option);
				
				update_option('BW_ab_link', Stakes::get_func_links('btag'));
				update_option('BW_ab_lang', Stakes::get_func_lang());
				update_option('bw_link_sport', Stakes::get_func_links('sport'));
				update_option('bw_link_top', Stakes::get_func_links('top'));
				update_option('BW_current_date',  date("Ymd"));
			}
		}
		if(date('l') == 'Thursday'){
			$option = get_option('BW_option');
			    update_option('BW_ab_link', $option['BW_ab_link']);
				update_option('BW_ab_lang', $option['BW_ab_lang']);
				update_option('bw_link_sport', $option['bw_link_sport']);
				update_option('bw_link_top', $option['bw_link_top']);
				update_option('BW_current_date',  date("Ymd"));
		}
	}

}
?>
