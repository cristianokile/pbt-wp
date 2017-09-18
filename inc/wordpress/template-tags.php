<?php
/**
 * Template de Tags Customizadas para este tema
 *
 * Ecentualmente, algumas funcionalidades aqui listadas podem ser substituidas por recursos padrão do sistema
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 */

if ( ! function_exists( 'pbt_wp_posted_on' ) ) :
/**
 * Exibe HTML com meta informação para atual post-data/hora e autor.
 */
function pbt_wp_posted_on() {

	// Pega o nome do autor. Exibe-o em uma link.
	$byline = sprintf(
		/* tradutores: %s: autor do post */
		__( 'por %s', 'pbt_wp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finalmente, vamos escrever tudo isso na página.
	echo '<span class="posted-on">' . pbt_wp_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;


if ( ! function_exists( 'pbt_wp_time_link' ) ) :
/**
 * Pega uma string de data de publicação melhor formatada.
 */
function pbt_wp_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Insere string de tempo em um link, e insere na frente o texto 'Postado em'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Postado em</span> %s', 'pbt_wp' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;


if ( ! function_exists( 'pbt_wp_entry_footer' ) ) :
/**
 * Exite um HTML com meta-informação para as categorias, tags e comentários.
 */
function pbt_wp_entry_footer() {

	/* tradutores: entre a lista de itens, há um espaço depois da vírigula */
	$separate_meta = __( ', ', 'pbt_wp' );

	// Pega as Categorias para os posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Pega as Tags para o Post
	$tags_list = get_the_tag_list( '', $separate_meta );

	// Não queremos exibir .entry-footer se ele estiver vazio, então não se esqueça.
	if ( ( ( pbt_wp_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && pbt_wp_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Certifique-se de que há mais de uma categoria antes de exibi-lo
						if ( $categories_list && pbt_wp_categorized_blog() ) {
							echo '<span class="cat-links">' . pbt_wp_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categorias', 'pbt_wp' ) . '</span>' . $categories_list . '</span>';
						}

						if ( $tags_list ) {
							echo '<span class="tags-links">' . pbt_wp_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'pbt_wp' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			pbt_wp_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'pbt_wp_edit_link' ) ) :
/**
 * Retorna um link amigável de acessibilidade para editar um post ou uma página
 *
 * Isso também nos dá um pequeno contexto sobre o que exatamente estamos editando
 * (postagem ou página?) Para que os usuários compreendam um pouco mais, onde eles 
 * estão em termos de hierarquia de modelos e seu conteúdo. Útil quando / se o layout
 * de uma página com várias postagens / páginas mostradas ficar confuso.
 */
function pbt_wp_edit_link() {
	edit_post_link(
		sprintf(
			/* tradutores: %s: Nome do post atual */
			__( 'Editar<span class="screen-reader-text"> "%s"</span>', 'pbt_wp' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Display a front page section.
 * Exibe uma sessão de Front-Page
 *
 * @param WP_Customize_Partial $partial Associado parcial com uma requisição de atualização seletiva.
 * @param integer              $id da seção a ser exibida.
 */
function pbt_wp_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) :
		// Encontra uma id e configure-a durante a atualização seletiva.
		global $pbt_wpcounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$pbt_wpcounter = $id;
	endif;

	global $post; // Modifique o objeto de postagem global antes de configurar os dados do post.
	if ( get_theme_mod( 'panel_' . $id ) ) :
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	elseif ( is_customize_preview() ) :
		// A âncora do espaço reservado da saída.
		echo '<article class="panel-placeholder panel pbt_wp-panel pbt_wp-panel' . $id . '" id="panel' . $id . '"><span class="pbt_wp-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'pbt_wp' ), $id ) . '</span></article>';
	endif;
}

/**
 * Retorna verdadeiro se um blog tiver mais de 1 categoria.
 *
 * @return bool
 */
function pbt_wp_categorized_blog() {
	$category_count = get_transient( 'pbt_wp_categories' );

	if ( false === $category_count ) :
		// Crie um array de todas as categorias que estão anexadas às postagens.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// Precisamos somente saber se há mais de uma categoria
			'number'     => 2,
		) );

		// Conta o número de categorias que estão atribuidas aos posts
		$category_count = count( $categories );

		set_transient( 'pbt_wp_categories', $category_count );
	endif;

	// Permitir a visualização no de caso o 0 ou 1 categorias na pré-visualização.
	if ( is_preview() ) :
		return true;
	endif;

	return $category_count > 1;
}


/**
 * Elimina os transientes usados em pbt_wp_categorized_blog.
 */
function pbt_wp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) :
		return;
	endif;
	// Curta, Caia-fora. Dig?
	delete_transient( 'pbt_wp_categories' );
}
add_action( 'edit_category', 'pbt_wp_category_transient_flusher' );
add_action( 'save_post',     'pbt_wp_category_transient_flusher' );
