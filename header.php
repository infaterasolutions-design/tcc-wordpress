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
			.desktop-header-search { display: none !important; }
			.mobile-search-icon { display: block !important; }
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
		<div class="flex items-center gap-sm">

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
			<div class="desktop-header-search" style="margin-right: 1.5rem; position: relative;">
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

						toggle.addEventListener('click', function(e) {
							if (input.style.width === '0px' || input.style.width === '') {
								e.preventDefault();
								input.style.width = '120px';
								input.style.opacity = '1';
								form.style.borderBottomColor = '#ccc';
								input.focus();
								toggle.type = 'submit';
							} else {
								if (input.value.trim() === '') {
									e.preventDefault();
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
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5 2.8 12 3 12c.5.1 1.1.2 1.6.1C2 10 2 6 2 6c.6.3 1.2.5 1.9.5C2 5 3 2 4 1c2.6 3.1 6.5 5.1 10.7 5.3.1-2.4 1.9-4.3 4.3-4.3 1.2 0 2.3.5 3.1 1.3 1 .2 1.9-.2 2.9-.8-.3 1-1 1.8-1.9 2.5z"></path>
				</svg>
			</div>
			<!-- Mobile search icon -->
			<div class="mobile-search-icon" style="display: none; cursor: pointer; font-size: 1.2rem;">
				🔍
			</div>
			<span id="hamburger-icon" class="hamburger-icon" style="font-size: 1.8rem; cursor: pointer; user-select: none; width: 30px; text-align: center;">
				≡
			</span>
		</div>
	</header>

	<!-- Search Overlay -->
	<div id="search-overlay" style="display: none; position: fixed; inset: 0; background-color: rgba(255,255,255,0.98); z-index: 105; flex-direction: column; align-items: center; justify-content: center;">
		<span id="close-search" style="position: absolute; top: 20px; right: 30px; font-size: 2rem; cursor: pointer; color: #000;">✕</span>
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="width: 80%; max-width: 600px; display: flex; border-bottom: 2px solid #000;">
			<input type="search" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" style="flex: 1; padding: 1rem 0; font-size: 2rem; border: none; outline: none; background: transparent; font-family: 'Playfair Display', serif;" />
			<button type="submit" style="padding: 1rem; background: transparent; border: none; font-size: 1.5rem; cursor: pointer;">🔍</button>
		</form>
	</div>

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
					<!-- Twitter (X) -->
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5 2.8 12 3 12c.5.1 1.1.2 1.6.1C2 10 2 6 2 6c.6.3 1.2.5 1.9.5C2 5 3 2 4 1c2.6 3.1 6.5 5.1 10.7 5.3.1-2.4 1.9-4.3 4.3-4.3 1.2 0 2.3.5 3.1 1.3 1 .2 1.9-.2 2.9-.8-.3 1-1 1.8-1.9 2.5z"></path>
					</svg>
				</div>
			</div>
		</div>
	</div>