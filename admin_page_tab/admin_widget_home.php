<div id="opt" ajax="<?php echo get_option('siteurl'); ?>"></div>
<?php if (get_option('BW_show_link') == 'close'): ?>
	<h3><?php _e('The plugin has been successfully installed.', 'bet-on-sports'); ?></h3>
	<p><?php _e('Now you need to select the language and download sports data:', 'bet-on-sports'); ?></p>
	<?php
	$wlang = get_option('BW_Lang');
	$wru = $wen = $wit = $wes = $wde = $wpt = $wcz = $wpl = $wlt = '';
	if ($wlang == 'ru_RU') {
		$wru = 'selected="selected"';
	}
	if ($wlang == 'en_US') {
		$wen = 'selected="selected"';
	}
	if ($wlang == 'it_IT') {
		$wit = 'selected="selected"';
	}
	if ($wlang == 'es_ES') {
		$wes = 'selected="selected"';
	}
	if ($wlang == 'de_DE') {
		$wde = 'selected="selected"';
	}
	if ($wlang == 'pt_PT') {
		$wpt = 'selected="selected"';
	}
	if ($wlang == 'cs_CZ') {
		$wcz = 'selected="selected"';
	}
	if ($wlang == 'pl_PL') {
		$wpl = 'selected="selected"';
	}
	if ($wlang == 'lt_LT') {
		$wlt = 'selected="selected"';
	}
	?>
	<form action="?page=bw_main_page&lang=update" method="POST">
		<p>
			<select name="BW_Lang">
				<option <?php echo $wru; ?> value="ru_RU">Русский</option>
				<option <?php echo $wen; ?> value="en_US">English</option>
				<option <?php echo $wit; ?> value="it_IT">Italiano</option>
				<option <?php echo $wes; ?> value="es_ES">Español</option>
				<option <?php echo $wde; ?> value="de_DE">Deutsch</option>
				<option <?php echo $wpt; ?> value="pt_PT">Portugal</option>
				<option <?php echo $wcz; ?> value="cs_CZ">Čeština</option>
				<option <?php echo $wpl; ?> value="pl_PL">Polski</option>
				<option <?php echo $wlt; ?> value="lt_LT">Lietùvių</option>
			</select>
			<a class="updet button button-primary"><?php _e('Upload sports data', 'bet-on-sports'); ?></a>
		</p>
		<p class="description"><?php _e('Loading data will continue about ~10 minutes. Do not close the page, wait while the notification of the completed download.', 'bet-on-sports'); ?></p>
		<p class="description"><?php _e('After the download is complete do not forget to turn on the display of the table in widgets section.', 'bet-on-sports'); ?></p>
		<div class="krutilka progress" style="display:none">
			<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
		</div>
	</form>
	<!--?page=bw_main_page&link=show-->
<?php elseif (get_option('BW_show_link') == 'show'): ?>
	<p><?php _e('Enter your link in the box below:', 'bet-on-sports'); ?></p>
	
	<form action="?page=bw_main_page&top_button=update" method="POST" >
		<label for="BW_ab_link" class="bw-form-label"><?php _e('Enter the URL', 'bet-on-sports'); ?></label><br>
		<input id="BW_ab_link" type="text" autocomplete="off" value="<?php echo get_option('BW_ab_link'); ?>" size="30" name="BW_ab_link">
		
		<?php
		$wlang = get_option('BW_Lang');
		$BW_ab_lang = get_option('BW_ab_lang');
		if(empty($BW_ab_lang)) $BW_ab_lang = 'ru';
		if ($wlang == 'ru_RU') {
			$BW_ab_lang = 'ru';
		}
		if ($wlang == 'en_US') {
			$BW_ab_lang = 'en';
		}
		if ($wlang == 'it_IT') {
			$BW_ab_lang = 'it';
		}
		if ($wlang == 'es_ES') {
			$BW_ab_lang = 'es';
		}
		if ($wlang == 'de_DE') {
			$BW_ab_lang = 'de';
		}
		if ($wlang == 'pt_PT') {
			$BW_ab_lang = 'pt';
		}
		if ($wlang == 'cs_CZ') {
			$BW_ab_lang = 'cs';
		}
		if ($wlang == 'pl_PL') {
			$BW_ab_lang = 'pl';
		}
		if ($wlang == 'lt_LT') {
			$BW_ab_lang = 'lt';
		}
		?>
		
		<input id="BW_ab_lang" type="hidden" autocomplete="off" value="<?php echo $BW_ab_lang; ?>" name="BW_ab_lang">
		<input type="submit" class="button button-primary" value="<?php _e('Save', 'bet-on-sports'); ?>">
	</form>
<?php endif; ?>

<?php
if (isset($_GET['top_button']) && $_GET['top_button'] == 'update') {

	update_option('BW_ab_lang', $_POST['BW_ab_lang']);
	update_option('BW_ab_link', $_POST['BW_ab_link']);

	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}
if (isset($_GET['link']) && $_GET['link'] == 'show') {
	update_option('BW_show_link', 'show');
	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}