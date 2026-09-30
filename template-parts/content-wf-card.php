<?php
/**
 * Template part for displaying a category grid post card
 */

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
