<?php

class Bw_shortcode {

	public function bw_get_tournament() {
		global $wpdb;

		$param = Bw_shortcode::get_arr_name();
		
		$id_tourn = filter_input(INPUT_GET, 'id_tourn', FILTER_SANITIZE_ENCODED);
		$table = get_option('BW_table_active');
		if ($table == 'item') {
			$sport_table = $wpdb->prefix . 'bw_sports';
			$cat_table = $wpdb->prefix . 'bw_category';
			$tourn_table = $wpdb->prefix . 'bw_tournament';
			$item_table = $wpdb->prefix . 'bw_item';
		}
		if ($table == 'item_1') {
			$sport_table = $wpdb->prefix . 'bw_sports_1';
			$cat_table = $wpdb->prefix . 'bw_category_1';
			$tourn_table = $wpdb->prefix . 'bw_tournament_1';
			$item_table = $wpdb->prefix . 'bw_item_1';
		}


		$results = $wpdb->get_results("SELECT * FROM `$item_table` WHERE `ID_tournament`='{$id_tourn}'");
		/* Инициализация переменных */
		$betType = array();
		$betTypeData = array();
		$_OddsType = array();
		$Outcome = array();
		$Outcomes = array();
		$Outcomes[1] = array();
		$OddsData = array();
		$OddsData[0] = array();
		$OddsData[1] = array();
		$OverOdds = array();
		$UnderOdds = array();
		$AwayOdds = array();
		$DrawOdds = array();
		$HomeOdds = array();
		$AwayTeam = array();
		$HomeTeam = array();
		$_Tournament = array();
		$_Category = array();
		$_Sports = array();
		$SpreadHome = array();
		$SpreadAway = array();
		$SpreadOddsHome = array();
		$SpreadOddsAway = array();
		$Outcome[0] = array();
		$Outcome[1] = array();
		$Outcome[2] = array();
		$Outcome[3] = array();
		$Outcome[4] = array();
		/* END Инициализация переменных */
		if ($id_tourn != '') {
			if (count($results)) {

				preg_match('/<Sport id="(.+?)">(.+?)<\/Sport>/iUs', $results[0]->text, $_Sports);
				preg_match('/<Category id="(.+?)">(.+?)<\/Category>/iUs', $results[0]->text, $_Category);
				preg_match('/<Tournament id="(.+?)">(.+?)<\/Tournament>/iUs', $results[0]->text, $_Tournament);
				echo "<div class='bw-o-p-name'>"
				. "<div class='bw-o-p'><span class='bw-t'>" . __('Sport:', 'bet-on-sports') . "</span><span><img src='" . get_option('siteurl') . "/wp-content/plugins/bet-on-sports/images/sports/" . get_option('BW_Lang') .'/'. str2url($_Sports[2]) . ".png' width='16'> $_Sports[2]</span></div>"
				. "<div class='bw-o-p'><span class='bw-t'>" . __('Category:', 'bet-on-sports') . "</span><span>$_Category[2]</span></div>"
				. "<div class='bw-o-p'><span class='bw-t'>" . __('Tournament:', 'bet-on-sports') . "</span><span>$_Tournament[2]</span></div>"
				. "</div>";
				foreach ($results as $data) {
					preg_match('#<OddsType betTypeId="(.+?)" oddType="(.+?)" betTypeGroup="(.+?)" defaultName="(.+?)" groupName="(.+?)" betName="(.+?)">(.+?)</OddsType>#is', $data->text, $_OddsType);
					preg_match('#<OddsData>(.+?)</OddsData>#is', $data->text, $OddsData);
					preg_match('#<HomeTeam>(.+?)</HomeTeam>#is', $OddsData[0], $HomeTeam);   #<HomeTeam>...</HomeTeam>
					preg_match('#<AwayTeam>(.+?)</AwayTeam>#is', $OddsData[0], $AwayTeam);   #<AwayTeam>...</AwayTeam>
					preg_match('#<HomeOdds oddId="(.+?)" linkId="(.+?)">(.+?)</HomeOdds>#is', $OddsData[0], $HomeOdds);  #<HomeOdds oddId="..." linkId="...">...</HomeOdds>
					preg_match('#<AwayOdds oddId="(.+?)" linkId="(.+?)">(.+?)</AwayOdds>#is', $OddsData[0], $AwayOdds);  #<DrawOdds oddId="..." linkId="..."...</DrawOdds>
					preg_match('#<DrawOdds oddId="(.+?)" linkId="(.+?)">(.+?)</DrawOdds>#is', $OddsData[0], $DrawOdds);  #<AwayOdds oddId="..." linkId="...">...</AwayOdds>
					preg_match('#<UnderOdds oddId="(.+?)" linkId="(.+?)">(.+?)</UnderOdds>#is', $OddsData[0], $UnderOdds); #<UnderOdds oddId="..." linkId="...">...</UnderOdds>
					preg_match('#<OverOdds oddId="(.+?)" linkId="(.+?)">(.+?)</OverOdds>#is', $OddsData[0], $OverOdds);  #<OverOdds oddId="..." linkId="...">...</OverOdds>
					preg_match('#<Outcomes>(.+?)</Outcomes>#is', $OddsData[1], $Outcomes);   #<Outcomes>...<Outcome oddId="..." linkId="...." name="...">...</Outcome>...</Outcomes>
					@preg_match_all('#<Outcome oddId="(.+?)" linkId="(.+?)" name="(.+?)">(.+?)</Outcome>#is', $Outcomes[1], $Outcome);
					preg_match('#<SpreadHome>(.+?)</SpreadHome>#is', $OddsData[0], $SpreadHome);
					preg_match('#<SpreadAway>(.+?)</SpreadAway>#is', $OddsData[0], $SpreadAway);
					preg_match('#<SpreadOddsHome oddId="(.+?)" linkId="(.+?)">(.+?)</SpreadOddsHome>#is', $OddsData[0], $SpreadOddsHome);
					preg_match('#<SpreadOddsAway oddId="(.+?)" linkId="(.+?)">(.+?)</SpreadOddsAway>#is', $OddsData[0], $SpreadOddsAway);
					
					$its = array();
					for ($i = 0; $i <= count(@$Outcome[0]); $i++) {
						$its[] = array(
							'oddId' => @$Outcome[0][$i],
							'linkId' => @$Outcome[2][$i],
							'name' => @$Outcome[3][$i],
							'Outcome' => @$Outcome[4][$i],
						);
					}
					
					
					if (empty($its[1]))
						@$its = '';
					$outcomes_[] = array(
						'name_translit' => @str2url($HomeTeam[1] . $AwayTeam[1]),
						'betName' => @$_OddsType[6],
						'betName_trans' => @str2url($_OddsType[6]),
						'HomeTeam' => @$HomeTeam[1],
						'AwayTeam' => @$AwayTeam[1],
						'HomeoddId' => @$HomeOdds[1],
						'HomelinkId' => @$HomeOdds[2],
						'HomeOdds' => @$HomeOdds[3],
						'AwayoddId' => @$AwayOdds[1],
						'AwaylinkId' => @$AwayOdds[2],
						'AwayOdds' => @$AwayOdds[3],
						'DrawoddId' => @$DrawOdds[1],
						'DrawlinkId' => @$DrawOdds[2],
						'DrawOdds' => @$DrawOdds[3],
						'UnderoddId' => @$UnderOdds[1],
						'UnderlinkId' => @$UnderOdds[2],
						'UnderOdds' => @$UnderOdds[3],
						'OveroddId' => @$OverOdds[1],
						'OverlinkId' => @$OverOdds[2],
						'OverOdds' => @$OverOdds[3],
						'SpreadHome' => @$SpreadHome[1],
						'SpreadAway' => @$SpreadAway[1],
						'SpreadHomeoddId' => @$SpreadOddsHome[1],
						'SpreadHomelinkId' => @$SpreadOddsHome[2],
						'SpreadHomeodd' => @$SpreadOddsHome[3],
						'SpreadAwayoddId' => @$SpreadOddsAway[1],
						'SpreadAwaylinkId' => @$SpreadOddsAway[2],
						'SpreadAwayodd' => @$SpreadOddsAway[3],
						'Outcomes' => @$its,
					);
				}
				echo '<div id="Bet_type">';
				echo '<ul class="sport_list">';
				foreach ($betTypeData as $data) {
					?>
					<li>
						<input type="checkbox" <?php echo $chec; ?> name="sportID[]" value="<?php echo $sport->ID_sport; ?>"/>
						<label class="label" for="sportID[]"><?php echo $sport->name_sport; ?></label>
					</li>
					<?php
				}
				echo '</ul>';
				echo '</div>';


				$betOsn = 0;
				$betTwo = 0;
				$betThree = 0;
				$betfour = 0;
				$betfive = 0;
				$betsixe = 0;
				$array1 = array();
				foreach ($outcomes_ as $data) {
					@$itemsis[$data[betName_trans]][] = $data;
				}

				foreach (@$itemsis as $val) {

					if ($val != '') {

						echo "<div class='bw-group effect7'>";
						echo '<ul>';
						foreach ($val as $data) {

							$echoOsn = '';
							$echoOsnh = '';

							if ($data['betName'] == $param['Tip']) {
								if ($betOsn == 0) {

									$echoOsnh .="<li class='bet-osn-head " . str2url($data['betName']) . "'>{$data['betName']} <div class='bw-right'>";
									if ($data['HomeOdds'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['DrawOdds'])
										$echoOsnh .="<span class='bw-head-button'>X</span>";
									if ($data['AwayOdds'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}

								$echoOsn .="<li class='bet-osn " . str2url($data['betName']) . "'>{$data['HomeTeam']} - {$data['AwayTeam']} <div class='bw-right'>";
								if ($data['HomeOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a target='_blank' href='" . get_oddid_link($data['HomeoddId']) . "'>{$data['HomeOdds']}</a></span>";
								if ($data['DrawOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a target='_blank' href='" . get_oddid_link($data['DrawoddId']) . "'>{$data['DrawOdds']}</a></span>";
								if ($data['AwayOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a target='_tab' href='" . get_oddid_link($data['AwayoddId']) . "'>{$data['AwayOdds']}</a></span>";
								$echoOsn .="</div></li> \n";

								echo $echoOsn;
								$betOsn++;
							}
							if ($data['betName'] == $param['Double_Chance']) {
								if (@$betTwo == 0) {

									$echoOsnh .="<li class='bet-osn-head' " . str2url($data['betName']) . ">{$data['betName']} <div class='bw-right'>";
									$echoOsnh .="<span class='bw-head-button'>1X</span>";
									$echoOsnh .="<span class='bw-head-button'>12</span>";
									$echoOsnh .="<span class='bw-head-button'>X2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}

								$echoOsn .="<li class='bet-osn " . str2url($data['betName']) . "'>{$data['HomeTeam']} - {$data['AwayTeam']} <div class='bw-right'>";
								$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['Outcomes'][0]['linkId']) . "'>{$data['Outcomes'][0]['Outcome']}</a></span>";
								$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['Outcomes'][1]['linkId']) . "'>{$data['Outcomes'][1]['Outcome']}</a></span>";
								$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['Outcomes'][2]['linkId']) . "'>{$data['Outcomes'][2]['Outcome']}</a></span>";
								$echoOsn .="</div></li> \n";

								echo $echoOsn;
								$betTwo++;
							}
							if ($data['betName'] == $param['Handicap']) {
								if ($betThree == 0) {

									$echoOsnh .="<li class='bet-osn-head " . str2url($data['betName']) . "'>{$data['betName']} <div class='bw-right'>";
									if ($data['HomeOdds'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['DrawOdds'])
										$echoOsnh .="<span class='bw-head-button'>X</span>";
									if ($data['AwayOdds'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}

								$echoOsn .="<li class='bet-osn " . str2url($data['betName']) . "'>{$data['HomeTeam']} - {$data['AwayTeam']} <div class='bw-right'>";
								if ($data['HomeOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['HomeoddId']) . "'>{$data['HomeOdds']}</a></span>";
								if ($data['DrawOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['DrawoddId']) . "'>{$data['DrawOdds']}</a></span>";
								if ($data['AwayOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['AwayoddId']) . "'>{$data['AwayOdds']}</a></span>";
								$echoOsn .="</div></li> \n";

								echo $echoOsn;
								$betThree++;
							}
							if ($data['betName'] == $param['Under/Over']) {
								if ($betfive == 0) {

									$echoOsnh .="<li class='bet-osn-head " . str2url($data['betName']) . "'>{$data['betName']} <div class='bw-right'>";
									if ($data['UnderOdds'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['OverOdds'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}
								$echoOsn .="<li class='bet-osn " . str2url($data['betName']) . "'>{$data['HomeTeam']} - {$data['AwayTeam']} <div class='bw-right'>";
								if ($data['UnderOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['UnderlinkId']) . "'>{$data['UnderOdds']}</a></span>";
								if ($data['OverOdds'])
									$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['OverlinkId']) . "'>{$data['OverOdds']}</a></span>";
								$echoOsn .="</div></li> \n";

								echo $echoOsn;
								$betfive++;
							}
							if ($data['betName'] == $param['Spread']) {
								if ($betsixe == 0) {
									
									$echoOsnh .="<li class='bet-osn-head" . str2url($data['betName']) . "'>{$data['betName']} <div class='bw-right'>";
									$echoOsnh .="<span class='bw-head-button'>1</span>";
									$echoOsnh .="<span class='bw-head-button'>2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}
								$echoOsn .="<li class='bet-osn " . str2url($data['betName']) . "'>{$data['HomeTeam']} - {$data['AwayTeam']} ({$data['SpreadHome']} / {$data['SpreadAway']}) <div class='bw-right'>";
								$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['SpreadHomelinkId']) . "'>{$data['SpreadHomeodd']}</a></span>";
								$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['SpreadAwaylinkId']) . "'>{$data['SpreadAwayodd']}</a></span>";
								$echoOsn .="</div></li> \n";

								echo $echoOsn;
								$betsixe++;
							}



							if ($data['betName'] != $param['Tip'] && $data['betName'] != $param['Spread'] &&
								$data['betName'] != $param['Under/Over'] && $data['betName'] != $param['Handicap'] &&
								$data['betName'] != $param['Double_Chance'] && $data['betName'] == $data['betName']) {


								if (!in_array($data['betName_trans'], $array1)) {
									$array1[] = $data['betName_trans'];

									$echoOsnh .="<li class='bet-osn-head'>{$data['betName']} <div class='bw-right'>";
									if ($data['HomeOdds'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['DrawOdds'])
										$echoOsnh .="<span class='bw-head-button'>X</span>";
									if ($data['AwayOdds'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									if ($data['UnderOdds'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['OverOdds'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									if ($data['SpreadHome'])
										$echoOsnh .="<span class='bw-head-button'>1</span>";
									if ($data['SpreadAway'])
										$echoOsnh .="<span class='bw-head-button'>2</span>";
									$echoOsnh .="</div></li> \n";

									echo $echoOsnh;
								}
								
								if ($data['HomeOdds'] || $data['UnderOdds'] || $data['SpreadHome']) {
								
									if($data['SpreadHome']){$sp ="({$data['SpreadHome']} / {$data['SpreadAway']})";}else{$sp ='';}
								
									$echoOsn .="<li class='bet-osn'>{$data['HomeTeam']} - {$data['AwayTeam']} $sp <div class='bw-right'>";
									if ($data['HomeOdds'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['HomeoddId']) . "'>{$data['HomeOdds']}</a></span>";
									if ($data['DrawOdds'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['DrawoddId']) . "'>{$data['DrawOdds']}</a></span>";
									if ($data['AwayOdds'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['AwayoddId']) . "'>{$data['AwayOdds']}</a></span>";
									if ($data['UnderOdds'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['UnderoddId']) . "'>{$data['UnderOdds']}</a></span>";
									if ($data['OverOdds'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['OveroddId']) . "'>{$data['OverOdds']}</a></span>";
										if ($data['SpreadHome'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['SpreadHomelinkId']) . "'>{$data['SpreadHomeodd']}</a></span>";
										if ($data['SpreadAway'])
										$echoOsn .="<span class='bw-head-button-link'><a href='" . get_oddid_link($data['SpreadAwaylinkId']) . "'>{$data['SpreadAwayodd']}</a></span>";
									$echoOsn .="</div>";
									$echoOsn .="</li> \n";
								}else {
									$array2 = array();
									//if(!isset($data)){
									echo "<div class='bw-group-ots'>";
									$i = 0;
								
									foreach ($data['Outcomes'] as $value) {

										if (!in_array($data['betName_trans'], $array2)) {
											$array2[] = $data['betName_trans'];
											if ($data['HomeTeam'])
												$echoOsn .="<li class='bet-osn-head '>{$data['HomeTeam']} - {$data['AwayTeam']} <div class='bw-right'>";
										}//linkId
										if (!empty($value['name'])) {
											$i++;
											$echoOsn .="<li class='bet-osn '>{$value['name']}<div class='bw-right'><span class='bw-head-button-link'><a href='" . get_oddid_link($value['linkId']) . "'>{$value['Outcome']}</a></span></div></li>";
										}
									}
									echo '</div>';
									//}
								}//sub_outcomes
								echo $echoOsn;
							}
						}
						echo '</ul>';
						echo '</div>';
					}
				}
			}
		}
	}

	public function get_arr_name() {
		$Lang = get_option('BW_Lang');
		if ($Lang == 'ru_RU') {
			$param = array(
				'Tip'=>'Основная ставка',
				'Double_Chance'=>'Двойной шанс',
				'Under/Over'=>'Меньше/Больше',
				'Handicap'=>'Фора',
				'Spread'=>'Спред'
			);
		} elseif ($Lang == 'en_US') {
			$param = array(
				'Tip'=>'Tip',
				'Double_Chance'=>'Double Chance',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		} elseif ($Lang == 'it_IT') {
			$param = array(
				'Tip'=>'Scommessa principale',
				'Double_Chance'=>'Doppia chance',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		} elseif ($Lang == 'es_ES') {
			$param = array(
				'Tip'=>'Apuesta principal',
				'Double_Chance'=>'Doble oportunidad',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		} elseif ($Lang == 'de_DE') {
			$param = array(
				'Tip'=>'Hauptwette',
				'Double_Chance'=>'Doppelte Chance',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		} elseif ($Lang == 'pt_PT') {
			$param = array(
				'Tip'=>'Aposta principal',
				'Double_Chance'=>'Oportunidade dupla',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		} elseif ($Lang == 'cs_CZ') {
			$param = array(
				'Tip'=>'Tip',
				'Double_Chance'=>'Dvojitá šance',
				'Under/Over'=>'Under/Over',
				'Handicap'=>'Handicap',
				'Spread'=>'Spread'
			);
		}
		
		return $param;
	}

}
?>
