<?php

class Bw_ajax {

	public function my_action_callback( $exit = TRUE ) {
		global $wpdb;
		$status_1 = '';
		$status_2 = '';
		$table = get_option('BW_table_active');
		if ($table == 'item') {
			$sport_table = $wpdb->prefix . 'bw_sports_1';
			$cat_table = $wpdb->prefix . 'bw_category_1';
			$tourn_table = $wpdb->prefix . 'bw_tournament_1';
			$item_table = $wpdb->prefix . 'bw_item_1';
		}
		if ($table == 'item_1') {
			$sport_table = $wpdb->prefix . 'bw_sports';
			$cat_table = $wpdb->prefix . 'bw_category';
			$tourn_table = $wpdb->prefix . 'bw_tournament';
			$item_table = $wpdb->prefix . 'bw_item';
		}
		$lang = get_option('BW_Lang');
		$xml = sports('file_get_contents', $lang);
		preg_match_all('#<List generatedAt="(.+?)">#is', $xml, $data);


		if (get_option('BW_date_sport') != $data[1][1]) {

			$status_1 = 'download';
		} else if (get_option('BW_progress') != 'complite') {

			$status_2 = 'download';
		} else {
			$status_1 = 'complite';
			$status_2 = 'complite';
		}

		if ($status_1 == 'download' or $status_2 == 'download') {
			$xm1 = preg_replace('/^.*--><List/isU', '', $xml);
                        unset($xml);
			preg_match_all('#<OddsObject>(.+?)</OddsObject>#is', $xm1, $OddsObject);


			update_option('BW_item_count', count($OddsObject[0]));
			update_option('BW_progress', 'in progress');
			update_option('BW_date_sport', $data[1][1]);
			if ($status_2 != 'download') {
				$res = $wpdb->query("TRUNCATE TABLE  $sport_table");
				$res2 = $wpdb->query("TRUNCATE TABLE  $cat_table"); //JOIN $sport_table ON `$cat_table`.`ID_sport`=`$sport_table`.`ID_sport` ORDER BY `$cat_table`.`ID_sport`
				$res3 = $wpdb->query("TRUNCATE TABLE  $tourn_table");
				$res3 = $wpdb->query("TRUNCATE TABLE  $item_table");
			}

			$sports = array();
			$sports_ = array();
			$category = array();
			$category_ = array();
			$tournament = array();
			$tournament_ = array();
			$items = array();
			$match = array();
			$match_ = array();
			$oddstype = array();
			$oddstype_ = array();
			$oddsosn = array();
			$oddsosn_ = array();
			$outcomes = array();
			$outcomes_ = array();
			$ii = 0;

			echo $get_last_id = $wpdb->get_var("SELECT count(ID) FROM $item_table");
			if ($get_last_id != get_option('BW_item_count')) {
				foreach ($OddsObject[0] as $item) {

					if ($get_last_id == $ii) {
						preg_match('/<Sport id="(.+?)">(.+?)<\/Sport>/iUs', $item, $_Sports);
						preg_match('/<Category id="(.+?)">(.+?)<\/Category>/iUs', $item, $_Category);
						preg_match('/<Tournament id="(.+?)">(.+?)<\/Tournament>/iUs', $item, $_Tournament);
						preg_match('/<OddsType betTypeId=".*" oddType=".*" betTypeGroup=".*" defaultName=".*" groupName=".*" betName="(.+?)">.*<\/OddsType>/iUs', $item, $_Bet);

						$wpdb->query("INSERT INTO `$item_table` (`ID`,`text`,`betType`,`ID_tournament`,`ID_sport`)VALUES ('$ii','$item','$_Bet[1]','$_Tournament[1]','$_Sports[1]]')");
						if (@!in_array($_Tournament[1], $tournament[str2url($_Sports[1])][str2url($_Category[1])])) {
							@$tournament[str2url($_Sports[1])][str2url($_Category[1])][] = $_Tournament[1];
							@$tournament_[str2url($_Sports[1])][str2url($_Category[1])][] = array(
								'name_rus' => @$_Tournament[2],
								'name_trans' => @str2url($_Tournament[2]),
								'ID' => @$_Tournament[1],
							);
						}

						if (!in_array(@$_Sports[1], $sports)) {
							$sports[] = @$_Sports[1];
							$sports_[] = array(
								'ID_sport' => @$_Sports[1],
								'name_rus' => @$_Sports[2],
								'name_trans' => @str2url($_Sports[2])
							);
						}
						$get_last_id++;
					}$ii++;
				}
			}
			if ($get_last_id == get_option('BW_item_count')) {
				foreach ($sports as $ids) {

					foreach ($OddsObject[1] as $item) {
						preg_match('/<Sport id="' . $ids . '">.*<\/Sport><Category id="(.+?)">(.+?)<\/Category>/iUs', $item, $_Category);
						if (!in_array(@$_Category[1], $category)) {
							$category[] = @$_Category[1];
							$category_[] = array(
								'ID_sports' => @$ids,
								'ID_category' => @$_Category[1],
								'name_rus' => @$_Category[2],
								'name_trans' => @str2url($_Category[2])
							);
						}
					}
				}
				foreach ($sports_ as $sport_data) {
					$wpdb->query("INSERT INTO `$sport_table` (`ID_sport` ,`name_sport` ,`trans_sport`)VALUES ('$sport_data[ID_sport]', '$sport_data[name_rus]', '$sport_data[name_trans]')");
				}
				foreach ($category_ as $cat_data) {
					$wpdb->query("INSERT INTO `$cat_table` (`ID_category` ,`name_cat` ,`trans_cat`,`ID_sport`)VALUES ('$cat_data[ID_category]', '$cat_data[name_rus]','$cat_data[name_trans]','$cat_data[ID_sports]')");
				}
				foreach ($tournament_ as $key => $tourn_data) {
					foreach ($tourn_data as $key2 => $value) {
						foreach ($value as $value2) {
							$wpdb->query("INSERT INTO `$tourn_table` (`ID_tournament` ,`name_tourn` ,`trans_tourn`,`ID_category`)VALUES ('$value2[ID]', '$value2[name_rus]','$value2[name_trans]','$key2')");
						}
					}
				}
				if ($table == 'item') {
					$tables = 'item_1';
				} else {
					$tables = 'item';
				}
				update_option('BW_progress', 'complite');
				update_option('BW_table_active', $tables);
			}
		} elseif (@$_POST['updat'] == 'upda') {
			$args = array(
				'sport_table' => $sport_table,
				'cat_table' => $cat_table,
				'tourn_table' => $tourn_table,
				'item_table' => $item_table,
			);
			self::update_items($xml, $args, $data[1][1]);
		}
		Stakes::get_func_day();
		if( $exit )
		    exit; // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	}

	public function set_default_callback() {
		update_option('BW_ab_link', 'a_45206b_23447');
		update_option('BW_ab_lang', 'ru');

		if (get_option('BW_ab_link') == 'a_45206b_23447') {

			echo 'true';
		} else {
			echo 'false';
		}
		exit();
	}

	public function update_lang_callback() {
		if (update_option('BW_Lang', $_POST['BW_Lang'])) {
			echo 'done!';
		} else {
			echo 'not done!';
		}
		exit();
	}

	public function update_items($xml, $args, $uptime) {

		global $wpdb;
		extract($args);
                //$xm1 = preg_replace('/^.*--><List/isU', '', $xml);
//		if ($xm1 == '')
			$xm1 = preg_replace('/^.*-->.*<List/isU', '', $xml);
		//echo 'k'.$xm1;
		$table = get_option('BW_table_active');
		preg_match_all('#<OddsObject>(.+?)</OddsObject>#is', $xm1, $OddsObject);

		update_option('BW_item_count', count($OddsObject[0]));
		update_option('BW_progress', 'in progress');
		update_option('BW_date_sport', $uptime);

		$res = $wpdb->query("TRUNCATE TABLE $sport_table");
		$res2 = $wpdb->query("TRUNCATE TABLE $cat_table"); //JOIN $sport_table ON `$cat_table`.`ID_sport`=`$sport_table`.`ID_sport` ORDER BY `$cat_table`.`ID_sport`
		$res3 = $wpdb->query("TRUNCATE TABLE $tourn_table");
		$res3 = $wpdb->query("TRUNCATE TABLE $item_table");


		preg_match_all('#<OddsObject>(.+?)</OddsObject>#is', $xm1, $OddsObject);
              
		$sports  = array();
		$sports_ = array();
		$category = array();
		$category_ = array();
		$tournament = array();
		$tournament_ = array();
		$items = array();
		$match = array();
		$match_ = array();
		$oddstype = array();
		$oddstype_ = array();
		$oddsosn = array();
		$oddsosn_ = array();
		$outcomes = array();
		$outcomes_ = array();
		$ii = 0;

		$get_last_id = $wpdb->get_var("SELECT count(ID) FROM $item_table");
		
			foreach ($OddsObject[0] as $item) {

				if ($get_last_id == $ii) {
					preg_match('/<Sport id="(.+?)">(.+?)<\/Sport>/iUs', $item, $_Sports);
					preg_match('/<Category id="(.+?)">(.+?)<\/Category>/iUs', $item, $_Category);
					preg_match('/<Tournament id="(.+?)">(.+?)<\/Tournament>/iUs', $item, $_Tournament);
					preg_match('/<OddsType betTypeId=".*" oddType=".*" betTypeGroup=".*" defaultName=".*" groupName=".*" betName="(.+?)">.*<\/OddsType>/iUs', $item, $_Bet);

					$wpdb->query("INSERT INTO `$item_table` (`ID`,`text`,`betType`,`ID_tournament`,`ID_sport`)VALUES ('$ii','$item','$_Bet[1]','$_Tournament[1]','$_Sports[1]]')");
					if (@!in_array($_Tournament[1], $tournament[str2url($_Sports[1])][str2url($_Category[1])])) {
						@$tournament[str2url($_Sports[1])][str2url($_Category[1])][] = $_Tournament[1];
						@$tournament_[str2url($_Sports[1])][str2url($_Category[1])][] = array(
							'name_rus' => @$_Tournament[2],
							'name_trans' => @str2url($_Tournament[2]),
							'ID' => @$_Tournament[1],
						);
					}

					if (!in_array(@$_Sports[1], $sports)) {
						$sports[] = @$_Sports[1];
						$sports_[] = array(
							'ID_sport' => @$_Sports[1],
							'name_rus' => @$_Sports[2],
							'name_trans' => @str2url($_Sports[2])
						);
					}
					$get_last_id++;
				}$ii++;
			}
		
			foreach ($sports as $ids) {

				foreach ($OddsObject[1] as $item) {
					preg_match('/<Sport id="' . $ids . '">.*<\/Sport><Category id="(.+?)">(.+?)<\/Category>/iUs', $item, $_Category);
					if (!in_array(@$_Category[1], $category)) {
						$category[] = @$_Category[1];
						$category_[] = array(
							'ID_sports' => @$ids,
							'ID_category' => @$_Category[1],
							'name_rus' => @$_Category[2],
							'name_trans' => @str2url($_Category[2])
						);
					}
				}
			}
			foreach ($sports_ as $sport_data) {
				$wpdb->query("INSERT INTO `$sport_table` (`ID_sport` ,`name_sport` ,`trans_sport`)VALUES ('$sport_data[ID_sport]', '$sport_data[name_rus]', '$sport_data[name_trans]')");
			}
			foreach ($category_ as $cat_data) {
				$wpdb->query("INSERT INTO `$cat_table` (`ID_category` ,`name_cat` ,`trans_cat`,`ID_sport`)VALUES ('$cat_data[ID_category]', '$cat_data[name_rus]','$cat_data[name_trans]','$cat_data[ID_sports]')");
			}
			foreach ($tournament_ as $key => $tourn_data) {
				foreach ($tourn_data as $key2 => $value) {
					foreach ($value as $value2) {
						$wpdb->query("INSERT INTO `$tourn_table` (`ID_tournament` ,`name_tourn` ,`trans_tourn`,`ID_category`)VALUES ('$value2[ID]', '$value2[name_rus]','$value2[name_trans]','$key2')");
					}
				}
			}
			if ($table == 'item') {
				$tables = 'item_1';
			} else {
				$tables = 'item';
			}
			update_option('BW_progress', 'complite');
			update_option('BW_table_active', $tables);
	}

}
