<h3>Добрый день</h3>
<p>Плагин позволяет выводить в виджетах актуальные коэффициенты на спортивные события. Ссылки на коэффициентах ведут на сайт букмекерской конторы bet-at-home.</p>
<div id="opt" ajax="<?php echo get_option('siteurl'); ?>"></div>
<?php if (get_option('BW_show_link') == 'close'): ?>
	<p>Если вы зарегистрируетесь на сайте bet-at-home.com, то сможете учувствовать в реферальной системе 
		<a href="http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_31095&aid=" target="_blank" onclick="window.location = '?page=bw_main_page&link=show'" class="bw_button_small">Получить партнерскую ссылку</a></p>

	<!--?page=bw_main_page&link=show-->
<?php elseif (get_option('BW_show_link') == 'show'): ?>
	<p>Что бы поменять ID c текущего на свой<b>Вам нужно стать партнёром bet-at-home.com</b></p>
<p>Для этого необходимо:
<ol>
	<li>Зарегистрироваться<a href="http://affiliates.bet-at-home.com/processing/clickthrgh.asp?btag=a_45206b_31095&aid=" class="bw_button_small">bet-at-home.com</a></li>
	<li>Получить ID и вставить его в поле "Ваш ID"</li>
	<li>Получить Филиальную ссылку и вставить ее на следующей вкладке(Верхний виджет) в поле "Филиальная ссылка"</li>
	<li>Зарабатывать вместе с нами деньги не выходя из дома</li>
</ol></p>
	<form action="?page=bw_main_page&top_button=update" method="POST" >
		<label for="BW_ab_link" class="bw-form-label">Ваш ID</label>
		<input id="BW_ab_link" type="text" autocomplete="off" value="<?php echo get_option('BW_ab_link'); ?>" size="30" name="bw_link_top">
		<br/><br/>
		<label for="BW_ab_lang" class="bw-form-label">Ваш Язык</label>
		<input id="BW_ab_lang" type="text" autocomplete="off" value="<?php echo get_option('BW_ab_lang'); ?>" size="30" name="bw_link_top">

		</p>
	<?php endif; ?>

	<p><?php if (get_option('BW_show_link') == 'show'): ?>
			<input type="submit" class="bw_button_small" value="Сохранить">
	</form>		 
<?php endif; ?><span  class="updet bw_button_small">Обновить данные</span><span  class="updete_default bw_button_small">Вернуть стандартные настройки</span></p>
<div class="bw-none" id="krutilka" ></div>

<?php
if (@$_GET['top_button'] == 'update') {
	update_option('BW_ab_lang', $_POST['BW_ab_lang']);
	update_option('BW_ab_link', $_POST['BW_ab_link']);
	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}
if (@$_GET['link'] == 'show') {
	update_option('BW_show_link', 'show');
	echo '<script>window.location = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}