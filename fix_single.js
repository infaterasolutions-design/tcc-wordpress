const fs = require('fs');

let php = fs.readFileSync('single-centered.php', 'utf8');

// Replace the hardcoded inline padding styles with responsive classes
php = php.replace(/<header style="max-width: 1240px; margin: 0 auto; padding: 4rem 2rem 2rem;">/g, '<header class="centered-post-header">');
php = php.replace(/<div style="max-width: 1240px; margin: 0 auto 4rem; padding: 0 2rem;">/g, '<div class="centered-post-image">');
php = php.replace(/<article class="article-content" style="max-width: 1240px; margin: 0 auto; padding: 0 2rem;">/g, '<article class="article-content centered-post-content">');

fs.writeFileSync('single-centered.php', php);

let css = fs.readFileSync('style.css', 'utf8');
css += `
/* Centered Post Layout Fix */
.centered-post-header {
  max-width: 1240px;
  margin: 0 auto;
  padding: 2rem 1rem 1rem;
}
.centered-post-image {
  max-width: 1240px;
  margin: 0 auto 2rem;
  padding: 0;
}
.centered-post-content {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 1rem;
}
@media (min-width: 768px) {
  .centered-post-header {
    padding: 4rem 2rem 2rem;
  }
  .centered-post-image {
    margin-bottom: 4rem;
    padding: 0;
  }
  .centered-post-content {
    padding: 0 2rem;
  }
}
`;
fs.writeFileSync('style.css', css);
