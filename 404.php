<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 100px 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 60vh; text-align: center;">

	<section class="error-404 not-found" style="max-width: 600px; width: 100%;">
		<header class="page-header" style="margin-bottom: 2rem;">
			<h1 class="page-title" style="font-family: 'Playfair Display', serif; font-size: 8rem; font-weight: 400; line-height: 1; color: #000; margin: 0 0 1rem 0;">404</h1>
			<h2 style="font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 500; color: #333; margin: 0 0 1.5rem 0; letter-spacing: -0.02em;">Oops! That page can&rsquo;t be found.</h2>
			<div style="width: 40px; height: 1px; background-color: #000; margin: 0 auto 1.5rem auto;"></div>
			<p style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #666; margin: 0 0 2.5rem 0;">It looks like nothing was found at this location. It might have been removed, renamed, or did not exist in the first place.</p>
		</header><!-- .page-header -->

		<div class="page-content">
			<div style="margin-bottom: 3rem;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: inline-block; background-color: #000; color: #fff; text-decoration: none; padding: 1rem 2rem; font-family: 'Inter', sans-serif; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; transition: opacity 0.3s ease;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
					Return to Homepage
				</a>
			</div>
			
			<div class="search-form-container" style="max-width: 400px; margin: 0 auto;">
				<p style="font-family: 'Inter', sans-serif; font-size: 0.9rem; color: #888; margin-bottom: 1rem;">Or try searching for what you need:</p>
				<?php get_search_form(); ?>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #primary -->

<?php
get_footer();
