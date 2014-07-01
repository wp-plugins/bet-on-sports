=== Bet on Sports - Russian, English, German, Czech, Portuguese, Italian, Spanish, Polish, Lithuanian ===
Contributors: SEOAlbion
Donate link: http://www.bukmekerskajakontora.ru/
Tags: sport, stakes, sport prognoses, coefficients, tables of stakes , bookmaker's coefficient, bookmaker's office, stakes on sport, sport widgets,  widgets , affiliate
Requires at least: 2.1
Tested up to: 2.4.1
Stable tag: 2.4.1
License: GPL
License URI: http://www.gnu.org/licenses/gpl.html
Bet on Sports - The plug-in shows the actual coefficients for consecutive sport events. 
== Description ==
**Tables, stakes on sport, prognoses.** There are two widgets - the upper and the side ones, where the coefficients for stakes of bookmaker's office betathome are shown, the visitors of your site can enter stakes at once! The partner reference can be changed, there is an opportunity to screen different types of sport.
**Bet on Sports** - shows the actual coefficients for consecutive sport events. You can also become a participator of partner program bet-at-home.com
The plug-in consists of two widgets :

* ( Stakes Widget Top ) Upper widget

* ( Stakes Widget Sports ) Side widget

**StakesWidgetTop** - In this widget there are actual coefficients for common stakes from selected categories shown.

**StakesWidgetSports** - This widget screens the Types of sport subdivided into the Event Location and  the Tournaments. By clicking the Tournaments the digest of questions and coefficients will be opened.
All the data are saved at http://www.bukmekerskajakontora.ru  in the form of XML files, the files are renewed daily. The plug-in automatically checks the date of XML file’s renewal on the server by means of ajax-request. If the dates are not concurred, the data is registered in staging tables created in the base during the installation of the plug-in. When all the data of XML file are loaded into the base, the widgets will screen them at once.
 Also you can forcedly renew the data in admin panel of the plug-in
== Installation ==
1. Unpack the plug-in into the folder `/wp-content/plugins/bukmekers-widget`
2. Activate the plug-in through the ‘Plug-ins’ menu in the control panel.
3. Screening:
To screen the widgets you should at first create two side-bars in the file of the theme (functions.php) http://codex.wordpress.org/Function_Reference/register_sidebar
For example:
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
After the side-bars were created one should add them to the theme. Paste the following code to the necessary point of your template:
<code>
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name1');
endif;
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name2');
endif;

</code>
Then one should place the installed widgets in the side-bars. For this purpose just carry the necessary widget in the admin panel to suitable side-bar. 
== Frequently Asked Questions==
= Should I register to activate the plug-in =
No, the plug-in is ready for work after installation!
= Widgets are screened incorrectly on the page, what to do? =
For the correct work of widgets in your theme there should be the plug-in jQuery, if it is not plugged-in, then paste the following code into the theme file functions.php : 
<?php wp_enqueue_script("jquery"); ?>
= Widgets are not shown automatically in my theme, what to do? =
To screen the widgets you should at first create two side-bars in the theme file (functions.php) http://codex.wordpress.org/Function_Reference/register_sidebar
For example:
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
After the side-bars were created one should add them to the theme. Paste the following code to the necessary point of your template:
<code>
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name1');
endif;
if( ! function_exists( 'register_sidebar' ) ) :
dynamic_sidebar('Sidebar name2');
endif;

</code>

Then one should place the installed widgets in the side-bars. For this purpose just carry the necessary widget in the admin panel to suitable side-bar. 
== Screenshots ==
1.	( Stakes Widget Top ) Upper widget
2.	( Stakes Widget Sports ) Side widget
3.	Selection of categories for StakesWidgetTop
4.	The main page
5.	The page of selected tournament on the site
== Change Log ==
= 1.0 =
* Release.
= 1.1 =
* Fixed js code.
= 1.2 =
* Added extra checks and updated menu widget
= 1.2 =
* The first release
= 2.0 =
* Added localization: Russian, English, German, Czech, Portuguese, Italian, Spanish
= 2.1 =
* General fix
== Upgrade Notice  ==
= 1.0 =
* Release.
= 1.1 =
* Fixed js code.
= 1.2 =
* Added extra checks and updated menu widget
= 1.2 =
* The first release
= 2.0 =
* Added localization: Russian, English, German, Czech, Portuguese, Italian, Spanish
= 2.1 =
* General fix
