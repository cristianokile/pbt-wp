<?php
/**
 * Arquivo de Front-Page do Tema
 * 
 * Se o usuário selecionar uma página estática para sua homepage, esta será a 
 * página que irá ser exibida.
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
									<?php if ( have_posts() ) : ?>

										<?php if ( is_home() && ! is_front_page() ) : ?>
											<!-- Home ou Front Page -->
										<?php else : ?>
											<!-- Index Comum -->
										<?php endif; ?>

										<?php while ( have_posts() ) : the_post(); ?>

											<?php get_template_part( 'template-parts/page/content', 'front-page' ); ?>

										<?php endwhile; ?>

									<!-- Pagination -->

									<?php else: ?>

										<?php get_template_part( 'template-parts/post/content', 'none' ); ?>

									<?php endif ?>
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