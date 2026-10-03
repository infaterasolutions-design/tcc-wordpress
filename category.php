<?php
/**
 * The main template file / Blog / Archive
 */

get_header(); 

$is_blog_home = is_home();
$cat_title = $is_blog_home ? single_post_title('', false) : single_term_title('', false);
if ( empty($cat_title) ) {
	$cat_title = 'Blog';
}
global $wp_query;
?>

<style>
.wf-archive-bg {
    background-color: #EAEBE6;
    min-height: 100vh;
    padding-bottom: 80px;
}
.wf-category-header {
    text-align: left;
    padding: 60px 40px 40px;
    max-width: 1240px; margin: 0 auto;
}
.wf-category-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 500;
    color: #000;
    margin: 0;
}
.wf-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    max-width: 1240px; margin: 0 auto;
    padding: 0 40px;
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
    .wf-category-header { padding: 50px 40px 30px; }
}
@media (max-width: 768px) {
    .wf-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px; }
    .wf-category-header { padding: 40px 20px 20px; }
    .wf-category-title { font-size: 26px; }
}
@media (max-width: 480px) {
    .wf-grid { grid-template-columns: 1fr; }
}
</style>

<main class="wf-archive-bg">
    
    <header class="wf-category-header">
        <h1 class="wf-category-title"><?php echo esc_html( $cat_title ); ?></h1>
    </header>

    <div class="wf-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); 
                
                // Dynamic count logic
                $raw_content = get_post_field('post_content', get_the_ID());
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
            <?php endwhile; ?>
        <?php else : ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888; font-family: 'Inter', sans-serif;">
                No posts found in this category.
            </div>
        <?php endif; ?>
    </div>

    <!-- LOAD MORE BUTTON -->
    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div style="display: flex; align-items: center; justify-content: center; margin-top: 60px;">
            <button class="load-more-btn" id="tcc-load-more" data-page="1" data-max="<?php echo esc_attr($wp_query->max_num_pages); ?>" data-category="<?php echo esc_attr( $is_blog_home ? '' : single_cat_title('', false) ); ?>" style="font-family: 'Inter', sans-serif; font-size: 12px; letter-spacing: 2px; border: 1px solid #000; padding: 12px 30px; background: transparent; cursor: pointer; transition: background 0.3s, color 0.3s;">
                LOAD MORE
            </button>
        </div>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
