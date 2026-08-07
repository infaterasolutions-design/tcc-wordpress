<?php
/**
 * The template for displaying standard WordPress pages (e.g. About Us, Privacy Policy)
 */

get_header(); ?>

<main id="main" class="site-main" style="background-color: #faf9f6; min-height: 100vh; padding-bottom: 4rem; padding-top: 4rem;">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="centered-post-content" <?php post_class(); ?>>
			
			<!-- PAGE HEADER -->
			<header class="centered-post-header">
				<!-- Title -->
				<h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; line-height: 1.1; color: #000; text-align: center; margin-bottom: 3rem;">
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
