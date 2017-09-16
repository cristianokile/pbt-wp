<?php
/**
 * Template para exibição de exibição de Páginas de Arquivos
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
									<header class="page-archive-title col-md-12">
										<?php if ( have_posts() ) : ?>										
											<?php
												the_archive_title( '<h1 class="page-title">', '</h1>' );
												the_archive_description( '<div class="taxonomy-description">', '</div>' );
											?>										
										<?php endif; ?>
									</header>
									<section class="page-archive-content col-md-12">
										<div class="row">
											<?php if ( have_posts() ) : ?>
												<?php while ( have_posts() ) : the_post();?>
													<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
												<?php endwhile ?>
											<?php else: ?>
												<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
											<?php endif; ?>
										</div>
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