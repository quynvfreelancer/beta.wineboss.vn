<?php
/**
* The template for displaying comments.
*
* The area of the page that contains both current comments
* and the comment form.
*
* @package _mbbasetheme
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
<div id="comments" class="comments-area clearfix  ">
	<?php if ( have_comments() ) : ?>
		<?php 
		$current_post_id = get_the_ID();
		$comment_number  = get_comments_number( $current_post_id);
		?>
		<h3 class="comment-section-title">Bình luận (<span style="color:#00af91;"><?php echo $comment_number; ?></span>)</h3>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'type'=>'comment',
				'style'      => 'ol',
				'short_ping' => true,
				'reply_text' =>'Trả lời',
				'callback' => 'wb_theme_comment',
				'avatar_size' =>50
			) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h4 class="screen-reader-text"><?php _e( 'Xem thêm bình luận', '_mbbasetheme' ); ?></h4>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Bình luận cũ hơn', '_mbbasetheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Bình luận mới nhất &rarr;', '_mbbasetheme' ) ); ?></div>
		</nav>
	<?php endif;  ?>
	<?php else: ?>
		<p class="response-none">Trở thành người đầu tiên bình luận cho bài viết này!</p>
	<?php endif;  ?>

	<?php

	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
	<p class="no-comments"><?php _e( 'Comments are closed.', '_mbbasetheme' ); ?></p>
<?php endif; ?>
<?php
$str ='<div class="w-100">';
$str .='<p class="comment-form-comment">';
$str .='<label for="comment">Nội dung bình luận</label><textarea class="form-control" id="comment" name="comment" placeholder="Nội dung bình luận"  rows="5" aria-required="true"></textarea>';
$str .='</p></div>';
$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="comment-form-author ">' . '<input class="form-control" id="author" placeholder=" Họ tên" name="author" type="text" value="' .
			esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
			'</div>'
			,
			'email'  => '<div class="comment-form-email ">' . '<input class="form-control" id="email" placeholder="Email của bạn" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30" />'  .
			'</div>',
			
		)
	),
	'comment_field' => $str,
	'comment_notes_after' => '',
	'title_reply' => '',
	'label_submit' => 'Gửi bình luận',
	'title_reply_to'    => __( 'Trả lời %s' ),
	'cancel_reply_link' => __( 'Hủy trả lời' ),
);

comment_form($args);
?>
</div><!-- #comments -->