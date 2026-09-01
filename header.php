<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<style>
/* CRITICAL SIDEBAR LAYOUT OVERRIDES (Cache Busting) */
.sidebar-page-container {
    max-width: 1240px !important;
    margin: 0 auto !important;
    padding: 3rem 1rem !important;
    display: flex !important;
    gap: 60px !important;
    align-items: flex-start !important;
}
.sidebar-page-container .article-container {
    flex: 1 !important;
    width: 100% !important;
    max-width: 837px !important;
    position: relative !important;
    min-width: 0 !important; /* Prevents flex blowout */
}
.sidebar-page-container .sidebar-container {
    width: 100% !important;
    max-width: 340px !important;
    flex-shrink: 0 !important;
}
/* Fix for full-width sliders/images in sidebar layout */
.sidebar-page-container .alignfull,
.sidebar-page-container .alignwide {
    margin-left: 0 !important;
    margin-right: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    left: 0 !important;
    transform: none !important;
}
@media (max-width: 1024px) {
    .sidebar-page-container {
        flex-direction: column !important;
        padding: 2rem 1rem !important;
        gap: 40px !important;
    }
    .sidebar-page-container .sidebar-container {
        max-width: 100% !important;
    }
}
/* Prevent Horizontal Scroll & Image Blowout */
body, html {
    max-width: 100vw !important;
}
.article-hero-image {
    width: 100% !important;
    height: auto !important;
    display: block !important;
    max-width: 100% !important;
}
.article-body img {
    max-width: 100% !important;
    height: auto !important;
}
</style>
<?php wp_head(); ?>
	<style>
		@media (max-width: 1200px) {
			.desktop-nav { display: none !important; }
			.desktop-shop-btn { display: none !important; }
			.desktop-socials { display: none !important; }
			.hamburger-icon { display: block !important; }
			.header-logo-tcc { font-size: 1.5rem !important; }
			.header-logo-text { font-size: 0.9rem !important; }
			.site-logo img.custom-logo { max-height: 35px !important; width: auto !important; }
			.header-main { 
				padding: 0.8rem var(--spacing-sm) !important; 
				position: sticky !important;
				top: 0 !important;
				z-index: 999 !important;
			}
		}
		@media (min-width: 1201px) {
			.hamburger-icon { display: none !important; }
		}
		.desktop-nav ul {
			display: flex;
			gap: 2rem;
			list-style: none;
			margin: 0;
			padding: 0;
		}
		.desktop-nav a {
			font-family: 'Inter', sans-serif;
			font-size: 13px;
			letter-spacing: 0.15em;
			font-weight: 500;
			color: #6b7280;
			text-transform: uppercase;
			text-decoration: none;
			transition: color 0.2s ease;
		}
		.desktop-nav a:hover {
			color: #000;
		}
	</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">
	<header class="container flex justify-between items-center header-main" style="padding: 1.5rem var(--spacing-sm); border-bottom: 1px solid var(--color-border); margin-bottom: 0; position: relative; z-index: 100; background-color: var(--color-bg);">
		<div id="header-left-col" class="flex items-center gap-sm">

			<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo flex items-center">
					<?php the_custom_logo(); ?>
				</div>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center header-logo-link" style="gap: 0.5rem; text-decoration: none;">
				<span class="text-script header-logo-tcc" style="font-size: 2.5rem; color: #b0afa9; line-height: 1;">tcc</span>
				<span class="text-serif header-logo-text" style="font-size: 1.5rem; font-weight: bold; letter-spacing: -0.5px; color: #000;">the combo closet</span>
			</a>
			<?php endif; ?>
		</div>
		
		<!-- Desktop Nav -->
		<?php
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			'menu_class'      => 'desktop-nav flex gap-md text-sans uppercase',
			'container'       => 'nav',
			'container_class' => 'desktop-nav-container',
			'fallback_cb'     => false,
			'walker'          => new TCC_Mega_Menu_Walker(),
		) );
		?>
		
		<div class="flex items-center gap-sm">
			<!-- Sleek Header Search Bar -->
			<div class="desktop-header-search" style="position: relative;">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="expandable-search-form" style="display: flex; align-items: center; border-bottom: 1px solid transparent; padding-bottom: 4px; transition: border-color 0.3s ease;">
					<input type="search" class="expandable-search-input" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" style="border: none; outline: none; background: transparent; font-family: 'Inter', sans-serif; font-size: 0.8rem; width: 0; padding: 0; opacity: 0; transition: all 0.3s ease; color: #000;" />
					<button type="button" class="expandable-search-toggle" style="background: transparent; border: none; padding: 0; cursor: pointer; display: flex; align-items: center; margin-left: 5px; color: #000;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
					</button>
				</form>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						const form = document.querySelector('.expandable-search-form');
						const input = document.querySelector('.expandable-search-input');
						const toggle = document.querySelector('.expandable-search-toggle');

						const leftCol = document.getElementById('header-left-col');

						toggle.addEventListener('click', function(e) {
							if (input.style.width === '0px' || input.style.width === '') {
								e.preventDefault();
								if (window.innerWidth <= 1200) {
									if(leftCol) leftCol.style.display = 'none';
									input.style.width = 'calc(100vw - 120px)';
								} else {
									input.style.width = '120px';
								}
								input.style.opacity = '1';
								form.style.borderBottomColor = '#ccc';
								input.focus();
								toggle.type = 'submit';
							} else {
								if (input.value.trim() === '') {
									e.preventDefault();
									if (window.innerWidth <= 1200) {
										if(leftCol) leftCol.style.display = 'flex';
									}
									input.style.width = '0';
									input.style.opacity = '0';
									form.style.borderBottomColor = 'transparent';
									toggle.type = 'button';
								}
							}
						});

						// Collapse when clicking outside
						document.addEventListener('click', function(e) {
							if (!form.contains(e.target) && input.value.trim() === '') {
								if (window.innerWidth <= 1200) {
									if(leftCol) leftCol.style.display = 'flex';
								}
								input.style.width = '0';
								input.style.opacity = '0';
								form.style.borderBottomColor = 'transparent';
								toggle.type = 'button';
							}
						});
					});
				</script>
			</div>

			<div class="desktop-socials flex" style="display: flex; gap: 1.25rem; align-items: center; color: #000; cursor: pointer;">
				<!-- Social SVG Icons -->
				<a href="https://www.instagram.com/thecombocloset/" target="_blank" rel="noopener noreferrer" style="color: inherit;">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
						<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
						<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
					</svg>
				</a>
				<a href="https://in.pinterest.com/thecombocloset/" target="_blank" rel="noopener noreferrer" style="color: inherit;">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.592 0 12.017 0z"/>
					</svg>
				</a>
				<a href="https://www.youtube.com/@thecombocloset" target="_blank" rel="noopener noreferrer" style="color: inherit;">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
						<polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
					</svg>
				</a>
				<a href="https://www.threads.com/@thecombocloset" target="_blank" rel="noopener noreferrer" style="color: inherit;">
					<svg width="16" height="16" viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6596 97.2286 61.6596C97.3051 61.6596 97.3819 61.66 97.4584 61.6622C109.112 61.7377 116.634 70.3601 118.825 84.8778C110.158 82.5209 101.539 81.3387 93.3087 81.3387C69.043 81.3387 51.5215 90.0637 51.5215 109.683C51.5215 127.351 64.9126 138.835 83.2181 138.835C101.42 138.835 116.398 127.702 121.284 109.845C124.636 113.882 128.537 117.849 132.887 121.658C120.738 134.469 102.664 142.127 83.2181 142.127C50.2974 142.127 26.6974 121.145 26.6974 88.9483C26.6974 55.4385 49.3377 34.1952 83.2181 34.1952C101.767 34.1952 116.516 41.5293 125.753 53.6496L139.11 43.1554C127.24 27.5255 107.654 17.2793 83.2181 17.2793C40.6695 17.2793 9.77734 44.9782 9.77734 88.9483C9.77734 131.785 41.426 159.043 83.2181 159.043C108.312 159.043 131.968 148.167 146.527 129.492C150.816 124.032 154.341 118.064 157.062 111.758C159.505 106.096 160.852 100.177 161.077 94.2758C161.272 89.1415 160.485 84.281 158.749 79.7915C155.626 71.7143 149.689 65.9126 142.062 62.7758C136.257 60.3897 129.624 59.2736 122.617 59.5298C122.253 64.9121 121.393 70.9329 119.863 77.2917C124.908 77.0134 129.654 77.7285 133.743 79.4093C138.835 81.5037 142.663 86.2084 144.116 93.3087C145.418 99.6738 144.382 105.152 141.229 109.11C137.957 113.22 132.84 115.428 126.31 115.428C117.848 115.428 110.155 110.978 105.992 102.768C103.491 97.8344 102.164 91.803 102.164 85.0744C102.164 84.819 102.168 84.5619 102.176 84.3031C101.274 84.3411 100.355 84.3831 99.4182 84.4285C97.4332 84.5246 95.4019 84.6293 93.3087 84.6293C79.8827 84.6293 68.4415 90.0152 68.4415 102.261C68.4415 113.626 76.5167 121.919 88.2435 121.919C102.091 121.919 113.111 111.411 116.892 94.6368C125.753 97.2604 133.877 94.6859 141.537 88.9883Z" fill="currentColor"/>
					</svg>
				</a>
			</div>

			<span id="hamburger-icon" class="hamburger-icon" style="cursor: pointer; user-select: none; display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; color: #000;">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
			</span>
		</div>
	</header>



	<!-- Mobile Drawer Overlay -->
	<div id="mobile-drawer-overlay" class="mobile-drawer-overlay" style="display: none; position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); z-index: 98;"></div>

	<!-- Mobile Drawer -->
	<div id="mobile-drawer" class="mobile-drawer" style="position: fixed; top: 0; left: 0; width: 300px; max-width: 85vw; height: 100%; background-color: var(--color-bg); z-index: 101; transform: translateX(-100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;">
		<div style="padding: 1.5rem var(--spacing-sm); display: flex; align-items: center;">
			<span id="close-drawer" style="display: none; font-size: 1.8rem; cursor: pointer; user-select: none; width: 30px; text-align: center;">
				✕
			</span>
		</div>
		
		<div style="padding: 2rem; display: flex; flex-direction: column; gap: 2rem; overflow-y: auto;">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu_class'      => 'flex text-sans uppercase flex-col gap-6',
				'container'       => 'nav',
				'fallback_cb'     => false,
			) );
			?>
			
			<div style="height: 1px; background-color: var(--color-border); width: 100%;"></div>
			
			<div class="flex" style="flex-direction: column; gap: 1.5rem;">
				
				<div class="flex justify-center" style="gap: 1.5rem; color: #000; cursor: pointer; margin-top: 1rem;">
					<!-- Social SVG Icons -->
					<a href="https://www.instagram.com/thecombocloset/" target="_blank" rel="noopener noreferrer" style="color: inherit;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
							<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
							<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
						</svg>
					</a>
					<!-- Pinterest -->
					<a href="https://in.pinterest.com/thecombocloset/" target="_blank" rel="noopener noreferrer" style="color: inherit;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.592 0 12.017 0z"/>
						</svg>
					</a>
					<!-- YouTube -->
					<a href="https://www.youtube.com/@thecombocloset" target="_blank" rel="noopener noreferrer" style="color: inherit;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
							<polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
						</svg>
					</a>
					<!-- Threads -->
					<a href="https://www.threads.com/@thecombocloset" target="_blank" rel="noopener noreferrer" style="color: inherit;">
						<svg width="20" height="20" viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6596 97.2286 61.6596C97.3051 61.6596 97.3819 61.66 97.4584 61.6622C109.112 61.7377 116.634 70.3601 118.825 84.8778C110.158 82.5209 101.539 81.3387 93.3087 81.3387C69.043 81.3387 51.5215 90.0637 51.5215 109.683C51.5215 127.351 64.9126 138.835 83.2181 138.835C101.42 138.835 116.398 127.702 121.284 109.845C124.636 113.882 128.537 117.849 132.887 121.658C120.738 134.469 102.664 142.127 83.2181 142.127C50.2974 142.127 26.6974 121.145 26.6974 88.9483C26.6974 55.4385 49.3377 34.1952 83.2181 34.1952C101.767 34.1952 116.516 41.5293 125.753 53.6496L139.11 43.1554C127.24 27.5255 107.654 17.2793 83.2181 17.2793C40.6695 17.2793 9.77734 44.9782 9.77734 88.9483C9.77734 131.785 41.426 159.043 83.2181 159.043C108.312 159.043 131.968 148.167 146.527 129.492C150.816 124.032 154.341 118.064 157.062 111.758C159.505 106.096 160.852 100.177 161.077 94.2758C161.272 89.1415 160.485 84.281 158.749 79.7915C155.626 71.7143 149.689 65.9126 142.062 62.7758C136.257 60.3897 129.624 59.2736 122.617 59.5298C122.253 64.9121 121.393 70.9329 119.863 77.2917C124.908 77.0134 129.654 77.7285 133.743 79.4093C138.835 81.5037 142.663 86.2084 144.116 93.3087C145.418 99.6738 144.382 105.152 141.229 109.11C137.957 113.22 132.84 115.428 126.31 115.428C117.848 115.428 110.155 110.978 105.992 102.768C103.491 97.8344 102.164 91.803 102.164 85.0744C102.164 84.819 102.168 84.5619 102.176 84.3031C101.274 84.3411 100.355 84.3831 99.4182 84.4285C97.4332 84.5246 95.4019 84.6293 93.3087 84.6293C79.8827 84.6293 68.4415 90.0152 68.4415 102.261C68.4415 113.626 76.5167 121.919 88.2435 121.919C102.091 121.919 113.111 111.411 116.892 94.6368C125.753 97.2604 133.877 94.6859 141.537 88.9883Z" fill="currentColor"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>