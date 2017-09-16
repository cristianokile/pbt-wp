<?php
/**
 * Piece Blank Theme - Funcções e Definições Padrões do tema
 *
 * @package PieceBlankTheme
 * @subpackage pbt-wp
 * @since 1.0
 */
?>

<?php
/**
 * SUPORTE A WP - Piece Blank Theme funciona somente a partir do WordPress versão 4.7
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Definição dos padrões do tema e registro do suporte para vários recursos do WordPress.
 *
 * Observe que esta função é hookada dentro do after_setup_theme, que é executado antes do
 * hook inicial. O gancho de inicialização é atrasdo para alguns recursos, como indicação de
 * suporte para as miniaturas do post.
 */
function pbt_wp_setup() {
	// TRADUÇÕES - Habilita o tema para receber traduções 
	load_theme_textdomain( 'pbt_wp' );

	// RSS FEED - Adiciona RSS feed links de posts padrões e comentários ao cabecalho 
	add_theme_support( 'automatic-feed-links' );

	 // TITULO DO DOCUMENTO - Permitir ao WordPress gerenciar o Title do Documento
	add_theme_support( 'title-tag' );

	// MINIATURA DE POSTS - Habilita o suporte a Miniatura de Posts (Post Thumbnails) nas páginas e posts
	add_theme_support( 'post-thumbnails' );

	//TAMANHOS MINIATURAS DE POSTS - Adiciona tamanhos customizados de Miniaturas de Posts
	add_image_size( 'pbt_wp-featured-image', 2000, 1200, true );
	add_image_size( 'pbt_wp-thumbnail-avatar', 100, 100, true );

	// LARGURA DE CONTENT - Define a largura do tamanho padrão de conteúdo
	$GLOBALS['content_width'] = 525;

	// MENUS - Define a àrea onde os menus wp_nav_menu() deverão aparecer
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'pbt_wp' ),
		'social' => __( 'Social Links Menu', 'pbt_wp' ),
	) );

	/* HTML5 FORMS - Altera a marcação padrão do núcleo para formulário de pesquisa,
	 formulário de comentário e comentários para produzir HTML5 válido.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// FORMATOS DE POSTS - Habilita o suporte para Formatos Específicos de Posts
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// LOGO CUSTOMIZADO - Adiciona suporte ao Logo Customizado
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	//ATUALIZAÇÃO DE WIDGETS - Adiciona suporte a atualização seletiva de widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	// ESTILO DE EDITOR - Adiciona o mesmo estilo visual do tema para o editor visual (cores, fontes e larguras)
	add_editor_style( array( 'assets/css/editor-style.css', pbt_wp_fonts_url() ) );

	// CONTEÚDOS PADRÕES - Define o conteúdo inicial e widgets que deverão ser exibidos em cada nova instalaõa do tema
	$starter_content = array(
		'widgets' => array(
			// Coloca os três widgets definidos no núcleo na área da barra lateral.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Adiciona o widget de informações de negócios definido pelo núcleo na área do rodapé 1.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Coloca dois widgets definidos no núcleo na área do rodapé 2.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),
		// PADRÕES DE IMAGENS - Define para algumas páginas que serão criadas pelo sistema, quais tipos de miniaturas deverão ser suportadas.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Crie os anexos de imagem personalizados usados como miniaturas de publicação para páginas.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'pbt_wp' ),
				'file' => 'assets/images/espresso.jpg', // URL relativa ao diretório do template.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'pbt_wp' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'pbt_wp' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// EXIBIÇÃO DE POSTS
		// Define uma página estática para exibição de Home e Exibição de Posts.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// IDS DE MÓDULOS
		// Define para as seções dos módulos do tema os IDs das páginas registradas no núcleo.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// REGISTRO DE MENUS
		// Define menus de navegação para cada uma das duas áreas registradas no tema.
		'nav_menus' => array(
			// TOP - Atribui o menu top para o cabeçalho do tema
			'top' => array(
				'name' => __( 'Top Menu', 'pbt_wp' ),
				'items' => array(
					'link_home', // Note que a página inicial da "home" será um link para o caso de uma página front-page não ser usada.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// SOCIAL - Atribui um menu para o rodapé do tema
			'social' => array(
				'name' => __( 'Social Links Menu', 'pbt_wp' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);


	/**
	 * Filtros Piece Blank Theme de inicializar conteúdos.
	 *
	 * @since Piece Blank Theme 1.0
	 *
	 * @param array $starter_content Array do inicializador de conteúdo.
	 */
	$starter_content = apply_filters( 'pbt_wp_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'pbt_wp_setup' );


/**
 * Configura o tamanho do conteuúdo em pixels, baseado no design do tema e folha de estilos
 *
  * Prioridade 0 faz ele ser disponível em baixa prioridade nas chamadas callbacks.
 *
 * @global int $content_width
 */
function pbt_wp_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Obtem o layout
	$page_layout = get_theme_mod( 'page_layout' );

	// Checa se o layout é de uma coluna
	if ( 'one-column' === $page_layout ) {
		if ( pbt_wp_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Checa se é single post e se ele possui sidebar
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Piece Blank Theme content width of the theme.
	 *
	 * @since Piece Blank Theme 1.0
	 *
	 * @param int $content_width Largura do Conteúdo em pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'pbt_wp_content_width', $content_width );
}
add_action( 'template_redirect', 'pbt_wp_content_width', 0 );

/**
 * FONTES
 * Registra Fontes Customizadas
 */
function pbt_wp_fonts_url() {
	$fonts_url = '';
	/*
	 * Tradutores: Se houverem caracteres em sua linguagem que não forem suportados
	 * pela Libre Franklin, coloque na tradução 'off'. Não traduza para a sua lingua.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'pbt_wp' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * GOOGLE FONTES
 * Adiciona preconexão para o Google Fonts.
 *
 * @since Piece Blank Theme 1.0
 *
 * @param array  $urls           URLs para imprimir dicas de recursos.
 * @param string $relation_type  O tipo de relação que os URLs são impressos.
 * @return array $urls           URLs para imprimir dicas de recursos.
 */
function pbt_wp_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'pbt_wp-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'pbt_wp_resource_hints', 10, 2 );

/**
 * ÁREAS DE WIDGETS
 * Registrar áreas de widget.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pbt_wp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'pbt_wp' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'pbt_wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'pbt_wp' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'pbt_wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'pbt_wp' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'pbt_wp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'pbt_wp_widgets_init' );

/**
 * LEIA MAIS 
 * Substituir "[...]" (adicionado automaticamente nos excerpts gerados) com ... e
 * um link de 'Continuar lendo'.
 *
 * @since Piece Blank Theme 1.0
 *
 * @param string $link Link para single post/page.
 * @return string link 'Continuar lendo' precedido com uma elipse.
 */
function pbt_wp_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* tradutores: %s: Nome do Post Atual */
		sprintf( __( 'Continuar lendo <span class="screen-reader-text"> "%s"</span>', 'pbt_wp' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'pbt_wp_excerpt_more' );

/**
 * DETECÇÃO DE SCRIPTS 
 * Detecção e Manipulação de Javascript
 *
 * Adiciona uma classe `js` ao elemento `<html>` quando JavaScript for detectado.
 *
 * @since Piece Blank Theme 1.0
 */
function pbt_wp_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'pbt_wp_javascript_detection', 0 );

/**
 * PINGBACK
 * Adiciona uma url de pingback auto-discovery header para artigos singularmente identificaveis.
 */
function pbt_wp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'pbt_wp_pingback_header' );

/**
 * ENFILEIRAMENTO DE SCRIPTS E ESTILOS
 */
function pbt_wp_scripts() {
	// Adicionar Fontes Customizadas, usadas na folha de estilo principal
	wp_enqueue_style( 'pbt_wp-fonts', pbt_wp_fonts_url(), array(), null );

	// Folha de estilo do tema
	wp_enqueue_style( 'pbt_wp-style', get_stylesheet_uri() );

	// Carrega o esquema de cores Dark
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'pbt_wp-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'pbt_wp-style' ), '1.0' );
	}

	// Carrega os estilos específicos para o Internet Explorar 9, para corrigir problemas de exibição na customização
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'pbt_wp-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'pbt_wp-style' ), '1.0' );
		wp_style_add_data( 'pbt_wp-ie9', 'conditional', 'IE 9' );
	}

	// Carrega os estilos específicos para o Internet Explorer 8
	wp_enqueue_style( 'pbt_wp-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'pbt_wp-style' ), '1.0' );
	wp_style_add_data( 'pbt_wp-ie8', 'conditional', 'lt IE 9' );

	// Carrega o HTML6 Shiv
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'pbt_wp-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
	$pbt_wp_l10n = array(
		'quote'          => pbt_wp_get_svg( array( 'icon' => 'quote-right' ) ),
	);
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'pbt_wp-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$pbt_wp_l10n['expand']         = __( 'Expand child menu', 'pbt_wp' );
		$pbt_wp_l10n['collapse']       = __( 'Collapse child menu', 'pbt_wp' );
		$pbt_wp_l10n['icon']           = pbt_wp_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}


	// ADIÇÃO DE SCRIPTS
	
	// jQUERY 1.0
	wp_enqueue_script( 'pbt_wp-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
	// ScrollTo
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'pbt_wp-skip-link-focus-fix', 'pbt_wpScreenReaderText', $pbt_wp_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pbt_wp_scripts' );

/**
 * ATRIBUTOS DE IMAGENS
 * Adicionando atributos de imagems de tamanhos customizados para habilitar a 
 * funcionalidade de imagens responsiva a conteudos de imagens
 *
 * @since Piece Blank Theme 1.0
 *
 * @param string $sizes Um valor de tamanho de fonte para uso em um atributo 'tamanhos'.
 * @param array  $size Tamanho de imagem. Aceita um array de largura e altura
 *                      valores em pixels (nesta ordem).
 * @return string Um valor de tamanho de fonte para uso em um atributo de tamanhos de imagem de conteúdo.
 */
function pbt_wp_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'pbt_wp_content_image_sizes_attr', 10, 2 );

