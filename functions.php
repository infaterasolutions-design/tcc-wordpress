<?php
/**
 * The Combo Closet functions and definitions
 */

if ( ! defined( 'TCC_VERSION' ) ) {
	define( 'TCC_VERSION', filemtime(get_stylesheet_directory() . '/style.css') );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function tcc_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array( 'height' => 100, 'width' => 400, 'flex-height' => true, 'flex-width' => true ) );
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

	add_theme_support( 'editor-styles' );
	add_editor_style( array(
		'editor-style.css',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&family=Playfair+Display:wght@400;700&family=Great+Vibes&family=Sacramento&family=Allura&family=Herr+Von+Muellerhoff&family=Antic+Didone&family=Adamina&family=Marcellus&family=Public+Sans:wght@600&family=Poppins:wght@400&family=Bodoni+Moda:wght@400&family=Vidaloka&display=block'
	) );
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

	// Register Main Sidebar for Ads
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'tcc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add ad widgets and other sidebar items here.', 'tcc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s" style="margin-bottom: 2rem;">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title" style="font-family: \'Playfair Display\', serif; font-size: 24px; margin-bottom: 1.5rem; text-align: center; font-weight: 400;">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'tcc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tcc_scripts() {
	// Google Fonts (Optimized Payload with Elegant Scripts)
	// Disabled render-blocking enqueue; loaded asynchronously in wp_head below.
	// wp_enqueue_style( 'tcc-google-fonts-v3', 'https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;800&family=Playfair+Display:wght@400;700&family=Great+Vibes&family=Sacramento&family=Allura&family=Herr+Von+Muellerhoff&family=Qwigley&family=Antic+Didone&family=Adamina&family=Marcellus&family=Public+Sans:wght@600&family=Poppins:wght@400&family=Bodoni+Moda:wght@400&family=Vidaloka', array(), null );
	
	// Theme stylesheet
	wp_enqueue_style( 'tcc-theme-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css') );
    
	// Tailwind CSS v4 via compiled style.css

	// Ensure jQuery is loaded (required by many third-party ad networks like SheMedia)
	wp_enqueue_script( 'jquery' );

	// Main JS for AJAX and interactivity
	wp_enqueue_script( 'tcc-main', get_template_directory_uri() . '/assets/js/main.js', array(), TCC_VERSION, true );
	
	// Lightbox JS for double tap image zooming
	wp_enqueue_script( 'tcc-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array(), time(), true );
	
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

	// Shoppable Videos CPT
	register_post_type( 'shoppable_video',
		array(
			'labels' => array(
				'name'          => __( 'Shoppable Videos', 'tcc' ),
				'singular_name' => __( 'Shoppable Video', 'tcc' )
			),
			'public'      => true,
			'has_archive' => true,
			'supports'    => array( 'title', 'thumbnail' ), // Only title and thumbnail needed
			'menu_icon'   => 'dashicons-video-alt3',
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
function tcc_shop_the_post_shortcode( $atts, $content = null ) {
    $images = array(
        'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1591561954557-26941169b49e?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?auto=format&fit=crop&w=100&q=80',
        'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?auto=format&fit=crop&w=100&q=80'
    );
    
    $has_custom_products = !empty(trim($content));
    
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
                    <?php 
                    if ($has_custom_products) {
                        echo do_shortcode( $content );
                    } else {
                        foreach( array_merge($images, $images, $images) as $img ) : 
                    ?>
                    <button href="#" class="shop-post-item" style="scroll-snap-align: start; display: block; flex-shrink: 0; width: 100px; height: 100px; background-color: #f5f5f5; transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); border-radius: 4px; overflow: hidden; text-decoration: none;">
                        <picture class="tcc-picture-wrapper">
                            <source srcset="<?php echo esc_url(str_replace('auto=format', 'fm=avif', $img)); ?>" type="image/avif">
                            <img src="<?php echo esc_url($img); ?>" alt="Shop Item" loading="lazy" width="100" height="100" style="width: 100% !important; height: 100% !important; min-height: 100%; max-height: 100%; object-fit: cover; display: block; margin: 0 !important; padding: 0 !important;" />
                        </picture>
                    </button>
                    <?php 
                        endforeach; 
                    }
                    ?>
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

// [shop_product link="https..." image="https..."]
function tcc_shop_product_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'link' => '#',
        'image' => ''
    ), $atts );
    
    if ( empty($a['image']) ) return '';
    
    return '
    <button href="' . esc_url($a['link']) . '" target="_blank" rel="nofollow noopener" class="shop-post-item" style="scroll-snap-align: start; display: block; flex-shrink: 0; width: 100px; height: 100px; background-color: #f5f5f5; transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); border-radius: 4px; overflow: hidden; text-decoration: none;">
        <img src="' . esc_url($a['image']) . '" alt="Shop Item" loading="lazy" width="100" height="100" style="width: 100% !important; height: 100% !important; min-height: 100%; max-height: 100%; object-fit: cover; display: block; margin: 0 !important; padding: 0 !important;" />
    </button>';
}
add_shortcode( 'shop_product', 'tcc_shop_product_shortcode' );

// [affiliate_carousel]
function tcc_affiliate_carousel_shortcode( $atts, $content = null ) {
    ob_start();
    ?>
    <div class="tcc-affiliate-carousel-wrap" style="width: 100%; max-width: 1216px; height: 240px; margin: 4rem auto; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative;">
        
        <div class="tcc-affiliate-carousel" style="width: 100%; max-width: 600px; height: 240px; position: relative; display: flex; align-items: center; overflow: hidden; background: #fff;">
            
            <button class="tcc-affiliate-prev" onclick="this.nextElementSibling.scrollBy({left: -200, behavior: 'smooth'})" style="position: absolute; left: 0; top: 0; width: 25px; height: 240px; background: rgba(255,255,255,0.9); border: none; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #333; outline: none; padding: 0; transition: all 0.3s ease;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
            </button>
            
            <div class="tcc-affiliate-track" style="display: flex; gap: 30px; height: 240px; align-items: center; overflow-x: auto; scrollbar-width: none; scroll-behavior: smooth; padding: 0 35px; width: 100%; scroll-snap-type: x mandatory;">
                <?php echo do_shortcode( $content ); ?>
            </div>

            <button class="tcc-affiliate-next" onclick="this.previousElementSibling.scrollBy({left: 200, behavior: 'smooth'})" style="position: absolute; right: 0; top: 0; width: 25px; height: 240px; background: rgba(255,255,255,0.9); border: none; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center; color: #333; outline: none; padding: 0; transition: all 0.3s ease;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
            </button>
            
        </div>
    </div>
    <style>
        .tcc-affiliate-track::-webkit-scrollbar { display: none; }
        .tcc-affiliate-item { flex-shrink: 0; transition: transform 0.3s cubic-bezier(0.25, 1, 0.5, 1); display: block; scroll-snap-align: center; }
        .tcc-affiliate-item:hover { transform: translateY(-4px); }
        .tcc-affiliate-prev:hover, .tcc-affiliate-next:hover { background: #fff; transform: scale(1.1); color: #000; }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'affiliate_carousel', 'tcc_affiliate_carousel_shortcode' );

// [affiliate_product link="..." image="..."]
function tcc_affiliate_product_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'link' => '#',
        'image' => ''
    ), $atts );
    
    if ( empty($a['image']) ) return '';
    
    return '
    <button href="' . esc_url($a['link']) . '" target="_blank" rel="nofollow noopener" class="tcc-affiliate-item" style="height: 240px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
        <img src="' . esc_url($a['image']) . '" alt="Affiliate Product" loading="lazy" width="200" height="230" style="max-height: 230px; max-width: 200px; width: auto; height: auto; object-fit: contain; margin: 0; padding: 0;" />
    </button>';
}
add_shortcode( 'affiliate_product', 'tcc_affiliate_product_shortcode' );

