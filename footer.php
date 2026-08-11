</div> <!-- .site-wrapper -->

<footer class="site-footer figma-footer">
	<div class="figma-footer-main">
		
		<!-- Left Column: Links -->
		<div class="figma-footer-col figma-footer-col-left">
			<nav class="figma-footer-nav">
				<a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">ABOUT US</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">CONTACT</a>
				<a href="<?php echo esc_url( home_url( '/disclaimer/' ) ); ?>">DISCLAIMER</a>
				<a href="<?php echo esc_url( home_url( '/privacy-policy-affiliate-disclosure/' ) ); ?>">PRIVACY POLICY & AFFILIATE DISCLOSURE</a>
				<a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">TERMS AND CONDITIONS</a>
			</nav>
		</div>

		<!-- Vertical Divider -->
		<div class="figma-footer-divider"></div>

		<!-- Middle Column: Branding -->
		<div class="figma-footer-col figma-footer-col-middle">
			<div class="figma-footer-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo flex items-center" style="margin-bottom: 15px;">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center header-logo-link" style="gap: 0.5rem; text-decoration: none; margin-bottom: 15px;">
						<span class="text-script header-logo-tcc" style="font-size: 2.5rem; color: #b0afa9; line-height: 1;">tcc</span>
						<span class="text-serif header-logo-text" style="font-size: 1.5rem; font-weight: bold; letter-spacing: -0.5px; color: #000;">the combo closet</span>
					</a>
				<?php endif; ?>
			</div>
			<div class="figma-footer-social">
				<a href="#" aria-label="Instagram">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
					  <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
					  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
					  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
					</svg>
				</a>
				<a href="#" aria-label="Pinterest">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
					  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.168 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.592 0 12.017 0z"/>
					</svg>
				</a>
			</div>
		</div>

		<!-- Vertical Divider -->
		<div class="figma-footer-divider"></div>

		<!-- Right Column: Newsletter -->
		<div class="figma-footer-col figma-footer-col-right">
			<h3 class="newsletter-title">Elevate your inbox</h3>
			<p class="newsletter-desc">Join the tcc newsletter community to receive exclusive content.</p>
			<!-- Reusing the newsletter form logic -->
			<form class="newsletter-form" action="#" method="post">
				<input type="text" placeholder="First name" required />
				<input type="email" placeholder="Email address" required />
				<button type="submit">SUBSCRIBE</button>
			</form>
		</div>
	</div>

	<!-- Back to Top Button (Stuck to right edge of footer) -->
	<button id="back-to-top" class="figma-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
		<span>back to top</span>
		<svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		  <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#3C3C3C" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</button>

	<!-- Bottom Bar -->
	<div class="figma-footer-bottom">
		<p>&copy; <?php echo date('Y'); ?> THE COMBO CLOSET&reg; &nbsp;|&nbsp; <a href="<?php echo esc_url( home_url( '/privacy-policy-affiliate-disclosure/' ) ); ?>">PRIVACY POLICY</a> &nbsp;|&nbsp; SITE CREDIT</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
