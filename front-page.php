<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>

<main class="fp-hero-main">

	<!-- Hero Section -->
	<section class="tcc-hero-section">
		<div class="tcc-hero-container">
			<!-- Text -->
			<div class="tcc-hero-text">
				<h1 class="text-serif">
					<?php echo wp_kses_post( get_theme_mod( 'tcc_hero_heading', "Welcome to<br/>Minimalist<br/>Sophistication with<br/>Maximum Style" ) ); ?>
				</h1>
				<p class="text-sans">
					<?php echo wp_kses_post( get_theme_mod( 'tcc_hero_text', 'The Combo Closet is an inspired style, home, and beauty destination for those who prefer quality over quantity, subtle over obvious, and ease over complexity.' ) ); ?>
				</p>
			</div>
			<!-- Image -->
			<div class="tcc-hero-image-wrapper">
				<?php
				$hero_raw = get_theme_mod( 'tcc_hero_image', 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=600' );
				if (strpos($hero_raw, 'unsplash.com') !== false) {
					$hero_avif = str_replace('auto=format', 'fm=avif', $hero_raw);
				} else {
					$hero_avif = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $hero_raw);
				}
				?>
				<picture>
					<source srcset="<?php echo esc_url($hero_avif); ?>" type="image/avif">
					<img src="<?php echo esc_url($hero_raw); ?>" alt="Hero image" class="tcc-hero-img" fetchpriority="high" loading="eager" />
				</picture>
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



	<!-- Subscribe -->
	<section class="subscribe-section container" style="background-color: #FAF6EE; margin: 4rem auto; border: 1px solid #EAE3D5; border-radius: 8px;">
		<div class="subscribe-text-container">
			<h3 class="text-serif" style="font-size: 2rem; color: #2C2C2C; margin-bottom: 0.5rem; line-height: 1.2;">Join the Newsletter</h3>
			<p class="text-sans" style="font-size: 1rem; color: #666; margin: 0;">Sign up for weekly style inspiration straight to your inbox.</p>
		</div>
		
		<div class="subscribe-form-container">
			<form id="tcc-newsletter-form" class="subscribe-form" style="display: flex; gap: 0; width: 100%; border: 1px solid #D5D5D5; border-radius: 4px; overflow: hidden; background: #FFF;" onsubmit="event.preventDefault(); this.parentElement.innerHTML = '<div style=\'padding: 0.8rem; width: 100%; text-align: left;\'><span style=\'color: #4CAF50; font-weight: 600; font-size: 1.1rem;\'>✓ You\'re on the list!</span></div>';">
				<input type="email" placeholder="Email Address" required style="flex: 1; padding: 0.8rem 1rem; border: none; outline: none; font-size: 1rem; width: 100%; color: #2C2C2C;" />
				<button type="submit" class="uppercase text-sans" style="background-color: #C5DAD4; color: #1F2937; border: none; padding: 0.8rem 1.5rem; font-weight: 600; font-size: 0.9rem; letter-spacing: 1px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#B3CBC4'" onmouseout="this.style.backgroundColor='#C5DAD4'">SUBSCRIBE</button>
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
	<section class="fp-elsewhere-section container">
		<div class="fp-elsewhere-container">
			<!-- Script Text -->
			<div class="fp-elsewhere-text-wrapper">
				<span class="text-script fp-elsewhere-text">elsewhere</span>
			</div>
			<!-- Image 1: Clothes rack -->
			<?php $img1 = "https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?auto=format&fit=crop&q=80&w=400"; ?>
			<picture class="fp-elsewhere-img1">
				<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img1)); ?>" type="image/avif">
				<img src="<?php echo esc_url($img1); ?>" alt="Clothes rack" class="w-full object-cover aspect-[3/4]" loading="lazy" />
			</picture>
			<!-- Image 2: Striped sweater -->
			<?php $img2 = "https://images.unsplash.com/photo-1617019114583-affb34d1b3cd?auto=format&fit=crop&q=80&w=400"; ?>
			<picture class="fp-elsewhere-img2">
				<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img2)); ?>" type="image/avif">
				<img src="<?php echo esc_url($img2); ?>" alt="Striped sweater" class="w-full object-cover aspect-[3/4]" loading="lazy" />
			</picture>
			<!-- Image 3: Bag and drink -->
			<div class="fp-elsewhere-img3-wrapper">
				<?php $img3 = "https://images.unsplash.com/photo-1509319117193-57bab727e09d?auto=format&fit=crop&q=80&w=400"; ?>
				<picture class="w-full">
					<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img3)); ?>" type="image/avif">
					<img src="<?php echo esc_url($img3); ?>" alt="Bag and drink" class="w-full object-cover aspect-square" loading="lazy" />
				</picture>
				<div class="fp-elsewhere-handle">@THECOMBOCLOSET</div>
			</div>
			<!-- Image 4: Woman walking -->
			<?php $img4 = "https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=400"; ?>
			<picture class="fp-elsewhere-img4">
				<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img4)); ?>" type="image/avif">
				<img src="<?php echo esc_url($img4); ?>" alt="Woman walking" class="w-full object-cover aspect-[3/4]" loading="lazy" />
			</picture>
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