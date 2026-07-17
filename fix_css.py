import os
import re

css_path = r"C:\Users\sande\Local Sites\tcc\app\public\wp-content\themes\tcc-theme\input.css"

with open(css_path, "r", encoding="utf-8") as f:
    content = f.read()

# Find the start of the first @media (max-width: 900px) block that occurs in the lower half of the file
# Or just find /* Front Page Styles */ and everything before it up to the @media
# Since the file got mangled, let's find .fp-elsewhere-img4 img and cut there.

match = re.search(r'\.fp-elsewhere-img4 img \{.*?\}', content)
if match:
    idx = match.end()
    top_half = content[:idx].strip() + "\n\n"
else:
    print("Could not find anchor!")
    exit(1)

# Now we append exactly what should be at the bottom:
bottom_half = """@media (max-width: 900px) {
  .hero-section { flex-direction: column-reverse !important; }
  .hero-left { padding: 3rem 1.5rem !important; text-align: center; }
  .hero-left h1 { font-size: 2.5rem !important; }
  .hero-right { padding: 2rem !important; }
  .trending-grid { grid-template-columns: 1fr !important; padding: 1.5rem !important; }
  .trending-featured { flex-direction: column !important; margin-right: 0 !important; max-height: none !important; }
  .trending-featured-text { padding: 1.5rem !important; }
  .trending-list { border-left: none !important; padding-left: 0 !important; margin-top: 2rem !important; }
  .trending-nav, .recent-nav { display: none !important; }
  .recent-grid { grid-template-columns: 1fr !important; }
  .subscribe-section { flex-direction: column !important; text-align: center; gap: 1.5rem !important; }
  .subscribe-input-group { width: 100%; justify-content: center; }
  .shop-videos-row { flex-wrap: nowrap !important; overflow-x: auto; scroll-snap-type: x mandatory; justify-content: flex-start !important; scrollbar-width: none; }
  .shop-videos-row::-webkit-scrollbar { display: none; }
  .shop-videos-item { min-width: 65% !important; scroll-snap-align: center; margin-bottom: 0 !important; flex-shrink: 0; }
  .shop-videos-title { min-width: 35% !important; flex-shrink: 0; scroll-snap-align: start; }
}

@media (min-width: 601px) and (max-width: 1024px) {
  .recent-grid { grid-template-columns: repeat(2, 1fr) !important; }
}

.shop-videos-row { display: flex; overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none; scroll-snap-type: x mandatory; }
.shop-videos-row::-webkit-scrollbar { display: none; }
.shop-videos-item { scroll-snap-align: start; flex-shrink: 0; }

/* Figma Trending Section Refactor */
.figma-trending-container { width: 1200px; max-width: 100%; margin: 40px auto; position: relative; padding: 0; }
.figma-trending-title-wrapper { display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 30px; position: relative; z-index: 10; }
.figma-trending-title { font-family: 'Great Vibes', cursive; font-size: 144px; line-height: 0; text-transform: lowercase; color: #000; margin-left: 60px; margin-top: 30px; }
.figma-trending-nav { display: flex; align-items: center; gap: 15px; }
.figma-trending-nav span { font-family: 'Courier Prime', monospace; font-size: 11px; line-height: 13px; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; padding: 10.5px 20px; }
.figma-trending-nav-active { background: #000; color: #fff; }
.figma-trending-nav-item { background: transparent; color: #000; }
.figma-trending-grid { display: flex; flex-direction: row; align-items: flex-start; width: 100%; height: 546px; }
.figma-trending-featured { display: flex; flex-direction: row; width: 840px; padding-right: 30px; height: 100%; }
.figma-trending-featured-img { width: 402px; height: 100%; background-size: cover; background-position: center; flex-shrink: 0; }
.figma-trending-featured-content { width: 409px; height: 100%; background: #fff; display: flex; flex-direction: column; justify-content: center; padding: 35px 40px; box-sizing: border-box; }
.figma-trending-featured-title { font-family: 'Playfair Display', serif; font-size: 36px; line-height: 1; letter-spacing: 0.3px; color: #000; margin-bottom: 15px; text-decoration: none; }
.figma-trending-featured-excerpt { font-family: 'Inter', sans-serif; font-size: 13px; line-height: 1.69; letter-spacing: 1px; color: #000; margin-bottom: 30px; }
.figma-trending-featured-btn { background: #F4F1EC; padding: 8.5px 20px; font-family: 'Inter', sans-serif; font-size: 9px; line-height: 9px; letter-spacing: 1.5px; text-transform: uppercase; color: #000; text-decoration: none; display: inline-block; align-self: flex-start; }
.figma-trending-list { width: 360px; height: 100%; border-left: 2.4px solid #000; padding-left: 30px; display: flex; flex-direction: column; justify-content: flex-start; }
.figma-trending-list-item { display: flex; align-items: center; padding: 15px 0; text-decoration: none; height: 125.91px; box-sizing: border-box; cursor: pointer; }
.figma-trending-list-num { font-family: 'Playfair Display', serif; font-size: 96px; line-height: 96px; letter-spacing: 1px; width: 75px; text-align: center; color: #DFD7C9; margin-right: 15px; transition: color 0.3s ease; }
.figma-trending-list-num.active-num { color: #000; }
.figma-trending-list-title { font-family: 'Inter', sans-serif; font-size: 15px; line-height: 1.25; letter-spacing: 0.17px; text-transform: uppercase; color: #DFD7C9; flex: 1; transition: color 0.3s ease; }
.figma-trending-list-title.active-title { color: #000; }
.figma-trending-list-item:hover .figma-trending-list-num,
.figma-trending-list-item:hover .figma-trending-list-title { color: #000; }
.figma-trending-list-btn { background: #000; color: #F4F1EC; font-family: 'Inter', sans-serif; font-size: 12px; line-height: 1; letter-spacing: 1.5px; text-transform: uppercase; text-align: center; padding: 15px 30px; text-decoration: none; display: block; margin-top: auto; }
@media (max-width: 1200px) {
    .figma-trending-container, .figma-trending-title-wrapper, .figma-trending-grid { width: 100%; }
    .figma-trending-grid { flex-direction: column; height: auto; }
    .figma-trending-featured { width: 100%; padding-right: 0; height: auto; flex-direction: column; }
    .figma-trending-featured-img { width: 100%; height: 400px; }
    .figma-trending-featured-content { width: 100%; }
    .figma-trending-list { width: 100%; border-left: none; border-top: 2.4px solid #000; padding-left: 0; padding-top: 30px; margin-top: 30px; height: auto; }
    .figma-trending-title { font-size: 80px; margin-left: 0; margin-top: 0; }
    .figma-trending-title-wrapper { flex-direction: column; align-items: flex-start; gap: 20px; }
}
"""

with open(css_path, "w", encoding="utf-8") as f:
    f.write(top_half + bottom_half)

print("Done fixing CSS.")
