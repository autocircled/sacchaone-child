<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

// @codingStandardsIgnoreStart
global $is_job_valid;
// Company name with link
$company_array = get_the_terms($post->ID, 'company');
if ($company_array) {
    $i = 0;
    foreach ($company_array as $company) {
        $company_url = get_term_link($company, 'company');
        $i++;
    }
}
// Job locations

$job_locations = get_the_terms($post->ID, 'location');

if ($job_locations) {
    $location_full = '';
    $j = count($job_locations) - 1;
    foreach ($job_locations as $location) {
        $location_link = get_term_link($location);
        $location_full .= '<a href="'. $location_link .'">' . $location->name . '</a>' . ($j > 0 ? ', ' : '');
        $j--;
    }
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" data-href="<?php echo esc_url(get_permalink()); ?>">
<?php
$entry_header_classes = '';

if (is_singular()) {
    $entry_header_classes .= ' header-footer-group';
}
$company_image = get_the_post_thumbnail_url(null, 'post-thumbnails');
?>

    <header class="entry-header has-text-align-center<?php echo esc_attr($entry_header_classes); ?>">

        <div class="entry-header-inner section-inner medium">
            <div class="job-header">
				<div class="lf">
				<?php

					the_title('<h1 class="entry-title heading-size-5">', '</h1>');

					if ($company_array) {
						echo '<a href="' . esc_url($company_url) . '">' . $company_array[0]->name . '</a>';
					}

					if ($job_locations) {
						echo '<p>' . $location_full . '</p>';
					}


				?>
				</div>
				<div class="rf">
					<?php 
					if ( $is_job_valid ) {
						do_action( 'dinjob_before_publish_date' );
						?>
						<p class="info">Published <?php echo dinjob_posted_on( get_the_ID() ); ?></p>
						<?php
						do_action( 'dinjob_after_publish_date' );
					} else {	
						?>
						<p class="warning">This job has been expired</p>
						<?php
					} ?>
					
				</div>
            </div><!-- .job-header -->
            <div class="clear"></div>
        </div><!-- .entry-header-inner -->

    </header><!-- .entry-header -->
   
	<?php
            if ( is_singular() || is_front_page()) {
                ?>
    <div class="post-inner thin">

        <div class="entry-content">

            <?php
                
                the_content();
                
                ?>
                <div class="content-footer-wrap">
					
                    <?php do_action( 'dinjob_before_apply_now_section' ); ?>
					
                    <div class="apply-now" id="apply-now">
                        <?php
						if ( $is_job_valid ) {
							$platform = get_field( 'platform' );
							if ($platform == 'other') {
								$button_text = 'Apply on company website';
							}else {
								$button_text = 'Apply with LinkedIn';
							}
							
							do_action( 'dinjob_before_apply_now' );
							?>
							<a href="<?php the_field('apply_now'); ?>" target="_blank" class="wp-block-button__link" rel="ugc nofollow noopener"><?php echo $button_text; ?></a>
						<?php
							do_action( 'dinjob_after_apply_now' );
						}else{
							?>
						<p class="warning">This job has been expired</p>
							<?php
						}
						?>
                    </div>
                </div>
            <?php
            // }
            ?>

        </div><!-- .entry-content -->

    </div><!-- .post-inner -->
    <?php } ?>

</article><!-- .post -->

