<?php
/**
 * The template for displaying all single posts in the new Figma layout.
 */

get_header(); ?>

<style>
/* FAQ Styling */
.tcc-faq-box {
    background: #fff;
    border-radius: 8px;
    padding: 10px 30px;
    margin: 30px 0;
}
.tcc-faq-item {
    border-bottom: 1px solid #EAEBE6;
}
.tcc-faq-item:last-child {
    border-bottom: none;
}
.tcc-faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0;
    cursor: pointer;
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    color: #111;
    transition: opacity 0.2s;
}
.tcc-faq-question:hover {
    opacity: 0.7;
}
.tcc-faq-question svg {
    color: #ccc;
    flex-shrink: 0;
    margin-left: 20px;
}
.tcc-faq-question .faq-icon-minus {
    display: none;
}
.tcc-faq-answer {
    display: none;
    padding-bottom: 24px;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #444;
}
.tcc-faq-item.is-open .faq-icon-plus {
    display: none;
}
.tcc-faq-item.is-open .faq-icon-minus {
    display: block;
}
.tcc-faq-item.is-open .tcc-faq-answer {
    display: block;
}

/* Inline Newsletter Banner */
.tcc-inline-newsletter {
	background-color: #c9d7d1;
	padding: 50px 40px;
	text-align: center;
	margin: 50px 0;
	position: relative;
	z-index: 1;
	transition: box-shadow 0.4s ease;
}
.tcc-inline-newsletter.spotlight {
	box-shadow: 0 0 0 9999px rgba(0,0,0,0.5);
	z-index: 10000;
}
.tcc-inline-newsletter-title {
	font-family: 'Playfair Display', serif;
	font-size: 28px;
	font-weight: 700;
	color: #111;
	margin-bottom: 15px;
}
.tcc-inline-newsletter-desc {
	font-family: 'Inter', sans-serif;
	font-size: 16px;
	line-height: 1.6;
	color: #333;
	margin-bottom: 30px;
	max-width: 550px;
	margin-left: auto;
	margin-right: auto;
}
.tcc-inline-newsletter-form {
	display: flex;
	justify-content: center;
	gap: 12px;
	flex-wrap: wrap;
}
.tcc-inline-newsletter-form input {
	padding: 14px 18px;
	border: 1px solid #778f85;
	background: #fff;
	font-size: 16px;
	color: #333;
	width: 220px;
	text-transform: uppercase;
	letter-spacing: 0.03em;
	outline: none;
	box-sizing: border-box;
}
.tcc-inline-newsletter-form input::placeholder {
	color: #888;
}
.tcc-inline-newsletter-form button {
	padding: 14px 30px;
	background-color: #F1B42F;
	color: #111;
	border: none;
	font-weight: 700;
	font-size: 16px;
	letter-spacing: 0.05em;
	cursor: pointer;
	text-transform: uppercase;
	transition: background 0.2s;
}
.tcc-inline-newsletter-form button:hover {
	background-color: #dda224;
}
@media (max-width: 480px) {
	.tcc-inline-newsletter-form input { width: 100%; }
	.tcc-inline-newsletter-form { flex-direction: column; align-items: center; }
	.tcc-inline-newsletter-form button { width: 100%; }
	.tcc-inline-newsletter { padding: 35px 20px; }
	.tcc-inline-newsletter-title { font-size: 22px; }
}

/* Reset some body/html styles if necessary */
body, html {
	background-color: #E6E8E3 !important; /* Sage/Beige matching Figma */
}

/* Figma Layout Container */
.figma-post-wrapper {
	background-color: #E6E8E3;
	min-height: 100vh;
	padding: 40px 20px 30px 20px;
	display: flex;
	justify-content: center;
	font-family: 'Inter', sans-serif;
}

/* Grid container for perfectly centered content */
.figma-layout-grid {
	display: grid;
	grid-template-columns: 240px minmax(auto, 640px) 240px;
	justify-content: space-between;
	gap: 40px;
	width: 100%;
	max-width: 1240px;
	padding: 0 1rem;
	margin: 0 auto;
	align-items: start;
}

/* Left Sidebar */
.figma-sidebar {
	width: 100%;
	justify-self: start;
	position: sticky;
	top: 120px; /* Accounts for sticky header height */
	max-height: calc(100vh - 140px); /* Ensures it never goes off bottom of screen */
	overflow-y: auto;
	scrollbar-width: none; /* Firefox */
}
.figma-sidebar::-webkit-scrollbar {
	display: none; /* Safari/Chrome */
}

/* Right Sidebar */
.figma-right-sidebar {
	width: 100%;
	justify-self: end;
	display: flex;
	flex-direction: column;
	position: sticky;
	top: 120px;
}
.tcc-newsletter-widget {
	background-color: #c9d7d1;
	padding: 35px 30px;
	text-align: center;
	font-family: 'Inter', sans-serif;
	color: #222;
}
.tcc-newsletter-title {
	font-size: 16px;
	font-weight: 500;
	letter-spacing: 0.05em;
	text-transform: uppercase;
	margin-bottom: 15px;
}
.tcc-newsletter-desc {
	font-size: 16px;
	line-height: 1.5;
	margin-bottom: 25px;
}
.tcc-newsletter-form {
	display: flex;
	flex-direction: column;
	gap: 15px;
}
.tcc-newsletter-input {
	width: 100%;
	padding: 14px 15px;
	background: transparent;
	border: 1px solid #778f85;
	font-size: 16px;
	color: #333;
	outline: none;
	box-sizing: border-box;
}
.tcc-newsletter-input::placeholder {
	color: #66756e;
}
.tcc-newsletter-btn {
	width: 100%;
	padding: 15px;
	background-color: #F1B42F;
	color: #111;
	border: none;
	font-weight: 700;
	font-size: 16px;
	letter-spacing: 0.05em;
	cursor: pointer;
	text-transform: uppercase;
	transition: background 0.2s;
}
.tcc-newsletter-btn:hover {
	background-color: #dda224;
}

