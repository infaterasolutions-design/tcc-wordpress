<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>

<main class="fp-hero-main container">

	<!-- Hero Section -->
	<section class="flex hero-section">
		<!-- Left Half (Text) -->
		<div class="w-full flex items-center justify-center hero-left">
			<div class="fp-hero-left">
				<h1 class="text-serif">
					<?php echo wp_kses_post( get_theme_mod( 'tcc_hero_heading', "Welcome to<br/>Minimalist<br/>Sophistication with<br/>Maximum Style" ) ); ?>
				</h1>
				<p class="text-sans">
					<?php echo wp_kses_post( get_theme_mod( 'tcc_hero_text', 'The Combo Closet is an inspired style, home, and beauty destination for those who prefer quality over quantity, subtle over obvious, and ease over complexity.' ) ); ?>
				</p>
			</div>
		</div>
		<!-- Right Half (Image) -->
		<div class="w-full flex items-center justify-center hero-right">
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
				<img src="<?php echo esc_url($hero_raw); ?>" alt="Hero image" class="object-cover" fetchpriority="high" loading="eager" />
			</picture>
		</div>
	</section>

	<!-- Trending Section -->
	<!-- Trending Section -->
	<section class="figma-trending-container">
		<?php
		$tabs_config = [
			['id' => 'popular', 'label' => 'POPULAR', 'query' => ['post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'comment_count'], 'btn_text' => 'READ MORE POPULAR POSTS'],
			['id' => 'travel-tips', 'label' => 'TRAVEL TIPS', 'query' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'travel-tips'], 'btn_text' => 'READ MORE TRAVEL TIPS'],
			['id' => 'outfit-guides', 'label' => 'OUTFIT GUIDES', 'query' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'outfit-guides'], 'btn_text' => 'READ MORE OUTFIT GUIDES'],
			['id' => 'reviews', 'label' => 'REVIEWS', 'query' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'reviews'], 'btn_text' => 'READ MORE REVIEWS'],
		];
		
		$tabs_data = [];
		// Only pre-load the first tab to save query time!
		$first_tab = $tabs_config[0];
		$q = new WP_Query($first_tab['query']);
		$posts = [];
		if ($q->have_posts()) {
			while ($q->have_posts()) {
				$q->the_post();
				$cat = get_the_category();
				$dummy_img = get_post_meta(get_the_ID(), '_tcc_dummy_image', true) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400';
				$img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : $dummy_img;
				
				$posts[] = [
					'title' => get_the_title(),
					'permalink' => get_permalink(),
					'excerpt' => wp_trim_words(get_the_excerpt(), 15, '&hellip;'),
					'category' => $cat ? esc_html($cat[0]->name) : '',
					'image' => $img_url
				];
			}
		}
		wp_reset_postdata();
		$tabs_data[$first_tab['id']] = [
			'btn_text' => $first_tab['btn_text'],
			'posts' => $posts
		];
		?>
		
		<div class="figma-trending-title-wrapper">
			<h2 class="figma-trending-title">trending</h2>
			<nav class="figma-trending-nav" id="figma-tabs-nav">
				<?php foreach($tabs_config as $index => $tab): ?>
					<span class="<?php echo $index === 0 ? 'figma-trending-nav-active' : 'figma-trending-nav-item'; ?>" data-tab="<?php echo esc_attr($tab['id']); ?>">
						<?php echo esc_html($tab['label']); ?>
					</span>
				<?php endforeach; ?>
			</nav>
		</div>

		<div class="figma-trending-grid" id="figma-trending-grid">
			<!-- Featured (Left) -->
			<div class="figma-trending-featured">
				<div class="figma-trending-featured-img" id="ft-feat-img" style="background-image: url('');"></div>
				<div class="figma-trending-featured-content">
					<a href="#" class="figma-trending-featured-title" id="ft-feat-title"></a>
					<div class="figma-trending-featured-excerpt" id="ft-feat-excerpt"></div>
					<a href="#" class="figma-trending-featured-btn" id="ft-feat-link">VIEW THE POST</a>
				</div>
			</div>
			
			<!-- List (Right) -->
			<div class="figma-trending-list" id="ft-list-container">
				<!-- Dynamically generated list items will go here -->
				<a href="#" class="figma-trending-list-btn" id="ft-list-btn"></a>
			</div>
		</div>

		<script>
		document.addEventListener('DOMContentLoaded', function() {
			let tabsData = <?php echo json_encode($tabs_data); ?>;
			const navItems = document.querySelectorAll('#figma-tabs-nav span');
			
			// DOM Elements
			const featImg = document.getElementById('ft-feat-img');
			const featTitle = document.getElementById('ft-feat-title');
			const featExcerpt = document.getElementById('ft-feat-excerpt');
			const featLink = document.getElementById('ft-feat-link');
			const listContainer = document.getElementById('ft-list-container');
			const listBtn = document.getElementById('ft-list-btn');
			
			function renderFeatured(post) {
				featImg.style.backgroundImage = `url(${post.image})`;
				featTitle.textContent = post.title;
				featTitle.href = post.permalink;
				featExcerpt.innerHTML = post.excerpt;
				featLink.href = post.permalink;
			}
			
			function renderTab(tabId) {
				if (tabsData[tabId]) {
					_render(tabId);
				} else {
					listBtn.textContent = 'LOADING...';
					fetch('/wp-json/tcc/v1/trending/' + tabId)
						.then(res => res.json())
						.then(data => {
							tabsData[tabId] = data;
							_render(tabId);
						})
						.catch(err => {
							console.error(err);
							listBtn.textContent = 'ERROR LOADING POSTS';
						});
				}
			}

			function _render(tabId) {
				const data = tabsData[tabId];
				if (!data || !data.posts || data.posts.length === 0) return;
				
				// Render Featured initial
				renderFeatured(data.posts[0]);
				
				// Render List
				// First remove old items
				const oldItems = listContainer.querySelectorAll('.figma-trending-list-item');
				oldItems.forEach(item => item.remove());
				
				// Create new items
				const fragment = document.createDocumentFragment();
				for (let i = 0; i < data.posts.length; i++) {
					const post = data.posts[i];
					const a = document.createElement('a');
					a.className = 'figma-trending-list-item';
					a.href = '#';
					a.setAttribute('data-index', i);
					
					const num = document.createElement('span');
					num.className = 'figma-trending-list-num ' + (i === 0 ? 'active-num' : '');
					num.textContent = i + 1;
					
					const title = document.createElement('span');
					title.className = 'figma-trending-list-title ' + (i === 0 ? 'active-title' : '');
					title.textContent = post.title;
					
					a.appendChild(num);
					a.appendChild(title);
					
					// Click listener to update featured card instead of navigating
					a.addEventListener('click', function(e) {
						e.preventDefault();
						
						// Update active styling
						const allItems = listContainer.querySelectorAll('.figma-trending-list-item');
						allItems.forEach(item => {
							item.querySelector('.figma-trending-list-num').classList.remove('active-num');
							item.querySelector('.figma-trending-list-title').classList.remove('active-title');
						});
						num.classList.add('active-num');
						title.classList.add('active-title');
						
						// Update featured left side
						renderFeatured(data.posts[this.getAttribute('data-index')]);
					});
					
					fragment.appendChild(a);
				}
				
				listContainer.insertBefore(fragment, listBtn);
				listBtn.textContent = data.btn_text;
			}
			
			// Init
			if (navItems.length > 0) {
				renderTab(navItems[0].getAttribute('data-tab'));
			}
			
			// Event Listeners
			navItems.forEach(item => {
				item.addEventListener('click', function() {
					navItems.forEach(nav => {
						nav.classList.remove('figma-trending-nav-active');
						nav.classList.add('figma-trending-nav-item');
					});
					this.classList.add('figma-trending-nav-active');
					this.classList.remove('figma-trending-nav-item');
					renderTab(this.getAttribute('data-tab'));
				});
			});
		});
		</script>
	</section>

	<!-- Recent Posts Section -->
	<section class="fp-recent-section">
		<!-- Header -->
		<div class="flex items-center justify-between fp-recent-header">
			<div class="flex items-center fp-recent-header-left">
				<h2 class="text-serif fp-recent-title">recent posts:</h2>
				<div class="fp-recent-line"></div>
			</div>
			<nav class="flex items-center uppercase text-sans recent-nav fp-recent-nav">
				<span class="fp-recent-nav-label">BROWSE MORE IN:</span>
				<div class="flex fp-recent-nav-links">
					<span class="fp-recent-nav-link active">AMAZON</span>
					<span class="fp-recent-nav-link">REVIEWS</span>
					<span class="fp-recent-nav-link">BEAUTY</span>
					<span class="fp-recent-nav-link">TRAVEL</span>
				</div>
			</nav>
		</div>

		<!-- Grid -->
		<div class="recent-grid">
			<?php
			$recent_args = array(
				'post_type'      => 'post',
				'posts_per_page' => 4,
			);
			$recent_query = new WP_Query( $recent_args );
			if ( $recent_query->have_posts() ) :
				while ( $recent_query->have_posts() ) : $recent_query->the_post();
			?>
				<div class="recent-card">
					<div class="img-container relative">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ); ?>
						<?php else : ?>
							<?php $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400'; ?>
							<picture class="absolute inset-0 w-full h-full">
								<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $dummy_img)); ?>" type="image/avif">
								<img src="<?php echo esc_url($dummy_img); ?>" alt="Placeholder" class="absolute inset-0 w-full h-full object-cover" />
							</picture>
						<?php endif; ?>
					</div>
					<span class="uppercase text-sans category"><?php $category = get_the_category(); if($category) echo esc_html($category[0]->name); ?></span>
					<h4 class="text-serif"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				</div>
			<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>

		<!-- Load More -->
		<div class="flex items-center justify-center fp-recent-load-more">
			<div class="flex items-center fp-recent-load-btn">
				<span class="uppercase text-sans fp-recent-load-text">LOAD MORE</span>
				<div class="fp-recent-load-line">
					<div class="fp-recent-load-arrow"></div>
				</div>
			</div>
		</div>
	</section>

	<!-- Subscribe -->
	<section class="subscribe-section" style="background-color: #FAF6EE; margin: 4rem auto; border: 1px solid #EAE3D5; border-radius: 8px;">
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

	<!-- Shop by Trending Videos -->
	<section>
		<div class="flex gap-sm shop-videos-row fp-shop-videos-container">
			<div class="shop-videos-title">
				<div class="sticky-container">
					<h2 class="text-serif text-center">SHOP<br/>MY<br/>VIDEOS<br/><span class="fp-shop-videos-arrow">→</span></h2>
				</div>
			</div>
			<?php for($i=1; $i<=4; $i++): ?>
			<div class="shop-videos-item">
				<?php $video_img = "https://images.unsplash.com/photo-1516762689617-e1cffcef479d?auto=format&fit=crop&q=80&w=200&h=300&sig=" . $i; ?>
				<picture>
					<source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $video_img)); ?>" type="image/avif">
					<img src="<?php echo esc_url($video_img); ?>" alt="Video" class="w-full object-cover h-[250px]" loading="lazy" />
				</picture>
				<button>SHOP NOW</button>
			</div>
			<?php endfor; ?>
		</div>
	</section>

	<!-- Elsewhere Section -->
	<section class="fp-elsewhere-section">
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

</main>

<?php get_footer(); ?>