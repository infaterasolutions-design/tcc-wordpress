<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>

<main class="fp-hero-main">

	<!-- Hero Section -->
	<style>
	.tcc-custom-hero-banner {
		position: relative;
		width: 100%;
		min-height: 600px;
		display: flex;
		align-items: center;
		justify-content: flex-start;
		background-image: url('/wp-content/themes/tcc-theme/assets/hero-bg-desktop-highres-green.png');
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		overflow: hidden;
	}
	.hero-text-overlay {
		max-width: 550px;
		text-align: left;
		padding: 40px;
		margin-left: 18%; /* Shift right to avoid the plant/mirror */
	}
	.hero-kicker {
		font-family: 'Inter', sans-serif;
		font-size: 14px;
		font-weight: 600;
		letter-spacing: 0.15em;
		color: #DDA89A; 
		text-transform: uppercase;
		margin-bottom: 15px;
		display: block;
	}
	.hero-main-title {
		font-family: 'Playfair Display', serif;
		font-size: 76px;
		line-height: 1.1;
		color: #fff;
		margin: 0 0 20px 0;
		font-weight: 500;
	}
	.hero-main-title span {
		color: #DDA89A;
	}
	.hero-desc {
		font-family: 'Inter', sans-serif;
		font-size: 17px;
		line-height: 1.6;
		color: #fff;
		margin: 0 0 35px 0;
		max-width: 450px;
	}
	.hero-btn-link {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		background-color: #C76B69;
		color: #fff;
		font-family: 'Inter', sans-serif;
		font-size: 14px;
		font-weight: 500;
		text-transform: uppercase;
		letter-spacing: 0.05em;
		padding: 16px 36px;
		border-radius: 40px;
		text-decoration: none;
		transition: background-color 0.3s ease;
	}
	.hero-btn-link:hover {
		background-color: #9d4d52;
		color: #fff;
	}
	.tcc-mobile-hero-banner { display: none; }

	@media (max-width: 1024px) {
		.hero-main-title { font-size: 56px; }
	}
	@media (max-width: 768px) {
		.tcc-custom-hero-banner { display: none; }
		.tcc-mobile-hero-banner { 
			display: flex; 
			width: 100%; 
			min-height: 550px;
			background-image: url('/wp-content/themes/tcc-theme/assets/hero-bg-mobile-sunglasses.png');
			background-size: cover;
			background-position: 50% 20%;
			background-repeat: no-repeat;
			position: relative;
			align-items: center;
			justify-content: flex-start;
		}
		.mobile-hero-text-overlay {
			padding: 40px 30px;
			text-align: left;
			width: 100%;
			max-width: 90%;
		}
		.mobile-hero-kicker {
			font-family: 'Inter', sans-serif;
			font-size: 13px;
			font-weight: 600;
			letter-spacing: 0.1em;
			color: #DDA89A; 
			text-transform: uppercase;
			margin-bottom: 12px;
			display: block;
		}
		.mobile-hero-main-title {
			font-family: 'Playfair Display', serif;
			font-size: 52px;
			line-height: 1.1;
			color: #fff; 
			margin: 0 0 15px 0;
			font-weight: 500;
		}
		.mobile-hero-desc {
			font-family: 'Inter', sans-serif;
			font-size: 15px;
			line-height: 1.5;
			color: #fff; 
			margin: 0 0 25px 0;
			max-width: 320px;
		}
		.mobile-hero-btn-link {
			display: inline-block;
			background-color: #C76B69; 
			color: #fff;
			font-family: 'Inter', sans-serif;
			font-size: 14px;
			font-weight: 500;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			padding: 14px 30px;
			border-radius: 30px;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}
	}
	@media (max-width: 480px) {
		.tcc-mobile-hero-banner { min-height: 500px; background-position: 60% 20%; }
		.mobile-hero-main-title { font-size: 46px; }
		.mobile-hero-text-overlay { padding: 30px 20px; }
	}
	</style>
	
	<!-- Desktop Hero (Pink background with dynamic text) -->
	<section class="tcc-custom-hero-banner" style="background-image: url('/wp-content/uploads/bg1.png') !important; background-color: #F8E7E0;">
		<div class="hero-text-overlay">
			<span class="hero-kicker">Outfit Ideas for Real Life</span>
			<h1 class="hero-main-title">
				Build a<br>
				Wardrobe<br>
				<span>You'll Love</span>
			</h1>
			<p class="hero-desc">
				Easy outfit ideas, seasonal style guides and closet planning tips to help you look and feel your best â€” every day.
			</p>
			<a href="<?php echo esc_url( home_url( '/category/wardrobe/' ) ); ?>" class="hero-btn-link">
				Explore Outfit Ideas &rarr;
			</a>
		</div>
	</section>

	<!-- Mobile Hero (Green background with dynamic text) -->
	<section class="tcc-mobile-hero-banner" style="background-image: url('/wp-content/uploads/bg2.png') !important; background-color: #2F4436;">
		<div class="mobile-hero-text-overlay">
			<span class="mobile-hero-kicker">From Closet to Confidence</span>
			<h1 class="mobile-hero-main-title">
				Outfits<br>
				That Fit<br>
				Your Life
			</h1>
			<p class="mobile-hero-desc">
				Practical outfit ideas, trend guides and<br/> closet planning tips for everyday style.
			</p>
			<a href="<?php echo esc_url( home_url( '/category/wardrobe/' ) ); ?>" class="mobile-hero-btn-link">
				Explore Now &rarr;
			</a>
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
								<?php $dummy_img = tcc_get_fallback_image(get_the_ID()); ?>
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
				<div class="fp-creator-hub-title-wrapper" id="ch-title" style="opacity: 0; transition: opacity 0.5s ease;">
					<span class="fp-creator-hub-initial">C</span>
					<span class="fp-creator-hub-title">REATOR HUB</span>
				</div>
				<noscript><style>#ch-title { opacity: 1 !important; }</style></noscript>
				<script>
					if (document.fonts) {
						document.fonts.ready.then(function() { document.getElementById('ch-title').style.opacity = '1'; });
					} else {
						document.getElementById('ch-title').style.opacity = '1';
					}
				</script>
				<p class="fp-creator-hub-subtitle">I'm leveraging my collective industry experience to help you grow your content creation into a successful brand.</p>
			</div>

			<!-- Top Resources -->
			<div class="fp-creator-hub-resources-wrapper">
				<h3 class="fp-creator-hub-label">TOP RESOURCES</h3>
				
				<div class="fp-creator-hub-list">
					<?php
					$creator_hub_args = array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'category_name'  => 'creator-hub',
					);
					$creator_hub_query = new WP_Query( $creator_hub_args );
					
					if ( $creator_hub_query->have_posts() ) :
						while ( $creator_hub_query->have_posts() ) : $creator_hub_query->the_post();
					?>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="fp-creator-hub-item">
						<div class="fp-creator-hub-item-left">
							<svg class="fp-creator-hub-arrow-icon" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
								<ellipse cx="23" cy="16" rx="22" ry="15" stroke="black" stroke-width="1"/>
								<path d="M12 16H34M34 16L27 10M34 16L27 22" stroke="black" stroke-width="1" stroke-linecap="round"/>
							</svg>
							<span class="fp-creator-hub-item-title"><?php the_title(); ?></span>
						</div>
						<span class="fp-creator-hub-read-more">READ MORE &rarr;</span>
					</a>
					<?php
						endwhile;
						wp_reset_postdata();
					else :
					?>
						<p>No posts found in the "Creator Hub" category.</p>
					<?php endif; ?>
				</div>
                <div class="fp-creator-hub-see-more-wrapper">
					<?php
					$creator_hub_cat = get_category_by_slug( 'creator-hub' );
					$creator_hub_link = $creator_hub_cat ? get_category_link( $creator_hub_cat->term_id ) : '#';
					?>
				    <a href="<?php echo esc_url( $creator_hub_link ); ?>" class="fp-creator-hub-see-more">SEE MORE ON THE CREATOR HUB&rarr;</a>
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
									<?php $dummy_img = tcc_get_fallback_image(get_the_ID()); ?>
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


	<style>
	.capsule-promo-section {
		margin: 0;
		background-color: #2F4436;
		background-image: url('/wp-content/themes/tcc-theme/assets/capsule-bg-highres.png');
		background-size: cover;
		background-position: center;
		display: flex;
		overflow: hidden;
		min-height: 450px;
		width: 100%;
	}

	.capsule-promo-image {
		display: none;
	}

	.capsule-promo-content {
		width: 50%;
		margin-left: auto;
		padding: 60px 50px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
	}

	.capsule-promo-title {
		font-family: 'Playfair Display', serif;
		font-size: 52px;
		line-height: 1.15;
		color: #fff;
		margin: 0 0 15px 0;
		font-weight: 500;
	}

	.capsule-promo-desc {
		font-family: 'Inter', sans-serif;
		font-size: 18px;
		color: #eaeaea;
		margin: 0 0 35px 0;
	}

	.capsule-promo-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		background-color: #F1D4D0; /* Light pink from mockup */
		color: #8C433D; /* Dark brownish text */
		font-family: 'Inter', sans-serif;
		font-size: 14px;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		padding: 16px 36px;
		border-radius: 40px;
		text-decoration: none;
		transition: opacity 0.3s ease;
	}
	.capsule-promo-btn:hover {
		opacity: 0.85;
		color: #8C433D;
	}
	@media (max-width: 768px) {
		.capsule-promo-section {
			flex-direction: row;
			margin: 0;
			border-radius: 0;
			min-height: 250px;
		}
		.capsule-promo-content {
			width: 60%;
			margin-left: auto;
			padding: 20px 15px;
			align-items: flex-start;
		}
		.capsule-promo-title { font-size: 26px; margin-bottom: 8px; line-height: 1.1; }
		.capsule-promo-desc { font-size: 13px; margin-bottom: 15px; line-height: 1.3; }
		.capsule-promo-btn { padding: 10px 18px; font-size: 11px; }
	}
	</style>

	<!-- Capsule Wardrobe Promo Banner -->
	<section class="capsule-promo-section" style="background-image: url('/wp-content/uploads/bg3.png') !important; background-color: #2F4436;">
		<div class="capsule-promo-image" id="capsule-image-placeholder">
			<!-- Background image will be applied here once provided -->
		</div>
		<div class="capsule-promo-content">
			<h2 class="capsule-promo-title">Build a<br>Capsule Wardrobe</h2>
			<p class="capsule-promo-desc">Simple pieces. Endless outfits.</p>
			<a href="<?php echo esc_url( home_url( '/category/wardrobe/' ) ); ?>" class="capsule-promo-btn">
				Learn More &rarr;
			</a>
		</div>
	</section>

	<!-- Shop by Trending Videos (Figma Redesign) -->
	<section class="figma-smv-section">
		<div class="figma-smv-container">
			
			<!-- Left: Title -->
			<div class="figma-smv-left">
				<div class="figma-smv-title-wrapper">
					<h2 class="figma-smv-heading">SHOP MY VIDEOS</h2>
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
					$args = array(
						'post_type' => 'shoppable_video',
						'posts_per_page' => 10,
						'post_status' => 'publish'
					);
					$video_query = new WP_Query($args);
					
					if ( $video_query->have_posts() ) :
						while ( $video_query->have_posts() ) : $video_query->the_post();
							$title = get_the_title();
							$img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : tcc_get_fallback_image(get_the_ID());
							$video_url = get_post_meta(get_the_ID(), '_tcc_video_url', true);
							$shopping_links = get_post_meta(get_the_ID(), '_tcc_video_products', true);
							$direct_shop_url = get_post_meta(get_the_ID(), '_tcc_direct_shop_url', true);
					?>
					<div class="figma-smv-slide">
						<!-- Video Thumbnail -->
						<div class="figma-smv-thumb tcc-smv-trigger" style="cursor: pointer;" data-video="<?php echo esc_url($video_url); ?>" data-direct-url="<?php echo esc_url($direct_shop_url); ?>">
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
						<div class="figma-smv-shop-links" style="display:none;"><?php echo do_shortcode($shopping_links); ?></div>
						<?php if ( ! empty( $direct_shop_url ) ) : ?>
							<a href="<?php echo esc_url( $direct_shop_url ); ?>" target="_blank" rel="nofollow noopener" class="figma-smv-shop-btn text-sans">
								SHOP NOW
							</a>
						<?php else : ?>
							<a href="#" class="figma-smv-shop-btn text-sans tcc-smv-shop-trigger">
								SHOP NOW
							</a>
						<?php endif; ?>
					</div>
					<?php 
						endwhile;
						wp_reset_postdata();
					else : 
						// Fallback dummy data if no videos exist yet
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
					<?php 
						endforeach; 
					endif; 
					?>
					
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

		// Lightbox Logic for Shoppable Videos
		const lightbox = document.getElementById('tcc-smv-lightbox');
		const closeBtn = document.querySelector('.tcc-smv-lightbox-close');
		const overlay = document.querySelector('.tcc-smv-lightbox-overlay');
		const playerContainer = document.getElementById('tcc-smv-player-container');
		const productsContainer = document.getElementById('tcc-smv-products-container');

		function closeLightbox() {
			lightbox.style.display = 'none';
			playerContainer.innerHTML = ''; // Stop video playback
			productsContainer.innerHTML = '';
		}

		if (lightbox) {
			closeBtn.addEventListener('click', closeLightbox);
			overlay.addEventListener('click', closeLightbox);

			const triggers = document.querySelectorAll('.tcc-smv-trigger, .tcc-smv-shop-trigger');
			triggers.forEach(trigger => {
				trigger.addEventListener('click', (e) => {
					e.preventDefault();
					const slide = trigger.closest('.figma-smv-slide');
					if (!slide) return;

					// 1. Get Shopping Links & Direct URL
					const shopLinksHtml = slide.querySelector('.figma-smv-shop-links').innerHTML;
					const thumb = slide.querySelector('.tcc-smv-trigger');
					let directUrl = thumb ? thumb.getAttribute('data-direct-url') : '';
					
					if (shopLinksHtml.trim() !== '') {
						productsContainer.innerHTML = shopLinksHtml;
					} else if (directUrl) {
						productsContainer.innerHTML = `<a href="${directUrl}" target="_blank" rel="nofollow noopener" style="display:block; text-align:center; background:#000; color:#fff; padding:15px 25px; text-decoration:none; font-family:'Inter', sans-serif; font-weight:600; font-size:14px; letter-spacing:1px; text-transform:uppercase; margin-top:20px;">SHOP THIS LOOK</a>`;
					} else {
						productsContainer.innerHTML = '';
					}
					let videoUrl = thumb ? thumb.getAttribute('data-video') : '';
					if (!videoUrl) return;

					videoUrl = videoUrl.trim();
					let playerHtml = '';

					if (videoUrl.includes('instagram.com')) {
						// Extract post ID to build embed URL
						// e.g. https://www.instagram.com/reel/C1XJZ5Iuxui/
						let embedUrl = videoUrl.replace(/\/$/, '') + '/embed';
						playerHtml = `<iframe src="${embedUrl}" width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" allowfullscreen="true"></iframe>`;
					} else if (videoUrl.endsWith('.mp4')) {
						playerHtml = `<video src="${videoUrl}" width="100%" height="100%" controls autoplay style="object-fit: cover; border-radius: 8px;"></video>`;
					} else if (videoUrl.includes('tiktok.com')) {
						// For TikTok, you'd usually use their oEmbed or iframe, simple iframe fallback:
						playerHtml = `<iframe src="https://www.tiktok.com/embed/v2/${videoUrl.split('/').pop()}" width="100%" height="100%" frameborder="0" allowfullscreen="true" allow="encrypted-media;"></iframe>`;
					} else {
						// Generic iframe fallback
						playerHtml = `<iframe src="${videoUrl}" width="100%" height="100%" frameborder="0" allowfullscreen="true"></iframe>`;
					}

					playerContainer.innerHTML = playerHtml;
					lightbox.style.display = 'flex';
				});
			});
		}

	});
	</script>

	<!-- Instagram Section (Figma Redesign) -->
	<section class="figma-ig-section">
		<div class="figma-ig-header">
			<div class="figma-ig-subtitle">SOCIAL</div>
			<h2 class="figma-ig-title">On Instagram</h2>
			<p class="figma-ig-desc">Everyday Outfits and Style Inspiration</p>
			<div class="figma-ig-buttons">
				<a href="#" class="figma-ig-btn">SHOP DAILY LOOKS HERE</a>
				<a href="https://www.instagram.com/thecombocloset/" target="_blank" rel="noopener noreferrer" class="figma-ig-btn">FOLLOW ON INSTAGRAM</a>
			</div>
		</div>
		<div class="figma-ig-grid plugin-container" style="width: 100%; overflow: hidden;">
            <style>
                /* Force Smash Balloon into a flawless seamless 6-column grid */
                #sb_instagram { padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
                #sb_instagram #sbi_images { display: flex !important; flex-wrap: nowrap !important; gap: 1px !important; background-color: #ffffff !important; padding: 0 !important; margin: 0 !important; width: 100% !important; }
                                                                                #sb_instagram .sbi_item { padding: 0 !important; margin: 0 !important; flex: 1 1 16.666% !important; max-width: 16.666% !important; border: none !important; }
                #sb_instagram .sbi_item img { width: 100% !important; height: 100% !important; object-fit: cover !important; }
                #sb_instagram .sbi_load_btn, #sb_instagram .sbi_follow_btn { display: none !important; }
                
                /* Fix Play Button Position */
                #sb_instagram .sbi_playbtn {
                    position: absolute !important;
                    top: 50% !important;
                    left: 50% !important;
                    right: auto !important;
                    bottom: auto !important;
                    transform: translate(-50%, -50%) !important;
                    margin: 0 !important;
                    width: 48px !important;
                    height: 48px !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    background: rgba(0, 0, 0, 0.4) !important;
                    border-radius: 50% !important;
                    padding: 12px !important;
                    z-index: 10 !important;
                }
                #sb_instagram .sbi_playbtn svg {
                    width: 24px !important;
                    height: 24px !important;
                    fill: #ffffff !important;
                    margin: 0 !important;
                }
                
                /* Mobile: 4 items visible, horizontal swiping slider */
                @media (max-width: 768px) { 
                    #sb_instagram #sbi_images { 
                        overflow-x: auto !important; 
                        scroll-snap-type: x mandatory !important; 
                        -webkit-overflow-scrolling: touch !important; 
                        scrollbar-width: none !important; 
                    } 
                    #sb_instagram #sbi_images::-webkit-scrollbar { display: none !important; } 
                    #sb_instagram .sbi_item { 
                        flex: 0 0 25% !important; /* Exactly 4 visible at once */
                        max-width: 25% !important; 
                        scroll-snap-align: start !important; 
                    } 
                }
            </style>
			<?php echo do_shortcode('[instagram-feed num=6 cols=6 disablemobile=true showheader=false showbutton=false showfollow=false]'); ?>
		</div>
	</section>

</main>

<?php get_footer(); ?>





