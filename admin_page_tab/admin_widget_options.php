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
?><form action="?page=bw_main_page&lang=update" method="POST">
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="blogname"><?php _e('Language output', 'bet-on-sports'); ?></label></th>
				<td>
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
					<span class="description"><?php _e('Language of widgets on the front part of the site', 'bet-on-sports'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="blogname"><?php _e('Current version of sports base', 'bet-on-sports'); ?></label></th>
				<td>
					<code><?php echo get_option('BW_date_sport'); ?></code>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="submit">
		<p><span  class="updet button button-primary"><?php _e('Renew the data', 'bet-on-sports'); ?></span></p>
		<p class="description"><?php _e('Loading data will continue about ~10 minutes. Do not close the page, wait while the notification of the completed download.', 'bet-on-sports'); ?></p>
		<div class="krutilka progress" style="display:none">
			<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
		</div>
	</div>
</form>
