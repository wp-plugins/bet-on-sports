<?php

class Stakes {

	public function load_tab($view_name) {

		if (file_exists(BW_LOAD_TABS . $view_name . '.php')) {

			include BW_LOAD_TABS . $view_name . '.php';
		} else {

			echo 'View "' . $view_name . '" not found.';
		}
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
			'post_title' => 'Турнир',
			'post_type' => 'page'
		);

		// Вставляем данные в БД  
		$id_post = wp_insert_post($my_post);
		add_option('BW_link', 'http://www.bukmekerskajakontora.ru/go/wh2');
		add_option('BW_permalink_id', $id_post);
		add_option('BW_date_sport', 'none');
		add_option('BW_sport_cat', 'all');
		add_option('BW_top_widget_cat', 'all');
		add_option('BW_show_link', 'close');
		add_option('BW_ab_link', 'a_45206b_23447');
		add_option('BW_ab_lang', 'ru');
		add_option('BW_table_active', 'item');
		add_option('BW_progress', 'copmplite');

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
	}

	public function bw_unset_options() {

		wp_delete_post(get_option('BW_permalink_id'));

		if (deleteOptions('BW_link', 'BW_permalink_id', 'BW_progress', 'BW_ab_link', 'BW_ab_lang', 'BW_table_active', 'BW_date_sport', 'BW_show_link', 'BW_sport_cat', 'BW_top_widget_cat'))
			echo 'Settings have been cleared!';
		else
			echo 'Erasing caused the error. Setup failed to remove!';
	}

	public function bw_main_page() {
		?>
		<div class="wrap">
			<h2>
				<img height="32" width="32" src="<?php echo BW_IMAGES ?>am_foot_big.png"/>   Stakes Plugin
			</h2>
			<div class="bw_section">

				<ul class="tabs">
					<li class="current">Главная</li>
					<li>( Stakes Widget Top ) Верхний виджет</li>
					<li>( Stakes Widget Sports ) Боковой виджет</li>
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

	public function bw_func_carusel() {
		
	}

}
?>
