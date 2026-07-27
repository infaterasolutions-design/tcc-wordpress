const fs = require('fs');

// Update header.php
let html = fs.readFileSync('header.php', 'utf8');
let oldLogo = `<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center header-logo-link" style="gap: 0.5rem; text-decoration: none;">
				<span class="text-script header-logo-tcc" style="font-size: 2.5rem; color: #b0afa9; line-height: 1;">tcc</span>
				<span class="text-serif header-logo-text" style="font-size: 1.5rem; font-weight: bold; letter-spacing: -0.5px; color: #000;">the combo closet</span>
			</a>`;
let newLogo = `<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo flex items-center">
					<?php the_custom_logo(); ?>
				</div>
			<?php else : ?>
				` + oldLogo.trim() + `
			<?php endif; ?>`;
html = html.replace(oldLogo, newLogo);
fs.writeFileSync('header.php', html);

// Update functions.php
let func = fs.readFileSync('functions.php', 'utf8');
func = func.replace("add_theme_support( 'title-tag' );", "add_theme_support( 'title-tag' );\n\tadd_theme_support( 'custom-logo', array( 'height' => 100, 'width' => 400, 'flex-height' => true, 'flex-width' => true ) );");
fs.writeFileSync('functions.php', func);

// Update style.css
let css = fs.readFileSync('style.css', 'utf8');
css += "\n/* Custom Logo */\n.site-logo img.custom-logo { max-height: 45px; width: auto; display: block; }\n";
fs.writeFileSync('style.css', css);
