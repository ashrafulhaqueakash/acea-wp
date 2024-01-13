<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acea
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
if ( have_comments() ):
?>
		<?php the_comments_navigation();?>
		<ol class="comment-list">
			<?php
wp_list_comments(
    array(
        'style'      => 'ol',
        'short_ping' => true,
    )
);
?>
		</ol><!-- .comment-list -->
		<?php
the_comments_navigation();
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( !comments_open() ):
?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'acea' );?></p>
			<?php
endif;
endif; // Check for have_comments().

$commenter      = wp_get_current_commenter();
$req            = get_option( 'require_name_email' );
$aria_req       = ( $req ? " aria-required='true'" : '' );
$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
$html5          = 'html5' === $args['format'];
$fields         = array(
    'author' =>
    '<div class="row"><div class="comment-filed author col-md-12 col-lg-6">' .
    '<input id="author" class = "form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Enter Name', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Enter Name', 'acea' ) . '\'" /></div>',

    'email'  =>
    '<div class="comment-filed email col-md-12 col-lg-6">' .
    '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Enter email address', 'acea') . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Enter email address', 'acea' ) . 's\'"/></div>',

    'url'    =>
    '<div class="comment-filed subject col-12 ">' .
    '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" placeholder="' . esc_attr__( 'Subject', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Subject', 'acea' ) . '\'"/></div>',
);
$args = array(
    'fields'              => $fields,
    'id_form'             => 'commentform',
    'id_submit'           => 'submit',
    'class_form'          => 'comment-form',
    'class_submit'        => 'submit',
    'name_submit'         => 'submit',
    'title_reply'         => '',
    'title_reply_before'  => '<div class="message_heading"><h4 id="reply-title" class="comment-reply-title">' . esc_attr__( 'Leave a reply:', 'acea' ) . '</div>',
    'title_reply_after'   => '</h4>',
    'cancel_reply_before' => ' <small>',
    'cancel_reply_after'  => '</small>',
    'title_reply_to'      => __( '%s', 'acea' ),
    'cancel_reply_link'   => __( 'Cancel Reply', 'acea' ),
    'label_submit'        => __( 'Post Comment', 'acea' ),
    'label_submit'        => __( 'Post Comment', 'acea' ),
    'submit_button'       => '<input name="%1$s" type="submit" id="%2$s" class="%3$s submitbtn" value="%4$s" />',
    'submit_field'        => '<div class="form-group">%1$s %2$s</div>',
    'format'              => 'xhtml',

    'comment_field'       =>
    '<div class="row"><div class="col-12 comment-form-comment">
	  <textarea class = "form-control comment" id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Comment', 'acea' ) . '\'" cols="45" rows="8" aria-required="true">' .
    '</textarea></div>',
);

$twofields = array(
    'author' =>
    '<div class="row"><div class="comment-filed author col-lg-4 col-md-12">' .
    '<input id="author" class = "form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Enter Name', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Enter Name', 'acea' ) . '\'" /></div>',

    'email'  =>
    '<div class="comment-filed email col-lg-4 col-md-12">' .
    '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Enter email address', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Enter email address', 'acea' ) . '\'"/></div>',

    'url'    =>
    '<div class="comment-filed subject col-lg-4 col-md-12 ">' .
    '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" placeholder="' . esc_attr__( 'Subject', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Subject', 'acea' ) . '\'"/></div>',
);
$twoargs = array(
    'fields'              => $twofields,
    'id_form'             => 'commentform',
    'id_submit'           => 'submit',
    'class_form'          => 'comment-form',
    'class_submit'        => 'submit',
    'name_submit'         => 'submit',
    'title_reply'         =>  '',
    'title_reply_before'  => '<div class="message_heading"><h4 id="reply-title" class="comment-reply-title">' . esc_attr__( 'Leave a reply:', 'acea' ) . '</div>',
    'title_reply_after'   => '</h4>',
    'cancel_reply_before' => ' <small>',
    'cancel_reply_after'  => '</small>',
    'title_reply_to'      => __( '%s', 'acea' ),
    'cancel_reply_link'   => __( 'Cancel Reply', 'acea' ),
    'label_submit'        => __( 'Post Comment', 'acea' ),
    'label_submit'        => __( 'Post Comment', 'acea' ),
    'submit_button'       => '<input name="%1$s" type="submit" id="%2$s" class="%3$s submitbtn" value="%4$s" />',
    'submit_field'        => '<div class="form-group">%1$s %2$s</div>',
    'format'              => 'xhtml',

    'comment_field'       =>
    '<div class="row"><div class="col-12 comment-form-comment"><textarea class = "form-control comment" id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'acea' ) . '" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'' . esc_attr__( 'Comment', 'acea' ) . '\'" cols="45" rows="8" aria-required="true">' .
    '</textarea></div></div>',
);

$style = get_theme_mod( 'acea_single_comment_from', 'style-one' );

if ( 'style-two' == $style ) {
    comment_form( $twoargs );
} else {
    comment_form( $args );
}
?>
</div><!-- #comments -->