/* Guide Box */
.figma-guide-box {
	background-color: #235F6A; /* Dark teal */
	border-radius: 10px;
	padding: 24px;
	margin-bottom: 24px;
	color: #fff;
	box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.figma-guide-box-pre {
	font-size: 10px;
	text-transform: uppercase;
	letter-spacing: 0.05em;
	color: #A5C8C6;
	margin-bottom: 8px;
	font-weight: 600;
}
.figma-guide-box-title {
	font-family: 'Playfair Display', serif;
	font-size: 20px;
	line-height: 1.3;
	margin-bottom: 20px;
	color: #fff;
}
.figma-guide-box-btn {
	display: inline-block;
	background-color: #E81D2C; /* Red */
	color: #fff;
	font-size: 11px;
	font-weight: 700;
	text-transform: uppercase;
	padding: 8px 16px;
	border-radius: 4px;
	text-decoration: none;
	letter-spacing: 0.05em;
}
.figma-guide-box-btn:hover {
	background-color: #c91724;
	color: #fff;
}

/* TOC Box (White Box) */
.figma-toc-box {
	background-color: #fffdfa;
	border-radius: 8px;
	padding: 24px 16px;
	box-shadow: none; /* Removing shadow to match flat design if applicable */
	margin-bottom: 24px;
}
.figma-toc-box .tcc-toc-container {
	margin: 0 !important;
	padding: 0 !important;
	border: none !important;
	background: transparent !important;
}
.figma-toc-box .tcc-toc-title {
	font-family: 'Playfair Display', serif;
	font-size: 21px;
	color: #1A1A1A;
	margin-bottom: 20px;
	border: none;
	padding: 0;
	font-weight: 500;
	letter-spacing: -0.01em;
}
.figma-toc-box .tcc-toc-list {
	list-style: none !important;
	margin: 0 !important;
	padding: 0 !important;
}
.figma-toc-box .tcc-toc-item {
	padding: 0 0 10px 0 !important;
	margin: 0 !important;
	display: flex;
	align-items: flex-start;
	cursor: pointer;
}
.figma-toc-box .tcc-toc-item::before {
	content: '◆';
	color: #B8B8B8;
	font-size: 16px;
	margin-right: 10px;
	margin-top: 3px;
	display: inline-block;
	flex-shrink: 0;
	transition: color 0.2s ease;
}
.figma-toc-box .tcc-toc-item a {
	font-family: 'Avenir', 'Montserrat', 'Proxima Nova', sans-serif;
	font-size: 15px;
	line-height: 1.4;
	color: #555;
	text-decoration: none;
	font-weight: 400; 
	transition: color 0.2s ease;
}
.figma-toc-box .tcc-toc-item:hover::before,
.figma-toc-box .tcc-toc-item:hover a,
.figma-toc-box .tcc-toc-item a:hover {
	color: #235F6A; /* Theme Green */
}
.figma-toc-box .tcc-toc-item.active::before,
.figma-toc-box .tcc-toc-item.active a {
	color: #235F6A !important;
	font-weight: 600 !important;
}
.figma-toc-box .tcc-toc-item-h3 {
	padding-left: 15px !important;
}
.figma-toc-box .tcc-toc-expand {
	display: none !important; 
}
.figma-toc-box .tcc-toc-hidden-item {
	display: flex !important; 
}

/* Scrollable TOC List */
.figma-toc-box .tcc-toc-list {
	max-height: calc(100vh - 500px); /* Dynamically scales down on small laptops */
	min-height: 150px;
	overflow-y: auto;
	padding-right: 10px !important;
	
	/* Firefox */
	scrollbar-width: thin;
	scrollbar-color: #E0E0E0 transparent;
}
/* Webkit (Chrome/Safari) */
.figma-toc-box .tcc-toc-list::-webkit-scrollbar {
	width: 6px;
}
.figma-toc-box .tcc-toc-list::-webkit-scrollbar-track {
	background: transparent;
}
.figma-toc-box .tcc-toc-list::-webkit-scrollbar-thumb {
	background: #D0D0D0;
	border-radius: 6px;
}
.figma-share-box {
	display: flex;
	align-items: center;
	gap: 15px;
	padding: 0 10px;
}
.figma-share-text {
	font-size: 16px;
	color: #666;
}
.figma-share-icons {
	display: flex;
	gap: 10px;
}
.figma-share-icons svg {
	width: 20px;
	height: 20px;
	fill: #A0A0A0;
	cursor: pointer;
	transition: fill 0.2s ease;
}
.figma-share-icons svg:hover {
	fill: #000;
}

/* Main Content area */
.figma-post-container {
	grid-column: 2;
	width: 100%;
	max-width: 680px; 
}

/* Breadcrumb */
.figma-post-breadcrumb {
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	text-transform: uppercase;
	letter-spacing: 0.1em;
	color: #666;
	margin-bottom: 25px;
}
.figma-post-breadcrumb a {
	color: #666;
	text-decoration: none;
}
.figma-post-breadcrumb a:hover {
	color: #000;
}

/* Title */
.figma-post-title {
	font-family: 'Playfair Display', serif;
	font-size: 42px;
	font-weight: 400;
	line-height: 1.15;
	color: #2C2C2C;
	margin: 0 0 15px 0;
}

/* Meta */
.figma-post-meta {
	font-size: 15px;
	color: #555;
	margin-bottom: 15px;
	display: flex;
	gap: 10px;
	align-items: center;
}
.figma-post-meta strong {
	font-weight: 600;
}
.figma-post-meta a {
	color: inherit;
	text-decoration: none;
}
.figma-post-meta a:hover {
	text-decoration: underline;
}

/* Disclosure */
.figma-post-disclosure {
	font-size: 11px;
	color: #777;
	margin-bottom: 30px;
	line-height: 1.5;
}
.figma-post-disclosure a {
	color: #555;
	text-decoration: underline;
}

/* Featured Image */
.figma-post-image {
	margin-bottom: 40px;
	width: 100%;
}
.figma-post-image img {
	width: 100%;
	height: auto;
	border-radius: 4px;
	display: block;
}
.figma-post-image-caption {
	font-size: 11px;
	color: #888;
	margin-top: 8px;
	text-align: left;
}

/* Content Area */
.figma-post-content {
	font-family: 'Inter', sans-serif;
	font-size: 15px;
	line-height: 1.7;
	color: #333;
}

.figma-post-content h2, .figma-post-content h3, .figma-post-content h4 {
	font-family: 'Playfair Display', serif;
	color: #2C2C2C;
	margin-top: 40px;
	margin-bottom: 15px;
	font-weight: 500;
}
.figma-post-content h2 {
	font-size: 28px !important;
}
.figma-post-content h3 {
	font-size: 28px !important;
}

.figma-post-content p {
	margin-bottom: 25px;
}

/* Gutenberg Drop Cap Styling */
.figma-post-content .wp-block-image,
.figma-post-content .wp-block-image figure {
    position: relative;
}
.figma-post-content p.has-drop-cap:not(:focus)::first-letter {
	float: left;
	font-size: 60px;
	line-height: 0.8;
	padding-top: 4px;
	padding-right: 8px;
	font-family: 'Playfair Display', serif;
	font-weight: 700;
	color: #2C2C2C;
	text-transform: uppercase;
}
.figma-post-content img {
	max-width: 100%;
	height: auto;
	margin-bottom: 10px;
	border-radius: 4px;
}

/* Hide original TOC inside content */
.figma-post-content .tcc-toc-container {
	display: none !important;
}

@media (max-width: 1240px) {
	.figma-layout-grid {
		grid-template-columns: 240px minmax(auto, 640px);
		justify-content: center;
	}
	.figma-right-sidebar {
		display: none;
	}
}

@media (max-width: 1024px) {
	.figma-layout-grid {
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.figma-sidebar {
		display: none !important; /* Hide sidebar completely on mobile to prevent top gap */
	}
	.figma-post-container {
		grid-column: auto;
		width: 100%;
	}
}

@media (max-width: 768px) {
	.figma-post-wrapper {
		padding: 20px 15px;
	}
	.figma-post-title {
		font-size: 32px;
	}
}
/* Figma Image Layout */
.figma-post-content .wp-block-image {
	margin-top: 30px !important;
	margin-bottom: 5px !important;
}
.figma-post-content .wp-block-image figure {
	position: relative;
	margin: 0;
	border-radius: 12px;
	overflow: hidden;
}
.figma-post-content .wp-block-image img {
	display: block;
	width: 100% !important;
	max-width: 100% !important;
	height: auto;
	border-radius: 12px;
	margin: 0 !important;
}
.figma-post-content .tcc-pin-btn,
.figma-post-content .tcc-pin-wrapper .tcc-pin-btn {
	display: none !important;
}
.figma-pin-btn {
	position: absolute;
	top: 15px;
	right: 15px;
	background-color: #E60023 !important;
	background-image: none !important;
	color: #fff !important;
	font-family: 'Inter', sans-serif;
	font-size: 16px;
	font-weight: 600;
	padding: 10px 20px;
	border-radius: 8px;
	text-decoration: none !important;
	display: flex;
	align-items: center;
	gap: 8px;
	opacity: 0;
	transition: opacity 0.3s ease;
	z-index: 10;
}
.figma-post-content .wp-block-image:hover .figma-pin-btn {
	opacity: 1;
}
.figma-pin-btn svg {
	fill: currentColor;
}
.figma-img-source-overlay {
	position: absolute;
	bottom: 15px;
	left: 15px;
	color: #fff;
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	font-weight: 500;
	text-shadow: 0 1px 3px rgba(0,0,0,0.8);
	z-index: 2;
}
.figma-img-caption-below {
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	color: #666;
	margin-top: 5px;
	margin-bottom: 40px;
}
.figma-img-caption-below a {
	color: #666;
	text-decoration: underline;
}
.tcc-zoom-badge {
	position: absolute;
	bottom: 15px;
	right: 15px;
	background-color: rgba(45, 38, 38, 0.95);
	color: #fff;
	padding: 8px 16px;
	border-radius: 20px;
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	display: flex;
	align-items: center;
	gap: 6px;
	pointer-events: none;
	opacity: 0;
	transition: opacity 0.3s;
	z-index: 5;
}
.wp-block-image:hover .tcc-zoom-badge,
.tcc-img-overlay-wrapper:hover .tcc-zoom-badge {
	opacity: 1;
}
.tcc-lightbox {
	position: fixed;
	top: 0; left: 0; right: 0; bottom: 0;
	background: rgba(0,0,0,0.9);
	z-index: 999999;
	display: flex;
	align-items: center;
	justify-content: center;
	opacity: 0;
	visibility: hidden;
	transition: all 0.3s ease;
	cursor: zoom-out;
}
.tcc-lightbox.active {
	opacity: 1;
	visibility: visible;
}
.tcc-lightbox img {
	max-width: 90vw;
	max-height: 90vh;
	object-fit: contain;
	transform: scale(0.95);
	transition: transform 0.3s ease;
	border-radius: 8px;
}
.tcc-lightbox.active img {
	transform: scale(1);
}
.tcc-lightbox-close {
	position: absolute;
	top: 20px;
	right: 30px;
	color: #fff;
	font-size: 40px;
	cursor: pointer;
}

/* Gallery Peek Carousel Layout */
.tcc-carousel-wrapper {
	position: relative;
	margin-bottom: 40px;
}
.figma-post-content .wp-block-gallery {
	display: flex !important;
	flex-wrap: nowrap !important;
	overflow-x: auto !important;
	scroll-snap-type: x mandatory !important;
	scrollbar-width: none;
	-webkit-overflow-scrolling: touch;
	gap: 15px !important;
	margin: 0 0 10px 0 !important;
	padding: 0 !important;
}
.figma-post-content .wp-block-gallery::-webkit-scrollbar {
	display: none;
}
.figma-post-content .wp-block-gallery .wp-block-image {
	flex: 0 0 90% !important; /* 90% width creates the peek effect */
	scroll-snap-align: start !important;
	margin: 0 !important;
	width: auto !important;
}
/* Affiliate Slider Override (4 items on desktop, 1 on mobile) */
.figma-post-content .wp-block-gallery.affiliate-slider .wp-block-image {
	flex: 0 0 calc((100% - 45px) / 4) !important;
}
@media (max-width: 768px) {
	.figma-post-content .wp-block-gallery.affiliate-slider .wp-block-image {
		flex: 0 0 100% !important;
		text-align: center;
	}
	.figma-post-content .wp-block-gallery.affiliate-slider .wp-block-image a {
		display: block;
	}
	.figma-post-content .wp-block-gallery.affiliate-slider .wp-block-image img {
		max-width: 160px !important;
		margin: 0 auto !important;
	}
}
.affiliate-slider-wrapper .tcc-carousel-caption-row {
	display: none !important;
}
.affiliate-slider-wrapper .tcc-carousel-arrow {
	background: transparent !important;
	color: #333 !important;
}
.affiliate-slider-wrapper .tcc-carousel-arrow svg {
	width: 32px;
	height: 32px;
	stroke-width: 1.5;
}
.affiliate-slider-wrapper .tcc-carousel-arrow.prev {
	left: -50px !important;
}
.affiliate-slider-wrapper .tcc-carousel-arrow.next {
	right: -50px !important;
}
.affiliate-slider-wrapper {
	margin-left: 50px;
	margin-right: 50px;
	text-align: center;
	margin-bottom: 50px;
}
.figma-post-content div.affiliate-slider-heading {
	font-family: 'Inter', sans-serif;
	font-size: 18px !important;
	font-weight: 600;
	letter-spacing: 2px;
	text-transform: uppercase;
	color: #032525;
	margin-bottom: 25px;
	margin-top: 20px;
}
.affiliate-slider-crosses {
	color: #B56545;
	font-size: 24px;
	letter-spacing: 8px;
	font-weight: 800;
	margin-top: 15px;
}
@media (max-width: 768px) {
	.affiliate-slider-wrapper {
		margin-left: 0;
		margin-right: 0;
	}
	.affiliate-slider-wrapper .tcc-carousel-arrow.prev {
		left: 0px !important;
		background: transparent !important;
	}
	.affiliate-slider-wrapper .tcc-carousel-arrow.next {
		right: 0px !important;
		background: transparent !important;
	}
}
.tcc-carousel-arrow {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	width: 40px;
	height: 40px;
	background: rgba(0,0,0,0.5);
	color: white;
	border: none;
	border-radius: 4px;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	z-index: 10;
	transition: background 0.3s ease;
}
.tcc-carousel-arrow:hover {
	background: rgba(0,0,0,0.8);
}
.tcc-carousel-arrow.prev { left: 10px; }
.tcc-carousel-arrow.next { right: 10px; }
.tcc-carousel-caption-row {
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	color: #666;
	padding: 0 5px;
}
.tcc-carousel-caption-row a {
	color: #666;
	text-decoration: underline;
}
.carousel-counter-right {
	display: flex;
	align-items: center;
	gap: 5px;
}


/* Mobile TOC Capsule & Overlay */
#mobile-toc-capsule {
	position: fixed;
	bottom: 110px; /* Moved up to avoid ad */
	left: 50%;
	transform: translateX(-50%);
	background: #235F6A; /* Theme color */
	color: white;
	padding: 12px 24px;
	border-radius: 30px;
	font-family: 'Inter', sans-serif;
	font-size: 14px;
	white-space: nowrap;
	font-weight: 500;
	display: none;
	align-items: center;
	gap: 8px;
	z-index: 999999;
	box-shadow: 0 4px 12px rgba(0,0,0,0.3);
	cursor: pointer;
}
@media (max-width: 1024px) {
	#mobile-toc-capsule {
		display: flex;
	}
}
#mobile-toc-overlay {
	position: fixed;
	top: 0; left: 0; right: 0; bottom: 0;
	background: rgba(0,0,0,0.6);
	z-index: 9999999;
	display: none;
	align-items: center; /* Center like a popup */
	justify-content: center;
	padding: 20px; /* Margin on left/right */
}
#mobile-toc-overlay.active {
	display: flex;
}
#mobile-toc-sheet {
	background: #fff;
	width: 100%;
	max-width: 400px;
	max-height: 80vh;
	border-radius: 20px;
	padding: 30px 25px;
	overflow-y: auto;
	position: relative;
	box-shadow: 0 10px 30px rgba(0,0,0,0.2);
	animation: popIn 0.3s ease-out;
}
@keyframes popIn {
	from { transform: scale(0.9); opacity: 0; }
	to { transform: scale(1); opacity: 1; }
}
.mobile-toc-close {
	position: absolute;
	top: 15px;
	right: 20px;
	font-size: 28px;
	color: #666;
	cursor: pointer;
	line-height: 1;
}
.mobile-toc-sheet-title {
	font-family: 'Inter', sans-serif;
	font-size: 22px;
	font-weight: 600;
	color: #032525;
	margin-top: 0;
	margin-bottom: 25px;
}
#mobile-toc-sheet .tcc-toc-list,
#mobile-toc-sheet .tcc-toc-list ul,
#mobile-toc-sheet ul {
	list-style: none !important;
	padding: 0 !important;
	margin: 0 !important;
	display: block !important;
	opacity: 1 !important;
	visibility: visible !important;
}
#mobile-toc-sheet .tcc-toc-item,
#mobile-toc-sheet li {
	margin-bottom: 15px !important;
	display: block !important;
	opacity: 1 !important;
	visibility: visible !important;
}
#mobile-toc-sheet .tcc-toc-item a,
#mobile-toc-sheet li a {
	color: #333 !important;
	text-decoration: none !important;
	font-size: 16px !important;
	font-weight: 500 !important;
	font-family: 'Inter', sans-serif !important;
	display: block !important;
	line-height: 1.4 !important;
}
</style>

