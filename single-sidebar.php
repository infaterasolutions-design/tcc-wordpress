<?php
/**
 * The template part for displaying a single post in the Wardrobe category.
 */

get_header(); 
?>

<div style="background-color: #fff; min-height: 100vh; padding-bottom: 4rem;">

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="sidebar-page-container">
		<div class="article-container">
			<!-- Breadcrumb -->
			<div class="article-breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> &raquo; <?php echo get_the_category_list( ', ' ); ?>
			</div>

			<!-- Title -->
			<h1 class="article-title"><?php the_title(); ?></h1>

			<!-- Meta -->
			<div class="article-meta">
				By <?php the_author(); ?> | <?php echo get_the_date(); ?>
			</div>

			<!-- Intro (Using Excerpt if it exists, otherwise omit) -->
			<?php if ( has_excerpt() ) : ?>
				<p class="article-intro"><?php echo get_the_excerpt(); ?></p>
			<?php endif; ?>

			<!-- Hero Image -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div style="margin-bottom: 48px;">
					<?php the_post_thumbnail( 'full', array( 'class' => 'article-hero-image', 'style' => 'margin-bottom: 0;' ) ); ?>
					<?php $caption = get_the_post_thumbnail_caption(); ?>
					<?php if ( $caption ) : ?>
						<p class="text-sans" style="text-align: center; font-size: 0.85rem; color: #666; margin-top: 0.8rem; font-style: italic;">
							<?php echo esc_html( $caption ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<!-- Fallback dummy image for wardrobe -->
				<div style="margin-bottom: 48px;">
					<?php 
						$dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=1200'; 
						echo tcc_get_picture_tag($dummy_img, 'Featured', 'article-hero-image', 'margin-bottom: 0;');
					?>
				</div>
			<?php endif; ?>

			<!-- Article Body -->
			<article class="article-body tiptap-content">
				<?php the_content(); ?>
			</article>
		</div>

		<!-- Sidebar -->
		<aside class="sidebar-container">
			<div style="background-color: #FAF6EE; padding: 24px; margin-bottom: 2rem; display: flex; flex-direction: column; align-items: center;">
				<?php echo tcc_get_picture_tag('https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=300', 'Elle Penner', '', 'width: 100%; aspect-ratio: 1/1; object-fit: cover; margin-bottom: 20px;'); ?>
				<h3 style="font-family: 'Playfair Display', serif; font-size: 30px; margin: 0 0 16px 0; text-align: center; font-weight: 400; color: #2C2C2C;">Hey there, I’m Elle.</h3>
				<p style="font-family: 'Inter', sans-serif; font-size: 20px; line-height: 32px; color: #2C2C2C; text-align: center; margin: 0 0 24px 0;">
					Simplifying and organizing expert, dietitian, and mom of two. I'm here to help you declutter your home so you have more time and energy for the things that truly matter.
				</p>
				<a href="#" style="display: inline-flex; justify-content: center; align-items: center; padding: 7px 18px; background-color: #FFFFFF; border: 1.6px solid #EC9277; text-decoration: none; color: #2C2C2C;">
					<span class="text-sans" style="font-size: 18px; font-weight: 400; text-transform: uppercase;">About Me</span>
				</a>
			</div>
			
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


