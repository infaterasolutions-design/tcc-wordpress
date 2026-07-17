const fs = require('fs');

const themeDir = 'C:\\Users\\sande\\Downloads\\tcc-theme';

// --- header.php ---
let header = fs.readFileSync(`${themeDir}\\header.php`, 'utf8');

// Replace mega menu with wp_nav_menu
const navStartStr = '<div id="mega-menu-wrap-primary"';
const navEndStr = '</nav>';
const navStartIdx = header.indexOf(navStartStr);
const navEndIdx = header.indexOf(navEndStr);

if (navStartIdx !== -1 && navEndIdx !== -1) {
    const dynamicNav = `
    <div id="mega-menu-wrap-primary" class="mega-menu-wrap">
        <?php wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_id' => 'mega-menu-primary', 
            'menu_class' => 'mega-menu max-mega-menu mega-menu-horizontal',
            'fallback_cb' => false
        ) ); ?>
    </div>
    `;
    header = header.substring(0, navStartIdx) + dynamicNav + header.substring(navEndIdx);
}
fs.writeFileSync(`${themeDir}\\header.php`, header, 'utf8');

// --- footer.php ---
let footer = fs.readFileSync(`${themeDir}\\footer.php`, 'utf8');

// We have 4 columns in the footer of fashion_jackson_home.html: 
// <div class="column-1">, <div class="column-2">, <div class="column-3">, <div class="column-4">
// Let's replace the inner content of these columns with dynamic_sidebar calls.
for (let i = 1; i <= 4; i++) {
    const colStr = `<div class="column-${i}">`;
    const colStartIdx = footer.indexOf(colStr);
    if (colStartIdx !== -1) {
        // Find the matching closing </div> for this column.
        // It's followed by another <div class="column..."> or </div><!-- .flex.wrap -->
        let nextColIdx = footer.indexOf(`<div class="column-${i+1}">`);
        if (nextColIdx === -1) nextColIdx = footer.indexOf(`</div><!-- .flex.wrap -->`);
        
        if (nextColIdx !== -1) {
            // Find the last </div> before nextColIdx
            const colEndIdx = footer.lastIndexOf('</div>', nextColIdx);
            
            const dynamicSidebar = `\n<?php if ( is_active_sidebar( 'footer-${i}' ) ) { dynamic_sidebar( 'footer-${i}' ); } ?>\n`;
            footer = footer.substring(0, colStartIdx + colStr.length) + dynamicSidebar + footer.substring(colEndIdx);
        }
    }
}
fs.writeFileSync(`${themeDir}\\footer.php`, footer, 'utf8');

console.log("Header and Footer wired dynamically.");
