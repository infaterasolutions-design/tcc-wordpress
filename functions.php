<?php
/**
 * The Combo Closet functions and definitions
 */

if ( ! defined( 'TCC_VERSION' ) ) {
	define( 'TCC_VERSION', '1.1.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function tcc_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'tcc' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'tcc_theme_setup' );

/**
 * Register widget area.
 */
function tcc_widgets_init() {
	$footer_columns = array( 'Blog', 'Shop', 'Browse', 'Connect', 'Subscribe' );
	
	foreach ( $footer_columns as $col ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer: ' . $col, 'tcc' ),
				'id'            => 'footer-' . strtolower( $col ),
				'description'   => esc_html__( 'Add widgets here.', 'tcc' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s mb-6">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title font-serif text-lg mb-4">',
				'after_title'   => '</h4>',
			)
		);
	}
}
add_action( 'widgets_init', 'tcc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tcc_scripts() {
	// Google Fonts (Optimized Payload)
	wp_enqueue_style( 'tcc-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&family=Playfair+Display:wght@400;700&family=Great+Vibes&display=swap', array(), null );
	
	// Theme stylesheet
	wp_enqueue_style( 'tcc-style', get_stylesheet_uri(), array(), TCC_VERSION );
    
	// Tailwind CSS v4 via compiled style.css

	// Main JS for AJAX and interactivity
	wp_enqueue_script( 'tcc-main', get_template_directory_uri() . '/assets/js/main.js', array(), TCC_VERSION, true );
	wp_localize_script( 'tcc-main', 'tcc_ajax', array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'tcc_load_more_nonce' )
	) );
}
add_action( 'wp_enqueue_scripts', 'tcc_scripts' );

/**
 * AJAX Load More Handler
 */
function tcc_load_more_posts() {
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'tcc_load_more_nonce' ) ) {
		wp_die();
	}

	$page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
	$category = isset( $_POST['category'] ) ? sanitize_text_field( wp_unslash( $_POST['category'] ) ) : '';

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'paged'          => $page,
		'category_name'  => $category
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/content', 'card' );
		}
	}

	wp_die();
}
add_action( 'wp_ajax_tcc_load_more_posts', 'tcc_load_more_posts' );
add_action( 'wp_ajax_nopriv_tcc_load_more_posts', 'tcc_load_more_posts' );

/**
 * Register Customizer settings.
 */
