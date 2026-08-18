<?php
/**
 * The main template file / Blog / Archive
 */

get_header(); 

$is_blog_home = is_home();
$cat_title = $is_blog_home ? single_post_title('', false) : single_term_title('', false);
if ( empty($cat_title) ) {
	$cat_title = 'Blog';
}
global $wp_query;

// We need the first 3 posts for the top grid, and the rest for the bottom grid.
// But we should do this within the standard loop if possible, or just use a counter.
?>

<main style="background-color: #fff; min-height: 100vh; display: flex; flex-direction: column; align-items: center;; width: 100%; max-width: 100vw; overflow-x: hidden;">
	<div class="archive-container">
		
		<?php if ( have_posts() ) : ?>
			
			<!-- TOP SECTION: 3 FEATURED POSTS -->
			<div class="top-grid">
				<?php 
				$post_counter = 0;
				while ( have_posts() && $post_counter < 3 ) : the_post(); 
					$post_counter++;
				?>
					<a href="<?php the_permalink(); ?>" style="text-decoration: none;">
						<div class="top-card group">
							<div class="top-card-image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;', 'class' => 'hover-scale' ) ); ?>
								<?php else : ?>
									<?php $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=600'; echo tcc_get_picture_tag($dummy_img, 'Placeholder', 'hover-scale', 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;'); ?>
								<?php endif; ?>
								
<div class="recent-hover-overlay">
	<span class="recent-hover-text">VIEW THE POST</span>
	<svg class="recent-hover-arrow" viewBox="0 0 100 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5 12 Q 30 9 60 14 T 95 12 M 95 12 L 80 4 M 95 12 L 82 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</div>
<style>
									.top-card:hover .hover-scale { transform: scale(1.05); }
								</style>
							</div>
							<div class="top-card-overlay">
								<div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
									<span style="font-size: 9px; font-weight: 900; font-family: sans-serif;">&rarr;</span>
									<span style="font-family: 'Inter', sans-serif; font-size: 9px; letter-spacing: 1.51px; color: #000; text-transform: uppercase;">
										<?php echo get_the_date(); ?>
									</span>
								</div>
								<h2 class="text-serif" style="font-size: 20px; line-height: 25px; letter-spacing: 0.17px; color: #000; margin: 0;">
									<?php the_title(); ?>
								</h2>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
			</div>

			<!-- MIDDLE SECTION: TITLE & TABS -->
			<div class="middle-section">
				<h1 class="script-title">
					<?php echo esc_html( strtolower( $cat_title ) ); ?>
				</h1>
				<div class="filter-tags">
					<button class="filter-tag active">ALL</button>
					<button class="filter-tag">OUTFITS</button>
					<button class="filter-tag">STYLE TIPS</button>
					<button class="filter-tag">SEASONAL</button>
				</div>
			</div>

			<!-- BOTTOM SECTION: 4 COLUMN GRID -->
			<?php if ( have_posts() ) : ?>
				<div class="bottom-grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<a href="<?php the_permalink(); ?>" style="text-decoration: none;">
							<div class="bottom-card group">
								<div class="bottom-card-image">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;', 'class' => 'hover-scale' ) ); ?>
									<?php else : ?>
										<?php $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=600'; echo tcc_get_picture_tag($dummy_img, 'Placeholder', 'hover-scale', 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;'); ?>
									<?php endif; ?>
									
<div class="recent-hover-overlay">
	<span class="recent-hover-text">VIEW THE POST</span>
	<svg class="recent-hover-arrow" viewBox="0 0 100 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5 12 Q 30 9 60 14 T 95 12 M 95 12 L 80 4 M 95 12 L 82 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</div>
<style>
										.bottom-card:hover .hover-scale { transform: scale(1.05); }
									</style>
								</div>
								<div>
									<span style="font-family: 'Inter', sans-serif; font-size: 9px; letter-spacing: 1.51px; color: #605C5C; text-transform: uppercase; display: block; margin-bottom: 8px;">
										<?php echo get_the_date(); ?>
									</span>
									<h2 class="text-serif" style="font-size: 20px; line-height: 25px; letter-spacing: 0.17px; color: #000; margin: 0;">
										<?php the_title(); ?>
									</h2>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<!-- LOAD MORE BUTTON -->
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div style="display: flex; align-items: center; justify-content: center; margin-bottom: 80px;">
					<button class="load-more-btn" id="tcc-load-more" data-page="1" data-max="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-category="<?php echo esc_attr( $is_blog_home ? '' : single_cat_title('', false) ); ?>">
						LOAD MORE
						<div class="load-more-line"></div>
					</button>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<div style="text-align: center; padding: 40px 0 80px; color: #888;">
				No posts found.
			</div>
		<?php endif; ?>

		<!-- Elsewhere Section -->
		<section class="fp-elsewhere-section" style="margin-top: 4rem; margin-bottom: 4rem;">
			<div class="fp-elsewhere-container">
				
				<!-- Column 1 -->
				<a href="#" class="fp-elsewhere-col1">
					<?php $img1 = "https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?auto=format&fit=crop&q=80&w=400"; ?>
					<picture class="w-full">
						<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img1)); ?>" type="image/avif">
						<img src="<?php echo esc_url($img1); ?>" alt="Clothes rack" loading="lazy" />
					</picture>
				</a>

				<div class="fp-elsewhere-text">elsewhere</div>
				
				<!-- Column 2 -->
				<div class="fp-elsewhere-col2">
					<a href="#" class="fp-elsewhere-col2-img-wrapper">
						<?php $img2 = "https://images.unsplash.com/photo-1617019114583-affb34d1b3cd?auto=format&fit=crop&q=80&w=400"; ?>
						<picture class="w-full">
							<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img2)); ?>" type="image/avif">
							<img src="<?php echo esc_url($img2); ?>" alt="Striped sweater" loading="lazy" />
						</picture>
					</a>
				</div>

				<!-- Column 3 -->
				<div class="fp-elsewhere-col3">
					<a href="#" class="fp-elsewhere-col3-inner">
						<?php $img3 = "https://images.unsplash.com/photo-1509319117193-57bab727e09d?auto=format&fit=crop&q=80&w=400"; ?>
						<picture class="w-full">
							<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img3)); ?>" type="image/avif">
							<img src="<?php echo esc_url($img3); ?>" alt="Bag and drink" loading="lazy" />
						</picture>
					</a>
					<a href="https://instagram.com/THECOMBOCLOSET" class="fp-elsewhere-handle" target="_blank">@THECOMBOCLOSET</a>
				</div>

				<!-- Column 4 -->
				<a href="#" class="fp-elsewhere-col4">
					<?php $img4 = "https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=400"; ?>
					<picture class="w-full">
						<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img4)); ?>" type="image/avif">
						<img src="<?php echo esc_url($img4); ?>" alt="Woman walking" loading="lazy" />
					</picture>
				</a>

			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>

