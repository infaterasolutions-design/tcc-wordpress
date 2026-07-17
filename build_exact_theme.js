const fs = require('fs');

const sourceFile = 'C:\\Users\\sande\\Downloads\\The combo closet - wordpress\\fashion_jackson_home.html';
const themeDir = 'C:\\Users\\sande\\Downloads\\tcc-theme';

const content = fs.readFileSync(sourceFile, 'utf8');

// Find boundaries
const headerMarker = '</header><!-- #masthead -->';
const contentMarker = '<div id="content" class="site-content wrap">';
const footerMarker = '<footer id="colophon" class="site-footer" role="contentinfo">';

const headerEndIdx = content.indexOf(headerMarker) + headerMarker.length;
const contentStartIdx = content.indexOf(contentMarker);
const footerStartIdx = content.indexOf(footerMarker);

if (headerEndIdx === -1 || contentStartIdx === -1 || footerStartIdx === -1) {
    console.error("Could not find one or more boundaries.");
    process.exit(1);
}

// Extract parts
let headerHtml = content.substring(0, headerEndIdx);
let bodyHtml = content.substring(contentStartIdx, footerStartIdx);
let footerHtml = content.substring(footerStartIdx);

// Inject WP hooks
headerHtml = headerHtml.replace('</head>', '<?php wp_head(); ?>\n</head>');
footerHtml = footerHtml.replace('</body>', '<?php wp_footer(); ?>\n</body>');

// Remove hardcoded live CSS and add our local stylesheet hook? 
// Wait, wp_head() will enqueue our local style.css. The hardcoded ones in <head> might override or duplicate.
// The user said "use exact HTML/CSS structure... priority is 100% visual fidelity first".
// Leaving the hardcoded ones will definitely work, but it's cleaner to remove the main stylesheet link from head 
// since we enqueued it. But I'll leave them for now to ensure 100% fidelity.

const frontPage = "<?php get_header(); ?>\n" + bodyHtml + "\n<?php get_footer(); ?>";

// Write files
fs.writeFileSync(`${themeDir}\\header.php`, headerHtml, 'utf8');
fs.writeFileSync(`${themeDir}\\front-page.php`, frontPage, 'utf8');
fs.writeFileSync(`${themeDir}\\footer.php`, footerHtml, 'utf8');

console.log("Successfully generated exact HTML templates.");
