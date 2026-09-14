<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<main id="main" class="site-main" style="background-color: #ffffff; min-height: 100vh; padding-bottom: 4rem;">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="centered-post-content">
			<!-- ARTICLE HEADER -->
			<header class="centered-post-header">
			<!-- Breadcrumb -->
			<div class="centered-post-breadcrumb" style="font-family: 'Inter', sans-serif; font-size: 0.65rem; font-weight: bold; letter-spacing: 0.1em; text-transform: uppercase; color: #888; margin-bottom: 1.5rem;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #888; text-decoration: none;">HOME</a> / POST / <?php echo esc_html( strtoupper( get_the_title() ) ); ?>
			</div>

			<!-- Title -->
			<h1 class="centered-post-title article-title" style="margin-top: 0; margin-bottom: 1.5rem;">
				<?php the_title(); ?>
			</h1>

			<!-- Meta Info -->
			<div class="centered-post-meta" style="font-family: 'Inter', sans-serif; display: flex; align-items: center; gap: 1rem; font-size: 0.75rem; color: #666; letter-spacing: 0.05em; text-transform: uppercase; flex-wrap: wrap;">
				<span><?php get_template_part( 'template-parts/author-hover' ); ?></span>
				<span><?php echo get_the_date(); ?></span>
				<span><?php echo strip_tags( get_the_category_list( ', ' ) ); ?></span>
			</div>
		</header>

		<!-- FEATURED IMAGE -->
		<?php 
		$thumbnail_id = get_post_thumbnail_id();
		$content = get_the_content();
		
		$is_in_content = false;
		if ( $thumbnail_id ) {
		    // 1. Check for Gutenberg block class (original method)
		    if ( strpos( $content, 'wp-image-' . $thumbnail_id ) !== false ) {
		        $is_in_content = true;
		    } else {
		        // 2. Smarter fallback: Check if the actual image filename exists in the post content
		        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		        if ( $thumbnail_url ) {
		            $filename = basename( parse_url( $thumbnail_url, PHP_URL_PATH ) );
		            // Strip WordPress size suffixes (e.g., -1024x768) just in case
		            $base_filename = preg_replace('/-\d+x\d+(?=\.[a-z]+$)/i', '', $filename);
		            if ( !empty($base_filename) && strpos( $content, $base_filename ) !== false ) {
		                $is_in_content = true;
		            }
		        }
		    }
		}
		
		if ( has_post_thumbnail() ) : 
			if ( ! $is_in_content ) :
		?>
		<div class="centered-post-image">
				<?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
				<?php $caption = get_the_post_thumbnail_caption(); ?>
				<?php if ( $caption ) : ?>
					<p style="font-family: 'Inter', sans-serif; text-align: center; font-size: 0.85rem; color: #666; margin-top: 0.8rem; font-style: italic;">
						<?php echo esc_html( $caption ); ?>
					</p>
				<?php endif; ?>
		</div>
		<?php endif; // End check for is_in_content ?>
		<?php endif; ?>

		<!-- ARTICLE BODY -->
		<div id="content" class="entry-content post-content content article-content">
				<?php the_content(); ?>
			</div>

			<!-- Separation Line (Tags & Share Hidden) -->
			<div style="margin-top: 4rem; padding-bottom: 2rem; border-bottom: 1px solid #d4cfc3;"></div>
			</div>
		</article>

		<!-- RELATED POSTS SECTION -->
		<div style="max-width: 1240px; margin: 2rem auto 6rem; padding: 0 2rem;">
			<h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 800; text-align: center; margin-bottom: 3rem; font-variant-numeric: lining-nums; font-feature-settings: 'lnum' 1;">
				You Might Also Like
			</h2>
			<div class="related-grid">
				<?php
				$categories = get_the_category();
				if ( $categories ) {
					$category_ids = array();
					foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
					
					$transient_key = 'tcc_centered_related_' . $post->ID;
					$related_post_ids = get_transient( $transient_key );
					
					if ( false === $related_post_ids ) {
						$args = array(
							'category__in'     => $category_ids,
							'post__not_in'     => array( $post->ID ),
							'posts_per_page'   => 3,
							'ignore_sticky_posts' => 1,
							'no_found_rows'    => true,
							'fields'           => 'ids'
						);
						$fetch_query = new WP_Query( $args );
						$related_post_ids = $fetch_query->posts;
						set_transient( $transient_key, $related_post_ids, 4 * HOUR_IN_SECONDS );
					}
					
					if ( ! empty( $related_post_ids ) ) {
						$my_query = new WP_Query( array(
							'post__in'       => $related_post_ids,
							'orderby'        => 'post__in',
							'posts_per_page' => 3,
							'no_found_rows'  => true
						) );
						
						if ( $my_query->have_posts() ) {
							while ( $my_query->have_posts() ) {
								$my_query->the_post();
								?>
							<a href="<?php the_permalink(); ?>" style="display: flex; flex-direction: column; width: 100%; text-decoration: none; color: inherit;">
								<div style="width: 100%; padding-bottom: 125%; margin-bottom: 1rem; background-color: #e5e5e5; position: relative; overflow: hidden;" class="post-card-img-container">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'large', array( 'class' => 'post-card-img', 'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;' ) ); ?>
									<?php else : ?>
										<?php echo tcc_get_picture_tag(tcc_get_fallback_image(get_the_ID()), 'Placeholder', 'post-card-img', 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;'); ?>
									<?php endif; ?>
								</div>
								<span style="font-family: 'Inter', sans-serif; text-transform: uppercase; font-size: 0.65rem; font-weight: bold; color: #888; letter-spacing: 0.1em; margin-bottom: 0.4rem; display: block;">
									<?php $cat = get_the_category(); if($cat) echo esc_html($cat[0]->name); ?>
								</span>
								<h4 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 800; line-height: 1.3; color: #000; margin: 0; font-variant-numeric: lining-nums; font-feature-settings: 'lnum' 1;">
									<?php the_title(); ?>
								</h4>
								<span style="font-family: 'Inter', sans-serif; font-size: 0.6rem; color: #888; letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.5rem; display: block;">
									<?php echo get_the_date(); ?>
								</span>
							</a>
							<?php
						} // End while
					} // End if have_posts
					wp_reset_postdata();
				} // End if !empty related_post_ids
				} // End if categories
				?>
			</div>
		</div>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>

