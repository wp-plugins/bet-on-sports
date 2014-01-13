=== Bet on sports - Таблицы, ставки на спорт, прогнозы. ===
Contributors: SEOAlbion
Donate link: http://www.bukmekerskajakontora.ru/
Tags: спорт, ставки, прогнозы на спорт, коэффициенты, таблица ставок , букмекерский коэффициент, Букмекерская контора, спортивные ставки, спортивные виджеты,  виджеты
Requires at least: 1.2
Tested up to: 2
Stable tag: 1.2
License: GPL
License URI: http://www.gnu.org/licenses/gpl.html

Bet on sports - Плагин выводить актуальные коэффициенты на спортивные события. 

== Description ==
Таблицы, ставки на спорт, прогнозы. Два виджета, верхний и боковой, где выводятся коэффициенты ставок букмекерской конторы bet at home, посетители на вашем сайте смогут делать сразу ставки! Партнерскую ссылку можно менять, можно выводить разные виды спорта.
Bet on sports - Плагин позволяет выводить в виджетах актуальные коэффициенты на спортивные события. Так же можно стать участником партнерской программы bet-at-home.com
Плагин состоит из двух виджетов:
-( Stakes Widget Top ) Верхний виджет
-( Stakes Widget Sports ) Боковой виджет

 Stakes Widget Top    - В этом виджете выводятся актуальные коэффициенты по основным ставкам из выбранных категорий.
 Stakes Widget Sports - Этот виджет выводит на экран Виды спорта разделённые на место проведение и турниры, по нажатию на турнир откроется сводка вопросов и коэффициентов.
 
 Все данные хранятся на сайте http://bukmekerskajakontora.ru  в XML файлах, файлы обновляются  каждый день. А плагин автоматически проверяет ajax запросом, сравнивая дату обновления XML файла на сервере,
 если даты не совпадают, тогда данные записываются в промежуточные таблицы созданных базе данных при установке плагина, после как все данные с XML файла будут в базе денных виджиты начнут показывать эти данные.
 Так же можно обновить принудительно в админ панели плагина

== Installation ==
1. Распакуйте архив с плагином в папку `/wp-content/plugins/bukmekers-widget`
2. Активируйте плагин через меню 'Плагины' Панели управления.
3. Вывод на экан:
Для того что бы вывести виджеты нужно сначала создать Sidebar
<code>
if ( ! function_exists( 'register_sidebar' ) ) :
    	register_sidebar( array(
		'name'          => __( 'myTheme-Top', 'myTheme' ),
		'id'            => 'sidebar-Top-myTheme',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'myTheme' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
    	register_sidebar( array(
		'name'          => __( 'myTheme-Result', 'myTheme' ),
		'id'            => 'sidebar-Result-myTheme',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'myTheme' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
endif;
</code>
После создания Sidebar нужно их вывести в теме в нужном месте вставляем такой код
<code>
( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar( 'sidebar-Top-myTheme' );
endif;
</code>
После нужно вывести установленный виджет в созданом Sidebar . В админ панели на странице виджетов просто перетаскиваем нужный нам виджет,  в созданный нами sidebar. 
== Frequently Asked Questions ==

= Нужно ли где-то регистрироваться, чтобы плагин заработал? =

Нет, плагин заработает сразу после установки!
= Виджеты не корректно отображаются на странице, что делать? =
что бы виджеты работали корректно нужно в Вашей теме должен быть подключен плагин jQuery, если не подключено то в файле темы function.php 
вставле следующее <?php wp_enqueue_script("jquery"); ?>
= Виджеты не появились автоматически в моей теме, что делать? =

Для того что бы вывести виджеты нужно сначало создать Sidebar
<code>
if ( ! function_exists( 'register_sidebar' ) ) :
    	register_sidebar( array(
		'name'          => __( 'myTheme-Top', 'myTheme' ),
		'id'            => 'sidebar-Top-myTheme',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'myTheme' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
    	register_sidebar( array(
		'name'          => __( 'myTheme-Result', 'myTheme' ),
		'id'            => 'sidebar-Result-myTheme',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'myTheme' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
endif;
</code>
После создания Sidebar нужно их вывести в теме. Таким вот кодом представленым ниже :
<code>
( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar( 'sidebar-Top-myTheme' );
endif;
</code>
После  нужно вывести установленный виджет в созданом Sidebar . В админ панели на странице виджетов просто перетаскиваем нужный нам виджет,  в созданный нами sidebar. 

== Screenshots ==

1.	( Stakes Widget Top ) Верхний виджет
2.	( Stakes Widget Sports ) Боковой виджет
3.	Выбор категорий для Stakes Widget Top
4.	Главная страница
5.	Страница с выбраным турниром на сайте

== Changelog ==

Список версий и изменений.

== Upgrade Notice ==
= 1.0 =
* Релиз.
= 1.1 =
* Исправлен js код.
= 1.2 =
* Добавлены дополнительные проверки и обновлено меню виджета
= 1.2 =
Первый релиз
