<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegant
 */

?>





	
	<footer id="colophon" class="">
		<div class="wrapper">
			<div class="row justify-content-center align-items-start">
				<div class="col-12 col-md-7">
					<p>&#169; 2014 Designed and Developed by Diogo Dantas</p>				
				</div>
				<div class="col-12 col-md-5 text-md-right">
					<a href="mailto:imdiogodantas@gmail.com">Email: imdiogodantas@gmail.com</a>
				</div>
			</div>
		</div>	
	</footer>

<?php wp_footer(); ?>


<?php if ( get_post_type() === 'page' && is_front_page()): ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmHUV8JIqLC9SdhjFrIfH2-vJ7uFZUixY&callback=initMap" async defer></script>
<?php endif; ?>



</body>
</html>
