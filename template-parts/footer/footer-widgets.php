<?php
/**
 * Displays footer widgets if assigned
 * Exibe Widgets no Footer, quando ativados
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
 */
?>
<div class="row">
<?php
if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) ) :?>

	<aside class="widget-area col-md-12" role="complementary">
		<div class="row">
			<?php
			if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="widget-column footer-widget-1 col-md-12">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			<?php endif;
			if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<div class="widget-column footer-widget-2 col-md-12">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>

</div>