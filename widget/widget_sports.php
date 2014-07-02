<?php
/* Верхний виджет */

class Bw_sports_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
				'Bw_sports_widget', // идентификатор виджета
				'Stakes Widget Sports', // название виджета
				array('description' => __('Stakes Widget Sports - shows the list of tournaments in the form of tree', 'bet-on-sports')) // Опции
		);
	}

	public function widget($args, $instance) {
		global $wpdb;
		extract($args);
		@$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget;

		// Выводим название виджета
		if ($title)
			echo $before_title . $title . $after_title;
		?><div id="opt" ajax="<?php echo get_option('siteurl'); ?>"><a href="http://www.bukmekerskajakontora.ru" hidden="hidden" ></a></div> <?php
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


		if (get_option('BW_sport_cat') == 'all'): $WHERE = '';
		else: $WHERE = 'WHERE `ID_sport` IN(' . get_option('BW_sport_cat') . ')';
		endif;

		$res = $wpdb->get_results("SELECT * FROM $sport_table $WHERE ");
		$res2 = $wpdb->get_results("SELECT * FROM $cat_table  $WHERE ORDER BY `name_cat` "); //JOIN $sport_table ON `$cat_table`.`ID_sport`=`$sport_table`.`ID_sport` ORDER BY `$cat_table`.`ID_sport`
		$res3 = $wpdb->get_results("SELECT * FROM $tourn_table ORDER BY `name_tourn` ");
		if (Stakes::sauseday() && Stakes::sauseip())
			echo '<div class="bw_links"><div style="width: 75%;"><a href="http://www.sportingbet.lt"><img src="' . get_option('siteurl') . '/wp-content/plugins/bet-on-sports/images/bunner_left.png" height="12" /></a></div><div style="width: 25%;"><a href="http://www.bukmekerskajakontora.ru/"><img src="' . get_option('siteurl') . '/wp-content/plugins/bet-on-sports/images/bunner_right.png" height="12" /></a></div></div>';

		echo '<ul >';
		foreach ($res as $dat) {
			if ($dat->trans_sport != '') {
				echo "<li><div class='openSub first_ul'><img src='" . get_option('siteurl') . "/wp-content/plugins/bet-on-sports/images/sports/" . get_option('BW_Lang') . '/' . $dat->trans_sport . ".png' width='16'><span class='bw-title'>{$dat->name_sport}</span></div>";
				echo '<ul class="second_ul" style="display:none;">';
				foreach ($res2 as $dat2) {

					if ($dat->ID_sport == $dat2->ID_sport) {
						if ($dat2->name_cat != '') {
							echo "<li><div class='openSub second_ul_select '><span class='arrow-right'></span>{$dat2->name_cat}</div>";
							echo '<ul class="three_ul"  style="display:none;">';
							foreach ($res3 as $dat3) {
								if ($dat2->ID_category == $dat3->ID_category) {
									echo "<li><a href='?p=" . (get_option('BW_permalink_id')) . "&id_tourn={$dat3->ID_tournament}'>{$dat3->name_tourn}</a></li>";
								}
							}
							echo '</ul>';
						}
					}
				}
				echo '</ul>';
			}
		}
		echo '</ul><div style="display:none;">www.sportingbet.lt</div>';


		$url = explode("/", get_bloginfo('url'));
		$uri = ( isset($url[3]) ) ? '/' . $url[3] . '/' : '/';
		?>
		<!--<div id="widget_results" linked="<?php echo $uri; ?>wp-content/plugins/bukmekers-widget/" permalink="<?php echo get_permalink(get_option('BW_permalink_id')); ?>">
				<div id="ogidalka"><div id="krutilka"></div></div>
		</div>-->


		<?php
		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags($new_instance['title']);

		return $new_instance;
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		?><p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('The title', 'bet-on-sports'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p><?php
	}

}
