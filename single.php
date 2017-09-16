<?php
/**
 * Template para exibição de Posts
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

									<?php while ( have_posts() ) : the_post(); ?>

										<?php get_template_part( 'template-parts/page/content', get_post_format() ); ?>

										<?php 
										// If comments are open or we have at least one comment, load up the comment template.
											if ( comments_open() || get_comments_number() ) :
												comments_template();
											endif;
										 ?>

									<?php endwhile; ?>

								<!-- Pagination -->

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