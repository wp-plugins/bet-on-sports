<?php
/* Верхний виджет */

class Bw_sports_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'Bw_sports_widget', // идентификатор виджета
			'Stakes Widget Sports', // название виджета
			array('description' => 'Stakes Widget Sports - Выводит список турниров в виде дерева') // Опции
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
		echo '<ul >';
		foreach ($res as $dat) {
			if ($dat->trans_sport != '') {
				echo "<li><div class='openSub first_ul'><img src='" . get_option('siteurl') . "/wp-content/plugins/bet-on-sports/images/sports/" . $dat->trans_sport . ".png' width='16'><span class='bw-title'>{$dat->name_sport}</span></div>";
				echo '<ul class="second_ul" style="display:none;">';
				foreach ($res2 as $dat2) {

					if ($dat->ID_sport == $dat2->ID_sport) {
						if ($dat2->name_cat != '') {
							echo "<li><div class='openSub second_ul_select '><span class='arrow-right'></span>{$dat2->name_cat}</div>";
							echo '<ul class="three_ul"  style="display:none;">';
							foreach ($res3 as $dat3) {
								if ($dat2->ID_category == $dat3->ID_category) {
									echo "<li><a href='" . get_permalink(get_option('BW_permalink_id')) . "?id_tourn={$dat3->ID_tournament}'>{$dat3->name_tourn}</a></li>";
								}
							}
							echo '</ul>';
						}
					}
				}
				echo '</ul>';
			}
		}
		echo '</ul>';
		
		/* bukmeker only */
		echo "<script>
			jQuery(document).ready(function($) {
				//$('#sidebar-wrapper').isotope('destroy');
				$('#sidebar-wrapper').removeClass('isotope');
				$('#sidebar-wrapper').removeAttr('style');
			});
		</script>";
		
		/* bukmeker only */

		$url = explode("/", get_bloginfo('url'));
		$uri = ($url[3]) ? '/' . $url[3] . '/' : '/';
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
		// Название виджета
		?><p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Название:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p><?php
	}

}
