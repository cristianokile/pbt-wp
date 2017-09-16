<?php
/**
 * Arquivo de Footer do Template
 *
 * Contem o fechamento do conteudo das divs e de todos os conteudos posteriores
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 * @version 1.0
 */

?>

		<!-- RODAPÉ -->
		<div class="container">
			<div class="row">
				<footer class="col-md-12 footer">
					<div class="row">
						<div class="col-md-12 footer-widgets">
							<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
						</div>
						<div class="col-md-12 footer-nav">
							<?php get_template_part( 'template-parts/footer/footer', 'nav' ); ?>	
						</div>
						<div class="col-md-12 footer-info">
							<?php get_template_part( 'template-parts/footer/footer', 'info' ); ?>	
						</div>
					</div>
				</footer>
			</div>
		</div>

		<!-- Scripts Secundários -->
	    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	    <?php wp_footer(); ?>

	</body>

</html>