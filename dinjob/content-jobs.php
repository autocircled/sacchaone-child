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
$company_url = '';
if ($company_array) {
    $i = 0;
    foreach ($company_array as $company) {
        $company_url = get_term_link($company, 'company');
        $i++;
    }
}
// Job locations

$job_locations = get_the_terms($post->ID, 'location');
$location_full = '';
if ($job_locations) {
    
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


$company_image = get_the_post_thumbnail_url(null, 'post-thumbnails');
?>

    <header class="entry-header">

        <div class="entry-header-inner section-inner medium">
            <div class="job-header">
				<div class="lf">
					<?php the_title('<h2 class="entry-title heading-size-5"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
					<div class="title-meta">
						<?php
						if ( $company_array ) {
							echo '<a href="' . esc_url($company_url) . '">' . $company_array[0]->name . '</a>';
						}

						if ($job_locations) {
							echo '<p>' . $location_full . '</p>';
						}
						?>
					</div>
				</div>
				<div class="rf">
					<p class="info">Published <?php echo dinjob_posted_on( get_the_ID() ); ?></p>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="wp-block-button__link">Apply Now</a>
				</div>
            </div><!-- .job-header -->
            <div class="clear"></div>
        </div><!-- .entry-header-inner -->

    </header><!-- .entry-header -->

</article><!-- .post -->

