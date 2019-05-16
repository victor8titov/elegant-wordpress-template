<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegant
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$name_class = '';
	if ( get_post_type() === 'page' && is_front_page()) {
		// главная страница
		//	в настройка сайта указана статическая страница
		$name_class = 'page-main';
	} else if (get_post_type() === 'post' ) {
		// страница постов
		$name_class='page-posts';
	} else if (get_post_type() === 'work') {
		//	страница кастом пост тайпа work
		$name_class='page-work';
	} else if (get_post_type() === 'project') {
		// кастом пост тайп project
		$name_class='page-project';
	} else if (is_page_template('contact.php') && get_post_type() === 'page') {
		// page в котором указан шаблон contact.php
		$name_class='page-contact';
	} else if (is_page_template('about.php') && get_post_type() === 'page') {
		// page в котором указан шаблон about.php
		$name_class='page-about';
	} else {
		$name_class = 'page-main';
	}


?>


<!-- HEADER -->
<header id="masthead" class="site-header containear-fluid <?php echo $name_class; ?>">
	<div class="container">

		<div class="row justify-content-between ">
			<!-- LOGO -->
			<div class="col-11 col-md-10 header-logo">
				<?php
				the_custom_logo();
				?>
			</div>

			<div class="col-1 col-md-2  p-0">
				<!-- NAVIGATON -->
				<nav id="site-navigation" class="header-menu ">
					<div class="menu-icon" id="menu-icon">
						<div class="line-1" id="line-1"></div>
						<div class="line-2" id="line-2"></div>
						<div class="line-3" id="line-3"></div>
					</div>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'header_menu',
						'menu_id'        => 'header-menu',
						'menu_class'	 => 'menu gradient-menu ',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	
		<div class="row text-center ">
			<!-- MASTHEAD -->
			<div class="col-12 masthead">
				<h1>Say <span class="italic">Haloa</span> to your Portfolio</h1>
			</div>					
		</div>
		<div class="move-down invisible"></div>
  	</div>
</header>
