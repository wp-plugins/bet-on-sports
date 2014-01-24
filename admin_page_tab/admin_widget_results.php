<form action="?page=bw_main_page&results_button=update" method="POST">
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
	$id_cat = explode(',', get_option('BW_sport_cat'));
	?>
	<div class="bw-text">Выберите категории, которые будут отображаться в виджете Stakes Widget Sports на сайте, если все галочки сняты, то отображаться на сайте будут все категории </div>
	<ul class="sport_list">
<?php
foreach ($res as $sport) {
	if ($sport->name_sport != '') {
		if (in_array($sport->ID_sport, $id_cat)) {
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
	<input type="submit" class="bw_button_small" value="Сохранить">
</form>

<?php
if (@$_GET['results_button'] == 'update') {
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
		update_option('BW_sport_cat', $ids);
	}else {
		update_option('BW_sport_cat', 'all');
	}

	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}