// [instagram_post url="https://instagram.com/p/..."]
function tcc_instagram_post_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'url' => ''
    ), $atts );
    
    if ( empty($a['url']) ) return '';
    
    // Ensure URL is clean
    $url = esc_url($a['url']);
    
    ob_start();
    ?>
    <div class="tcc-instagram-wrapper" style="display: flex; flex-direction: column; align-items: center; margin: 3rem 0; width: 100%;">
        <blockquote class="instagram-media" data-instgrm-permalink="<?php echo $url; ?>" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
        </blockquote>
        <script async src="//www.instagram.com/embed.js"></script>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'instagram_post', 'tcc_instagram_post_shortcode' );

// [image_split left="https://..." right="https://..."]
function tcc_image_split_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'left' => '',
        'right' => ''
    ), $atts );
    
    if ( empty($a['left']) || empty($a['right']) ) return '';
    
    return '
    <div class="tcc-image-split" style="display: flex; gap: 20px; width: 100%; margin: 3rem 0;">
        <div style="flex: 1; overflow: hidden; border-radius: 4px;">
            <img src="' . esc_url($a['left']) . '" alt="Left Image" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; display: block; margin: 0;" />
        </div>
        <div style="flex: 1; overflow: hidden; border-radius: 4px;">
            <img src="' . esc_url($a['right']) . '" alt="Right Image" loading="lazy" width="600" height="800" style="width: 100%; height: 100%; object-fit: cover; display: block; margin: 0;" />
        </div>
    </div>
    <style>
        @media(max-width: 768px) {
            .tcc-image-split { flex-direction: column !important; gap: 15px !important; }
        }
    </style>
    ';
}
add_shortcode( 'image_split', 'tcc_image_split_shortcode' );

// Custom Comment Markup
function tcc_custom_comment_markup($comment, $args, $depth) {
    ?>
    <li <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>" style="margin-bottom: 2.5rem;">
        <div class="tcc-comment-body" style="display: flex; gap: 1.5rem;">
            <div class="tcc-comment-avatar">
                <?php echo get_avatar($comment, 50, '', '', array('style' => 'border-radius: 50%; border: 1px solid #eee;')); ?>
            </div>
            <div class="tcc-comment-content" style="flex: 1; padding-bottom: 1.5rem; border-bottom: 1px solid #f5f5f5;">
                <div class="tcc-comment-meta" style="margin-bottom: 0.8rem; display: flex; align-items: baseline; gap: 0.8rem;">
                    <strong style="font-family: 'Inter', sans-serif; font-size: 0.95rem; color: #000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                        <?php echo get_comment_author(); ?>
                    </strong>
                    <span style="font-family: 'Inter', sans-serif; font-size: 0.8rem; color: #999; font-style: italic;">
                        <?php printf('%1$s at %2$s', get_comment_date(), get_comment_time()); ?>
                    </span>
                </div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em style="font-size: 0.85rem; color: #999; display: block; margin-bottom: 0.5rem;">Your comment is awaiting moderation.</em>
                <?php endif; ?>
                <div class="tcc-comment-text" style="font-family: 'Inter', sans-serif; font-size: 0.95rem; color: #444; line-height: 1.7;">
                    <?php comment_text(); ?>
                </div>
                <div class="tcc-reply-link" style="margin-top: 1rem; font-family: 'Inter', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 600;">
                    <?php 
                    comment_reply_link(array_merge($args, array(
                        'reply_text' => 'Reply &rarr;',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    ))); 
                    ?>
                </div>
            </div>
        </div>
    <?php
}


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
    if (strpos($handle, 'google-site-kit') !== false || strpos($src, 'googletagmanager.com') !== false) {
        if (strpos($tag, ' defer') === false && strpos($tag, ' async') === false) {
            $tag = str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}, 10, 3);

// Explicitly tell LiteSpeed Cache to NEVER touch Mediavine or Grow scripts
add_filter( 'litespeed_optimize_js_excludes', function( $excludes ) {
    $excludes[] = 'scriptwrapper.com';
    $excludes[] = 'grow.me';
    $excludes[] = 'mediavine';
    $excludes[] = 'nutrimatic';
    return $excludes;
} );

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
        return 90; // Premium quality baseline
    }
    return $quality;
}, 10, 2 );

