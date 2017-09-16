<?php
/**
 * Template para exibição dos comentários
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
 * 
 * Se o post atual for protegido por senha e
 * o visitante não tiver digitado uma senha, 
 * exibiremos a página sem carregar os comentários.
 */
	if ( post_password_required() ) :
		return;
	endif;
?>

<div id="commentarios" class="comments-area col-md-12">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php $comments_number = get_comments_number();
			if ( '1' === $comments_number ) :
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'pbt_wp' ), get_the_title() );
			else :
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'pbt_wp'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			endif;
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => pbt_wp_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'pbt_wp' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => pbt_wp_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'pbt_wp' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'pbt_wp' ) . '</span>' . pbt_wp_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'pbt_wp' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
