=== Bet on sports - Таблицы, ставки на спорт, прогнозы.  ===
Contributors: SEOAlbion
Donate link: http://www.bukmekerskajakontora.ru/
Tags: филиал, спорт, ставки, прогнозы на спорт, коэффициенты, таблица ставок, букмекерский коэффициент, Букмекерская контора, спортивные ставки, спортивные виджеты, виджеты
Requires at least: 1.2
Tested up to: 2
Stable tag: 1.2
License: GPL
License URI: http://www.gnu.org/licenses/gpl.html

Bet on sports - Плагин выводит актуальные коэффициенты на спортивные события. 

== Description ==
**Таблицы, ставки на спорт, прогнозы.** Два виджета, верхний и боковой, где выводятся коэффициенты ставок букмекерской конторы **bet-athome**, посетители на вашем сайте смогут делать сразу ставки! Партнерскую ссылку можно менять, можно выводить разные виды спорта.

**Bet on sports** - позволяет выводить в виджетах актуальные коэффициенты на спортивные события. Так же можно стать участником партнерской программы bet-at-home.com
Плагин состоит из двух виджетов:

* ( Stakes Widget Top ) Верхний виджет
* ( Stakes Widget Sports ) Боковой виджет
 
**Stakes Widget Top** - В этом виджете выводятся актуальные коэффициенты по основным ставкам из выбранных категорий.

**Stakes Widget Sports** - Этот виджет выводит на экран Виды спорта разделённые на место проведения и турниры, по нажатию на турнир откроется сводка вопросов и коэффициентов.
 
Все данные хранятся на сайте http://www.bukmekerskajakontora.ru  в XML файлах, файлы обновляются  каждый день. Плагин автоматически проверяет ajax запросом   дату обновления XML файла на сервере,
 если даты не совпадают, тогда данные записываются в промежуточные таблицы, созданные в базе при установке плагина, после как все данные с XML файла будут в базе, виджеты начнут показывать эти данные.
 
 Так же можно обновить принудительно в админ-панели плагина

== Installation ==
1. Распакуйте архив с плагином в папку `/wp-content/plugins/bukmekers-widget`
2. Активируйте плагин через меню 'Плагины' панели управления.
3. Вывод на экран:
Для того что бы вывести виджеты, сначала необходимо создать два сайдбара  в файле темы (functions.php) http://codex.wordpress.org/Function_Reference/register_sidebar
Например:
<code>
<?php 
	$args_sidebar1 = array(
		'name'          => __( 'Sidebar name1', 'theme_text_domain' ),
		'id'            => 'unique-sidebar-id-1',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' ); 
		
	$args_sidebar2 = array(
		'name'          => __( 'Sidebar name2', 'theme_text_domain' ),
		'id'            => 'unique-sidebar-id-2',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' ); 
	if ( ! function_exists( 'register_sidebar' ) ) :
    	register_sidebar($args_sidebar1);
		register_sidebar($args_sidebar2);
	endif;
?></code>
После создания сайдбаров нужно  вывести их в теме в нужном месте Вашего шаблона вставляем такой код:
<code>
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name1');
endif;
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name2');
endif;

</code>
После этого необходимо вывести установленные виджеты в созданных сайдабарах. В админ-панели на странице виджетов просто перетаскиваем необходимый нам виджет в созданный нами сайдбар. 

== Frequently Asked Questions ==

= Нужно ли где-то регистрироваться, чтобы плагин заработал? =

Нет, плагин заработает сразу после установки!
= Виджеты не корректно отображаются на странице, что делать? =
Для  того чтобы виджеты работали корректно, в Вашей теме должен быть подключен  плагин jQuery , если плагин не подключен, то в файле темы functions.php  вставляем следующий код : 
<?php wp_enqueue_script("jquery"); ?>

= Виджеты не появились автоматически в моей теме, что делать? =

Для того что бы вывести виджеты, необходимо создать два сайдбара  в файле темы (functions.php) http://codex.wordpress.org/Function_Reference/register_sidebar
Например:
<code>
<?php 
	$args_sidebar1 = array(
		'name'          => __( 'Sidebar name1', 'theme_text_domain' ),
		'id'            => 'unique-sidebar-id-1',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' ); 
		
	$args_sidebar2 = array(
		'name'          => __( 'Sidebar name2', 'theme_text_domain' ),
		'id'            => 'unique-sidebar-id-2',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' ); 
	if ( ! function_exists( 'register_sidebar' ) ) :
    	register_sidebar($args_sidebar1);
		register_sidebar($args_sidebar2);
	endif;
?></code>
После создания сайдбаров необходимо вывести их в теме и в нужном месте Вашего шаблона вставляем такой код:
<code>
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name1');
endif;
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name2');
endif;

</code>
После этого необходимо вывести установленные виджеты в созданных сайдбарах. В админ панели на странице виджетов просто перетаскиваем нужный нам виджет в созданный нами сайдбар. 

== Screenshots ==

1.	( Stakes Widget Top ) Верхний виджет
2.	( Stakes Widget Sports ) Боковой виджет
3.	Выбор категорий для Stakes Widget Top
4.	Главная страница
5.	Страница с выбранным турниром на сайте

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