function tcc_customize_register( $wp_customize ) {
    // Hero Section
    $wp_customize->add_section( 'tcc_hero_section', array(
        'title'    => __( 'Hero Section', 'tcc' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'tcc_hero_heading', array(
        'default'           => 'Welcome to Minimalist Sophistication with Maximum Style',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'tcc_hero_heading', array(
        'label'   => __( 'Hero Heading', 'tcc' ),
        'section' => 'tcc_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'tcc_hero_text', array(
        'default'           => 'The Combo Closet is an inspired style, home, and beauty destination for those who prefer quality over quantity, subtle over obvious, and ease over complexity.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'tcc_hero_text', array(
        'label'   => __( 'Hero Text', 'tcc' ),
        'section' => 'tcc_hero_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'tcc_hero_image', array(
        'default'           => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=600',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tcc_hero_image', array(
        'label'    => __( 'Hero Image', 'tcc' ),
        'section'  => 'tcc_hero_section',
        'settings' => 'tcc_hero_image',
    ) ) );
}
add_action( 'customize_register', 'tcc_customize_register' );

/**
 * Register Custom Post Type & Taxonomy
 */
function tcc_register_post_types() {
	// Fashion Post CPT
	register_post_type( 'fashion_post',
		array(
			'labels' => array(
				'name'          => __( 'Fashion Posts', 'tcc' ),
				'singular_name' => __( 'Fashion Post', 'tcc' )
			),
			'public'      => true,
			'has_archive' => true,
			'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'menu_icon'   => 'dashicons-store',
		)
	);

	// Custom Taxonomy
	register_taxonomy(
		'fashion_category',
		'fashion_post',
		array(
			'label'        => __( 'Fashion Categories' ),
			'rewrite'      => array( 'slug' => 'fashion-category' ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'tcc_register_post_types' );

/**
 * SHORTCODES
 */

// [accent_box title="Title" border="true"]
function tcc_accent_box_shortcode( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'title' => '',
        'border' => 'false'
    ), $atts );

    $border_style = $a['border'] === 'true' ? 'border: 2px solid #EC9277;' : 'border: none;';
    
    $html = '<div style="background-color: #FAF6EE; padding: 2rem; margin: 2rem 0; ' . esc_attr($border_style) . '">';
    if ( ! empty( $a['title'] ) ) {
        $html .= '<h2 style="margin-top: 0; font-family: \'Playfair Display\', serif; font-size: 2.2rem; color: #000; margin-bottom: 1.5rem;">' . esc_html( $a['title'] ) . '</h2>';
    }
    $html .= do_shortcode( $content );
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'accent_box', 'tcc_accent_box_shortcode' );

// [shop_the_post]
function tcc_shop_the_post_shortcode( $atts ) {
    $images = array(
        'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1591561954557-26941169b49e?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?auto=format&fit=crop&w=100&q=80'
    );
    
    ob_start();
    ?>
    <div style="margin: 4rem 0;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #000; margin-bottom: 2rem; text-align: center;">Shop the Post</h2>
        <div class="shop-post-container" style="display: flex; flex-direction: column; align-items: center; margin: 0 auto; width: 100%;">
            <div class="shop-post-wrapper" style="display: flex; align-items: center; justify-content: space-between; max-width: 640px; width: 100%; height: 130px; position: relative;">
                <button class="shop-post-prev" onclick="this.nextElementSibling.scrollBy({left: -240, behavior: 'smooth'})" style="width: 40px; height: 130px; background-color: transparent; border: none; cursor: pointer; color: #999; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; outline: none;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                </button>
                <div class="shop-post-track" style="display: flex; gap: 20px; height: 100%; align-items: center; overflow-x: auto; scrollbar-width: none; scroll-behavior: smooth; scroll-snap-type: x mandatory; padding: 10px 0; width: calc(100% - 80px);">
                    <?php foreach( array_merge($images, $images, $images) as $img ) : ?>
                    <a href="#" class="shop-post-item" style="scroll-snap-align: start; display: block; flex-shrink: 0; width: 100px; height: 100px; background-color: #f5f5f5; transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); border-radius: 4px; overflow: hidden; text-decoration: none;">
                        <picture class="tcc-picture-wrapper" style="display: block; width: 100%; height: 100%;">
                            <source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img)); ?>" type="image/avif">
                            <img src="<?php echo esc_url($img); ?>" alt="Shop Item" style="width: 100% !important; height: 100% !important; min-height: 100%; max-height: 100%; object-fit: cover; display: block; margin: 0 !important; padding: 0 !important;" />
                        </picture>
                    </a>
                    <?php endforeach; ?>
                </div>
                <button class="shop-post-next" onclick="this.previousElementSibling.scrollBy({left: 240, behavior: 'smooth'})" style="width: 40px; height: 130px; background-color: transparent; border: none; cursor: pointer; color: #999; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; outline: none;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                </button>
            </div>
        </div>
    </div>
    <style>
        .shop-post-track::-webkit-scrollbar { display: none; } 
        .shop-post-item:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(0,0,0,0.1); } 
        .shop-post-prev:hover, .shop-post-next:hover { color: #000; transform: scale(1.1); }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'shop_the_post', 'tcc_shop_the_post_shortcode' );

/**
 * 1. Performance Bloat Cleanup
 */
add_action('init', function() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
});

function tcc_remove_gutenberg_bloat() {
    if (!is_admin_bar_showing()) {
        wp_deregister_style('dashicons');
    }
    
    $styles = [
        'wp-block-library',
        'wp-block-library-theme',
        'wc-blocks-style',
        'global-styles',
        'classic-theme-styles'
    ];
    
    foreach ($styles as $style) {
        wp_dequeue_style($style);
        wp_deregister_style($style);
    }
}
// Hook into both enqueue and print at priority 9999 to catch late enqueues
add_action('wp_enqueue_scripts', 'tcc_remove_gutenberg_bloat', 9999);
add_action('wp_print_styles', 'tcc_remove_gutenberg_bloat', 9999);

// Remove Global Styles completely
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

// Disable separate block styles (prevents wp-block-heading-inline-css etc.)
add_filter('should_load_separate_core_block_assets', '__return_false');
remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');

// Bulletproof body class cleanup: Forcefully strip any remaining elementor template classes
add_filter('body_class', function($classes) {
    foreach ($classes as $key => $value) {
        if (strpos($value, 'elementor') !== false) {
            unset($classes[$key]);
        }
    }
    return $classes;
}, 9999);

add_filter('script_loader_tag', function($tag, $handle, $src) {
    if (strpos($handle, 'google-site-kit') !== false || strpos($src, 'googletagmanager.com') !== false || strpos($src, 'grow.me') !== false) {
        if (strpos($tag, ' defer') === false && strpos($tag, ' async') === false) {
            $tag = str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}, 10, 3);

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * 4. Native AVIF Support & Picture Tag Filters
 */
// 1. Force WordPress-generated image outputs to AVIF
add_filter( 'image_editor_output_format', function( $formats ) {
    $formats['image/jpeg'] = 'image/avif';
    $formats['image/png']  = 'image/avif';
    $formats['image/webp'] = 'image/avif';
    return $formats;
} );

// 2. Set AVIF quality explicitly
add_filter( 'wp_editor_set_quality', function( $quality, $mime_type ) {
    if ( 'image/avif' === $mime_type ) {
        return 80; // Optimal balance of quality and size
    }
    return $quality;
}, 10, 2 );

// 3. Ensure AVIF uploads are allowed
add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['avif'] = 'image/avif';
    return $mimes;
} );

// 7. Detect AVIF Support and Report to Admin
add_action('admin_notices', function() {
    $has_imagick = class_exists('Imagick') && count(Imagick::queryFormats('AVIF')) > 0;
    $has_gd = function_exists('imageavif');
    
    if ( ! $has_imagick && ! $has_gd ) {
        echo '<div class="notice notice-error"><p><strong>CRITICAL:</strong> Your server does not support AVIF generation. Both Imagick (with AVIF) and GD (with libavif) are missing. Images will NOT be converted to AVIF automatically.</p></div>';
    }
});
function tcc_avif_exists_locally($avif_url) {
    // For debugging the user's issue: forcefully return true so the <picture> tags 
    // are ALWAYS generated. This will prove the filter is running. 
    // If the browser 404s the .avif file, it means the conversion script failed on their server.
    return true;
}

add_filter('post_thumbnail_html', function($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if ( empty($html) ) return $html;
    
    $original_url = wp_get_attachment_url($post_thumbnail_id);
    if (!$original_url) return $html;

    $picture = '<picture class="tcc-picture-wrapper" style="display: block; width: 100%; height: 100%;">';

    $picture .= '<!-- AVIF HELPER ACTIVE -->';
    if ( strpos($html, '.avif') !== false ) {
        // Native WP AVIF generation caught! Extract srcset/src for the <source> tag.
        preg_match('/srcset=[\'"]([^\'"]+)[\'"]/', $html, $srcset_matches);
        $srcset = !empty($srcset_matches[1]) ? $srcset_matches[1] : '';
        preg_match('/src=[\'"]([^\'"]+)[\'"]/', $html, $src_matches);
        $src = !empty($src_matches[1]) ? $src_matches[1] : '';
        
        $picture .= '<source srcset="' . esc_attr($srcset ?: $src) . '" type="image/avif">';
        
        // Rewrite the <img> fallback to point to the original non-AVIF file
        $fallback_html = preg_replace('/src=[\'"][^\'"]+[\'"]/', 'src="' . esc_url($original_url) . '"', $html);
        $fallback_html = preg_replace('/srcset=[\'"][^\'"]+[\'"]/', '', $fallback_html); // remove srcset
        
        $picture .= $fallback_html;
        $picture .= '</picture>';
        return $picture;
    }
    
    // Legacy support: if WP outputted JPG/WebP, check if our retroactive script generated an AVIF on disk.
    $src = wp_get_attachment_image_url($post_thumbnail_id, $size);
    if ( ! $src ) return $html;
    $avif_src = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $src);
    
    if ( ! tcc_avif_exists_locally($avif_src) ) {
        return $html;
    }
    
    $picture .= '<source srcset="' . esc_url($avif_src) . '" type="image/avif">';
    $picture .= $html;
    $picture .= '</picture>';
    
    return $picture;
}, 10, 5);

function tcc_get_picture_tag($src, $alt = '', $classes = '', $styles = '') {
    $picture = '<picture class="tcc-picture-wrapper" style="display: block; width: 100%; height: 100%;">';
    
    if (strpos($src, 'unsplash.com') !== false) {
        $avif_src = str_replace('auto=format', 'fm=avif', $src);
        $picture .= '<source srcset="' . esc_url($avif_src) . '" type="image/avif">';
    } else {
        $avif_src = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $src);
        if ( tcc_avif_exists_locally($avif_src) ) {
            $picture .= '<source srcset="' . esc_url($avif_src) . '" type="image/avif">';
        }
    }
    
    $picture .= '<img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" class="' . esc_attr($classes) . '" style="' . esc_attr($styles) . '" />';
    $picture .= '</picture>';
    return $picture;
}

