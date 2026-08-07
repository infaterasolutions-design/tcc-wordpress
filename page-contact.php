<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<main id="main" class="site-main" style="background-color: #faf9f6; min-height: 100vh;">
	
	<!-- Hero Section -->
	<section style="position: relative; width: 100vw; max-width: 100%; height: 60vh; min-height: 400px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 4rem;">
		<!-- Background Image -->
		<?php 
			$hero_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=2000';
			echo tcc_get_picture_tag($hero_img, 'Contact', '', 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;');
		?>
		<!-- Overlay -->
		<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); z-index: 2;"></div>
		
		<!-- Text -->
		<div style="position: relative; z-index: 3; text-align: center;">
			<h1 class="text-script" style="font-size: clamp(4rem, 12vw, 150px); color: #fff; line-height: 0.8; font-weight: 300; text-shadow: 0 4px 20px rgba(0,0,0,0.2); transform: rotate(-5deg);">get in touch</h1>
		</div>
	</section>

	<div style="max-width: 1240px; margin: 0 auto; padding: 0 20px 6rem; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;" class="contact-grid">
		
		<style>
			@media(max-width: 900px) {
				.contact-grid { grid-template-columns: 1fr !important; gap: 2rem !important; }
			}
			.contact-form-group {
				position: relative;
				margin-bottom: 2rem;
			}
			.contact-form-input {
				width: 100%;
				background: transparent;
				border: none;
				border-bottom: 1px solid #000;
				padding: 10px 0;
				font-family: 'Inter', sans-serif;
				font-size: 0.85rem;
				color: #000;
				outline: none;
				transition: border-color 0.3s ease;
			}
			.contact-form-input:focus {
				border-bottom-color: #EC9277;
			}
			.contact-form-label {
				position: absolute;
				top: 10px;
				left: 0;
				font-family: 'Inter', sans-serif;
				font-size: 0.85rem;
				letter-spacing: 0.1em;
				text-transform: uppercase;
				color: #888;
				pointer-events: none;
				transition: 0.3s ease all;
			}
			.contact-form-input:focus ~ .contact-form-label,
			.contact-form-input:not(:placeholder-shown) ~ .contact-form-label {
				top: -15px;
				font-size: 0.65rem;
				color: #000;
			}
			.contact-submit-btn {
				background: #000;
				color: #fff;
				border: none;
				padding: 1rem 2.5rem;
				font-family: 'Inter', sans-serif;
				font-size: 0.75rem;
				letter-spacing: 0.15em;
				text-transform: uppercase;
				cursor: pointer;
				transition: background 0.3s ease;
				position: relative;
				overflow: hidden;
			}
			.contact-submit-btn:hover {
				background: #EC9277;
			}
			.spinner {
				display: none;
				width: 20px;
				height: 20px;
				border: 2px solid #fff;
				border-top: 2px solid transparent;
				border-radius: 50%;
				animation: spin 1s linear infinite;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}
			@keyframes spin {
				0% { transform: translate(-50%, -50%) rotate(0deg); }
				100% { transform: translate(-50%, -50%) rotate(360deg); }
			}
			.contact-submit-btn.loading {
				color: transparent;
			}
			.contact-submit-btn.loading .spinner {
				display: block;
			}
			.success-msg {
				display: none;
				background: #d4edda;
				color: #155724;
				padding: 1rem;
				margin-bottom: 2rem;
				font-family: 'Inter', sans-serif;
				font-size: 0.85rem;
				text-align: center;
				border-radius: 4px;
			}
			.error-msg {
				display: none;
				background: #f8d7da;
				color: #721c24;
				padding: 1rem;
				margin-bottom: 2rem;
				font-family: 'Inter', sans-serif;
				font-size: 0.85rem;
				text-align: center;
				border-radius: 4px;
			}
		</style>

		<!-- Left Column: Info -->
		<div style="padding-right: 2rem;">
			<h2 style="font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem;">
				Hello there!
			</h2>
			<div style="font-family: 'Inter', sans-serif; font-size: 1rem; line-height: 1.8; color: #444; margin-bottom: 3rem;">
				<?php 
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							$content = get_the_content();
							if (!empty(trim(strip_tags($content)))) {
								the_content();
							} else {
								echo "<p>We would love to hear from you! Whether you have a question about styling, a business inquiry, or just want to say hi, feel free to drop a message using the form.</p>";
							}
						}
					}
				?>
			</div>
			
			<div style="margin-bottom: 2rem;">
				<h4 style="font-family: 'Inter', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #000; margin-bottom: 0.5rem; font-weight: bold;">Email</h4>
				<a href="mailto:<?php echo get_option('admin_email'); ?>" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #EC9277; text-decoration: none;">
					<?php echo get_option('admin_email'); ?>
				</a>
			</div>
			
			<div>
				<h4 style="font-family: 'Inter', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #000; margin-bottom: 1rem; font-weight: bold;">Follow</h4>
				<div style="display: flex; gap: 1rem; color: #000;">
					<a href="#" style="color: inherit;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
					<a href="#" style="color: inherit;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5 2.8 12 3 12c.5.1 1.1.2 1.6.1C2 10 2 6 2 6c.6.3 1.2.5 1.9.5C2 5 3 2 4 1c2.6 3.1 6.5 5.1 10.7 5.3.1-2.4 1.9-4.3 4.3-4.3 1.2 0 2.3.5 3.1 1.3 1 .2 1.9-.2 2.9-.8-.3 1-1 1.8-1.9 2.5z"></path></svg></a>
					<a href="#" style="color: inherit;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="10" x2="12" y2="22"></line><path d="M12 10a4 4 0 0 0-4 4c0 1.5.8 2.5 1 3l1-4a4 4 0 0 1 4-4 4 4 0 0 1 4 4 4 4 0 0 1-8 0"></path><circle cx="12" cy="12" r="10"></circle></svg></a>
				</div>
			</div>
		</div>

		<!-- Right Column: Form -->
		<div style="background: #fff; padding: 3rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03);">
			
			<div id="contact-success" class="success-msg">
				Thank you! Your message has been sent successfully. We will be in touch soon.
			</div>
			<div id="contact-error" class="error-msg">
				Oops! Something went wrong. Please try again.
			</div>

			<form id="tcc-contact-form">
				<div class="contact-form-group">
					<input type="text" id="contact_name" name="name" class="contact-form-input" placeholder=" " required>
					<label for="contact_name" class="contact-form-label">Name *</label>
				</div>
				<div class="contact-form-group">
					<input type="email" id="contact_email" name="email" class="contact-form-input" placeholder=" " required>
					<label for="contact_email" class="contact-form-label">Email *</label>
				</div>
				<div class="contact-form-group">
					<input type="text" id="contact_subject" name="subject" class="contact-form-input" placeholder=" ">
					<label for="contact_subject" class="contact-form-label">Subject</label>
				</div>
				<div class="contact-form-group">
					<textarea id="contact_message" name="message" class="contact-form-input" style="min-height: 120px; resize: vertical;" placeholder=" " required></textarea>
					<label for="contact_message" class="contact-form-label">Message *</label>
				</div>
				<button type="submit" id="contact_submit" class="contact-submit-btn">
					<span>Send Message</span>
					<div class="spinner"></div>
				</button>
			</form>
		</div>

	</div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('tcc-contact-form');
	const submitBtn = document.getElementById('contact_submit');
	const successMsg = document.getElementById('contact-success');
	const errorMsg = document.getElementById('contact-error');

	if(form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			
			// Reset states
			submitBtn.classList.add('loading');
			submitBtn.disabled = true;
			successMsg.style.display = 'none';
			errorMsg.style.display = 'none';

			const formData = {
				name: document.getElementById('contact_name').value,
				email: document.getElementById('contact_email').value,
				subject: document.getElementById('contact_subject').value,
				message: document.getElementById('contact_message').value
			};

			fetch('/wp-json/tcc/v1/contact', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': '<?php echo wp_create_nonce("wp_rest"); ?>'
				},
				body: JSON.stringify(formData)
			})
			.then(response => response.json())
			.then(data => {
				submitBtn.classList.remove('loading');
				submitBtn.disabled = false;
				
				if (data.success) {
					successMsg.style.display = 'block';
					form.reset();
				} else {
					errorMsg.style.display = 'block';
					if(data.message) {
						errorMsg.innerText = data.message;
					}
				}
			})
			.catch(error => {
				console.error('Error:', error);
				submitBtn.classList.remove('loading');
				submitBtn.disabled = false;
				errorMsg.style.display = 'block';
			});
		});
	}
});
</script>

<?php get_footer(); ?>
