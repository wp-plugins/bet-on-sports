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
	$id_cat = explode(',', get_option('BW_top_widget_cat'));
	if (get_option('BW_show_link') != 'close') {
		if (get_option('BW_show_link') == 'close'):
			?>
			<p>Если вам нужна личная ссылка, нажмите эту кнопку.<a href="http://www.bukmekerskajakontora.ru/" target="_blank" onclick="window.location = '?page=bw_main_page&link=show'" class="bw_button_small">Получить партнерскую ссылку</a></p>
			<!--?page=bw_main_page&link=show-->
		<?php elseif (get_option('BW_show_link') == 'show'): ?>
			<p>
				Ссылки на коэфициентах ведут на сайт букмекерской конторы bet at home.
			</p><p>
				<label for="BW_ab_lang" class="bw-form-label">Филиальная ссылка</label>
				<input id="BW_ab_lang" type="text" autocomplete="off" value="<?php echo get_option('BW_link'); ?>" size="30" name="bw_link_top">
				<br/><br/>



			</p>
		<?php endif;
	} ?>

	<?php
	if (@$_GET['top_button'] == 'update') {
		update_option('BW_link', $_POST['bw_link_top']);
		echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	}
	if (@$_GET['link'] == 'show') {
		update_option('BW_show_link', 'show');
		echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
	}
	?>
	<div class="bw-text">Выберите категории которые будут отображаться в виджете ( Stakes Widget Top ) на сайте, если все галочки сняты то отображаться на сайте будут все категории</div>
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
					<input type="checkbox" <?php echo $chec; ?> name="sportID[]" title="<?php echo $sport->name_sport; ?>" value="<?php echo $sport->ID_sport; ?>"/>
					<label class="label" title="<?php echo $sport->name_sport; ?>" for="sportID[]"><?php echo $sport->name_sport; ?></label>
				</li>
			<?php }
		} ?>
	</ul>
	<input type="submit" class="bw_button_small" value="Сохранить">
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
		update_option('BW_top_widget_cat', 'all');
	}


	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}