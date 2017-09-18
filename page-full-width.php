<?php
/**
 * Template name: Page Full Width
 *
 * Arquivo de Páginas do Tema Full Width
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
*/
?>

<?php get_header(); ?>

	<!-- CONTEÚDO -->

	<div class="container-fluid">
		<div class="row">
			<main class="col-md-12">
				<div class="row">
					<section class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<?php while ( have_posts() ) : the_post(); ?>

										<?php if ( is_home() && ! is_front_page() ) : ?>
											<!-- Home ou Front Page -->
										<?php else : ?>
											<!-- Index Comum -->
										<?php endif; ?>

										<?php get_template_part( 'template-parts/page/content', 'page' ); ?>

										<!-- Comentários -->
										<?php // Se comentários estiverem abertos ou houver ao menos um, carrega o template de comentário.
											if ( comments_open() || get_comments_number() ) :
												comments_template();
											endif;
										 ?>

									<?php endwhile; ?>
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