add_filter('the_content', function($content) {
    if (empty($content)) return $content;
    
    $upload_dir = wp_get_upload_dir();
    
    return preg_replace_callback('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', function($matches) use ($upload_dir) {
        $img_tag = $matches[0];
        $src = $matches[1];
        
        $picture = '<picture class="tcc-picture-wrapper" style="display: block; width: 100%; height: 100%;">';

        // If the tag is already AVIF natively
        if (strpos($src, '.avif') !== false) {
            // Find fallback by assuming the original file has the same base name but .jpg/.png
            // This is tricky inside content without post_id, so we fallback to a simple replace for common extensions
            preg_match('/srcset=[\'"]([^\'"]+)[\'"]/', $img_tag, $srcset_matches);
            $srcset = !empty($srcset_matches[1]) ? $srcset_matches[1] : '';
            $picture .= '<source srcset="' . esc_attr($srcset ?: $src) . '" type="image/avif">';
            
            // Try to find original by stripping WP image sizing e.g., -300x300.avif -> .jpg
            $fallback_src = preg_replace('/-\d+x\d+\.avif$/i', '.jpg', $src);
            $fallback_src = str_replace('.avif', '.jpg', $fallback_src);
            
            $fallback_html = preg_replace('/src=[\'"][^\'"]+[\'"]/', 'src="' . esc_url($fallback_src) . '"', $img_tag);
            $fallback_html = preg_replace('/srcset=[\'"][^\'"]+[\'"]/', '', $fallback_html);
            
            $picture .= $fallback_html;
            $picture .= '</picture>';
            return $picture;
        }

        // Legacy / Retroactive AVIF handling
        if (preg_match('/\.(jpg|jpeg|png|webp)$/i', $src)) {
            $avif_src = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $src);
            
            if ( tcc_avif_exists_locally($avif_src) ) {
                $picture .= '<source srcset="' . esc_attr($avif_src) . '" type="image/avif">';
                $picture .= $img_tag;
                $picture .= '</picture>';
                return $picture;
            }
        }
        
        return $img_tag;
    }, $content);
}, 99);

