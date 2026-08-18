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
		'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title" style="font-family: \'Inter\', sans-serif; font-size: 1.4rem; font-weight: 700; color: #333; margin-bottom: 0.5rem; text-align: left; margin-top: 3rem;">',
		'title_reply_after'  => '</h2>',
		'title_reply'        => 'Leave a Reply',
		'comment_notes_before' => '<p class="comment-notes" style="font-family: \'Inter\', sans-serif; font-size: 0.85rem; font-style: italic; color: #555; margin-bottom: 2rem; text-align: left;">Your email address will not be published. Required fields are marked <span style="color: #c95c54;">*</span></p>',
		'class_submit'       => 'tcc-submit-comment',
		'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" style="background: #c2d1c7; color: #444; border: none; padding: 0.8rem 1.2rem; font-family: \'Inter\', sans-serif; font-size: 0.85rem; font-weight: 500; text-transform: uppercase; cursor: pointer; transition: background 0.3s ease;">POST COMMENT</button>',
		'comment_field'      => '<div class="comment-form-comment" style="margin-bottom: 2rem;"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="Comment *" style="width: 100%; padding: 1rem; border: 1px solid #f6f6f6; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none;"></textarea></div>',
		'fields'             => array(
			'author' => '<div class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required="required" placeholder="Name *" style="width: 100%; padding: 1rem; border: 1px solid #eaeaea; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none;" /></div>',
			'email'  => '<div class="comment-form-email"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" required="required" placeholder="Email *" style="width: 100%; padding: 1rem; border: 1px solid #eaeaea; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none;" /></div>',
			'url'    => '<div class="comment-form-url"><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" placeholder="Website" style="width: 100%; padding: 1rem; border: 1px solid #eaeaea; font-family: \'Inter\', sans-serif; font-size: 0.95rem; background: #fff; outline: none;" /></div>',
			'cookies' => '<p class="comment-form-cookies-consent" style="font-family: \'Inter\', sans-serif; font-size: 0.9rem; color: #444; display: flex; align-items: center; gap: 0.5rem;"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . (empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"') . ' style="cursor: pointer;" /> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>'
		)
	) );
	?>
	
	<style>
		.tcc-comments-area form.comment-form {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}
		.tcc-comments-area form.comment-form .comment-notes { width: 100%; order: 1; }
		.tcc-comments-area form.comment-form .comment-form-comment { width: 100%; order: 2; margin-bottom: 2rem; }
		.tcc-comments-area form.comment-form .comment-form-author { width: 48%; order: 3; margin-bottom: 1.5rem; }
		.tcc-comments-area form.comment-form .comment-form-email { width: 48%; order: 4; margin-bottom: 1.5rem; }
		.tcc-comments-area form.comment-form .comment-form-url { width: 100%; order: 5; margin-bottom: 1.5rem; }
		.tcc-comments-area form.comment-form .comment-form-cookies-consent { width: 100%; order: 6; margin-bottom: 1.5rem; }
		.tcc-comments-area form.comment-form p.comment-subscription-form { width: 100%; order: 7; margin-bottom: 0.5rem; font-family: 'Inter', sans-serif; font-size: 0.9rem; color: #444; }
		.tcc-comments-area form.comment-form .form-submit { width: 100%; order: 8; margin-top: 0.5rem; }
		
		@media (max-width: 600px) {
			.tcc-comments-area form.comment-form .comment-form-author,
			.tcc-comments-area form.comment-form .comment-form-email {
				width: 100%;
			}
		}
	</style>

</div><!-- #comments -->
