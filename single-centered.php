<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<main style="background-color: #faf9f6; min-height: 100vh; padding-bottom: 4rem;">

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- ARTICLE HEADER -->
		<header style="max-width: 1240px; margin: 0 auto; padding: 4rem 2rem 2rem;">
			<!-- Breadcrumb -->
			<div style="font-family: 'Inter', sans-serif; font-size: 0.65rem; font-weight: bold; letter-spacing: 0.1em; text-transform: uppercase; color: #888; margin-bottom: 1.5rem; text-align: center;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #888; text-decoration: none;">HOME</a> / POST / <?php echo esc_html( strtoupper( get_the_title() ) ); ?>
			</div>

			<!-- Title -->
			<h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; line-height: 1.1; color: #000; text-align: center; margin-bottom: 1.5rem;">
				<?php the_title(); ?>
			</h1>

			<!-- Meta Info -->
			<div style="font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; gap: 1rem; font-size: 0.75rem; color: #666; letter-spacing: 0.05em; text-transform: uppercase;">
				<span>By <?php the_author(); ?></span>
				<span>&middot;</span>
				<span><?php echo get_the_date(); ?></span>
				<span>&middot;</span>
				<span><?php echo strip_tags( get_the_category_list( ', ' ) ); ?></span>
			</div>
		</header>

		<!-- FEATURED IMAGE -->
		<div style="max-width: 1240px; margin: 0 auto 4rem; padding: 0 2rem;">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
				<?php $caption = get_the_post_thumbnail_caption(); ?>
				<?php if ( $caption ) : ?>
					<p style="font-family: 'Inter', sans-serif; text-align: center; font-size: 0.85rem; color: #666; margin-top: 0.8rem; font-style: italic;">
						<?php echo esc_html( $caption ); ?>
					</p>
				<?php endif; ?>
			<?php else : ?>
					<?php 
						$dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=1200'; 
						echo tcc_get_picture_tag($dummy_img, 'Featured', '', 'width: 100%; height: auto; display: block;');
					?>
			<?php endif; ?>
		</div>

		<!-- ARTICLE BODY -->
		<article class="article-content" style="max-width: 1240px; margin: 0 auto; padding: 0 2rem;">
			<?php the_content(); ?>

			<!-- Tags & Share -->
			<div style="margin-top: 4rem; padding-bottom: 2rem; border-bottom: 1px solid #d4cfc3; display: flex; justify-content: space-between; align-items: center;">
				<div style="font-family: 'Inter', sans-serif; display: flex; gap: 0.5rem; font-size: 0.7rem; font-weight: bold; letter-spacing: 0.1em; text-transform: uppercase;">
					<span style="color: #888;">TAGS:</span>
					<?php 
					$tags = get_the_tags();
					if ( $tags ) {
						foreach ( $tags as $tag ) {
							echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" style="color: inherit; text-decoration: none;">' . esc_html( $tag->name ) . '</a> ';
						}
					}
					?>
				</div>
				<div style="font-family: 'Inter', sans-serif; display: flex; gap: 1rem; font-size: 0.7rem; font-weight: bold; letter-spacing: 0.1em; text-transform: uppercase;">
					<span style="cursor: pointer;">SHARE</span>
					<span style="cursor: pointer;">PIN IT</span>
				</div>
			</div>
		</article>

		<!-- RELATED POSTS SECTION -->
		<div style="max-width: 1240px; margin: 4rem auto 0; padding: 0 2rem;">
			<h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 800; text-align: center; margin-bottom: 3rem;">
				You Might Also Like
			</h2>
			<div class="related-grid">
				<?php
				$categories = get_the_category();
				if ( $categories ) {
					$category_ids = array();
					foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
					$args = array(
						'category__in'     => $category_ids,
						'post__not_in'     => array( $post->ID ),
						'posts_per_page'   => 3,
						'ignore_sticky_posts' => 1
					);
					$my_query = new wp_query( $args );
					if ( $my_query->have_posts() ) {
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							?>
							<div style="display: flex; flex-direction: column; width: 100%;">
								<div style="width: 100%; padding-bottom: 125%; margin-bottom: 1rem; background-color: #e5e5e5; position: relative; overflow: hidden;" class="post-card-img-container">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'large', array( 'class' => 'post-card-img', 'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;' ) ); ?>
									<?php else : ?>
										<?php echo tcc_get_picture_tag('https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400', 'Placeholder', 'post-card-img', 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;'); ?>
									<?php endif; ?>
								</div>
								<span style="font-family: 'Inter', sans-serif; text-transform: uppercase; font-size: 0.65rem; font-weight: bold; color: #888; letter-spacing: 0.1em; margin-bottom: 0.4rem; display: block;">
									<?php $cat = get_the_category(); if($cat) echo esc_html($cat[0]->name); ?>
								</span>
								<h4 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 800; line-height: 1.3; color: #000; margin: 0;">
									<a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
								</h4>
								<span style="font-family: 'Inter', sans-serif; font-size: 0.6rem; color: #888; letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.5rem; display: block;">
									<?php echo get_the_date(); ?>
								</span>
							</div>
							<?php
						}
					}
					wp_reset_query();
				}
				?>
			</div>
		</div>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>

