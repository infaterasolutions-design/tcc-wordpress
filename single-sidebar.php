<?php
/**
 * The template part for displaying a single post in the Wardrobe category.
 */

get_header(); 
?>

<div style="background-color: #fff; min-height: 100vh; padding-bottom: 4rem;">

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="sidebar-page-container">
		<main id="main" class="site-main article-container">
			<article id="post-<?php the_ID(); ?>" class="tiptap-content">
				<!-- Breadcrumb -->
				<div class="article-breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> &raquo; <?php echo get_the_category_list( ', ' ); ?>
				</div>

			<!-- Title & Header -->
			<header class="entry-header">
			<h1 class="entry-title article-title"><?php the_title(); ?></h1>

			<!-- Meta -->
			<div class="article-meta">
				<?php get_template_part( 'template-parts/author-hover' ); ?> | <?php echo get_the_date(); ?>
			</div>

			<!-- Intro (Using Excerpt if it exists, otherwise omit) -->
			<?php if ( has_excerpt() ) : ?>
				<p class="article-intro"><?php echo get_the_excerpt(); ?></p>
			<?php endif; ?>

			<!-- Hero Image -->
			<?php 
			$thumbnail_id = get_post_thumbnail_id();
			$content = get_the_content();
			// Check if the image block with this ID is present in the post content
			$is_in_content = $thumbnail_id && strpos( $content, 'wp-image-' . $thumbnail_id ) !== false;
			
			if ( has_post_thumbnail() ) : 
				if ( ! $is_in_content ) :
			?>
				<div style="margin-bottom: 48px;">
					<?php the_post_thumbnail( 'full', array( 'class' => 'article-hero-image', 'style' => 'margin-bottom: 0;', 'fetchpriority' => 'high', 'loading' => false ) ); ?>
					<?php $caption = get_the_post_thumbnail_caption(); ?>
					<?php if ( $caption ) : ?>
						<p class="text-sans" style="text-align: center; font-size: 0.85rem; color: #666; margin-top: 0.8rem; font-style: italic;">
							<?php echo esc_html( $caption ); ?>
						</p>
					<?php endif; ?>
				</div>
				<?php endif; // End check for is_in_content ?>
			<?php endif; ?>
			</header>

				<!-- Article Body -->
				<div id="content" class="entry-content post-content content article-body">
					<?php the_content(); ?>
				</div>
			</article>
			
			<!-- INTERNAL LINKING FOR SEO (Forces Google to crawl unindexed pages) -->
			<?php
			$related_args = array(
				'category__in'   => wp_get_post_categories( get_queried_object_id() ),
				'posts_per_page' => 3,
				'post__not_in'   => array( get_queried_object_id() ),
				'orderby'        => 'rand' // Random ensures all 139 hidden posts eventually get front-page exposure to Googlebot
			);
			$related_query = new WP_Query( $related_args );
			if ( $related_query->have_posts() ) :
			?>
			<div class="tcc-related-posts" style="margin: 60px 0; border-top: 1px solid #eaeaea; padding-top: 40px;">
				<h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 30px; text-align: center;">You Might Also Love</h3>
				<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: block; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
							<?php if ( has_post_thumbnail() ) : ?>
								<div style="width: 100%; aspect-ratio: 4/5; overflow: hidden; border-radius: 8px; margin-bottom: 16px;">
									<?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
								</div>
							<?php endif; ?>
							<h4 style="font-family: 'Playfair Display', serif; font-size: 18px; line-height: 1.3; margin: 0 0 8px;"><?php the_title(); ?></h4>
							<span style="font-family: 'Inter', sans-serif; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px;"><?php echo get_the_date(); ?></span>
						</a>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php 
			// Include the beautiful comments template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		</main>

		<!-- Sidebar -->
		<aside id="secondary" class="sidebar sidebar-container widget-area" role="complementary">
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="primary-sidebar-widgets">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			<?php endif; ?>


			<div style="background-color: #C5DAD4; padding: 2rem; text-align: center; margin-bottom: 2rem;">
				<h3 class="text-sans" style="font-size: 1.2rem; text-transform: uppercase; margin-bottom: 1rem; margin-top: 0;">Join the Newsletter</h3>
				<p class="text-sans" style="font-size: 0.9rem; margin-bottom: 1rem;">Get weekly decluttering tips straight to your inbox.</p>
				<input type="email" placeholder="Email Address" style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; border: 1px solid #48647E;" />
				<button style="width: 100%; padding: 0.8rem; background-color: #F3B41B; border: none; font-weight: bold; cursor: pointer; color: #2C2C2C;">SUBSCRIBE</button>
			</div>

			<div style="padding: 1rem 0; width: 100%; max-width: 290px; margin: 0 auto;">
				<h3 style="font-family: 'Playfair Display', serif; font-size: 30px; margin-bottom: 1.5rem; margin-top: 0; text-align: center; font-weight: 400;">Popular Posts</h3>
				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
					<?php
					// Query popular posts
					$popular = new WP_Query( array(
						'post_type'      => 'post',
						'posts_per_page' => 4,
						'orderby'        => 'comment_count',
						'post__not_in'   => array( get_the_ID() )
					) );
					if ( $popular->have_posts() ) :
						while ( $popular->have_posts() ) : $popular->the_post();
					?>
					<a href="<?php the_permalink(); ?>" style="display: flex; flex-direction: column; text-decoration: none; align-items: center;">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'medium', array( 'style' => 'width: 100%; aspect-ratio: 3/4; object-fit: cover; margin-bottom: 10px;' ) ); ?>
						<?php else : ?>
							<?php 
								$dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=400'; 
								echo tcc_get_picture_tag($dummy_img, 'Featured', '', 'width: 100%; aspect-ratio: 3/4; object-fit: cover; margin-bottom: 10px;');
							?>
						<?php endif; ?>
						<h4 class="text-sans" style="font-size: 18px; font-weight: 500; color: #2C2C2C; line-height: 24px; margin: 0; text-align: center; text-transform: capitalize;">
							<?php echo wp_trim_words( get_the_title(), 5 ); ?>
						</h4>
					</a>
					<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</aside>
	</div>

	<?php endwhile; ?>
</div>

<?php get_footer(); ?>


