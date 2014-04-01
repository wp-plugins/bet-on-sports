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
    <div class="CSSTableGenerator" >
	<table>
	    <tr>
		<td><?php _e('Setting name', 'bet-on-sports') ?></td>
		<td><?php _e('Setting', 'bet-on-sports'); ?></td>
		<td><?php _e('Comment', 'bet-on-sports') ?></td>
	    </tr>
	    <tr>
		<td><?php _e('Language output', 'bet-on-sports'); ?></td>
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
		</td>
		<td>
		    <ul>
			<li><?php _e('Language in which widgets are displayed on the site.', 'bet-on-sports'); ?></li>
			<li><?php _e('Language in which the data will be taken from the server.', 'bet-on-sports'); ?></li>
		    </ul>
		</td>
	    </tr>
	    <tr>
		<td><?php _e('Current version of sports base', 'bet-on-sports'); ?></td>
		<td><?php echo get_option('BW_date_sport'); ?><br/><br/><span  class="updet bw_button_small"><?php _e('Renew the data', 'bet-on-sports'); ?> </span>

		    <div class="bw-none krutilka" id="krutilka" ></div></td>
		<td></td>
	    </tr>
	</table>
    </div><br/>
</form>