// 3. Ensure AVIF uploads are allowed
add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['avif'] = 'image/avif';
    return $mimes;
} );

// 4. Convert master file to AVIF immediately upon upload
add_filter('wp_handle_upload', function($upload) {
    if (isset($upload['error']) && $upload['error']) {
        return $upload;
    }
    
    $file_path = $upload['file'];
    $mime_type = $upload['type'];
    
    // Only convert JPEG, PNG, WEBP
    if (in_array($mime_type, ['image/jpeg', 'image/png', 'image/webp'])) {
        $has_imagick = class_exists('Imagick');
        $has_gd = function_exists('imageavif');
        
        if ($has_imagick || $has_gd) {
            $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            
            if ($ext === 'png') {
                // Convert to lossless WebP
                $webp_path = preg_replace('/\.png$/i', '.webp', $file_path);
                if ($has_imagick) {
                    try {
                        $image = new Imagick($file_path);
                        $image->setImageFormat('webp');
                        $image->setOption('webp:lossless', 'true');
                        $image->writeImage($webp_path);
                        $image->clear();
                        $image->destroy();
                    } catch (Exception $e) {}
                } else if (function_exists('imagewebp')) {
                    $image = @imagecreatefrompng($file_path);
                    if ($image !== false) {
                        imagewebp($image, $webp_path, 100);
                        imagedestroy($image);
                    }
                }
                return $upload;
            }
            
            $avif_path = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $file_path);
            $success = false;
            $quality = 90;
            
            if ($has_imagick) {
                try {
                    $image = new Imagick($file_path);
                    $image->setImageFormat('avif');
                    $image->setImageCompressionQuality($quality);
                    $image->writeImage($avif_path);
                    $image->clear();
                    $image->destroy();
                    $success = true;
                } catch (Exception $e) {}
            } else if ($has_gd) {
                if ($mime_type === 'image/jpeg') {
                    $image = @imagecreatefromjpeg($file_path);
                } else if ($mime_type === 'image/png') {
                    $image = @imagecreatefrompng($file_path);
                } else if ($mime_type === 'image/webp') {
                    $image = @imagecreatefromwebp($file_path);
                }
                if (isset($image) && $image !== false) {
                    if (imageavif($image, $avif_path, $quality)) {
                        $success = true;
                    }
                    imagedestroy($image);
                }
            }
            
            if ($success && file_exists($avif_path)) {
                // Delete original file
                @unlink($file_path);
                
                // Update upload array to point to new AVIF file
                $upload['file'] = $avif_path;
                $upload['url'] = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $upload['url']);
                $upload['type'] = 'image/avif';
            }
        }
    }
    
    return $upload;
});

// 7. Detect AVIF Support and Report to Admin
add_action('admin_notices', function() {
    $has_imagick = class_exists('Imagick') && count(Imagick::queryFormats('AVIF')) > 0;
    $has_gd = function_exists('imageavif');
    
    if ( ! $has_imagick && ! $has_gd ) {
        echo '<div class="notice notice-error"><p><strong>CRITICAL:</strong> Your server does not support AVIF generation. Both Imagick (with AVIF) and GD (with libavif) are missing. Images will NOT be converted to AVIF automatically.</p></div>';
    }
});
function tcc_avif_exists_locally($avif_url) {
    $parsed = parse_url($avif_url);
    if (empty($parsed['path'])) return false;
    
    $wp_content_pos = strpos($parsed['path'], '/wp-content/');
    if ($wp_content_pos !== false) {
        $local_file = ABSPATH . substr($parsed['path'], $wp_content_pos + 1);
        return file_exists($local_file);
    }
    return false;
}

add_filter('post_thumbnail_html', function($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if ( empty($html) ) return $html;
    
    $original_url = wp_get_attachment_url($post_thumbnail_id);
    if (!$original_url) return $html;

    $picture = '<picture class="tcc-picture-wrapper">';

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
    
    // Legacy support: check if our retroactive script generated an AVIF/WebP on disk.
    $src = wp_get_attachment_image_url($post_thumbnail_id, $size);
    if ( ! $src ) return $html;
    
    $is_png = preg_match('/\.png$/i', $src);
    $optimized_src = $is_png ? preg_replace('/\.png$/i', '.webp', $src) : preg_replace('/\.(jpg|jpeg|webp)$/i', '.avif', $src);
    $type = $is_png ? 'image/webp' : 'image/avif';
    
    if ( ! tcc_avif_exists_locally($optimized_src) ) {
        return $html;
    }
    
    preg_match('/srcset=[\'"]([^\'"]+)[\'"]/', $html, $srcset_matches);
    $original_srcset = !empty($srcset_matches[1]) ? $srcset_matches[1] : '';
    preg_match('/sizes=[\'"]([^\'"]+)[\'"]/', $html, $sizes_matches);
    $sizes_attr = !empty($sizes_matches[1]) ? ' sizes="' . esc_attr($sizes_matches[1]) . '"' : '';
    
    $optimized_srcset = '';
    if ($original_srcset) {
        $optimized_srcset = $is_png ? preg_replace('/\.png/i', '.webp', $original_srcset) : preg_replace('/\.(jpg|jpeg|webp)/i', '.avif', $original_srcset);
    } else {
        $optimized_srcset = $optimized_src;
    }
    
    $picture .= '<source srcset="' . esc_attr($optimized_srcset) . '"' . $sizes_attr . ' type="' . esc_attr($type) . '">';
    $picture .= $html;
    $picture .= '</picture>';
    
    return $picture;
}, 10, 5);

