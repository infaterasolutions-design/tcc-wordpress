<?php
/**
 * The template for displaying author archive pages
 */

get_header();

$author = get_queried_object();

// Fallback if WordPress returns null (e.g. author has 0 posts)
if ( ! $author || ! isset($author->ID) ) {
    $author_name = get_query_var('author_name');
    if ( $author_name ) {
        $author = get_user_by( 'slug', $author_name );
    } else {
        $author = get_userdata( get_query_var('author') );
    }
}

$author_id = $author ? $author->ID : 0;
$author_name = $author ? esc_html( $author->display_name ) : 'Author';
$author_bio = $author_id ? wp_kses_post( get_the_author_meta( 'description', $author_id ) ) : '';
$author_avatar = $author_id ? get_avatar( $author_id, 150, '', $author_name, array( 'class' => 'author-page-avatar' ) ) : '';
?>

<main style="background-color: #fff; min-height: 100vh; display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 100vw; overflow-x: hidden;">

	<div class="archive-container">
		
		<!-- Author Header Info -->
		<div style="text-align: center; margin: 80px auto 60px; max-width: 600px;">
			<div style="margin-bottom: 24px; display: flex; justify-content: center;">
				<?php echo $author_avatar; ?>
			</div>
			<h1 class="text-serif" style="font-family: 'Playfair Display', serif; font-size: 42px; margin-bottom: 20px; color: #2C2C2C;">
				<?php echo $author_name; ?>
			</h1>
			<?php if ( $author_bio ) : ?>
				<p class="text-sans" style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 1.8; color: #4A4A4A;">
					<?php echo $author_bio; ?>
				</p>
			<?php endif; ?>
		</div>

		<!-- Separator -->
		<div style="width: 100%; height: 1px; background-color: #EAEAEA; margin-bottom: 60px;"></div>

		<!-- Posts Grid -->
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
							</div>
							<div style="margin-top: 15px;">
								<span style="font-family: 'Inter', sans-serif; font-size: 10px; letter-spacing: 1.5px; color: #605C5C; text-transform: uppercase; display: block; margin-bottom: 8px;">
									<?php echo get_the_date(); ?>
								</span>
								<h2 class="text-serif" style="font-family: 'Playfair Display', serif; font-size: 22px; line-height: 1.3; color: #000; margin: 0;">
									<?php the_title(); ?>
								</h2>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
			</div>
			
			<!-- Pagination -->
			<div style="margin: 60px 0 80px; text-align: center;">
				<?php the_posts_pagination( array(
					'prev_text' => '&laquo; Previous',
					'next_text' => 'Next &raquo;',
				) ); ?>
			</div>

		<?php else : ?>
			<div style="text-align: center; padding: 40px 0 80px; color: #888;">
				No articles found for this author yet.
			</div>
		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
