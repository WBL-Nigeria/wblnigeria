<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arrowit
 * @since   1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="comment-box">
			<h3 class="comments-title">
				<?php
					if ( get_comments_number() > 1 ){
						echo esc_html__('Comments','arrowit');
					}else{
						echo esc_html__('Comment','arrowit');
					}
				?>
				<span>
					<?php echo '(' . get_comments_number() .')';?>
				</span>
			</h3>
			<div class="comment-list-wrap">
				<?php Arrowit_Templates::comment_navigation( array( 'container_id' => 'comment-nav-above' ) ); ?>
				<ul class="comment-list">
					<?php
					wp_list_comments( array(
						'style'       => 'ul',
						'callback'    => array( 'Arrowit_Templates', 'comment_template' ),
						'short_ping'  => true,
					) );
					?>
				</ul><!-- .comment-list -->
				<?php Arrowit_Templates::comment_navigation( array( 'container_id' => 'comment-nav-below' ) ); ?>
			</div>
		</div>
	<?php endif; // Check for have_comments().
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'arrowit' ); ?></p>
		<?php
	endif;
	?>
	<div class="comment-form-wrap">
		<?php Arrowit_Templates::comment_form(); ?>
	</div>
</div><!-- #comments -->