function tcc_get_picture_tag($src, $alt = '', $classes = '', $styles = '') {
    $picture = '<picture class="tcc-picture-wrapper">';
    
    if (strpos($src, 'unsplash.com') !== false) {
        $avif_src = str_replace('auto=format', 'fm=avif', $src);
        $picture .= '<source srcset="' . esc_url($avif_src) . '" type="image/avif">';
    } else {
        $is_png = preg_match('/\.png$/i', $src);
        $optimized_src = $is_png ? preg_replace('/\.png$/i', '.webp', $src) : preg_replace('/\.(jpg|jpeg|webp)$/i', '.avif', $src);
        $type = $is_png ? 'image/webp' : 'image/avif';
        if ( tcc_avif_exists_locally($optimized_src) ) {
            $picture .= '<source srcset="' . esc_url($optimized_src) . '" type="' . esc_attr($type) . '">';
        }
    }
    
    $picture .= '<img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" class="' . esc_attr($classes) . '" style="' . esc_attr($styles) . '" />';
    $picture .= '</picture>';
    return $picture;
}

// add_filter('the_content', function($content) {
//    return $content; // Temporarily disabled for ad testing
// }, 99);

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
        'decluttering' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'decluttering'],
        'living-minimally' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'living-minimally'],
        'travel-guide' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'travel-guide'],
        'reviews' => ['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'reviews'],
    ];

    $btn_texts = [
        'decluttering' => 'READ MORE DECLUTTERING POSTS',
        'living-minimally' => 'READ MORE LIVING MINIMALLY POSTS',
        'travel-guide' => 'READ MORE TRAVEL GUIDES',
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
                $is_png = preg_match('/\.png$/i', $img_url);
                $optimized_url = $is_png ? preg_replace('/\.png$/i', '.webp', $img_url) : preg_replace('/\.(jpg|jpeg|webp)$/i', '.avif', $img_url);
                if ( function_exists('tcc_avif_exists_locally') && tcc_avif_exists_locally($optimized_url) ) {
                    $img_url = $optimized_url;
                }
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

/**
 * Mega Menu Walker
 */
require_once get_template_directory() . '/tcc_mega_menu_walker.php';

/* ==========================================================================
   CUSTOM AJAX CONTACT FORM ENDPOINT
   ========================================================================== */
add_action('rest_api_init', function () {
    register_rest_route('tcc/v1', '/contact', array(
        'methods' => 'POST',
        'callback' => 'tcc_handle_contact_form',
        'permission_callback' => '__return_true',
    ));
});

function tcc_handle_contact_form($request) {
    $params = $request->get_json_params();
    if (empty($params['name']) || empty($params['email']) || empty($params['message'])) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }
    
    $name = sanitize_text_field($params['name']);
    $email = sanitize_email($params['email']);
    $subject = !empty($params['subject']) ? sanitize_text_field($params['subject']) : 'New Contact Form Submission';
    $message = sanitize_textarea_field($params['message']);
    
    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Please provide a valid email address.', array('status' => 400));
    }
    
    $to = 'thecombocloset111@gmail.com';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $to . '>',
        'Reply-To: ' . $email
    );
    
    $body = '<h3>New Contact Message from ' . $name . '</h3>';
    $body .= '<p><strong>Email:</strong> ' . $email . '</p>';
    $body .= '<p><strong>Subject:</strong> ' . $subject . '</p>';
    $body .= '<p><strong>Message:</strong><br/>' . nl2br($message) . '</p>';
    
    $sent = wp_mail($to, 'Contact Form: ' . $subject, $body, $headers);
    
    if ($sent) {
        return rest_ensure_response(array('success' => true, 'message' => 'Message sent successfully.'));
    } else {
        return new WP_Error('send_failed', 'Sorry, the message could not be sent. Please try again later.', array('status' => 500));
    }
}

/**
 * Custom Meta Box for Homepage Card Title
 */
function tcc_add_custom_box() {
    add_meta_box(
        'tcc_homepage_card_title_id',           // Unique ID
        'Homepage Card Short Title',  // Box title
        'tcc_custom_box_html',  // Content callback
        'post'                   // Post type
    );
}
add_action( 'add_meta_boxes', 'tcc_add_custom_box' );

function tcc_custom_box_html( $post ) {
    $value = get_post_meta( $post->ID, '_tcc_homepage_card_title', true );
    wp_nonce_field( 'tcc_save_meta_box_data', 'tcc_meta_box_nonce' );
    ?>
    <label for="tcc_homepage_card_title"><strong>Short Title (for The Latest section cards):</strong></label>
    <input type="text" id="tcc_homepage_card_title" name="tcc_homepage_card_title" value="<?php echo esc_attr( $value ); ?>" style="width:100%; margin-top:10px; padding: 5px;" />
    <p class="description">If left blank, the default long post title will be used.</p>
    <?php
}

