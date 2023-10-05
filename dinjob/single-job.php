<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>
<main id="site-content" class="site-main container mt-5">
	
	<div class="row">
		
		<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
			
			<?php

			if ( have_posts() ) {

				while ( have_posts() ) {
					the_post();

					dinjob_get_template_part( 'content', 'single-job' );
				}
			}

			?>
		</div>
		
		<?php get_sidebar(); ?>
		
	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