<div class="figma-post-wrapper">
	<div class="figma-layout-grid">

		<!-- Left Sidebar -->
		<aside class="figma-sidebar sidebar widget-area" id="figma-sidebar">
			<div class="figma-guide-box">
				<div class="figma-guide-box-pre">THIS POST IS PART OF:</div>
				<div class="figma-guide-box-title">The Ultimate Guide To Wedding Hairstyles</div>
				<a href="#" class="figma-guide-box-btn">VIEW GUIDE</a>
			</div>

			<div class="figma-toc-box" id="sidebar-toc-placeholder">
				<!-- TOC will be injected here via JS -->
				<h2 class="tcc-toc-title">In This Article</h2>
			</div>

			<div class="figma-share-box">
				<span class="figma-share-text">Share</span>
				<div class="figma-share-icons">
					<!-- Facebook -->
					<svg viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.597 1.323-1.324V1.325C24 .597 23.403 0 22.675 0z"/></svg>
					<!-- Pinterest -->
					<svg viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.195 0 7.451 2.991 7.451 6.986 0 4.175-2.632 7.533-6.284 7.533-1.228 0-2.383-.638-2.775-1.391l-.756 2.878c-.274 1.042-1.022 2.348-1.523 3.141 1.198.37 2.469.569 3.784.569 6.621 0 11.988-5.367 11.988-11.987C24.004 5.367 18.638 0 12.017 0z"/></svg>
					<!-- Link -->
					<svg viewBox="0 0 24 24"><path d="M10.59 13.41c.41.39.41 1.03 0 1.42-.39.39-1.03.39-1.42 0a5.003 5.003 0 0 1 0-7.07l3.54-3.54a5.003 5.003 0 0 1 7.07 0 5.003 5.003 0 0 1 0 7.07l-1.49 1.49c.01-.82-.12-1.64-.4-2.42l.47-.48a2.982 2.982 0 0 0 0-4.24 2.982 2.982 0 0 0-4.24 0l-3.53 3.53a2.982 2.982 0 0 0 0 4.24m2.82-4.24c.39-.39 1.03-.39 1.42 0a5.003 5.003 0 0 1 0 7.07l-3.54 3.54a5.003 5.003 0 0 1-7.07 0 5.003 5.003 0 0 1 0-7.07l1.49-1.49c-.01.82.12 1.64.4 2.43l-.47.47a2.982 2.982 0 0 0 0 4.24 2.982 2.982 0 0 0 4.24 0l3.53-3.53a2.982 2.982 0 0 0 0-4.24.973.973 0 0 1 0-1.42z"/></svg>
				</div>
			</div>
		</aside>

		<!-- Main Content -->
		<main id="main" class="site-main figma-post-container">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>">

					<!-- Breadcrumb -->
					<div class="figma-post-breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> &raquo; <?php echo strip_tags( get_the_category_list( ' &raquo; ' ) ); ?>
					</div>

					<!-- Title -->
					<h1 class="figma-post-title">
						<?php the_title(); ?>
					</h1>
					<?php 
					$raw_content = get_post_field('post_content', get_the_ID());
					$img_count = substr_count(strtolower($raw_content), '<img');
					if ($img_count == 0) $img_count = 1; // Fallback to 1 for thumbnail
					
					preg_match_all('/<h[2-3][^>]*>/i', $raw_content, $matches);
					$tip_count = count($matches[0]);
					if ($tip_count == 0) $tip_count = 1; // Fallback
					?>
					<div style="margin-bottom: 15px; font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600; color: #555; text-transform: uppercase; letter-spacing: 0.05em; display: flex; gap: 15px; align-items: center;">
						<span style="display: flex; align-items: center; gap: 6px;">
							<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
							<?php echo $img_count . ($img_count == 1 ? ' PHOTO' : ' PHOTOS'); ?>
						</span>
						<span style="display: flex; align-items: center; gap: 6px;">
							<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
							<?php echo $tip_count . ($tip_count == 1 ? ' PRO TIP' : ' PRO TIPS'); ?>
						</span>
					</div>
					
					<!-- Meta -->
					<div class="figma-post-meta">
						<span>By <strong><?php the_author_posts_link(); ?></strong></span> 
						<span>|</span> 
						<span><?php echo get_the_date(); ?></span>
					</div>

					<!-- Disclosure -->
					<div class="figma-post-disclosure">
						Contains affiliate links. <a href="<?php echo esc_url( home_url( '/privacy-policy-affiliate-disclosure/' ) ); ?>">Read our disclosure policy.</a>
					</div>


					<!-- Content -->
					<div class="figma-post-content tiptap-content entry-content post-content article-body" id="figma-post-content">
						

						<?php the_content(); ?>
							<?php if ( is_single() && strpos($_SERVER['REQUEST_URI'], 'spring-outfits-for-black-women-everyday-style') !== false ) : ?>
							<figure class="wp-block-gallery affiliate-slider has-nested-images columns-default is-cropped">
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-49-820x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-48-819x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-47-901x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-49-820x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-48-819x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-47-901x1024.jpeg" alt=""></a></figure>
								<figure class="wp-block-image size-large"><a href="#"><img src="https://staging.thecombocloset.com/wp-content/uploads/2025/10/image-49-820x1024.jpeg" alt=""></a></figure>
							</figure>
							<?php endif; ?>
						

					</div>

				</article>

			<?php endwhile; ?>

