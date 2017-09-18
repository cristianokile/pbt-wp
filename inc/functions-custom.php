<?php
/**
 * Piece Blank Theme - Funcções e Definições Customizadas do tema
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 */
?>

<?php 

	// REGISTRAR CUSTOM NAVIGATION WALKER
		//require_once('assets/wp-bootstrap-navwalker.php');

	// CUSTOM POSTS
		//require get_parent_theme_file_path( '/template-parts/custom-posts/videos.php' );

	// ADICIONA SUPORTE AO AMP

	define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );
	add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
	add_filter( 'template_include', 'amp_page_template', 99 );

	function amp_page_template( $template ) {
		if( get_query_var( AMP_QUERY_VAR, false ) !== false ) :
	    	if ( is_single() ) :
	      		$template = get_template_directory() .  '/amp-files/amp-single.php';
	    	elseif ( is_page() ) :
	    		$template = get_template_directory() .  '/amp-files/amp-page.php';
	    	endif;   
	  	endif;
	  	return $template;
	};

	function amp_seo() {
		if( is_single() ): ?>
			<link rel="amphtml" href="<?php echo esc_url( get_the_permalink().'amp' ); ?>" />
	    <?php endif; 
	}?>
	<?php add_action('wp_head', 'amp_seo');?>

