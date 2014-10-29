<?php
/**
 * The template for displaying Search Results pages.
 *
 *
 * @package WordPress
 * @subpackage Gmk_Theme
 * @since Gmk Theme 0.29
 */

get_header(); ?>
<section>
	<h1>Contenido</h1>
	<h2>Busqueda</h2>
	<?php
	/* Run the loop to output the page.
	 * If you want to overload this in a child theme then include a file
	 * called loop-page.php and that will be used instead.
	 */
	get_template_part( 'loop', 'loop' );
	?>
</section>
<?php get_footer(); ?>
