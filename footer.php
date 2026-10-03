</div> <!-- .site-wrapper -->

<footer id="tcc-footer" class="site-footer figma-footer">
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
				<a href="https://www.instagram.com/thecombocloset/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
					  <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
					  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
					  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
					</svg>
				</a>
				<a href="https://in.pinterest.com/thecombocloset/" target="_blank" rel="noopener noreferrer" aria-label="Pinterest">
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
			<form class="modal-newsletter-form" action="#" method="post">
				<input type="text" placeholder="First name" required />
				<input type="email" placeholder="Email address" required />
				<button type="submit">SUBSCRIBE</button>
			</form>
		</div>
	</div>



	<!-- Bottom Bar -->
	<div class="figma-footer-bottom">
		<p>&copy; <?php echo date('Y'); ?> THE COMBO CLOSET&reg; &nbsp;|&nbsp; <a href="<?php echo esc_url( home_url( '/privacy-policy-affiliate-disclosure/' ) ); ?>">PRIVACY POLICY</a> &nbsp;|&nbsp; SITE CREDIT</p>
	</div>
</footer>

<!-- Shoppable Video Lightbox -->
<div id="tcc-smv-lightbox" class="tcc-smv-lightbox" style="display:none;">
    <div class="tcc-smv-lightbox-overlay"></div>
    <div class="tcc-smv-lightbox-content">
        <button class="tcc-smv-lightbox-close" aria-label="Close">&times;</button>
        <div class="tcc-smv-lightbox-layout">
            <!-- Left: Video Player -->
            <div class="tcc-smv-lightbox-video">
                <div id="tcc-smv-player-container"></div>
            </div>
            <!-- Right: Shop Products -->
            <div class="tcc-smv-lightbox-shop">
                <h3 class="tcc-smv-shop-title">Shop this look</h3>
                <div id="tcc-smv-products-container" class="tcc-smv-products-grid"></div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<style>
/* Back to Top Button */
#tcc-floating-to-top {
    position: fixed;
    bottom: 170px;
    right: 30px;
    width: 45px;
    height: 45px;
    background: #235F6A;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: opacity 0.3s, transform 0.3s, visibility 0.3s, background 0.2s;
    z-index: 1000;
}
#tcc-floating-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
#tcc-floating-to-top:hover {
    background: #1a4a53;
}
@media (max-width: 768px) {
    #tcc-floating-to-top {
        bottom: 160px;
        right: 20px;
        width: 40px;
        height: 40px;
    }
}
</style>