function tcc_save_postdata( $post_id ) {
    if ( ! isset( $_POST['tcc_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['tcc_meta_box_nonce'], 'tcc_save_meta_box_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['tcc_homepage_card_title'] ) ) {
        update_post_meta( $post_id, '_tcc_homepage_card_title', sanitize_text_field( $_POST['tcc_homepage_card_title'] ) );
    }
}
add_action( 'save_post', 'tcc_save_postdata' );

/**
 * Automatically inject Table of Contents into Single Posts
 */
function tcc_auto_inject_toc( $content ) {
    if ( ! is_single() || ! in_the_loop() || ! is_main_query() || get_post_type() !== 'post' || in_category( 'wardrobe' ) ) {
        return $content;
    }

    // Find all h2 and h3
    $pattern = '/<h([2-3])([^>]*)>(.*?)<\/h\1>/is';
    if ( ! preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
        return $content;
    }

    $toc_items = array();
    foreach ( $matches as $match ) {
        $full_match = $match[0];
        $level      = $match[1];
        $attributes = $match[2];
        $text       = wp_strip_all_tags( $match[3] );
        
        // Extract or create ID
        if ( preg_match( '/id=[\'"]([^\'"]+)[\'"]/', $attributes, $id_match ) ) {
            $id = $id_match[1];
        } else {
            $id = sanitize_title( $text );
            // Replace full match in content to inject ID
            $new_heading = sprintf( '<h%1$s%2$s id="%3$s">%4$s</h%1$s>', $level, $attributes, esc_attr( $id ), $match[3] );
            $content = str_replace( $full_match, $new_heading, $content );
        }
        
        $toc_items[] = array(
            'level' => $level,
            'id'    => $id,
            'text'  => $text,
        );
    }

    if ( empty( $toc_items ) ) {
        return $content;
    }

    $visible_limit = 4;
    $has_hidden = count( $toc_items ) > $visible_limit;

    ob_start();
    ?>
    <div class="tcc-toc-container">
        <h2 class="tcc-toc-title">Table of Contents</h2>
        <ul class="tcc-toc-list">
            <?php foreach ( $toc_items as $index => $item ) : ?>
                <?php 
                    $class = 'tcc-toc-item';
                    if ( $item['level'] == '3' ) {
                        $class .= ' tcc-toc-item-h3';
                    }
                    if ( $index >= $visible_limit ) {
                        $class .= ' tcc-toc-hidden-item';
                    }
                ?>
                <li class="<?php echo esc_attr( $class ); ?>">
                    <a href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ( $has_hidden ) : ?>
            <div class="tcc-toc-expand">
                <button type="button" class="tcc-toc-expand-btn">
                    <span class="tcc-toc-expand-icon">+</span> <span class="tcc-toc-expand-text">VIEW MORE</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var expandBtns = document.querySelectorAll('.tcc-toc-expand-btn');
        expandBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var container = this.closest('.tcc-toc-container');
                container.classList.toggle('tcc-toc-is-expanded');
                var textSpan = this.querySelector('.tcc-toc-expand-text');
                var iconSpan = this.querySelector('.tcc-toc-expand-icon');
                if (container.classList.contains('tcc-toc-is-expanded')) {
                    textSpan.textContent = 'VIEW LESS';
                    iconSpan.textContent = '-';
                } else {
                    textSpan.textContent = 'VIEW MORE';
                    iconSpan.textContent = '+';
                }
            });
        });
    });
    </script>
    <?php
    $toc_html = ob_get_clean();

    // Insert TOC immediately before the first heading
    if ( preg_match('/<h[23][^>]*>/i', $content, $match, PREG_OFFSET_CAPTURE) ) {
        $first_heading_pos = $match[0][1];
        return substr( $content, 0, $first_heading_pos ) . $toc_html . substr( $content, $first_heading_pos );
    }

    return $toc_html . $content;
}
add_filter( 'the_content', 'tcc_auto_inject_toc', 20 );

/**
 * Force author archives to load author.php even if they have 0 posts.
 */
add_filter( 'pre_handle_404', function( $preempt, $query ) {
    if ( $query->is_main_query() && ( $query->get( 'author_name' ) || $query->get( 'author' ) ) ) {
        $query->is_404 = false;
        $query->is_author = true;
        $query->is_archive = true;
        return true; // Bypass default 404 handling
    }
    return $preempt;
}, 10, 2 );


add_action( 'init', function() {
    add_rewrite_rule('^author/([^/]+)/?$', 'index.php?author_name=$matches[1]', 'top');
    if ( ! get_option( 'tcc_flushed_rules_v3' ) ) {
        flush_rewrite_rules(false);
        update_option( 'tcc_flushed_rules_v3', 1 );
    }
});

add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_author() ) {
        $query->set( 'post_type', 'any' );
    }
});

add_action('init', function() {
    if (!file_exists(ABSPATH . 'debug-pages.txt')) {
        global $wpdb;
        $pages = $wpdb->get_results("SELECT post_title, post_name, post_type FROM wp_posts WHERE post_type='page' AND post_status='publish'");
        $out = print_r($pages, true);
        file_put_contents(ABSPATH . 'debug-pages.txt', $out);
    }
});

add_action('template_redirect', function() {
    global $wp_query, $template;
    $log = date('Y-m-d H:i:s') . ' | URI: ' . $_SERVER['REQUEST_URI'] . ' | is_author: ' . ($wp_query->is_author ? 'yes' : 'no') . ' | author_name: ' . $wp_query->get('author_name') . ' | template: ' . $template . "\n";
    file_put_contents(ABSPATH . 'debug-requests.txt', $log, FILE_APPEND);
});

add_filter('redirect_canonical', function($redirect_url, $requested_url) {
    if ( is_author() || get_query_var( 'author_name' ) ) {
        return false;
    }
    return $redirect_url;
}, 10, 2);

add_action('init', function() {
    if (strpos($_SERVER['REQUEST_URI'], '/author/') !== false) {
        preg_match('#/author/([^/]+)#', $_SERVER['REQUEST_URI'], $matches);
        if (!empty($matches[1])) {
            $slug = sanitize_title($matches[1]);
            $user = get_user_by('slug', $slug);
            
            global $wp_query;
            $args = array(
                'author_name' => $slug,
                'post_type' => 'any',
                'posts_per_page' => get_option('posts_per_page'),
            );
            $wp_query = new WP_Query($args);
            
            $wp_query->is_404 = false;
            $wp_query->is_author = true;
            $wp_query->is_archive = true;
            
            if ($user) {
                $wp_query->queried_object = $user;
                $wp_query->queried_object_id = $user->ID;
            }
            
            status_header(200);
            include( get_stylesheet_directory() . '/author.php' );
            exit;
        }
    }
}, 1);

/**
 * Enqueue custom block editor scripts
 */
add_action( 'enqueue_block_editor_assets', 'tcc_enqueue_editor_featured_image_script' );
function tcc_enqueue_editor_featured_image_script() {
    wp_enqueue_script(
        'tcc-editor-featured-image',
        get_stylesheet_directory_uri() . '/assets/js/editor-featured-image.js',
        array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-hooks', 'wp-compose', 'wp-data' ),
        filemtime( get_stylesheet_directory() . '/assets/js/editor-featured-image.js' ),
        true
    );
}

/**
 * Shoppable Videos Meta Boxes
 */
