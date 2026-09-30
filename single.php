<?php
/**
 * The template for displaying all single posts
 */

if ( in_category( 'wardrobe' ) ) {
	// Wardrobe gets the centered layout
	get_template_part( 'single-centered' );
} else {
	// The other 5 categories get the new figma layout
	get_template_part( 'single-figma' );
}
