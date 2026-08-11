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
				<h2 class="branding-logo">tcc</h2>
			</div>
			<div class="figma-footer-social">
				<a href="#">INSTAGRAM</a>
				<a href="#">PINTEREST</a>
				<a href="#">TIKTOK</a>
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
		&rarr;
	</button>

	<!-- Bottom Bar -->
	<div class="figma-footer-bottom">
		<p>&copy; <?php echo date('Y'); ?> THE COMBO CLOSET&reg; &nbsp;|&nbsp; <a href="<?php echo esc_url( home_url( '/privacy-policy-affiliate-disclosure/' ) ); ?>">PRIVACY POLICY</a> &nbsp;|&nbsp; SITE CREDIT</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
