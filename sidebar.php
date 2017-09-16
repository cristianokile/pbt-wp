<?php
/**
 * Sidebar contendo a widget área principal
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
*/
?>

<?php 
	if ( ! is_active_sidebar( 'sidebar-1' ) ) :
		return;
	endif;
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
