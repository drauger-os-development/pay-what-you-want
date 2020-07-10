<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * Template Name:paywhatyouwant
 * @package <ADD YOUR WORDPRESS THEME PACKAGE NAME HERE>
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="singular-content-wrap">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content/content', 'page' );

					get_template_part( 'template-parts/content/content', 'comment' );

				endwhile; // End of the loop.
				?>
			</div>	<!-- .singular-content-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->
// Begin pay what you want script

<?php function getValue() {
    var str = $("#amount").val();
    str = str.replace(/[^0-9.,]/g, "");
    var val = parseFloat(str.replace(",", "."));
    return (isNaN(val) || val < 0) ? 0 : val;
}
 
$("#amount").on('change blur keyup', function() {
    $("#ppamount").val(getValue().toFixed(2));
});
 
$("#paypal_form").submit(function(event) {
    var val = getValue();
    var msg = 'A payment is optional. If you see this, an error has occured. ' +
        'If you wish to download the ISO, select ok and you will not be charged. ' +
        'If you need to change the amount, select cancel.';
    if (val < 0.00) {
        event.preventDefault();
        if (val == 0 || confirm(msg)) {
            window.location = "DOWNLOAD_LINK";
        }
    }
}); ?>

// End pay what you want script
<?php get_sidebar(); ?>
<?php
get_footer();