function tcc_shoppable_video_meta_boxes() {
    add_meta_box(
        'tcc_shoppable_video_details',
        'Video Details & Shopping Links',
        'tcc_shoppable_video_html',
        'shoppable_video',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'tcc_shoppable_video_meta_boxes' );

function tcc_shoppable_video_html( $post ) {
    wp_nonce_field( 'tcc_save_shoppable_video', 'tcc_shoppable_video_nonce' );
    $video_url = get_post_meta( $post->ID, '_tcc_video_url', true );
    $shopping_links = get_post_meta( $post->ID, '_tcc_video_products', true );
    $direct_shop_url = get_post_meta( $post->ID, '_tcc_direct_shop_url', true );
    ?>
    <p>
        <label for="tcc_video_url"><strong>Video URL (Instagram, TikTok, or direct .mp4):</strong></label><br>
        <input type="text" id="tcc_video_url" name="tcc_video_url" value="<?php echo esc_attr( $video_url ); ?>" style="width:100%; max-width:600px; margin-top:5px;" />
    </p>
    <hr style="margin:20px 0;">
    <p>
        <label for="tcc_direct_shop_url"><strong>Direct Shop Link (LTK, Amazon, etc.):</strong></label><br>
        <input type="url" id="tcc_direct_shop_url" name="tcc_direct_shop_url" value="<?php echo esc_attr( $direct_shop_url ); ?>" style="width:100%; max-width:600px; margin-top:5px;" />
        <br><small>If you paste a URL here, the "Shop Now" button will link straight to it (no shortcodes needed!).</small>
    </p>
    <p><strong>- OR -</strong></p>
    <p>
        <label for="tcc_video_products"><strong>Shopping Products (Shortcodes):</strong></label><br>
        <textarea id="tcc_video_products" name="tcc_video_products" rows="5" style="width:100%; max-width:600px; margin-top:5px;"><?php echo esc_textarea( $shopping_links ); ?></textarea>
        <br><small>Paste your [shop_product] shortcodes here to show a grid of products inside the video popup.</small>
    </p>
    <?php
}

function tcc_save_shoppable_video( $post_id ) {
    if ( ! isset( $_POST['tcc_shoppable_video_nonce'] ) || ! wp_verify_nonce( $_POST['tcc_shoppable_video_nonce'], 'tcc_save_shoppable_video' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['tcc_video_url'] ) ) {
        update_post_meta( $post_id, '_tcc_video_url', sanitize_text_field( $_POST['tcc_video_url'] ) );
    }
    if ( isset( $_POST['tcc_direct_shop_url'] ) ) {
        update_post_meta( $post_id, '_tcc_direct_shop_url', esc_url_raw( $_POST['tcc_direct_shop_url'] ) );
    }
    if ( isset( $_POST['tcc_video_products'] ) ) {
        update_post_meta( $post_id, '_tcc_video_products', wp_kses_post( $_POST['tcc_video_products'] ) );
    }
}
add_action( 'save_post_shoppable_video', 'tcc_save_shoppable_video' );



/**
 * Custom Pinterest Hover Save Button (Smooth CSS version)
 */
function tcc_add_custom_pinterest_hover_script() {
    // Only load on single blog posts, and specifically EXCLUDE the 'wardrobe' category
    if ( is_single() && get_post_type() === 'post' && ! in_category( 'wardrobe' ) ) {
        ?>
        <script>
        window.addEventListener('load', function() {
            const images = document.querySelectorAll('.entry-content img, .post-content img, .tcc-post-content img, .article-hero-image');
            const pageUrl = encodeURIComponent(window.location.href);
            const pageTitle = encodeURIComponent(document.title);
            
            images.forEach(img => {
                // Ignore small icons/emojis. Fallback to HTML attributes if lazy-loaded and unrendered.
                const w = img.clientWidth || img.naturalWidth || parseInt(img.getAttribute('width') || 0);
                const h = img.clientHeight || img.naturalHeight || parseInt(img.getAttribute('height') || 0);
                if (w > 0 && w < 200) return;
                if (h > 0 && h < 100) return;
                
                // Prevent double wrapping
                if (img.parentElement.classList.contains('tcc-pin-wrapper')) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'tcc-pin-wrapper';
                
                // Copy some layout styles from the image to the wrapper to prevent layout shift
                wrapper.style.cssFloat = img.style.cssFloat || getComputedStyle(img).float;
                wrapper.style.display = (getComputedStyle(img).display === 'inline' || getComputedStyle(img).display === 'inline-block') ? 'inline-block' : 'block';
                wrapper.style.margin = getComputedStyle(img).margin;
                img.style.margin = '0'; // Reset margin on image so wrapper handles it

                const mediaUrl = encodeURIComponent(img.src);
                const desc = encodeURIComponent(img.alt || document.title);
                const pinUrl = `https://pinterest.com/pin/create/button/?url=${pageUrl}&media=${mediaUrl}&description=${desc}`;

                const btn = document.createElement('button');
                btn.onclick = function() { window.open(pinUrl, '_blank'); };
                btn.className = 'tcc-pin-btn';
                btn.setAttribute('data-pin-do', 'none'); // Extra protection
                btn.innerHTML = `<svg viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.183 0 7.437 2.983 7.437 6.961 0 4.155-2.617 7.502-6.255 7.502-1.22 0-2.368-.634-2.763-1.385l-.754 2.873c-.273 1.042-1.011 2.346-1.507 3.141 1.144.335 2.35.513 3.593.513 6.62 0 11.986-5.367 11.986-11.988C24.004 5.367 18.638 0 12.017 0z"/></svg> Save`;

                img.parentNode.insertBefore(wrapper, img);
                wrapper.appendChild(img);
                wrapper.appendChild(btn);
            });
        });
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'tcc_add_custom_pinterest_hover_script', 99 );
function tcc_pinterest_button_inline_css() {
    ?>
    <style>
    /* INLINE CSS TO BYPASS ANY CACHING PLUGINS */
    .tcc-pin-wrapper { position: relative; display: inline-block; max-width: 100%; }
    .tcc-pin-btn {
        position: absolute; top: 20px; left: 20px;
        background-color: #E60023 !important;
        color: #ffffff !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        font-size: 14px !important; font-weight: 700; padding: 8px 12px; border-radius: 24px;
        text-decoration: none; display: flex; align-items: center; gap: 6px;
        opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease, background-color 0.2s ease;
        z-index: 999; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.3) !important;
        border: none !important;
    }
    .tcc-pin-btn:hover { background-color: #ad081b !important; color: #ffffff !important; }
    .tcc-pin-btn svg { width: 16px; height: 16px; fill: currentColor; }
    .tcc-pin-wrapper:hover .tcc-pin-btn { opacity: 1; visibility: visible; }
    </style>
    <?php
}
add_action( 'wp_head', 'tcc_pinterest_button_inline_css', 999 );

/* ==========================================================================
   TECHNICAL SEO SAFEGUARDS
   ========================================================================== */

// 1. SEO Content Quality Enforcer
function tcc_seo_content_quality_check() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'post' ) return;
    
    global $post;
    if ( ! $post || $post->post_status !== 'publish' ) return;
    
    $word_count = str_word_count( strip_tags( strip_shortcodes( $post->post_content ) ) );
    
    if ( $word_count < 500 ) {
        echo '<div class="notice notice-error is-dismissible" style="border-left-color: #E60023;">';
        echo '<p><strong>🚨 SEO WARNING:</strong> This post only has ' . $word_count . ' words. Google considers posts under 500 words to be "thin content" and is highly likely to flag it as <em>"Crawled - currently not indexed"</em>. Please add more valuable content to force indexing!</p>';
        echo '</div>';
    }
}
add_action( 'admin_notices', 'tcc_seo_content_quality_check' );