<!-- COMMENTS SECTION -->
<style>
.tcc-comments-section {
	max-width: 680px;
	margin: 20px auto 60px auto;
	padding: 0 20px;
	display: none; /* Hidden by default */
}
.tcc-comments-toggle {
	max-width: 680px;
	margin: 20px auto 0 auto;
	padding: 20px 10px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	display: flex;
	justify-content: space-between;
	align-items: center;
	cursor: pointer;
	font-family: 'Inter', sans-serif;
	font-weight: 600;
	font-size: 15px;
	letter-spacing: 0.05em;
	color: #4A3C3C;
	transition: background 0.2s;
}
.tcc-comments-toggle:hover {
	background-color: #fafafa;
}
.tcc-comments-toggle .icon {
	font-size: 24px;
	font-weight: 300;
	line-height: 1;
}
.tcc-comments-section h2 {
	font-family: 'Playfair Display', serif;
	font-size: 32px;
	font-weight: 500;
	color: #111;
	margin-bottom: 40px;
}
.tcc-comments-section .comment-list {
	list-style: none;
	padding: 0;
	margin: 0 0 50px 0;
}
.tcc-comments-section .comment {
	border-bottom: 1px solid #ddd;
	padding: 25px 0;
}
.tcc-comments-section .comment:last-child {
	border-bottom: none;
}
.tcc-comments-section .comment-author {
	display: flex;
	align-items: center;
	gap: 12px;
	margin-bottom: 10px;
}
.tcc-comments-section .comment-author img {
	border-radius: 50%;
	width: 40px;
	height: 40px;
}
.tcc-comments-section .comment-author .fn {
	font-family: 'Inter', sans-serif;
	font-weight: 600;
	font-size: 15px;
	color: #111;
}
.tcc-comments-section .comment-metadata {
	font-family: 'Inter', sans-serif;
	font-size: 12px;
	color: #888;
	margin-bottom: 12px;
}
.tcc-comments-section .comment-metadata a {
	color: #888;
	text-decoration: none;
}
.tcc-comments-section .comment-content p {
	font-family: 'Inter', sans-serif;
	font-size: 15px;
	line-height: 1.7;
	color: #444;
}
.tcc-comments-section .comment-reply-link {
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	color: #235F6A;
	text-decoration: none;
	font-weight: 500;
}
.tcc-comments-section .comment-reply-link:hover {
	text-decoration: underline;
}
.tcc-comments-section .children {
	list-style: none;
	padding-left: 40px;
	margin: 0;
}
/* Comment Form */
.tcc-comments-section #comments {
	margin-top: 20px !important;
	padding-top: 0 !important;
	border-top: none !important;
}
.tcc-comments-section .comment-respond {
	margin-top: 0 !important;
}
.tcc-comments-section .comment-reply-title {
	font-family: 'Playfair Display', serif;
	font-size: 26px;
	font-weight: 500;
	color: #111;
	margin-bottom: 25px;
	margin-top: 0 !important;
}
.tcc-comments-section .comment-form label {
	font-family: 'Inter', sans-serif;
	font-size: 16px;
	color: #555;
	display: block;
	margin-bottom: 6px;
}
.tcc-comments-section .comment-form input[type="text"],
.tcc-comments-section .comment-form input[type="email"],
.tcc-comments-section .comment-form input[type="url"],
.tcc-comments-section .comment-form textarea {
	width: 100%;
	padding: 14px 16px;
	border: 1px solid #ccc;
	font-family: 'Inter', sans-serif;
	font-size: 15px;
	color: #333;
	background: #fff;
	margin-bottom: 20px;
	outline: none;
	box-sizing: border-box;
	transition: border-color 0.2s;
}
.tcc-comments-section .comment-form input:focus,
.tcc-comments-section .comment-form textarea:focus {
	border-color: #235F6A;
}
.tcc-comments-section .comment-form textarea {
	min-height: 150px;
	resize: vertical;
}
.tcc-comments-section .comment-form .submit {
	padding: 15px 40px;
	background-color: #235F6A;
	color: #fff;
	border: none;
	font-family: 'Inter', sans-serif;
	font-weight: 600;
	font-size: 15px;
	letter-spacing: 0.03em;
	cursor: pointer;
	transition: background 0.2s;
}
.tcc-comments-section .comment-form .submit:hover {
	background-color: #1a4a53;
}
.tcc-comments-section .logged-in-as,
.tcc-comments-section .comment-notes {
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	color: #888;
	margin-bottom: 20px;
}
.tcc-comments-section .logged-in-as a,
.tcc-comments-section .comment-notes a {
	color: #235F6A;
}
</style>

