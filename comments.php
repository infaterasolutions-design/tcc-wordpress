<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="tcc-comments-area" style="margin-top: 5rem; padding-top: 4rem; border-top: 1px solid #eaeaea;">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title" style="font-family: 'Playfair Display', serif; font-size: 2rem; margin-bottom: 3rem; color: #000; text-align: center;">
			<?php
			$tcc_comment_count = get_comments_number();
			if ( '1' === $tcc_comment_count ) {
				printf( esc_html__( '1 Comment', 'tcc' ) );
			} else {
				printf( esc_html__( '%s Comments', 'tcc' ), number_format_i18n( $tcc_comment_count ) );
			}
			?>
		</h2>

		<ol class="comment-list" style="list-style: none; padding: 0; margin: 0;">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 50,
				'callback'    => 'tcc_custom_comment_markup'
			) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments" style="font-family: 'Inter', sans-serif; font-size: 0.9rem; color: #999; font-style: italic; margin-top: 2rem; text-align: center;">
				<?php esc_html_e( 'Comments are closed.', 'tcc' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	
	comment_form( array(
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title" style="font-family: \'Playfair Display\', serif; font-size: 1.8rem; margin-bottom: 2rem; color: #000; margin-top: 3rem;">',
		'title_reply_after'  => '</h2>',
		'title_reply'        => 'Leave a Comment',
		'class_submit'       => 'tcc-submit-comment',
		'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" style="background: #000; color: #fff; border: 1px solid #000; padding: 1rem 2.5rem; font-family: \'Inter\', sans-serif; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; cursor: pointer; transition: all 0.3s ease;">%4$s</button>',
		'comment_field'      => '<div class="comment-form-comment" style="margin-bottom: 1.5rem;"><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required" placeholder="Your comment here..." style="width: 100%; padding: 1.2rem; border: 1px solid #ddd; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none; transition: border-color 0.3s ease;" onfocus="this.style.borderColor=\'#000\'" onblur="this.style.borderColor=\'#ddd\'"></textarea></div>',
		'fields'             => array(
			'author' => '<div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem;"><div class="comment-form-author" style="flex: 1;"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required="required" placeholder="Name *" style="width: 100%; padding: 1rem 1.2rem; border: 1px solid #ddd; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none; transition: border-color 0.3s ease;" onfocus="this.style.borderColor=\'#000\'" onblur="this.style.borderColor=\'#ddd\'" /></div>',
			'email'  => '<div class="comment-form-email" style="flex: 1;"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" required="required" placeholder="Email *" style="width: 100%; padding: 1rem 1.2rem; border: 1px solid #ddd; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none; transition: border-color 0.3s ease;" onfocus="this.style.borderColor=\'#000\'" onblur="this.style.borderColor=\'#ddd\'" /></div></div>',
			'url'    => '', // Remove website field for a cleaner look
			'cookies' => '' // Hide cookies consent checkbox
		),
		'comment_notes_before' => '',
	) );
	?>

</div><!-- #comments -->
