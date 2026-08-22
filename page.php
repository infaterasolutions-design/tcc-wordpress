<?php
/**
 * The template for displaying standard WordPress pages (e.g. About Us, Privacy Policy)
 */

get_header(); ?>

<?php
$is_reduced_gap_page = is_page( array( 'about-us', 'disclaimer', 'privacy-policy-affiliate-disclosure', 'terms-and-conditions' ) );
$padding_top = $is_reduced_gap_page ? '0' : '4rem';
$title_margin_bottom = $is_reduced_gap_page ? '1rem' : '3rem';
?>

<main id="main" class="site-main" style="background-color: #faf9f6; min-height: 100vh; padding-bottom: 4rem; padding-top: <?php echo $padding_top; ?>;">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="centered-post-content" <?php post_class(); ?>>
			
			<!-- PAGE HEADER -->
			<header class="centered-post-header">
				<!-- Title -->
				<h1 class="centered-post-title article-title" style="margin-top: 0; margin-bottom: <?php echo $title_margin_bottom; ?>;">
					<?php the_title(); ?>
				</h1>
			</header>

			<!-- FEATURED IMAGE (Optional for pages) -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="centered-post-image" style="margin-bottom: 3rem;">
					<?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
				</div>
			<?php endif; ?>

			<!-- PAGE BODY -->
			<div id="content" class="entry-content post-content content article-content" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>
