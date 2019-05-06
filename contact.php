
<?php
/*
Template Name: page-contact
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

<?php
/**
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

<section class="contact">
	<div class="wrapper">
		<div class="row">
			<div class="col-12 text-center ">
				<div class="header">
					<h3>This is it!</h3>
					<h2>Contact Us</h2>	
				</div>				
			</div>
			<div class="col-12 col-md-5 px-md-1">
				<div class="adress">
					<h4>Rua Serpa Pinto, Lisbon, Portugal</h4>
				</div>				
			</div>
			<div class="col-12 col-md-7 px-md-1">
				<div class="img">
					
				</div>				
			</div>
			<div class="col-12 col-md-7 py-md-0 px-md-0  ">
				<div class="text">
					<p>Good design as little design as possible. Good design is to chance. My goal is making something memorable and especially the consumer. Good design is aesthetic. Care and aesthetic. Good design emphasises the consumer. It does not only functional.</p>
				</div>				
			</div>
			<div class="col-12 col-md-5  py-md-0 px-md-0 ">	
				<div class="phone">
					<ul>
						<li><h4>+88 (0) 101 0000 000</h4></li>
						<li><h4>+88 (0) 101 0000 000</h4></li>
					</ul>
				</div>			
				
			</div>
			<div class="col-12 text-center">
				<div class="box-button">
					<a href="#" class="button" id="show-form">Shote us an Email</a>
				</div>
				<div class="box-form">
					<div class="button-close" id="button-close"></div>
					<h2 class="text-uppercase mb-4">Contact us</h2>
        			<p class="mb-4">Please contact us for all inquiries.</p>
       
					<form action="#" method="post" class="form">
						<div class="row justify-content-center">
							<div class="form-group col-12 col-md-6">
								<input type="text" id="name" name="name" class="form-control " placeholder="Name" required>
							</div>
							<div class="form-group col-12 col-md-6">
								<input type="email" class="form-control " id="email" aria-describedby="emailHelp" name="email" placeholder="Enter Email" required>
							</div>
							<div class="form-group col-12">
								<textarea class="form-control " rows="5" placeholder="Enter the messsage" name="message" id="message" required></textarea>
								<textarea name="comment" id="comment"></textarea>
        						<textarea name="content" id="content"></textarea>
							</div>
							<div class="col-12 col-md-4 ">
								<button type="submit" class="button  w-100" id="submit" >Send</button>
							</div>
						</div>
					</form>
					<div class="message invisible d-flex flex-column justify-content-center align-items-center " id="form-message">
						<div class="spinner-border text-secondary  invisible" role="status">
						</div>
						<h4 class="status m-5"></h4>
					</div>
					<script>
					var ajaxQueryForm = {
						url: '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
					}                
					</script>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
//get_sidebar();
get_footer();
