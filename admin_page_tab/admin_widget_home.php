<h3><?php _e('Good afternoon','bet-on-sports'); ?></h3>
<p><?php _e('The plug-in gives shows in widgets the actual coefficients for consecutive sport events. The references in coefficients lead to the site of bookmaker`s office betathome.','bet-on-sports'); ?></p>
<div id="opt" ajax="<?php echo get_option('siteurl'); ?>"></div>
<?php if (get_option('BW_show_link') == 'close'): ?>
	<p><?php _e('If you register at the site bet-at-home.com, you will be able to participate in the referral system','bet-on-sports'); ?>
		<a href="<?php echo Stakes::get_func_links('ref'); ?>" target="_blank" onclick="window.location = '?page=bw_main_page&link=show'" class="bw_button_small"><?php _e('get the partner reference','bet-on-sports'); ?></a></p>

	<!--?page=bw_main_page&link=show-->
<?php elseif (get_option('BW_show_link') == 'show'): ?>
	<p><?php _e('To alter the ID from current one to your own. <b>You have to become a partner bet-at-home.com </b>','bet-on-sports'); ?></p>
<p><?php _e('For this purpose you should:','bet-on-sports'); ?>
<ol>
	<li><?php _e('Register','bet-on-sports'); ?><a href="<?php echo Stakes::get_func_links('ref'); ?>" class="bw_button_small">bet-at-home.com</a></li>
	<li><?php _e('Get your ID and paste it into "Your ID" field','bet-on-sports'); ?></li>
	<li><?php _e('Get affiliated reference and paste it into the following tab (the upper widget) in the "Affiliated reference" field','bet-on-sports'); ?></li>
	<li><?php _e('Earn money with us staying at home.','bet-on-sports'); ?></li>
</ol></p>
	<form action="?page=bw_main_page&top_button=update" method="POST" >
		<label for="BW_ab_link" class="bw-form-label"><?php _e('Your ID','bet-on-sports'); ?></label>
		<input id="BW_ab_link" type="text" autocomplete="off" value="<?php echo get_option('BW_ab_link'); ?>" size="30" name="BW_ab_link">
		<br/><br/>
		<label for="BW_ab_lang" class="bw-form-label"><?php _e('Your Language','bet-on-sports'); ?></label>
		<input id="BW_ab_lang" type="text" autocomplete="off" value="<?php echo get_option('BW_ab_lang'); ?>" size="30" name="BW_ab_lang">
		en, ru, it, es, de, pt, pl, lt

		</p>
	<?php endif; ?>

	<p><?php if (get_option('BW_show_link') == 'show'): ?>
			<input type="submit" class="bw_button_small" value="<?php _e('Save','bet-on-sports'); ?>">
	</form>		 
<?php endif; ?>
<span  class="updet bw_button_small"><?php _e('Renew the data','bet-on-sports'); ?> </span>
<span  class="updete_default bw_button_small"><?php _e('Restore standard settings','bet-on-sports'); ?></span></p>
<div class="bw-none krutilka" id="krutilka" ></div>

<?php
if (isset( $_GET['top_button'] ) && $_GET['top_button'] == 'update') {

	update_option('BW_ab_lang', $_POST['BW_ab_lang']);
	update_option('BW_ab_link', $_POST['BW_ab_link']);
	
	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}
if (isset( $_GET['link'] ) && $_GET['link'] == 'show') {
	update_option('BW_show_link', 'show');
	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}