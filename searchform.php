<?php
/**
 * Template para exibição de formulários de busca
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
*/
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<div class="row">
	<form role="search" method="get" class="search-form col-md-12" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="<?php echo $unique_id; ?>">
			<span class="screen-reader-text">
				<?php echo _x( 'Search for:', 'label', 'pbt_wp' ); ?>
			</span>
		</label>
		
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'pbt_wp' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

		<button type="submit" class="search-submit"><?php echo pbt_wp_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'pbt_wp' ); ?></span></button>
	</form>
</div>
