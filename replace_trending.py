import re

with open("C:/Users/sande/Local Sites/tcc/app/public/wp-content/themes/tcc-theme/front-page.php", "r", encoding="utf-8") as f:
    content = f.read()

new_html = """	<!-- The Latest Section -->
	<section class="fp-the-latest-section">
		<div class="fp-latest-header">
			<h2 class="fp-latest-title">THE LATEST</h2>
		</div>
		<div class="fp-latest-content">
			<div class="fp-latest-grid">
				<?php
				$latest_args = array(
					'post_type'      => 'post',
					'posts_per_page' => 4,
				);
				$latest_query = new WP_Query( $latest_args );
				if ( $latest_query->have_posts() ) :
					while ( $latest_query->have_posts() ) : $latest_query->the_post();
				?>
					<a href="<?php the_permalink(); ?>" class="fp-latest-card">
						<div class="fp-latest-card-img-wrapper">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large' ); ?>
							<?php else : ?>
								<?php $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400'; ?>
								<picture>
									<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $dummy_img)); ?>" type="image/avif">
									<img src="<?php echo esc_url($dummy_img); ?>" alt="Placeholder" />
								</picture>
							<?php endif; ?>
						</div>
						<div class="fp-latest-meta">
							<span class="fp-latest-category"><?php $category = get_the_category(); if($category) echo esc_html($category[0]->name); ?></span>
							<span class="fp-latest-date"><?php echo get_the_date('F j, Y'); ?></span>
						</div>
						<h3 class="fp-latest-post-title"><?php the_title(); ?></h3>
					</a>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="fp-latest-view-more">VIEW MORE POSTS &rarr;</a>
		</div>
	</section>"""

# Find the block between <!-- Trending Section --> and </section> before <!-- Recent Posts Section -->
pattern = re.compile(r'<!-- Trending Section -->\s*<!-- Trending Section -->\s*<section class="figma-trending-container container">.*?</section>', re.DOTALL)
new_content = pattern.sub(new_html, content)

with open("C:/Users/sande/Local Sites/tcc/app/public/wp-content/themes/tcc-theme/front-page.php", "w", encoding="utf-8") as f:
    f.write(new_content)

print("Done replacing.")
