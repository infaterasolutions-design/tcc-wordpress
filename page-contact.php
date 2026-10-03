<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<main id="main" class="site-main" style="background-color: #faf9f6; min-height: 100vh; padding-top: 60px;">
	
	<!-- Clean Typography Header -->
	<section style="text-align: center; padding: 2rem 20px 1rem 20px;">
		<h1 style="font-family: 'Playfair Display', serif; font-size: clamp(3rem, 8vw, 5rem); font-weight: 400; font-style: italic; color: #000; margin: 0;">Get in Touch</h1>
		<div style="width: 60px; height: 1px; background-color: #EC9277; margin: 1.5rem auto 0 auto;"></div>
	</section>

	<div style="max-width: 1100px; margin: 0 auto; padding: 1rem 20px 4rem 20px;" class="contact-layout">
		
		<style>
			.contact-layout {
				display: grid;
				grid-template-columns: 1fr 1fr;
				gap: 4rem;
				align-items: start;
			}
			
			.contact-info-col { padding-right: 2rem; }
			.contact-form-col { background: #fff; padding: 4rem 3rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border-radius: 8px; }

			@media(max-width: 900px) {
				.contact-layout { grid-template-columns: 1fr; gap: 2rem; }
				.contact-info-col { padding-right: 0; text-align: center; }
				.contact-info-col .social-links { justify-content: center; }
				.contact-form-col { padding: 2rem 1.5rem; }
			}
			
			.contact-form-group {
				position: relative;
				margin-bottom: 2.5rem;
			}
			.contact-form-input {
				width: 100%;
				background: transparent;
				border: none;
				border-bottom: 1px solid #ccc;
				padding: 10px 0;
				font-family: 'Inter', sans-serif;
				font-size: 0.95rem;
				color: #000;
				outline: none;
				transition: border-color 0.3s ease;
				border-radius: 0;
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
				top: -18px;
				font-size: 0.7rem;
				color: #000;
			}
			.contact-submit-btn {
				background: #000;
				color: #fff;
				border: none;
				padding: 1rem 0;
				width: 100%;
				font-family: 'Inter', sans-serif;
				font-size: 0.85rem;
				letter-spacing: 0.15em;
				text-transform: uppercase;
				cursor: pointer;
				transition: background 0.3s ease;
				position: relative;
				overflow: hidden;
				border-radius: 4px;
				font-weight: 600;
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
		<div class="contact-info-col">
			<h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 400; line-height: 1.2; margin-bottom: 1.5rem; color: #000;">
				We'd love to hear from you.
			</h2>
			<div style="font-family: 'Inter', sans-serif; font-size: 1rem; line-height: 1.8; color: #555; margin-bottom: 3rem;">
				<?php 
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							$content = get_the_content();
							if (!empty(trim(strip_tags($content)))) {
								the_content();
							} else {
								echo "<p>Whether you have a question about styling, a business inquiry, or just want to say hi, feel free to drop a message using the form. We try our best to respond within 48 hours.</p>";
							}
						}
					}
				?>
			</div>
			
			<div style="margin-bottom: 2.5rem;">
				<h4 style="font-family: 'Inter', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #888; margin-bottom: 0.5rem; font-weight: 600;">Direct Email</h4>
				<a href="mailto:thecombocloset111@gmail.com" style="font-family: 'Inter', sans-serif; font-size: 1.1rem; color: #000; text-decoration: none; font-weight: 500;">
					thecombocloset111@gmail.com
				</a>
			</div>
			
			<div>
				<h4 style="font-family: 'Inter', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: #888; margin-bottom: 1rem; font-weight: 600;">Follow</h4>
				<div class="social-links" style="display: flex; gap: 1.5rem; color: #000; align-items: center;">
					<a href="https://www.instagram.com/thecombocloset/" target="_blank" style="color: inherit; transition: color 0.2s;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
					<a href="https://www.pinterest.com/" target="_blank" style="color: inherit; transition: color 0.2s;"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="10" x2="12" y2="22"></line><path d="M12 10a4 4 0 0 0-4 4c0 1.5.8 2.5 1 3l1-4a4 4 0 0 1 4-4 4 4 0 0 1 4 4 4 4 0 0 1-8 0"></path><circle cx="12" cy="12" r="10"></circle></svg></a>
				</div>
			</div>
		</div>

		<!-- Right Column: Form -->
		<div class="contact-form-col">
			
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
					<textarea id="contact_message" name="message" class="contact-form-input" style="min-height: 100px; resize: vertical;" placeholder=" " required></textarea>
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