<style>
/* Author Box */
.tcc-author-box {
	max-width: 680px;
	margin: 50px auto 0 auto;
	display: flex;
	gap: 30px;
	align-items: flex-start;
}
.tcc-author-avatar img {
	width: 120px;
	height: 120px;
	border-radius: 50%;
	object-fit: cover;
}
.tcc-author-info {
	flex: 1;
}
.tcc-author-name {
	font-family: 'Playfair Display', serif;
	font-size: 32px;
	font-weight: 500;
	color: #4A3C3C;
	margin-top: 0;
	margin-bottom: 15px;
}
.tcc-author-bio {
	font-family: 'Inter', sans-serif;
	font-size: 16px;
	line-height: 1.6;
	color: #444;
	margin-bottom: 20px;
}
.tcc-author-link {
	font-family: 'Inter', sans-serif;
	font-size: 13px;
	font-weight: 700;
	color: #111;
	text-decoration: none;
	text-transform: uppercase;
	letter-spacing: 0.05em;
}
.tcc-author-link:hover {
	text-decoration: underline;
}
@media (max-width: 600px) {
	.tcc-author-box {
		flex-direction: column;
		align-items: center;
		text-align: center;
	}
}
</style>

<?php
$author_id = get_the_author_meta('ID');
$author_name = get_the_author_meta('display_name');
$author_bio = get_the_author_meta('description');
if (empty($author_bio)) {
	$author_bio = "$author_name is a lifestyle and fashion enthusiast sharing tips on how to curate a beautiful wardrobe."; // fallback bio
}
$author_url = get_author_posts_url($author_id);
$author_avatar = get_avatar_url($author_id, ['size' => 120]);
?>
<div class="tcc-author-box">
	<div class="tcc-author-avatar">
		<img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
	</div>
	<div class="tcc-author-info">
		<h3 class="tcc-author-name"><?php echo esc_html($author_name); ?></h3>
		<p class="tcc-author-bio"><?php echo esc_html($author_bio); ?></p>
		<a href="<?php echo esc_url($author_url); ?>" class="tcc-author-link">VIEW PROFILE</a>
	</div>
