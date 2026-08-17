<?php
/**
 * Template part for displaying the author name with a hover card
 */

$author_id = get_the_author_meta( 'ID' );
$author_name = esc_html( get_the_author() );
$author_nicename = get_the_author_meta( 'user_nicename' );
if ( empty( $author_nicename ) ) {
    $author_nicename = sanitize_title( $author_name );
}
// Use a relative URL to ensure it stays on the local testing environment 
// instead of redirecting to the live production site
$author_url = '/author/' . $author_nicename . '/';
$author_bio = wp_kses_post( get_the_author_meta( 'description' ) );
$author_avatar = get_avatar( $author_id, 64, '', $author_name, array( 'class' => 'tcc-author-card-avatar' ) );
?>
<span class="tcc-author-hover-wrapper">
	By <a href="<?php echo $author_url; ?>" class="tcc-author-name"><?php echo $author_name; ?></a>
	
	<div class="tcc-author-hover-card">
		<!-- Pointer triangle -->
		<div class="tcc-author-card-pointer"></div>
		
		<div class="tcc-author-card-header">
			<a href="<?php echo $author_url; ?>">
				<?php echo $author_avatar; ?>
			</a>
			<a href="<?php echo $author_url; ?>" class="tcc-author-card-name"><?php echo $author_name; ?></a>
		</div>
		
		<?php if ( $author_bio ) : ?>
			<p class="tcc-author-card-bio"><?php echo $author_bio; ?></p>
		<?php endif; ?>
	</div>
</span>