// 2. Automatic Image SEO (Alt Tag Automator)
function tcc_add_auto_image_alt_tags( $content ) {
    global $post;
    if ( ! $post ) return $content;

    $post_title = esc_attr( $post->post_title );
    
    // Replace empty alt attributes: alt="" or alt=''
    $new_content = preg_replace('/alt=([\'"])\s*([\'"])/i', 'alt=$1' . $post_title . '$2', $content);
    if ( $new_content !== null ) {
        $content = $new_content;
    }
    
    // Add alt attribute if missing entirely (using a safer regex to prevent backtrack limit crashes)
    $new_content = preg_replace('/<img(?![^>]*\balt=)([^>]+)>/i', '<img$1 alt="' . $post_title . '">', $content);
    if ( $new_content !== null ) {
        $content = $new_content;
    }
    
    return $content;
}
add_filter( 'the_content', 'tcc_add_auto_image_alt_tags', 99 );

// 3. Crawl Budget Protector
function tcc_crawl_budget_protector() {
    // If it's a useless page that wastes Google's crawl budget, force noindex
    if ( is_tag() || is_category() || is_author() || is_date() || is_attachment() || is_search() || is_404() ) {
        echo '<!-- Crawl Budget Protector: Forcing Noindex on Low-Value Page -->';
        echo '<meta name="robots" content="noindex, follow" />';
    }
}
add_action( 'wp_head', 'tcc_crawl_budget_protector', 1 );

/* ==========================================================================
   SPEED OPTIMIZATIONS (Core Web Vitals)
   ========================================================================== */

// 1. Optimized Google Fonts Loader (Fixes FOUT / layout shifts)
function tcc_async_google_fonts() {
    $font_url = 'https://fonts.googleapis.com/css2?display=block&family=Inter:wght@400;500;700;800&family=Playfair+Display:wght@400;700&family=Great+Vibes&family=Sacramento&family=Allura&family=Herr+Von+Muellerhoff&family=Antic+Didone&family=Adamina&family=Marcellus&family=Public+Sans:wght@600&family=Poppins:wght@400&family=Bodoni+Moda:wght@400&family=Vidaloka';
    
    echo "<!-- OPTIMIZED GOOGLE FONTS LOADER -->\n";
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";
    echo "<link rel='preload' as='style' href='" . esc_url($font_url) . "'>\n";
    echo "<link rel='stylesheet' media='print' onload=\"this.media='all'\" href='" . esc_url($font_url) . "'>\n";
    echo "<noscript><link rel='stylesheet' href='" . esc_url($font_url) . "'></noscript>\n";
}
add_action( 'wp_head', 'tcc_async_google_fonts', 2 );

// 2. Defer Non-Critical JavaScript Execution
function tcc_defer_scripts( $tag, $handle, $src ) {
    // The handles of scripts we want to defer
    $defer_scripts = array( 'tcc-main', 'tcc-lightbox' );
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . esc_url( $src ) . '" defer="defer"></script>' . "\n";
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'tcc_defer_scripts', 10, 3 );

/* ==========================================================================
   INLINE READ MORE SHORTCODE
   ========================================================================== */

function tcc_get_reading_time( $post_id ) {
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( strip_shortcodes( $content ) ) );
    $reading_time = ceil( $word_count / 200 ); // average reading speed 200 wpm
    if ($reading_time < 1) $reading_time = 1;
    return $reading_time . ' min read';
}

function tcc_read_more_shortcode( $atts ) {
    global $post;
    
    // Get the first category of the current post
    $categories = get_the_category( $post->ID );
    $category_name = 'Fashion';
    $category_link = '#';
    $category_id = 0;
    
    if ( ! empty( $categories ) ) {
        $category_name = esc_html( $categories[0]->name );
        $category_link = esc_url( get_category_link( $categories[0]->term_id ) );
        $category_id = $categories[0]->term_id;
    }
    
    // Query 3 related posts
    $args = array(
        'cat'            => $category_id,
        'post__not_in'   => array( $post->ID ),
        'posts_per_page' => 3,
        'orderby'        => 'rand'
    );
    $related = new WP_Query( $args );
    
    if ( ! $related->have_posts() ) {
        return '';
    }
    
    ob_start();
    ?>
    <div class="tcc-inline-read-more">
        <div class="rm-header">
            <span class="rm-prefix">Read More on </span><a href="<?php echo $category_link; ?>" class="rm-category"><?php echo $category_name; ?></a>
        </div>
        <div class="rm-posts-container">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="rm-post-link">
                    <div class="rm-post-info">
                        <h4 class="rm-title"><?php echo wp_trim_words( get_the_title(), 12, '...' ); ?></h4>
                        <span class="rm-time"><?php echo tcc_get_reading_time( get_the_ID() ); ?></span>
                    </div>
                    <div class="rm-thumbnail">
                        <?php 
                        if ( has_post_thumbnail() ) {
                            $bg_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                        } else {
                            $bg_url = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=112&q=80';
                        }
                        ?>
                        <div style="width: 100%; height: 100%; background-image: url('<?php echo esc_url($bg_url); ?>'); background-size: cover; background-position: center; border-radius: 0;"></div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'tcc_read_more', 'tcc_read_more_shortcode' );