/**
 * Filtro de valores de 'tamanho' na marcação de imagem no header
 *
 * @since Piece Blank Theme 1.0
 *
 * @param string $html   A de tag de imagem em HTML sendo filtrada.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array de attributos para a tag de imagem.
 * @return string A imagem de cabeçalho HMTL filtrada.
 */
function pbt_wp_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'pbt_wp_header_image_tag', 10, 3 );

/**
 * Adicionando tamanhos de imagens customizados para habilitar a funcionalidade de
 * responsividade de imagens para miniaturas de posts
 *
 * @since Piece Blank Theme 1.0
 *
 * @param array $attr       Atributes para a marcação de imagem.
 * @param int   $attachment ID da imagem de anexo.
 * @param array $size       Tamanho de imagem registrada ou array de dimensões de alturas e larguras.
 * @return string Um valor de tamanho de origem para uso no atributo de "tamanhos" de uma miniatura de publicação.
 */
function pbt_wp_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'pbt_wp_post_thumbnail_sizes_attr', 10, 3 );

/**
 * FRONT-PAGE ESTÁTICA 
 * Usar front-page.php quando a opção Front page for configurada para ser uma página estática.
 *
 * @since Piece Blank Theme 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string O template a ser usado: blank se is_home() for verdadeiro (defaults para index.php), senão $template.
 */
function pbt_wp_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'pbt_wp_front_page_template' );

/**
 * CUSTOM HEADER
 * Implementar o recurso de Custom Header.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * TEMPLATE TAGS CUSTOM
 * Template de tags customizados para teste tema
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );
