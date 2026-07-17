const fs = require('fs');
const themeDir = 'C:\\Users\\sande\\Downloads\\tcc-theme';
let frontPage = fs.readFileSync(`${themeDir}\\front-page.php`, 'utf8');

// Hero replacements
const heroHtml = `
			<div class="intro-left">
				<h1 class="section-title type-1"><?php echo esc_html( get_theme_mod( 'tcc_hero_heading', 'Welcome to Minimalist Sophistication with Maximum Style' ) ); ?></h1>
				<div class="description"><p><?php echo wp_kses_post( get_theme_mod( 'tcc_hero_text', 'Fashion Jackson is an inspired style, home, and beauty destination for those who prefer quality over quantity, subtle over obvious, and ease over complexity.' ) ); ?></p></div>
			</div>
			
			<div class="intro-right">
				<div class="background-image" style="background:url(https://fashionjackson.com/wp-content/uploads/2023/06/beige-header-image.jpg) center no-repeat;"></div>
				
				<div class="featured-image"><img width="780" height="1040" src="<?php echo esc_url( get_theme_mod( 'tcc_hero_image', 'https://fashionjackson.com/wp-content/uploads/2023/06/Header-Portrait-Image.jpeg' ) ); ?>" class="attachment-full size-full" alt="Hero Image" decoding="async" fetchpriority="high" /></div>			
            </div>
`;

// Find the <div class="flex"> inside <div id="intro">
const introStart = frontPage.indexOf('<div id="intro">');
const flexStart = frontPage.indexOf('<div class="flex">', introStart);
const introRightEnd = frontPage.indexOf('</div>', frontPage.indexOf('<div class="intro-right">')) + 6; // closes background-image
const featuredImageEnd = frontPage.indexOf('</div>', frontPage.indexOf('<div class="featured-image">', introRightEnd)) + 6; // closes featured-image
const introRightDivEnd = frontPage.indexOf('</div>', featuredImageEnd) + 6; // closes intro-right

frontPage = frontPage.substring(0, flexStart + '<div class="flex">'.length) + '\n' + heroHtml + '\n' + frontPage.substring(introRightDivEnd);

fs.writeFileSync(`${themeDir}\\front-page.php`, frontPage, 'utf8');
console.log("Hero wired dynamically.");