// Forcefully enable Gutenberg Fullscreen Mode to hide the left sidebar & blend Yoast SEO
// Forcefully enable Gutenberg Fullscreen Mode to hide the left sidebar & blend Yoast SEO
// Forcefully enable Gutenberg Fullscreen Mode to hide the left sidebar
add_action( 'enqueue_block_editor_assets', function() {
    $script = "
        // Force Fullscreen Mode safely when DOM is ready
        wp.domReady(function() {
            setTimeout(function() {
                if (wp && wp.data && wp.data.select('core/edit-post')) {
                    const isFullscreen = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');
                    if (!isFullscreen) {
                        wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
                    }
                }
            }, 500);
        });
    ";
    wp_add_inline_script( 'wp-edit-post', $script );
} );

/**
 * Get a fallback image for posts without a featured image.
 * It dynamically extracts the first image from the post content so users aren't shown random dummy images.
 */
function tcc_get_fallback_image($post_id) {
    // Check for explicit dummy meta
    $dummy_img = get_post_meta( $post_id, '_tcc_dummy_image', true );
    if ( $dummy_img && strpos($dummy_img, 'unsplash.com') === false ) {
        return $dummy_img; // Only return if it's not a hardcoded unsplash dummy
    }
    
    // Extract first image from post content
    $post = get_post( $post_id );
    if ( $post ) {
        // Find standard img tags or wp:image block src
        if ( preg_match( '/<img.*?src=["\'](.*?)["\'].*?>/i', $post->post_content, $matches ) && ! empty( $matches[1] ) ) {
            return $matches[1];
        }
    }
    
    // Return a transparent 1x1 pixel if absolutely no images exist
    return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
}

// Forcefully activate Gutenberg plugin for the user
add_action('admin_init', function() {
    $active_plugins = get_option('active_plugins');
    if (is_array($active_plugins) && !in_array('gutenberg/gutenberg.php', $active_plugins)) {
        $active_plugins[] = 'gutenberg/gutenberg.php';
        update_option('active_plugins', $active_plugins);
    }
});

// Force all category outputs in lists/breadcrumbs to be Title Case (fixes ALL CAPS database names)
add_filter( 'the_category', 'tcc_capitalize_categories' );
function tcc_capitalize_categories( $thelist ) {
    return preg_replace_callback( '/>([^<]+)<\/a>/', function( $matches ) {
        return '>' . ucwords( strtolower( $matches[1] ) ) . '</a>';
    }, $thelist );
}

/**
 * Automatically clean up messy HTML (excessive spacing/gaps) generated by Google Sheet automations.
 * This runs in the background when the automation creates the draft, so the HTML is perfectly clean
 * before the user ever clicks "Convert to blocks".
 */
add_filter( 'wp_insert_post_data', 'tcc_clean_automation_html', 10, 2 );
function tcc_clean_automation_html( $data, $postarr ) {
    // Only apply to posts to prevent breaking pages or other features
    if ( $data['post_type'] !== 'post' ) {
        return $data;
    }

    $content = wp_unslash($data['post_content']);

    // 1. Google Docs uses hidden <span> tags and &#160; (non-breaking spaces). 
    // Strip empty spans first so the paragraph becomes empty.
    $content = preg_replace('/<span[^>]*>(\s|&nbsp;|&#160;|<br\s*\/?>)*<\/span>/i', '', $content);

    // 2. Strip out empty paragraphs (e.g., <p></p>, <p>&nbsp;</p>, <p>&#160;</p>, <p><br></p>)
    $content = preg_replace('/<p[^>]*>(\s|&nbsp;|&#160;|<br\s*\/?>)*<\/p>/i', '', $content);

    // 3. Remove multiple consecutive <br> tags (more than 1) which create huge gaps below images
    $content = preg_replace('/(<br\s*\/?>\s*){2,}/i', '<br>', $content);

    // 4. Condense excessive newlines (3 or more) down to standard double newlines
    $content = preg_replace("/[\r\n]{3,}/", "\n\n", $content);
    
    // 5. Remove stray non-breaking spaces on empty lines
    $content = preg_replace("/^(&nbsp;|&#160;|\s)+$/m", "", $content);

    // 6. BULLETPROOF IMAGE SCRUBBER: Google Docs/Sheets exports astronomical width values (EMUs).
    // We completely strip EVERY attribute from the <img> tag except 'src' and 'alt'.
    $content = preg_replace_callback('/<img([^>]+)>/i', function($matches) {
        $attrs = $matches[1];
        $new_attrs = '';
        if (preg_match('/src=["\']([^"\']+)["\']/i', $attrs, $src_match)) {
            $new_attrs .= ' src="' . $src_match[1] . '"';
        }
        if (preg_match('/alt=["\']([^"\']*)["\']/i', $attrs, $alt_match)) {
            $new_attrs .= ' alt="' . $alt_match[1] . '"';
        }
        return '<img' . $new_attrs . '>';
    }, $content);

    // 7. Aggressively strip ANY line breaks (<br>) or spaces that immediately follow an image tag.
    $content = preg_replace('/(<img[^>]+>)(?:\s|&nbsp;|&#160;|<br\s*\/?>)+/i', '$1', $content);

    // 8. Strip <br> tags that are sitting at the very end or beginning of a paragraph
    $content = preg_replace('/(<br\s*\/?>\s*)+<\/p>/i', '</p>', $content);
    $content = preg_replace('/<p[^>]*>\s*(<br\s*\/?>\s*)+/i', '<p>', $content);

    // Update and return the sanitized content (must be re-slashed for WordPress DB)
    $data['post_content'] = wp_slash(trim($content));

    return $data;
}
