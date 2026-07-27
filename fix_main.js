const fs = require('fs');
['category.php', 'archive.php', 'index.php'].forEach(file => {
	if (fs.existsSync(file)) {
		let php = fs.readFileSync(file, 'utf8');
		php = php.replace(/<main style="(.*?)">/g, '<main style="$1; width: 100%; max-width: 100vw; overflow-x: hidden;">');
		fs.writeFileSync(file, php);
	}
});