</div>

<div class="tcc-comments-toggle" id="tcc-comments-toggle">
	<span class="text">SHOW COMMENTS</span>
	<span class="icon">+</span>
</div>

<div class="tcc-comments-section" id="tcc-comments-section">
	<?php
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var toggleBtn = document.getElementById('tcc-comments-toggle');
	var commentsSec = document.getElementById('tcc-comments-section');
	if (toggleBtn && commentsSec) {
		toggleBtn.addEventListener('click', function() {
			var textSpan = toggleBtn.querySelector('.text');
			var iconSpan = toggleBtn.querySelector('.icon');
			
			if (commentsSec.style.display === 'block') {
				commentsSec.style.display = 'none';
				textSpan.textContent = 'SHOW COMMENTS';
				iconSpan.textContent = '+';
			} else {
				commentsSec.style.display = 'block';
				textSpan.textContent = 'HIDE COMMENTS';
				iconSpan.textContent = '-';
			}
		});
	}
});
</script>

			</main>
			
			<!-- Right Sidebar (Newsletter & Ads) -->
			<aside class="figma-right-sidebar sidebar widget-area" id="secondary">
				<div class="tcc-newsletter-widget">
					<div class="tcc-newsletter-title">Join The Newsletter</div>
					<div class="tcc-newsletter-desc">Get weekly decluttering tips straight to your inbox.</div>
					<div class="tcc-newsletter-form">
						<input type="email" class="tcc-newsletter-input" placeholder="Email Address" />
						<button class="tcc-newsletter-btn">Subscribe</button>
					</div>
				</div>
			</aside>
	</div>
</div>
<!-- STORIES YOU MIGHT LIKE SECTION -->
<style>
.wf-related-bg {
    background-color: #EAEBE6;
    padding-bottom: 80px;
    padding-top: 80px;
    margin-top: 40px;
}
.wf-related-header {
    text-align: left;
    padding: 0 60px 40px;
    max-width: 100%;
}
.wf-related-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 500;
    color: #000;
    margin: 0;
}
.wf-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    max-width: 100%;
    padding: 0 60px;
}
.wf-card {
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.wf-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
.wf-card-img-wrap {
    width: 100%;
    aspect-ratio: 3 / 4;
    overflow: hidden;
}
.wf-card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.wf-card:hover .wf-card-img-wrap img {
    transform: scale(1.05);
}
.wf-card-content {
    padding: 24px;
}
.wf-card-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    color: #444;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
    text-transform: uppercase;
}
.wf-card-meta span {
    display: flex;
    align-items: center;
}
.wf-card-meta svg {
    width: 16px;
    height: 16px;
    margin-right: 6px;
    stroke-width: 1.5;
}
.wf-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    line-height: 1.35;
    color: #111;
    font-weight: 500;
    margin: 0;
    transition: color 0.2s ease;
}
.wf-card:hover .wf-card-title {
    color: #235F6A;
    text-decoration: underline;
}

@media (max-width: 1024px) {
    .wf-grid { grid-template-columns: repeat(3, 1fr); padding: 0 40px; }
    .wf-related-header { padding: 0 40px 30px; }
}
@media (max-width: 768px) {
    .wf-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
    .wf-related-header { padding: 0 20px 20px; }
    .wf-related-title { font-size: 26px; }
}
@media (max-width: 480px) {
    .wf-grid { grid-template-columns: 1fr; }
}
</style>

