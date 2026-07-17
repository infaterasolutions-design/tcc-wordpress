import re

source_file = r"C:\Users\sande\Downloads\The combo closet - wordpress\fashion_jackson_home.html"
theme_dir = r"C:\Users\sande\Downloads\tcc-theme"

with open(source_file, 'r', encoding='utf-8') as f:
    content = f.read()

# Find boundaries
header_end_idx = content.find('</header><!-- #masthead -->') + len('</header><!-- #masthead -->')
content_start_idx = content.find('<div id="content" class="site-content wrap">')
footer_start_idx = content.find('<footer id="colophon" class="site-footer" role="contentinfo">')

if header_end_idx == -1 or content_start_idx == -1 or footer_start_idx == -1:
    print("Could not find one or more boundaries.")
    exit(1)

# Extract parts
header_html = content[:header_end_idx]
body_html = content[content_start_idx:footer_start_idx]
footer_html = content[footer_start_idx:]

# Inject WP hooks
header_html = header_html.replace('</head>', '<?php wp_head(); ?>\n</head>')
footer_html = footer_html.replace('</body>', '<?php wp_footer(); ?>\n</body>')

# Create front-page.php
front_page = "<?php get_header(); ?>\n" + body_html + "\n<?php get_footer(); ?>"

# Write files
with open(theme_dir + r"\header.php", "w", encoding="utf-8") as f:
    f.write(header_html)

with open(theme_dir + r"\front-page.php", "w", encoding="utf-8") as f:
    f.write(front_page)

with open(theme_dir + r"\footer.php", "w", encoding="utf-8") as f:
    f.write(footer_html)

print("Successfully generated exact HTML templates.")
