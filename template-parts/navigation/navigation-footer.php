<?php
/**
 * Menu Footer
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( has_nav_menu( 'social' ) ) : ?>

	<nav class="footer-nav-links col-md-12" role="navigation" aria-label="<?php esc_attr_e( 'Footer Nav Links', 'pbt-wp' ); ?>">
	<?php
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class'     => 'social-links-menu',
			'depth'          => 1,
		) );
	?>
	</nav><!-- footer-nav-links -->

<?php endif; ?>