<div class="wf-related-bg">
    <header class="wf-related-header">
        <h2 class="wf-related-title">Stories You Might Like</h2>
    </header>
    <div class="wf-grid">
        <?php
        $related_args = array(
            'post_type' => 'post',
            'posts_per_page' => 12,
            'post__not_in' => array( get_the_ID() ),
            'orderby' => 'rand'
        );
        $related_query = new WP_Query($related_args);
        
        if ( $related_query->have_posts() ) :
            while ( $related_query->have_posts() ) : $related_query->the_post();
            
            // Dynamic count logic
            $raw_content  = get_post_field(\'post_content\', get_the_ID());
            $img_count = substr_count(strtolower($raw_content), '<img');
            if ($img_count == 0) $img_count = 1; // Fallback to 1 for thumbnail
            
            preg_match_all('/<h[2-3][^>]*>/i', $raw_content, $matches);
            $tip_count = count($matches[0]);
            if ($tip_count == 0) $tip_count = 1; // Fallback
        ?>
                <a href="<?php the_permalink(); ?>" class="wf-card">
                    <div class="wf-card-img-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php else : ?>
                            <?php 
                            $dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=600'; 
                            echo '<img src="'.esc_url($dummy_img).'" alt="Placeholder" />';
                            ?>
                        <?php endif; ?>
                    </div>
                    <div class="wf-card-content">
                        <div class="wf-card-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                <?php echo $img_count . ($img_count == 1 ? ' PHOTO' : ' PHOTOS'); ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <?php echo $tip_count . ($tip_count == 1 ? ' PRO TIP' : ' PRO TIPS'); ?>
                            </span>
                        </div>
                        <h2 class="wf-card-title"><?php the_title(); ?></h2>
                    </div>
                </a>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Move TOC from content to sidebar
	const originalTocList = document.querySelector('.figma-post-content .tcc-toc-container .tcc-toc-list');
	const sidebarPlaceholder = document.getElementById('sidebar-toc-placeholder');
	
	if (originalTocList && sidebarPlaceholder) {
		sidebarPlaceholder.appendChild(originalTocList.cloneNode(true));
		// IntersectionObserver to highlight active TOC item
		const tocLinks = sidebarPlaceholder.querySelectorAll('.tcc-toc-item a');
		if (tocLinks.length > 0) {
			const headingElements = [];
			const linkMap = new Map();
			
			tocLinks.forEach(link => {
				const id = link.getAttribute('href').replace('#', '');
				const target = document.getElementById(id);
				if (target) {
					headingElements.push(target);
					linkMap.set(target, link.closest('.tcc-toc-item'));
				}
			});

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						// Remove active class from all
						tocLinks.forEach(l => l.closest('.tcc-toc-item').classList.remove('active'));
						// Add active class to intersecting element
						const activeItem = linkMap.get(entry.target);
						if (activeItem) {
							activeItem.classList.add('active');
							// Auto-scroll TOC box so the active item is visible
							const tocList = sidebarPlaceholder.querySelector('.tcc-toc-list');
							if (tocList) {
								const itemTop = activeItem.offsetTop;
								tocList.scrollTo({ top: itemTop - 40, behavior: 'smooth' });
							}
						}
					}
				});
			}, { rootMargin: '-10% 0px -80% 0px', threshold: 0 });

			headingElements.forEach(el => observer.observe(el));
		}
	} else {
		// If no TOC generated, hide the box
		sidebarPlaceholder.style.display = 'none';
	}


	// Create Mobile Floating TOC Capsule
	if (originalTocList) {
		const mobileCapsule = document.createElement('div');
		mobileCapsule.id = 'mobile-toc-capsule';
		mobileCapsule.innerHTML = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg> Table of Content';
		document.body.appendChild(mobileCapsule);

		const overlay = document.createElement('div');
		overlay.id = 'mobile-toc-overlay';
		
		const sheet = document.createElement('div');
		sheet.id = 'mobile-toc-sheet';
		
		const closeBtn = document.createElement('div');
		closeBtn.className = 'mobile-toc-close';
		closeBtn.innerHTML = '&times;';
		
		const sheetTitle = document.createElement('h3');
		sheetTitle.className = 'mobile-toc-sheet-title';
		sheetTitle.textContent = 'Table of Content';

		sheet.appendChild(closeBtn);
		sheet.appendChild(sheetTitle);
		sheet.appendChild(originalTocList.cloneNode(true));
		overlay.appendChild(sheet);
		document.body.appendChild(overlay);

		mobileCapsule.addEventListener('click', function() {
			overlay.classList.add('active');
		});
		
		overlay.addEventListener('click', function(e) {
			if (e.target === overlay || e.target === closeBtn) {
				overlay.classList.remove('active');
			}
		});

		// Close overlay when a link is clicked
		const sheetLinks = sheet.querySelectorAll('a');
		sheetLinks.forEach(link => {
			link.addEventListener('click', function() {
				overlay.classList.remove('active');
			});
		});
	}
	// Make sidebars fade in when scrolling past the featured image
	const sidebar = document.getElementById('figma-sidebar');
	const rightSidebar = document.querySelector('.figma-right-sidebar');
	const contentDiv = document.getElementById('figma-post-content');
	
	// Get all headings inside the post content for unstick logic
	const postHeadings = contentDiv ? contentDiv.querySelectorAll('h2, h3') : [];
	let rightSidebarUnstuck = false;
	
	if (contentDiv) {
		// Sidebars are now visible from the top
	}

	// Inject inline newsletter banner after the 3rd heading in the content
	const allContentHeadings = contentDiv ? contentDiv.querySelectorAll('h2.wp-block-heading, h3.wp-block-heading') : [];
	if (allContentHeadings.length >= 3) {
		const thirdHeading = allContentHeadings[2];
		const newsletterHTML = `
			<div class="tcc-inline-newsletter" id="tcc-inline-newsletter">
				<div class="tcc-inline-newsletter-title">Grab your FREE capsule wardrobe checklists!</div>
				<div class="tcc-inline-newsletter-desc">Sign up for my weekly simplifying tips, and I'll send you my free capsule wardrobe checklist to help you simplify your clothes.</div>
				<div class="tcc-inline-newsletter-form">
					<input type="text" placeholder="First Name" />
					<input type="email" placeholder="Email Address" />
					<button>Get The Checklists</button>
				</div>
			</div>
		`;
		thirdHeading.insertAdjacentHTML('beforebegin', newsletterHTML);
		
		// Spotlight effect: dim the screen when the newsletter scrolls into view
		const inlineNL = document.getElementById('tcc-inline-newsletter');
		let spotlightTriggered = false;
		
		if (inlineNL) {
			const nlObserver = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting && !spotlightTriggered) {
						spotlightTriggered = true;
						inlineNL.classList.add('spotlight');
						setTimeout(function() {
							inlineNL.classList.remove('spotlight');
						}, 3500);
						nlObserver.disconnect();
					}
				});
			}, { threshold: 0.5 });
			nlObserver.observe(inlineNL);
		}
	}

	// Transform Image Layouts to match Figma (rounded corners, overlay source, pin button)
	const imageBlocks = document.querySelectorAll('.figma-post-content .wp-block-image');
	imageBlocks.forEach(block => {
		const img = block.querySelector('img');
		if (!img) return;
			if (block.closest(".affiliate-slider")) return;


		const figure = block.querySelector('figure') || block;
		
		// Find source paragraph if it exists immediately after
		let nextEl = block.nextElementSibling;
		let sourceLink = null;
		let sourceText = '';
		if (nextEl && nextEl.tagName === 'P' && nextEl.textContent.includes('Source')) {
			const a = nextEl.querySelector('a');
			if (a) {
				sourceLink = a.href;
				sourceText = a.textContent;
				nextEl.style.display = 'none'; // hide original paragraph
			}
		}

		const imgWrapper = document.createElement("div");
		imgWrapper.style.position = "relative";
		imgWrapper.style.display = "inline-block";
		imgWrapper.style.maxWidth = "100%";
		imgWrapper.className = "tcc-img-overlay-wrapper";
		img.parentNode.insertBefore(imgWrapper, img);
		imgWrapper.appendChild(img);
		if (sourceText) {
			// Overlay source on image
			const overlay = document.createElement('div');
			overlay.className = 'figma-img-source-overlay';
			overlay.textContent = sourceText;
			imgWrapper.appendChild(overlay);

			// Caption below image
			const caption = document.createElement('div');
			caption.className = 'figma-img-caption-below';
			caption.innerHTML = `Photo by: <a href="${sourceLink}" target="_blank" rel="nofollow">${sourceText.replace('@','')}</a>`;
			block.parentNode.insertBefore(caption, block.nextSibling);
		}

		// Pin Button
		const pinBtn = document.createElement('a');
		pinBtn.className = 'figma-pin-btn';
		pinBtn.href = `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(window.location.href)}&media=${encodeURIComponent(img.src)}`;
		pinBtn.target = '_blank';
		pinBtn.innerHTML = `Save to <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.195 0 7.451 2.991 7.451 6.986 0 4.175-2.632 7.533-6.284 7.533-1.228 0-2.383-.638-2.775-1.391l-.756 2.878c-.274 1.042-1.022 2.348-1.523 3.141 1.198.37 2.469.569 3.784.569 6.621 0 11.988-5.367 11.988-11.987C24.004 5.367 18.638 0 12.017 0z"/></svg>`;
		imgWrapper.appendChild(pinBtn);
		// Zoom Badge
		const zoomBadge = document.createElement('div');
		zoomBadge.className = 'tcc-zoom-badge';
		zoomBadge.innerHTML = '<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg> Double click to zoom';
		imgWrapper.appendChild(zoomBadge);

		// Double click to zoom event
		img.addEventListener('dblclick', function(e) {
			e.preventDefault();
			if (typeof openTccLightbox === 'function') {
				openTccLightbox(img.src);
			}
		});
	});

	// Initialize Lightbox
	let tccLightbox = document.createElement('div');
	tccLightbox.id = 'tcc-lightbox';
	tccLightbox.className = 'tcc-lightbox';
	tccLightbox.innerHTML = '<div class="tcc-lightbox-close">&times;</div><img src="" alt="Zoomed Image">';
	document.body.appendChild(tccLightbox);

	tccLightbox.addEventListener('click', function() {
		tccLightbox.classList.remove('active');
		if (history.state && history.state.lightboxOpen) {
			history.back();
		}
	});

	window.openTccLightbox = function(src) {
		tccLightbox.querySelector('img').src = src;
		tccLightbox.classList.add('active');
		history.pushState({ lightboxOpen: true }, '', '');
	};

	window.addEventListener('popstate', function(e) {
		if (tccLightbox.classList.contains('active')) {
			tccLightbox.classList.remove('active');
		}
	});

	// Transform WP Gallery into Peek Carousel
	const galleries = document.querySelectorAll('.figma-post-content .wp-block-gallery');
	galleries.forEach((gallery) => {
		// Create wrapper
		const wrapper = document.createElement('div');
		wrapper.className = 'tcc-carousel-wrapper';
			let isAffiliate = gallery.classList.contains('affiliate-slider');
			if (isAffiliate) {
				wrapper.classList.add('affiliate-slider-wrapper');
				const heading = document.createElement('div');
				heading.className = 'affiliate-slider-heading';
				heading.textContent = 'SHOP THIS OUTFIT:';
				wrapper.appendChild(heading);
			}
			gallery.parentNode.insertBefore(wrapper, gallery);
			wrapper.appendChild(gallery);
			if (isAffiliate) {
				const crosses = document.createElement('div');
				crosses.className = 'affiliate-slider-crosses';
				crosses.innerHTML = '&times; &times; &times;';
				wrapper.appendChild(crosses);
			}

		// Add arrows
		const prevBtn = document.createElement('button');
		prevBtn.className = 'tcc-carousel-arrow prev';
		prevBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
		
		const nextBtn = document.createElement('button');
		nextBtn.className = 'tcc-carousel-arrow next';
		nextBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
		
		wrapper.appendChild(prevBtn);
		wrapper.appendChild(nextBtn);

		// Arrow click logic
		prevBtn.addEventListener('click', () => {
			const slideWidth = gallery.querySelector('.wp-block-image').offsetWidth + 15; // + gap
			gallery.scrollBy({ left: -slideWidth, behavior: 'smooth' });
		});
		
		nextBtn.addEventListener('click', () => {
			const slideWidth = gallery.querySelector('.wp-block-image').offsetWidth + 15;
			gallery.scrollBy({ left: slideWidth, behavior: 'smooth' });
		});
		
		const images = gallery.querySelectorAll('.wp-block-image');
		let sourceText = '';
		let nextEl = wrapper.nextElementSibling;
		if (nextEl && nextEl.tagName === 'P' && nextEl.textContent.includes('Source')) {
			const a = nextEl.querySelector('a');
			if (a) {
				sourceText = `<a href="${a.href}" target="_blank" rel="nofollow">${a.textContent.replace('@','')}</a>`;
			}
			nextEl.style.display = 'none';
		}

		// Add Caption Row
		const captionRow = document.createElement('div');
		captionRow.className = 'tcc-carousel-caption-row';
		captionRow.innerHTML = `
			<div class="carousel-source-left">Photo by: ${sourceText}</div>
			<div class="carousel-counter-right"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="counter-text">1 / ${images.length}</span></div>
		`;
		wrapper.parentNode.insertBefore(captionRow, wrapper.nextSibling);

		// Scroll listener for counter
		gallery.addEventListener('scroll', () => {
			const scrollLeft = gallery.scrollLeft;
			const slideWidth = gallery.querySelector('.wp-block-image').offsetWidth + 15;
			const currentIndex = Math.round(scrollLeft / slideWidth) + 1;
			captionRow.querySelector('.counter-text').textContent = `${currentIndex} / ${images.length}`;
		});
	});
});
</script>

