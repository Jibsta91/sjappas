<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 * @package best-listing
 */

use BestListing\wpWax\Helper as ThemeHelper;

if ( post_password_required() ) {
	return;
}

if ( ! have_comments() && ! comments_open() ) {
	return;
}

$best_listing_post_id         = get_the_ID();
$best_listing_user            = wp_get_current_user();
$best_listing_user_identity   = $best_listing_user->exists() ? $best_listing_user->display_name : '';
$best_listing_comments_number = get_comments_number();
/* translators: %s is replaced with the number of comment */
$best_listing_comments_text = sprintf( _nx( '%s Comment', '%s Comments', $best_listing_comments_number, 'comments title', 'best-listing' ), number_format_i18n( $best_listing_comments_number ) );

$best_listing_comment_args = array(
	'callback' => 'BestListing\wpWax\Helper::comments_callback',
);

$best_listing_comment_form_fields = array(
	'author'        => '<div class="col-md-6"><input name="author" type="text" placeholder="' . esc_attr_x( 'Name*', 'placeholder', 'best-listing' ) . '" class="form-control m-bottom-30" required></div>',
	'email'         => '<div class="col-md-6"><input name="email" type="email" placeholder="' . esc_attr_x( 'Email*', 'placeholder', 'best-listing' ) . '" class="form-control m-bottom-30" required></div>',
	'url'           => '',
	'cookies'       => '',
);

$best_listing_comment_form_args = array(
	'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn theme-btn btn-primary %3$s" value="' . esc_attr_x( 'Post Comment', 'submit button', 'best-listing' ) . '">',
	'submit_field'         => '<div class="col-md-12"><p class="form-submit m-bottom-0">%1$s %2$s</p></div>',
	'title_reply_before'   => '<h3 class="m-bottom-10">',
	'title_reply_after'    => '</h3>',
	'class_form'           => 'comment_form_wrapper row',
	'comment_notes_before' => '<div class="col-md-12"><p class="comment-notes m-bottom-40"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'best-listing' ) . '</span></div>',
	'fields'               => apply_filters( 'best_listing_comment_form_default_fields', $best_listing_comment_form_fields ),
	'comment_field'        => '<div class="col-md-12"><div class="comment-form-comment"><textarea class="form-control m-bottom-30" id="comment" name="comment" placeholder="' . esc_attr_x( 'Your Text*', 'placeholder', 'best-listing' ) . '" required></textarea></div></div>',

	'logged_in_as'         => sprintf(
		'<p class="logged-in-as">%s</p>',
		sprintf(
			/* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
			__( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>', 'best-listing' ),
			get_edit_user_link(),
			/* translators: %s: User name. */
			esc_attr( sprintf( _x( 'Logged in as %s. Edit your profile.', 'Logged in as', 'best-listing' ), $best_listing_user_identity ) ),
			$best_listing_user_identity,
			/** This filter is documented in wp-includes/link-template.php */
			wp_logout_url( apply_filters( 'best_listing_the_permalink', get_permalink( $best_listing_post_id ), $best_listing_post_id ) )
		)
	),
);
?>

<div class="comments-area m-top-50 m-bottom-60" id="comments">

	<?php if ( have_comments() ) : ?>

		<div class="comment-title">

			<h3><?php echo esc_html( $best_listing_comments_text ); ?></h3>

		</div>

		<div class="comment-lists">

			<ul class="media-list list-unstyled">

				<?php wp_list_comments( $best_listing_comment_args ); ?>

			</ul>

		</div>

		<div class="comment-pagination">

			<nav class="navigation pagination d-flex justify-content-center" role="navigation">

				<div class="nav-links">

					<?php 
					paginate_comments_links(
						array(
							'prev_text' => ThemeHelper::get_svg_icon( 'long-arrow-alt-left-solid' ),
							'next_text' => ThemeHelper::get_svg_icon( 'long-arrow-alt-right-solid' ),
						)
					);
					?>

				</div>

			</nav>

		</div>

	<?php endif; ?>

</div>

<?php if ( comments_open() ) : ?>

	<?php comment_form( $best_listing_comment_form_args ); ?>

<?php else : ?>

	<div class="no-comments"><?php esc_html_e( 'Comments are closed.', 'best-listing' ); ?></div>

	<?php 
endif;
