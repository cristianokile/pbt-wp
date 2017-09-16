<?php
/**
 * Template para exibição de páginas 404 (não encontrado)
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
*/
?>

<?php get_header(); ?>

	<!-- CONTEÚDO -->

	<div class="container">
		<div class="row">
			<main class="col-md-12">
				<div class="row">
					<section class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<header class="error-404 not-found page-404-title col-md-12">
										<h1 class="page-title">
											<?php _e( 'Oops! That page can&rsquo;t be found.', 'pbt-wp' ); ?>
										</h1>
									</header>
									<section class="page-404-content col-md-12">
										<p><?php _e( 'Não foi encontrado nada nesta página. Deseja realizar uma busca?', 'pbt-wp' ); ?></p>
										<?php get_search_form(); ?>
									</section>										
								</div>
							</div>
						</div>
					</section>
				</div>
			</main>
			<?php //get_sidebar(); ?>
		</div>
	</div>
		
<?php get_footer(); ?>