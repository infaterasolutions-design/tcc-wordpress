<?php
/**
 * Mega Menu Walker for The Combo Closet
 */

class TCC_Mega_Menu_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Default start_el logic
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $title = $item->title;
        $mega_menu_titles = ['Fashion', 'Plus Size', 'Nails', 'Hairstyle'];
        
        // Ensure case-insensitive matching and trim spaces
        $is_mega = false;
        foreach ($mega_menu_titles as $mega_title) {
            if (strtolower(trim($title)) === strtolower(trim($mega_title))) {
                $is_mega = true;
                break;
            }
        }

        if ($is_mega && $depth === 0) {
            $classes[] = 'tcc-mega-menu-parent';
        }

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        
        if ($is_mega && $depth === 0) {
            $atts['aria-expanded'] = 'false';
            $atts['aria-haspopup'] = 'true';
            $atts['class'] = 'tcc-mega-toggle';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
        // Append Mega Menu HTML for top-level mega items
        if ($is_mega && $depth === 0) {
            $output .= $this->get_mega_menu_html($title);
        }
    }
    
    private function get_mega_menu_html($title) {
        $config = [
            'Fashion' => [
                'Outfit Ideas' => 'outfit-ideas',
                'Capsule Wardrobe' => 'capsule-wardrobe',
                'Seasonal Fashion' => 'seasonal-fashion',
                'Shopping Guides' => 'shopping-guides'
            ],
            'Plus Size' => [
                'Workwear Outfits' => 'workwear-outfits',
                'Seasonal Fashion' => 'plus-seasonal-fashion',
                'Fashion Tips' => 'fashion-tips'
            ],
            'Nails' => [
                'Short Nails' => 'short-nails',
                'Long Nails' => 'long-nails',
                'Seasonal Nails' => 'seasonal-nails'
            ],
            'Hairstyle' => [
                'Short Hairstyles' => 'short-hairstyles',
                'Long Hairstyles' => 'long-hairstyles',
                'Hairstyles by Face Shape' => 'hairstyles-face-shape'
            ]
        ];
        
        $key = null;
        foreach($config as $k => $v) {
            if (strtolower(trim($k)) === strtolower(trim($title))) {
                $key = $k;
                break;
            }
        }
        
        if (!$key) return '';
        
        $subcats = $config[$key];
        
        $html = '<div class="tcc-mega-panel" role="menu">';
        $html .= '<div class="tcc-mega-container container">';
        
        // Left Column (Subcategories)
        $html .= '<div class="tcc-mega-left">';
        $html .= '<ul class="tcc-mega-subcats">';
        $first = true;
        foreach ($subcats as $name => $slug) {
            $active_class = $first ? ' tcc-mega-active' : '';
            $subcat_obj = get_category_by_slug($slug);
            $link = $subcat_obj ? get_category_link($subcat_obj->term_id) : home_url('/category/' . $slug);
            $html .= '<li><a href="'.esc_url($link).'" class="tcc-mega-subcat-link'.$active_class.'" data-target="mega-'.esc_attr($slug).'" role="menuitem">'.esc_html($name).'</a></li>';
            $first = false;
        }
        $html .= '</ul>';
        $html .= '</div>';
        
        // Right Column (Posts)
        $html .= '<div class="tcc-mega-right">';
        $first = true;
        foreach ($subcats as $name => $slug) {
            $active_class = $first ? ' tcc-mega-active' : '';
            $html .= '<div class="tcc-mega-posts-group'.$active_class.'" id="mega-'.esc_attr($slug).'">';
            
            // 1. Try real subcategory posts
            $q = new WP_Query([
                'category_name' => $slug,
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'no_found_rows' => true // performance optimization
            ]);
            
            $label = '';
            
            // 2. Fallback to parent category if no posts
            if (!$q->have_posts()) {
                $parent_slug = sanitize_title($key);
                $q = new WP_Query([
                    'category_name' => $parent_slug,
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'no_found_rows' => true
                ]);
                if ($q->have_posts()) {
                    $label = '<div class="tcc-mega-label text-sans uppercase">Latest in ' . esc_html($key) . '</div>';
                }
            }
            
            if ($label) {
                $html .= $label;
            }
            
            if ($q->have_posts()) {
                $html .= '<div class="tcc-mega-posts-grid">';
                while ($q->have_posts()) {
                    $q->the_post();
                    // Fallback to a placeholder if no thumbnail exists to maintain layout
                    $img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium_large') : tcc_get_fallback_image(get_the_ID());
                    $html .= '<a href="'.esc_url(get_permalink()).'" class="tcc-mega-post-card">';
                    $html .= '<div class="tcc-mega-post-img" style="background-image: url('.esc_url($img).');"></div>';
                    $html .= '<h4 class="tcc-mega-post-title text-serif">'.esc_html(get_the_title()).'</h4>';
                    $html .= '</a>';
                }
                wp_reset_postdata();
                $html .= '</div>';
            } else {
                // 3. Clean empty state
                $html .= '<div class="tcc-mega-empty text-sans">No posts available yet. Check back soon!</div>';
            }
            
            $html .= '</div>';
            $first = false;
        }
        $html .= '</div>'; // close right
        
        $html .= '</div>'; // close container
        $html .= '</div>'; // close panel
        
        return $html;
    }
}
