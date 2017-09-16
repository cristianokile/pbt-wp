<?php
/**
 * Template para exibição de resultado de buscas
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
									<header class="page-search-title col-md-12">
										<?php if ( have_posts() ) : ?>
											<h1 class="page-title">
												<?php printf( __( 'Resultados encontrados para: %s', 'pbt-wp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
										<?php else : ?>
											<h1 class="page-title">
												<?php _e( 'Nenhum conteúdo encontrado', 'pbt-wp' ); ?>
											</h1>
										<?php endif; ?>
									</header>
									<section class="page-search-content col-md-12">
										<?php if ( have_posts() ) : ?>
											<?php while ( have_posts() ) : the_post(); ?>
												<?php get_template_part( 'template-parts/post/content', 'excerpt' );?>
											<?php endwhile;?>
										<?php else : ?>
											<p><?php _e( 'Descuilpe, mas não foi encontrado nenhum conteúdo com estes termos. Tente realizar uma busca com novas palavras', 'pbt-wp' ); ?></p>
											<?php get_search_form(); ?>
										<?php endif; ?>
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