/**
 * REST API for Trending Tabs
 */
add_action('rest_api_init', function() {
    register_rest_route('tcc/v1', '/trending/(?P<tab>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'tcc_get_trending_tab',
        'permission_callback' => '__return_true',
    ));
});

function tcc_get_trending_tab($request) {
    $tab_id = $request['tab'];
    $tabs_config = [
        'popular' => ['post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'comment_count'],
        'travel-tips' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'travel-tips'],
        'outfit-guides' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'outfit-guides'],
        'reviews' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'reviews'],
    ];

    $btn_texts = [
        'popular' => 'READ MORE POPULAR POSTS',
        'travel-tips' => 'READ MORE TRAVEL TIPS',
        'outfit-guides' => 'READ MORE OUTFIT GUIDES',
        'reviews' => 'READ MORE REVIEWS'
    ];

    if (!isset($tabs_config[$tab_id])) {
        return new WP_Error('invalid_tab', 'Invalid tab ID', array('status' => 404));
    }

    $q = new WP_Query($tabs_config[$tab_id]);
    $posts = [];
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            $cat = get_the_category();
            $dummy_img = get_post_meta(get_the_ID(), '_tcc_dummy_image', true) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=400';
            $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : $dummy_img;
            
            // Force AVIF for the REST API background image
            if (strpos($img_url, 'unsplash.com') !== false) {
                $img_url = str_replace('auto=format', 'fm=avif', $img_url);
            } else {
                $img_url = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $img_url);
            }
            
            $posts[] = [
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 15, '&hellip;'),
                'category' => $cat ? esc_html($cat[0]->name) : '',
                'image' => $img_url
            ];
        }
    }
    wp_reset_postdata();

    return rest_ensure_response([
        'btn_text' => $btn_texts[$tab_id],
        'posts' => $posts
    ]);
}