<style>
/* Floating Socials */
.tcc-floating-socials {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    background: #fff;
    box-shadow: -2px 0 10px rgba(0,0,0,0.05);
    z-index: 999;
    border-radius: 8px 0 0 8px;
    padding: 10px 5px;
    gap: 10px;
}
.tcc-floating-socials a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: #444;
    transition: background 0.2s, color 0.2s;
    border-radius: 50%;
}
.tcc-floating-socials a:hover {
    background: #f4f4f4;
    color: #235F6A;
}

@media (max-width: 1024px) {
    .tcc-floating-socials {
        display: none; /* Hide on smaller screens */
    }
}
</style>

<div class="tcc-floating-socials">
    <a href="#" target="_blank" title="Pinterest">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.624 0 12.017 0z"></path></svg>
    </a>
    <a href="#" target="_blank" title="Instagram">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
    </a>
    <a href="#" target="_blank" title="Facebook">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.323-1.325z"/></svg>
    </a>
    <a href="#" target="_blank" title="WhatsApp">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652c1.746.957 3.71 1.463 5.704 1.464h.004c6.58 0 11.939-5.336 11.943-11.897 0-3.172-1.24-6.155-3.466-8.466zm-8.475 18.256h-.003c-1.77 0-3.504-.475-5.02-1.371l-.36-.214-3.736.974.993-3.625-.235-.373c-.985-1.562-1.505-3.376-1.505-5.23 0-5.419 4.43-9.827 9.873-9.827 2.64 0 5.122 1.021 6.985 2.875 1.864 1.855 2.89 4.318 2.89 6.947-.002 5.421-4.434 9.844-9.89 9.844zm5.415-7.362c-.297-.148-1.758-.862-2.03-.96-.271-.099-.47-.148-.668.148-.198.296-.768.96-.941 1.157-.173.197-.347.222-.644.074-1.644-.827-2.91-1.776-3.882-3.486-.173-.296-.018-.456.13-.604.134-.133.297-.344.446-.517.149-.172.198-.295.297-.492.099-.197.05-.37-.025-.518-.074-.148-.668-1.6-.915-2.192-.24-.579-.485-.5-.668-.51h-.57c-.198 0-.52.074-.792.37-.272.296-1.04 1.01-1.04 2.463 0 1.453 1.065 2.858 1.213 3.055.149.197 2.08 3.155 5.038 4.417 2.428 1.036 3.224.962 3.82.812.784-.197 2.376-.962 2.71-1.893.333-.93.333-1.725.234-1.893-.099-.168-.347-.267-.644-.415z"/></svg>
    </a>
</div>

<?php get_footer(); ?>
