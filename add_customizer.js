const fs = require('fs');
const themeDir = 'C:\\Users\\sande\\Downloads\\tcc-theme';

let functionsPhp = fs.readFileSync(`${themeDir}\\functions.php`, 'utf8');

const customizerCode = `
/**
 * Register Customizer settings.
 */
function tcc_customize_register( $wp_customize ) {
    // Hero Section
    $wp_customize->add_section( 'tcc_hero_section', array(
        'title'    => __( 'Hero Section', 'tcc' ),
        'priority' => 30,
    ) );

    // Hero Heading
    $wp_customize->add_setting( 'tcc_hero_heading', array(
        'default'           => 'Welcome to Minimalist Sophistication with Maximum Style',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'tcc_hero_heading', array(
        'label'   => __( 'Hero Heading', 'tcc' ),
        'section' => 'tcc_hero_section',
        'type'    => 'text',
    ) );

    // Hero Text
    $wp_customize->add_setting( 'tcc_hero_text', array(
        'default'           => 'Fashion Jackson is an inspired style, home, and beauty destination for those who prefer quality over quantity, subtle over obvious, and ease over complexity.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'tcc_hero_text', array(
        'label'   => __( 'Hero Text', 'tcc' ),
        'section' => 'tcc_hero_section',
        'type'    => 'textarea',
    ) );

    // Hero Image
    $wp_customize->add_setting( 'tcc_hero_image', array(
        'default'           => 'https://fashionjackson.com/wp-content/uploads/2023/06/Header-Portrait-Image.jpeg',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tcc_hero_image', array(
        'label'    => __( 'Hero Image', 'tcc' ),
        'section  ' => 'tcc_hero_section',
        'settings' => 'tcc_hero_image',
    ) ) );
}
add_action( 'customize_register', 'tcc_customize_register' );
`;

if (!functionsPhp.includes('tcc_customize_register')) {
    functionsPhp += customizerCode;
    fs.writeFileSync(`${themeDir}\\functions.php`, functionsPhp, 'utf8');
}
