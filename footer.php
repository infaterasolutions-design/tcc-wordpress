</div> <!-- .site-wrapper -->

<footer class="site-footer">
	<style>
		@media (max-width: 900px) {
			.footer-columns-container { flex-direction: column !important; gap: 2.5rem !important; align-items: center; text-align: center; }
			.footer-column { align-items: center !important; }
			.footer-bottom-bar { flex-direction: column !important; text-align: center; gap: 1rem !important; }
			.footer-bottom-links { justify-content: center !important; }
			.footer-logo { font-size: 3.5rem !important; }
			.footer-logo-row { flex-direction: column !important; text-align: center !important; gap: 1rem !important; }
			.footer-logo-line { display: none !important; }
			.back-to-top-container { width: 100%; display: flex; justify-content: center; margin-top: 1rem; }
			.footer-layout-row { flex-direction: column !important; align-items: center !important; }
		}
	</style>
	<div class="footer-container">
		
		<!-- Top section: Logo and Line -->
		<div class="footer-logo-row">
			<h2 class="text-serif footer-logo">tcc</h2>
			<div class="footer-logo-line"></div>
		</div>

		<!-- Columns and Button section -->
		<div class="footer-layout-row">
			
			<!-- 5 Columns Container -->
			<div class="footer-columns-container">
				<!-- Column 1 -->
				<div class="footer-column">
					<h4>Blog</h4>
					<a href="#">About</a>
					<a href="#">Contact</a>
					<a href="#">Subscribe</a>
					<a href="#">Partner</a>
				</div>
				<!-- Column 2 -->
				<div class="footer-column">
					<h4>Shop</h4>
					<a href="#">Recent Outfits</a>
					<a href="#">By Instagram</a>
					<a href="#">Amy's Picks</a>
					<a href="#">Liketoknow.it</a>
				</div>
				<!-- Column 3 -->
				<div class="footer-column">
					<h4>Browse</h4>
					<a href="#">Style</a>
					<a href="#">Beauty</a>
					<a href="#">Travel</a>
					<a href="#">Lifestyle</a>
				</div>
				<!-- Column 4 -->
				<div class="footer-column">
					<h4>Connect</h4>
					<a href="#">Instagram</a>
					<a href="#">Liketoknow.it</a>
					<a href="#">Pinterest</a>
					<a href="#">Facebook</a>
				</div>
				<!-- Column 5 -->
				<div class="footer-column">
					<h4>Subscribe</h4>
					<a href="#">Newsletter</a>
					<a href="#">RSS Feed</a>
					<a href="#">Bloglovin'</a>
					<a href="#">Feedly</a>
				</div>
			</div>

			<!-- Back to top button -->
			<div class="back-to-top-container">
				<button id="back-to-top" class="text-sans uppercase back-to-top-btn">
					Back to Top ^
				</button>
			</div>

		</div>
	</div>

	<!-- Bottom Black Bar -->
	<div class="footer-bottom-wrapper">
		<div class="footer-bottom-bar">
			
			<!-- Left Links -->
			<div class="footer-bottom-links">
				<a href="#" class="text-sans uppercase footer-bottom-link">Terms of Use</a>
				<a href="#" class="text-sans uppercase footer-bottom-link">Privacy Policy</a>
				<span class="text-sans uppercase footer-bottom-link">&copy; <?php echo date('Y'); ?> All Rights Reserved</span>
			</div>

			<!-- Right Link -->
			<div class="text-sans uppercase footer-bottom-link">
				
			</div>

		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
