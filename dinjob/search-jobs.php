<?php

get_header();

?>
<main id="site-content" class="site-main container mt-5">
	
	<div class="row">
		<?php
		if ( sacchaone_sidebar( 'left' ) ) {
			get_sidebar( 'left' );
		}
		?>
		
		<div id="primary" class="content-area <?php echo esc_attr( sacchaone_class_attr( 'content-area' ) ); ?>">
			<?php
			

			if ( have_posts() ) {

				/**
				 * Hook sacchaone_archive_title
				 *
				 * @hooked sacchaone_archive_title 10
				 */
				do_action( 'sacchaone_archive_title' );

				while ( have_posts() ) {
					the_post();

					dinjob_get_template_part( 'content', 'jobs' );
				}
			}
			dinjob_get_template_part( 'content', 'pagination' );
			?>
		</div>
		
		<?php
		if ( sacchaone_sidebar( 'right' ) ) {
			get_sidebar();
		}
		?>
		
	</div>

</main><!-- #site-content -->
<?php
get_footer();