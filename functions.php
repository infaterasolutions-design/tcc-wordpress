<?php
/**
 * The Combo Closet functions and definitions
 */

if ( ! defined( 'TCC_VERSION' ) ) {
	define( 'TCC_VERSION', '1.0.5' );
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
	// Google Fonts
	wp_enqueue_style( 'tcc-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400&family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Great+Vibes&display=swap', array(), null );
	
	// Theme stylesheet
	wp_enqueue_style( 'tcc-style', get_stylesheet_uri(), array(), TCC_VERSION );
    
	// Tailwind CSS v4 via compiled style.css

	// Main JS for AJAX
	wp_enqueue_script( 'tcc-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );
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

add_action('wp_enqueue_scripts', function() {
    if (!is_admin_bar_showing()) {
        wp_deregister_style('dashicons');
    }
}, 20);

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * 4. AVIF Upload Hook & Picture Tag Filter
 */
add_filter('wp_generate_attachment_metadata', function($metadata, $attachment_id) {
    if ( ! class_exists( 'Imagick' ) ) return $metadata;
    $file = get_attached_file($attachment_id);
    if ( ! $file || ! file_exists( $file ) ) return $metadata;
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ( ! in_array( $ext, ['jpg', 'jpeg', 'png', 'webp'] ) ) return $metadata;

    $generate_avif = function($source_file) {
        $avif_file = preg_replace('/\.[a-zA-Z0-9]+$/', '.avif', $source_file);
        if ( ! file_exists( $avif_file ) ) {
            try {
                $image = new Imagick($source_file);
                $image->setImageFormat('avif');
                $image->setImageCompressionQuality(80);
                $image->writeImage($avif_file);
                $image->clear();
                $image->destroy();
            } catch ( Exception $e ) {
                error_log('AVIF generation failed: ' . $e->getMessage());
            }
        }
    };

    $generate_avif($file);
    
    if ( isset($metadata['sizes']) && is_array($metadata['sizes']) ) {
        $base_dir = dirname($file);
        foreach ( $metadata['sizes'] as $size => $size_info ) {
            $size_file = $base_dir . '/' . $size_info['file'];
            if ( file_exists($size_file) ) {
                $generate_avif($size_file);
            }
        }
    }
    
    return $metadata;
}, 10, 2);

add_filter('post_thumbnail_html', function($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if ( empty($html) ) return $html;
    
    $src = wp_get_attachment_image_url($post_thumbnail_id, $size);
    if ( ! $src ) return $html;
    
    $avif_src = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $src);
    
    // Check if the AVIF file actually exists on disk
    $upload_dir = wp_get_upload_dir();
    $avif_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $avif_src );
    if ( ! file_exists( $avif_path ) ) {
        return $html;
    }
    
    $picture = '<picture class="tcc-picture-wrapper" style="display: block; width: 100%; height: 100%;">';
    $picture .= '<source srcset="' . esc_url($avif_src) . '" type="image/avif">';
    $picture .= $html;
    $picture .= '</picture>';
    
    return $picture;
}, 10, 5);
