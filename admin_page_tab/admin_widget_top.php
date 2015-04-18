<form action="?page=bw_main_page&top_widget_button=update" method="POST">

	<?php
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
	$res = $wpdb->get_results("SELECT * FROM $sport_table ");
	$id_cat_raw = get_option('BW_top_widget_cat');
	$id_cat = explode(',', $id_cat_raw);
	?>

	<?php
	if (isset( $_GET['top_widget_button'] ) && $_GET['top_widget_button'] == 'update') {
		update_option('bw_link_top', $_POST['bw_link_top']);
		echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	}
	if (isset( $_GET['link'] ) && $_GET['link'] == 'show') {
		update_option('BW_show_link', 'show');
		echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	}
	?>
			
			
			
	<div class="bw-text"><?php _e('Choose the categories that will be shown in widget (StakesWidgetTop) on the site. If all the check marks are removed, the site will screen all the categories','bet-on-sports'); ?></div>
	<ul class="sport_list">
		<?php
		foreach ($res as $sport) {
			if ($sport->name_sport != '') {
				if ($id_cat_raw == 'all' || in_array($sport->ID_sport, $id_cat)) {
					$chec = 'checked="checked"';
				} else {
					$chec = '';
				}
				?>
					<li>
						<input type="checkbox" <?php echo $chec; ?> name="sportID[]" value="<?php echo $sport->ID_sport; ?>"/>
						<label class="label" for="sportID[]"><?php echo $sport->name_sport; ?></label>
					</li>
			<?php }
		} ?>
	</ul>
	<input type="submit" class="button button-primary" value="<?php _e('Save','bet-on-sports'); ?>">
</form>

<?php
if (@$_GET['top_widget_button'] == 'update') {
	if (isset($_POST['sportID'])) {
		$i = 0;
		$idcount = count($_POST['sportID']);
		$ids = '';
		foreach ($_POST['sportID'] as $data) {

			$i++;
			$ids .= $data;
			if ($i != $idcount)
				$ids .=',';
		}
		update_option('BW_top_widget_cat', $ids);
	}else {
		update_option('BW_top_widget_cat', '');
	}


	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}