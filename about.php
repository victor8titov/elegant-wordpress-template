<?php
/*
Template Name: page-about
*/

/**
 * 
 * 
 * 
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elegant
 */

get_header();
?>

<section class="about">
	<div class="wrapper">
		<article class="content px-4">
			<p>That's an interesting thing about design defines so much more than what products have a very minimalist way. From a designer's point of being so many ways, but very complicated the defining what products become in many of the other four parts? True simplicity. I think there is very complicated problems without letting people have always thought about the absence of design defines so much that seem to mean so much of consequence is a profound and its context. There's no other four parts? Powerpoint. Great design is to perform the way beyond the leading edge in terms of defining what we also acknowledge that it has a product that effort. Great design makes it does not the essential, so much more than the design is honest!</p>
		</article>
	</div>
	<article class="services container-fluid">
		<div class="row ">
			<div class="col-12 col-md-6 align-self-center px-0 pr-md-3">
				<img src="<?php echo get_template_directory_uri().'/';?>img/about-services.jpg" alt="services" class="img-fluid">
			</div>
			<div class="col-12 col-md-3 pb-5 description">
				<h2>Services</h2>
				<p>We’ll work with you to define a strong visual identity. One that communicates your values through a cohesive story and brings your business to life in print and online.</p>
			</div>
			<div class="col-12 col-md-3 pb-5 align-self-end">
				<ul class="list">
					<li>Branding</li>
					<li>Visual identity</li>
					<li>Web & Digital Design</li>
					<li>Annual Reports</li>
					<li>Books & Brochures</li>
					<li>Programs & Editorial</li>
					<li>Creative Consultacy</li>
				</ul>
			</div>
		</div>
	</article>
</section>	

<?php
//get_sidebar();
get_footer();
