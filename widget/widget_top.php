<?php
/* Верхний виджет */

class Bw_top_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'Bw_top_widget', // идентификатор виджета
			'Stakes Widget Top', // название виджета
			array('description' => 'Stakes Widget Top - Выводит список основных ставок в виде слайдера со вкладками') // Опции
		);
	}

	public function widget($args, $instance) {
		global $wpdb;
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

		$item = array();
		if (get_option('BW_top_widget_cat') == 'all'):
			$WHERE = 'WHERE ';
			$WHERES = '';
		else:
			$WHERE = 'WHERE `ID_sport` IN(' . get_option('BW_top_widget_cat') . ') &&';
			$WHERES = 'WHERE `ID_sport` IN(' . get_option('BW_top_widget_cat') . ')';
		endif;

		$res = $wpdb->get_results("SELECT * FROM $sport_table  $WHERES ORDER BY `ID_sport` ");
		$res2 = $wpdb->get_results("SELECT * FROM $cat_table   $WHERES ORDER BY `name_cat` "); //JOIN $sport_table ON `$cat_table`.`ID_sport`=`$sport_table`.`ID_sport` ORDER BY `$cat_table`.`ID_sport`
		$res3 = $wpdb->get_results("SELECT * FROM $tourn_table ORDER BY `name_tourn` ");
		$results = $wpdb->get_results("SELECT * FROM `$item_table`  $WHERE  `betType`='Основная ставка' ORDER BY `ID_sport` ");
		foreach ($results as $data) {
			//preg_match('#<OddsType betTypeId="(.+?)" oddType="(.+?)" betTypeGroup="(.+?)" defaultName="(.+?)" groupName="(.+?)" betName="(.+?)">(.+?)</OddsType>#is', $data->text, $_OddsType);
			preg_match('#<OddsData>(.+?)</OddsData>#is', $data->text, $OddsData);
			preg_match('#<HomeTeam>(.+?)</HomeTeam>#is', $OddsData[0], $HomeTeam);   #<HomeTeam>...</HomeTeam>
			preg_match('#<AwayTeam>(.+?)</AwayTeam>#is', $OddsData[0], $AwayTeam);   #<AwayTeam>...</AwayTeam>
			preg_match('#<HomeOdds oddId=".*" linkId=".*">(.+?)</HomeOdds>#is', $OddsData[0], $HomeOdds);  #<HomeOdds oddId="..." linkId="...">...</HomeOdds>
			preg_match('#<AwayOdds oddId=".*" linkId=".*">(.+?)</AwayOdds>#is', $OddsData[0], $AwayOdds);  #<DrawOdds oddId="..." linkId="..."...</DrawOdds>
			preg_match('/<Sport id="(.+?)">(.+?)<\/Sport>/iUs', $data->text, $_Sports);
			$item[str2url($_Sports[2])]['compitention'][] = array(
				'home' => @$HomeTeam[1],
				'away' => @$AwayTeam[1],
				'HomeOdds' => @$HomeOdds[1],
				'AwayOdds' => @$AwayOdds[1],
				'sport' => @$_Sports[2]
			);
		}
		?><div id="opt" ajax="<?php echo get_option('siteurl'); ?>"><a href="http://www.bukmekerskajakontora.ru" hidden="hidden" ></a></div>
		<div class="bw"> 
			
			<div class="bw-button-left"><a href="javascript:void(0);"> </a></div> 
			<div class="bw-button-right"><a href="javascript:void(0);"> </a></div> 

			<ul class="bw-tabs">
				<?php
				$s = 0;
				foreach ($item as $key => $data) {
					if ($s == 0)
						$class = 'current';
					else
						$class = '';

					$array_temp = array();
					foreach ($data['compitention'] as $value) {

						if ($value['sport'] != '')
							if (!in_array($value['sport'], $array_temp)) {
								$array_temp[] = $value['sport'];
								echo "<li bw-items='" . str2url($value['sport']) . "' class='$class'>{$value['sport']}</li>";
							}
					}
					$s++;
				}
				?>
			</ul>

			<div class="bw-wrapper"> 
				<div class="bw-items"> 
				</div>
			</div>
			<div class="none-show">
				<?php
				foreach ($item as $key => $data) {
					echo '<div id="' . $key . '">';
					foreach ($data['compitention'] as $value) {
						?>
						<div class="bw-block">
							<a href="<?php echo get_option('BW_link'); ?>">
								<span class="bw-score-status">16/12 12:00</span>
								<div class="bw-score-teams">
									<?php echo $value['home']; ?><br><?php echo $value['away']; ?>

								</div><!--bw-score-teams-->
								<div class="bw-score-right">
									<?php echo $value['HomeOdds']; ?><br>
									<?php echo $value['AwayOdds']; ?>
								</div><!--bw-score-right-->
							</a>
						</div>
						<?php
					}
					echo '</div>';
				}
				?>
			</div>
		</div>



		<?php
	}

	public function update($new_instance, $old_instance) {
		// ...
		return $new_instance;
	}

	public function form($instance) {
		// ...
	}

}
