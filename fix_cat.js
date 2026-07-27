const fs = require('fs');
let overlayHtml = `
<div class="recent-hover-overlay">
	<span class="recent-hover-text">VIEW THE POST</span>
	<svg class="recent-hover-arrow" viewBox="0 0 100 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M5 12 Q 30 9 60 14 T 95 12 M 95 12 L 80 4 M 95 12 L 82 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</div>
`;
['archive.php', 'index.php'].forEach(file => {
	if (fs.existsSync(file)) {
		let php = fs.readFileSync(file, 'utf8');
		php = php.replace(/(<\?php endif; \?>\s*)<style>/g, '$1' + overlayHtml + '<style>');
		fs.writeFileSync(file, php);
	}
});