<div id="tcc-floating-to-top" title="Back to Top">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var backToTop = document.getElementById('tcc-floating-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
</script>

<!-- Subscribe Modal -->
<div id="tcc-subscribe-modal" style="display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center;">
	<!-- Overlay -->
	<div style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(4px); cursor: pointer;" onclick="closeSubscribeModal()"></div>
	
	<!-- Modal Content -->
	<div style="position: relative; background: #fff; width: 90%; max-width: 800px; display: flex; border-radius: 12px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); z-index: 10000;">
		
		<!-- Close Button -->
		<button onclick="closeSubscribeModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 24px; cursor: pointer; color: #000; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; z-index: 2;">&times;</button>
		
		<!-- Left: Image (Hidden on small screens) -->
		<div class="modal-img-col" style="flex: 1; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/bg2.png'); background-color: #2F4436; background-size: cover; background-position: center; min-height: 400px; display: flex; align-items: center; padding: 30px;">
			<div style="text-align: left; width: 100%;">
				<span style="font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 600; letter-spacing: 0.1em; color: #DDA89A; text-transform: uppercase; margin-bottom: 12px; display: block;">From Closet to Confidence</span>
				<div style="font-family: 'Playfair Display', serif; font-size: 32px; line-height: 1.1; color: #fff; margin: 0 0 15px 0; font-weight: 400;">
					Outfits<br>
					That Fit<br>
					<span style="font-family: 'Georgia Script', cursive; font-style: italic; color: #ffffff; font-size: 48px; display: block; margin-top: -5px;">Your Life</span>
				</div>
			</div>
		</div>
		
		<!-- Right: Form -->
		<div class="modal-form-col" style="flex: 1; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
			<h2 style="font-family: 'Playfair Display', serif; font-size: 32px; font-style: italic; margin: 0 0 10px 0; color: #000;">Elevate your inbox</h2>
			<p style="font-family: 'Inter', sans-serif; font-size: 14px; color: #555; margin-bottom: 25px; line-height: 1.5;">Join the TCC newsletter community to receive exclusive style tips, early access, and curated outfit inspiration.</p>
			
			<form class="modal-newsletter-form" action="#" method="post" style="display: flex; flex-direction: column; gap: 15px; width: 100%; max-width: 320px;">
				<input type="text" placeholder="First name" required style="width: 100%; border: 1px solid #ccc; padding: 12px 15px; font-family: 'Inter', sans-serif; font-size: 14px; border-radius: 4px; text-align: center;" />
				<input type="email" placeholder="Email address" required style="width: 100%; border: 1px solid #ccc; padding: 12px 15px; font-family: 'Inter', sans-serif; font-size: 14px; border-radius: 4px; text-align: center;" />
				<button type="submit" style="background-color: #000; color: #fff; border: none; padding: 15px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 14px; letter-spacing: 0.05em; text-transform: uppercase; cursor: pointer; border-radius: 4px; transition: background 0.2s;">Subscribe</button>
			</form>
			<p style="font-family: 'Inter', sans-serif; font-size: 11px; color: #999; margin-top: 15px; text-align: center;">We respect your privacy. Unsubscribe at any time.</p>
		</div>
	</div>
</div>

<style>
@media (max-width: 768px) {
	.modal-img-col { display: none !important; }
	.modal-form-col { padding: 40px 25px !important; text-align: center; }
}
</style>

<script>
function openSubscribeModal(e) {
	if(e) e.preventDefault();
	document.getElementById('tcc-subscribe-modal').style.display = 'flex';
	document.body.style.overflow = 'hidden';
	
	// Add a dummy state to history so the back button can be intercepted
	if (window.location.hash !== '#subscribe') {
		window.history.pushState({ modalOpen: true }, '', window.location.pathname + window.location.search + '#subscribe');
	}
}

function closeSubscribeModal(fromPopState = false) {
	document.getElementById('tcc-subscribe-modal').style.display = 'none';
	document.body.style.overflow = '';
	
	// If closed manually via X or overlay, and we have the hash, go back to clear it
	if (!fromPopState && window.location.hash === '#subscribe') {
		window.history.back();
	}
}

window.addEventListener('popstate', function(e) {
	// If the hash is gone, it means the user pressed the back button
	if (window.location.hash !== '#subscribe') {
		var modal = document.getElementById('tcc-subscribe-modal');
		if (modal && modal.style.display === 'flex') {
			closeSubscribeModal(true);
		}
	}
});
</script>


<script>
var tcc_ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
document.querySelectorAll('.newsletter-form, .modal-newsletter-form').forEach(form => {
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		const btn = form.querySelector('button[type="submit"]');
		const inputs = form.querySelectorAll('input');
		const firstName = inputs[0].value;
		const email = inputs[1].value;
		
		const originalText = btn.textContent;
		btn.textContent = 'Wait...';
		btn.disabled = true;

		const formData = new FormData();
		formData.append('action', 'tcc_subscribe');
		formData.append('first_name', firstName);
		formData.append('email', email);

		fetch(tcc_ajax_url, {
			method: 'POST',
			body: formData
		})
		.then(res => res.json())
		.then(res => {
			if(res.success) {
				btn.textContent = 'Subscribed!';
				btn.style.backgroundColor = '#2F4436';
				btn.style.color = '#fff';
				inputs.forEach(i => i.value = '');
			} else {
				alert(res.data);
				btn.textContent = originalText;
				btn.disabled = false;
			}
		})
		.catch(err => {
			alert('Network error.');
			btn.textContent = originalText;
			btn.disabled = false;
		});
	});
});
</script>
</body>
</html>
