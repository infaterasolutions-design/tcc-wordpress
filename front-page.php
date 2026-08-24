<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>

<main class="fp-hero-main">

	<!-- Stitch Hero Section (Desktop & Mobile) -->
	<section class="figma-hero-section">
		<!-- Desktop Hero Layout -->
		<div class="figma-hero-desktop hidden-mobile">
			<!-- Header Row -->
			<div class="figma-hero-header">
				<div class="figma-hero-learn">
					<svg class="figma-hero-circle-text" viewBox="0 0 100 100">
						<path d="M 50, 50 m -35, 0 a 35,35 0 1,1 70,0 a 35,35 0 1,1 -70,0" fill="transparent" id="circlePath"></path>
						<text><textPath href="#circlePath" startOffset="0%">Learn about us through this video • </textPath></text>
					</svg>
					<button class="figma-hero-play-btn">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
					</button>
				</div>
				
				<h1 class="figma-hero-title">Elevate Your Style With<br/>Bold Fashion</h1>
				
				<div class="figma-hero-avatars">
					<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIeI-EV9B-4xqLmLRw95kbGlDMVUZthDXPv76_lsjH7CsYlSXrNumuGE2N_tH6AFJgQOLVPQT7ebfarLyqPYim2ji6oWMLpRPmhtE8reXtTmjZvszAWbwBJ3yKQT0g8JYYtDq5lsR1mDkyjU01v2aqnopBWblTTPuSy-ZRdpRmfR5Sk5ihVyriNy-1JWT2aVrPuvkBwA0Z58p1mGNFkE7WAKnVjFSldQdnN_GWQfSpj-U9TWQEkJPO" alt="Avatar 1">
					<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmDY-phvVvk9ycBHRnK4yq4riNd1yV7i2IYOmLwibNKVpIR4dnv3BpCCy3COKLOmqIjsB0Jnu8CdE64yLd-XQmb0hvG9HvfMK60ltxAdKoS3ZA3322Spk9qAS1foRcErQsRQcNEizr_A-5foo5PQP5bqEi78b-hfflQLu8VopPMTkOcqb9BW09O9PQorznflJW0eLnM0DIDd5OHrQmsG_aaD1AzXepfPH_W14Gnk1pyeJ4rNHv4JMz" alt="Avatar 2">
					<div class="figma-hero-avatar-more">+</div>
				</div>
			</div>

			<!-- Masonry Grid Row -->
			<div class="figma-hero-grid">
				<!-- Column 1 -->
				<div class="figma-grid-col col-1">
					<div class="figma-card card-orange">
						<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6s5KfAe0nX7GLW390NEUQUXIfbuNHiUDP1COiIdiVM7ltY3tUdAcMwUroEnFXRMEVcvO68fi0-mqiSVEp-pvoVYzRey8UhpDk-cet8fB0lUT4LD7MJ3RYzm5IfiWbVgCW56W9Vszdo9uupNS2vEen4Dl_tf-iQsdwflFrDWmRy0s0G1-AaWa9KzSuJTvmzmWjgQW-FQ7XL-OIEg_o2egtfz-llMCjGQqOgA73530IGjQz9WkTfHdE" alt="Orange Outfit">
					</div>
					<div class="figma-card card-teal">
						<img src="https://images.unsplash.com/photo-1582299878229-87a1d1d808d2?auto=format&fit=crop&q=80&w=600" alt="Teal Outfit">
					</div>
				</div>
				<!-- Column 2 -->
				<div class="figma-grid-col col-2">
					<div class="figma-card card-green">
						<div class="notch-mask"></div>
						<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuATPiQSlXnS1L9FCdh4rkc3wUE3H8VQzLrMmFulLyzeylsjewYdOwog2IuyXC8_3T4UL68JlX008h5JpAM4F_2hSYObJCHcI9uAESJijgLH4-mHbH3yoOBZYENhCVBQlAD4ghbcPhk12EpOwg3y1umz-6ISVbpDiU5c92OyB-f3zMP27C5agAvuXsnil5w2Dp9EV-4Ael_6F4bksYF7Rji9_vvUKlRL1PGbVMADPg4jG_I9Cpnd4fRm" alt="Green Coat">
					</div>
				</div>
				<!-- Column 3 -->
				<div class="figma-grid-col col-3">
					<div class="figma-hero-flower-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F4A261" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
					</div>
					<div class="figma-card card-yellow">
						<img src="https://images.unsplash.com/photo-1596207869389-9159048a60cd?auto=format&fit=crop&q=80&w=600" alt="Yellow Outfit">
					</div>
					<button class="figma-hero-explore-btn">
						Explore Collections <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M19 12l-7 7M19 12l-7-7"/></svg>
					</button>
				</div>
				<!-- Column 4 -->
				<div class="figma-grid-col col-4">
					<div class="figma-card card-blue">
						<div class="notch-mask"></div>
						<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJpJL8qD9gDcjP7tAaIGpE_-5kTG2mVRNIZuI8B4e0J3YHq4zkcEETeWOqPJQ2INdpnFdj5r1OFyIBGRPi70JmG7GdbW1xhzqsZFpgwhlUPgbxbK-EariW04lvnkXkVVfqw8opdGZADOgNQSYWxYMvk2_XWdwvTbrL-TygplsTN70X8CGmkvWtUtEq2bMY8ojJ8NJeVqtaQRTJi91WWIF5s_wTjOPn_SRDHUSHZpcUF-h2T0xSSSx4" alt="Blue Outfit">
					</div>
				</div>
				<!-- Column 5 -->
				<div class="figma-grid-col col-5">
					<div class="figma-card card-red-glasses">
						<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeOlBso1FzezaZJ1pQqLTO0S5DJv4face5L-IPMwhxx1wTHtJ6iF7_26tmLRLrWsqoR1hC_3Aw5VepjpN-PuNT1dCGCRMcXtrFGQtwkaEPM5ha-EhY70IJoM0JIhC7FifRZVCLIjsiz_AxD5vSzZW1U5Z3oGMaimOFGHiA2knYE1Q9RzThsY0jv4rc2CG9m-kAHMHp4lgbm2Wa3gVnvEKM9ZqulZBfhBVdq64MmV-wnusq2ZtyeMQh" alt="Red Glasses">
					</div>
					<div class="figma-card card-dark-green">
						<img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=600" alt="Dark Green Suit">
					</div>
				</div>
			</div>
		</div>

		<!-- Mobile Hero Layout (Carousel) -->
		<div class="figma-hero-mobile hidden-desktop">
			<div class="figma-mobile-header">
				<div class="figma-mobile-learn">
					<svg class="figma-hero-circle-text" viewBox="0 0 100 100">
						<path d="M 50, 50 m -35, 0 a 35,35 0 1,1 70,0 a 35,35 0 1,1 -70,0" fill="transparent" id="circlePathMob"></path>
						<text><textPath href="#circlePathMob" startOffset="0%">Learn about us through this video • </textPath></text>
					</svg>
					<button class="figma-hero-play-btn">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
					</button>
				</div>
				<h1 class="figma-mobile-title">Elevate Your Style With<br/>Bold Fashion</h1>
				<div class="figma-mobile-avatars">
					<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIeI-EV9B-4xqLmLRw95kbGlDMVUZthDXPv76_lsjH7CsYlSXrNumuGE2N_tH6AFJgQOLVPQT7ebfarLyqPYim2ji6oWMLpRPmhtE8reXtTmjZvszAWbwBJ3yKQT0g8JYYtDq5lsR1mDkyjU01v2aqnopBWblTTPuSy-ZRdpRmfR5Sk5ihVyriNy-1JWT2aVrPuvkBwA0Z58p1mGNFkE7WAKnVjFSldQdnN_GWQfSpj-U9TWQEkJPO" alt="Avatar 1">
					<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmDY-phvVvk9ycBHRnK4yq4riNd1yV7i2IYOmLwibNKVpIR4dnv3BpCCy3COKLOmqIjsB0Jnu8CdE64yLd-XQmb0hvG9HvfMK60ltxAdKoS3ZA3322Spk9qAS1foRcErQsRQcNEizr_A-5foo5PQP5bqEi78b-hfflQLu8VopPMTkOcqb9BW09O9PQorznflJW0eLnM0DIDd5OHrQmsG_aaD1AzXepfPH_W14Gnk1pyeJ4rNHv4JMz" alt="Avatar 2">
					<div class="figma-mobile-avatar-more">+</div>
				</div>
			</div>
			
			<div class="figma-mobile-carousel">
				<div class="figma-carousel-card card-orange"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6s5KfAe0nX7GLW390NEUQUXIfbuNHiUDP1COiIdiVM7ltY3tUdAcMwUroEnFXRMEVcvO68fi0-mqiSVEp-pvoVYzRey8UhpDk-cet8fB0lUT4LD7MJ3RYzm5IfiWbVgCW56W9Vszdo9uupNS2vEen4Dl_tf-iQsdwflFrDWmRy0s0G1-AaWa9KzSuJTvmzmWjgQW-FQ7XL-OIEg_o2egtfz-llMCjGQqOgA73530IGjQz9WkTfHdE" alt="Orange Outfit"></div>
				<div class="figma-carousel-card card-green"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuATPiQSlXnS1L9FCdh4rkc3wUE3H8VQzLrMmFulLyzeylsjewYdOwog2IuyXC8_3T4UL68JlX008h5JpAM4F_2hSYObJCHcI9uAESJijgLH4-mHbH3yoOBZYENhCVBQlAD4ghbcPhk12EpOwg3y1umz-6ISVbpDiU5c92OyB-f3zMP27C5agAvuXsnil5w2Dp9EV-4Ael_6F4bksYF7Rji9_vvUKlRL1PGbVMADPg4jG_I9Cpnd4fRm" alt="Green Coat"></div>
				<div class="figma-carousel-card card-blue"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJpJL8qD9gDcjP7tAaIGpE_-5kTG2mVRNIZuI8B4e0J3YHq4zkcEETeWOqPJQ2INdpnFdj5r1OFyIBGRPi70JmG7GdbW1xhzqsZFpgwhlUPgbxbK-EariW04lvnkXkVVfqw8opdGZADOgNQSYWxYMvk2_XWdwvTbrL-TygplsTN70X8CGmkvWtUtEq2bMY8ojJ8NJeVqtaQRTJi91WWIF5s_wTjOPn_SRDHUSHZpcUF-h2T0xSSSx4" alt="Blue Outfit"></div>
				<div class="figma-carousel-card card-red-glasses"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeOlBso1FzezaZJ1pQqLTO0S5DJv4face5L-IPMwhxx1wTHtJ6iF7_26tmLRLrWsqoR1hC_3Aw5VepjpN-PuNT1dCGCRMcXtrFGQtwkaEPM5ha-EhY70IJoM0JIhC7FifRZVCLIjsiz_AxD5vSzZW1U5Z3oGMaimOFGHiA2knYE1Q9RzThsY0jv4rc2CG9m-kAHMHp4lgbm2Wa3gVnvEKM9ZqulZBfhBVdq64MmV-wnusq2ZtyeMQh" alt="Red Glasses"></div>
			</div>
			
			<div class="figma-mobile-cta">
				<button class="figma-hero-explore-btn">
					Explore Collections <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M19 12l-7 7M19 12l-7-7"/></svg>
				</button>
			</div>
			
		</div>
	</section>

		<!-- The Latest Section -->
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
					'category_name'  => 'wardrobe',
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
						<h3 class="fp-latest-post-title">
							<?php 
								$short_title = get_post_meta( get_the_ID(), '_tcc_homepage_card_title', true );
								echo $short_title ? esc_html( $short_title ) : get_the_title(); 
							?>
						</h3>
					</a>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<a href="<?php echo esc_url( home_url( '/category/wardrobe/' ) ); ?>" class="fp-latest-view-more">VIEW MORE POSTS &rarr;</a>
		</div>
	</section>

	<!-- Creator Hub Section -->
	<section class="fp-creator-hub-section">
		<div class="fp-creator-hub-container relative">
			<!-- Header -->
			<div class="fp-creator-hub-header">
				<div class="fp-creator-hub-title-wrapper">
					<span class="fp-creator-hub-initial">C</span>
					<span class="fp-creator-hub-title">REATOR HUB</span>
				</div>
				<p class="fp-creator-hub-subtitle">I'm leveraging my collective industry experience to help you grow your content creation into a successful brand.</p>
			</div>

			<!-- Top Resources -->
			<div class="fp-creator-hub-resources-wrapper">
				<h3 class="fp-creator-hub-label">TOP RESOURCES</h3>
				
				<div class="fp-creator-hub-list">
					<a href="#" class="fp-creator-hub-item">
						<div class="fp-creator-hub-item-left">
							<svg class="fp-creator-hub-arrow-icon" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<ellipse cx="23" cy="16" rx="22" ry="15" stroke="black" stroke-width="1"/>
								<path d="M12 16H34M34 16L27 10M34 16L27 22" stroke="black" stroke-width="1" stroke-linecap="round"/>
							</svg>
							<span class="fp-creator-hub-item-title">Best Practices for Pitching & Landing Paid Sponsorships</span>
						</div>
						<span class="fp-creator-hub-read-more">READ MORE &rarr;</span>
					</a>
					<a href="#" class="fp-creator-hub-item">
						<div class="fp-creator-hub-item-left">
							<svg class="fp-creator-hub-arrow-icon" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<ellipse cx="23" cy="16" rx="22" ry="15" stroke="black" stroke-width="1"/>
								<path d="M12 16H34M34 16L27 10M34 16L27 22" stroke="black" stroke-width="1" stroke-linecap="round"/>
							</svg>
							<span class="fp-creator-hub-item-title">15 Questions to Ask an Influencer Management Agency Before Signing a Contract</span>
						</div>
						<span class="fp-creator-hub-read-more">READ MORE &rarr;</span>
					</a>
					<a href="#" class="fp-creator-hub-item">
						<div class="fp-creator-hub-item-left">
							<svg class="fp-creator-hub-arrow-icon" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<ellipse cx="23" cy="16" rx="22" ry="15" stroke="black" stroke-width="1"/>
								<path d="M12 16H34M34 16L27 10M34 16L27 22" stroke="black" stroke-width="1" stroke-linecap="round"/>
							</svg>
							<span class="fp-creator-hub-item-title">I Quit My Teaching Job...Here's What Happened Next</span>
						</div>
						<span class="fp-creator-hub-read-more">READ MORE &rarr;</span>
					</a>
				</div>
                <div class="fp-creator-hub-see-more-wrapper">
				    <a href="#" class="fp-creator-hub-see-more">SEE MORE ON THE CREATOR HUB&rarr;</a>
                </div>
			</div>
		</div>
	</section>

	<!-- Trending Posts Section -->
	<section class="fp-trending-section">
		<div class="fp-trending-container relative">
			<div class="fp-trending-header flex items-center">
				<h2 class="fp-trending-title">TRENDING <i style="font-style: italic; font-weight: normal;">POSTS</i></h2>
				<div class="fp-trending-divider"></div>
			</div>
			<div class="fp-trending-content relative" style="position: relative;">
				<div class="fp-trending-grid">
					<?php
					$trending_args = array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'tag'            => 'trending',
					);
					$trending_query = new WP_Query( $trending_args );
					
					if ( ! $trending_query->have_posts() ) {
						$trending_args = array(
							'post_type'      => 'post',
							'posts_per_page' => 3,
							'offset'         => 4,
						);
						$trending_query = new WP_Query( $trending_args );
					}

					if ( $trending_query->have_posts() ) :
						while ( $trending_query->have_posts() ) : $trending_query->the_post();
					?>
						<a href="<?php the_permalink(); ?>" class="fp-trending-card">
							<div class="fp-trending-card-img-wrapper">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php else : ?>
									<?php $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400'; ?>
									<img src="<?php echo esc_url( $dummy_img ); ?>" alt="Dummy Image" style="width:100%; height:100%; object-fit:cover;">
								<?php endif; ?>
							</div>
							<div class="fp-trending-card-content">
								<div class="fp-trending-meta-row flex items-center justify-between">
									<span class="fp-trending-category">
										<?php 
											$categories = get_the_category();
											if ( ! empty( $categories ) ) {
												echo esc_html( $categories[0]->name );
											} else {
												echo 'LIFESTYLE';
											}
										?>
									</span>
									<div class="fp-trending-arrow">
										<svg width="46" height="32" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
											<ellipse cx="23" cy="16" rx="22" ry="15" stroke="black" stroke-width="1"/>
											<path d="M12 16H34M34 16L27 10M34 16L27 22" stroke="black" stroke-width="1" stroke-linecap="round"/>
										</svg>
									</div>
								</div>
								<h3 class="fp-trending-post-title"><?php the_title(); ?></h3>
							</div>
						</a>
					<?php endwhile; wp_reset_postdata(); endif; ?>
				</div>
                
                <!-- Mobile Navigation Arrows -->
                <button class="fp-trending-mobile-nav prev" onclick="tccTrendingPrev()">
                    <svg width="24" height="40" viewBox="0 0 24 40" fill="none" stroke="black" stroke-width="1.5"><path d="M20 38L2 20L20 2"/></svg>
                </button>
                <button class="fp-trending-mobile-nav next" onclick="tccTrendingNext()">
                    <svg width="24" height="40" viewBox="0 0 24 40" fill="none" stroke="black" stroke-width="1.5"><path d="M4 38L22 20L4 2"/></svg>
                </button>

                <script>
                    let currentTrending = 0;
                    function tccTrendingUpdate() {
                        const trendingCards = document.querySelectorAll('.fp-trending-card');
                        if (!trendingCards.length) return;
                        if (window.innerWidth > 900) {
                            trendingCards.forEach(c => { c.style.display = ''; c.classList.remove('active-mobile-card'); });
                            return;
                        }
                        trendingCards.forEach((c, i) => {
                            if (i === currentTrending) {
                                c.style.display = 'flex';
                                c.classList.add('active-mobile-card');
                            } else {
                                c.style.display = 'none';
                                c.classList.remove('active-mobile-card');
                            }
                        });
                    }
                    function tccTrendingNext() {
                        const cards = document.querySelectorAll('.fp-trending-card');
                        currentTrending = (currentTrending + 1) % cards.length;
                        tccTrendingUpdate();
                    }
                    function tccTrendingPrev() {
                        const cards = document.querySelectorAll('.fp-trending-card');
                        currentTrending = (currentTrending - 1 + cards.length) % cards.length;
                        tccTrendingUpdate();
                    }
                    window.addEventListener('resize', tccTrendingUpdate);
                    document.addEventListener('DOMContentLoaded', tccTrendingUpdate);
                </script>
			</div>
		</div>
	</section>


	<!-- Subscribe (Figma Redesign) -->
	<section class="figma-newsletter-section">
		<div class="figma-newsletter-container">
			<div class="figma-newsletter-label">NEWSLETTER</div>
			<h2 class="figma-newsletter-title">Elevate your inbox</h2>
			<div class="figma-newsletter-subtitle">subscribe to the newsletter</div>
			<p class="figma-newsletter-desc">Join the wit & whimsy newsletter community and you'll instantly get Meghan's Guide to New York City plus even more exclusive content.</p>
			
			<form id="tcc-newsletter-form" class="figma-newsletter-form" onsubmit="event.preventDefault(); this.innerHTML = '<div style=\'padding: 1rem; text-align: center; color: #4CAF50; font-family: var(--font-sans); font-weight: 600; width: 100%;\'>✓ You\'re on the list!</div>';">
				<div class="figma-input-wrapper">
					<input type="text" placeholder="First name" required class="figma-newsletter-input" />
				</div>
				<div class="figma-input-wrapper">
					<input type="email" placeholder="Email address" required class="figma-newsletter-input" />
				</div>
				<div class="figma-btn-wrapper">
					<button type="submit" class="figma-newsletter-btn">SUBSCRIBE</button>
				</div>
			</form>
		</div>
	</section>

	<!-- Shop by Trending Videos (Figma Redesign) -->
	<section class="figma-smv-section">
		<div class="figma-smv-container">
			
			<!-- Left: Title -->
			<div class="figma-smv-left">
				<div class="figma-smv-title-wrapper">
					<h2 class="figma-smv-heading">SHOP<br/>MY<br/>VIDEOS</h2>
					<div class="figma-smv-nav-arrows">
						<div class="figma-smv-nav-arrow" id="smv-prev">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<div class="figma-smv-nav-arrow" id="smv-next">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
					</div>
				</div>
			</div>

			<!-- Right: Slider -->
			<div class="figma-smv-right">
				<div class="figma-smv-slider" id="figma-smv-slider">
					
					<?php 
					$products = [
						"Play Room Book Display" => "https://images.unsplash.com/photo-1544457070-4cd773b4d71e?auto=format&fit=crop&q=80&w=400",
						"Self-Tan Face Drops" => "https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&q=80&w=400",
						"Diamond Hoops" => "https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&q=80&w=400",
						"Flat Hair Clip" => "https://images.unsplash.com/photo-1596755389378-c31d21fd1273?auto=format&fit=crop&q=80&w=400",
						"Dress too low cut?" => "https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=400"
					];
					
					foreach($products as $title => $img): 
					?>
					<div class="figma-smv-slide">
						<!-- Video Thumbnail -->
						<div class="figma-smv-thumb">
							<picture>
								<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img)); ?>" type="image/avif">
								<img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" />
							</picture>
							<div class="figma-smv-play">
								<div class="figma-smv-play-circle"></div>
								<svg class="figma-smv-play-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8 5V19L19 12L8 5Z" fill="#000000"/>
								</svg>
							</div>
						</div>
						
						<!-- Product Title -->
						<div class="figma-smv-product-title text-sans">
							<?php echo esc_html($title); ?>
						</div>
						
						<!-- Shop Now Button -->
						<a href="#" class="figma-smv-shop-btn text-sans">
							SHOP NOW
						</a>
					</div>
					<?php endforeach; ?>
					
				</div>
			</div>

		</div>
	</section>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const slider = document.getElementById('figma-smv-slider');
		const prevBtn = document.getElementById('smv-prev');
		const nextBtn = document.getElementById('smv-next');
		
		let isDown = false;
		let startX;
		let scrollLeft;

		if(slider) {
			// Make cursor indicate grab ability on desktop
			slider.style.cursor = 'grab';
			
			slider.addEventListener('mousedown', (e) => {
				isDown = true;
				slider.style.cursor = 'grabbing';
				startX = e.pageX - slider.offsetLeft;
				scrollLeft = slider.scrollLeft;
				// Temporarily disable snap scrolling while dragging for smooth movement
				slider.style.scrollSnapType = 'none';
			});
			slider.addEventListener('mouseleave', () => {
				isDown = false;
				slider.style.cursor = 'grab';
				slider.style.scrollSnapType = 'x mandatory';
			});
			slider.addEventListener('mouseup', () => {
				isDown = false;
				slider.style.cursor = 'grab';
				slider.style.scrollSnapType = 'x mandatory';
			});
			slider.addEventListener('mousemove', (e) => {
				if (!isDown) return;
				e.preventDefault();
				const x = e.pageX - slider.offsetLeft;
				const walk = (x - startX) * 2; // Scroll speed multiplier
				slider.scrollLeft = scrollLeft - walk;
			});
			
			// Arrow click handlers
			if(prevBtn && nextBtn) {
				prevBtn.addEventListener('click', () => {
					slider.scrollBy({ left: -225, behavior: 'smooth' });
				});
				nextBtn.addEventListener('click', () => {
					slider.scrollBy({ left: 225, behavior: 'smooth' });
				});
			}
		}
	});
	</script>

	<!-- Elsewhere Section -->
	<section class="fp-elsewhere-section">
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

	<!-- Instagram Section (Figma Redesign) -->
	<section class="figma-ig-section">
		<div class="figma-ig-header">
			<div class="figma-ig-subtitle">SOCIAL</div>
			<h2 class="figma-ig-title">On Instagram</h2>
			<p class="figma-ig-desc">Everyday Outfits and Style Inspiration</p>
			<div class="figma-ig-buttons">
				<a href="#" class="figma-ig-btn">SHOP DAILY LOOKS HERE</a>
				<a href="#" class="figma-ig-btn">FOLLOW ON INSTAGRAM</a>
			</div>
		</div>
		<div class="figma-ig-grid">
			<?php 
			$ig_images = [
				"https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=400",
				"https://images.unsplash.com/photo-1550614000-4b95d41b7146?auto=format&fit=crop&q=80&w=400",
				"https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&q=80&w=400",
				"https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=400",
				"https://images.unsplash.com/photo-1544457070-4cd773b4d71e?auto=format&fit=crop&q=80&w=400",
				"https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?auto=format&fit=crop&q=80&w=400"
			];
			foreach($ig_images as $ig_img): 
			?>
			<a href="#">
				<picture>
					<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $ig_img)); ?>" type="image/avif">
					<img src="<?php echo esc_url($ig_img); ?>" alt="Instagram post" loading="lazy" />
				</picture>
			</a>
			<?php endforeach; ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>